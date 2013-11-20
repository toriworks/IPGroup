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

require_once('../classes/dao/KeeperDaoImpl.php');
require_once('../classes/service/KeeperServiceImpl.php');
require_once('../classes/domain/Keeper.php');

$conn = ConnectionFactory::create();
$requestsDaoImpl = new RequestsDaoImpl();
$requestsServiceImpl = new RequestsServiceImpl();
$requestsServiceImpl->setRequestsDao($requestsDaoImpl);

// 한 페이지에서 보여줄 갯수
$rowCountPerPage = 0;
$rowCountPerPage = ($_REQUEST['rcpp'] != '') ?  $_REQUEST['rcpp'] : 10;

$orderBy = $_REQUEST['orderBy'];
if($orderBy == '') {
    $orderBy = ' regdate_r ';
}

$orderDir = $_REQUEST['orderDir'];
if($orderDir == '') {
    $orderDir = ' DESC ';
}

$orderDirS = $_REQUEST['orderDirS'];
if($orderDirS == '') {
    $orderDirS = 'f^f^f^f^f^f^f^';
}

$curPage = $_REQUEST['curPage'];
if($curPage == '') {
    $curPage = 1;
}

// 검색조건
$schPeriod = $_REQUEST['sch_period'];
$schDateFrom = $_REQUEST['sch_date_from'];
$schDateTo = $_REQUEST['sch_date_to'];
$schWtypesR = (int) ('0' + $_REQUEST['sch_wtypes_r']);
$schGubun = $_REQUEST['sch_gubun'];
$schText = $_REQUEST['sch_text'];

// 조건절 구성
$wParam = '';
if($schPeriod == 'Y') {
    // 기간 선택이 체크 되어야지만 기간 선택이 수행
    $wParam .= " AND (a.regdate >= '".$schDateFrom."' AND a.regdate <= '".$schDateTo."') ";
}

// 유형
if($schWtypesR > 0) {
    $wParam .= " AND (types & ".$schWtypesR.") > 0 ";
}

// 검색어
if($schText != '') {
    if($schGubun == 'C') {
        $wParam .= " AND company_name LIKE '%".$schText."%' ";
    } else if($schGubun == 'T') {
        $wParam .= " AND (contact_tel LIKE '%".$schText."%' OR contact_mobile LIKE '%".$schText."%') ";
    } else if($schGubun == 'E') {
        $wParam .= " AND email LIKE '%".$schText."%' ";
    } else {
        $wParam .= " AND manager_name LIKE '%".$schText."%' ";
    }
}

// 메뉴 관련 권한 얻기
$keeperDaoImpl = new KeeperDaoImpl();
$keeperServiceImpl = new KeeperServiceImpl();
$keeperServiceImpl->setKeeperDao($keeperDaoImpl);
$keeper = new Keeper();
$keeper->setId($_COOKIE["keeper_id"]);

