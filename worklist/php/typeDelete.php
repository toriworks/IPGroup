<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

$seq = mysql_result(mysql_query("SELECT seq FROM ".$prefix."type_info WHERE tid=".$_POST['tid'], $connect),0 ,0);

$sql = "
	UPDATE ".$prefix."type_info SET
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
		DELETE FROM ".$prefix."type_info WHERE tid=".$_POST['tid']."
	";
	$result = mysql_query($sql, $connect);
	if (!$result) {
		//die('Invalid query: ' . mysql_error());
		//echo $sql;
		echo "ERROR";
	} else {

		$sql = "
			DELETE FROM ".$prefix."relation_gt WHERE tid=".$_POST['tid']."
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