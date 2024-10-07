<?php
include("config.php");
session_start();

if(isset($_SESSION["user_login"])){
		header("location: dashboard/account.php");
	}

	//unset email session first
	if(isset($_SESSION["email"])){
		unset($_SESSION["email"]);
	}
	
			
?>
	

<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
<?php require_once("metaTags.php");?>
<title>Password Reset | XeroCapitals</title>
<link rel="shortcut icon" href="images/favicon.png">

        <link rel="stylesheet" href="assets/css/dashlite.css?ver=3.2.3">
        <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=3.2.3">
      
    </head>
    <body class="nk-body bg-white npc-general pg-auth">
        <div class="nk-app-root">
            <div class="nk-main ">
                <div class="nk-wrap nk-wrap-nosidebar">
                    <div class="nk-content ">
                        <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                            <div class="brand-logo pb-4 text-center">
                                <a href="index.html" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg" src="images/logo.png" srcset="images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img logo-img-lg" src="images/logo-dark.png" srcset="images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="card card-bordered">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Forgot Password</h4>








		<!-- Google Translate - Mobile View -->
		<select class="form-control mr-5" onchange="doGTranslate(this);">
        <option value="">Change Language</option><option value="en|af">Afrikaans</option><option value="en|sq">Albanian</option><option value="en|ar">Arabic</option><option value="en|hy">Armenian</option><option value="en|az">Azerbaijani</option><option value="en|eu">Basque</option><option value="en|be">Belarusian</option><option value="en|bg">Bulgarian</option><option value="en|ca">Catalan</option><option value="en|zh-CN">Chinese (Simplified)</option><option value="en|zh-TW">Chinese (Traditional)</option><option value="en|hr">Croatian</option><option value="en|cs">Czech</option><option value="en|da">Danish</option><option value="en|nl">Dutch</option><option value="en|en">English</option><option value="en|et">Estonian</option><option value="en|tl">Filipino</option><option value="en|fi">Finnish</option><option value="en|fr">French</option><option value="en|gl">Galician</option><option value="en|ka">Georgian</option><option value="en|de">German</option><option value="en|el">Greek</option><option value="en|ht">Haitian Creole</option><option value="en|iw">Hebrew</option><option value="en|hi">Hindi</option><option value="en|hu">Hungarian</option><option value="en|is">Icelandic</option><option value="en|id">Indonesian</option><option value="en|ga">Irish</option><option value="en|it">Italian</option><option value="en|ja">Japanese</option><option value="en|ko">Korean</option><option value="en|lv">Latvian</option><option value="en|lt">Lithuanian</option><option value="en|mk">Macedonian</option><option value="en|ms">Malay</option><option value="en|mt">Maltese</option><option value="en|no">Norwegian</option><option value="en|fa">Persian</option><option value="en|pl">Polish</option><option value="en|pt">Portuguese</option><option value="en|ro">Romanian</option><option value="en|ru">Russian</option><option value="en|sr">Serbian</option><option value="en|sk">Slovak</option><option value="en|sl">Slovenian</option><option value="en|es">Spanish</option><option value="en|sw">Swahili</option><option value="en|sv">Swedish</option><option value="en|th">Thai</option><option value="en|tr">Turkish</option><option value="en|uk">Ukrainian</option><option value="en|ur">Urdu</option><option value="en|uz">Uzbek</option><option value="en|vi">Vietnamese</option><option value="en|cy">Welsh</option><option value="en|yi">Yiddish</option><option value="en|bn">Bengali</option><option value="en|bs">Bosnian</option><option value="en|ceb">Cebuano</option><option value="en|eo">Esperanto</option><option value="en|gu">Gujarati</option><option value="en|ha">Hausa</option><option value="en|hmn">Hmong</option><option value="en|ig">Igbo</option><option value="en|jw">Javanese</option><option value="en|kn">Kannada</option><option value="en|km">Khmer</option><option value="en|lo">Lao</option><option value="en|la">Latin</option><option value="en|mi">Maori</option><option value="en|mr">Marathi</option><option value="en|mn">Mongolian</option><option value="en|ne">Nepali</option><option value="en|pa">Punjabi</option><option value="en|so">Somali</option><option value="en|ta">Tamil</option><option value="en|te">Telugu</option><option value="en|yo">Yoruba</option><option value="en|zu">Zulu</option></select>
		
		<!--<div id="google_translate_element2"></div>-->

		<script type="text/javascript">
		function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
		</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


		<script type="text/javascript">
		/* <![CDATA[ */
		eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
		/* ]]> */
		</script>
		
		<!-- /Google Translate - Mobile View -->






        <div class="nk-block-des mt-2">
        <p><label label id="Etext" for="email">Reset your Password</label> <strong id="mail"></strong></p>
        </div>
        </div>
        </div>

       	<!-- errors | result -->
        <div id="Logresult"></div>
        <div id="Loginerrs"></div>



        <!-- Token Form - Success -->
        <div class="display-none" id="successCon" style="text-align:center">
        <img style="width:60px; height:60px; border-radius:50%;border:2px solid #526484" id="imgResult">
        <h3 class="text-capitalize mb-2 mt-2" id="User"></h3>

        <div id="tokenResult"></div>
        <div class="login-form" style="min-height:0px">
        <div class="form-group">
        <div class="form-control-wrap">
        <input type="text" class="form-control form-control-lg" id="token"  name="token" placeholder="Enter Token">
        </div>
        </div>
        </div>
        <div class="form-group mt-3">
        <button id="validate" class="btn btn-lg btn-primary btn-block">
        Validate Token &nbsp; <img class="display-none roll" width="15px" src="images/Aloader.gif">
        </button>
        </div>
        </div>




                <!-- reset Password Con -->
                <div id="loginform">
                <div class="form-group">
                <div class="form-control-wrap">
                <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Username or email">
                </div>
                </div>
                <div class="form-group">
                <button id="send" name="login" class="btn btn-lg btn-primary btn-block">
                Continue &nbsp; <img class="display-none roll" width="15px" src="images/Aloader.gif">
                </button>
                </div>
                </div>





                <!-- change password Form - After token validation -->
                <section id="pCon" class="display-none">
        
                <div class="form-group">
                <div class="form-control-wrap">
                <input id="password" name="password" type="password" class="form-control form-control-lg" placeholder="New password">
                </div>
                </div>

                <div class="form-group">
                <div class="form-control-wrap">
                <input id="confpassword" name="confpassword" type="password" class="form-control form-control-lg" placeholder="Confirm password">
                </div>
                </div>

                <div class="group  mt-3">
                <button id="change" name="login" class="btn btn-lg btn-primary btn-block">
                Continue &nbsp; <img class="display-none roll" width="15px" src="images/Aloader.gif">
                </button>
                </div>

                </section>
                <!-- /change password -->

                <!-- success on changed password -->
                <section style="text-align:center" id="sucOnchange" class="display-none">
                <div class='alert mb-2 bg-success-dim alert-dismissible alert-icon' data-bs-dismiss='alert'><em class='icon ni ni-security'></em>Password Updated <button class='close' data-bs-dismiss='alert'></div>
                <h5 class='logs'> Redirecting</h5> &nbsp; <img src="images/Aloader.gif">
                </section>




                <div class="text-center pt-4">
                <h6 class="overline-title overline-title-sap">
                <span>OR</span>
                </h6>
                </div>

                <div class="form-note-s2 text-center pt-2">
                <!-- Don't have an account?  -->
                <a href="login.php">
                <strong>Back to Login</strong>
                </a>
                </div>







                </div>
                </div>
                </div>
                <div class="nk-footer nk-auth-footer-full">
                <div class="container wide-lg">
                <div class="row g-3">
                <div class="col-lg-6 order-lg-last">
                <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                <li class="nav-item">
                <a class="link link-primary fw-normal py-2 px-3" href="terms.php">Terms & Condition</a>
                </li>
                <li class="nav-item">
                <a class="link link-primary fw-normal py-2 px-3" href="index.php">Home</a>
                </li>
               
              
                </ul>
                </div>
                <div class="col-lg-6">
                <div class="nk-block-content text-center text-lg-left">
                <p class="text-soft">&copy;2023 DashLite. All Rights Reserved.</p>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>

        <ul class="nk-sticky-toolbar">
            <li class="demo-settings">
                <a class="toggle tipinfo" data-target="settingPanel" href="#" title="Site Settings">
                    <em class="icon ni ni-setting-alt"></em>
                </a>
            </li>
            <li class="demo-purchase">
                <a class="tipinfo" target="_blank" href="" title="Plans">
                    <em class="icon ni ni-cart"></em>
                </a>
            </li>
        </ul>
       
        
     
        <div class="nk-demo-panel toggle-slide toggle-slide-right" data-content="settingPanel" data-toggle-overlay="true" data-toggle-body="true" data-toggle-screen="any">
            <div class="nk-demo-head">
                <h6 class="mb-0">Preview Settings</h6>
                <a class="nk-demo-close toggle btn btn-icon btn-trigger revarse mr-n2" data-target="settingPanel" href="#">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="nk-opt-panel" data-simplebar>
               
         
                <div class="nk-opt-set">
                    <div class="nk-opt-set-title">Skin Mode</div>
                    <div class="nk-opt-list col-2x">
                        <div class="nk-opt-item active" data-key="mode" data-update="light-mode">
                            <span class="nk-opt-item-bg is-light">
                                <span class="theme-light"></span>
                            </span>
                            <span class="nk-opt-item-name">Light Skin</span>
                        </div>
                        <div class="nk-opt-item" data-key="mode" data-update="dark-mode">
                            <span class="nk-opt-item-bg">
                                <span class="theme-dark"></span>
                            </span>
                            <span class="nk-opt-item-name">Dark Skin</span>
                        </div>
                    </div>
                </div>
                <div class="nk-opt-reset">
                    <a href="#" class="reset-opt-setting">Reset Setting</a>
                </div>
            </div>
        </div>
        
    
        
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bundle.js?ver=3.2.3"></script>
        <script src="assets/js/scripts.js?ver=3.2.3"></script>
       





