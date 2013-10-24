<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<?
db_connect();

$sql = "
	SELECT
		p.pid,
		p.name,
		p.active
	FROM 
		".$prefix."project_info AS p
			INNER JOIN 
		".$prefix."relation_gp as r
	WHERE
		p.pid = r.pid
			AND
		r.gid = ".$_GROUP."
	ORDER BY
		p.seq
";
$result = mysql_query($sql, $connect);
$total = mysql_num_rows($result);

?>
					<h2>프로젝트</h2>
 					<ul>
						<li class="on"><a href="#0">전체</a></li>
<?
for ($i = 0; $i < $total; $i++) {
	$projectList = mysql_fetch_array($result);
	if ($projectList['active'] == 1) {
		$activeClass = " active";
	} else {
		$activeClass = " inactive";
	}
?>
						<li class="off<?=$activeClass?>"><a href="#<?=$projectList['pid']?>"><?=$projectList['name']?></a></li>
<?
}
if ($total == 0) {
?>

<?
}
?>
 					</ul>
					<div class="clear"></div>