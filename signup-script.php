<?php

include("include/config.php");
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');


if(isset($_SESSION["user_login"])){
		header("location: index.php");
	}

	$fullName = $_POST["fullName"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$country = $_POST["country"];
	
	//Get Referral ID if user was referred
	if(!empty($_POST["ref"])){
	$refID = "?ref=".htmlspecialchars(strip_tags($_POST["ref"]));
	}else{
		$refID = "";
	}



		function validate($str){
			return trim(htmlspecialchars(strip_tags(($str))));
		}
		

			$username = validate($_POST["username"]);
			if(!preg_match('/^[a-zA-Z0-9-_\s]+$/', $username)){
				$errorMsg[] = "Only letters with numbers, hyphen or underscore allowed";
			}else{
				$stmt = "SELECT userid FROM users WHERE username=:username";
				$stmt=$pdo->prepare($stmt);
				$stmt->bindParam(":username", $username, PDO::PARAM_STR);
				$stmt->execute();
				if($stmt->rowCount()>0){
					$errorMsg[] = "Username already taken. <br> Try: '" . $username . "20', '" . $username . "10', '" . $username . "5'";
				}
			}
		
	
			$fullName = validate($_POST["fullName"]);
			if(!preg_match('/^[a-zA-Z\s]+$/', $fullName)){
				$errorMsg[] = "Invalid name! Must contain letters only";
			}

		
			$email = validate($_POST["email"]);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errorMsg[]  = "Invalid email supplied, must contain @.com";
			}else{
				$stmt=$pdo->prepare("SELECT userid FROM users WHERE email=:email");
				$con = array(":email"=>$email);
				$stmt->execute($con);
				if($stmt->rowCount() >0){
					$errorMsg[] = "A user with this email already exist";
				}
			}
		
				$password = validate($_POST["password"]);
				if(strlen($_POST["password"])<6){
					$errorMsg[] = "Password must be upto 6 characters";
				}
		
			
		if(empty($errorMsg)){
			
			try{
				$type = "user";
				$profilepix = "";
				
				$stmt=$pdo->prepare("INSERT INTO users (fullName, profilepix, username, email, password, country) VALUES(:fullName, :profilepix, :username, :email, :password, :country)");
				$password = password_hash($password, PASSWORD_DEFAULT);
				$stmt->bindParam(":fullName", $fullName, PDO::PARAM_STR);
				$stmt->bindParam(":profilepix", $profilepix, PDO::PARAM_STR);
				$stmt->bindParam(":username", $username, PDO::PARAM_STR);
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":password", $password, PDO::PARAM_STR);
				$stmt->bindParam(":country", $country, PDO::PARAM_STR);
				$stmt->execute();
				
				if($stmt){
				$success = "Registered Successfully &nbsp;&nbsp;<i class='fa fa-check-circle'></i>";
				}
				
				if(isset($success)){
					$stmt=$pdo->prepare("SELECT * FROM users WHERE username=:username OR email=:email");
					$stmt->bindParam(":username", $username, PDO::PARAM_STR);
					$stmt->bindParam(":email", $email, PDO::PARAM_STR);
					$stmt->execute();
					$row=$stmt->fetch();
					}
					
				$_SESSION["user_login"] = $row["userid"];
				$userid = intval($_SESSION["user_login"]);
				
				
				//Update user unique ref link
				
				//create a unique key for referral program for every signed up user
				$unique = "aAbBcCDdEeFf123456";
				$custom = str_shuffle($unique);
				$key = substr($custom,0,5)."_".$userid;
				
					$stmt=$pdo->prepare("UPDATE users SET invite_ref = :invite_ref WHERE userid=:userid");
					$stmt->bindParam(":invite_ref", $key, PDO::PARAM_STR);
					$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
					$stmt->execute();
				
				
				
		//Update Account Balance Table to 0!
		$token = 0;
		$deposit = 0;
		$VAT = 1;
		
		$stmt = $pdo->prepare("INSERT INTO account (token,deposit,userid,VAT) VALUES (:token,:deposit, :userid, :VAT)");
		$stmt->bindParam(":token",$token,PDO::PARAM_STR);
		$stmt->bindParam(":deposit",$deposit,PDO::PARAM_STR);
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
		$stmt->bindParam(":VAT",$VAT,PDO::PARAM_STR);
		$stmt->execute();	
		
		


	//Set Default Timezone
	include("dashboard/timezoneSet.php");
	$dateFormat = "dd/mm/yy";
	$language = "English";
	$region = $row["country"];
	$displayName = "fullName";
	$saveActivity = "yes";

	$stmt = $pdo->prepare("INSERT INTO preference (timezone, dateFormat, language, region, displayName, timezoneLabel,saveActivity, userid) 
	VALUES (:timezone, :dateFormat, :language, :region, :displayName, :timezoneLabel,:saveActivity, :userid)");
	$stmt->bindParam(":timezone", $getTimeZone, PDO::PARAM_STR); //defaultTimeZone from timezoneSet.php
	$stmt->bindParam(":dateFormat", $dateFormat, PDO::PARAM_STR); 
	$stmt->bindParam(":language", $language, PDO::PARAM_STR); 
	$stmt->bindParam(":region", $region, PDO::PARAM_STR); 
	$stmt->bindParam(":displayName", $displayName, PDO::PARAM_STR); 
	$stmt->bindParam(":timezoneLabel", $timezoneLabel, PDO::PARAM_STR); 
	$stmt->bindParam(":saveActivity",$saveActivity,PDO::PARAM_STR);
	$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
	$stmt->execute();




		//Add Mailer Script to send user info to their mail
		//require_once("mails/welcomeMail.php");
				
			
			}catch(PDOException $e){
				echo "Error in connection " . $e->getMessage();
			}
			
			
		}
	
	
	// END REGISTER CODE
	


?>






<script>
var close = document.getElementsByClassName("closebtn");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>



<?php 

if(isset($success)){ ?>

	<script>
		//hide form
		$("#Regform, .nk-block-head, .overline-title, .form-note-s2").fadeOut("fast");
		$("#successLoginRegContainer").fadeIn(2000);
		//redirect
		setTimeout(function(){
			location.href='dashboard/index.php<?php echo $refID;?>'
		},6000);
	</script>
	
	
	<div id="successLoginRegContainer" class="text-center">
	<h4 class="nk-block-title text-center">
	Welcome <?php echo htmlspecialchars($row["username"]);?>!
	</h4>

  	<div style='margin:10px; font-size:18px;' class="alert alert-success">
	<?php echo $success;?>
	</div>
	<div style="font-size:17px;font-weight:500" class='logs'>Preparing Account
	</div>
	<span id="roll" class="display-none">
	<div class="spinner-border m-5" role="status">
	<span class="visually-hidden">Loading...</span></div>
	</span>
	</div>

 
<?php }?>



<!-- ERROR IF WRONG CREDENTIALS-->
<?php
if(isset($errorMsg)){
	foreach($errorMsg as $error){
	
	echo 
  '<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> '.$error.'<button class="close" data-bs-dismiss="alert">
  </button></div>';
	}
}
?>