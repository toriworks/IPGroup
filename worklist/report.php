<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? db_connect(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>퍼블리싱팀 작업일지</title>
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="css/selectBox.css" />
	<link type="text/css" rel="stylesheet" href="css/custom-theme/jquery-ui-1.8.8.custom.css" />
	<!-- <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script> -->
	<!-- <script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script> -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/config.js"></script>
	<script type="text/javascript" src="js/selectBox.js"></script>
</head>
<body>

<?

$sql = "
	SELECT
		w.id AS id,
		w.date AS date,
		DAYOFWEEK(w.date) AS week,
		p.name AS project,
		w.work AS work,
		wk.name AS worker,
		w.worktime AS worktime,
		t.name AS type
	FROM wl_work_data AS w
	INNER JOIN wl_project_info AS p ON w.pid = p.pid
	INNER JOIN wl_worker_info AS wk ON w.wid = wk.wid
	INNER JOIN wl_type_info AS t ON w.tid = t.tid
	WHERE
		w.gid = 1 AND
		t.tid = 2 AND
		(w.pid = 2 OR w.pid = 20 OR w.pid = 3 OR w.pid = 4 OR w.pid = 21 OR w.pid = 22) AND
		w.date BETWEEN '2013-7-01' and '2013-7-31'
		
	ORDER BY
		w.date ASC , worker , project

";

$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

?>
			<style type="text/css">
				tr.bt td {border-top:2px solid #000;}
			</style>
			<table class="workList" cellpadding="0" cellspacing="0" border="0" style="width:900px;">
				<colgroup>
					<col class="date" />
					<col class="week" />
					<col class="worker" />
					<col class="project" style="width:200px;" />
					<col class="type" />					
					<col class="subject" />					
					<col class="worktime" />					
				</colgroup>
<!-- 				<thead>
					<tr>
						<th scope="col">날짜</th>
						<th scope="col">요일</th>
						<th scope="col">작업자</th>
						<th scope="col" class="r">유형</th>
						<th scope="col">프로젝트</th>
						<th scope="col" class="r">작업명</th>
						<th scope="col">작업시간</th>						
					</tr>
				</thead> -->
				<tbody>
<?
$beforeDate = '';
for ($i = 0; $i < $total; $i++) {
	$workList = mysql_fetch_array($result);
	$totalWorktime += $workList['worktime'];
	if ($beforeDate != $workList['date']) {
		$trClass = "bt";
		$beforeDate = $workList['date'];
	} else {
		$trClass = "";
	}
?>
					<tr workId="<?=$workList['id']?>" class="<?=$trClass?>">
						<td class="date"><?=$workList['date']?></td>
						<td class="week"><?=week_kr($workList['week'])?></td>
						<td class="worker"><?=$workList['worker']?></td>
						<td class="project ellipsis"><?=$workList['project']?></td>
						<td class="type"><?=$workList['type']?></td>						
						<td class="subject ellipsis"><?=$workList['work']?></td>
						<td class="worktime"><?=$workList['worktime']?></td>
					</tr>
<?
}
if ($total == 0) {
?>
					<tr>
						<td class="noData" colspan="8">목록이 없습니다.</td>
					</tr>
<?
}
?>
				</body>
			</table>





</body>
</html>
