<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<?
db_connect();

$sql = "
	SELECT
		p.pid,
		p.name,
		p.active
	FROM ".$prefix."project_info AS p
	ORDER BY
		p.seq
";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

?>
			<div class="left">
				<div class="section">
					<h3>프로젝트 목록</h3>
					<ul id="projectItemList" class="itemList sortable">
<?
for ($i = 0; $i < $total; $i++) {
	$projectList = mysql_fetch_array($result);
?>
						<li pid="<?=$projectList['pid']?>" active="<?=$projectList['active']?>"><span><?=$projectList['name']?></span></li>
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
				<input type="hidden" name="pid" value="" />
				<input type="hidden" name="name" value="" />
				<div class="nameModify">
					<input type="text" class="text" /><input type="button" class="button" value="프로잭트명 변경" />
				</div>
				<div class="activeCheck">
					<input type="checkbox" class="checkbox" id="activeCheckbox" />
					<label for="activeCheckbox">사용유무 체크</label>
				</div>
				<div class="itemDel"><a href="#"><img src="./img/icon_delete.png" border="0" alt="" /></a></div>
			</div>