<script>
$(document).ready(function(){



	//RESET
	$('button#send').click(function(){
	
	let reset = "reset";
	let email = $('input#email').val();
	if(email ==''){
	

	$('div#Loginerrs').fadeIn().html('<div class="alert mb-2 bg-danger-dim alert-dismissible alert-icon" data-bs-dismiss="alert"><em class="icon ni ni-alert"></em>Enter your Email<button class="close" data-bs-dismiss="alert"></div>');
	
	$('input#email').focus();
	return false;
	}
	
	//hide errors
	$('.bg-danger-dim').hide();

	$.ajax({
	
	type: 'POST',
	url: 'resetPassword-script.php',
	data:{email:email, reset:reset},
	beforeSend: function(){
		$('button#send').prop("disabled", true);
		$('.roll').removeClass("display-none");
	},
		
	success: function(data){
        $('button#send').prop("disabled", false);
		$('.roll').addClass("display-none");

		$('#Logresult').html(data);
	}
		
	});
	});







// validate token
$('button#validate').click(function(){
	
	let token = $('input#token').val();
	let email = $('input#email').val();

	if(token ==''){
	$('div#tokenResult').fadeIn().html('<div class="alert mb-2 bg-danger-dim alert-dismissible alert-icon" data-bs-dismiss="alert"><em class="icon ni ni-alert"></em>Enter token <button class="close" data-bs-dismiss="alert"></div>');
	
	$('input#token').focus();
	return false;
	}
	
	//hide errors
	$('.bg-danger-dim').hide();

	$.ajax({
	
	type: 'POST',
	url: 'resetPassword-script.php',
	data:{token:token, email:email},
	beforeSend: function(){
		$('button#validate').prop("disabled", true);
		$('.roll').removeClass("display-none");
	},
	
	success: function(data){
        $('button#validate').prop("disabled", false);
		$('.roll').addClass("display-none");

		$('#Logresult').html(data);
	}
		
	});
	});
	











// proceed to change passwore
$('button#change').click(function(){
	
	let password = $('input#password').val();
	let confpassword = $('input#confpassword').val();
	let email = $('input#email').val();


	if(password ==''){
	$('div#Loginerrs').fadeIn().html('<div class="alert mb-2 bg-danger-dim alert-dismissible alert-icon" data-bs-dismiss="alert"><em class="icon ni ni-alert"></em>Enter new password <button class="close" data-bs-dismiss="alert"></div>');
	$('input#password').focus();
	return false;
	}
	
	
	if(password.length <6){
	$('div#Loginerrs').fadeIn().html('<div class="alert mb-2 bg-danger-dim alert-dismissible alert-icon" data-bs-dismiss="alert"><em class="icon ni ni-alert"></em>Enter 6 characters password <button class="close" data-bs-dismiss="alert"></div>');
	$('input#password').focus();
	return false;
	}
	
	if(confpassword ==''){
	$('div#Loginerrs').fadeIn().html('<div class="alert mb-2 bg-danger-dim alert-dismissible alert-icon" data-bs-dismiss="alert"><em class="icon ni ni-alert"></em>Confirm password <button class="close" data-bs-dismiss="alert"></div>');
	$('input#confpassword').focus();
	return false;
	}
	
	if(confpassword !== password){
	$('div#Loginerrs').fadeIn().html('<div class="alert mb-2 bg-danger-dim alert-dismissible alert-icon" data-bs-dismiss="alert"><em class="icon ni ni-alert"></em>Passwords doesn\'t match <button class="close" data-bs-dismiss="alert"></div>');
	$('input#confpassword').focus();
	return false;
	}


	
	//hide errors
	$('.bg-danger-dim').hide();

	$.ajax({
	
	type: 'POST',
	url: 'resetPassword-script.php',
	data:{password:password, email:email},
	beforeSend: function(){
        $('button#change').prop("disabled", true);
		$('.roll').removeClass("display-none");
	},
	success: function(data){
        $('button#change').prop("disabled", true);
		$('.roll').removeClass("display-none");

		$('#Logresult').html(data);
	}
		
	});
	});
	
	



});
</script>

</body>
</html>




