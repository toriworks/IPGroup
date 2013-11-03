<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 31
 * Time: 오후 7:12
 */
@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once('./classes/ConnectionFactory.php');

require_once('./classes/dao/RequestsDaoImpl.php');
require_once('./classes/service/RequestsServiceImpl.php');
require_once('./classes/domain/Requests.php');

require_once('./classes/domain/Attaches.php');
require_once('./classes/dao/AttachesDaoImpl.php');
require_once('./classes/service/AttachesServiceImpl.php');

$conn = ConnectionFactory::create();

$requestDaoImpl = new RequestsDaoImpl();
$requestServiceImpl = new RequestsServiceImpl();
$requestServiceImpl->setRequestsDao($requestDaoImpl);

//echo 'company_name:'.$_REQUEST['company_name'].'<br>';
//echo 'manager_name:'.$_REQUEST['manager_name'].'<br>';
//echo 'url:'.$_REQUEST['url'].'<br>';
//echo 'contact_tel:'.$_REQUEST['contact_tel'].'<br>';
//echo 'contact_mobile:'.$_REQUEST['contact_mobile'].'<br>';
//echo 'email:'.$_REQUEST['email'].'<br>';
//echo 'types:'.$_REQUEST['types'].'<br>';
//echo 'memos:'.$_REQUEST['memos'].'<br>';

// 키값 생성
$validChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$key = randomString($validChars, 6);
$key = 'REQ-'.$key;

$requestObj = new Requests();
$requestObj->setId($key);
$requestObj->setCompanyName($_REQUEST['company_name']);
$requestObj->setManagerName($_REQUEST['manager_name']);
$requestObj->setUrl($_REQUEST['url']);
$requestObj->setContactTel($_REQUEST['contact_tel']);
$requestObj->setContactMobile($_REQUEST['contact_mobile']);
$requestObj->setEmail($_REQUEST['email']);
$requestObj->setTypes($_REQUEST['types']);
$requestObj->setMemos('');
$requestObj->setManagerId('');
$requestObj->setDescriptions($_REQUEST['memos']);

$resulfOfQuery = $requestServiceImpl->add($conn, $requestObj);
if($resulfOfQuery > 0) {
    // 파일 업로드 수행
    $attachesDaoImpl = new AttachesDaoImpl();
    $attachesServiceImpl = new AttachesServiceImpl();
    $attachesServiceImpl->setAttachesDao($attachesDaoImpl);

    $target_path = class_path.'/uploaded/requests/';
    if($_FILES['file_attach']['name'] != "") {
        $ext = pathinfo($_FILES['file_attach']['name'], PATHINFO_EXTENSION);
        $new_filename = randomString($validChars, 20).'.'.$ext;

        move_uploaded_file($_FILES['file_attach']['tmp_name'],  $target_path.$new_filename);

        $aObj = new Attaches();
        $aObj->setRefId($key);
        $aObj->setStypes('A1');
        $aObj->setMtypes('RQ');
        $aObj->setOriginalFilename($_FILES['file_attach']['name']);
        $aObj->setTransferFilename($new_filename);

        $attachesServiceImpl->delete($conn, $aObj);
        $attachesServiceImpl->add($conn, $aObj);
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
//?>
<html lang="ko">
<head>
<meta charset="utf-8">
<script type="text/javascript">
    alert("문의가 접수되었습니다.\n감사합니다.");
    location.href = "./index.html#works_list";
</script>
</head>
<body></body>
</html>