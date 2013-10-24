<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<?
db_connect();

$totalWorktime = 0;

if (($_GET['d'] == undefined) || ($_GET['d'] == "")) {
	$sd = $_GET['y']."-".$_GET['m']."-01";
	$ed = $_GET['y']."-".$_GET['m']."-31";
} else {
	$sd = $_GET['d'];
	$ed = $_GET['d'];
}

if (($_GET['p'] == undefined) || ($_GET['p'] == "") || ($_GET['p'] == 0)) {
	$sql_p = "";
} else {
	$sql_p = "AND w.pid = ".$_GET['p'];
}

if (($_GET['w'] == undefined) || ($_GET['w'] == "") || ($_GET['w'] == 0)) {
	$sql_w = "";	
} else {
	$sql_w = "AND w.wid = ".$_GET['w'];
}

if (($_GET['t'] == undefined) || ($_GET['t'] == "") || ($_GET['t'] == 0)) {
	$sql_t = "";	
} else {
	$sql_t = "AND w.tid = ".$_GET['t'];
}

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
	FROM ".$prefix."work_data AS w
	INNER JOIN ".$prefix."project_info AS p ON w.pid = p.pid
	INNER JOIN ".$prefix."worker_info AS wk ON w.wid = wk.wid
	INNER JOIN ".$prefix."type_info AS t ON w.tid = t.tid
	WHERE
		w.gid = ".$_GROUP." AND
		w.date BETWEEN '".$sd."' and '".$ed."'
		".$sql_p."
		".$sql_w."
		".$sql_t."
	ORDER BY
		w.date DESC , w.pid
";

$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

?>

			<!-- <pre style="font-size:11px;"><?=print_r($_GET)?></pre>  -->

			<table class="workList" cellpadding="0" cellspacing="0" border="0">
				<colgroup>
					<col class="date" />
					<col class="week" />
					<col class="project" />
					<col class="subject" />
					<col class="button" />
					<col class="worker" />
					<col class="worktime" />
					<col class="type" />
				</colgroup>
				<thead>
					<tr>
						<th scope="col">��¥</th>
						<th scope="col">����</th>
						<th scope="col">������Ʈ</th>
						<th scope="col" class="r">�۾���</th>
						<th scope="col">&nbsp;</th>
						<th scope="col">�۾���</th>
						<th scope="col">�۾��ð�</th>
						<th scope="col" class="r">����</th>
					</tr>
				</thead>
				<tbody>
<?
for ($i = 0; $i < $total; $i++) {
	$workList = mysql_fetch_array($result);
	$totalWorktime += $workList['worktime'];
?>
					<tr workId="<?=$workList['id']?>">
						<td class="date"><?=$workList['date']?></td>
						<td class="week"><?=week_kr($workList['week'])?></td>
						<td class="project ellipsis"><?=$workList['project']?></td>
						<td class="subject ellipsis"><?=$workList['work']?></td>
						<td class="button"><div class="icoSet"><a class="icoMod" href="#"><span class="none">����</span></a><a class="icoDel" href="#"><span class="none">����</span></a></div></td>
						<td class="worker"><?=$workList['worker']?></td>
						<td class="worktime"><?=$workList['worktime']?></td>
						<td class="type"><?=$workList['type']?></td>
					</tr>
<?
}
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


<?
if ($total == 0) {
?>
			<script type="text/javascript">
				displayMessage("<strong>�˻����</strong> <em>0</em> �� <span class='bar'>|</span> ����� �����ϴ�.");
			</script>
<?
} else {
	$message = "�˻���� <strong>".$total."</strong>�� <span class='bar'>|</span> ";
?>
			<script type="text/javascript">
				if (_ProjectName != "��ü") { msgP = "'"+_ProjectName+"'"; } else { msgP = ""; }
				if (_WorkerName != "��ü") { msgW = "'"+_WorkerName+"'"; } else { msgW = ""; }
				if (_TypeName != "��ü") { msgT = "'"+_TypeName+"'"; } else { msgT = ""; }
				//if (!(_Date == undefined || _Date == "")) { msgD = "'"+_Date+"', "; } else { msgD = ""; }

				if (msgP != "" && (msgW != "" || msgT != "")) { msgP += ", "; }
				if (msgW != "" && msgT != "") { msgW += ", "; }
				if (msgP == "" && msgW == "" && msgT == "") { msgE = "��ü"; } else { msgE = ""; }

				//displayMessage("<strong>�˻����</strong> <em><?=$total?></em> ��<span class='bar'>|</span><strong>�۾��ð�</strong> <em><?=$totalWorktime?></em> �ð� (<em><?=round($totalWorktime/8/22.1,2)?></em> M/M)<span class='bar'>|</span><em>"+msgD+msgP+msgW+msgT+"</em>"+msgE+" ����Դϴ�.");
				displayMessage("<strong>�˻����</strong> <em><?=$total?></em> ��<span class='bar'>|</span><strong>�۾��ð�</strong> <em><?=$totalWorktime?></em> �ð� (<em><?=round($totalWorktime/8/22.1,2)?></em> M/M)<span class='bar'>|</span><em>"+msgP+msgW+msgT+"</em>"+msgE+" ����Դϴ�.");
			</script>
<?
}
?>