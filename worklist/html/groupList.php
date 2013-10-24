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
			<ul>
<?
for ($i = 0; $i < $total; $i++) {
	$groupList = mysql_fetch_array($result);
	$lic = ($groupList['gid'] == $_GROUP)?"on":"off";
?>
				<li class="<?=$lic?>"><a href="#<?=$groupList['gid']?>"><?=$groupList['name']?></a></li>
<?
}
?>
			</ul>