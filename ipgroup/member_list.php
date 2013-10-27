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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title>IPGROUP 관리자페이지</title>
    <link rel="stylesheet" type="text/css" href="./css/admin.css" />
    <link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui-1.10.3.custom.css" />
    <script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
    <script type="text/javascript" src="./js/admin.js"></script>
    <script type="text/javascript" src="./js/message.js"></script>
    <script type="text/javascript">
        orderBySetting = function(idObj) {

        }
    </script>
</head>
<body>

<div id="admin_wrap">

    <div id="admin_left">
        <h1>IPGROUP</h1>

        <p class="username">
            <span><?= $_COOKIE["keeper_kor_name"] ?></span><br />
            <a href="javascript:try_logout();">[로그아웃]</a>
        </p>

        <ul class="menu">
            <li><a href="work_list.php">Work</a></li>
            <li><a href="request_list.php">Request</a></li>
            <li><a href="recruit_list.php">Recruit</a></li>
            <li><a href="job_posting_list.php">Job Posting</a></li>
            <li><a href="company_introduction.php">Company Introduction</a></li>
            <li class="active"><a href="member_list.php">Member</a></li>
        </ul>
    </div>
<?
$rowCountPerPage = 7;
$wParam = '';
$orderBy = $_REQUEST['orderBy'];
$orderDir = $_REQUEST['orderDir'];
if($orderBy == '') {
    $orderBy = ' regdate DESC ';
}

$curPage = $_REQUEST['curPage'];
if($curPage == '') {
    $curPage = 1;
}

$totalCnt = $keeperServiceImpl->listsCount($conn, $wParam);
$result = $keeperServiceImpl->lists($conn, $wParam, $orderBy, $curPage, $rowCountPerPage);
?>
    <div id="admin_contents">
        <div class="page_top">
            <h2>Member</h2>
        </div>
        <div class="container">
            <!-- 본문 영역 -->

            <div class="section">
                <!-- 상단 영역 -->
                <div class="area_top">
                    <div class="right">
                        <a class="txt_button" href="member_write.php">신규등록</a>
                    </div>
                </div>
                <!-- //상단 영역 -->

                <!-- 데이터 테이블 -->
                <div class="data_table">
                    <table class="tbl" border="1" cellspacing="0">
                        <colgroup>
                            <col width="10%" />
                            <col width="24%" />
                            <col width="22%" />
                            <col width="22%" />
                            <col width="22%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><a class="asc" href="javascript:orderBySetting(this);" id="dir_id">ID</a></th>
                            <th><a class="asc" href="javascript:orderBySetting(this);" id="dir_kor_name">사용자</a></th>
                            <th><a class="asc" href="javascript:orderBySetting(this);" id="dir_auth_types">권한</a></th>
                            <th><a class="desc" href="javascript:orderBySetting(this);" id="dir_regdate">생성일</a></th>
                        </tr>
                        </thead>
                        <tbody>
<?
if($totalCnt > 0) {
    $bPage = (($curPage - 1) * $rowCountPerPage) + 1;
    while($row = mysql_fetch_array($result)) {
        $bPage++;
?>
                        <tr>
                            <td><?= $bPage - 1 ?></td>
                            <td><a href="member_view.php"><?= $row['id'] ?></a></td>
                            <td><?= $row['kor_name'] ?></td>
                            <td><?= $row['auth_types'] ?></td>
                            <td><?= $row['regdate'] ?></td>
                        </tr>
<?
    }
}
?>
                        </tbody>
                    </table>
                </div>
                <!-- //데이터 테이블 -->

                <!-- 페이징 -->
<?
$divPage = (int) ($totalCnt / $rowCountPerPage);
$modPage = $totalCnt % $rowCountPerPage;

$totalPage = ($modPage == 0) ? $divPage : ($divPage + 1);
?>
                <div class="paginate">
<?
// Prev block
if($curPage > 1) {
    echo '<a class="direction" href="'.$_SERVER[PHP_SELF].'?wParam=&orerBy=&curPage='.($curPage-1).'"><span>‹</span> 이전페이지</a>';
} else {
    echo '<span>‹</span> 이전페이지';
}

$strPage = '';
for($k = 1; $k <= $totalPage; $k++) {
    if($curPage == $k) {
        $strPage = '<a href=><strong>'.$k.'</strong></a>';
    } else {
        $strPage = '<a href="'.$_SERVER[PHP_SELF].'?wParam=&orderBy=&curPage='.$k.'">'.$k.'</a>';
    }

    // 1, 2, 3, 4, 5, 6 ...
    echo $strPage;
}

// Next block
if($curPage < $totalPage) {
    echo '<a class="direction" href="'.$_SERVER[PHP_SELF].'?wParam=&orderBy=&curPage='.($curPage+1).'">다음페이지 <span>›</span></a>';
} else {
    echo '다음페이지 <span>›</span>';
}
?>
                </div>
                <!-- //페이징 -->
            </div>

            <!-- //본문 영역 -->
        </div>
    </div>

</div>

</body>
</html>
