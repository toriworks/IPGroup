<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once('../classes/ConnectionFactory.php');
require_once('../classes/domain/Work.php');
require_once('../classes/dao/WorkDaoImpl.php');
require_once('../classes/service/WorkServiceImpl.php');

require_once('../classes/domain/Attaches.php');
require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');

require_once('../classes/utils/CommonUtils.php');


$conn = ConnectionFactory::create();
$workDaoImpl = new WorkDaoImpl();
$workServiceImpl = new WorkServiceImpl();
$workServiceImpl->setWorkDao($workDaoImpl);

$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);


// Get parameters
$is_shop = $_REQUEST['is_shop'];
$thumb_title = $_REQUEST['thumb_title'];
$thumb_sub_title = $_REQUEST['thumb_sub_title'];
$thumb_types = $_REQUEST['thumb_types'];

// 오픈일 분해
$open_date = $_REQUEST['open_date'];
$open_date_m = ''; $open_date_y = ''; $open_date_d = '';
if($open_date != "") {
    $arrOD = explode('.', $open_date);
    $open_date_y = $arrOD[0];
    $open_date_m = $arrOD[1];
    $open_date_d = $arrOD[2];
}

// 썸네일 첨부1, 2
$target_path = $_FILES['thumb_attach1']['name'];
$thumb_attach2 = $_FILES['thumb_attach2']['name'];

$wtypes = $_REQUEST['wtypes'];
$pname = $_REQUEST['pname'];;
$client_name = $_REQUEST['client_name'];
$start_date = $_REQUEST['start_date'];
$start_date_y =''; $start_date_m = ''; $start_date_d = '';
if($start_date != "") {
    $arrSD = explode('.', $start_date);
    $start_date_y = $arrSD[0];
    $start_date_m = $arrSD[1];
    $start_date_d = $arrSD[2];
}
$end_date = $_REQUEST['end_date'];
$end_date_y =''; $end_date_m = ''; $end_date_d = '';
if($end_date != "") {
    $arrED = explode('.', $end_date);
    $end_date_y = $arrED[0];
    $end_date_m = $arrED[1];
    $end_date_d = $arrED[2];
}
$url = $_REQUEST['url'];
$descriptions = $_REQUEST['descriptions'];

// 키값 생성
$validChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$key = randomString($validChars, 6);
$key = 'WRK-'.$key;


// 객체 생성 후, 값 설정
$workObj = new Work();
$workObj->setId($key);
$workObj->setIsShop($is_shop);
$workObj->setKeeperId($_COOKIE["keeper_id"]);
$workObj->setModId('');
$workObj->setThumbTitle($thumb_title);
$workObj->setThumbSubTitle($thumb_sub_title);
$workObj->setThumbTypes($thumb_types);
$workObj->setOpenDateY($open_date_y);
$workObj->setOpenDateM($open_date_m);
$workObj->setOpenDateD($open_date_d);
$workObj->setThumbAttach1($thumb_attach1);
$workObj->setThumbAttach2($thumb_attach2);
$workObj->setWtypes($wtypes);
$workObj->setName($pname);
$workObj->setClientName($client_name);
$workObj->setStartDateY($start_date_y);
$workObj->setStartDateM($start_date_m);
$workObj->setStartDateD($start_date_d);
$workObj->setEndDateY($end_date_y);
$workObj->setEndDateM($end_date_m);
$workObj->setEndDateD($end_date_d);
$workObj->setUrl($url);
$workObj->setDescriptions($descriptions);
$workObj->setWorkAttach($work_attach);
$workObj->setWorkAttachCnt($work_attach_cnt);


// 입력 작업 시작
$retSuccess = $workServiceImpl->add($conn, $workObj);
//echo "<p>retSuccess:".$retSuccess."<p/>";

if($retSuccess == 1) {
    // 성공인 경우에 업로드 수행
    $ta1 = $workObj->getThumbAttach1();
    $ta2 = $workObj->getThumbAttach2();

    $target_path = class_path.'/uploaded/work/';
    if($ta1) {
        $ext = pathinfo($_FILES["thumb_attach1"]["name"], PATHINFO_EXTENSION);
        $new_filename = randomString($validChars, 20).'.'.$ext;

        // 썸네일 첨부 1
        move_uploaded_file($_FILES["thumb_attach1"]["tmp_name"],  $target_path.$new_filename);

        $aObj = new Attaches();
        $aObj->setRefId($key);
        $aObj->setStypes('T1');
        $aObj->setMtypes('WK');
        $aObj->setOriginalFilename($thumb_attach1);
        $aObj->setTransferFilename($new_filename);

        $attachesServiceImpl->add($conn, $aObj);
    }

    if($ta2) {
        $ext = pathinfo($_FILES["thumb_attach2"]["name"], PATHINFO_EXTENSION);
        $new_filename = randomString($validChars, 20).'.'.$ext;

        // 썸네일 첨부 1
        move_uploaded_file($_FILES["thumb_attach2"]["tmp_name"],  $target_path.$new_filename);

        $aObj = new Attaches();
        $aObj->setRefId($key);
        $aObj->setStypes('T2');
        $aObj->setMtypes('WK');
        $aObj->setOriginalFilename($thumb_attach2);
        $aObj->setTransferFilename($new_filename);

        $attachesServiceImpl->add($conn, $aObj);
    }


    // 첨부파일
    $work_attach_cnt = $_REQUEST['work_attach_cnt'];
    $work_attach = '';
    for($i=0; $i<$work_attach_cnt; $i++) {
        //echo $_FILES['work_attach'.($i+1)]['name'].'<br/>';

        if($_FILES['work_attach'.($i+1)]['name'] != "") {
            $ext = pathinfo($_FILES['work_attach'.($i+1)]["name"], PATHINFO_EXTENSION);
            $new_filename = randomString($validChars, 20).'.'.$ext;

            move_uploaded_file($_FILES['work_attach'.($i+1)]["tmp_name"],  $target_path.$new_filename);

            $aObj = new Attaches();
            $aObj->setRefId($key);
            $aObj->setStypes('A'.($i+1));
            $aObj->setMtypes('WK');
            $aObj->setOriginalFilename($_FILES['work_attach'.($i+1)]['name']);
            $aObj->setTransferFilename($new_filename);

            $attachesServiceImpl->add($conn, $aObj);
        }
    }

}


// 키 생성
function randomString($valid_chars, $length)
{
    $random_string = "";
    $num_valid_chars = strlen($valid_chars);

    for ($i = 0; $i < $length; $i++)
    {
        $random_pick = mt_rand(1, $num_valid_chars);
        $random_char = $valid_chars[$random_pick-1];
        $random_string .= $random_char;
    }
    return $random_string;
}
?>
<script type="text/javascript">
    location.href = "./redirect.php?page=work_list.php";
</script>