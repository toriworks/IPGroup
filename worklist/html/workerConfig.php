<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<?
db_connect();

$sql = "
	SELECT
		wk.wid,
		wk.name,
		wk.active
	FROM ".$prefix."worker_info AS wk
	ORDER BY
		wk.seq
";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

?>
			<div class="left">
				<div class="section">
					<h3>작업자 목록</h3>
					<ul id="workerItemList" class="itemList sortable">
<?
for ($i = 0; $i < $total; $i++) {
	$workerList = mysql_fetch_array($result);
?>
						<li wid="<?=$workerList['wid']?>" active="<?=$workerList['active']?>"><span><?=$workerList['name']?></span></li>
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
				<input type="hidden" name="wid" value="" />
				<input type="hidden" name="name" value="" />
				<div class="nameModify">
					<input type="text" class="text" /><input type="button" class="button" value="작업자 이름 변경" />
				</div>
				<div class="activeCheck">
					<input type="checkbox" class="checkbox" id="activeCheckbox" />
					<label for="activeCheckbox">사용유무 체크</label>
				</div>
				<div class="itemDel"><a href="#"><img src="./img/icon_delete.png" border="0" alt="" /></a></div>
			</div>