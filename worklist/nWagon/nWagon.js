/*
    nWagon v1.0 | Copyright (C) 2013 NHN Technology Services.
    All rights reserved. Any use of the code written here-in belongs to NHN Technology Services.
    The library is non-commercial use only. Any content contained within can be added, 
    deleted and modified at any time.
    Authors | Insook Choe(choe.insook@nhn.com), Hansol Kim(hansol.kim@nhn.com)
*/

var CONST_SVG_URL = 'http://www.w3.org/2000/svg';
var CONST_MAX_RADIUS = 100;
var CONST_DECREMENT = 20;
//var obj.increment = 200;

var nWagon = {

    chart: function(options){

        var chartObj = new Object();
        chartObj.chartType = options['chartType'];
        chartObj.dataset = options['dataset'];
        chartObj.legend = options['legend'];
        chartObj.width = options['chartSize']['width'];
        chartObj.height = options['chartSize']['height'];
        chartObj.chart_div = options['chartDiv'];
        
        switch (chartObj.chartType)
        {
            case ('radar') : 
                this.radar.drawRadarChart(chartObj);
                break;
            case ('column'):
            case ('stacked_column') :
            case ('multi_column') :
                if (options['maxValue']) chartObj.highest = options['maxValue'];
                if (options['increment']) chartObj.increment = options['increment'];
                this.column.drawColumnChart(chartObj);
                break;
        }
    },

    createChartArea: function(parentSVG, chartType, viewbox, width, height){

        var chartDiv = document.getElementById(parentSVG);
        var attr = {'version':'1.1', 'width':width, 'height':height, 'viewBox':viewbox, 'class':'nWagon_' + chartType};
        var svg = nWagon.createSvgElem('svg', attr);
        chartDiv.appendChild(svg);

        return svg;
    },

    createSvgElem: function(elem, attr){
        var svgElem = document.createElementNS(CONST_SVG_URL, elem);
        if(!$.isEmptyObject(attr)) nWagon.setAttributes(svgElem, attr);
    
        return svgElem;
    },

    setAttributes: function(svgObj, attributes){ 
        $.each(attributes, function(key){
            svgObj.setAttribute(key,attributes[key]);
        });    
    },

    getMax: function(a){
        var maxValue = 0;
        $.each(a, function(i){
            var values = a[i]['value'];
            for (var j = 0; j < values.length; j++) 
            {
                if (typeof(values[j]) == 'number' && values[j] > maxValue) maxValue = values[j];
            } 
        });
        return maxValue;          
    },

    createTooltip: function(){
        var tooltip = nWagon.createSvgElem('g', {'class':'tooltip'});
        var tooltipbg = nWagon.createSvgElem('rect', {});
        tooltip.appendChild(tooltipbg);
        
        var tooltiptxt = nWagon.createSvgElem('text', {});
        tooltip.appendChild(tooltiptxt);

        return tooltip;
    },

    showToolTip: function(tooltip, px, py, value, height, ytextOffset, yRectOffset){
        return function(){
            $(tooltip).attr('display','block');
            $(tooltip).find('text').text(' ' + value);
            $(tooltip).find('text').attr({'x':px, 'y':py-ytextOffset, 'text-anchor':'middle'});
            var width = $(tooltip).find('text')[0].getBBox().width;
            $(tooltip).find('rect').attr({'x':(px-width/2)-5, 'y':py-yRectOffset, 'width':width+10,'height':height});
        }
    },

    hideToolTip: function(tooltip){
        return function(){
            $(tooltip).attr('display','none');
        }
    },

    column:{

        drawColumnChart: function(obj){         

            var width = obj.width, height = obj.height;
            var LeftOffsetAbsolute = 50, BottomOffsetAbsolute = 80;
            var RightOffsetAbsolute = obj.dataset['fields'] ? 150 : 0;

            var viewbox = (-LeftOffsetAbsolute) + ' ' + (BottomOffsetAbsolute-height) + ' ' + width + ' ' + height;
            var svg =  nWagon.createChartArea(obj.chart_div, obj.chartType, viewbox, width, height);
            var max = obj.highest ? obj.highest : nWagon.getMax(obj.dataset);
            
            this.drawBackground(svg, obj.legend['names'].length, obj.dataset, obj.increment, max, width-LeftOffsetAbsolute-RightOffsetAbsolute, height-BottomOffsetAbsolute);
            this.drawColumnForeground(svg, obj.legend, obj.dataset, obj.increment, max, width-LeftOffsetAbsolute-RightOffsetAbsolute, height-BottomOffsetAbsolute, obj.chartType);

        },

        drawColumn: function(parentGroup, width, height){

            var column = nWagon.createSvgElem('rect', {'x':'0', 'y':-height, 'width':width, 'height':height});
            parentGroup.appendChild(column);

            return column;
        },

        drawLabels: function(x, y, labelText){
            
            var attributes = {'x':x, 'y':y, 'text-anchor':'end', 'transform':'rotate(315,'+ x +','+ y + ')'};
            var text = nWagon.createSvgElem('text', attributes);
            text.textContent = labelText;
        
            return text;
        },

        getColorSetforSingleColumnChart: function(max, values, colorset){
            var numOfColors = colorset.length;
            var interval = max/numOfColors;
            var colors = [];
            $.each(values, function(index){
                var colorIndex = Math.floor(values[index]/interval);
                if (colorIndex == numOfColors) colorIndex--;
                colors.push(colorset[colorIndex]);
            });
            return colors;
        },

        drawColumnForeground: function(parentSVG, legend, dataset, increment, max, width, height, chartType){

            var numOfCols = legend['names'].length;    
            var colWidth = Math.floor(width/numOfCols);
            var yLimit = (Math.ceil(max/increment)+1) * increment;
            var px = '', cw = '', ch = '';
            var names = legend['names'];
            var data = dataset['values']

            var foreground = nWagon.createSvgElem('g', {'class':'foreground'});
            parentSVG.appendChild(foreground);

            var columns = nWagon.createSvgElem('g', {'class':'columns'});
            foreground.appendChild(columns);

            var labels = nWagon.createSvgElem('g', {'class':'labels'});
            foreground.appendChild(labels);

            var tooltip = nWagon.createTooltip();
            foreground.appendChild(tooltip);

            var drawColGroups = function(columns, ch, px, color, tooltipText, isStackedColumn, yValue){
                var colgroup  =  nWagon.createSvgElem('g', {});
                columns.appendChild(colgroup);
    
                var column = nWagon.column.drawColumn(colgroup, cw, ch);
                
                nWagon.setAttributes(column, {'x':px, 'style':'fill:'+color});
                if(isStackedColumn)
                {
                    py =  yValue - column.getBBox().y; 
                    if ( py > 0 ) nWagon.setAttributes(column, {'y':-py});
                }

                column.onmouseover = nWagon.showToolTip(tooltip, px+cw/2, -ch, tooltipText, 14, 7, 18);
                column.onmouseout = nWagon.hideToolTip(tooltip);

                column = null;  //prevent memory leak (in IE) 
            };

            if(chartType == 'column')
            {
                cw = (3/5*colWidth);  
                var colors = nWagon.column.getColorSetforSingleColumnChart(max, data, dataset['colorset']);

                $.each(data, function(index){

                    px = (colWidth*(index+0.2));// + cw;
                    ch = data[index]/yLimit*height;                                
                    drawColGroups(columns, ch, px, colors[index], data[index]);                    
                    
                    var text = nWagon.column.drawLabels(px + cw/2, 15, names[index], false, 0);
                    labels.appendChild(text);
                });

            }
            else if(chartType == 'multi_column')
            {
                var colors = dataset['colorset'];
                cw = (3/5*colWidth)/colors.length;  

                $.each(data, function(i){
                
                    var one_data = data[i];
                    px = (colWidth*(i+0.2));

                    $.each(one_data, function(index){
                        pxx = px+ (index*(cw));
                        ch = one_data[index]/yLimit*height;
                        drawColGroups(columns, ch, pxx, colors[index], data[index], false, 0);
                    });
            
                    var text = nWagon.column.drawLabels(px + cw/2, 15, names[i]);
                    labels.appendChild(text);    

                });
            }
            else if(chartType == 'stacked_column')
            {
                cw = (3/5*colWidth);  
                var colors = dataset['colorset'];

                $.each(data, function(i){
                 
                    var one_data = data[i];
                    var yValue = 0;

                    $.each(one_data, function(index){

                        px = (colWidth*(i+0.2));// + cw;
                        ch = one_data[index]/yLimit*height;

                        drawColGroups(columns, ch, px, colors[index], one_data[index], true, yValue);
                        yValue +=ch;
                        column = null;  
                    });
                
                    var text = nWagon.column.drawLabels(px + cw/2, 15, names[i]);
                    labels.appendChild(text);
                
                });
            }
        },

        drawBackground: function(parentSVG, numOfCols, dataset, increment, max, width, height){
            
            var colWidth = Math.floor(width/numOfCols);
            var attributes = {};
            var px = '', yRatio = 1;

            var background = nWagon.createSvgElem('g', {'class':'background'});
            parentSVG.appendChild(background);

            var numOfRows = Math.ceil(max/increment);
            rowHeight = height/(numOfRows+1);
    
            //Vertical lines
            for (var i = 0; i<=numOfCols; i++)
            {
                px = (i * colWidth).toString();
                attributes = {'x1':px, 'y1':'0', 'x2':px, 'y2':rowHeight-height, 'class':'v'};
                var line = nWagon.createSvgElem('line', attributes);
                background.appendChild(line);
            }
            //Horizontal lines (draw 1 more extra line to accomodate the max value)
            var count = 0;
            for (var i = 0; i<=numOfRows; i++)
            {
                attributes = {'x1':'0', 'y1':'-'+ i*rowHeight, 'x2':(numOfCols*colWidth).toString(), 'y2':'-'+ i*rowHeight, 'class':'h'};
                var line = nWagon.createSvgElem('line', attributes);
                background.appendChild(line);

                attributes = {'x':'-15', 'y':-((count*rowHeight)-3), 'text-anchor':'end'};
                var text = nWagon.createSvgElem('text', attributes);
                text.textContent = (count*increment).toString();
         
                background.appendChild(text);
                count++;
            }
            //Field Names
            if(dataset['fields'])
            {
                var fields = nWagon.createSvgElem('g', {'class':'fields'});
                background.appendChild(fields);

                var numOfFields = dataset['fields'].length;
                for (var i = 0; i<numOfFields; i++)
                {
                    px = width+20;
                    py = (30*i) - height + rowHeight;

                    attributes = {'x':px, 'y':py, 'width':30, 'height':15, 'fill':dataset['colorset'][i]};
                    var badge = nWagon.createSvgElem('rect', attributes);
                    fields.appendChild(badge);

                    attributes = {'x':px+40, 'y':py+7, 'alignment-baseline':'central'};
                    var name = nWagon.createSvgElem('text', attributes);
                    name.textContent = dataset['fields'][i];
                    fields.appendChild(name);
                }
            }

        },
    },

    radar: {        

        drawRadarChart: function(obj){

            var width = obj.width, height = obj.height;
            var viewbox = '-' + width/2 + ' -' + height/2 + ' ' + width + ' ' + height;
            var svg =  nWagon.createChartArea(obj.chart_div, obj.chartType, viewbox, width, height);

            this.drawBackground(svg, obj.legend['names'].length, CONST_DECREMENT, CONST_MAX_RADIUS);
            this.drawLabels(svg, obj.legend, CONST_MAX_RADIUS);
            this.drawCoordinates(svg, CONST_DECREMENT, CONST_MAX_RADIUS);
            this.drawPolygonForeground(svg, obj.legend, obj.dataset['values']);
        },

        drawCoordinates: function(parentSVG, decrement, maxRadius){
            
            var g = nWagon.createSvgElem('g', {'class':'xAxis'}); 
            var i = maxRadius, y=0.0, point=0.0;
            
            while (i > 0)
            {
                point = i+',' + y;

                var attributes = {'points': point, 'x':i, 'y':y, 'text-anchor':'middle'};
                var text = nWagon.createSvgElem('text', attributes);
                text.textContent = i.toString();
                g.appendChild(text);
                i-=decrement;
            }
            parentSVG.appendChild(g);
        },

        drawLabels: function(parentSVG, legend, maxRadius){
            
            var labels = nWagon.createSvgElem('g', {'class':'labels'});
            var hrefs = legend['hrefs'], names = legend['names'];
            var numOfRadars = names.length;

            $.each(names, function(index){

                var angle = (Math.PI*2)/numOfRadars; // (2*PI)/numOfRadars
                var x = 0 + (maxRadius+12) * Math.cos(((Math.PI*2)/numOfRadars) * (index));
                var y = 0 + (maxRadius+12) * Math.sin(((Math.PI*2)/numOfRadars) * (index));
                var align = (x < 0) ? 'end' : 'start';
                if(x < 1 && x > -1) align = 'middle';

                var attributes = {'onclick':'location.href="' + hrefs[index] + '"', 'x':x, 'y':y, 'text-anchor':align, 'class':'chart_label'};
                var text = nWagon.createSvgElem('text', attributes);
                text.textContent = names[index];

                labels.appendChild(text);
            });
            parentSVG.appendChild(labels);
        },

        drawPie: function(parentGroup, numOfRadars, maxRadius, decrement){
            /* Draw outer solid line and then inner dotted lines  */

            var angle = (Math.PI*2)/numOfRadars;
            var p0='', p1='', p2='';
            var attributes = {}, points ='';
            var radius = maxRadius;

            var pie = nWagon.createSvgElem('g', {'class':'pie'});

            while (radius > 0)
            {
                p0 = radius+',0'; //'100,0';
                p1 = '0,0'; 
                p2 = (radius*Math.sin(angle)/Math.tan(angle)) + ',' + (-radius*Math.sin(angle));
            
                if (radius == maxRadius)
                {
                    points = p0 + ' ' + p1 + ' ' + p2;
                    var lr = nWagon.createSvgElem('polyline', {'points':points});
                    pie.appendChild(lr);
                }
                
                points = p0 + ' ' + p2;
                attributes =  {'points':points, 'stroke-dasharray':'2px,2px'};
                var la = nWagon.createSvgElem('polyline', attributes);

                pie.appendChild(la);
                radius-=decrement;
            }
            
            parentGroup.appendChild(pie);

        },

        drawBackground: function(parentSVG, numOfRadars, decrement, maxRadius){

            var angle = 360/numOfRadars;
            var nthChild = 0;
            var i = maxRadius, count=0 ;

            var background = nWagon.createSvgElem('g', {'class':'background'});
            parentSVG.appendChild(background);
     
            for(var j=1; j<=numOfRadars; j++)
            {
                nthChild = count * numOfRadars + j;
                this.drawPie(background, numOfRadars, maxRadius, decrement);
                $('.nWagon_radar .background:last .pie:nth-child('+nthChild+')').attr('transform','rotate('+angle * (j-1)+')');
            }
        },

        dimmedPie: function(parentGroup, index, length)
        {
            var angle = (360/length) * index;
            this.drawPie(parentGroup, length, CONST_MAX_RADIUS, CONST_DECREMENT);
            $('.pie:last').attr('transform','rotate('+angle +')');
            $('.pie:last > polyline').attr('class','dim');

            if (((index+1)%length)== 0)
            {   
                this.drawPie(parentGroup, length, CONST_MAX_RADIUS, CONST_DECREMENT);
            }
            else
            {
                angle = (360/length) * (index+1);
                this.drawPie(parentGroup, length, CONST_MAX_RADIUS, CONST_DECREMENT);
                $('.pie:last').attr('transform','rotate('+angle +')');
            }
            $('.pie:last > polyline').attr('class','dim');
        },

        drawPolygonForeground: function(parentSVG, legend, dataGroup){

            var istooltipNeeded = (dataGroup.length == 1) ? true : false;

            $.each(dataGroup, function(i){
                var dataset = dataGroup[i];
                var length = dataset.length;
                var coordinate = [];
                var angle = (Math.PI/180)*(360/length);
                var pointValue = 0.0, px=0.0; py=0, attributes = {};
                var vertexes = [], tooltips =[];
        
                var foreground = nWagon.createSvgElem('g', {'class':'foreground'});
                parentSVG.appendChild(foreground);

                var polygon = nWagon.createSvgElem('polyline', {'class':'polygon'});
                foreground.appendChild(polygon);

                var tooltip = {};
                if (istooltipNeeded)
                {
                    tooltip = nWagon.createTooltip();
                } 

                $.each(dataset, function(index){

                    pointValue = dataset[index];
                    pointDisplay = dataset[index];
                    if (typeof(dataset[index]) != 'number')
                    {
                        nWagon.radar.dimmedPie(foreground, index, length); 
                        pointValue = 0;
                        pointDisplay = dataset[index];
                    }
                    
                    px = (index == 0) ? pointValue : pointValue*Math.sin(angle*index)/Math.tan(angle*index);
                    py = (index == 0) ? 0 : pointValue*Math.sin(angle*index);  
                    coordinate.push(px + ',' + py);

                    attributes = {'cx':px, 'cy':py, 'r':3, 'stroke-width':8, 'stroke':'transparent'};
                    var vertex = nWagon.createSvgElem('circle', attributes);

                    if (istooltipNeeded)
                    {
                        vertex.onmouseover = nWagon.showToolTip(tooltip, px, py, legend['names'][index] + ' : ' +  pointDisplay, 20, 15, 28);
                        vertex.onmouseout = nWagon.hideToolTip(tooltip);
                    }
                    foreground.appendChild(vertex);
                    vertex = null;

                });

                var coordinates = coordinate.join(' ');
                var attributes = {'points':coordinates, 'class':'polygon'};
                nWagon.setAttributes(polygon, attributes);

                if (istooltipNeeded) foreground.appendChild(tooltip);
            });
        },
    }
};









