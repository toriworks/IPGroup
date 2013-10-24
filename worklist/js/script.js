var _Today;
var _TodayYear;
var _TodayMonth;
var _TodayDay;
var _Year;
var _Month;
var _Date;
var _Project;
var _ProjectName = '전체';
var _Worker;
var _WorkerName = '전체';
var _Type;
var _TypeName = '전체';
var _InputTextSubject;
var _InputTextWorktime;

$(window).load(function(){
	init();
});

function init() {

	/* 현재 년월 설정 */
	_Today = new Date();
	_TodayYear = _Today.getFullYear();
	_TodayMonth = _Today.getMonth()+1;
	_TodayDay =  _Today.getDate();
	_Year  = _TodayYear;
	_Month = _TodayMonth;

	displayMonthSet(_Year,_Month);
	displayGroupListFunc();
	displayProjectListFunc();
	displayWorkerListFunc();
	displayTypeListFunc();
	initSelectBox();
}

/************************************************************************
 *  Event Functions
 */

function setWorkListFunc() {
	$('table.workList tr').hover(function(){
		$(this).addClass('over');
	}, function(){
		$(this).removeClass('over');
	});

	$('table.workList a.icoMod').click(function(){
		$('.writeButton').css('display','none');
		$('.modifyButton').css('display','inline');
		pTr = $(this).parent().parent().parent();
		workId = pTr.attr('workId');
		pTr.after('<tr class="modify"><td colspan="'+pTr.children('td').length+'"></td></tr>');
		$('fieldset.writeContainer').appendTo(pTr.next().children('td'));
		$('table.workList tr.modify').filter(function(){
			if ($(this).children('td').children('fieldset.writeContainer').length == 1) {
				return false;
			} else {
				return true;
			}
		}).remove();

		$('#datepicker').datepicker('setDate',$('tr[workId="'+workId+'"] td.date').text());
		$('input[name="subject"]').attr('value',$('tr[workId="'+workId+'"] td.subject').text());
		$('input[name="worktime"]').attr('value',$('tr[workId="'+workId+'"] td.worktime').text());
		setSelectBox('worker',$('tr[workId="'+workId+'"] td.worker').text());
		setSelectBox('type',$('tr[workId="'+workId+'"] td.type').text());
		setSelectBox('project',$('tr[workId="'+workId+'"] td.project').text());

		$('a.btnModify').attr('href','#'+workId);

		return false;	
	});

	$('table.workList a.icoDel').click(function(){
		workId = $(this).parent().parent().parent().attr('workId');
		if (confirm('삭제하시겠습니까?')) {
			displayLoading(true);
			$.ajax({
				type: 'POST',
				url: 'php/workDelete.php',
				data: 'id='+workId,
				success: function(msg){
					displayLoading(false);
					if (msg == 'COMPLETE') {
						$('tr[workId="'+workId+'"]').remove();
						displayMessage('삭제되었습니다.');
					} else {
						alert('ERROR');
					}
				}
			});
		}
		return false;	
	});

	$('table.workList a.icoMod').focus(function(){
		$(this).blur();
	});
	$('table.workList a.icoDel').focus(function(){
		$(this).blur();
	});
	$('table.workList td.date').css('cursor','pointer');
	$('table.workList td.date').click(function() {
		_Date = $(this).text();
		displayWorkList();
		_Date = '';
		return false;
	});
}

function setGroupListFunc() {
	$('#groupList a').click(function(){
		setCookie('_GROUP',$(this).attr('href').replace('#',''),30);
		document.location.href = '?_GROUP='+$(this).attr('href').replace('#','');
		return false;
	});
	$('#groupList a').focus(function(){
		$(this).blur();
	});
}

function setProjectListFunc() {
	$('#projectList li a').click(function(){
		_Project = $(this).attr('href').replace('#','');
		_ProjectName = $(this).html();
		$('#projectList li').removeClass('on');
		$('#projectList li').removeClass('off');
		$('#projectList li').addClass('off');
		$(this).parent().addClass('on');
		displayWorkList();
		return false;
	});
	$('#projectList li a').focus(function(){
		$(this).blur();
	});
}

function setWorkerListFunc() {
	$('#workerList li a').click(function(){
		_Worker = $(this).attr('href').replace('#','');
		_WorkerName = $(this).html();
		$('#workerList li').removeClass('on');
		$('#workerList li').removeClass('off');
		$('#workerList li').addClass('off');
		$(this).parent().addClass('on');
		displayWorkList();
		return false;
	});
	$('#workerList li a').focus(function(){
		$(this).blur();
	});
}

function setTypeListFunc() {
	$('#typeList li a').click(function(){
		_Type = $(this).attr('href').replace('#','');
		_TypeName = $(this).html();
		$('#typeList li').removeClass('on');
		$('#typeList li').removeClass('off');
		$('#typeList li').addClass('off');
		$(this).parent().addClass('on');
		displayWorkList();
		return false;
	});
	$('#typeList li a').focus(function(){
		$(this).blur();
	});
}

