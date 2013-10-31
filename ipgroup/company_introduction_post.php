<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 31
 * Time: 오후 7:12
 */
@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once('../classes/ConnectionFactory.php');

require_once('../classes/domain/Attaches.php');
require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');

$conn = ConnectionFactory::create();
$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);

$target_path = class_path.'/uploaded/introduction/';

$validChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
if($_FILES['file_attach']['name'] != "") {
    $ext = pathinfo($_FILES['file_attach']['name'], PATHINFO_EXTENSION);
    $new_filename = randomString($validChars, 20).'.'.$ext;

    move_uploaded_file($_FILES['file_attach']['tmp_name'],  $target_path.$new_filename);

    $aObj = new Attaches();
    $aObj->setRefId('CPI-000001');
    $aObj->setStypes('A1');
    $aObj->setMtypes('CI');
    $aObj->setOriginalFilename($_FILES['file_attach']['name']);
    $aObj->setTransferFilename($new_filename);

    $attachesServiceImpl->delete($conn, $aObj);
    $attachesServiceImpl->add($conn, $aObj);
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
    location.href = "./redirect.php?page=company_introduction.php";
</script>
