<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

require_once('./auth.php');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/WorkDaoImpl.php');
require_once('../classes/service/WorkServiceImpl.php');
require_once('../classes/domain/Work.php');

$conn = ConnectionFactory::create();
$workDaoImpl = new WorkDaoImpl();
$workServiceImpl = new WorkServiceImpl();
$workServiceImpl->setWorkDao($workDaoImpl);
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
        goDetail = function(id, ob, od, wp) {
            location.href = "work_list_view.php?work_id=" + id + "&orderBy=" + ob + "&orderDir=" + od + "&wParam=" + wp;
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
        <li class="active"><a href="work_list.php">Work</a></li>
        <li><a href="request_list.php">Request</a></li>
        <li><a href="recruit_list.php">Recruit</a></li>
        <li><a href="job_posting_list.php">Job Posting</a></li>
        <li><a href="company_introduction.php">Company Introduction</a></li>
        <li><a href="member_list.php">Member</a></li>
    </ul>
</div>
<?
$rowCountPerPage = 7;
$wParam = '';
$orderBy = $_REQUEST['orderBy'];
$orderDir = $_REQUEST['orderDir'];
if($orderBy == '') {
    $orderBy = ' regdate_r DESC ';
}

$curPage = $_REQUEST['curPage'];
if($curPage == '') {
    $curPage = 1;
}

$totalCnt = $workServiceImpl->listsCount($conn, $wParam);
$result = $workServiceImpl->lists($conn, $wParam, $orderBy, $curPage, $rowCountPerPage);
?>
<div id="admin_contents">
<div class="page_top">
    <h2>Work</h2>
</div>
<div class="container">
    <!-- 본문 영역 -->

    <div class="section">
        <div class="form_search">
            <dl>
                <dt class="t">기간선택 : </dt>
                <dd>
                    <input type="checkbox" />
                    <select class="select" name="" id="">
                        <option value="">등록일자</option>
                        <option value="">수정일자</option>
                    </select>
                    <input id="date_from" class="i_text date" type="text" value="" />
                    ~
                    <input id="date_to" class="i_text date" type="text" value="" />
                </dd>
                <script type="text/javascript">
                    init_from_to_date();
                </script>

                <dt>전시여부 : </dt>
                <dd>
                    <input id="ck_a_1" type="checkbox" /><label for="ck_a_1">YES</label>
                    <input id="ck_a_2" type="checkbox" /><label for="ck_a_2">NO</label>
                </dd>

                <dt>유형 : </dt>
                <dd>
                    <input id="ck_b_1" type="checkbox" /><label for="ck_b_1">Project</label>
                    <input id="ck_b_2" type="checkbox" /><label for="ck_b_2">Promotion</label>
                    <input id="ck_b_3" type="checkbox" /><label for="ck_b_3">UX/UI</label>
                    <input id="ck_b_4" type="checkbox" /><label for="ck_b_4">Mobile</label>
                    <input id="ck_b_5" type="checkbox" /><label for="ck_b_5">Offer</label>
                    <input id="ck_b_6" type="checkbox" /><label for="ck_b_6">Consulting</label>
                    <input id="ck_b_7" type="checkbox" /><label for="ck_b_7">AD</label>
                </dd>
            </dl>

            <div class="keyword_area">
                <select class="select" name="" id="">
                    <option value="">프로젝트명</option>
                    <option value="">클라이언트</option>
                    <option value="">URL</option>
                </select>
                <input class="keyword" type="text" />
                <a class="txt_button" href="#">검색</a>
            </div>
        </div>

    </div>


    <div class="section">
        <!-- 상단 영역 -->
        <div class="area_top">
            <div class="left">
                <select class="select">
                    <option value="10">10개씩보기</option>
                    <option value="20">20개씩보기</option>
                    <option value="50">50개씩보기</option>
                    <option value="100">100개씩보기</option>
                </select>
            </div>
            <div class="right">
                <a class="txt_button" href="work_write.php">신규등록</a>
            </div>
        </div>
        <!-- //상단 영역 -->

        <!-- 데이터 테이블 -->
        <div class="data_table">
            <table class="tbl" border="1" cellspacing="0">
                <colgroup>
                    <col width="7%" />
                    <col width="49%" />
                    <col width="12%" />
                    <col width="12%" />
                    <col width="12%" />
                    <col width="8%" />
                </colgroup>
                <thead>
                <tr>
                    <th><a class="asc" href="#">No</a></th>
                    <th><a class="desc" href="#">제목</a></th>
                    <th><a class="desc" href="#">등록일</a></th>
                    <th><a class="desc" href="#">수정일</a></th>
                    <th><a class="desc" href="#">등록ID</a></th>
                    <th><a class="desc" href="#">전시</a></th>
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
                    <td class="title"><a href="javascript:goDetail('<?= $row['id'] ?>', '<?= $orderBy ?>', '<?= $orderDir ?>', '<?= $wParam ?>');"><?= $row['name'] ?></a></td>
                    <td><?= $row['regdate'] ?></td>
                    <td><?= $row['moddate'] ?></td>
                    <td><?= $row['keeper_id'] ?></td>
                    <td class="active y"><?= $row['is_shop'] ?></td>
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
        <!-- //페이징 -->
    </div>

    <!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
