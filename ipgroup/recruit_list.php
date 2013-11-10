<?php
/**
 * Created by IntelliJ IDEA.
 * User: toriworks
 * Date: 2013. 10. 30.
 * Time: 오전 12:45
 * To change this template use File | Settings | File Templates.
 */

require_once('./auth.php');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/ApplicantsDaoImpl.php');
require_once('../classes/service/ApplicantsServiceImpl.php');
require_once('../classes/domain/Applicants.php');

require_once('../classes/utils/CommonUtils.php');


$conn = ConnectionFactory::create();
$applicantsDaoImpl = new ApplicantsDaoImpl();
$applicantsServiceImpl = new ApplicantsServiceImpl();
$applicantsServiceImpl->setApplicantsDao($applicantsDaoImpl);

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
    $orderDirS = 'f^f^f^f^f^f^f^f^f^';
}

$curPage = $_REQUEST['curPage'];
if($curPage == '') {
    $curPage = 1;
}

// 검색조건
$schPeriod = $_REQUEST['sch_period'];
$schDateType = $_REQUEST['sch_date_type'];
$schDateFrom = $_REQUEST['sch_date_from'];
$schDateTo = $_REQUEST['sch_date_to'];
$schCareerTypesR = (int) ('0' + $_REQUEST['sch_career_types_r']);
$schSchoolTypesR = (int) ('0' + $_REQUEST['sch_school_types_r']);
$schStatusR = (int) ('0' + $_REQUEST['sch_status_r']);
$schGubun = $_REQUEST['sch_gubun'];
$schText = $_REQUEST['sch_text'];

// 조건절 구성
$wParam = '';
if($schPeriod == 'Y') {
    $wParam .= " AND (regdate >= '".$schDateFrom."' AND regdate <= '".$schDateTo."') ";
}

// 경력
if($schCareerTypesR > 0) {
    if($schCareerTypesR == 1) {
        $wParam .= " AND carrer_types='N' ";
    } else if($schCareerTypesR == 2) {
        $wParam .= " AND carrer_types='Y' ";
    } else if($schCareerTypesR == 3) {
        $wParam .= " AND (carrer_types='N' OR career_types='Y') ";
    }
}

// 학력
if($schSchoolTypesR > 0) {

}

