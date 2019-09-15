function loginUser(){
	var e = _("email").value;
	var p = _("password").value;
	//alert(branch+school+course+county+estate+coach);
	if( e == "" || p == ""){
		//alert("Fill out all of the form data");
		_("infostatus").innerHTML = '<strong style="color:red;">Fill out all of the form data</strong>';

	} else {
		//alert(e+" and p"+p);
		
		var ajax = ajaxObj("POST", "login.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	        	var login_status = ajax.responseText.split("|");
	        	login_status1 = login_status[0];
	        	login_status2 = login_status[1];
	        	
	            if(login_status1 == "login_successful"){

		_("waitingstatus").innerHTML = '<strong style="color:#009900;">please wait ...</strong>';
		_("loginbtn").style.display = "none";
	        	alert(login_status2);
					window.location = 'index.php';

				}else if (login_status1 == "login_failed" && login_status2 == "empty_fields") {
					//alert("email and password required");
		_("infostatus").innerHTML = '<strong style="color:red;">email and password required</strong>';
				}else if (login_status1 == "login_failed" && login_status2 == "wrong_email") {
				//	alert("wrong email");
		_("infostatus").innerHTML = '<strong style="color:red;">wrong email</strong>';
				}else if (login_status1 == "login_failed" && login_status2 == "wrong_password") {
					//alert("wrong password");
		_("infostatus").innerHTML = '<strong style="color:red;">wrong password</strong>';
				}
				else{
					alert(login_status);
		_("infostatus").innerHTML = '<strong style="color:red;">UNKNOWN ERROR OCCURED ...</strong>';
				} 
	        }
        }
        ajax.send("e="+e+"&p="+p);
        
	}
}