$(document).ready(function(){
    $("#btn_login").removeAttr("disabled");
    //User namespace
    var users = {};
    users.check_login = function(){

        $("#btn_login").prop('disabled', true);

        var items = {};
        items.username = $('#txt_username').val();
        items.password = $('#txt_password').val();

        if(!items.username) {

            alert('กรุณาระบุชื่อผู้ใช้งาน');
            //app.alert('กรุณาระบุชื่อผู้ใช้งาน');
            $("#btn_login").removeProp("disabled");
            return false;

        }else if(!items.password) {

            alert('กรุณาระบุรหัสผ่าน');
            //app.alert('กรุณาระบุรหัสผ่าน');
            $("#btn_login").removeProp("disabled");
            return false;

        }else{
            return true;
        }
    }

    $('#txt_password').bind('keypress', function(e) {
        if(e.keyCode==13){
            users.check_login();
        }
    });

    $('#frm_login').on('submit', function(e) {
        return users.check_login();
    });
});