function setSelectBox(n,v) {
		$('div.select.'+n+' li').removeClass('hover');
		$('div.select.'+n+' div.my_value').text(v);
		f = $('div.select.'+n+' label').filter(function(){
			return $(this).text() == v;
		}).attr('for');
		$('#'+f).attr('checked',true)
				.parent().addClass('hover');
}

function clearSelectBox(n,v) {
		$('div.select.'+n+' li').removeClass('hover');
		$('div.select.'+n+' div.my_value').text(v);
		$('div.select.'+n+' input[type=radio]').attr('checked',false);
}

function resetWriteContainer() {
	if ($('.writeButton').css('display') == 'none') {
		$('.writeButton').css('display','inline');
		$('.modifyButton').css('display','none');

		$('fieldset.writeContainer').appendTo($('div.topStatusBar'));
		$('table.workList tr.modify').remove();

		$('#datepicker').datepicker('setDate',_TodayYear+'-'+_TodayMonth+'-'+_TodayDay);
		$('input[name="subject"]').attr('value',_InputTextSubject);
		$('input[name="worktime"]').attr('value',_InputTextWorktime);
		clearSelectBox('worker','작업자 선택');
		clearSelectBox('type','유형 선택');
		clearSelectBox('project','프로젝트 선택');
	}
}

/************************************************************************
 *  Display Functions
 */

function displayGroupListFunc() {
	var param = "";
	$('#groupList').load('/worklist/html/groupList.php',param,function(){
		setGroupListFunc();
	});
}
function displayProjectListFunc() {
	var param = "";
	$('#projectList').load('/worklist/html/projectList.php',param,function(){
		setProjectListFunc();
	});
}
function displayWorkerListFunc() {
	var param = "";
	$('#workerList').load('/worklist/html/workerList.php',param,function(){
		setWorkerListFunc();
	});
}
function displayTypeListFunc() {
	var param = "";
	$('#typeList').load('/worklist/html/typeList.php',param,function(){
		setTypeListFunc();
	});
}
function displayMonthSet(y,m) {
	$('.monthSet .setValue').html(y+'.'+((m<10)?'0'+m:m));
	_Year  = y;
	_Month = m;
	
	displayWorkList();

	var py = y;
	var ny = y;
	var pm = m;
	var nm = m;

	if ((y == 2010) && (m == 1)) {
		$('.monthSet .prev').html('<span>&lt; 이전달</span>');
	} else {
		if (m == 1) { py = y-1; pm = 12;} else { pm--; }
		$('.monthSet .prev').html('<a>&lt; 이전달</a>');
		$('.monthSet .prev a').click(function(){
			displayMonthSet(py,pm);
		});
	}	
	
	if ((y == _TodayYear) && (m == _TodayMonth)) {
		$('.monthSet .next').html('<span>다음달 &gt;</span>');
	} else {
		if (m == 12) { ny = y+1; nm = 1; } else { nm++; }
		$('.monthSet .next').html('<a>다음달 &gt;</a>');
		$('.monthSet .next a').click(function(){
			displayMonthSet(ny,nm);
		});
	}
}

function displayWorkList() {
	resetWriteContainer();
	param = 'y='+_Year+'&m='+_Month+'&p='+_Project+'&w='+_Worker+'&t='+_Type+'&d='+_Date;
	displayLoading(true);
	$('#workList').load('/worklist/html/workList.php',param,function(){
		setWorkListFunc();
		displayLoading(false);
	});
}

function displayLoading(s) {
	if (s) {
		$('#loadImg .icon').css('display','block');
		$('#loadImg .message').css('display','none');
	} else {
		$('#loadImg .icon').css('display','none');
		$('#loadImg .message').css('display','block');
	}
}

function displayMessage(s) {
	$('#loadImg .message').html(s);
}

function displayInactiveShow() {
	$('#projectList li.inactive').show();
}

function displayInactiveHide() {
	$('#projectList li.inactive').hide();
}

/************************************************************************
 *  Cookie Functions
 */

function setCookie(c_name,value,expiredays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ '=' +escape(value)+	((expiredays==null) ? '' : ';expires='+exdate.toUTCString());
}

