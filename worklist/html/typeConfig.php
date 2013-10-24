<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<?
db_connect();

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

?>
			<div class="left">
				<div class="section">
					<h3>유형 목록</h3>
					<ul id="typeItemList" class="itemList sortable">
<?
for ($i = 0; $i < $total; $i++) {
	$typeList = mysql_fetch_array($result);
?>
						<li tid="<?=$typeList['tid']?>"><span><?=$typeList['name']?></span></li>
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
				<input type="hidden" name="tid" value="" />
				<input type="hidden" name="name" value="" />
				<div class="nameModify">
					<input type="text" class="text" /><input type="button" class="button" value="유형 변경" />
				</div>
				<div class="itemDel"><a href="#"><img src="./img/icon_delete.png" border="0" alt="" /></a></div>
			</div>