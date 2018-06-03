/*------------------------------------------------------------------
 [ Login  Trigger Js]

 Project     :	Fickle Responsive Admin Template
 Version     :	1.0
 Author      : 	AimMateTeam
 URL         :   http://aimmate.com
 Support     :   aimmateteam@gmail.com
 Primary use :   Login Page
 -------------------------------------------------------------------*/
var login_fields_empty = "";
var send_once = true;
function enable_disable_login_btn(){
	if(jQuery("#user_email").val().length > 0 && jQuery("#user_password").val().length > 0)
		jQuery(".login-btn-box button").prop("disabled",false);
	else jQuery(".login-btn-box button").prop("disabled",true);	
}
function getQueryString() {
  var result = {}, queryString = location.search.slice(1),
      re = /([^&=]+)=([^&]*)/g, m;

  while (m = re.exec(queryString)) {
    result[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
  }

  return result;
}
jQuery(document).ready(function($) {
    'use strict';
    bootstrap_switch_trigger_call();
    forgo_password_view();
    login_view_submit();
	lock_view_submit();
	mine_attempt_focus();
    // Bind progress buttons and simulate loading progress
    ladda_button_call();
	jQuery("#user_email,#user_password").keyup(function(){enable_disable_login_btn();});
	enable_disable_login_btn();
});
/*** Switch Call ***/
function bootstrap_switch_trigger_call(){
    $(".switchCheckBox").bootstrapSwitch();

}
/*** Switch Call  End***/
function forgo_password_view(){
    $(".forgot-password, .login-view").click(function () {
        $('.login-form, .forgot-pass-box').slideToggle('slow');
    });


}
function login_view_submit(){
    $('#form-login').submit(function () {
        /*var setUrl = window.location.origin + '/index.html'
         window.location.assign(setUrl);*/
		if(!jQuery("#user_email").val().trim() || !jQuery("#user_password").val().trim()){
			login_fields_empty = "yes";
		}else{
			login_fields_empty = "no"		
		}
        return false;
    });
}
function lock_view_submit(){
    $('#form-lock-screen').submit(function () {
        /*var setUrl = window.location.origin + '/index.html'
         window.location.assign(setUrl);*/
		if(!jQuery("#user_email").val().trim() || !jQuery("#user_password").val().trim()){
			login_fields_empty = "yes";
		}else{
			login_fields_empty = "no"		
		}
        return false;
    });
}
function mine_attempt_focus(){
	var input_id = (jQuery("#user_email").attr("type") == "hidden")?"user_password":"user_email";
	setTimeout( function(){ try{
		d = document.getElementById(input_id);
		d.focus();
		d.select();
		} catch(e){}
	}, 200);
}
var login_return_path = "";
function ladda_button_call(){	
    Ladda.bind('button.ladda-button', {
        callback: function (instance) {			
            var progress = 0;
            var interval = setInterval(function () {
                progress = Math.min(progress + Math.random() * 0.1, 1);
                instance.setProgress(progress);
                if (progress === 1) {
                    instance.stop();
                    clearInterval(interval);
                    //Checking Login in here
					validate_user_login();
					/*if(login_fields_empty == "yes"){
						return false;
					}*/
					/*alert(login_return_path); return false;*/
					jacked_success_danger = (login_return_path.indexOf("dashboard") > -1)?'success':'error';
					jacked_msg = (login_return_path.indexOf("dashboard") > -1)?login_success_txt:login_fail_txt;
                    var jacked = humane.create({baseCls: 'humane-jackedup', addnCls: 'humane-jackedup-'+jacked_success_danger});
                    jacked.log(jacked_msg);
                    setInterval(function () {
						var user_login_url = false;
						return;
						if(window.location.search.indexOf('to_url') > -1 && 
						login_return_path.indexOf("user/login") == -1){
							getParams = getQueryString();
							user_login_url = true;
							login_return_path = window.location.href.substring(site_url.length).split('/')[0]+"/"+getParams['to_url'];
						}
                        var setUrl = site_url+login_return_path;
						if(!user_login_url)setUrl += window.location.search;
						if(send_once)
                        	window.location.assign(setUrl);
						send_once = false;
                    }, 1500);
                }
            }, 200);
        }
    });
}
function validate_user_login(){
	var path=  "";
	jQuery.ajax({
		url:site_url+"qajax/validate_login",
		type:'POST',
		async:false,
		data:"user_email="+jQuery("#user_email").val()+"&user_password="+jQuery("#user_password").val()+"&csrf_minetoken_name="+jQuery("input[name=csrf_minetoken_name]").val(),
		success:function(data){			
			//console.log(data);
			login_return_path = data;			
		}
	});
}