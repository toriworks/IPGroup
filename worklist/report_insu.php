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
	<title>�ۺ����� �۾�����</title>
	<link type="text/css" rel="stylesheet" href="css/style.css" />
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
		w.pid = 23 AND
		w.date BETWEEN '2013-1-01' and '2013-12-31'
		
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
						<th scope="col">��¥</th>
						<th scope="col">����</th>
						<th scope="col">�۾���</th>
						<th scope="col" class="r">����</th>
						<th scope="col">������Ʈ</th>
						<th scope="col" class="r">�۾���</th>
						<th scope="col">�۾��ð�</th>						
					</tr>
				</thead> -->
				<tbody>

<?
$fp = fopen("report_insu.csv", "w");

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

	fputs ($fp, $workList['date'].','.week_kr($workList['week']).','.$workList['worker'].','.$workList['project'].','.$workList['type'].',"'.$workList['work'].'",'.$workList['worktime']."\n");
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

fclose ($fp);



if ($total == 0) {
?>
					<tr>
						<td class="noData" colspan="8">����� �����ϴ�.</td>
					</tr>
<?
}
?>
				</body>
			</table>





</body>
</html>
