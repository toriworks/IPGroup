<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

if ($_POST['act'] == 'project') {
	$sql = "
		INSERT INTO ".$prefix."relation_gp
			(gid, pid) VALUES
			(".$_POST['gid'].", ".$_POST['pid'].")
	";
} else if ($_POST['act'] == 'worker') {
	$sql = "
		INSERT INTO ".$prefix."relation_gw
			(gid, wid) VALUES
			(".$_POST['gid'].", ".$_POST['wid'].")
	";
} else if ($_POST['act'] == 'type') {
	$sql = "
		INSERT INTO ".$prefix."relation_gt
			(gid, tid) VALUES
			(".$_POST['gid'].", ".$_POST['tid'].")
	";
}
$result = mysql_query($sql, $connect);
if (!$result) {
    //die('Invalid query: ' . mysql_error());
	echo $sql;
	//echo "ERROR";
} else {
	echo "COMPLETE";
}

?>