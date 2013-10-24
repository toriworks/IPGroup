<?PHP
include $DOCUMENT_ROOT."/worklist/lib.php";
db_connect();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="euc-kr">
<title>nWagon demo</title>
<style>
*{margin:0;padding:0;}
div{padding:20px; overflow: hidden; height: auto}
a{display:block;margin:10px 0;}
hgroup{padding:20px;background-color:#e9e9e9;}
hgroup h1{font-family:Tahoma;}
hgroup p{margin:10px 0;font-size:10px}
h2{margin:0;padding:20px;border:1px solid #000;background-color:#f9f9f9;border-width:1px 0;font-family:Tahoma;}
</style>
</head>
<body>

<link rel="stylesheet" href="nWagon.css" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="nWagon.js"></script>

<hgroup>
	<h1>nWagon chart library demo</h1>
	<p>Developed by Insook Choe, Hansol Kim</p>
</hgroup>

<?
/* --------------------------- 작업자 정보 쿼리 ----------------------- */
$worker = Array();

$sql = "SELECT * FROM wl_worker_info WHERE active = 1 ORDER BY wid";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

for ($i = 0; $i < $total; $i++) {
	$worker_data = mysql_fetch_array($result);
	$worker[$worker_data[wid]] = $worker_data[name];
}
/* --------------------------- //작업자 정보 쿼리 ----------------------- */

$month_data = Array();
$time_data = Array();

$sql = "SELECT substr(date,1,7) as month, sum(worktime) as time FROM wl_work_data WHERE gid = 1 AND pid = 23 AND date BETWEEN '2013-01-01' AND '2013-12-31' GROUP BY month";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

for ($i = 0; $i < $total; $i++) {
	$work_data = mysql_fetch_array($result);
	array_push($month_data, "'".$work_data['month']."'");
	array_push($time_data, $work_data['time']);
}

function get_increment($n) {
	if ($n > 10000) return 10000;
	else if ($n > 1000) return 1000;
	else if ($n > 100) return 100;
	else if ($n > 10) return 10;
}
?>
<pre>
	<?=print_r($month_data)?>
</pre>
<h2>Test chart</h2>
<div id="chart7"></div>
<script>
	var options = {
		'legend':{
			names: [<?=implode(",",$month_data)?>],
			hrefs: ['http://nuli.nhncorp.com/blog/1132444',
					'http://nuli.nhncorp.com/blog/1132442',
					'http://nuli.nhncorp.com/blog/1132439',
					'http://nuli.nhncorp.com/blog/1132426',
					'http://nuli.nhncorp.com/blog/1115205',
					'http://nuli.nhncorp.com/blog/1111811',
					'http://nuli.nhncorp.com/blog/1111181',
					'http://nuli.nhncorp.com/blog/1096163',
					'http://nuli.nhncorp.com/blog/1079940']
				},
		'dataset':{
			title:'Playing time per day', 
			values: [<?=implode(",",$time_data)?>],
			colorset: ['#DC143C','#FF8C00', "#30a1ce"]
			},
		'chartDiv' : 'chart7',
		'chartType' : 'column',
		'chartSize' : {width:900, height:500},
		'maxValue' : <?=max($time_data)?>,
		'increment' : <?=get_increment(max($time_data))?>
	};

	nWagon.chart(options);
</script>




<h2>Column chart</h2>

<div id="chart6"></div>
<script>

	var options = {
		'legend':{
			names: ['EunJeong', 'HanSol', 'InSook', 'Eom', 'Pearl', 'SeungMin', 'TJ', 'Taegyu', 'YongYong'],
			hrefs: ['http://nuli.nhncorp.com/blog/1132444',
					'http://nuli.nhncorp.com/blog/1132442',
					'http://nuli.nhncorp.com/blog/1132439',
					'http://nuli.nhncorp.com/blog/1132426',
					'http://nuli.nhncorp.com/blog/1115205',
					'http://nuli.nhncorp.com/blog/1111811',
					'http://nuli.nhncorp.com/blog/1111181',
					'http://nuli.nhncorp.com/blog/1096163',
					'http://nuli.nhncorp.com/blog/1079940']
				},
		'dataset':{
			title:'Playing time per day', 
			values: [[5,7,2], [2,5,7], [7,2,3], [6,1,5], [5,3,8], [8,3,1], [6,3,9], [6,2,6], [8,2,4]],
			colorset: ['#DC143C','#FF8C00', "#30a1ce"],
			fields:['Working Time', 'Late count', 'Mail count']
			},
		'chartDiv' : 'chart6',
		'chartType' : 'multi_column',
		'chartSize' : {width:700, height:300},
		'maxValue' : 10,
		'increment' : 1
	};

	nWagon.chart(options);

</script>

<div id="chart5"></div>
<script>
	
	var options = {
		'legend': {
			names: ['EunJeong', 'HanSol', 'InSook', 'Eom', 'Pearl', 'SeungMin', 'TJ', 'Taegyu', 'YongYong'],
			hrefs: ['http://nuli.nhncorp.com/blog/1132444',
					'http://nuli.nhncorp.com/blog/1132442',
					'http://nuli.nhncorp.com/blog/1132439',
					'http://nuli.nhncorp.com/blog/1132426',
					'http://nuli.nhncorp.com/blog/1115205',
					'http://nuli.nhncorp.com/blog/1111811',
					'http://nuli.nhncorp.com/blog/1111181',
					'http://nuli.nhncorp.com/blog/1096163',
					'http://nuli.nhncorp.com/blog/1079940']
				},
		'dataset': {
			title: 'Playing time per day', 
			values: [[5,7,2], [2,5,7], [7,2,3], [6,1,5], [5,3,8], [8,3,1], [6,3,9], [6,2,6], [8,2,4]],
			colorset: ['#DC143C', '#FF8C00', "#30a1ce"],
			fields: ['Working Time', 'Late count', 'Mail count']
			},
		'chartDiv': 'chart5',
		'chartType': 'stacked_column',
		'chartSize': {width:700, height:300},
		'maxValue': 20,
		'increment': 2
	};

	nWagon.chart(options);

</script>

<div id="chart4"></div>
<script>

	var options = {
		'legend': {
			names: ['EunJeong', 'HanSol', 'InSook', 'Eom', 'Pearl', 'SeungMin', 'TJ', 'Taegyu', 'YongYong'],
			hrefs: ['http://nuli.nhncorp.com/blog/1132444',
					'http://nuli.nhncorp.com/blog/1132442',
					'http://nuli.nhncorp.com/blog/1132439',
					'http://nuli.nhncorp.com/blog/1132426',
					'http://nuli.nhncorp.com/blog/1115205',
					'http://nuli.nhncorp.com/blog/1111811',
					'http://nuli.nhncorp.com/blog/1111181',
					'http://nuli.nhncorp.com/blog/1096163',
					'http://nuli.nhncorp.com/blog/1079940']
				},
		'dataset': {
			title: 'Playing time per day', 
			values: [5,7,2,4,6,3,5,2,10],
			colorset: ['#DC143C', '#FF8C00', "#30a1ce"]
			},
		'chartDiv': 'chart4',
		'chartType': 'column',
		'chartSize': {width:700, height:300},
		'maxValue': 10,
		'increment': 1
	};

	nWagon.chart(options);

</script>

<h2>Spider chart</h2>

<div id="chart3"></div>
<script>

	var options = {
		'legend':{
			names: ['Perceivable', 'Information Loss', 'Understandable', 'Enough Time', 'Epilepsy Prevent', 'Operable', 'Navigation', 'Error Prevent'],
			hrefs: ['http://nuli.nhncorp.com/accessibility#k1',
					'http://nuli.nhncorp.com/accessibility#k2',
					'http://nuli.nhncorp.com/accessibility#k3',
					'http://nuli.nhncorp.com/accessibility#k4',
					'http://nuli.nhncorp.com/accessibility#k5',
					'http://nuli.nhncorp.com/accessibility#k6',
					'http://nuli.nhncorp.com/accessibility#k7',
					'http://nuli.nhncorp.com/accessibility#k8']
				},
		'dataset': {
			title: 'Web accessibility status',
			values: [[34,53,67,23,78,45,69,98], [65,34,67,85,89,67,95]],
			bgColor: '#f9f9f9',
			fgColor: '#30a1ce',
		},
		'chartDiv': 'chart3',
		'chartType': 'radar',
		'chartSize': {width:500, height:300}
	};

	nWagon.chart(options);

</script>

<div id="chart2"></div>
<script>

	var options = {
		'legend':{
			names: ['Perceivable', 'Information Loss', 'Understandable', 'Enough Time', 'Epilepsy Prevent', 'Operable', 'Navigation', 'Error Prevent'],
			hrefs: ['http://nuli.nhncorp.com/accessibility#k1',
					'http://nuli.nhncorp.com/accessibility#k2',
					'http://nuli.nhncorp.com/accessibility#k3',
					'http://nuli.nhncorp.com/accessibility#k4',
					'http://nuli.nhncorp.com/accessibility#k5',
					'http://nuli.nhncorp.com/accessibility#k6',
					'http://nuli.nhncorp.com/accessibility#k7',
					'http://nuli.nhncorp.com/accessibility#k8']
				},
		'dataset': {
			title: 'Web accessibility status',
			values: [[34,53,67,23,'N/A',45,69,98]], 
			bgColor: '#f9f9f9',
			fgColor: '#30a1ce',
		},
		'chartDiv': 'chart2',
		'chartType': 'radar',
		'chartSize': {width:500, height:300}
	};

	nWagon.chart(options);

</script>

<div id="chart1"></div>
<script>

	var options = {
		'legend':{
			names: ['Perceivable', 'Information Loss', 'Understandable', 'Enough Time'],
			hrefs: ['http://nuli.nhncorp.com/accessibility#k1',
					'http://nuli.nhncorp.com/accessibility#k2',
					'http://nuli.nhncorp.com/accessibility#k3',
					'http://nuli.nhncorp.com/accessibility#k4']
				},
		'dataset': {
			title: 'Web accessibility status',
			values: [[34,53,67,100]], 
			bgColor: '#f9f9f9',
			fgColor: '#30a1ce',
		},
		'chartDiv': 'chart1',
		'chartType': 'radar',
		'chartSize': {width:500, height:300}
	};

	nWagon.chart(options);

</script>

<div id="chart0"></div>
<script>

	var options = {
		'legend':{
			names: ['Perceivable', 'Information Loss', 'Understandable', 'Enough Time', 'Epilepsy Prevent', 'Operable', 'Navigation', 'Error Prevent'],
			hrefs: ['http://nuli.nhncorp.com/accessibility#k1',
					'http://nuli.nhncorp.com/accessibility#k2',
					'http://nuli.nhncorp.com/accessibility#k3',
					'http://nuli.nhncorp.com/accessibility#k4',
					'http://nuli.nhncorp.com/accessibility#k5',
					'http://nuli.nhncorp.com/accessibility#k6',
					'http://nuli.nhncorp.com/accessibility#k7',
					'http://nuli.nhncorp.com/accessibility#k8']
				},
		'dataset': {
			title: 'Web accessibility status',
			values: [[34,53,67,23,78,45,69,98]], 
			bgColor: '#f9f9f9',
			fgColor: '#30a1ce',
		},
		'chartDiv': 'chart0',
		'chartType': 'radar',
		'chartSize': {width:500, height:300}
	};

	nWagon.chart(options);

</script>



</body>
</html>
