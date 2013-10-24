/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

var try_login = function() {
    var form = document.forms[0];
    var keeper_id = form.keeper_id.value;
    if(keeper_id == '' || keeper_id.length == 0) {
        // if user input fill with blank, no action
        return;
    }

    // normal situation
    $.ajax({
        type : "POST",
        async : true,
        url : "./process.php",
        data : "call_type=login&keeper_id=" + keeper_id,
        dataType : "html",
        success : onSuccess,
        error : onError
    });
};

var onSuccess = function(data) {
    // success event callback

};

var onError = function(request, status, error) {
    // network error
    alert(ERROR_NETWORK);
};
