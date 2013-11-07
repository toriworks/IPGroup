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
            <tr>
                <th class="tit" scope="row">희망연봉</th>
                <td class="val" colspan="3"><span class="pay"><?= $row['wish_pay'] ?>만원</span></td>
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
</div>
<!-- //상단 영역 -->

<!-- 데이터 테이블 -->
<div class="data_table">
    <table class="tbl" border="1" cellspacing="0">
        <colgroup>
            <col width="7%" />
            <col width="7%" />
            <col width="10%" />
            <col width="15%" />
            <col width="15%" />
            <col width="11%" />
            <col width="11%" />
            <col width="8%" />
            <col width="8%" />
            <col width="8%" />
        </colgroup>
        <thead>
        <tr>
            <th><a class="asc" href="#">No</a></th>
            <th><span class="hide">아이콘</span></th>
            <th><a class="desc" href="#">이름</a></th>
            <th><a class="desc" href="#">연락처</a></th>
            <th><a class="desc" href="#">E-Mail</a></th>
            <th><a class="desc" href="#">지원분야</a></th>
            <th><a class="desc" href="#">경력</a></th>
            <th><a class="desc" href="#">학력</a></th>
            <th><a class="desc" href="#">지원일</a></th>
            <th><a class="desc" href="#">상태</a></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>10</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>기획실</td>
            <td>신입</td>
            <td>대졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="ready">접수</span></td>
        </tr>
        <tr>
            <td>9</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>기획실</td>
            <td>신입</td>
            <td>대졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="ready">접수</span></td>
        </tr>
        <tr>
            <td>8</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><strong class="current">홍길동</strong></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>디자인실</td>
            <td>신입</td>
            <td>대졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="ready">접수</span></td>
        </tr>
        <tr>
            <td>7</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>경영지원팀</td>
            <td>경력3년</td>
            <td>전문대졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="pass">합격</span></td>
        </tr>
        <tr>
            <td>6</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>퍼블리싱팀</td>
            <td>신입</td>
            <td>고졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="fail">불합격</span></td>
        </tr>
        <tr>
            <td>5</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>기획실</td>
            <td>신입</td>
            <td>기타</td>
            <td>2012.12.25</td>
            <td class="status"><span class="fail">불합격</span></td>
        </tr>
        <tr>
            <td>4</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>기획실</td>
            <td>신입</td>
            <td>대졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="fail">불합격</span></td>
        </tr>
        <tr>
            <td>3</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>기획실</td>
            <td>신입</td>
            <td>대졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="pass">합격</span></td>
        </tr>
        <tr>
            <td>2</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>기획실</td>
            <td>신입</td>
            <td>대졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="pass">합격</span></td>
        </tr>
        <tr>
            <td>1</td>
            <td>
                <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
            </td>
            <td class="name"><a href="recruit_view.php">홍길동</a></td>
            <td>070-8730-8080<br />/ 010-1216-8888</td>
            <td>abcduser@ipgroup.co.kr</td>
            <td>기획실</td>
            <td>신입</td>
            <td>대졸</td>
            <td>2012.12.25</td>
            <td class="status"><span class="pass">합격</span></td>
        </tr>
        </tbody>
    </table>
</div>
<!-- //데이터 테이블 -->

<!-- 페이징 -->
<div class="paginate">
    <a class="direction" href="#"><span>‹</span> 이전페이지</a>
    <a href="#">11</a>
    <strong>12</strong>
    <a href="#">13</a>
    <a href="#">14</a>
    <a href="#">15</a>
    <a href="#">16</a>
    <a href="#">17</a>
    <a href="#">18</a>
    <a href="#">19</a>
    <a href="#">20</a>
    <a class="direction" href="#">다음페이지 <span>›</span></a>
</div>
<!-- //페이징 -->
</div>

<!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
