<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<?
db_connect();

$sql = "
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
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

?>
					<h2>유형</h2>
 					<ul>
						<li class="on"><a href="#0">전체</a></li>
<?
for ($i = 0; $i < $total; $i++) {
	$typeList = mysql_fetch_array($result);
?>
						<li class="off"><a href="#<?=$typeList['tid']?>"><?=$typeList['name']?></a></li>
<?
}
if ($total == 0) {
?>

<?
}
?>
 					</ul>
					<div class="clear"></div>