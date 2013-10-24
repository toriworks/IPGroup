<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

$seq = mysql_result(mysql_query("SELECT seq FROM ".$prefix."project_info WHERE pid=".$_POST['pid'], $connect),0 ,0);

$sql = "
	UPDATE ".$prefix."project_info SET
		seq = seq - 1
	WHERE
		seq > ".$seq."
";
$result = mysql_query($sql, $connect);
if (!$result) {
    //die('Invalid query: ' . mysql_error());
	//echo $sql;
	echo "ERROR";
} else {

	$sql = "
		DELETE FROM ".$prefix."project_info WHERE pid=".$_POST['pid']."
	";
	$result = mysql_query($sql, $connect);
	if (!$result) {
		//die('Invalid query: ' . mysql_error());
		//echo $sql;
		echo "ERROR";
	} else {

		$sql = "
			DELETE FROM ".$prefix."relation_gp WHERE pid=".$_POST['pid']."
		";
		$result = mysql_query($sql, $connect);
		if (!$result) {
			//die('Invalid query: ' . mysql_error());
			//echo $sql;
			echo "ERROR";
		} else {
			echo "COMPLETE";
		}

	}

}

?>
