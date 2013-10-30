<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 29
 * Time: 오후 4:21
 */
require_once('./auth.php');

require_once('../classes/utils/CommonUtils.php');
require_once('../classes/dao/ICommons.php');
require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/RequestsDaoImpl.php');
require_once('../classes/service/RequestsServiceImpl.php');
require_once('../classes/domain/Requests.php');

require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');
require_once('../classes/domain/Attaches.php');


$conn = ConnectionFactory::create();
$requestsDaoImpl = new RequestsDaoImpl();
$requestsServiceImpl = new RequestsServiceImpl();
$requestsServiceImpl->setRequestsDao($requestsDaoImpl);

// 파라미터 수신
$requests_id = $_REQUEST['requests_id'];

// 상제 정보 얻기
$requestsObj = new Requests();
$requestsObj->setId($requests_id);

$result = $requestsServiceImpl->detail($conn, $requestsObj);
$row = @mysql_fetch_array($result);

// 유형선택을 문자열로 변경
$wtypes = (int) $row['types'];
$strWT = CommonUtils::getProjectTypes($wtypes);
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
        String.prototype.trim = function() {
            return this.replace(/(^\s*)|(\s*$)/gi, "");
        }

        del_requests = function() {
            if(confirm(CONFIRM_DELETE)) {
                location.href = "./requests_delete_post.php?rids=<?= $requests_id ?>^";
            } else {
                return;
            }
        }

        save_memos = function() {
            var form = document.forms.requests_form;
            var memos = "" + form.memos.value;
            if(memos.trim() == "") {
                alert("메모" + PLZ_INPUT);
                return;
            }

            $.ajax({
                type : "POST",
                async : true,
                url : "./process.php",
                data : "call_type=save_memos&requests_id=<?= $requests_id ?>&memos=" + memos,
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
                    alert(MSG_SAVE_MEMOS);
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

<div class="button_area">
    <div class="left">
        <a class="txt_button" href="javascript:del_requests();">삭제하기</a>
    </div>
    <div class="right">
        <a class="txt_button" href="request_list.php">리스트 가기</a>
        <a class="txt_button" href="javascript:save_memos();">저장하기</a>
    </div>
</div>

<div class="section">
    <h3>문의 정보</h3>
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="35%" />
                <col width="15%" />
                <col width="35%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">문의일자</th>
                <td class="val"><?= $row['regdate'] ?></td>
                <th class="tit" scope="row">회사명</th>
                <td class="val"><?= $row['company_name'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">담당자</th>
                <td class="val"><?= $row['manager_name'] ?></td>
                <th class="tit" scope="row">전화번호</th>
                <td class="val"><?= $row['contact_tel'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">문의항목</th>
                <td class="val"><?= $strWT ?></td>
                <th class="tit" scope="row">휴대폰번호</th>
                <td class="val"><?= $row['contact_mobile'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">E-Mail</th>
                <td class="val" colspan="3"><?= $row['email'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">사이트 URL</th>
                <td class="val" colspan="3"><?= $row['url'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">문의 내용</th>
                <td class="val" colspan="3"><?= nl2br("".$row['descriptions']) ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">첨부파일</th>
                <td class="val" colspan="3">
<?
// 첨부파일 정보 얻기
$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);

$aresult = $attachesServiceImpl->lists($conn, $requests_id);

while($arow = mysql_fetch_array($aresult)) {
?>
                    <ul class="fileinfo">
                        <li>
                            <span class="filename"><?= $arow['original_filename'] ?></span>
                            <a href="/uploaded/request/<?= $arow['transfer_filename'] ?>" target="_blank">[다운로드]</a>
                        </li>
                    </ul>
<?
}
?>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="memo_text">메모</label></th>
                <td class="val" colspan="3">
                    <div class="item">
                        <form name="requests_form" action="" method="post">
                        <textarea id="memo_text" class="i_text" name="memos" cols="96" rows="10"><?= $row['memos'] ?></textarea>
                        </form>
                    </div>
                </td>
            </tr>
            </tbody>
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
                <col width="5%" />
                <col width="16%" />
                <col width="16%" />
                <col width="13%" />
                <col width="13%" />
                <col width="10%" />
                <col width="10%" />
            </colgroup>
            <thead>
            <tr>
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
            <tr>
                <td>10</td>
                <td>
                    <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                    <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
                </td>
                <td class="company"><a href="request_view.php">(주)아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>9</td>
                <td>
                    <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
                </td>
                <td class="company"><a href="request_view.php">(주)아이피그룹아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Mobile</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>8</td>
                <td>
                    <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                    <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
                </td>
                <td class="company"><strong class="current">(주)아이피그룹아이피그룹</strong></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project, Mobile</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>7</td>
                <td>
                    <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
                </td>
                <td class="company"><a href="request_view.php">(주)아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project, Mobile, UX/UI</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>6</td>
                <td>
                    <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                </td>
                <td class="company"><a href="request_view.php">(주)아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>5</td>
                <td>
                    <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                </td>
                <td class="company"><a href="request_view.php">(주)아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>4</td>
                <td>
                    <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
                </td>
                <td class="company"><a href="request_view.php">(주)아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project, Mobile, UX/UI, Mobile, Offer, Consulting, AD</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>3</td>
                <td></td>
                <td class="company"><a href="request_view.php">(주)아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>2</td>
                <td></td>
                <td class="company"><a href="request_view.php">(주)아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
            </tr>
            <tr>
                <td>1</td>
                <td></td>
                <td class="company"><a href="request_view.php">(주)아이피그룹</a></td>
                <td>070-8730-8080<br />/ 010-1216-8888</td>
                <td>abcduser@ipgroup.co.kr</td>
                <td>Project</td>
                <td>홍길동</td>
                <td>2012.12.25</td>
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
