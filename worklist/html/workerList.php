<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<?
db_connect();

$sql = "
	SELECT
		w.wid,
		w.name,
		w.active
	FROM 
		".$prefix."worker_info AS w
			INNER JOIN 
		".$prefix."relation_gw as r
	WHERE
		w.wid = r.wid
			AND
		r.gid = ".$_GROUP."
	ORDER BY
		w.seq
";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

?>
					<h2>작업자</h2>
 					<ul>
						<li class="on"><a href="#0">전체</a></li>
<?
for ($i = 0; $i < $total; $i++) {
	$workerList = mysql_fetch_array($result);
	if ($workerList['active'] == 1) {
		$activeClass = " active";
	} else {
		$activeClass = " inactive";
	}
?>
						<li class="off<?=$activeClass?>"><a href="#<?=$workerList['wid']?>"><?=$workerList['name']?></a></li>
<?
}
if ($total == 0) {
?>

<?
}
?>
 					</ul>
					<div class="clear"></div>
