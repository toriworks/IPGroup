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

require_once('../classes/dao/ApplicantsCompanyDaoImpl.php');
require_once('../classes/service/ApplicantsCompanyServiceImpl.php');
require_once('../classes/domain/ApplicantsCompany.php');

require_once('../classes/dao/JobsDaoImpl.php');
require_once('../classes/service/JobsServiceImpl.php');
require_once('../classes/domain/Jobs.php');

require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');
require_once('../classes/domain/Attaches.php');

require_once('../classes/utils/CommonUtils.php');

$conn = ConnectionFactory::create();
$applicantsDaoImpl = new ApplicantsDaoImpl();
$applicantsServiceImpl = new ApplicantsServiceImpl();
$applicantsServiceImpl->setApplicantsDao($applicantsDaoImpl);

$jobsDaoImpl = new JobsDaoImpl();
$jobsServiceImpl = new JobsServiceImpl();
$jobsServiceImpl->setJobsDao($jobsDaoImpl);

$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);

// 지원자 회사정보
$appCDaoImpl = new ApplicantsCompanyDaoImpl();
$appCServiceImpl = new ApplicantsCompanyServiceImpl();
$appCServiceImpl->setApplicantsCompanyDao($appCDaoImpl);


// 파라미터 받기
$id = $_REQUEST['id'];
$jid = $_REQUEST['jid'];
$applicantsObj = new Applicants();
$applicantsObj->setId($id);
$applicantsObj->setJobsId($jid);


// 데이터 얻기
$result = $applicantsServiceImpl->detail($conn, $applicantsObj);
$row = @mysql_fetch_array($result);


// Job posting 정보
$jobsObj = new Jobs();
$jobsObj->setId($jid);
$jResult = $jobsServiceImpl->detail($conn, $jobsObj);
$jRow = @mysql_fetch_array($jResult);


// 회사명 얻기
$wParamC = " jobs_id='".$jid."' AND applicants_id='".$id."' ";
$orderByC = " orders ASC ";
$resultC = $appCServiceImpl->lists($conn, $wParamC, $orderByC, 1, 10);