$keeper = $keeperServiceImpl->detail($conn, $keeper);
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

        orderb = function(ids, idt, idx) {

            // 모두 asc로 변경함
            for(var i=0; i<7; i++) {
                document.getElementById('o' + (i+1)).className = 'asc';
            }

            var ods = '<?= $orderDirS ?>';
            var arrOds = ods.split("^");
            for(var x=0; x<7; x++) {
                if(idx == x) {
                    if(arrOds[idx] == 'f') {
                        arrOds[idx] = 't';
                    } else {
                        arrOds[idx] = 'f';
                    }
                } else {
                    arrOds[x] = 'f';
                }
            }

            var nOds = '';
            for(var x=0; x<7; x++) {
                nOds += arrOds[x] + "^";
            }

            var form = document.forms.sch_form;
            form.curPage.value = 1;
            form.orderBy.value = ids;
            form.orderDirS.value = nOds;
            form.orderDir.value = (arrOds[idx] == 't') ? 'asc' : 'desc';
            form.submit();
        }

        changeRcpp = function(obj) {
            var sV = obj[obj.selectedIndex].value;

            var form = document.forms.sch_form;
            form.rcpp.value = sV;
            form.curPage.value = 1;

            form.submit();
        }

        goSearch = function() {
            var form = document.forms.sch_form;

            var sch_period = form.sch_period.checked;
            var sch_date_from = form.sch_date_from.value;
            var sch_date_to = form.sch_date_to.value;

            var sch_wtypes = 0;
            for(var k=0; k<7; k++) {
                if(form.sch_wtypes[k].checked == true) {
                    sch_wtypes += parseInt(form.sch_wtypes[k].value);
                }
            }
            form.sch_wtypes_r.value = sch_wtypes;

            var sch_gubun = '';
            for(var a=0; a<3; a++) {
                if(form.sch_gubun[a].selected == true) {
                    sch_gubun = form.sch_gubun[a].value;
                }
            }
            var sch_text = form.sch_text.value;
            form.submit();
        }

        goDetail = function(id) {
            var form = document.sch_form;
            form.requests_id.value = id;

            form.action = "request_view.php";
            form.submit();
        }

        goPaging = function(c, r) {
            var form = document.forms.sch_form;

            form.curPage.value = c;
            form.rcpp.value = r;

            form.submit();
        }

        $(document).ready(function(){
            $("#sch_text ").bind("keydown", function(e) {
                if (e.keyCode == 13) { // enter key
                    goSearch();
                    return false;
                }
            });
        });
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
        <? if(($keeper->getMenu1() & 1) > 0) { ?><li><a href="work_list.php">Work</a></li><? } ?>
        <? if(($keeper->getMenu2() & 1) > 0) { ?><li class="active"><a href="request_list.php">Request</a></li><? } ?>
        <? if(($keeper->getMenu3() & 1) > 0) { ?><li><a href="recruit_list.php">Recruit</a></li><? } ?>
        <? if(($keeper->getMenu4() & 1) > 0) { ?><li><a href="job_posting_list.php">Job Posting</a></li><? } ?>
        <? if(($keeper->getMenu5() & 1) > 0) { ?><li><a href="company_introduction.php">Company Introduction</a></li><? } ?>
        <? if(($keeper->getMenu6() & 1) > 0) { ?><li><a href="member_list.php">Member</a></li><? } ?>
    </ul>
</div>

<div id="admin_contents">
<div class="page_top">
    <h2>Request</h2>
</div>
<div class="container">
<!-- 본문 영역 -->

<form name="sch_form" action="<?= $_SERVER['PHP_SELF'] ?>?rcpp=<?= $rowCountPerPage ?>&curPage=<?= $curPage ?>" method="GET">
<input type="hidden" name="sch_wtypes_r" value="<?= $schWtypesR ?>" />
<input type="hidden" name="rcpp" value="<?= $rowCountPerPage ?>" />
<input type="hidden" name="curPage" value="<?= $curPage ?>" />
<input type="hidden" name="orderBy" value="<?= $orderBy ?>" />
<input type="hidden" name="orderDir" value="<?= $orderDir ?>" />
<input type="hidden" name="orderDirS" value="<?= $orderDirS ?>" />
<input type="hidden" name="requests_id" value="" />
<div class="section">
    <div class="form_search">
        <dl>
            <dt class="t">기간선택 : </dt>
            <dd>
                <input type="checkbox" id="sch_period" name="sch_period" value="Y"  <? if($schPeriod == 'Y') { echo ' checked'; } ?> />
                등록일자
                <input id="date_from" name="sch_date_from" class="i_text date" type="text" value="<?= $schDateFrom ?>" />
                ~
                <input id="date_to" name="sch_date_to" class="i_text date" type="text" value="<?= $schDateTo ?>" />
            </dd>
            <script type="text/javascript">
                init_from_to_date();
            </script>

            <dt>문의항목 : </dt>
            <dd>
                <input id="ck_b_1" name="sch_wtypes" value="1" type="checkbox" <? if(($schWtypesR & 1) > 0) { echo ' checked'; } ?> /><label for="ck_b_1">Project</label>
                <input id="ck_b_2" name="sch_wtypes" value="2" type="checkbox" <? if(($schWtypesR & 2) > 0) { echo ' checked'; } ?> /><label for="ck_b_2">Promotion</label>
                <input id="ck_b_3" name="sch_wtypes" value="4" type="checkbox" <? if(($schWtypesR & 4) > 0) { echo ' checked'; } ?> /><label for="ck_b_3">UX/UI</label>
                <input id="ck_b_4" name="sch_wtypes" value="8" type="checkbox" <? if(($schWtypesR & 8) > 0) { echo ' checked'; } ?> /><label for="ck_b_4">Mobile</label>
                <input id="ck_b_5" name="sch_wtypes" value="16" type="checkbox" <? if(($schWtypesR & 16) > 0) { echo ' checked'; } ?> /><label for="ck_b_5">Proposal</label>
                <input id="ck_b_6" name="sch_wtypes" value="32" type="checkbox" <? if(($schWtypesR & 32) > 0) { echo ' checked'; } ?> /><label for="ck_b_6">Consulting</label>
                <input id="ck_b_7" name="sch_wtypes" value="64" type="checkbox" <? if(($schWtypesR & 64) > 0) { echo ' checked'; } ?> /><label for="ck_b_7">AD</label>
            </dd>
        </dl>

        <div class="keyword_area">
            <select class="select" name="sch_gubun" id="sch_gubun">
                <option value="C" <? if($schGubun == 'C') { echo ' selected'; } ?>>회사명</option>
                <option value="T" <? if($schGubun == 'T') { echo ' selected'; } ?>>연락처</option>
                <option value="E" <? if($schGubun == 'E') { echo ' selected'; } ?>>E-Mail</option>
                <option value="M" <? if($schGubun == 'M') { echo ' selected'; } ?>>담당자</option>
            </select>
            <input class="keyword" type="text" name="sch_text" id="sch_text" value="<?= $schText ?>" />
            <a class="txt_button" href="javascript:goSearch();">검색</a>
        </div>
    </div>

