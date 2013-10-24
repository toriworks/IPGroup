<?
header ('Content-type: text/html; charset=euc-kr'); 

extract($_ENV); 
extract($_GET); 
extract($_POST); 
extract($_COOKIE); 
extract($_SERVER); 
extract($_FILES);

$prefix = "wl_";
$_path['db_config'] = $DOCUMENT_ROOT."/worklist/db_config.php";

if ($_COOKIE['_GROUP']) {
	$_GROUP = $_COOKIE['_GROUP'];
} else {
	$_GROUP = "1";
}

#########################################
#              ��� ����                #
#########################################
function db_connect() {
	global $connect,$db_connect_ok,$_path;
	
	if ($f_db_connect_ok) return;
	$f_db_connect_ok = true;
	
	$fp=file($_path['db_config']) or error("db_config.php������ �����ϴ�.\\n DB������ ���� �Ͻʽÿ�");

	$connect = mysql_connect(trim($fp[1]),trim($fp[2]),trim($fp[3]));
	$status = mysql_select_db(trim($fp[4]), $connect);

	mysql_query("set names euckr");
	
}

#########################################
#            ��� ���� ����             #
#########################################
function db_close() {
	global $connect;

	if($connect) {
		mysql_close($connect);
		unset($connect);
	}
}

#########################################
#               ���� ��ȯ               #
#########################################
function week_kr($n) {
	switch($n) {
		case 1 :
			return "��";
			break;
		case 2 :
			return "��";
			break;
		case 3 :
			return "ȭ";
			break;
		case 4 :
			return "��";
			break;
		case 5 :
			return "��";
			break;
		case 6 :
			return "��";
			break;
		case 7 :
			return "��";
			break;
		default :
			return "";
			break;
	}
}

#########################################
#             Relation Query            #
#########################################
function queryGroupRelation($gid, $m) {
	global $prefix, $connect;
	if ($m == "project")     { $sql = "SELECT r.pid FROM ".$prefix."relation_gp AS r WHERE r.gid = ".$gid." ORDER BY r.pid"; }
	else if ($m == "worker") { $sql = "SELECT r.wid FROM ".$prefix."relation_gw AS r WHERE r.gid = ".$gid." ORDER BY r.wid"; }
	else if ($m == "type")   { $sql = "SELECT r.tid FROM ".$prefix."relation_gt AS r WHERE r.gid = ".$gid." ORDER BY r.tid"; }
	$result = mysql_query($sql, $connect);
	$rval = "";
	for ($j = 0; $j < mysql_num_rows($result); $j++) {
		$rval .= mysql_result($result, $j).",";
	}
	$rval = substr($rval, 0, -1);
	return $rval;
}




###############################################################################################################################

$_path['ip_party_story_image'] = "/Upload/ipPartyStory/";
$_path['ip_party_story_upload'] = $DOCUMENT_ROOT.$_path['ip_party_story_image'];
$_path['ip_party_review_image'] = "/Upload/partyReview/";
$_path['ip_party_review_upload'] = $DOCUMENT_ROOT.$_path['ip_party_review_image'];

function hitUpdate($bid,$id) {
	global $_COOKIE, $connect;
	$hit['name'] = "ipgHit_".$bid;
	$hit['value'] = "";
	$hit['cookie'] = $_COOKIE[$hit['name']];
	$hitId = explode(",",$hit['cookie']);
	if (!in_array($id, $hitId)) {
		@mysql_query("update ipg_party_".$bid." set view = view+1 where id = ".$id, $connect);
		setcookie($hit['name'], $hit['cookie'].",".$id, time()+3600);
	}
}

#########################################
#            ���Ͼ��ε�                 #
#########################################
function fileUpload($img_tmp,$img_name,$img_size,$img_type,$img_dir){
	if(!$img_tmp){ 
		error("���ε��� �ڷᰡ �����ϴ�");
		exit;
	}
	if ($img_name) {
		$savepath = $img_dir.$img_name;
		if (file_exists($savepath)){
			error("�����̸��� ������ ��ϵǾ� �ֽ��ϴ�.");
			exit;
		}
		if (is_uploaded_file($img_tmp)) {
			move_uploaded_file($img_tmp,$savepath); 
		} else {
			error("���ϵ���� �����߽��ϴ�.");
			exit;
		}
	}
}

#########################################
#            ����� �����              #
#########################################
function createThumb($tw, $th, $srcImg, $thumbImg) {
	// ����� �����
	$tSize[0] = $tw;
	$tSize[1] = $th;
	$size = getimagesize($srcImg);

	if (($tSize[0]/$tSize[1]) <= ($size[0]/$size[1])) {
		$cSize[0] = $size[1] * ($tSize[0]/$tSize[1]);
		$cSize[1] = $size[1];
		$sSize[0] = ($size[0] - $cSize[0])/2;
		$sSize[1] = 0;
	} else {
		$cSize[0] = $size[0];
		$cSize[1] = $size[0] * ($tSize[1]/$tSize[0]);
		$sSize[0] = 0;
		$sSize[1] = ($size[1] - $cSize[1])/2;
	}

	// Load
	$thumb = imagecreatetruecolor($tSize[0], $tSize[1]);
	$source = imagecreatefromjpeg($srcImg);

	// Resize
	imagecopyresized($thumb, $source, 0, 0, $sSize[0], $sSize[1], $tSize[0], $tSize[1], $cSize[0], $cSize[1]);
	imagejpeg($thumb, $thumbImg);
}

#########################################
#            ������ �̵�                #
#########################################
function refresh($gopage) {	
	global $connect;
	if($connect) {
		mysql_close($connect);
		unset($connect);
		}
	echo "<meta http-equiv='refresh' content='0;url=$gopage'>"; 
	exit;
}	

#########################################
#            DB ����                    #
#########################################
function query($arraySQL) {
	global $connect;
	$flag = "COMPLETE";
	for ($i = 0; $i < count($arraySQL); $i++) {
		$result = mysql_query($arraySQL[$i], $connect);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
			echo $sql;
			$flag = "ERROR";
			break;
		}
	}
	if ($flag == "ERROR") {
		echo "ERROR";
	} else {
		echo "COMPLETE";
	}
}


#########################################
#            ����                       #
#########################################
function error($msg,$url="") {

	?>
	
	<script type='text/javascript'>
		alert("<?=$msg?>");
	<?
	if ($url == "") {
		echo "	</script>\n";
		}
	elseif ($url == "back") {
		echo "		history.back();\n";
		echo "	</script>\n";
		}
	elseif ($url == "close") {
		echo "		window.close();\n";
		echo "	</script>\n";
		}
	else {
		echo "	</script>\n";
		refresh($url);
		}
	exit;
}
?>