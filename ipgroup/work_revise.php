<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 28
 * Time: 오전 11:21
 */

require_once('./auth.php');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/WorkDaoImpl.php');
require_once('../classes/service/WorkServiceImpl.php');
require_once('../classes/domain/Work.php');

require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');


$conn = ConnectionFactory::create();
$workDaoImpl = new WorkDaoImpl();
$workServiceImpl = new WorkServiceImpl();
$workServiceImpl->setWorkDao($workDaoImpl);

$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);


// get parameters
$work_id = $_REQUEST['work_id'];
$orderBy = $_REQUEST['order_by'];
$orderDir = $_REQUEST['order_dir'];
$wParam = $_REQUEST['wParam'];

// get detail informations
$workObj = new Work();
$workObj->setId($work_id);

$result = $workServiceImpl->detail($conn, $workObj);
$row = @mysql_fetch_array($result);


// get file attaches
$result2 =  $attachesServiceImpl->lists($conn, $work_id);


// 오픈일 날짜 조합
$oy = $row['open_date_y'];
$om = $row['open_date_m'];
$od = $row['open_date_d'];

$open_date = ($oy != '') ? $oy.'.'.$om.'.'.$od : '';


// 프로젝트 시작,종료 날짜 조합
$sy = $row['start_date_y'];
$sm = $row['start_date_m'];
$sd = $row['start_date_d'];

$start_date = ($oy != '') ? $sy.'.'.$sm.'.'.$sd : '';

$ey = $row['end_date_y'];
$em = $row['end_date_m'];
$ed = $row['end_date_d'];

$end_date = ($oy != '') ? $ey.'.'.$em.'.'.$ed : '';


