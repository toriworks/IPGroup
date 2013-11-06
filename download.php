<?php
//function mb_basename($path) { return end(explode('/',$path)); }
function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE", $str); }
function is_ie() { return isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false; }
//
//// 파라미터 수신
$filename = $_REQUEST['filename'];
$ofilename = $_REQUEST['ofilename'];
$category = $_REQUEST['category'];
//
//// 다운로드 받을 경로 설정
//$directory = '';
if($category == 'CI') {
    $directory = './uploaded/introduction/';
}
//
//// 파일명 조합
$filename = trim($filename);
$filepath = $directory.$filename;
$filesize = filesize($filepath);
//
//// IE 처리
if( is_ie() ) $ofilename = utf2euc($ofilename);
//
//// 헤더 설정
//header("Pragma: public");
//header("Expires: 0");
//header("Content-Type: application/octet-stream");
//header("Content-Disposition: attachment; filename=\"$ofilename\"");
//header("Content-Transfer-Encoding: binary");
//header("Content-Length: $filesize");
//
//// 파일 읽기
//readfile($filepath);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($ofilename));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: '.$filesize);
ob_clean();
flush();
readfile($filepath);
exit;
?>