</div>
</form>

<div class="section">
<!-- 상단 영역 -->
<div class="area_top">
    <div class="left">
        <select class="select" name="rcpp" onchange="changeRcpp(this);">
            <option value="10" <? if($rowCountPerPage == '10') echo ' selected'; ?>>10개씩보기</option>
            <option value="20" <? if($rowCountPerPage == '20') echo ' selected'; ?>>20개씩보기</option>
            <option value="50" <? if($rowCountPerPage == '50') echo ' selected'; ?>>50개씩보기</option>
            <option value="100" <? if($rowCountPerPage == '100') echo ' selected'; ?>>100개씩보기</option>
        </select>
    </div>
    <div class="right">
        <?  if(($keeper->getMenu2() & 32) > 0) {  ?><a class="txt_button" href="javascript:del_checked();">삭제</a><? } ?>
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
<?
$arrASC = explode('^', $orderDirS);
$a1 = ($arrASC[0] == 'f') ? 'asc' : 'desc';
$a2 = ($arrASC[1] == 'f') ? 'asc' : 'desc';
$a3 = ($arrASC[2] == 'f') ? 'asc' : 'desc';
$a4 = ($arrASC[3] == 'f') ? 'asc' : 'desc';
$a5 = ($arrASC[4] == 'f') ? 'asc' : 'desc';
$a6 = ($arrASC[5] == 'f') ? 'asc' : 'desc';
$a7 = ($arrASC[6] == 'f') ? 'asc' : 'desc';
?>
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
            <th><a class="<?= $a1 ?>" id="o1" href="javascript:orderb('regdate', 'o1', 0);">No</a></th>
            <th><span class="hide">아이콘</span></th>
            <th><a class="<?= $a2 ?>" id="o2" href="javascript:orderb('company_name', 'o2', 1);">회사명</a></th>
            <th><a class="<?= $a3 ?>" id="o3" href="javascript:orderb('contact_tel', 'o3', 2);">연락처</a></th>
            <th><a class="<?= $a4 ?>" id="o4"  href="javascript:orderb('email', 'o4', 3);">E-Mail</a></th>
            <th><a class="<?= $a5 ?>" id="o5" href="javascript:orderb('types', 'o5', 4);">문의항목</a></th>
            <th><a class="<?= $a6 ?>" id="o6" href="javascript:orderb('manager_name', 'o6', 5);">담당자</a></th>
            <th><a class="<?= $a7 ?>" id="o7" href="javascript:orderb('regdate', 'o7', 6);">문의일</a></th>
        </tr>
        </thead>
        <tbody>