// 첨부파일 정보
$aResult = $attachesServiceImpl->lists($conn, $id);
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
        del_checked = function() {
            var sChecked = '<?= $id ?>^';
            if(confirm("정말 삭제하시겠습니까?")) {
                location.href = "./recruit_delete_post.php?ids=" + sChecked;
            } else {
                return;
            }
        }

        save_memos = function() {
            var form = document.forms.recruit_form;
            var memos = "" + form.memos.value;

            var status = "";
            for(var i=0; i<4; i++) {
                if(form.status[i].selected == true) {
                    status = form.status[i].value;
                }
            }

            var hire_date = form.hire_date.value;
            var hire_part = form.hire_part.value;
            var hire_task = form.hire_task.value;
            var keeper_name = form.keeper_name.value;
            var keeper_contact = form.keeper_contact.value;

            var d = "call_type=save_recruit&requests_id=<?= $id ?>&memos="+memos+"&status="+status+"&hire_date="+hire_date+"&hire_part="+hire_part+"&hire_task="+hire_task;
            d = d + "&keeper_name="+keeper_name+"&keeper_contact="+keeper_contact;

            $.ajax({
                type : "POST",
                async : true,
                url : "./process.php",
                data : d,
                dataType : "html",
                success : onSuccess,
                error : onError
            });
        }

        onSuccess = function(data) {
            var jsonObj = JSON.parse(data);
            var ret = "" + jsonObj.ipg.result;
            if(ret != "") {
                var iRet = parseInt(ret);
                if(iRet == 1) {
                    alert(MSG_SAVE_SUCCESS);
                } else {
                    alert(ERROR_DELFILE);
                }
            }
        }

        var onError = function(request, status, error) {
            // network error
            alert(ERROR_NETWORK);
        };

        goList = function() {
            var form = document.sch_form;
            form.action = "recruit_list.php";
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

        goDetail = function(id, jid) {
            var form = document.sch_form;
            form.id.value = id;
            form.jid.value = jid;

            form.action = "recruit_view.php";
            form.submit();
        }

        changeRcpp = function(obj) {
            var sV = obj[obj.selectedIndex].value;

            var form = document.forms.sch_form;
            form.rcpp.value = sV;
            form.curPage.value = 1;

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

<div id="admin_contents">
<div class="page_top">
    <h2>Recruit</h2>
</div>
<div class="container">
<!-- 본문 영역 -->

<div class="button_area">
    <div class="left">
        <a class="txt_button" href="javascript:del_checked();">삭제하기</a>
    </div>
    <div class="right">
        <a class="txt_button" href="recruit_list.php">리스트 가기</a>
        <a class="txt_button" href="javascript:save_memos();">저장하기</a>
    </div>
</div>

<div class="section">
    <h3>지원 정보</h3>
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <form name="recruit_form" action="" method="post">
            <colgroup>
                <col width="15%" />
                <col width="35%" />
                <col width="15%" />
                <col width="35%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row"><label for="recruit_status">지원상태 설정</label></th>
                <td class="val">
                    <div class="item">
                        <select name="status" id="recruit_status" class="i_select">
                            <option value="A" <? if($row['status'] == 'A') echo " selected"; ?>>접수</option>
                            <option value="B" <? if($row['status'] == 'B') echo " selected"; ?>>심사중</option>
                            <option value="C" <? if($row['status'] == 'C') echo " selected"; ?>>합격</option>
                            <option value="D" <? if($row['status'] == 'D') echo " selected"; ?>>불합격</option>
                        </select>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                recruit_status_check();
                                $('#recruit_status').bind('change',function(){
                                    recruit_status_check();
                                });

                                function recruit_status_check() {
                                    if ($('#recruit_status').find('> option:selected').text() == "합격") {
                                        $('tr.recruit_pass').show();
                                    } else {
                                        $('tr.recruit_pass').hide();
                                    }
                                }
                            });
                        </script>
                    </div>
                </td>
                <th class="tit" scope="row">지원 Posting</th>
                <td class="val"><a class="posting_link" href="job_posting_view.php?jids=<?= $jid ?>" target="_blank">[<?= $jid ?>]</a></td>
            </tr>
            <!-- 지원상태가 합격인 경우 -->
            <tr class="sub recruit_pass">
                <th class="tit" scope="row"><label for="join_date">입사일자</label></th>
                <td class="val" colspan="3">
                    <div class="item">
                        <input id="join_date" class="i_text" type="text" name="hire_date" value="<?= $row['hire_date'] ?>" style="width:70px;" />
                        <script type="text/javascript">
                            set_datepicker({ altField:'#join_date' });
                            if (!$('#join_date').val()) {
                                $('#join_date').datepicker('setDate','0');
                            }
                        </script>
                    </div>
                </td>
            </tr>
            <tr class="sub recruit_pass">
                <th class="tit" scope="row"><label for="join_department">근무부서</label></th>
                <td class="val">
                    <div class="item">
                        <input id="join_department" type="text" class="i_text" name="hire_part" value="<?= $row['hire_part'] ?>" style="width:200px;" />
                    </div>
                </td>
                <th class="tit" scope="row"><label for="join_work">담당업무</label></th>
                <td class="val">
                    <div class="item">
                        <input id="join_work" type="text" class="i_text" name="hire_task" value="<?= $row['hire_task'] ?>" style="width:200px;" />
                    </div>
                </td>
            </tr>
            <tr class="sub recruit_pass">
                <th class="tit" scope="row"><label for="join_person">담당자</label></th>
                <td class="val">
                    <div class="item">
                        <input id="join_person" type="text" class="i_text" name="keeper_name" value="<?= $row['keeper_name'] ?>" style="width:200px;" />
                    </div>
                </td>
                <th class="tit" scope="row"><label for="join_person_call">담당자 연락처</label></th>
                <td class="val">
                    <div class="item">
                        <input id="join_person_call" type="text" class="i_text" name="keeper_contact" value="<?= $row['keeper_contact'] ?>" style="width:200px;" />
                    </div>
                </td>
            </tr>
            <!-- // 지원상태가 합격인 경우 -->
<?
// 경력 문자열 처리
$careerTypesS = '';
if($row['career_types'] == 'Y') {
    $careerTypesS = '경력'.$row['career_years'].'년';
} else {
    $careerTypesS = '신입';
}

