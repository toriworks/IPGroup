<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */
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
        enroll_form = function() {
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

            work_form.action = "./work_write_post.php";
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
            <div class="right">
                <a class="txt_button" href="javascript:history.back();">취소</a>
                <a class="txt_button" href="javascript:enroll_form();">등록</a>
            </div>
        </div>
<form name="work_form" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="is_shop" value= "" />
    <input type="hidden" name="thumb_types" value="" />
    <input type="hidden" name="wtypes" value="" />
    <input type="hidden" name="work_attach_cnt" value="1" />
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
                                <input name="is_shop_t" id="r1_1" class="i_radio" value="Y" type="radio" checked /><label for="r1_1">YES</label>
                                <input name="is_shop_t" id="r1_2" class="i_check" value="N" type="radio" /><label for="r1_2">NO</label>
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
                                <input name="thumb_types_t" id="r2_1" class="i_radio" value="1" type="radio" checked /><label for="r2_1">1단</label>
                                <input name="thumb_types_t" id="r2_2" class="i_radio" value="2" type="radio" /><label for="r2_2">2단</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row"><label for="thumb_title">썸네일 제목</label></th>
                        <td class="val">
                            <div class="item">
                                <input id="thumb_title" name="thumb_title" class="i_text" type="text" value="" style="width:550px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row"><label for="thumb_subtitle">썸네일 부제목</label></th>
                        <td class="val">
                            <div class="item">
                                <input id="thumb_subtitle" name="thumb_sub_title" class="i_text" type="text" value="" style="width:550px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row"><label for="date_open">오픈일</label></th>
                        <td class="val">
                            <div class="item">
                                <input id="date_open" name="open_date" class="i_text" type="text" value="" style="width:70px;" />
                                <script type="text/javascript">
                                    set_datepicker({ altField:'#date_open' });
                                    $('#date_open').datepicker('setDate','0');
                                </script>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row"><label for="f1_1">썸네일 첨부 1단</label></th>
                        <td class="val">
                            <div class="item">
                                <input id="f1_1" name="thumb_attach1" class="i_file" type="file" value="" style="width:400px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row"><label for="f1_2">썸네일 첨부 2단</label></th>
                        <td class="val">
                            <div class="item">
                                <input id="f1_2" name="thumb_attach2" class="i_file" type="file" value="" style="width:400px;" />
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
                                <input id="k1_1" name="wtypes_t" class="i_check" value="1" type="checkbox" checked /><label for="k1_1">Project</label>
                                <input id="k1_2" name="wtypes_t" class="i_check" value="2" type="checkbox" /><label for="k1_2">Promotion</label>
                                <input id="k1_3" name="wtypes_t" class="i_check" value="4" type="checkbox" /><label for="k1_3">UX/UI</label>
                                <input id="k1_4" name="wtypes_t" class="i_check" value="8" type="checkbox" /><label for="k1_4">Mobile</label>
                                <input id="k1_5" name="wtypes_t" class="i_check" value="16" type="checkbox" /><label for="k1_5">Offer</label>
                                <input id="k1_6" name="wtypes_t" class="i_check" value="32" type="checkbox" /><label for="k1_6">Consulting</label>
                                <input id="k1_7" name="wtypes_t" class="i_check" value="64" type="checkbox" /><label for="k1_7">AD</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row"><label for="detail_project">프로젝트명</label></th>
                        <td class="val">
                            <div class="item">
                                <input id="detail_project" name="pname" class="i_text" type="text" value="" style="width:550px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row"><label for="detail_client">클라이언트</label></th>
                        <td class="val">
                            <div class="item">
                                <input id="detail_client" name="client_name" class="i_text" type="text" value="" style="width:550px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row">프로젝트 기간</th>
                        <td class="val">
                            <div class="item">
                                <input id="date_from" name="start_date" class="i_text date" type="text" style="width:70px;" value="" />
                                ~
                                <input id="date_to" name="end_date" class="i_text date" type="text" style="width:70px;" value="" />
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
                                <input id="detail_url" name="url" class="i_text" type="text" value="" style="width:550px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="tit" scope="row"><label for="detail_contents">내용설명</label></th>
                        <td class="val">
                            <div class="item">
                                <textarea id="detail_contents" name="descriptions" class="i_text" name="" id="" cols="96" rows="10"></textarea>
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
                                        document.forms.work_form.work_attach_cnt.value = parseInt(document.forms.work_form.work_attach_cnt.value) + 1;

                                        c.append('<input id="f2_'+(n+1)+'" class="i_file" type="file" name="work_attach'+(n+1)+'" value="" style="width:400px;" />');
                                        return false;
                                    });
                                </script>

                                <input id="f2_1" name="work_attach1" class="i_file" type="file" value="" style="width:400px;" /><br />
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
