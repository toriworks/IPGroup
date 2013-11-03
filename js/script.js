(function($){ 
/* ----------------------------------------------------------------------------------------- */
	function is_mobile() {
		return ($('#mobile_check').is(':visible')) ? true : false;
	}

	$(document).ready(function(){

		/*
		|--------------------------------------------------------------------------
		| Local navigation
		|--------------------------------------------------------------------------
		|
		| 섹션별 네비게이션에 대한 스크립트
		|
		*/
			function nav_link_off(objLink) {
				objLink.parent().removeClass("on");
				$(objLink.attr("href")).hide();
			}

			function nav_link_on(objLink) {
				objLink.parent().addClass("on");
				$(objLink.attr("href")).show();
			}

			function nav_link_check(objLink, linkCount) {
				var idx = objLink.parent().index();
				var oPrev = objLink.parents('.contents').find('.nav_controler a.prev');
				var oNext = objLink.parents('.contents').find('.nav_controler a.next');
				if (idx == 0) {
					oPrev.fadeOut(300);
					oNext.fadeIn(300);
				} else if (idx == linkCount - 1) {
					oPrev.fadeIn(300);
					oNext.fadeOut(300);
				} else {
					oPrev.fadeIn(300);
					oNext.fadeIn(300);
				}
			}

			$("div.contents > nav.lnb").each(function(){
				var _this = $(this);
				var _lnb_links = _this.find("> ul > li > a");
				if (_this.find("li.on").length > 0) return;
				_lnb_links.each(function(){ $($(this).attr("href")).hide(); });
				_lnb_links.bind("click",function(){
					nav_link_off(_this.find("> ul > li.on > a"));
					nav_link_on($(this));
					nav_link_check($(this), _lnb_links.length);
					return false;
				});
			});

			$("#about   nav.lnb li:first-child a").trigger("click");
			$("#contact nav.lnb li:first-child a").trigger("click");
			//$("#recruit nav.lnb li:first-child a").trigger("click");
			if ($("#recruit nav.lnb").length > 0) {
				if (document.location.href.split('#')[1] == 'recruit_job_posting') {
					$("#recruit nav.lnb li").eq(1).find("a").trigger("click");
				} else {
					$("#recruit nav.lnb li").eq(0).find("a").trigger("click");
				}
			}

			$("div.contents > div.nav_controler > a.prev").bind("click",function(){
				if ($(this).parents("div.contents").find("nav.lnb li.on").prev().length > 0) {
					$(this).parents("div.contents").find("nav.lnb li.on").prev().find("> a").trigger("click");
				};
				return false;
			});

			$("div.contents > div.nav_controler > a.next").bind("click",function(){
				if ($(this).parents("div.contents").find("nav.lnb li.on").next().length > 0) {
					$(this).parents("div.contents").find("nav.lnb li.on").next().find("> a").trigger("click");
				};
				return false;
			});


		/*
		|--------------------------------------------------------------------------
		| Works check
		|--------------------------------------------------------------------------
		|
		| Works 검색 조건 체크
		|
		*/
			$('.works_check label').bind('click',function(){
				if ($('#'+$(this).attr('for')).is(':checked')) {
					$(this).removeClass('on');
				} else {
					$(this).addClass('on');
				}				
			});
			$('.works_check input[type="checkbox"]').bind('change',function(){
				loadWorksList();
			});
			$('.works_check input[type="checkbox"]:checked').next().addClass('on');

		/*
		|--------------------------------------------------------------------------
		| How To Location
		|--------------------------------------------------------------------------
		|
		| Location 지도
		|
		*/
			$(".map_side .line_link a").bind("click",function(){

				var on_line = $(this).parents(".line_link").find("a.on");
				on_line.removeClass("on");
				$(on_line.attr("href")).hide();
				

				$(this).addClass("on");
				$($(this).attr("href")).show();

				return false;
			});

			setTimeout(function(){
				$(".map_side .line_link a").first().trigger("click");
			},100);



		/*
		|--------------------------------------------------------------------------
		| Vertical script
		|--------------------------------------------------------------------------
		|
		| Vertical script
		|
		*/
			if ($('body').hasClass('VERTICAL_PAGE')) {
				var default_idx = 1;
				var default_mark = document.location.href.split('#')[1];
				if (default_mark) {
					if (default_mark == 'about') {
						default_idx = 0;
					} else if (default_mark == 'works') {
						default_idx = 1;
					} else if (default_mark == 'contact') {
						default_idx = 2;
					}
				}
				var vertical_scroll = $.VerticalScroll({
					defaultSectionIdx : default_idx
				});
			}

		/*
		|--------------------------------------------------------------------------
		| Work list
		|--------------------------------------------------------------------------
		|
		| Work list
		|
		*/
			function loadWorksList() {
				var param_year = Array();
				$('input[name="year"]:checked').each(function(idx){
					param_year.push($(this).val());
				});
				param_year = param_year.join("^");

				var param_cate = 0;
				$('input[name="cate"]:checked').each(function(idx){
                    param_cate = param_cate + parseInt('0' + $(this).val());
				});

				var works_list = $.WorksList({
					param_y : param_year,
					param_c : param_cate,
					xmlPath : "./xml/works.php?param_year="+param_year+"&param_cate="+param_cate
				});
			}
			if ($('#works').length > 0) loadWorksList();
			var before_resize_is_mobile = is_mobile();
			$(window).bind('resize',function(){
				if (before_resize_is_mobile != is_mobile()) {
					loadWorksList();
				}
				before_resize_is_mobile = is_mobile();
			});

	});

/* ----------------------------------------------------------------------------------------- */

	$.extend({
		/*
		|--------------------------------------------------------------------------
		| VerticalScroll
		|--------------------------------------------------------------------------
		|
		| 세로 스크롤 스크립트
		|
		*/
		VerticalScroll : function(options) {
			// configuration
			var config = $.extend({
				sectionContainer : "section.screen",
				defaultSectionIdx : 0,
				scrollDuration : 300
			}, options);

			// variables
			var currentIdx = 0;
			var maxIdx;
			var timeoutScroll;
			var timeoutResize;
			var moveMode;
			var scrollDuration = 0;
			var scrollEnabled = true;

			// initialize the VerticalScroll
			function init() {
				scrollEnableCheck();
				maxIdx = $(config.sectionContainer).length;
				bind_event();
				changeSection(config.defaultSectionIdx);
				scrollDuration = config.scrollDuration;				
			}

			function bind_event() {
				$(document).bind('mousewheel',bindDocumentMousewheel);
				$(document).bind('scroll',bindDocumentScroll);
				$(window).bind('resize',bindWindowResize);
				$('nav.gnb ul li a').bind('click',bindNavLink);
				$("#works_view .area").bind('mousewheel',function(event){
				});
			}

			function bindDocumentMousewheel(event, delta, deltaX, deltaY) {
				if (!scrollEnabled) return;
				clearTimeout(timeoutScroll);
				event.preventDefault();
				if ($('html,body').is(':animated')) return;
				
				if ($('#works_view').is(':visible')) {	// Works 레이어 열렸을 때
					if (delta == -1) {
						$("#works_view .area").scrollTop($("#works_view .area").scrollTop() + 30);
					} else if (delta == 1) {
						$("#works_view .area").scrollTop($("#works_view .area").scrollTop() - 30);
					}
				} else {	// Works 레이어 안열렸을 때
					if (delta == -1) {
						if (currentIdx < maxIdx - 1) {
							changeSection(currentIdx + 1);
						}
					} else if (delta == 1) {
						if (currentIdx != 0) {
							changeSection(currentIdx - 1);
						}
					}
				}
			}

			function bindDocumentScroll() {
				if ($('html,body').is(":animated")) {
					return;
				} else {
					clearTimeout(timeoutScroll);
				}
				timeoutScroll = setTimeout(function(){
					if (!scrollEnabled) {
						var half = $('body').height() / 2;
						var about_top = $('#about').position().top;
						var works_top = $('#works').position().top;
						var contact_top = $('#contact').position().top;
						var document_top = $(document).scrollTop() + half;
						$('nav.gnb li.on').removeClass('on');
						if (document_top >= about_top && document_top < works_top) {
							$('nav.gnb li.a').addClass('on');
						} else if (document_top >= works_top && document_top < contact_top) {
							$('nav.gnb li.w').addClass('on');
						} else if (document_top >= contact_top) {
							$('nav.gnb li.c').addClass('on');
						}
					} else {
						checkScrollPosition();
					}
				}, 500);
			}

			function bindWindowResize() {
				scrollEnableCheck();
				if (!scrollEnabled) return;
				clearTimeout(timeoutResize);
				timeoutResize = setTimeout(checkScrollPosition, 500);
			}

			function scrollEnableCheck() {
				scrollEnabled = ($('#wrap').width() < 1024) ? false : true;
			}

			function bindNavLink() {
				changeSection($(this).parent().index());
				return false;
			}

			function autoScroll(n) {
				if (scrollEnabled) {
					$('html,body').animate({
						scrollTop : $('body').height() * n
					}, scrollDuration, function(){
						currentIdx = n;
					});
				} else {
					var o = $(config.sectionContainer).eq(n);
					$(document).scrollTop(o.position().top - 40);
				}
			}

			function checkScrollPosition() {
				var tmp = $(document).scrollTop() % $('body').height();
				var num = ($(document).scrollTop() - ($(document).scrollTop() % $('body').height())) / $('body').height();
				if (tmp >= $('body').height() / 2) {
					num++;
				}
				changeSection(num);
			}

			function changeSection(n) {
				$('nav.gnb ul li').removeClass('on').eq(n).addClass('on');
				autoScroll(n);
			}

			init();
		},

		/*
		|--------------------------------------------------------------------------
		| WorksList
		|--------------------------------------------------------------------------
		|
		| Works 리스트 ajax 스크립트 처리
		|
		*/
		WorksList : function(options) {
			// configuration
			var config = $.extend({
				param_y : "",
				param_c : "",
				xmlPath : "./xml/works.xml"
			}, options);

			// variables
			var worksXml;
			var worksList = $('#works .works_list');
			var workCount = 0;
			var workListPage = 1;
			var workListPageMax = 1;
			var btnPrev = $('.works_list_controler a.prev');
			var btnNext = $('.works_list_controler a.next');
			var workView = $('#works_view .view_contents');
			var workViewSeq = 1;
			var btnViewPrev = $('#works_view a.prev');
			var btnViewNext = $('#works_view a.next');
			var btnViewClose = $('#works_view a.close');
			
			// initialize the VerticalScroll
			function init() {

				$.ajax({
					type : "GET",
					url : config.xmlPath,
					cache : false,
					data : { year : config.param_y , cate : config.param_c },
					dataType : "xml",
					success : works_xml_loaded,
					error : function() { alert("Works xml load error!!"); }
				});

				clear_works_list();
				bind_event();
			}

			function bind_event() {
				btnPrev.bind('click',click_prev_button);
				btnNext.bind('click',click_next_button);
				btnViewPrev.bind('click',click_view_prev_button);
				btnViewNext.bind('click',click_view_next_button);
				btnViewClose.bind('click',click_view_close_button);
			}

			function click_prev_button() {
				if (workListPage == 1) return false;
				display_page(workListPage - 1);				
				return false;
			}

			function click_next_button() {
				if (workListPage == workListPageMax) return false;
				display_page(workListPage + 1);
				return false;
			}

			function button_setting() {
				if (workListPage == 1) {
					btnPrev.fadeOut(300);
					btnNext.fadeIn(300);
				} else if (workListPage == workListPageMax) {
					btnPrev.fadeIn(300);
					btnNext.fadeOut(300);
				} else {
					btnPrev.fadeIn(300);
					btnNext.fadeIn(300);
				}
			}

			function click_view_prev_button() {
				if (workViewSeq == 1) return false;
				display_view(workViewSeq - 1)
				return false;
			}

			function click_view_next_button() {
				if (workViewSeq == workCount) return false;
				display_view(workViewSeq + 1)
				return false;
			}

			function click_view_close_button() {
				$('#works_view').hide();
				return false;
			}

			function works_xml_loaded(xml) {
				worksXml = $(xml);
				workCount = worksXml.find('work').length;
				sort_works_list();
				display_page(workListPage);
			}

			function sort_works_list() {
				var row = 0;
				var col = 0;
				var sum = 0;
				var seq = 0;
				var page = 0;
				var type_val;
				var _this;

				// seq 지정
				worksXml.find('work').attr('seq','0');
				for (var w = 0; w < workCount; w++ ) {
					_this = worksXml.find('work').eq(w);
					type_val = parseFloat(_this.find('thumbnail').attr('type'));
					if (_this.attr('seq') != "0") {
						continue;
					}
					if (sum == 3) sum = 0;
					if (sum + type_val <= 3) {
						seq++;
						_this.attr('seq',seq);
						sum += type_val;
					} else {
						if (worksXml.find('work[seq=0] thumbnail[type=1]').length > 0) {
							seq++;
							worksXml.find('work[seq=0] thumbnail[type=1]').first().parents('work').attr('seq',seq);
						}
						seq++;
						_this.attr('seq',seq);
						sum = type_val;						
					}
				}

				// seq 기준 소팅
				for (var a = 1; a <= workCount; a++ ) {
					worksXml.find('ipgroup').append(worksXml.find('work[seq='+a+']'));
				}

				// 위치 정보 처리
				row = 1;
				col = 1;
				sum = 0;
				page = 1;

				worksXml.find('work').each(function(){
					_this = $(this);
					type_val = parseFloat(_this.find('thumbnail').attr('type'));
					if (sum + type_val > 3) {
						sum = type_val;
						if (row == 5) {
							row = 1;
							page++;
						} else {
							row++;
						}
						col = 1;
					} else {
						sum += type_val;
					}

					_this.attr('row',row);
					_this.attr('col',col);
					_this.attr('page',page);

					col += type_val;
				});

				workListPageMax = page;

				// ******************************
				if (is_mobile()) {
					worksXml.find('work').each(function(idx){
						$(this).attr('page',idx + 1);
						workListPageMax = idx + 1;
					});
				}
				// ******************************
			}

			function clear_works_list() {
				worksList.find('> ul').remove();
			}

			function display_page(p) {
				clear_works_list();
				worksList.append('<ul></ul>');
				var page_container = worksList.find('> ul');

				worksXml.find('work[page='+p+']').each(function(idx){
					page_container.append(html_list($(this)));
				});

				worksList.find('> ul > li')
				worksList.find('> ul > li').each(function(idx){
					//$(this).delay(50 * idx).show(400);
					$(this).delay(50 * idx).fadeIn(400);
					//$(this).show();
				});

				workListPage = p;
				button_setting();
				bind_work_view();
			}

			function html_list(o) {
				var type_class;
				var img_src;

				if (o.find('thumbnail').attr('type') == "1") {
					type_class = "type_a";
					img_src = o.find('thumbnail img_1').text();
				} else {
					type_class = "type_b";
					img_src = o.find('thumbnail img_2').text();
				}

				var html = '';
				html += '		<li style="display:none;" class="'+type_class+' row_'+o.attr('row')+' col_'+o.attr('col')+'">';
				html += '			<a class="work_view" href="#'+o.attr('seq')+'">';
				html += '				<img class="thumb" src="'+img_src+'" alt="'+o.find('thumbnail subtitle').text()+' 이미지">';
				html += '				<span class="title">'+o.find('thumbnail title').text()+'</span>';
				html += '				<span class="desc">'+o.find('thumbnail subtitle').text()+'</span>';
				html += '				<span class="date">'+o.find('thumbnail open').text()+'</span>';
				html += '				<span class="cover"></span>';
				html += '			</a>';
				html += '		</li>';
				return html;
			}

			function bind_work_view() {
				$('#works .works_list').find('a.work_view').bind('click',function(){
					var seq = $(this).attr('href').replace('#','');
					display_view(seq);
					return false;
				});
			}

			function clear_work_view() {
				workView.find('*').remove();
			}

			function display_view(seq) {
				$('#works_view').show();
				clear_work_view();
				workView.html(html_view(worksXml.find('work[seq='+seq+']')));
				$('#works_view .area').scrollTop(0);
				workViewSeq = parseFloat(seq);
				view_button_setting();
			}

			function html_view(o) {
				var html = '';
				html += '				<h3 class="title">';
				html += '					<span>'+o.find('project name').text()+'</span>';
				html += '				</h3>';
				html += '				<div class="info">';
				html += '					Client : '+o.find('project client').text()+'<br>';
				html += '					Period : '+o.find('project period').text()+'<br>';
				html += '					Link : <a href="'+o.find('project link').text()+'" target="_blank" title="새창">'+o.find('project link').text()+'</a><br>';
				html += '				</div>';
				html += '				<article>';
				for (var a = 0; a < o.find('project file').length ; a++ ) {
					html += '					<img src="'+o.find('project file').eq(a).text()+'" alt="'+o.find('project name').text()+'">';
				}
				html += '					<p>'+o.find('project content').text()+'</p>';
				html += '				</article>';
				return html;
			}

			function view_button_setting() {
				if (workViewSeq == 1) {
					btnViewPrev.fadeOut(300);
					btnViewNext.fadeIn(300);
				} else if (workViewSeq == workCount) {
					btnViewPrev.fadeIn(300);
					btnViewNext.fadeOut(300);
				} else {
					btnViewPrev.fadeIn(300);
					btnViewNext.fadeIn(300);
				}
			}

			init();
		}
	});

/* ----------------------------------------------------------------------------------------- */
})(jQuery);


/* ---------------------------------------------------------------------- */
Array.prototype.min = function() {
	var t = 99999;
	for (var i = 0; i < this.length; i++ ) {
		if (t > parseFloat(this[i])) t = parseFloat(this[i]);
	}
	return t;
}

Array.prototype.max = function() {
	var t = 0;
	for (var i = 0; i < this.length; i++ ) {
		if (t < parseFloat(this[i])) t = parseFloat(this[i]);
	}
	return t;
}

Array.prototype.indexOf = function(s) {
	for (var i = 0; i < this.length; i++ ) {
		if (this[i] == s) return i;
	}
}