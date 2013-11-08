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
$mid = $_REQUEST['mid'];
$keeper = new Keeper();
$keeper->setId($mid);

// 데이터 얻기
$ko = $keeperServiceImpl->detail($conn, $keeper);
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
  <script type="text/javascript" src="./js/login.js"></script>
  <script type="text/javascript">
    enroll_member = function() {
      var form = document.member_form;

      if(form.id.value == '') {
        alert("접속 아이디를 입력해주십시오.");
        return;
      }

      if(form.kor_name.value == '') {
        alert("이름을 입력해주십시오.");
        return;
      }

      var mrS = '';
      for(var i=0; i<2; i++) {
        if(form.mr[i].checked == true) {
          mrS = form.mr[i].value;
        }
      }

      var atS = '';
      for(var j=0; j<3; j++) {
        if(form.auth_types_t[j].selected == true) {
          atS = form.auth_types_t[j].value;
        }
      }

      if(mrS == 'X' && atS == '') {
        alert("운영자 또는 관리자를 선택해주십시오.");
        return;
      }

      if(mrS == 'X') {
        form.auth_types.value = atS;
      } else {
        form.auth_types.value = 'Y';
      }

      // 메뉴1
      var m1 = 0;
      for(var x=0; x<6; x++) {
        if(form.menu1[x].checked == true) {
          m1 = m1 + parseInt("0" + form.menu1[x].value);
        }
      }
      var m2 = 0;
      for(var x=0; x<6; x++) {
        if(form.menu2[x].checked == true) {
          m2 = m2 + parseInt("0" + form.menu2[x].value);
        }
      }
      var m3 = 0;
      for(var x=0; x<6; x++) {
        if(form.menu3[x].checked == true) {
          m3 = m3 + parseInt("0" + form.menu3[x].value);
        }
      }
      var m4 = 0;
      for(var x=0; x<6; x++) {
        if(form.menu4[x].checked == true) {
          m4 = m4 + parseInt("0" + form.menu4[x].value);
        }
      }
      var m5 = 0;
      for(var x=0; x<4; x++) {
        if(form.menu5[x].checked == true) {
          m5 = m5 + parseInt("0" + form.menu5[x].value);
        }
      }
      var m6 = 0;
      for(var x=0; x<6; x++) {
        if(form.menu6[x].checked == true) {
          m6 = m6 + parseInt("0" + form.menu6[x].value);
        }
      }

      form.menu1_t.value = m1;
      form.menu2_t.value = m2;
      form.menu3_t.value = m3;
      form.menu4_t.value = m4;
      form.menu5_t.value = m5;
      form.menu6_t.value = m6;

      form.action = "member_revise_post.php";
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
      <li><a href="recruit_list.php">Recruit</a></li>
      <li><a href="job_posting_list.php">Job Posting</a></li>
      <li><a href="company_introduction.php">Company Introduction</a></li>
      <li class="active"><a href="member_list.php">Member</a></li>
    </ul>
  </div>

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
            <a class="txt_button" href="member_list.php">취소</a>
            <a class="txt_button" href="javascript:enroll_member();">수정하기</a>
          </div>
        </div>
        <!-- //상단 영역 -->

        <!-- 멤버 테이블 -->
        <div class="member_table">
          <table class="tbl" border="1" cellspacing="0">
            <form name="member_form" action="" method="post">
              <input type="hidden" name="id" value="<?= $mid ?>" />
              <input type="hidden" name="menu1_t" value="" />
              <input type="hidden" name="menu2_t" value="" />
              <input type="hidden" name="menu3_t" value="" />
              <input type="hidden" name="menu4_t" value="" />
              <input type="hidden" name="menu5_t" value="" />
              <input type="hidden" name="menu6_t" value="" />
              <input type="hidden" name="auth_types" value="" />
              <colgroup>
                <col width="22%" />
                <col width="13%" />
                <col width="13%" />
                <col width="13%" />
                <col width="13%" />
                <col width="13%" />
                <col width="13%" />
              </colgroup>
              <tbody>
              <tr>
                <th scope="row" class="b">접속 ID</th>
                <td colspan="6">
                  <div class="item">
                    <?= $mid ?>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="col" class="b" rowspan="2">권한정보</th>
                <td colspan="6">
                  <div class="item">
                    이름 : <input class="i_text" type="text" name="kor_name" value="<?= $ko->getKorName() ?>" style="width:100px;" />
                  </div>
                </td>
              </tr>
<?
// 권한정보 취득 (Y 면 사용자 세팅이고 나머지는 기본 세팅임)
$at = $ko->getAuthTypes();

// 메뉴
$m1 = $ko->getMenu1();
$m2 = $ko->getMenu2();
$m3 = $ko->getMenu3();
$m4 = $ko->getMenu4();
$m5 = $ko->getMenu5();
$m6 = $ko->getMenu6();
?>
              <tr>
                <td colspan="6">
                  <div class="item">
                    권한 :
                    <input id="r_setting_1" class="i_radio" type="radio" name="mr" value="X" <? if($at != 'Y') { echo ' checked'; } ?> /><label for="r_setting_1">기본 세팅</label>
                    <select class="i_select" name="auth_types_t" id="permission_setting">
                      <option value="">선택해주세요.</option>
                      <option value="0" <? if($at != 'Y' && $at == '0') { echo ' selected'; } ?>>운영자</option>
                      <option value="1" <? if($at != 'Y' && $at == '1') { echo ' selected'; } ?>>관리자</option>
                    </select>

                    <input id="r_setting_2" class="i_radio" type="radio" name="mr" value="Y" <? if($at == 'Y') { echo ' checked'; } ?>/><label for="r_setting_2">사용자 세팅</label>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="col" rowspan="2">항목</th>
                <th scope="col" colspan="6" class="c">권한</th>
              </tr>
              <tr>
                <th scope="col" class="c">게시판</th>
                <th scope="col" class="c">리스트</th>
                <th scope="col" class="c">내용보기</th>
                <th scope="col" class="c">신규등록</th>
                <th scope="col" class="c">수정</th>
                <th scope="col" class="c">삭제</th>
              </tr>
              <tr>
                <th scope="row">Work</th>
                <td class="ck"><input id="r_work_0" type="checkbox" name="menu1" value="1" <?= ($m1 & 1) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_work_1" type="checkbox" name="menu1" value="2" <?= ($m1 & 2) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_work_2" type="checkbox" name="menu1" value="4" <?= ($m1 & 4) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_work_3" type="checkbox" name="menu1" value="8" <?= ($m1 & 8) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_work_4" type="checkbox" name="menu1" value="16" <?= ($m1 & 16) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_work_5" type="checkbox" name="menu1" value="32" <?= ($m1 & 32) > 0 ? ' checked' : '' ?>/></td>
              </tr>
              <tr>
                <th scope="row">Request</th>
                <td class="ck"><input id="r_request_0" type="checkbox" name="menu2" value="1" <?= ($m2 & 1) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_request_1" type="checkbox" name="menu2" value="2"<?= ($m2 & 2) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_request_2" type="checkbox" name="menu2" value="4" <?= ($m2 & 4) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_request_3" type="checkbox" name="menu2" value="8" <?= ($m2 & 8) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_request_4" type="checkbox" name="menu2" value="16" <?= ($m2 & 16) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_request_5" type="checkbox" name="menu2" value="32" <?= ($m2 & 32) > 0 ? ' checked' : '' ?> /></td>
              </tr>
              <tr>
                <th scope="row">Recruit</th>
                <td class="ck"><input id="r_recruit_0" type="checkbox" name="menu3" value="1" <?= ($m3 & 1) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_recruit_1" type="checkbox" name="menu3" value="2" <?= ($m3 & 2) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_recruit_2" type="checkbox" name="menu3" value="4" <?= ($m3 & 4) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_recruit_3" type="checkbox" name="menu3" value="8" <?= ($m3 & 8) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_recruit_4" type="checkbox" name="menu3" value="16" <?= ($m3 & 16) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_recruit_5" type="checkbox" name="menu3" value="32" <?= ($m3 & 32) > 0 ? ' checked' : '' ?>/></td>
              </tr>
              <tr>
                <th scope="row">Job Posting</th>
                <td class="ck"><input id="r_jobposting_0" type="checkbox" name="menu4" value="1" <?= ($m4 & 1) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_jobposting_1" type="checkbox" name="menu4" value="2" <?= ($m4 & 2) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_jobposting_2" type="checkbox" name="menu4" value="4" <?= ($m4 & 4) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_jobposting_3" type="checkbox" name="menu4" value="8" <?= ($m4 & 8) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_jobposting_4" type="checkbox" name="menu4" value="16" <?= ($m4 & 16) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_jobposting_5" type="checkbox" name="menu4" value="32" <?= ($m4 & 32) > 0 ? ' checked' : '' ?> /></td>
              </tr><tr>
                <th scope="row">Company Introduction</th>
                <td class="ck"><input id="r_company_0" type="checkbox" name="menu5" value="1" <?= ($m5 & 1) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_company_1" type="checkbox" name="menu5" value="2" <?= ($m5 & 2) > 0 ? ' checked' : '' ?>/></td>
                <td class="ck"><input id="r_company_2" type="checkbox" name="menu5" value="4" <?= ($m5 & 4) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_company_3" type="checkbox" name="menu5" value="8" <?= ($m5 & 8) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"></td>
                <td class="ck"></td>
              </tr>
              <tr>
                <th scope="row">Member</th>
                <td class="ck"><input id="r_member_0" type="checkbox" name="menu6" value="1" <?= ($m6 & 1) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_member_1" type="checkbox" name="menu6" value="2" <?= ($m6 & 2) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_member_2" type="checkbox" name="menu6" value="4" <?= ($m6 & 4) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_member_3" type="checkbox" name="menu6" value="8" <?= ($m6 & 8) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_member_4" type="checkbox" name="menu6" value="16" <?= ($m6 & 16) > 0 ? ' checked' : '' ?> /></td>
                <td class="ck"><input id="r_member_5" type="checkbox" name="menu6" value="32" <?= ($m6 & 32) > 0 ? ' checked' : '' ?> /></td>
              </tr>
              </tbody>
            </form>
          </table>
        </div>

        <script type="text/javascript">
          init_permission_setting();
        </script>
        <!-- //데이터 테이블 -->

      </div>

      <!-- //본문 영역 -->
    </div>
  </div>

</div>

</body>
</html>
