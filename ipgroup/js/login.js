/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

var try_login = function() {
    var form = document.forms.login_form;
    var keeper_id = form.keeper_id.value;

    if(keeper_id == '' || keeper_id.length == 0) {
        // if user input fill with blank, no action
        alert(BLANK_FILED_USER_ID);
        return;
    }

    // normal situation
    $.ajax({
        type : "POST",
        async : true,
        url : "./process.php",
        data : "call_type=login&keeper_ids=" + keeper_id,
        dataType : "html",
        success : onSuccess,
        error : onError
    });
};

var onSuccess = function(data) {
    // success event callback
    var form = document.forms[0];
    var jsonObj = JSON.parse(data);
    var ret = "" + jsonObj.ipg.result;
    if(ret != "") {
        var iRet = parseInt(ret);
        if(iRet == 1) {
            form.action = "work_list.php";
            form.submit();
        } else {
            form.keeper_id.value = "";
            alert(NOT_AUTHORIZED_USER);
        }
    }
};

var onError = function(request, status, error) {
    // network error
    alert(ERROR_NETWORK);
};

var try_logout = function() {
    if(confirm(CONFIRM_LOGOUT)) {
        $.ajax({
            type : "POST",
            async : true,
            url : "./process.php",
            data : "call_type=logout",
            dataType : "html",
            success : onSuccessOut,
            error : onError
        });
    } else {
         return;
    }
};

var onSuccessOut = function(data) {
    // success event callback
    var jsonObj = JSON.parse(data);
    var ret = "" + jsonObj.ipg.result;
    if(ret != "") {
        var iRet = parseInt(ret);
        if(iRet == 1) {
            location.href = "./redirect.php?page=login.php";
        } else {
            alert(NOT_AUTHORIZED_USER);
        }
    }
};
