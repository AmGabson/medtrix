<?php
include "include/config.php";
session_start();

if(isset($_SESSION["user_login"])){
		header("location: dashboard/index.php");
	}
	
	
	//get value incase user is coming from game page (for easy redirect when logged in)
	if(!empty($_GET["game"])){
		$game = htmlspecialchars($_GET["game"]);
	}
    //do same for home page
	if(!empty($_GET["login"]) && $_GET["login"] =="request"){
		$loginR = htmlspecialchars($_GET["login"]);
	}
	 
	
    //Check if site is locked - Effect site lock if pin is not set from "underMaintenance.php"
    //This is code is also pasted on "register-login.php", "index.php", user "dashboard/sidebar.php" and admin "admin/sidebar.php" 
    //to redirect user once site is blocked since sidebars appears in all pages
    
    $stmt=$pdo->prepare("SELECT * FROM maintenance");
    $stmt->execute();
    $value = $stmt->fetch();
    
    if($stmt->rowCount() > 0 && $value["locked"] == "locked"){
        
    if(!isset($_SESSION["site_lock"])){
    echo '<script>location.href="underMaintenance.php"</script>';
    }
    
    //if pass code from Session does not match code from "maintenance" table, bounce back and unset session
    //if eventually admin changed the passcode, and users previous pass Code session is set, it'll bounce them out
    elseif($_SESSION["site_lock"] !== $value["passCode"]){
    
    unset($_SESSION["site_lock"]);
    echo '<script>location.href="underMaintenance.php"</script>';			
    
    }
    }
			

?>
	

<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
<?php require_once "metaTags.php";?>
<title>Login | MedTrix</title>

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
                                <a href="index.php" class="logo-link">
                                    
            <img class="logo-light logo-img logo-img-lg" width="100px" src="images/logo.png" srcset="images/logo.png" alt="Medtrix Logo">
            
            <img width="100px" class="logo-dark logo-img logo-img-lg" src="images/logo.png" srcset="images/logo.png" alt="Medtrix Logo">
                                </a>
                            </div>
                            <div class="card card-bordered">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Login</h4>








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
        <p>Login to access your dashboard!</p>

        </div>
        </div>
        </div>

       	<!-- errors | result -->
        <div id="Logresult"></div>
        <div id="Loginerrs" style="margin:10px auto"></div>


        <form id="loginform">
        <!--Incase From game page -->
        <input type="hidden" name="game" value="<?php if(isset($game)){echo htmlspecialchars($game);}?>">

        <!--Incase From home page -->
        <input type="hidden" name="login" value="<?php if(isset($loginR)){echo htmlspecialchars($loginR);}?>">

        <div class="form-group">
        <div class="form-control-wrap">
        <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Username or email">
        </div>
        </div>



        <div class="form-group">
        <a class="link link-primary link-sm" href="resetPassword.php">Forgot Password?</a>
        <div class="form-control-wrap">

        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
        <em class="passcode-icon icon-show icon ni ni-eye"></em>
        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
        </a>
        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter your Password" data-type="password">
        </div>
        </div>


        <div class="form-group">
    
    <button class="btn btn-primary btn-block" id="login" type="button">
        <span id="roll" class="display-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span>Login</span></button>
 

        </div>
        </form>

                <div class="text-center pt-4">
                <h6 class="overline-title overline-title-sap">
                <span>OR</span>
                </h6>
                </div>

                <div class="form-note-s2 text-center pt-2">
                Don't have an account? 
                <a href="register.php">
                <strong>Register instead</strong>
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
                <a class="link link-primary fw-normal py-2 px-3" href="dashboard/tandc.php">Terms & Condition</a>
                </li>
                <li class="nav-item">
                <a class="link link-primary fw-normal py-2 px-3" href="index.php">Home</a>
                </li>
               
              
                </ul>
                </div>
                <div class="col-lg-6">
                <div class="nk-block-content text-center text-lg-left">
                <p class="text-soft">&copy;Medtrix <?php echo date("Y");?>  All Rights Reserved.</p>
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
                <a class="tipinfo" href="plans.php" title="Plans">
                    <em class="icon ni ni-invest"></em>
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

    //hide Error div when its clicked
	$('div#Loginerrs').click(function(){
		$('div.alert-danger').fadeOut("slow");
	});
	

	

	// LOGIN
	$('button#login').click(function(e){
		e.preventDefault();
	
	var email = $('input#email').val();
	if(email ==''){

        

        
	$('div#Loginerrs').html('<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> Email or username required<button class="close" data-bs-dismiss="alert"></button></div>');
	$('input#email').focus();
	return false;
	}
	
	var password = $('input#password').val();
	if(password ==''){
	$('div#Loginerrs').html('<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> Enter your password<button class="close" data-bs-dismiss="alert"></button></div>');
	$('input#password').focus();
	return false;
	}

	//hide errors
	$('div.alert-danger').hide();

	$.ajax({
	
	type: 'POST',
	url: 'login-script.php',
	data: $('#loginform').serialize(),
	beforeSend: function(){
		$('button#login').prop("disabled", true);
		$('span#roll').removeClass("display-none");
	},
	
	success: function(data){
		$('span#roll').addClass("display-none");
		$('button#login').prop("disabled", false);
		$('#Logresult').html(data);
	}
		
	});
	});
	
	
	
    

        });

    </script>

</body>
</html>




