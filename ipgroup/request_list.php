<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 29
 * Time: 오전 11:40
 */
require_once('./auth.php');

require_once('../classes/dao/ICommons.php');
require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/RequestsDaoImpl.php');
require_once('../classes/service/RequestsServiceImpl.php');
require_once('../classes/domain/Requests.php');

$conn = ConnectionFactory::create();
$requestsDaoImpl = new RequestsDaoImpl();
$requestsServiceImpl = new RequestsServiceImpl();
$requestsServiceImpl->setRequestsDao($requestsDaoImpl);
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
    <script type="text/javascript" src="./js/login.js"></script>
    <script type="text/javascript">
        del_checked = function() {
            var checkVObj = document.getElementsByName("check_v");
            var checkCnt = checkVObj.length;
            var cCnt = 0;
            var sChecked = "";
            for(var k=0; k<checkCnt; k++) {
                if(checkVObj[k].checked == true) {
                    cCnt++;
                    sChecked = sChecked + checkVObj[k].value + "^";
                }
            }
            if(cCnt == 0) {
                alert(DEL_NO_CHECKED);
                return;
            }

            if(confirm("정말 삭제하시겠습니까?")) {
                location.href = "./requests_delete_post.php?rids=" + sChecked;
            } else {
                return;
            }
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
        <li class="active"><a href="request_list.php">Request</a></li>
        <li><a href="recruit_list.php">Recruit</a></li>
        <li><a href="job_posting_list.php">Job Posting</a></li>
        <li><a href="company_introduction.php">Company Introduction</a></li>
        <li><a href="member_list.php">Member</a></li>
    </ul>
</div>

<div id="admin_contents">
<div class="page_top">
    <h2>Request</h2>
</div>
<div class="container">
<!-- 본문 영역 -->

<div class="section">
    <div class="form_search">
        <dl>
            <dt class="t">기간선택 : </dt>
            <dd>
                <input type="checkbox" />
                등록일자
                <input id="date_from" class="i_text date" type="text" value="" />
                ~
                <input id="date_to" class="i_text date" type="text" value="" />
            </dd>
            <script type="text/javascript">
                init_from_to_date();
            </script>

            <dt>문의항목 : </dt>
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
                <option value="">회사명</option>
                <option value="">연락처</option>
                <option value="">E-Mail</option>
                <option value="">담당자</option>
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
        <a class="txt_button" href="javascript:del_checked();">삭제</a>
    </div>
</div>
<!-- //상단 영역 -->

<!-- 데이터 테이블 -->
<div class="data_table">
    <table class="tbl" border="1" cellspacing="0">
        <colgroup>
            <col width="4%" />
            <col width="7%" />
            <col width="5%" />
            <col width="15%" />
            <col width="15%" />
            <col width="12%" />
            <col width="12%" />
            <col width="10%" />
            <col width="10%" />
        </colgroup>
        <thead>
        <tr>
            <th class="check">
                <input id="all_check" type="checkbox" />
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#all_check').bind('click',function(){
                            var cks = $(this).parents('table').find('> tbody td.check > input[type="checkbox"]');
                            if ($('#all_check').is(':checked')) {
                                cks.prop('checked',true);
                            } else {
                                cks.prop('checked',false);
                            }
                        });
                    });
                </script>
            </th>
            <th><a class="asc" href="#">No</a></th>
            <th><span class="hide">아이콘</span></th>
            <th><a class="desc" href="#">회사명</a></th>
            <th><a class="desc" href="#">연락처</a></th>
            <th><a class="desc" href="#">E-Mail</a></th>
            <th><a class="desc" href="#">문의항목</a></th>
            <th><a class="desc" href="#">담당자</a></th>
            <th><a class="desc" href="#">문의일</a></th>
        </tr>
        </thead>
        <tbody>
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

$totalCnt = $requestsServiceImpl->listsCount($conn, $wParam);
$result = $requestsServiceImpl->lists($conn, $wParam, $orderBy, $curPage, $rowCountPerPage);

if($totalCnt > 0) {
$bPage = (($curPage - 1) * $rowCountPerPage) + 1;
    while($row = mysql_fetch_array($result)) {
        $bPage++;

        // 유형선택을 문자열로 변경
        $wtypes = (int) $row['types'];
        $strWT = '';

        if(($wtypes & 1) == 1) {
            $strWT .= 'Project ';
        }
        if(($wtypes & 2) == 2) {
            $strWT = $strWT.'Promotion ';
        }
        if(($wtypes & 4) == 4) {
            $strWT = $strWT.'UX/UI ';
        }
        if(($wtypes & 8) == 8) {
            $strWT = $strWT.'Mobile ';
        }
        if(($wtypes & 16) == 16) {
            $strWT = $strWT.'Offer ';
        }
        if(($wtypes & 32) == 32) {
            $strWT = $strWT.'Consulting ';
        }
        if(($wtypes & 64) == 64) {
            $strWT = $strWT.'AD ';
        }
?>
        <tr>
            <td class="check"><input type="checkbox" id="check_v" name="check_v" value="<?= $row['id'] ?>" /></td>
            <td><?= $bPage - 1 ?></td>
            <td>
                <? if($row['original_filename'] != "") { ?>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <? } ?>
                <? if($row['is_old'] < IS_OLD_TERM) { ?><img src="./images/new-message.png" alt="신규항목" title="신규항목" /><? } ?>
            </td>
            <td class="company"><a href="request_view.php?requests_id=<?= $row['id'] ?>"><?= $row['company_name'] ?></a></td>
            <td><?= $row['contact_tel'] ?><br /><?= $row['contact_mobile'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $strWT ?></td>
            <td><?= $row['manager_name'] ?></td>
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
        <!-- //페이징 -->
    </div>

<!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