function getCookie(c_name) {
	if (document.cookie.length>0) {
		c_start=document.cookie.indexOf(c_name + '=');
		if (c_start!=-1) {
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(';',c_start);
		    if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return '';
}

/************************************************************************
 *  Write Forms Functions
 */
$(function(){

	// Datepicker
	$('#datepicker').datepicker({
		dayNamesMin:['일','월','화','수','목','금','토'],
		dayNamesShort:['일','월','화','수','목','금','토'],
		dayNames:['일','월','화','수','목','금','토'],
		monthNames:['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dateFormat:'yy-mm-dd',
		altField:'input[name="date"]',
		navigationAsDateFormat:true,
		onSelect : function() {
			$('#datepicker').hide();
		}
	});

	$('input[name="date"]').focus(function(){
		$('#datepicker').show();
		$(this).blur();
	});

	_InputTextSubject = $('input[name="subject"]').attr('value');

	$('input[name="subject"]').focus(function(){
		if ($(this).attr('value') == _InputTextSubject) {
			$(this).attr('value','');
		}
	});

	$('input[name="subject"]').blur(function(){
		if ($(this).attr('value') == '') {
			$(this).attr('value',_InputTextSubject);
		}
	});

	_InputTextWorktime = $('input[name="worktime"]').attr('value');

	$('input[name="worktime"]').focus(function(){
		if ($(this).attr('value') == _InputTextWorktime) {
			$(this).attr('value','');
		}
	});

	$('input[name="worktime"]').blur(function(){
		if ($(this).attr('value') == '') {
			$(this).attr('value',_InputTextWorktime);
		}
	});

	$('a.btnSave').click(function(){
		s_date     = $('input[name="date"]').attr('value');
		s_worker   = $('input[name="worker"]:checked').attr('value');
		s_type     = $('input[name="type"]:checked').attr('value');
		s_project  = $('input[name="project"]:checked').attr('value');
		s_subject  = $('input[name="subject"]').attr('value');
		s_worktime = $('input[name="worktime"]').attr('value');

		if (s_worker == undefined) {
			alert('작업자를 선택해 주세요.');
			return false;
		}
		if (s_type == undefined) {
			alert('유형을 선택해 주세요.');
			return false;
		}
		if (s_project == undefined) {
			alert('프로젝트를 선택해 주세요.');
			return false;
		}
		if (s_subject == '작업명') {
			alert('작업명을 입력해 주세요.');
			return false;
		}
		if (s_worktime == '작업시간') {
			alert('작업시간을 입력해 주세요.');
			return false;
		} else {
			if ((parseFloat(s_worktime) == 'NaN') || (parseFloat(s_worktime) != s_worktime)) {
				alert('작업시간을 잘못 입력하셨습니다.\n ex) 0.5 , 1.5 , 4');
				return false;
			}
		}
		
		displayLoading(true);
		$.ajax({
			type: 'POST',
			url: 'php/workInsert.php',
			data: 'd='+s_date+'&p='+s_project+'&wk='+s_worker+'&t='+s_type+'&wt='+s_worktime+'&w='+s_subject,
			success: function(msg){
				displayLoading(false);
				if (msg == 'COMPLETE') {
					displayWorkList();
					$('input[name="subject"]').attr('value',_InputTextSubject);
					$('input[name="worktime"]').attr('value',_InputTextWorktime);
				} else {
					alert('ERROR');
				}
			}
		});

		return false;
	});

	$('a.btnModify').click(function(){
		s_id       = $(this).attr('href').replace('#','');
		s_date     = $('input[name="date"]').attr('value');
		s_worker   = $('input[name="worker"]:checked').attr('value');
		s_type     = $('input[name="type"]:checked').attr('value');
		s_project  = $('input[name="project"]:checked').attr('value');
		s_subject  = $('input[name="subject"]').attr('value');
		s_worktime = $('input[name="worktime"]').attr('value');

		if (s_worker == undefined) {
			alert('작업자를 선택해 주세요.');
			return false;
		}
		if (s_type == undefined) {
			alert('유형을 선택해 주세요.');
			return false;
		}
		if (s_project == undefined) {
			alert('프로젝트를 선택해 주세요.');
			return false;
		}
		if (s_subject == '작업명') {
			alert('작업명을 입력해 주세요.');
			return false;
		}
		if (s_worktime == '작업시간') {
			alert('작업시간을 입력해 주세요.');
			return false;
		} else {
			if ((parseFloat(s_worktime) == 'NaN') || (parseFloat(s_worktime) != s_worktime)) {
				alert('작업시간을 잘못 입력하셨습니다.\n ex) 0.5 , 1.5 , 4');
				return false;
			}
		}
		
		displayLoading(true);
		$.ajax({
			type: 'POST',
			url: 'php/workUpdate.php',
			data: 'id='+s_id+'&d='+s_date+'&p='+s_project+'&wk='+s_worker+'&t='+s_type+'&wt='+s_worktime+'&w='+s_subject,
			success: function(msg){
				displayLoading(false);
				if (msg == 'COMPLETE') {
					resetWriteContainer();
					if (parseInt(s_worktime) == parseFloat(s_worktime)) {
						s_worktime = parseInt(s_worktime) + ".0";
					}
					temp = s_date.split('-');
					dd = new Date();
					dd.setFullYear(Number(temp[0]),Number(temp[1])-1,Number(temp[2]));
					week = new Array('일', '월', '화', '수', '목', '금', '토');
					$('tr[workId="'+s_id+'"] td.date').text(s_date);
					$('tr[workId="'+s_id+'"] td.week').text(week[dd.getDay()]);
					$('tr[workId="'+s_id+'"] td.subject').text(s_subject);
					$('tr[workId="'+s_id+'"] td.worktime').text(s_worktime);
					$('tr[workId="'+s_id+'"] td.project').text($('label[for="project'+s_project+'"]').text());
					$('tr[workId="'+s_id+'"] td.worker').text($('label[for="worker'+s_worker+'"]').text());
					$('tr[workId="'+s_id+'"] td.type').text($('label[for="type'+s_type+'"]').text());
				} else {
					alert('ERROR');
				}
			}
		});

		return false;
	});

	$('a.btnCancel').click(function(){
		resetWriteContainer();
		return false;
	});

	
});
