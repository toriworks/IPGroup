<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 31
 * Time: 오후 7:12
 */
@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once('./classes/ConnectionFactory.php');

require_once('./classes/dao/ApplicantsDaoImpl.php');
require_once('./classes/service/ApplicantsServiceImpl.php');
require_once('./classes/domain/Applicants.php');

require_once('./classes/dao/ApplicantsCompanyDaoImpl.php');
require_once('./classes/service/ApplicantsCompanyServiceImpl.php');
require_once('./classes/domain/ApplicantsCompany.php');

require_once('./classes/domain/Attaches.php');
require_once('./classes/dao/AttachesDaoImpl.php');
require_once('./classes/service/AttachesServiceImpl.php');

$conn = ConnectionFactory::create();

$appDaoImpl = new ApplicantsDaoImpl();
$appServiceImpl = new ApplicantsServiceImpl();
$appServiceImpl->setApplicantsDao($appDaoImpl);

//echo 'jobs_id:'.$_REQUEST['jobs_id'].'<br>';
//echo 'career_types:'.$_REQUEST['career_types'].'<br>';
//echo 'career_years:'.$_REQUEST['career_years'].'<br>';
//echo 'kor_name:'.$_REQUEST['kor_name'].'<br>';
//echo 'birth_year:'.$_REQUEST['birth_year'].'<br>';
//echo 'mobile_1:'.$_REQUEST['mobile_1'].'<br>';
//echo 'mobile_2:'.$_REQUEST['mobile_2'].'<br>';
//echo 'mobile_3:'.$_REQUEST['mobile_3'].'<br>';
//echo 'tel_1:'.$_REQUEST['tel_1'].'<br>';
//echo 'tel_2:'.$_REQUEST['tel_2'].'<br>';
//echo 'tel_3:'.$_REQUEST['tel_3'].'<br>';
//echo 'email:'.$_REQUEST['email'].'<br>';
//echo 'school_type:'.$_REQUEST['school_type'].'<br>';
//echo 'school_name:'.$_REQUEST['school_name'].'<br>';
//echo 'school_sub:'.$_REQUEST['school_sub'].'<br>';
//echo 'wish_pay:'.$_REQUEST['wish_pay'].'<br>';



// 키값 생성
$validChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$key = randomString($validChars, 6);
$key = 'APP-'.$key;

$app = new Applicants();
$app->setJobsId($_REQUEST['jobs_id']);
$app->setId($key);
$app->setCareerTypes($_REQUEST['career_types']);
$app->setCareerYears($_REQUEST['career_years']);
$app->setKorName($_REQUEST['kor_name']);
$app->setBirthYear($_REQUEST['birth_year']);
$app->setMobile1($_REQUEST['mobile_1']);
$app->setMobile2($_REQUEST['mobile_2']);
$app->setMobile3($_REQUEST['mobile_3']);
$app->setTel1($_REQUEST['tel_1']);
$app->setTel2($_REQUEST['tel_2']);
$app->setTel3($_REQUEST['tel_3']);
$app->setEmail($_REQUEST['email']);
$app->setSchoolType($_REQUEST['school_type']);
$app->setSchoolName($_REQUEST['school_name']);
$app->setSchoolSub($_REQUEST['school_sub']);
$app->setWishPay($_REQUEST['wish_pay']);

$resultOfQuery = $appServiceImpl->add($conn, $app);

if($resultOfQuery > 0) {
    // 회사정보 입력
    $appCompanyDao = new ApplicantsCompanyDaoImpl();
    $appCompanyService = new ApplicantsCompanyServiceImpl();
    $appCompanyService->setApplicantsCompanyDao($appCompanyDao);

    // 파라미터 수신
    $company_name1 = $_REQUEST['company_name1'];
    $work_period1 = $_REQUEST['work_period1'];
    $position1 = $_REQUEST['position1'];
    $descriptions1 = $_REQUEST['descriptions1'];
    //echo 'company_name1:'.$company_name1.', work:'.$work_period1.', position:'.$position1.', descriptions:'.$descriptions1.'<br>';

    $company_name2 = $_REQUEST['company_name2'];
    $work_period2 = $_REQUEST['work_period2'];
    $position2 = $_REQUEST['position2'];
    $descriptions2 = $_REQUEST['descriptions2'];
    //echo 'company_name2:'.$company_name2.', work:'.$work_period2.', position:'.$position2.', descriptions:'.$descriptions2.'<br>';

    $company_name3 = $_REQUEST['company_name3'];
    $work_period3 = $_REQUEST['work_period3'];
    $position3 = $_REQUEST['position3'];
    $descriptions3 = $_REQUEST['descriptions3'];
    //echo 'company_name1:'.$company_name3.', work:'.$work_period3.', position:'.$position3.', descriptions:'.$descriptions3.'<br>';

    // 객체생성
    $key1 = randomString($validChars, 6);
    $key1 = 'APC-'.$key1;

    $ac1 = new ApplicantsCompany();
    $ac1->setJobsId($_REQUEST['jobs_id']);
    $ac1->setApplicantsId($key);
    $ac1->setId($key1);
    $ac1->setCompanyName($company_name1);
    $ac1->setStartDate($work_period1);
    $ac1->setPosition($position1);
    $ac1->setDescriptions($descriptions1);
    $ac1->setOrder(1);
    $appCompanyService->add($conn, $ac1);

    //
    $key2 = randomString($validChars, 6);
    $key2 = 'APC-'.$key2;

    $ac2 = new ApplicantsCompany();
    $ac2->setJobsId($_REQUEST['jobs_id']);
    $ac2->setApplicantsId($key);
    $ac2->setId($key2);
    $ac2->setCompanyName($company_name2);
    $ac2->setStartDate($work_period2);
    $ac2->setPosition($position2);
    $ac2->setDescriptions($descriptions2);
    $ac2->setOrder(2);
    $appCompanyService->add($conn, $ac2);

    //
    $key3 = randomString($validChars, 6);
    $key3 = 'APC-'.$key3;

    $ac3 = new ApplicantsCompany();
    $ac3->setJobsId($_REQUEST['jobs_id']);
    $ac3->setApplicantsId($key);
    $ac3->setId($key3);
    $ac3->setCompanyName($company_name3);
    $ac3->setStartDate($work_period3);
    $ac3->setPosition($position3);
    $ac3->setDescriptions($descriptions3);
    $ac3->setOrder(3);
    $appCompanyService->add($conn, $ac3);


    // 파일 업로드 수행
    $attachesDaoImpl = new AttachesDaoImpl();
    $attachesServiceImpl = new AttachesServiceImpl();
    $attachesServiceImpl->setAttachesDao($attachesDaoImpl);

    $target_path = class_path.'/uploaded/recruit/';
    if($_FILES['file_attach']['name'] != "") {
        $ext = pathinfo($_FILES['file_attach']['name'], PATHINFO_EXTENSION);
        $new_filename = randomString($validChars, 20).'.'.$ext;

        move_uploaded_file($_FILES['file_attach']['tmp_name'],  $target_path.$new_filename);

        $aObj = new Attaches();
        $aObj->setRefId($key);
        $aObj->setStypes('A1');
        $aObj->setMtypes('RC');
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
?>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <script type="text/javascript">
        alert("정상적으로 입사지원 되셨습니다. 감사합니다.\n입사지원 결과는 개별 연락 또는 '합격확인'을 통해 확인하실 수 있습니다.");
        location.href = "./index.html#works_list";
    </script>
</head>
<body></body>
</html>