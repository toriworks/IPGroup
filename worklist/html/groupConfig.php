<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<?
db_connect();

$sql = "
	SELECT
		g.gid,
		g.name
	FROM ".$prefix."group_info AS g
	ORDER BY
		g.seq
";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

?>
			<div class="left">
				<div class="section">
					<h3>그룹 목록</h3>
					<ul id="groupItemList" class="itemList sortable">
<?
for ($i = 0; $i < $total; $i++) {
	$groupList = mysql_fetch_array($result);

	// Relation - Project
	$rp = queryGroupRelation($groupList['gid'], "project");
	$rw = queryGroupRelation($groupList['gid'], "worker");
	$rt = queryGroupRelation($groupList['gid'], "type");
?>
						<li gid="<?=$groupList['gid']?>" rp="<?=$rp?>" rw="<?=$rw?>" rt="<?=$rt?>"><span><?=$groupList['name']?></span></li>
<?
}
if ($total == 0) {
?>

<?
}
?>
					</ul>
					<div class="itemAdd">
						<input type="text" class="text" />
						<input type="button" class="button" value="추가" />
					</div>
				</div>
			</div>
			<div class="right" style="display:none;">
				<input type="hidden" name="gid" value="" />
				<input type="hidden" name="name" value="" />
				<input type="hidden" name="rp" value="" />
				<input type="hidden" name="rw" value="" />
				<input type="hidden" name="rt" value="" />
				<div class="nameModify">
					<input type="text" class="text" /><input type="button" class="button" value="그룹명 변경" />
				</div>

				<div class="section">
					<h3>프로젝트 선택</h3>
					<ul id="projectRelation" class="itemList">
<?
$sql = "
	SELECT
		p.pid,
		p.name
	FROM ".$prefix."project_info AS p
	ORDER BY
		p.seq
";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

for ($i = 0; $i < $total; $i++) {
	$projectList = mysql_fetch_array($result);
?>

						<li><input id="pck_<?=$i?>" type="checkbox" class="checkbox" name="pid_<?=$projectList['pid']?>" pid="<?=$projectList['pid']?>" /><label for="pck_<?=$i?>"><?=$projectList['name']?></label></li>
<?
}
?>
					</ul>
				</div>
				<div class="section">
					<h3>작업자 선택</h3>
					<ul id="workerRelation" class="itemList">
<?
$sql = "
	SELECT
		w.wid,
		w.name
	FROM ".$prefix."worker_info AS w
	ORDER BY
		w.seq
";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

for ($i = 0; $i < $total; $i++) {
	$workerList = mysql_fetch_array($result);
?>
						<li><input id="wck_<?=$i?>" type="checkbox" class="checkbox" name="wid_<?=$workerList['wid']?>" wid="<?=$workerList['wid']?>" /><label for="wck_<?=$i?>"><?=$workerList['name']?></label></li>
<?
}
?>
					</ul>
				</div>
				<div class="section">
					<h3>유형 선택</h3>
					<ul id="typeRelation" class="itemList">
<?
$sql = "
	SELECT
		t.tid,
		t.name
	FROM ".$prefix."type_info AS t
	ORDER BY
		t.seq
";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

for ($i = 0; $i < $total; $i++) {
	$typeList = mysql_fetch_array($result);
?>
						<li><input id="tck_<?=$i?>" type="checkbox" class="checkbox" name="tid_<?=$typeList['tid']?>" tid="<?=$typeList['tid']?>" /><label for="tck_<?=$i?>"><?=$typeList['name']?></label></li>
<?
}
?>
					</ul>
				</div>

				<div class="itemDel"><a href="#"><img src="./img/icon_delete.png" border="0" alt="" /></a></div>
			</div>
