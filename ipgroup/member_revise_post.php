<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

require_once('./auth.php');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/KeeperDaoImpl.php');
require_once('../classes/service/KeeperServiceImpl.php');
require_once('../classes/domain/Keeper.php');

$conn = ConnectionFactory::create();
$keeperDaoImpl = new KeeperDaoImpl();
$keeperServiceImpl = new KeeperServiceImpl();
$keeperServiceImpl->setKeeperDao($keeperDaoImpl);

// 파라미터 수신
$id = $_REQUEST['id'];
$kor_name = $_REQUEST['kor_name'];
$auth_types = $_REQUEST['auth_types'];
$menu1 = $_REQUEST['menu1_t'];
$menu2 = $_REQUEST['menu2_t'];
$menu3 = $_REQUEST['menu3_t'];
$menu4 = $_REQUEST['menu4_t'];
$menu5 = $_REQUEST['menu5_t'];
$menu6 = $_REQUEST['menu6_t'];

//echo $id.'<br>';
//echo $kor_name.'<br>';
//echo $auth_types.'<br>';
//echo $menu1.'<br>';
//echo $menu2.'<br>';
//echo $menu3.'<br>';
//echo $menu3.'<br>';
//echo $menu4.'<br>';
//echo $menu5.'<br>';
//echo $menu6.'<br>';

$keeper = new Keeper();
$keeper->setId($id);
$keeper->setKorName($kor_name);
$keeper->setAuthTypes($auth_types);
$keeper->setMenu1($menu1);
$keeper->setMenu2($menu2);
$keeper->setMenu3($menu3);
$keeper->setMenu4($menu4);
$keeper->setMenu5($menu5);
$keeper->setMenu6($menu6);

// 정보 수정
$keeperServiceImpl->update($conn, $keeper);
?>
<html lang="ko" >
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script type="text/javascript">
        alert("정보가 수정되었습니다.");
        location.href = "./redirect.php?page=member_view.php?mid=<?= $id ?>";
    </script>
</head>
<body></body>
</html>