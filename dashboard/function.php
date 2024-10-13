<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../include/config.php';
session_start();

$userid = intval($_SESSION['user_login']);

// Timezone
include("timezoneSet.php");


//get user info
$stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$userVal=$stmt->fetch();


//Get Account User Balance
$stmt="SELECT * FROM account WHERE userid = :userid";
$stmt=$pdo->prepare($stmt);
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$balance=$stmt->fetch();










//UPDATE PROFILE IMAGE
if(isset($_FILES["profilepix"]["name"])){

	//Check and remove previous image on folder
	 $query=$pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
	 $query->bindParam(":userid", $userid, PDO::PARAM_STR);
	 $query->execute();
	 $prev = $query->fetch();
	 if(!empty($prev["profilepix"]))
	 {
		@unlink('../images/users/'.$prev["profilepix"]);
	 }
	 
	
	
	 for($count=0; $count<count($_FILES["profilepix"]["name"]); $count++)
	 {
	  $profilepix = $_FILES["profilepix"]["name"][$count];
	  $tmp_name = $_FILES["profilepix"]['tmp_name'][$count];
	  $file_array = explode(".", $profilepix);
	  $file_extension = end($file_array);
	  if(file_already_uploaded($profilepix, $pdo))
	  {
	   $profilepix = $file_array[0] . '-'. rand() . '.' . $file_extension;
	  }
	  $location = '../images/users/' . $profilepix;
	  if(move_uploaded_file($tmp_name, $location))
	  {
	   
	   $stmt=$pdo->prepare("UPDATE users SET profilepix=(:profilepix) WHERE userid=:userid");
	   $stmt->bindParam(":profilepix", $profilepix, PDO::PARAM_STR);
	   $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	   $stmt->execute();
	   if($stmt){
		   
			//Load Image
			$sql=$pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
			$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
			$sql->execute();
			$row=$sql->fetch();
			$profilepix = (!empty($row["profilepix"]) ? "../images/users/".$row["profilepix"]: "../images/avatar.png");
		
			echo '
				<script>
				$(".ProfilePixResult").attr("src", "'.$profilepix.'");
				</script>';
	  }
	   
	  }
	 }
	}
	
	
	function file_already_uploaded($profilepix, $pdo)
	{
	 $userid = $_SESSION["user_login"];
	 
	 $statement = $pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
	 $statement->bindParam(":userid", $userid, PDO::PARAM_STR);
	 $statement->execute();
	 $getStmt = $statement->fetch();
	 if(!empty($getStmt["profilepix"]))
	 {
	  return true;
	 }
	 else
	 {
	  return false;
	 }
	}
	
	
	
	
	
	
	
	
	
	
	
	
	//UPDATE USER PROFILE
	
	if(isset($_POST["updateProfile"])){
			
		// sleep(5);
	
		$fullName = htmlspecialchars(str_ireplace('  ','',$_POST["fullName"]));
		$username = htmlspecialchars(str_ireplace('  ','',$_POST["username"]));
		$email = htmlspecialchars($_POST["email"]);
		$address = htmlspecialchars(trim($_POST["address"]));
		$phone = htmlspecialchars(trim($_POST["phone"]));
		$country = htmlspecialchars($_POST["country"]);
		$city = htmlspecialchars($_POST["city"]);
		$residentialCountry = htmlspecialchars($_POST["residentialCountry"]);
		$dob = htmlspecialchars($_POST["dob"]);
		$bankName = htmlspecialchars($_POST["bankName"]);
		$accountNumber = htmlspecialchars($_POST["accountNumber"]);
		
		
		if(empty($fullName)){
			$err[] = "Please enter your full name.<script>$('#fullName').focus().addClass('error');</script>";
		}
		elseif(!preg_match('/^[a-zA-Z-_.\s\']+$/',$fullName)){
			 $err[] = "Enter a valid fullname<script>$('#fullName').focus().addClass('error');</script>";
		  }
		if($username =="" || $username ==" " || $username =="   " || empty($username)){
			$err[] = "Username is required<script>$('#username').focus().addClass('error');</script>";
		}
		elseif(!preg_match('/^[a-zA-Z-0-9_.\s\']+$/',$username)){
			  $err[] = " Username must not contain special characters.<script>$('#username').focus().addClass('error');</script>";
		  }
	
		  elseif(empty($phone)){
			$err[] = "Enter phone number<script>$('#phone').focus().addClass('error');</script>";
		}
		  elseif(strlen($phone) < 10){
			$err[] = "Enter a valid phone number<script>$('#phone').focus().addClass('error');</script>";
		}
		  elseif(empty($dob)){
			$err[] = "Select date of birth<script>$('#dob').focus().addClass('error');</script>";
		}
		
		  elseif(empty($country)){
			$err[] = "Select nationality country<script>$('#country').focus().addClass('error'); $('.navPersonal').removeClass('active'); $('.navAddress').addClass('active');</script>";
		}
		  elseif(empty($city)){
			$err[] = "Enter current city<script>$('#city').focus().addClass('error'); $('.navPersonal').removeClass('active'); $('.navAddress').addClass('active');</script>";
		}
		  elseif(empty($residentialCountry)){
			$err[] = "Select residential country<script>$('#residentialCountry').focus().addClass('error'); $('.navPersonal').removeClass('active'); $('.navAddress').addClass('active');</script>";
		}
		
		  elseif(empty($address)){
			$err[] = "Enter residential adress <script>$('#address').addClass('error'); $('.navPersonal').removeClass('active'); $('.navAddress').addClass('active');</script>";
		}
	
		  
			 
			if(isset($err)){
			foreach($err as $error){
				echo
				'<div style="margin:20px 0px; font-size:14px;" class="alert alert-danger p-2">
				'.$error.'<span class="close times" style="cursor:pointer">&times;</span>
				</div>
				
				<script>$(".times").click(function(){ $(this).parent().fadeOut(); });</script>';
			}
			}else{
			$stmt = $pdo->prepare("
			UPDATE users SET fullName=:fullName,email=:email,address=:address,username=:username,phone=:phone,
			country=:country,residentialCountry=:residentialCountry,dob=:dob,city=:city,bank=:bankName,accountNumber=:accountNumber WHERE userid=:userid");
			
			$stmt->bindParam(":fullName",$fullName,PDO::PARAM_STR);
			$stmt->bindParam(":email",$email,PDO::PARAM_STR);
			$stmt->bindParam(":address",$address,PDO::PARAM_STR);
			$stmt->bindParam(":username",$username,PDO::PARAM_STR);
			$stmt->bindParam(":phone",$phone,PDO::PARAM_STR);
			$stmt->bindParam(":country",$country,PDO::PARAM_STR);
			$stmt->bindParam(":residentialCountry",$residentialCountry,PDO::PARAM_STR);
			$stmt->bindParam(":dob",$dob,PDO::PARAM_STR);
			$stmt->bindParam(":city",$city,PDO::PARAM_STR);
			$stmt->bindParam(":bankName",$bankName,PDO::PARAM_STR);
			$stmt->bindParam(":accountNumber",$accountNumber,PDO::PARAM_STR);
			$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
			$stmt->execute();
			if($stmt){
				echo '
				<script>
				//Success
				
						$(".suc").removeClass("display-none").fadeIn(function(){
							setTimeout(()=>{
								$(this).fadeOut();
							},2000);
						});
						$(".wlcm").html("Profile Updated");
						
	
						
				</script>';
	 
				echo "<script>
				//Success alert
				
		
	
				$.alert({
					title: 'Success!!',
					content: 'Profile Updated',
					animation: 'scale',
					animationBounce: 2, // default is 1.2 whereas 1 is no bounce.
					closeAnimation: 'bottom',
					backgroundDismiss: true,
					type: 'green',
					draggable: true,
						buttons: {
					Done: {
						text: 'Done!',
						btnClass: 'btn-dark',
						action: function(){
	
							$('.modal-backdrop').remove();
							$('#profile-edit').modal('hide');
	
							}
						}
					}
				});
	
				</script>";
	
	
	
			}
			}
			
			}
			
			
			
			
	
	
	
	






		// Change Display Name
		if(isset($_POST["toggleDisplayName"])){
			$value = htmlspecialchars($_POST["value"]);

			$stmt = $pdo->prepare("UPDATE preference SET displayName=:displayName WHERE userid=:userid");
			$stmt->bindParam(":displayName",$value,PDO::PARAM_STR);
			$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
			$stmt->execute();

			if($stmt){
				if($value  == "fullName"){
					$changed =  $userVal["fullName"];
				}else{
					$changed =  $userVal["username"];
				}

				echo "
				<script>
				$('.toggleVal').html('".$changed."');

			$.alert({
				title: 'Display name changed',
				content: '<b>To&nbsp;</b> ".$changed."',
				animation: 'scale',
				animationBounce: 2, // default is 1.2 whereas 1 is no bounce.
				closeAnimation: 'bottom',
				backgroundDismiss: true,
				type: 'green',
				draggable: true,
					buttons: {
				Done: {
					text: 'Done!',
					btnClass: 'btn-dark',
					action: function(){
					// do nothing
						}
					}
				}
			});
				</script>";

			}

		}





















		// SAVE UNSAVE ACTIVITY LOG
		if(isset($_POST["activityLog"])){
			$value = htmlspecialchars($_POST["value"]);

			$stmt = $pdo->prepare("UPDATE preference SET saveActivity=:saveActivity WHERE userid=:userid");
			$stmt->bindParam(":saveActivity",$value,PDO::PARAM_STR);
			$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
			$stmt->execute();

			if($stmt){
				if($value  == "yes"){
					$changed =  "Will be Saved";
					echo '<script>
					$(".statBg").removeClass("bg-danger");
        			$(".statBg").addClass("bg-primary");
        			$("#actText").html("YES");
					</script>';

				}else{
					$changed =  "Will not be Saved";
					echo '<script>
					$(".statBg").removeClass("bg-primary");
        			$(".statBg").addClass("bg-danger");
        			$("#actText").html("NO");
					</script>';
				}

				echo "
				<script>
				$('.toggleVal').html('".$changed."');

			$.alert({
				title: 'Activity Log Updated',
				content: 'Your activity log <b>".$changed."</b>',
				animation: 'scale',
				animationBounce: 2, // default is 1.2 whereas 1 is no bounce.
				closeAnimation: 'bottom',
				backgroundDismiss: true,
				type: 'green',
				draggable: true,
					buttons: {
				Done: {
					text: 'Done!',
					btnClass: 'btn-dark',
					action: function(){
					// do nothing
						}
					}
				}
			});
				</script>";

			}

		}



















		// Set Timezone
		if(isset($_POST["setTimezone"])){

		$timezone = htmlspecialchars($_POST["timezone"]);
		$timezoneLabel = htmlspecialchars($_POST["timezoneLabel"]);

		$stmt = $pdo->prepare("UPDATE preference SET timezone=:timezone, timezoneLabel=:timezoneLabel WHERE userid=:userid");
		$stmt->bindParam(":timezone",$timezone,PDO::PARAM_STR);
		$stmt->bindParam(":timezoneLabel",$timezoneLabel,PDO::PARAM_STR);
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
		$stmt->execute();

		if($stmt){
			echo 1;
		}


	}
		















//BOOK CONSULTATION
if(isset($_POST["preferredDate"])){

	//create a unique key for referral program for every signed up user
	$unique = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$custom = str_shuffle($unique);
	$ref = "TXN-" . substr($custom,0,6).$userid;

	$sex = htmlspecialchars($_POST["sex"]);
	$contactFrom = htmlspecialchars($_POST["contactFrom"]);
	$preferredDate = htmlspecialchars($_POST["preferredDate"]);
	$preferredTime = htmlspecialchars($_POST["preferredTime"]);
	$status = "pending";
	$patientDesc = htmlspecialchars($_POST["patientDesc"]);
	$consultId = intval($_POST["consultId"]);

 
	$stmt = $pdo->prepare("INSERT INTO consultations (userid,sex,contactFrom,preferredDate,preferredTime,status,patientDesc,consultId,ref) VALUES (:userid,:sex,:contactFrom,:preferredDate,:preferredTime,:status,:patientDesc,:consultId,:ref)");
	$stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
	$stmt->bindParam(":sex",$sex,PDO::PARAM_STR);
	$stmt->bindParam(":contactFrom",$contactFrom,PDO::PARAM_STR);
	$stmt->bindParam(":preferredDate",$preferredDate,PDO::PARAM_STR);
	$stmt->bindParam(":preferredTime",$preferredTime,PDO::PARAM_STR);
	$stmt->bindParam(":status",$status,PDO::PARAM_STR);
	$stmt->bindParam(":patientDesc",$patientDesc,PDO::PARAM_STR);
	$stmt->bindParam(":consultId",$consultId,PDO::PARAM_INT);
	$stmt->bindParam(":ref",$ref,PDO::PARAM_STR);
	$stmt->execute();
	
	if($stmt){

	$stmt=$pdo->prepare("SELECT * FROM consultationType WHERE consultId = :consultId");
	$stmt->bindParam(":consultId", $consultId, PDO::PARAM_INT);
	$stmt->execute();
	$consulType=$stmt->fetch();
	$type = $consulType['type'];
	?>
		
		<script>
		// Hide form
		$('.consultForm').fadeOut('fast', function(){
			$('.success').removeClass('display-none');
			$('.textSpan').html("<strong class='text-capitalize'><?php echo $type;?></strong> Appointment Recorded");
		});
		</script>

<?php } }











		
		//Delete Activity Log
		if(isset($_POST["delActivity"])){
		
			$id = intval($_POST["delActivity"]);
		
			$stmt = $pdo->prepare("DELETE FROM activities WHERE id=:id");
			$stmt->bindParam(":id",$id,PDO::PARAM_STR);
			$stmt->execute();
			if($stmt){echo 1;}
			}











		
		//Delete Notifications
		if(isset($_POST["delNotification"])){
		
			$id = intval($_POST["delNotification"]);
		
			$stmt = $pdo->prepare("DELETE FROM notifications WHERE id=:id");
			$stmt->bindParam(":id",$id,PDO::PARAM_STR);
			$stmt->execute();
			if($stmt){echo "Deleted";}
		}











				
			
	///UPDATE PASSWORD
		
	if(isset($_POST["updatePass"])){	
		
		$oldPassword = htmlspecialchars($_POST["oldPassword"]);
		$password = htmlspecialchars($_POST["password"]);
		$ConfirmPassword = htmlspecialchars($_POST["ConfirmPassword"]);
			
		$checkPassword = password_verify($oldPassword, $userVal["password"]);
			
		if(empty($oldPassword)){
			$err[] = "Enter your current password<script>$('#oldPassword').focus()</script>";
		}
		elseif(empty($password)){
			$err[] = "Enter your new password<script>$('#password').focus()</script>";
		}
		elseif(empty($ConfirmPassword)){
			$err[] = "Confirm password<script>$('#ConfirmPassword').focus()</script>";
		}
		
		elseif(strlen($password)<6){
				$err[] = "Password must be upto 6 characters<script>$('#password').focus()</script>";
			}
			
		elseif($ConfirmPassword != $password){
				$err[] = "New passwords did match<script>$('#ConfirmPassword').focus()</script>";
			}
				
		elseif($checkPassword != $oldPassword){
				$err[] = "Incorrect password supplied<script>$('#oldPassword').focus()</script>";
			}
		
			
			
			
			if(isset($err)){
			foreach($err as $error){

				echo '<div class="alert mb-2 alert-danger alert-dismissible alert-icon">
					<em class="icon ni ni-cross-circle"></em>'.$error.'<button class="close" data-bs-dismiss="alert">
					</button></div>';
			}
			}else{
	
				try{
				
					$newPassword = password_hash($password, PASSWORD_DEFAULT);
					$passUpdateDate = date("Y-m-d H:i:s");

					$stmt=$pdo->prepare("UPDATE users SET password=(:password), passUpdateDate=:passUpdateDate WHERE userid=:userid");
					
					$stmt->bindParam(":password",$newPassword,PDO::PARAM_STR);
					$stmt->bindParam(":passUpdateDate",$passUpdateDate,PDO::PARAM_STR);
					$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
					$stmt->execute();
					
					if($stmt){
				
				echo '
				<div class="alert mb-2 alert-success alert-dismissible alert-icon">
				<em class="icon ni ni-check"></em> Password Changed <button class="close" data-bs-dismiss="alert">
				</button></div>';
				
				
				echo "<script>
				
				$.alert({
					title: 'Successful!',
					content: '<b>Password Changed </b> ',
					animation: 'scale',
					animationBounce: 2, // default is 1.2 whereas 1 is no bounce.
					closeAnimation: 'bottom',
					backgroundDismiss: true,
					type: 'green',
					draggable: true,
						buttons: {
					Done: {
						text: 'Done!',
						btnClass: 'btn-dark',
						action: function(){
						// close Modal
						$('.modal-backdrop').remove();
						$('#password-edit').modal('hide');
							}
						}
					}
				});

				$('#pdate').html('Today');
				</script>";
				
				
				//Send Confirmation Email to user
				//require_once("../mails/change_password.php");


		// Update  Notification
		$notiStatus = "unread";
		$title = "Your password was changed!";
		$icon = "ni-qr";
		$color = "danger";

		$stmt = $pdo->prepare("INSERT INTO notifications (userid, title, status, icon, color) 
								VALUES (:userid, :title, :status, :icon, :color)");
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
		$stmt->bindParam(":title",$title,PDO::PARAM_STR);
		$stmt->bindParam(":status",$notiStatus,PDO::PARAM_STR);
		$stmt->bindParam(":icon",$icon,PDO::PARAM_STR);
		$stmt->bindParam(":color",$color,PDO::PARAM_STR);
		$stmt->execute();
					
			}
				
				}catch(PDOException $e){
					echo "Error occured " . $e->getMessage();
				}
					
				}
			
			
			}
			
			


			








		// MARK ALL NOTIFICATION AS READ
		if(isset($_POST["markRead"])){
			

			$status = htmlentities($_POST["markRead"]);
			$query=$pdo->prepare("UPDATE notifications SET status = :status WHERE userid=:userid");
			$query->bindParam(":status", $status, PDO::PARAM_STR);
			$query->bindParam(":userid", $userid, PDO::PARAM_STR);
			$query->execute();

			if($stmt){ ?>

				<script>

				$(".readStat").html('<div class="justify-center nk-notification-item dropdown-inner"><h6 class="text-gray text-center m-2">All Read</h6></div>');

				$(".readText").html("Updated  <em class='icon ni ni-check'></em>");
				$(".nt-count").html("Notifications(0)");
				$(".alert").removeClass("N-active");
				</script>


<?php } }
















//UPDATE KYC FRONT
if(isset($_FILES["idFront"]["name"])){

	$kycIdType = htmlspecialchars($_POST["idType"]);
	$kycVerify = "pending";
	$kycDate = date("Y-m-d H:i:s");

	//Check and remove previous image on folder
	 $query=$pdo->prepare("SELECT idFront FROM users WHERE userid=:userid");
	 $query->bindParam(":userid", $userid, PDO::PARAM_STR);
	 $query->execute();
	 $prev = $query->fetch();
	 if(!empty($prev["idFront"]))
	 {
		@unlink('../images/kyc/'.$prev["idFront"]);
	 }
	 
	
	 for($count=0; $count<count($_FILES["idFront"]["name"]); $count++){
	  $idFront = $_FILES["idFront"]["name"][$count];
	  $tmp_name = $_FILES["idFront"]['tmp_name'][$count];
	  $file_array = explode(".", $idFront);
	  $file_extension = end($file_array);
	  if(file_already_upload($idFront, $pdo))
	  {
	   $idFront = $file_array[0] . '-'. rand() . '.' . $file_extension;
	  }
	  $location = '../images/kyc/' . $idFront;
	  if(move_uploaded_file($tmp_name, $location))
	  {
	   
	   $stmt=$pdo->prepare("UPDATE users SET idFront=:idFront, kycIdType=:kycIdType, kycVerify=:kycVerify, kycDate=:kycDate WHERE userid=:userid");
	   $stmt->bindParam(":idFront", $idFront, PDO::PARAM_STR);
	   $stmt->bindParam(":kycIdType", $kycIdType, PDO::PARAM_STR);
	   $stmt->bindParam(":kycVerify", $kycVerify, PDO::PARAM_STR);
	   $stmt->bindParam(":kycDate", $kycDate, PDO::PARAM_STR);
	   $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	   $stmt->execute();
	   if($stmt){
		   
			//Load Image
			$sql=$pdo->prepare("SELECT idFront, idBack FROM users WHERE userid=:userid");
			$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
			$sql->execute();
			$row=$sql->fetch();
			$idFront = (!empty($row["idFront"]) ? "../images/kyc/".$row["idFront"]: "../images/avatar.png");
		
			// show continue btn if both id is uploaded
			if(!empty($row["idFront"]) && !empty($row["idBack"])){
				echo '
				<script>
				$(".continue").removeClass("display-none");
				</script>';
			}

			echo '
				<script>
				$("#idFrontResult").attr("src", "'.$idFront.'");
				$(".lab1").html("Re-Upload");

				 $(".err1").html("<div class=\"alert alert-success alert-icon\"><em class=\"icon ni ni-check-circle\"></em> <strong>Successful</strong>. Your front <strong class=\"text-capitalize\">'.$kycIdType.'</strong> Uploaded</div>");
	
				</script>';
	  }
	   
	  }
	 }
	}
	
	
	function file_already_upload($idFront, $pdo)
	{
	 $userid = $_SESSION["user_login"];
	 
	 $statement = $pdo->prepare("SELECT idFront FROM users WHERE userid=:userid");
	 $statement->bindParam(":userid", $userid, PDO::PARAM_STR);
	 $statement->execute();
	 $getStmt = $statement->fetch();
	 if(!empty($getStmt["idFront"]))
	 {
	  return true;
	 }
	 else
	 {
	  return false;
	 }
	}















//UPDATE KYC BACK
if(isset($_FILES["idBack"]["name"])){

	$kycIdType = htmlspecialchars($_POST["idType"]);
	$kycVerify = "pending";
	$kycDate = date("Y-m-d H:i:s");

	//Check and remove previous image on folder
	 $query=$pdo->prepare("SELECT idBack FROM users WHERE userid=:userid");
	 $query->bindParam(":userid", $userid, PDO::PARAM_STR);
	 $query->execute();
	 $prev = $query->fetch();
	 if(!empty($prev["idBack"]))
	 {
		@unlink('../images/kyc/'.$prev["idBack"]);
	 }
	 
	
	 for($count=0; $count<count($_FILES["idBack"]["name"]); $count++){
	  $idBack = $_FILES["idBack"]["name"][$count];
	  $tmp_name = $_FILES["idBack"]['tmp_name'][$count];
	  $file_array = explode(".", $idBack);
	  $file_extension = end($file_array);
	  if(file_already_up($idBack, $pdo))
	  {
	   $idBack = $file_array[0] . '-'. rand() . '.' . $file_extension;
	  }
	  $location = '../images/kyc/' . $idBack;
	  if(move_uploaded_file($tmp_name, $location))
	  {
	   
	   $stmt=$pdo->prepare("UPDATE users SET idBack=:idBack, kycIdType=:kycIdType, kycVerify=:kycVerify, kycDate=:kycDate  WHERE userid=:userid");
	   $stmt->bindParam(":idBack", $idBack, PDO::PARAM_STR);
	   $stmt->bindParam(":kycIdType", $kycIdType, PDO::PARAM_STR);
	   $stmt->bindParam(":kycVerify", $kycVerify, PDO::PARAM_STR);
	   $stmt->bindParam(":kycDate", $kycDate, PDO::PARAM_STR);
	   $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	   $stmt->execute();
	   if($stmt){
		   
			//Load Image
			$sql=$pdo->prepare("SELECT idBack,idFront FROM users WHERE userid=:userid");
			$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
			$sql->execute();
			$row=$sql->fetch();
			$idBack = (!empty($row["idBack"]) ? "../images/kyc/".$row["idBack"]: "../images/avatar.png");
		
			// show continue btn if both id is uploaded
			if(!empty($row["idFront"]) && !empty($row["idBack"])){
				echo '
				<script>
				$(".continue").removeClass("display-none");
				</script>';
			}

			echo '
				<script>
				$("#idBackResult").attr("src", "'.$idBack.'");
				$(".lab2").html("Re-Upload");

				 $(".err2").html("<div class=\"alert alert-success alert-icon\"><em class=\"icon ni ni-check-circle\"></em> <strong>Successful</strong>. Your front <strong class=\"text-capitalize\">'.$kycIdType.'</strong> Uploaded</div>");
	
				</script>';
	  }
	   
	  }
	 }
	}
	
	
	function file_already_up($idBack, $pdo)
	{
	 $userid = $_SESSION["user_login"];
	 
	 $statement = $pdo->prepare("SELECT idBack FROM users WHERE userid=:userid");
	 $statement->bindParam(":userid", $userid, PDO::PARAM_STR);
	 $statement->execute();
	 $getStmt = $statement->fetch();
	 if(!empty($getStmt["idBack"]))
	 {
	  return true;
	 }
	 else
	 {
	  return false;
	 }
	}













		//Toggle Skin mode
		if(isset($_POST["skinMode"])){
		
			$skin = $_POST["skinMode"];
		
			$stmt = $pdo->prepare("UPDATE preference SET skin=:skin WHERE userid=:userid");
			$stmt->bindParam(":skin",$skin,PDO::PARAM_STR);
			$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
			$stmt->execute();
			if($stmt){echo $skin;}
		}



			//ui Design
			if(isset($_POST["uiDesign"])){
		
				$uiDesign = $_POST["uiDesign"];
			
				$stmt = $pdo->prepare("UPDATE preference SET uiDesign=:uiDesign WHERE userid=:userid");
				$stmt->bindParam(":uiDesign",$uiDesign,PDO::PARAM_STR);
				$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
				$stmt->execute();
				if($stmt){echo $uiDesign;}
			}
			