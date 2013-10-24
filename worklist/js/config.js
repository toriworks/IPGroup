$(document).ready(function(){
	$('#configButton a').click(function(){
		$('#Config').animate({
			opacity : 1,
			height : 'toggle'
		}, 500, function() {});
		return false;
	});

	/* 관리 탭 */
	$('#configTab li a').bind('click',function(){
		$('#configTab li').removeClass('on');
		$(this).parent().addClass('on');
		var mode = $(this).attr('href');
		switch (mode)
		{
		case '#Group' :
			displayGroupConfigFunc();
			break;
		case '#Project' :
			displayProjectConfigFunc();
			break;
		case '#Worker' :
			displayWorkerConfigFunc();
			break;
		case '#Type' :
			displayTypeConfigFunc();
			break;
		}
		return false;
	});
});

function setSortSelect(m) {
	$(".sortable").sortable({ axis: 'y' , cancel: 'span' });
	$(".sortable").selectable({ 
		tolerance : "fit",
		selected : function(e,ui) {
			//console.log('selected');
			eval('selected'+m+'Func(e,ui)');
		},
		selecting :function() {
			//console.log('selecting');
		},
		unselected :function() {
			//console.log('unselected');
			$('.right').fadeOut('fast');
		},
		unselecting :function() {
			//console.log('unselecting');
		}
	});
	$(".sortOn").bind('click',function(){
		$(".sortable").sortable({ disabled : false });
	});
	$(".sortOff").bind('click',function(){
		$(".sortable").sortable({ disabled : true });
	});
}

/************************************************************************
 *  Display Functions
 */

function displayGroupConfigFunc() {
	var param = "";
	$('#configBox').load('/worklist/html/groupConfig.php',param,function(){
		setSortSelect('Group');
		setGroupConfigFunc();
	});
}

function displayProjectConfigFunc() {
	var param = "";
	$('#configBox').load('/worklist/html/projectConfig.php',param,function(){
		setSortSelect('Project');
		setProjectConfigFunc();
	});
}

function displayWorkerConfigFunc() {
	var param = "";
	$('#configBox').load('/worklist/html/workerConfig.php',param,function(){
		setSortSelect('Worker');
		setWorkerConfigFunc();
	});
}

function displayTypeConfigFunc() {
	var param = "";
	$('#configBox').load('/worklist/html/typeConfig.php',param,function(){
		setSortSelect('Type');
		setTypeConfigFunc();
	});
}

/************************************************************************
 *  Event Functions
 */

