<? 
header("Content-Type: text/xml; charset=UTF-8"); 

extract($_ENV); 
extract($_GET); 
extract($_POST); 
extract($_COOKIE); 
extract($_SERVER); 
extract($_FILES);

$_path['db_config'] = $DOCUMENT_ROOT."/multipart/worklist/db_config.php";

#########################################
#              디비 접속                #
#########################################
function db_connect() {
	global $connect,$db_connect_ok,$_path;
	
	if ($f_db_connect_ok) return;
	$f_db_connect_ok = true;
	
	$fp=file($_path['db_config']) or error("db_config.php파일이 없습니다.\\n DB설정을 먼저 하십시요");

	$connect = mysql_connect(trim($fp[1]),trim($fp[2]),trim($fp[3]));
	$status = mysql_select_db(trim($fp[4]), $connect);
	
}

#########################################
#            디비 접속 해제             #
#########################################
function db_close() {
	global $connect;

	if($connect) {
		mysql_close($connect);
		unset($connect);
	}
}

// xml 파일
db_connect();
echo "<"."?xml version='1.0' encoding='UTF-8'?".">\n";

$g_sql = "select gid,name from mp_group_info order by seq";
$g_result = mysql_query($g_sql, $connect);
$g_total = mysql_num_rows($g_result);

echo "<data>\n";
echo "	<groups>\n";
for ($g = 0; $g < $g_total; $g++) {
	$group = mysql_fetch_array($g_result);

	echo "		<group gid='".iconv('euc-kr','utf-8',$group['gid'])."' name='".iconv('euc-kr','utf-8',$group['name'])."'>\n";

	$w_sql = "select wid,name from mp_worker_info where gid='".$group['gid']."' order by seq";
	$w_result = mysql_query($w_sql, $connect);
	$w_total = mysql_num_rows($w_result);

	echo "			<workers>\n";
	for ($w = 0; $w < $w_total; $w++) {
		$woker = mysql_fetch_array($w_result);

		echo "				<worker wid='".iconv('euc-kr','utf-8',$woker['wid'])."' name='".iconv('euc-kr','utf-8',$woker['name'])."' />\n";

	}
	echo "			</workers>\n";

	$t_sql = "select tid,name from mp_type_info where gid='".$group['gid']."' order by seq";
	$t_result = mysql_query($t_sql, $connect);
	$t_total = mysql_num_rows($t_result);

	echo "			<types>\n";
	for ($t = 0; $t < $t_total; $t++) {
		$type = mysql_fetch_array($t_result);

		echo "				<type tid='".iconv('euc-kr','utf-8',$type['tid'])."' name='".iconv('euc-kr','utf-8',$type['name'])."' />\n";

	}
	echo "			</types>\n";

	echo "		</group>\n";
}
echo "	</groups>\n";

$p_sql = "select pid,name from mp_project_info order by seq";
$p_result = mysql_query($p_sql, $connect);
$p_total = mysql_num_rows($p_result);

echo "	<projects>\n";
for ($p = 0; $p < $p_total; $p++) {
	$project = mysql_fetch_array($p_result);

	echo "		<project pid='".iconv('euc-kr','utf-8',$project['pid'])."' name='".iconv('euc-kr','utf-8',$project['name'])."' />\n";

}
echo "	</projects>\n";
echo "</data>\n";
?>