// 지원분야 문자열 처리
$hirePartS = '';
$hirePartS = CommonUtils::getHirePart($jRow['hire_part']);
?>
            <tr>
                <th class="tit" scope="row">지원분야</th>
                <td class="val"><?= $hirePartS ?></td>
                <th class="tit" scope="row">경력</th>
                <td class="val"><?= $careerTypesS ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">이름</th>
                <td class="val"><?= $row['kor_name'] ?></td>
                <th class="tit" scope="row">출생년도</th>
                <td class="val"><?= $row['birth_year'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">전화번호</th>
                <td class="val"><?= $row['tel_1'] ?>-<?= $row['tel_2'] ?>-<?= $row['tel_3'] ?></td>
                <th class="tit" scope="row">휴대폰번호</th>
                <td class="val"><?= $row['mobile_1'] ?>-<?= $row['mobile_2'] ?>-<?= $row['mobile_3'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">E-Mail</th>
                <td class="val" colspan="3"><?= $row['email'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">최종학력</th>
                <td class="val" colspan="3"><?= $row['school_name'] ?> 졸업 <? if($row['school_sub'] != '') { ?>|<? } ?> <?= $row['school_sub'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">경력사항</th>
                <td class="val" colspan="3">

                    <!-- 경력사항 테이블 -->
                    <table class="career">
                        <colgroup>
                            <col width="30%" />
                            <col width="25%" />
                            <col width="15%" />
                            <col width="30%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">회사명</th>
                            <th scope="col">근속기간</th>
                            <th scope="col">직급</th>
                            <th scope="col">업무명</th>
                        </tr>
                        </thead>
                        <tbody>
<?
while($rowC = mysql_fetch_array($resultC)) {
?>
                        <tr>
                            <td class="company"><?= $rowC['company_name'] ?></td>
                            <td class="date"><?= $rowC['start_date'] ?></td>
                            <td class="rank"><?= $rowC['position'] ?></td>
                            <td class="job"><?= $rowC['descriptions'] ?></td>
                        </tr>
<?
}
?>
                        </tbody>
                    </table>

                </td>
            </tr>
<?
// 희망연봉 문자열 처리
$wishPayS = '';
if($row['wish_pay'] != '') {
    if(strpos($row['wish_pay'], '만원') == true) {
        $wishPayS = '';
    } else {
        $wishPayS = '만원';
    }
}
?>
            <tr>
                <th class="tit" scope="row">희망연봉</th>
                <td class="val" colspan="3"><span class="pay"><?= $row['wish_pay'] ?><?= $wishPayS ?></span></td>
            </tr>
            <tr>
                <th class="tit" scope="row">첨부파일</th>
                <td class="val" colspan="3">
                    <ul class="fileinfo">
<?
while($aRow = mysql_fetch_array($aResult)) {
?>
                        <li>
                            <span class="filename"><?= $aRow['original_filename'] ?></span>
                            <a href="/uploaded/recruit/<?= $aRow['transfer_filename'] ?>" target="_blank">[다운로드]</a>
                        </li>
<?
}
?>
                    </ul>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="memo_text">메모</label></th>
                <td class="val" colspan="3">
                    <div class="item">
                        <textarea id="memo_text" class="i_text" name="memos" cols="96" rows="10"><?= $row['memos'] ?></textarea>
                    </div>
                </td>
            </tr>
            </tbody>
            </form>
        </table>
    </div>
</div>

<?
// 한 페이지에서 보여줄 갯수
$rowCountPerPage = 0;
$rowCountPerPage = ($_REQUEST['rcpp'] != '') ? $_REQUEST['rcpp'] : 10;

$orderBy = $_REQUEST['orderBy'];
if ($orderBy == '') {
    $orderBy = ' regdate_r ';
}

$orderDir = $_REQUEST['orderDir'];
if ($orderDir == '') {
    $orderDir = ' DESC ';
}

$orderDirS = $_REQUEST['orderDirS'];
if ($orderDirS == '') {
    $orderDirS = 'f^f^f^f^f^f^f^f^f^';
}

$curPage = $_REQUEST['curPage'];
if ($curPage == '') {
    $curPage = 1;
}

// 검색조건
$schPeriod = $_REQUEST['sch_period'];
$schDateType = $_REQUEST['sch_date_type'];
$schDateFrom = $_REQUEST['sch_date_from'];
$schDateTo = $_REQUEST['sch_date_to'];
$schCareerTypesR = (int)('0' + $_REQUEST['sch_career_types_r']);
$schSchoolTypesR = (int)('0' + $_REQUEST['sch_school_types_r']);
$schStatusR = (int)('0' + $_REQUEST['sch_status_r']);
$schGubun = $_REQUEST['sch_gubun'];
$schText = $_REQUEST['sch_text'];

// 조건절 구성
$wParam = '';
if ($schPeriod == 'Y') {
    $wParam .= " AND (a.regdate >= '" . $schDateFrom . "' AND a.regdate <= '" . $schDateTo . "') ";
}

// 경력
if ($schCareerTypesR > 0) {
    if ($schCareerTypesR == 1) {
        $wParam .= " AND career_types='N' ";
    } else if ($schCareerTypesR == 2) {
        $wParam .= " AND career_types='Y' ";
    } else if ($schCareerTypesR == 3) {
        $wParam .= " AND (career_types='N' OR career_types='Y') ";
    }
}

// 학력
if ($schSchoolTypesR > 0) {
//$wParam .= " AND (a.school_type & ".$schSchoolTypesR.") > 0 ";
    $arrSS = array();
    if (($schSchoolTypesR & 1) > 0) {
        array_push($arrSS, 'HS');
    }
    if (($schSchoolTypesR & 2) > 0) {
        array_push($arrSS, 'CL');
    }
    if (($schSchoolTypesR & 4) > 0) {
        array_push($arrSS, 'UV');
    }
    if (($schSchoolTypesR & 8) > 0) {
        array_push($arrSS, 'NG');
    }

    $strSS = '';
    $sizeSS = count($arrSS);
    for ($i = 0; $i < $sizeSS; $i++) {
        $strSS .= "'" . $arrSS[$i] . "'";
        if ($i < $sizeSS - 1) {
            $strSS .= ",";
        }
    }

    $wParam .= " AND a.school_type IN (" . $strSS . ") ";
}

// 상태
if ($schStatusR > 0) {
    $arrSX = array();
    if (($schStatusR & 1) > 0) {
        array_push($arrSX, 'A');
    }
    if (($schStatusR & 2) > 0) {
        array_push($arrSX, 'B');
    }
    if (($schStatusR & 4) > 0) {
        array_push($arrSX, 'C');
    }
    if (($schStatusR & 8) > 0) {
        array_push($arrSX, 'D');
    }

    $strSX = '';
    $sizeSX = count($arrSX);
    for ($i = 0; $i < $sizeSX; $i++) {
        $strSX .= "'" . $arrSX[$i] . "'";
        if ($i < $sizeSX - 1) {
            $strSX .= ",";
        }
    }

    $wParam .= " AND a.status IN (" . $strSX . ") ";
}

// 검색어
if ($schText != '') {
    if ($schGubun == 'K') {
        $wParam .= " AND kor_name LIKE '%" . $schText . "%' ";
    } else if ($schGubun == 'C') {
        $wParam .= " AND client_name LIKE '%" . $schText . "%' ";
    } else {
        $wParam .= " AND email LIKE '%" . $schText . "%' ";
    }
}

$totalCnt = $applicantsServiceImpl->listsCount($conn, $wParam);
$result = $applicantsServiceImpl->lists($conn, $wParam, $orderBy, $orderDir, $curPage, $rowCountPerPage);
?>
<div class="section">
    <form name="sch_form" action="<?= $_SERVER['PHP_SELF'] ?>?rcpp=<?= $rowCountPerPage ?>&curPage=<?= $curPage ?>" method="GET">
        <input type="hidden" name="rcpp" value="<?= $rowCountPerPage ?>" />
        <input type="hidden" name="curPage" value="<?= $curPage ?>" />
        <input type="hidden" name="orderBy" value="<?= $orderBy ?>" />
        <input type="hidden" name="orderDir" value="<?= $orderDir ?>" />
        <input type="hidden" name="orderDirS" value="<?= $orderDirS ?>" />
        <input type="hidden" name="id" value="<?= $_REQUEST['id'] ?>" />
        <input type="hidden" name="jid" value="<?= $_REQUEST['jid'] ?>" />
        <input type="hidden" name="sch_career_types_r" value="<?= $schCareerTypesR ?>" />
        <input type="hidden" name="sch_school_types_r" value="<?= $schSchoolTypesR ?>" />
        <input type="hidden" name="sch_status_r" value="<?= $schStatusR ?>" />
    </form>
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
            <td><?= $bPage - 1 ?></td>
            <td>
                <? if($row['original_filename'] != "") { ?>
                    <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <? } ?>
                <? if($row['is_old'] < IS_OLD_TERM) { ?><img src="./images/new-message.png" alt="신규항목" title="신규항목" /><? } ?>
            </td>
            <td class="name"><a href="javascript:goDetail('<?= $row['id'] ?>','<?= $row['jobs_id'] ?>');"><?= $row['kor_name'] ?></a></td>
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