function setGroupConfigFunc() {
	$('.itemAdd input[type="button"]').bind('click',function(){
		var addType = $('.itemAdd input[type="text"]').val();
		if (addType == "") { return false; }
		$.ajax({
			type: 'POST',
			url: 'php/groupInsert.php',
			data: 'name='+addType,
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayGroupConfigFunc();
					displayConfigMessage('그룹이 추가되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;
	});

	$('.nameModify input[type="button"]').bind('click',function(){
		var name = $('.nameModify input[type="text"]').val();
		var gid  = $('input[name="gid"]').val();
		if (name == "") { return false; }
		$.ajax({
			type: 'POST',
			url: 'php/groupUpdate.php',
			data: 'act=name&gid='+gid+'&name='+name,
			success: function(msg){
				if (msg == 'COMPLETE') {
					$('#groupItemList .ui-selected span').text(name);
					$('input[name="name"]').val(name)
					displayConfigMessage('그룹이 변경되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;
	});

	$('.itemDel a').bind('click',function(){
		if (!confirm('[' + $('input[name="name"]').val() + '] 그룹을 삭제 하시겠습니까?')) {
			return false;
		}
		var gid = $('input[name="gid"]').val();
		$.ajax({
			type: 'POST',
			url: 'php/groupDelete.php',
			data: 'gid='+gid,
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayConfigMessage('[' + $('input[name="name"]').val() + '] 그룹이 삭제되었습니다.');
					$('.right').fadeOut('fast');
					$('li[gid="'+gid+'"').remove();
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;		
	});

	$('#projectRelation li input[type="checkbox"]').bind('change',function(){
		var gid = $('input[name="gid"]').val();
		var act = "project";
		if ($(this).attr('checked')) {
			var mode = "Insert";
			var completeMsg = $(this).find('+label').text() + " 프로젝트가 선택되었습니다.";
		} else {
			var mode = "Delete";
			var completeMsg = $(this).find('+label').text() + " 프로젝트가 해제되었습니다.";
		}
		$.ajax({
			type: 'POST',
			url: 'php/relation'+mode+'.php',
			data: 'act='+act+'&gid='+gid+'&pid='+$(this).attr('pid'),
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayConfigMessage(completeMsg);
				} else {
					displayConfigMessage(msg);
				}
				updateRelationValues();
			}
		});
	});

	$('#workerRelation li input[type="checkbox"]').bind('change',function(){
		var gid = $('input[name="gid"]').val();
		var act = "worker";
		if ($(this).attr('checked')) {
			var mode = "Insert";
			var completeMsg = $(this).find('+label').text() + " 작업자가 선택되었습니다.";
		} else {
			var mode = "Delete";
			var completeMsg = $(this).find('+label').text() + " 작업자가 해제되었습니다.";
		}
		$.ajax({
			type: 'POST',
			url: 'php/relation'+mode+'.php',
			data: 'act='+act+'&gid='+gid+'&wid='+$(this).attr('wid'),
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayConfigMessage(completeMsg);
				} else {
					displayConfigMessage(msg);
				}
				updateRelationValues();
			}
		});
	});

	$('#typeRelation li input[type="checkbox"]').bind('change',function(){
		var gid = $('input[name="gid"]').val();
		var act = "type";
		if ($(this).attr('checked')) {
			var mode = "Insert";
			var completeMsg = $(this).find('+label').text() + " 유형이 선택되었습니다.";
		} else {
			var mode = "Delete";
			var completeMsg = $(this).find('+label').text() + " 유형이 해제되었습니다.";
		}
		$.ajax({
			type: 'POST',
			url: 'php/relation'+mode+'.php',
			data: 'act='+act+'&gid='+gid+'&tid='+$(this).attr('tid'),
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayConfigMessage(completeMsg);
				} else {
					displayConfigMessage(msg);
				}
				updateRelationValues();
			}
		});
	});
}

function setProjectConfigFunc() {
	$('.itemAdd input[type="button"]').bind('click',function(){
		var addType = $('.itemAdd input[type="text"]').val();
		if (addType == "") { return false; }
		$.ajax({
			type: 'POST',
			url: 'php/projectInsert.php',
			data: 'name='+addType,
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayProjectConfigFunc();
					displayConfigMessage('프로젝트가 추가되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;
	});

	$('.nameModify input[type="button"]').bind('click',function(){
		var name = $('.nameModify input[type="text"]').val();
		var pid  = $('input[name="pid"]').val();
		if (name == "") { return false; }
		$.ajax({
			type: 'POST',
			url: 'php/projectUpdate.php',
			data: 'act=name&pid='+pid+'&name='+name,
			success: function(msg){
				if (msg == 'COMPLETE') {
					$('#projectItemList .ui-selected span').text(name);
					$('input[name="name"]').val(name)
					displayConfigMessage('프로젝트 이름이 변경되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;
	});

	$('.activeCheck input[type="checkbox"]').bind('change',function(){
		if ($(this).attr('checked')) {
			var active = "1";
		} else {
			var active = "0";
		}
		var pid  = $('input[name="pid"]').val();

		$.ajax({
			type: 'POST',
			url: 'php/projectUpdate.php',
			data: 'act=active&pid='+pid+'&active='+active,
			success: function(msg){
				if (msg == 'COMPLETE') {
					$('#projectItemList .ui-selected').attr('active',active);
					displayConfigMessage('사용유무가 변경되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});

		return false;
	});

	$('.itemDel a').bind('click',function(){
		if (!confirm('[' + $('input[name="name"]').val() + '] 프로젝트를 삭제 하시겠습니까?')) {
			return false;
		}
		var pid = $('input[name="pid"]').val();
		$.ajax({
			type: 'POST',
			url: 'php/projectDelete.php',
			data: 'pid='+pid,
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayConfigMessage('[' + $('input[name="name"]').val() + '] 프로젝트가 삭제되었습니다.');
					$('.right').fadeOut('fast');
					$('li[pid="'+pid+'"').remove();
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;		
	});
}

function setWorkerConfigFunc() {
	$('.itemAdd input[type="button"]').bind('click',function(){
		var addType = $('.itemAdd input[type="text"]').val();
		if (addType == "") { return false; }
		$.ajax({
			type: 'POST',
			url: 'php/workerInsert.php',
			data: 'name='+addType,
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayWorkerConfigFunc();
					displayConfigMessage('작업자가 추가되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;
	});

	$('.nameModify input[type="button"]').bind('click',function(){
		var name = $('.nameModify input[type="text"]').val();
		var wid  = $('input[name="wid"]').val();
		if (name == "") { return false; }
		$.ajax({
			type: 'POST',
			url: 'php/workerUpdate.php',
			data: 'act=name&wid='+wid+'&name='+name,
			success: function(msg){
				if (msg == 'COMPLETE') {
					$('#workerItemList .ui-selected span').text(name);
					$('input[name="name"]').val(name)
					displayConfigMessage('작업자 이름이 변경되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;
	});

	$('.activeCheck input[type="checkbox"]').bind('change',function(){
		if ($(this).attr('checked')) {
			var active = "1";
		} else {
			var active = "0";
		}
		var wid  = $('input[name="wid"]').val();

		$.ajax({
			type: 'POST',
			url: 'php/workerUpdate.php',
			data: 'act=active&wid='+wid+'&active='+active,
			success: function(msg){
				if (msg == 'COMPLETE') {
					$('#workerItemList .ui-selected').attr('active',active);
					displayConfigMessage('사용유무가 변경되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});

		return false;
	});

	$('.itemDel a').bind('click',function(){
		if (!confirm('[' + $('input[name="name"]').val() + '] 작업자를 삭제 하시겠습니까?')) {
			return false;
		}
		var wid = $('input[name="wid"]').val();
		$.ajax({
			type: 'POST',
			url: 'php/workerDelete.php',
			data: 'wid='+wid,
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayConfigMessage('[' + $('input[name="name"]').val() + '] 작업자가 삭제되었습니다.');
					$('.right').fadeOut('fast');
					$('li[wid="'+wid+'"').remove();
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;		
	});
}

function setTypeConfigFunc() {
	$('.itemAdd input[type="button"]').bind('click',function(){
		var addType = $('.itemAdd input[type="text"]').val();
		if (addType == "") { return false; }
		$.ajax({
			type: 'POST',
			url: 'php/typeInsert.php',
			data: 'name='+addType,
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayTypeConfigFunc();
					displayConfigMessage('유형이 추가되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;
	});

	$('.nameModify input[type="button"]').bind('click',function(){
		var name = $('.nameModify input[type="text"]').val();
		var tid  = $('input[name="tid"]').val();
		if (name == "") { return false; }
		$.ajax({
			type: 'POST',
			url: 'php/typeUpdate.php',
			data: 'act=name&tid='+tid+'&name='+name,
			success: function(msg){
				if (msg == 'COMPLETE') {
					$('#typeItemList .ui-selected span').text(name);
					$('input[name="name"]').val(name)
					displayConfigMessage('유형이 변경되었습니다.');
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;
	});

	$('.itemDel a').bind('click',function(){
		if (!confirm('[' + $('input[name="name"]').val() + '] 유형을 삭제 하시겠습니까?')) {
			return false;
		}
		var tid = $('input[name="tid"]').val();
		$.ajax({
			type: 'POST',
			url: 'php/typeDelete.php',
			data: 'tid='+tid,
			success: function(msg){
				if (msg == 'COMPLETE') {
					displayConfigMessage('[' + $('input[name="name"]').val() + ']유형이 삭제되었습니다.');
					$('.right').fadeOut('fast');
					$('li[tid="'+tid+'"').remove();
				} else {
					displayConfigMessage(msg);
				}
			}
		});
		return false;		
	});
}






function selectedGroupFunc(e,ui) {
	$('.right').fadeTo(10, 0.1, function(){
		$('input[name="gid"]').val($(ui.selected).attr('gid'));
		$('input[name="name"]').val($(ui.selected).find('span').text());
		$('input[name="rp"]').val($(ui.selected).attr('rp'));
		$('input[name="rw"]').val($(ui.selected).attr('rw'));
		$('input[name="rt"]').val($(ui.selected).attr('rt'));
		$('.nameModify .text').val($('input[name="name"]').val());
		$('#projectRelation input[type="checkbox"]').each(function(idx){
			if ($.inArray($(this).attr('pid'), $('input[name="rp"]').val().split(',')) > -1) {
				$(this).attr('checked','checked');
			} else {
				$(this).attr('checked','');
			}
		});
		$('#workerRelation input[type="checkbox"]').each(function(idx){
			if ($.inArray($(this).attr('wid'), $('input[name="rw"]').val().split(',')) > -1) {
				$(this).attr('checked','checked');
			} else {
				$(this).attr('checked','');
			}
		});
		$('#typeRelation input[type="checkbox"]').each(function(idx){
			if ($.inArray($(this).attr('tid'), $('input[name="rt"]').val().split(',')) > -1) {
				$(this).attr('checked','checked');
			} else {
				$(this).attr('checked','');
			}
		});
		relationCheckboxColor();

		$('.right').fadeTo('fast', 1);
	});
}

function selectedProjectFunc(e,ui) {
	$('.right').fadeTo(10, 0.1, function(){
		$('input[name="pid"]').val($(ui.selected).attr('pid'));
		$('input[name="name"]').val($(ui.selected).find('span').text());
		$('.nameModify .text').val($('input[name="name"]').val());
		if ($(ui.selected).attr('active') == 1) {
			$('.activeCheck .checkbox').attr('checked',true);
		} else {
			$('.activeCheck .checkbox').attr('checked',false);
		}
		$('.right').fadeTo('fast', 1);
	});
}

function selectedWorkerFunc(e,ui) {
	$('.right').fadeTo(10, 0.1, function(){
		$('input[name="wid"]').val($(ui.selected).attr('wid'));
		$('input[name="name"]').val($(ui.selected).find('span').text());
		$('.nameModify .text').val($('input[name="name"]').val());
		if ($(ui.selected).attr('active') == 1) {
			$('.activeCheck .checkbox').attr('checked',true);
		} else {
			$('.activeCheck .checkbox').attr('checked',false);
		}
		$('.right').fadeTo('fast', 1);
	});
}

function selectedTypeFunc(e,ui) {
	$('.right').fadeTo(10, 0.1, function(){
		$('input[name="tid"]').val($(ui.selected).attr('tid'));
		$('input[name="name"]').val($(ui.selected).find('span').text());
		$('.nameModify .text').val($('input[name="name"]').val());
		$('.right').fadeTo('fast', 1);
	});
}










function displayConfigMessage(s) {
	$('#configMessage').text(s);
	$('#configMessage').fadeIn('slow').delay(1000).fadeOut('slow');
}



function updateRelationValues() {
	var pids = "";
	var wids = "";
	var tids = "";

	$('#projectRelation li input:checked').each(function(idx){
		pids += ","+$(this).attr('pid');
	});
	$('#workerRelation li input:checked').each(function(idx){
		wids += ","+$(this).attr('wid');
	});
	$('#typeRelation li input:checked').each(function(idx){
		tids += ","+$(this).attr('tid');
	});

	pids = pids.substr(1);
	wids = wids.substr(1);
	tids = tids.substr(1);

	$('input[name="rp"]').val(pids);
	$('input[name="rw"]').val(wids);
	$('input[name="rt"]').val(tids);

	$('#groupItemList .ui-selected').attr('rp',pids);
	$('#groupItemList .ui-selected').attr('rw',wids);
	$('#groupItemList .ui-selected').attr('rt',tids);

	relationCheckboxColor();
}

function relationCheckboxColor() {
	$('input[type="checkbox"]').each(function(idx){
		if ($(this).attr('checked')) {
			$(this).find('+label').css('color','#82F14B');
		} else {
			$(this).find('+label').css('color','#ffffff');
		}
	});
}