// 검색어
if($schText != '') {
    if($schGubun == 'K') {
        $wParam .= " AND kor_name LIKE '%".$schText."%' ";
    } else if($schGubun == 'C') {
        $wParam .= " AND client_name LIKE '%".$schText."%' ";
    } else {
        $wParam .= " AND email LIKE '%".$schText."%' ";
    }
}


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
                location.href = "./recruit_delete_post.php?ids=" + sChecked;
            } else {
                return;
            }
        }

        goSearch = function() {
            var form = document.forms.sch_form;

            var sch_period = form.sch_period.checked;
            var sch_date_from = form.sch_date_from.value;
            var sch_date_to = form.sch_date_to.value;

            // 경력
            var sch_career_types = 0;
            for(var k=0; k<2; k++) {
                if(form.career_types[k].checked == true) {
                    sch_career_types += parseInt(form.career_types[k].value);
                }
            }
            form.sch_career_types_r.value = sch_career_types;

            // 학력
            var sch_school_type = 0;
            for(var k=0; k<4; k++) {
                if(form.school_type[k].checked == true) {
                    sch_school_type += parseInt(form.school_type[k].value);
                }
            }
            form.sch_school_types_r.value = sch_school_type;

            // 상태
            var sch_status = 0;
            for(var k=0; k<4; k++) {
                if(form.sch_status[k].checked == true) {
                    sch_status += parseInt(form.sch_status[k].value);
                }
            }
            form.sch_status_r.value = sch_status;

            var sch_gubun = '';
            for(var a=0; a<3; a++) {
                if(form.sch_gubun[a].selected == true) {
                    sch_gubun = form.sch_gubun[a].value;
                }
            }
            var sch_text = form.sch_text.value;
            form.submit();
        }

        orderb = function(ids, idt, idx) {

            // 모두 asc로 변경함
            for(var i=0; i<9; i++) {
                document.getElementById('o' + (i+1)).className = 'asc';
            }

            var ods = '<?= $orderDirS ?>';
            var arrOds = ods.split("^");
            for(var x=0; x<9; x++) {
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
            for(var x=0; x<9; x++) {
                nOds += arrOds[x] + "^";
            }

            var form = document.forms.sch_form;
            form.curPage.value = 1;
            form.orderBy.value = ids;
            form.orderDirS.value = nOds;
            form.orderDir.value = (arrOds[idx] == 't') ? 'asc' : 'desc';
            form.submit();
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
        <li class="active"><a href="recruit_list.php">Recruit</a></li>
        <li><a href="job_posting_list.php">Job Posting</a></li>
        <li><a href="company_introduction.php">Company Introduction</a></li>
        <li><a href="member_list.php">Member</a></li>
    </ul>
</div>
<?
$totalCnt = $applicantsServiceImpl->listsCount($conn, $wParam);
$result = $applicantsServiceImpl->lists($conn, $wParam, $orderBy, $orderDir, $curPage, $rowCountPerPage);
?>
<div id="admin_contents">
<div class="page_top">
    <h2>Recruit</h2>
</div>
<div class="container">
<!-- 본문 영역 -->

    <form name="sch_form" action="<?= $_SERVER['PHP_SELF'] ?>?rcpp=<?= $rowCountPerPage ?>&curPage=<?= $curPage ?>" method="GET">
        <input type="hidden" name="rcpp" value="<?= $rowCountPerPage ?>" />
        <input type="hidden" name="curPage" value="<?= $curPage ?>" />
        <input type="hidden" name="orderBy" value="<?= $orderBy ?>" />
        <input type="hidden" name="orderDir" value="<?= $orderDir ?>" />
        <input type="hidden" name="orderDirS" value="<?= $orderDirS ?>" />
        <input type="hidden" name="id" value="" />
        <input type="hidden" name="sch_career_types_r" value="<?= $schCareerTypesR ?>" />
        <input type="hidden" name="sch_school_types_r" value="<?= $schSchoolTypesR ?>" />
        <input type="hidden" name="sch_status_r" value="<?= $schStatusR ?>" />
<div class="section">
    <div class="form_search">
        <dl>
            <dt class="t">기간선택 : </dt>
            <dd>
                <input type="checkbox" />
                지원일자
                <input id="date_from" name="sch_date_from" class="i_text date" type="text" value="<?= $schDateFrom ?>" />
                ~
                <input id="date_to" name="sch_date_to" class="i_text date" type="text" value="<?= $schDateTo ?>" />
            </dd>
            <script type="text/javascript">
                $(document).ready(function() { init_from_to_date(); });
            </script>

            <dt>경력 : </dt>
            <dd>
                <input id="ck_a_1" type="checkbox" name="career_types" value="1" /><label for="ck_a_1">신입</label>
                <input id="ck_a_2" type="checkbox" name="career_types" value="2" /><label for="ck_a_2">경력</label>
                <!--input id="ck_a_3" type="checkbox" name="career_types" value="" /><label for="ck_a_3">무관</label-->
            </dd>

            <!--dt>지원분야 : </dt>
            <dd>
                <input id="ck_b_1" type="checkbox" name="career_types" value="N" /><label for="ck_b_1">기획실</label>
                <input id="ck_b_2" type="checkbox" name="career_types" value="N" /><label for="ck_b_2">디자인실</label>
                <input id="ck_b_3" type="checkbox" name="career_types" value="N" /><label for="ck_b_3">퍼블리싱팀</label>
                <input id="ck_b_4" type="checkbox" name="career_types" value="N" /><label for="ck_b_4">경영지원팀</label>
            </dd-->

            <dt>학력 : </dt>
            <dd>
                <input id="ck_c_1" type="checkbox" name="school_types" value="1" /><label for="ck_c_1">고졸</label>
                <input id="ck_c_2" type="checkbox" name="school_types" value="2" /><label for="ck_c_2">전문대졸</label>
                <input id="ck_c_3" type="checkbox" name="school_types" value="4" /><label for="ck_c_3">대졸</label>
                <input id="ck_c_4" type="checkbox" name="school_types" value="8" /><label for="ck_c_4">무관</label>
            </dd>

            <dt>상태 : </dt>
            <dd>
                <input id="ck_d_1" type="checkbox" name="status" value="1" /><label for="ck_d_1">접수</label>
                <input id="ck_d_2" type="checkbox" name="status" value="2" /><label for="ck_d_2">심사</label>
                <input id="ck_d_3" type="checkbox" name="status" value="4" /><label for="ck_d_3">합격</label>
                <input id="ck_d_4" type="checkbox" name="status" value="8" /><label for="ck_d_4">불합격</label>
            </dd>
        </dl>

        <div class="keyword_area">
            <select class="select" name="sch_gubun" id="sch_gubun">
                <option value="K" <? if($schGubun == 'K') { echo ' selected'; } ?>>이름</option>
                <!-- option value="C" <? if($schGubun == 'C') { echo ' selected'; } ?>>연락처</option -->
                <option value="E" <? if($schGubun == 'E') { echo ' selected'; } ?>>E-Mail</option>
            </select>
            <input class="keyword" type="text" name="sch_text" id="sch_text" value="<?= $schText ?>" />
            <a class="txt_button" href="javascript:goSearch();">검색</a>
        </div>
    </div>
    </form>

</div>


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
    <col width="7%" />
    <col width="10%" />
    <col width="14%" />
    <col width="14%" />
    <col width="10%" />
    <col width="10%" />
    <col width="8%" />
    <col width="8%" />
    <col width="8%" />
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
$a8 = ($arrASC[7] == 'f') ? 'asc' : 'desc';
$a9 = ($arrASC[8] == 'f') ? 'asc' : 'desc';
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
    <th><a class="<?= $a2 ?>" id="o2" href="javascript:orderb('regdate', 'o2', 1);">이름</a></th>
    <th><a class="<?= $a3 ?>" id="o3" href="javascript:orderb('regdate', 'o3', 2);">연락처</a></th>
    <th><a class="<?= $a4 ?>" id="o4" href="javascript:orderb('regdate', 'o4', 3);">E-Mail</a></th>
    <th><a class="<?= $a5 ?>" id="o5" href="javascript:orderb('regdate', 'o5', 4);">지원분야</a></th>
    <th><a class="<?= $a6 ?>" id="o6" href="javascript:orderb('regdate', 'o6', 5);">경력</a></th>
    <th><a class="<?= $a7 ?>" id="o7" href="javascript:orderb('regdate', 'o7', 6);">학력</a></th>
    <th><a class="<?= $a8 ?>" id="o8" href="javascript:orderb('regdate', 'o8', 7);">지원일</a></th>
    <th><a class="<?= $a9 ?>" id="o9" href="javascript:orderb('regdate', 'o9', 8);">상태</a></th>
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
    <td class="check"><input type="checkbox" id="check_v" name="check_v" value="<?= $row['id'] ?>" /></td>
    <td><?= $bPage - 1 ?></td>
    <td>
        <? if($row['original_filename'] != "") { ?>
            <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <? } ?>
        <? if($row['is_old'] < IS_OLD_TERM) { ?><img src="./images/new-message.png" alt="신규항목" title="신규항목" /><? } ?>
    </td>
    <td class="name"><a href="recruit_view.php?id=<?= $row['id'] ?>&jid=<?= $row['jobs_id'] ?>"><?= $row['kor_name'] ?></a></td>
    <td><?= $row['tel_1'] ?>-<?= $row['tel_2'] ?>-<?= $row['tel_3'] ?><br />/ <?= $row['mobile_1'] ?>-<?= $row['mobile_2'] ?>-<?= $row['mobile_3'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= CommonUtils::getRecruitStatus($row['status']) ?></td>
    <td><?= CommonUtils::getCareerTypes($row['career_types']) ?></td>
    <td><?= CommonUtils::getSchoolTypes4Recruit($row['school_type']) ?></td>
    <td><?= $row['regdate'] ?></td>
    <td class="status"><span class="<?= CommonUtils::getRecruitStatusStyle($row['status']) ?>"><?= CommonUtils::getRecruitStatus($row['status']) ?></span></td>
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