<?
// 권한에서 리스트 권한이 있는 경우에만 출력됨
if(($keeper->getMenu2() & 2) > 0) {


$totalCnt = $requestsServiceImpl->listsCount($conn, $wParam);
$result = $requestsServiceImpl->lists($conn, $wParam, $orderBy, $orderDir, $curPage, $rowCountPerPage);

if($totalCnt > 0) {
    $bPage = $totalCnt - (($curPage - 1) * $rowCountPerPage) + 1;
    $idx = 0;
    while($row = mysql_fetch_array($result)) {
        $bPage--;

        // 유형선택을 문자열로 변경
        $wtypes = (int) $row['types'];
        $strWT = '';

        if(($wtypes & 1) == 1) {
            $strWT .= 'Project, ';
        }
        if(($wtypes & 2) == 2) {
            $strWT = $strWT.'Promotion, ';
        }
        if(($wtypes & 4) == 4) {
            $strWT = $strWT.'UX/UI, ';
        }
        if(($wtypes & 8) == 8) {
            $strWT = $strWT.'Mobile, ';
        }
        if(($wtypes & 16) == 16) {
            $strWT = $strWT.'Offer, ';
        }
        if(($wtypes & 32) == 32) {
            $strWT = $strWT.'Consulting, ';
        }
        if(($wtypes & 64) == 64) {
            $strWT = $strWT.'AD, ';
        }

        // 마지막에 붙는 쉼표는 삭제
        $strWT = substr($strWT, 0, -2);

        $idx = $row['id'];
?>
        <tr>
            <td class="check"><input type="checkbox" id="check_v" name="check_v" value="<?= $row['id'] ?>" /></td>
            <td><?= $bPage ?></td>
            <td>
                <? if($row['original_filename'] != "") { ?>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <? } ?>
                <? if($row['is_old'] < IS_OLD_TERM) { ?><img src="./images/new-message.png" alt="신규항목" title="신규항목" /><? } ?>
            </td>
            <td class="company"><? if(($keeper->getMenu2() & 4) > 0) { ?><a href="javascript:goDetail('<?= $idx ?>');"><?= $row['company_name'] ?></a><? } else { ?><?= $row['company_name'] ?><? } ?></td>
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
            //echo '<a class="direction" href="'.$_SERVER[PHP_SELF].'?wParam='.$wParam.'&orerBy=&curPage='.($curPage-1).'&rcpp='.$rowCountPerPage.'"><span>‹</span> 이전페이지</a>';
            echo "<a class='direction' href='javascript:goPaging(".($curPage-1).",".$rowCountPerPage.");'><span>‹</span> 이전페이지</a>";
        } else {
            echo '<span>‹</span> 이전페이지';
        }

        $strPage = '';
        for($k = 1; $k <= $totalPage; $k++) {
            if($curPage == $k) {
                $strPage = '<a href=><strong>'.$k.'</strong></a>';
            } else {
                //$strPage = '<a href="'.$_SERVER[PHP_SELF].'?wParam='.$wParam.'&orderBy=&curPage='.$k.'&rcpp='.$rowCountPerPage.'">'.$k.'</a>';
                $strPage = "<a href='javascript:goPaging(".$k.",".$rowCountPerPage.");'>".$k."</a>";
            }

            // 1, 2, 3, 4, 5, 6 ...
            echo $strPage;
        }

        // Next block
        if($curPage < $totalPage) {
            //echo '<a class="direction" href="'.$_SERVER[PHP_SELF].'?wParam='.$wParam.'&orderBy=&curPage='.($curPage+1).'&rcpp='.$rowCountPerPage.'">다음페이지 <span>›</span></a>';
            echo "<a class='direction' href='javascript:goPaging(".($curPage+1).",".$rowCountPerPage.");'>다음페이지 <span>›</span></a>";
        } else {
            echo '다음페이지 <span>›</span>';
        }
        ?>
        <!-- //페이징 -->
    </div>

<?
}
?>
<!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
