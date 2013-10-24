<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

if ($_POST['g']) { $_GROUP = $_POST['g']; }

$sql = "
	INSERT INTO ".$prefix."work_data
		(gid, date, pid, wid, tid, worktime, work) VALUES
		(".$_GROUP.", '".$_POST['d']."', ".$_POST['p'].", ".$_POST['wk'].", ".$_POST['t'].", ".$_POST['wt'].", '".iconv("UTF-8","EUC-KR",$_POST['w'])."')
";
$result = mysql_query($sql, $connect);
if (!$result) {
    //die('Invalid query: ' . mysql_error());
	echo $sql;
	//echo "ERROR";
} else {
	echo "COMPLETE";
}

?>