<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 31
 * Time: 오후 5:21
 */

require_once('./auth.php');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');
require_once('../classes/domain/Attaches.php');

require_once('../classes/dao/KeeperDaoImpl.php');
require_once('../classes/service/KeeperServiceImpl.php');
require_once('../classes/domain/Keeper.php');

$conn = ConnectionFactory::create();
$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);

// 파라미터 설정
$ref_id = 'CPI-000001';
$stypes = 'A1';
$mtypes = 'CI';

$attachesObj = new Attaches();
$attachesObj->setRefId($ref_id);
$attachesObj->setStypes($stypes);
$attachesObj->setMtypes($mtypes);

$result = $attachesServiceImpl->detail($conn, $attachesObj);
$row = @mysql_fetch_array($result);

// 파일명 얻기
$original_filename = '';
$transfer_filename = '';
if($row != null) {
    $original_filename = $row['original_filename'];
    $transfer_filename = $row['transfer_filename'];
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
        enroll_ci = function() {
            var ci_form = document.forms.ci_form;
            var attache_file = ci_form.file_attach.value;
            if("" == attache_file) {
                alert("첨부파일" + PLZ_SELECT);
                return;
            }

            ci_form.action = "company_introduction_post.php";
            ci_form.submit();
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
            <? if(($keeper->getMenu1() & 1) > 0) { ?><li><a href="work_list.php">Work</a></li><? } ?>
            <? if(($keeper->getMenu2() & 1) > 0) { ?><li><a href="request_list.php">Request</a></li><? } ?>
            <? if(($keeper->getMenu3() & 1) > 0) { ?><li><a href="recruit_list.php">Recruit</a></li><? } ?>
            <? if(($keeper->getMenu4() & 1) > 0) { ?><li><a href="job_posting_list.php">Job Posting</a></li><? } ?>
            <? if(($keeper->getMenu5() & 1) > 0) { ?><li class="active"><a href="company_introduction.php">Company Introduction</a></li><? } ?>
            <? if(($keeper->getMenu6() & 1) > 0) { ?><li><a href="member_list.php">Member</a></li><? } ?>
        </ul>
    </div>

    <div id="admin_contents">
        <div class="page_top">
            <h2>Company Introduction</h2>
        </div>
        <div class="container">
            <!-- 본문 영역 -->

            <div class="section">
                <h3>회사소개서 관리</h3>
                <div class="form_table">
                    <table class="tbl" border="1" cellspacing="0">
                        <colgroup>
                            <col width="15%" />
                            <col width="85%" />
                        </colgroup>
                        <tbody>
                        <tr>
                            <th class="tit" scope="row"><label for="f1_2">회사소개서</label></th>
                            <td class="val">
                                <div class="item">
                                    <form name="ci_form" id="ci_form" action="" method="post" enctype="multipart/form-data">
                                    <input id="f1_2" class="i_file" type="file" value="" name="file_attach" style="width:400px;" />
                                    </form>
                                    <p class="savefile">
                                        <span class="file_name"><strong>현재파일 : </strong> <?= $original_filename ?></span>
                                        <?
                                        if($original_filename != '') {
                                        ?>
                                        <a class="file_view" href="/uploaded/introduction/<?= $row['transfer_filename'] ?>" target="_blank" title="새창">[다운로드]</a>
                                        <?
                                        }
                                        ?>
                                    </p>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="button_area">
                    <div class="center">
                        <? if(($keeper->getMenu5() & 8) > 0) { ?><a class="txt_button" href="javascript:enroll_ci();">등록하기</a><? } ?>
                    </div>
                </div>
            </div>

            <!-- //본문 영역 -->
        </div>
    </div>

</div>

</body>
</html>