// 유형선택을 문자열로 변경
$wtypes = (int) $row['wtypes'];
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
        del_attach = function(wi, st, mt) {
            if(confirm("첨부파일을 삭제하시겠습니까?")) {
                // normal situation
                $.ajax({
                    type : "POST",
                    async : true,
                    url : "./process.php",
                    data : "call_type=del_attach&work_id=" + wi + "&stypes=" + st + "&mtypes=" + mt,
                    dataType : "html",
                    success : onSuccess,
                    error : onError
                });
            } else {
                return;
            }
        }

        onSuccess = function(data) {
            var jsonObj = JSON.parse(data);
            var ret = "" + jsonObj.ipg.result;
            if(ret != "") {
                var iRet = parseInt(ret);
                if(iRet == 1) {

                } else {
                    alert(ERROR_DELFILE);
                }
            }
        }

        var onError = function(request, status, error) {
            // network error
            alert(ERROR_NETWORK);
        };

        del_data = function(wi) {
            if(confirm(CONFIRM_DELETE)) {
                location.href = "./work_delete_post.php?work_id=" + wi;
            } else {
                return;
            }
        }

        update_form = function() {
            var work_form = document.forms.work_form;

            // 전시여부
            for(var i=0; i<2; i++) {
                if(work_form.is_shop_t[i].checked == true) {
                    work_form.is_shop.value = work_form.is_shop_t[i].value;
                }
            }

            // 썸네일 유형
            for(var j=0; j<2; j++) {
                if(work_form.thumb_types_t[j].checked == true) {
                    work_form.thumb_types.value = work_form.thumb_types_t[j].value;
                }
            }

            // 제목
            if(work_form.thumb_title.value == "") {
                alert("썸네일 제목" + PLZ_INPUT);
                return;
            }

            // 유형
            var wtv = 0;
            for(var k=0; k<7; k++) {
                if(work_form.wtypes_t[k].checked == true) {
                    wtv = wtv + parseInt("" + work_form.wtypes_t[k].value);
                }
            }
            work_form.wtypes.value = wtv;

            // 프로젝트명
            if(work_form.pname.value == "") {
                alert("프로젝트명" + PLZ_INPUT);
                return;
            }

            // 클라이언트
            if(work_form.client_name.value == "") {
                alert("클라이언트" + PLZ_INPUT);
                return;
            }

            work_form.action = "./work_revise_post.php";
            work_form.submit();
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

<div id="admin_contents">
<div class="page_top">
    <h2>Work</h2>
</div>
<div class="container">
<!-- 본문 영역 -->

<div class="button_area">
    <div class="left">
        <a class="txt_button" href="javascript:del_data('<?=  $work_id ?>');">삭제하기</a>
    </div>
    <div class="right">
        <a class="txt_button" href="javascript:history.back();">취소</a>
        <a class="txt_button" href="javascript:update_form();">수정완료</a>
    </div>
</div>
<form name="work_form" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="is_shop" value= "<?= $row['is_shop'] ?>" />
<input type="hidden" name="thumb_types" value="<?= $row['thumb_types'] ?>" />
<input type="hidden" name="wtypes" value="<?= $row['wtypes'] ?>" />
<input type="hidden" name="work_attach_cnt" value="1" />
<input type="hidden" name="work_id" value="<?= $work_id ?>" />
<div class="section">
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="85%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">전시여부</th>
                <td class="val">
                    <div class="item">
                        <input id="r1_1" name="is_shop_t" class="i_radio" value="Y" type="radio" <? if($row['is_shop'] == 'Y') echo ' checked'; ?> /><label for="r1_1">YES</label>
                        <input id="r1_2" name="is_shop_t" class="i_radio" value="N" type="radio" <? if($row['is_shop'] == 'N') echo ' checked'; ?> /><label for="r1_2">NO</label>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section">
    <h3>썸네일 등록</h3>
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="85%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">썸네일 유형</th>
                <td class="val">
                    <div class="item">
                        <input name="thumb_types_t" id="r2_1" class="i_radio" value="1" type="radio"  <? if($row['thumb_types'] == '1') echo ' checked'; ?> /><label for="r2_1">1단</label>
                        <input name="thumb_types_t" id="r2_2" class="i_radio" value="2" type="radio"  <? if($row['thumb_types'] == '2') echo ' checked'; ?> /><label for="r2_2">2단</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="thumb_title">썸네일 제목</label></th>
                <td class="val">
                    <div class="item">
                        <input id="thumb_title" name="thumb_title" class="i_text" type="text" value="<?= $row['thumb_title'] ?>" style="width:550px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="thumb_subtitle">썸네일 부제목</label></th>
                <td class="val">
                    <div class="item">
                        <input id="thumb_subtitle" name="thumb_sub_title" class="i_text" type="text" value="<?= $row['thumb_sub_title'] ?>" style="width:550px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="date_open">오픈일</label></th>
                <td class="val">
                    <div class="item">
                        <input id="date_open" class="i_text" name="open_date" type="text" value="<?= $open_date ?>" style="width:70px;" />
                        <script type="text/javascript">
                            set_datepicker({ altField:'#date_open' });
                        </script>
                    </div>
                </td>
            </tr>
<?
$ta1 = ''; $ta2 = '';
$ta1_transfer = ''; $ta2_transfer = '';
while($row2 = mysql_fetch_array($result2)) {

    if($row2['stypes'] == 'T1') {
        $ta1 = $row2['original_filename'];
        $ta1_transfer = $row2['transfer_filename'];
    } else if($row2['stypes'] == 'T2') {
        $ta2 = $row2['original_filename'];
        $ta2_transfer = $row2['transfer_filename'];
    }
}
?>
            <tr>
                <th class="tit" scope="row"><label for="f1_1">썸네일 첨부 1단</label></th>
                <td class="val">
                    <div class="item">
                        <input id="f1_1" class="i_file" type="file" value="" style="width:400px;" />
                        <p class="savefile">
                            <span class="file_name"><strong>현재파일 : </strong><?= ($ta1 != "") ? $ta1 : "" ?></span>
                            <? if($ta1_transfer != "") { ?><a href="/uploaded/work/<?= $ta1_transfer ?>" class="file_view" target="_blank">[보기]</a><? } ?>
                            <? if($ta1_transfer != "") { ?><a class="file_dele" href="javascript:del_attach('<?= $work_id ?>', 'T1', 'WK');">[삭제]</a><? } ?>
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="f1_2">썸네일 첨부 2단</label></th>
                <td class="val">
                    <div class="item">
                        <input id="f1_2" class="i_file" type="file" value="" style="width:400px;" />
                        <p class="savefile">
                            <span class="file_name"><strong>현재파일 : </strong><?= ($ta2 != "") ? $ta2 : "" ?></span>
                            <? if($ta2_transfer != "") { ?><a href="/uploaded/work/<?= $ta2_transfer ?>" class="file_view" target="_blank">[보기]</a><? } ?>
                            <? if($ta2_transfer != "") { ?><a class="file_dele" href="javascript:del_attach('<?= $work_id ?>', 'T2', 'WK');">[삭제]</a><? } ?>
                        </p>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section">
    <h3>상세 등록</h3>
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="85%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">유형선택</th>
                <td class="val">
                    <div class="item">
                        <input id="k1_1" class="i_check" name="wtypes_t" value="1" type="checkbox" <? if(($row['wtypes'] & 1) == 1) echo ' checked'; ?> /><label for="k1_1">Project</label>
                        <input id="k1_2" class="i_check" name="wtypes_t" value="2" type="checkbox" <? if(($row['wtypes'] & 2) == 2) echo ' checked'; ?> /><label for="k1_2">Promotion</label>
                        <input id="k1_3" class="i_check" name="wtypes_t" value="4" type="checkbox" <? if(($row['wtypes'] & 4) == 4) echo ' checked'; ?> /><label for="k1_3">UX/UI</label>
                        <input id="k1_4" class="i_check" name="wtypes_t" value="8" type="checkbox" <? if(($row['wtypes'] & 8) == 8) echo ' checked'; ?> /><label for="k1_4">Mobile</label>
                        <input id="k1_5" class="i_check" name="wtypes_t" value="16" type="checkbox" <? if(($row['wtypes'] & 16) == 16) echo ' checked'; ?> /><label for="k1_5">Offer</label>
                        <input id="k1_6" class="i_check" name="wtypes_t" value="32" type="checkbox" <? if(($row['wtypes'] & 32) == 32) echo ' checked'; ?> /><label for="k1_6">Consulting</label>
                        <input id="k1_7" class="i_check" name="wtypes_t" value="64" type="checkbox" <? if(($row['wtypes'] & 64) == 64) echo ' checked'; ?> /><label for="k1_7">AD</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="detail_project">프로젝트명</label></th>
                <td class="val">
                    <div class="item">
                        <input id="detail_project" class="i_text" name="pname" type="text" value="<?= $row['name'] ?>" style="width:550px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="detail_client">클라이언트</label></th>
                <td class="val">
                    <div class="item">
                        <input id="detail_client" name="client_name" class="i_text" type="text" value="<?= $row['client_name'] ?>" style="width:550px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">프로젝트 기간</th>
                <td class="val">
                    <div class="item">
                        <input id="date_from" class="i_text date" name="start_date" type="text" style="width:70px;" value="<?= $start_date ?>" />
                        ~
                        <input id="date_to" class="i_text date" name="end_date" type="text" style="width:70px;" value="<?= $end_date ?>" />
                        <script type="text/javascript">
                            init_from_to_date2();
                        </script>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="detail_url">URL</label></th>
                <td class="val">
                    <div class="item">
                        <input id="detail_url" class="i_text" name="url" type="text" value="<?= $row['url'] ?>" style="width:550px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="detail_contents">내용설명</label></th>
                <td class="val">
                    <div class="item">
                        <textarea id="detail_contents" class="i_text" name="descriptions" id="" cols="96" rows="10"><?= $row['descriptions'] ?></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="f2_1">첨부파일</label></th>
                <td class="val">

                    <div class="item">
                        <a class="txt_button detail_file_add" href="#">추가</a>
                        <script type="text/javascript">
                            $('.detail_file_add').bind('click',function(){
                                var c = $(this).parents('.item');
                                var n = c.find('input[type="file"]').length;
                                c.append('<input id="f2_'+(n+1)+'" class="i_file" type="file" name="detail_file_'+(n+1)+'" value="" style="width:400px;" />');

                                return false;
                            });
                        </script>
<?
$wa = ''; $wa_t = '';
mysql_data_seek($result2, 0);
$idx = 1;
while($row3 = mysql_fetch_array($result2)) {
    if($row3['stypes'] != 'T1' && $row3['stypes'] != 'T2') {
        $wa = $row3['original_filename'];
        $wa_t = $row3['transfer_filename'];
?>
                        <input id="f2_1" class="i_file" type="file" name="work_attach<?= $idx ?>" value="" style="width:400px;" /><br />
                        <p class="savefile">
                            <span class="file_name"><strong>현재파일 : </strong><?= ($wa != "") ? $wa : "" ?></span>
                            <? if($wa_t != "") { ?><a class="file_view" href="/uploaded/work/<?= $wa_t ?>" target="_blank">[보기]</a><? } ?>
                            <a class="file_dele" href="#">[삭제]</a>
                        </p>
    <?
    }
}
?>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</form>

<!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
