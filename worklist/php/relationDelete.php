<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

if ($_POST['act'] == 'project') {
	$sql = "
		DELETE FROM ".$prefix."relation_gp WHERE gid=".$_POST['gid']." AND pid=".$_POST['pid']."
	";
}
if ($_POST['act'] == 'worker') {
	$sql = "
		DELETE FROM ".$prefix."relation_gw WHERE gid=".$_POST['gid']." AND wid=".$_POST['wid']."
	";
}
if ($_POST['act'] == 'type') {
	$sql = "
		DELETE FROM ".$prefix."relation_gt WHERE gid=".$_POST['gid']." AND tid=".$_POST['tid']."
	";
}
$result = mysql_query($sql, $connect);
if (!$result) {
    //die('Invalid query: ' . mysql_error());
	//echo $sql;
	echo "ERROR";
} else {
	echo "COMPLETE";
}

?>