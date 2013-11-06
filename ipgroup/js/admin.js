
function set_datepicker(options) {
	var config = $.extend({
		dayNamesMin:['일','월','화','수','목','금','토'],
		dayNamesShort:['일','월','화','수','목','금','토'],
		dayNames:['일','월','화','수','목','금','토'],
		monthNames:['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dateFormat:'yy.mm.dd',
		navigationAsDateFormat:true,
		changeYear: true
	}, options);

	$(options.altField).datepicker(config);
}

function init_from_to_date() {
	set_datepicker({
		altField:'#date_from',
		maxDate:'0',
		onClose: function( selectedDate ) {
			$("#date_to").datepicker("option","minDate",selectedDate);
		}
	});
	
	set_datepicker({
		altField:'#date_to',
		minDate:'-1m',
		onClose: function( selectedDate ) {
			$("#date_from").datepicker("option","maxDate",selectedDate);
		}
	});

	if (!$('#date_from').val()) {
		$('#date_from').datepicker('setDate','-1m');
	} else {
		$('#date_from').datepicker("option","maxDate",$('#date_to').datepicker('getDate'));
	}

	if (!$('#date_to').val()) {
		$('#date_to').datepicker('setDate','0');
	} else {
		$('#date_to').datepicker("option","minDate",$('#date_from').datepicker('getDate'));
	}
}

function init_from_to_date2() {
	set_datepicker({
		altField:'#date_from',
		onClose: function( selectedDate ) {
			$("#date_to").datepicker("option","minDate",selectedDate);
		}
	});
	
	set_datepicker({
		altField:'#date_to',
		onClose: function( selectedDate ) {
			$("#date_from").datepicker("option","maxDate",selectedDate);
		}
	});

	if (!$('#date_from').val()) {
		$('#date_from').datepicker('setDate','0');
	} else {
		$('#date_from').datepicker("option","maxDate",$('#date_to').datepicker('getDate'));
	}

	if (!$('#date_to').val()) {
		$('#date_to').datepicker('setDate','0');
	} else {
		$('#date_to').datepicker("option","minDate",$('#date_from').datepicker('getDate'));
	}
}




function init_permission_setting() {
	var permission = {
		setting : [
			{	// 운영자
				work       : [true, true, true, true, true, true],
				request    : [false, false, false, false, false, false],
				recruit    : [false, false, false, false, false, false],
				jobposting : [false, false, false, false, false, false],
				company    : [true, true, true, true],
				member     : [false, false, false, false, false, false]
			},
			{	// 관리자
				work       : [true, true, true, true, true, true],
				request    : [true, true, true, true, true, true],
				recruit    : [true, true, true, true, true, true],
				jobposting : [true, true, true, true, true, true],
				company    : [true, true, true, true],
				member     : [true, true, true, true, true, true]
			}
		]
	}

	$('.member_table .ck input[type="checkbox"]').bind('click',function(){
		$('#r_setting_2').prop('checked',true);
		$('#permission_setting option:first-child').prop('selected',true);
	});

	$('#r_setting_2').bind('change',function(){
		if ($(this).prop('checked')) {
			$('#permission_setting option:first-child').prop('selected',true);
		}
	});

	$('#permission_setting').bind('change',function(){
		$('#r_setting_1').prop('checked',true);
		var v = $(this).val();
		if (v) {
			check_permission(permission.setting[v],'work');
			check_permission(permission.setting[v],'request');
			check_permission(permission.setting[v],'recruit');
			check_permission(permission.setting[v],'jobposting');
			check_permission(permission.setting[v],'company');
			check_permission(permission.setting[v],'member');
		}
	});

	function check_permission(setting, cate) {
		for (var a = 0; a < setting[cate].length ; a++ ) {
			$('#r_'+cate+'_'+a).prop('checked',setting[cate][a]);
		}
	}
}