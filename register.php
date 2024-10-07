<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "include/config.php";
session_start();

if(isset($_SESSION["user_login"])){
		header("location: dashboard/index.php");
	}else{
	
	
	//if user is registering with referral link, get the ref from the url
	
	if(isset($_GET["ref"])){
        //set session incase user navigate to other pages making the ref on url to disappear
        $_SESSION["ref"]  = htmlspecialchars($_GET["ref"]);
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
			
}		
?>
	

<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
<?php require_once("metaTags.php");?>
<title>Register | Medtrix</title>


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
<img class="logo-light logo-img logo-img-lg" src="images/logo.png" srcset="images/logo.png 2x" alt="logo">
<img class="logo-dark logo-img logo-img-lg" src="images/logo.png" width="100px" srcset="images/logo.png 2x" alt="logo-dark">
</a>
</div>
<div class="card card-bordered">
<div class="card-inner card-inner-lg">
<div class="nk-block-head">
<div class="nk-block-head-content">
<h4 class="nk-block-title">Register</h4>








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
        <p>Create Medtrix Account</p>

        </div>
        </div>
        </div>

        <!-- errors | result -->
        <div id="regResult"></div>
        <div id="regErr" style="margin:10px auto"></div>


        <form id="Regform">
        <!--get Ref link if set-->
        <input type="hidden" name="ref" id="ref" value="<?php if(isset($_SESSION["ref"])){echo htmlspecialchars($_SESSION["ref"]);}?>">
    
        <div class="form-group">
        <div class="form-control-wrap">
        <input type="text" class="form-control form-control-lg" name="fullName" id="fullName" placeholder="Enter your Full name">
        </div>
        </div>
        <div class="form-group">
        <div class="form-control-wrap">
        <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Enter username">
        </div>
        </div>
        <div class="form-group">
        <div class="form-control-wrap">
        <input type="text" class="form-control form-control-lg" id="regemail" name="email" placeholder="Email address">
        </div>
        </div>


        <div class="form-group">
        <div class="form-control-wrap">
        <select id="country" name="country" class="form-control form-control-lg">
        <option value="">Select Country</option>
        <option value="Afghanistan">Afghanistan</option>
        <option value="Åland Islands">Åland Islands</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="American Samoa">American Samoa</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
        <option value="Anguilla">Anguilla</option>
        <option value="Antarctica">Antarctica</option>
        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Aruba">Aruba</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bermuda">Bermuda</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Bouvet Island">Bouvet Island</option>
        <option value="Brazil">Brazil</option>
        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
        <option value="Brunei Darussalam">Brunei Darussalam</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Cape Verde">Cape Verde</option>
        <option value="Cayman Islands">Cayman Islands</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Christmas Island">Christmas Island</option>
        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
        <option value="Congo">Congo</option>
        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
        <option value="Cook Islands">Cook Islands</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Cote D'ivoire">Cote D'ivoire</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
        <option value="Estonia">Estonia</option>
        <option value="Ethiopia">Ethiopia</option>
        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
        <option value="Faroe Islands">Faroe Islands</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>
        <option value="French Guiana">French Guiana</option>
        <option value="French Polynesia">French Polynesia</option>
        <option value="French Southern Territories">French Southern Territories</option>
        <option value="Gabon">Gabon</option>
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Gibraltar">Gibraltar</option>
        <option value="Greece">Greece</option>
        <option value="Greenland">Greenland</option>
        <option value="Grenada">Grenada</option>
        <option value="Guadeloupe">Guadeloupe</option>
        <option value="Guam">Guam</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Guernsey">Guernsey</option>
        <option value="Guinea">Guinea</option>
        <option value="Guinea-bissau">Guinea-bissau</option>
        <option value="Guyana">Guyana</option>
        <option value="Haiti">Haiti</option>
        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
        <option value="Honduras">Honduras</option>
        <option value="Hong Kong">Hong Kong</option>
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="India">India</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
        <option value="Iraq">Iraq</option>
        <option value="Ireland">Ireland</option>
        <option value="Isle of Man">Isle of Man</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jersey">Jersey</option>
        <option value="Jordan">Jordan</option>
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kiribati">Kiribati</option>
        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
        <option value="Korea, Republic of">Korea, Republic of</option>
        <option value="Kuwait">Kuwait</option>
        <option value="Kyrgyzstan">Kyrgyzstan</option>
        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Lesotho">Lesotho</option>
        <option value="Liberia">Liberia</option>
        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
        <option value="Liechtenstein">Liechtenstein</option>
        <option value="Lithuania">Lithuania</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Macao">Macao</option>
        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malawi">Malawi</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Maldives">Maldives</option>
        <option value="Mali">Mali</option>
        <option value="Malta">Malta</option>
        <option value="Marshall Islands">Marshall Islands</option>
        <option value="Martinique">Martinique</option>
        <option value="Mauritania">Mauritania</option>
        <option value="Mauritius">Mauritius</option>
        <option value="Mayotte">Mayotte</option>
        <option value="Mexico">Mexico</option>
        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
        <option value="Moldova, Republic of">Moldova, Republic of</option>
        <option value="Monaco">Monaco</option>
        <option value="Mongolia">Mongolia</option>
        <option value="Montenegro">Montenegro</option>
        <option value="Montserrat">Montserrat</option>
        <option value="Morocco">Morocco</option>
        <option value="Mozambique">Mozambique</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Namibia">Namibia</option>
        <option value="Nauru">Nauru</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherlands">Netherlands</option>
        <option value="Netherlands Antilles">Netherlands Antilles</option>
        <option value="New Caledonia">New Caledonia</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nicaragua">Nicaragua</option>
        <option value="Niger">Niger</option>
        <option value="Nigeria" selected>Nigeria</option>
        <option value="Niue">Niue</option>
        <option value="Norfolk Island">Norfolk Island</option>
        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
        <option value="Norway">Norway</option>
        <option value="Oman">Oman</option>
        <option value="Pakistan">Pakistan</option>
        <option value="Palau">Palau</option>
        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
        <option value="Panama">Panama</option>
        <option value="Papua New Guinea">Papua New Guinea</option>
        <option value="Paraguay">Paraguay</option>
        <option value="Peru">Peru</option>
        <option value="Philippines">Philippines</option>
        <option value="Pitcairn">Pitcairn</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>
        <option value="Puerto Rico">Puerto Rico</option>
        <option value="Qatar">Qatar</option>
        <option value="Reunion">Reunion</option>
        <option value="Romania">Romania</option>
        <option value="Russian Federation">Russian Federation</option>
        <option value="Rwanda">Rwanda</option>
        <option value="Saint Helena">Saint Helena</option>
        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
        <option value="Saint Lucia">Saint Lucia</option>
        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
        <option value="Samoa">Samoa</option>
        <option value="San Marino">San Marino</option>
        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Senegal">Senegal</option>
        <option value="Serbia">Serbia</option>
        <option value="Seychelles">Seychelles</option>
        <option value="Sierra Leone">Sierra Leone</option>
        <option value="Singapore">Singapore</option>
        <option value="Slovakia">Slovakia</option>
        <option value="Slovenia">Slovenia</option>
        <option value="Solomon Islands">Solomon Islands</option>
        <option value="Somalia">Somalia</option>
        <option value="South Africa">South Africa</option>
        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
        <option value="Spain">Spain</option>
        <option value="Sri Lanka">Sri Lanka</option>
        <option value="Sudan">Sudan</option>
        <option value="Suriname">Suriname</option>
        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
        <option value="Swaziland">Swaziland</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
        <option value="Taiwan">Taiwan</option>
        <option value="Tajikistan">Tajikistan</option>
        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
        <option value="Thailand">Thailand</option>
        <option value="Timor-leste">Timor-leste</option>
        <option value="Togo">Togo</option>
        <option value="Tokelau">Tokelau</option>
        <option value="Tonga">Tonga</option>
        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
        <option value="Tunisia">Tunisia</option>
        <option value="Turkey">Turkey</option>
        <option value="Turkmenistan">Turkmenistan</option>
        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
        <option value="Tuvalu">Tuvalu</option>
        <option value="Uganda">Uganda</option>
        <option value="Ukraine">Ukraine</option>
        <option value="United Arab Emirates">United Arab Emirates</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="United States">United States</option>
        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
        <option value="Uruguay">Uruguay</option>
        <option value="Uzbekistan">Uzbekistan</option>
        <option value="Vanuatu">Vanuatu</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Viet Nam">Viet Nam</option>
        <option value="Virgin Islands, British">Virgin Islands, British</option>
        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
        <option value="Wallis and Futuna">Wallis and Futuna</option>
        <option value="Western Sahara">Western Sahara</option>
        <option value="Yemen">Yemen</option>
        <option value="Zambia">Zambia</option>
        <option value="Zimbabwe">Zimbabwe</option>
        </select>
        </div>
        </div>


        <div class="form-group">
        <div class="form-control-wrap">
        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
        <em class="passcode-icon icon-show icon ni ni-eye"></em>
        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
        </a>
        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter your Password" data-type="password">
        </div>
        </div>
        <div class="form-group">
        <div class="custom-control custom-control-xs custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="checkbox">
        <label class="custom-control-label" for="checkbox">
        I agree to the <a href="dashboard/tandc.php">Terms</a>
        </label>
        </div>
        </div>


        <div class="form-group">
        <button type="submit" id="register" name="submit" class="btn btn-lg btn-primary btn-block">
        <span id="retxt">Register</span>
        <span id="regroll" class="display-none">
        <span id="roll" class="display-none">
        <div class="spinner-border m-5" role="status">
        <span class="visually-hidden">Loading...</span></div>
        </span>
        </span>
        </button>
        </div>
        </form>

                <div class="text-center pt-4">
                <h6 class="overline-title overline-title-sap">
                <span>OR</span>
                </h6>
                </div>

                <div class="form-note-s2 text-center pt-2">
                Already have an account? 
                <a href="login.php">
                <strong>Sign in instead</strong>
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
                <p class="text-soft">&copy;Medtrix <?php echo date("Y");?> All Rights Reserved.</p>
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
	$('div#regErr').click(function(){
		$('div.alert-danger').fadeOut("slow");
	});
	

	//Register Scripts
		
	$('button#register').click(function(e){
		e.preventDefault();


	var fullName = $('input#fullName').val();
	if(fullName ==''){
	$('#regErr').html('<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> Enter your fullname<button class="close" data-bs-dismiss="alert"></button></div>');
	$('input#fullName').focus();
	return false;
	}


	var username = $('input#username').val();
	if(username ==''){
	$('#regErr').html('<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> Username is required<button class="close" data-bs-dismiss="alert"></button></div>');
	$('input#username').focus();
	return false;
	}
	
	var email = $('input#regemail').val();
	if(email ==''){
	$('#regErr').html('<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> Email is required<button class="close" data-bs-dismiss="alert"></button></div>');
	$('input#regemail').focus();
	return false;
	}
	
	
	var country = $('select#country').val();
	if(country ==''){
	$('#regErr').html('<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> Select Country<button class="close" data-bs-dismiss="alert"></button></div>');
	$('select#country').focus();
	return false;
	}
	
	var password = $('input#password').val();
	if(password ==''){
	$('#regErr').html('<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> Enter Password<button class="close" data-bs-dismiss="alert"></button></div>');
	$('input#password').focus();
	return false;
	}
	
    var terms = $('input#checkbox');
	if(!terms.is(":checked")){
	$('#regErr').html('<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> Accept Terms<button class="close" data-bs-dismiss="alert"></button></div>');
	$('input#checkbox').focus();
	return false;
	}


    //hide errors
	$('div.alert-danger').hide();


	$.ajax({
	type: 'POST',
	url: 'signup-script.php',
	data: $('#Regform').serialize(),
	beforeSend: function(){
		$('span#retxt').hide();
		$('span#regroll').removeClass("display-none");
	},
	success: function(data){
		var data = $('#regResult').html(data);	
		$('span#retxt').show();;
		$('span#regroll').addClass("display-none");
	}	
		
	});
	});



        });

    </script>

</body>
</html>
