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

<div id="Wrap">

	<div id="Header">
		<div id="groupList"></div>
		<div class="groupListBottom"></div>
		<div id="configButton"><a href="#" style="font-size:8px; color:#fff;">설정</a></div>
	</div>
	<!------------------------------------------------ 설정 영역 ---------------------------------------------------->
	<div id="Config">
		<div id="configMessage"></div>
		<div id="configTab">
			<ul>
				<li><a href="#Group">그룹</a></li>
				<li><a href="#Project">프로젝트</a></li>
				<li><a href="#Worker">작업자</a></li>
				<li><a href="#Type">유형</a></li>
			</ul>
		</div>
		<div id="configBox"></div>
	</div>
	<!------------------------------------------------ 설정 영역 ---------------------------------------------------->
	<div id="Middle">
		<div id="Left">
			<div class="searchTop"></div>

			<div class="searchBox">
				<div class="monthSet">
					<span class="prev"></span>
					<span class="setValue"></span>
					<span class="next"></span>
				</div>
				<div class="clear"></div>
			</div>

			<div class="searchBox" id="projectList"></div>

			<div class="searchBox" id="workerList"></div>

			<div class="searchBox" id="typeList"></div>

		</div>
		<div id="Container">

			<div class="topStatusBar">
				<div id="loadImg">
					<img class="icon" src="img/load.gif" alt="" />
					<span class="message"></span>
				</div>

				<fieldset class="writeContainer">
					<legend class="none">작업내역 추가</legend>
					<div class="layer_1">
						
						<input type="text" class="inputText date" name="date" value="" />

						<div id="datepicker"></div>

						<div class="select worker">
							<span class="ctrl"><span class="arrow"></span></span>
							<div class="my_value">작업자 선택</div>
							<ul class="i_list">
<?
$sql_Worker = "
	SELECT
		w.wid,
		w.name
	FROM 
		".$prefix."worker_info AS w
			INNER JOIN 
		".$prefix."relation_gw as r
	WHERE
		w.wid = r.wid
			AND
		r.gid = ".$_GROUP."
			AND
		w.active = 1
	ORDER BY
		w.seq
";
$result_Worker = mysql_query($sql_Worker, $connect);
$total_Worker = mysql_num_rows($result_Worker);
for ($i = 0; $i < $total_Worker; $i++) {
	$workerList = mysql_fetch_array($result_Worker);
?>
							<li><input name="worker" id="worker<?=$workerList['wid']?>" type="radio" value="<?=$workerList['wid']?>" class="option"><label for="worker<?=$workerList['wid']?>"><?=$workerList['name']?></label></li>
<?
}
if ($total_Worker == 0) {
?>

<?
}
?>
							</ul>
						</div>

						<div class="select type">
							<span class="ctrl"><span class="arrow"></span></span>
							<div class="my_value">유형 선택</div>
							<ul class="i_list">
<?
$sql_Type = "
	SELECT
		t.tid,
		t.name
	FROM 
		".$prefix."type_info AS t 
			INNER JOIN 
		".$prefix."relation_gt as r
	WHERE
		t.tid = r.tid
			AND
		r.gid = ".$_GROUP."
	ORDER BY
		t.seq
";
$result_Type = mysql_query($sql_Type, $connect);
$total_Type = mysql_num_rows($result_Type);
for ($i = 0; $i < $total_Type; $i++) {
	$typeList = mysql_fetch_array($result_Type);
?>
							<li><input name="type" id="type<?=$typeList['tid']?>" type="radio" value="<?=$typeList['tid']?>" class="option"><label for="type<?=$typeList['tid']?>"><?=$typeList['name']?></label></li>
<?
}
if ($total_Type == 0) {
?>

<?
}
?>
							</ul>
						</div>

						<span style="font:normal 11px dotum;color:red;">작업명에 &, %, ', " 등의 기호를 넣으면 오류가 있습니다. 수정중...</span>

					</div>
					<div class="layer_2">

						<div class="select project">
							<span class="ctrl"><span class="arrow"></span></span>
							<div class="my_value">프로젝트 선택</div>
							<ul class="i_list">
<?
$sql_Project = "
	SELECT
		p.pid,
		p.name
	FROM 
		".$prefix."project_info AS p
			INNER JOIN 
		".$prefix."relation_gp as r
	WHERE
		p.pid = r.pid
			AND
		r.gid = ".$_GROUP."
			AND
		p.active = 1
	ORDER BY
		p.seq
";
$result_Project = mysql_query($sql_Project, $connect);
$total_Project = mysql_num_rows($result_Project);
for ($i = 0; $i < $total_Project; $i++) {
	$projectList = mysql_fetch_array($result_Project);
?>
							<li><input name="project" id="project<?=$projectList['pid']?>" type="radio" value="<?=$projectList['pid']?>" class="option"><label for="project<?=$projectList['pid']?>"><?=$projectList['name']?></label></li>
<?
}
if ($total_Project == 0) {
?>

<?
}
?>
							</ul>
						</div>

						<input type="text" class="inputText subject" name="subject" value="작업명" />
						<input type="text" class="inputText worktime" name="worktime" value="작업시간" />

						<span class="writeButton">
							<a class="btnSave" href="#">저장</a>
						</span>
						<span class="modifyButton">
							<a class="btnModify" href="#">수정</a>
							<a class="btnCancel" href="#">취소</a>
						</span>

					</div>
				</fieldset>

			</div>
			
			<div id="workList"></div>

			<div id="modifyLayer"></div>

		</div>
	</div>

</div>


</body>
</html>
