<?php
include("config.php");
session_start();

			function validate($str){
			return trim(htmlspecialchars(strip_tags(($str))));
		}




	if(isset($_POST["reset"])){

	$email = htmlspecialchars(strip_tags($_POST["email"]));

			if(!preg_match('/^[a-zA-Z0-9@\.s]+$/',$email)){
			$errorMsg[] = "Invalid email or Username";
		
		}else{
		
		try{
			
			$query="SELECT * FROM users WHERE ";
					if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
						$query .="email=:email";
					}else{
						$query .="username=:email";
					}
			
			$stmt=$pdo->prepare($query);
			$stmt->bindValue(":email",$email,PDO::PARAM_STR);
			$stmt->execute();
			$result=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount()>0){

			$query="SELECT * FROM users WHERE ";
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
					$query .="email=:email";
				}else{
					$query .="username=:email";
				}
				$stmt=$pdo->prepare($query);
				$stmt->bindValue(":email",$email,PDO::PARAM_STR);
				$stmt->execute();
				$row=$stmt->fetch();
				$userimage = (!empty($row["profilepix"]) ? "images/users/".$row["profilepix"]: "images/avatar.png");
				$name = htmlspecialchars($row["username"]);
				$mail = htmlspecialchars($row["email"]);
		
					
				echo "
				<script>
				
				$('span#log').hide();
				$('h2#roll').show();
				
				//hide form
				$('#loginform').fadeOut('fast');
				$('#successCon').removeClass('display-none').fadeIn(2000);
				$('#imgResult').prop('src', '$userimage');
				$('#User').html('$name');
				$('#mail').html('$mail');
				$('#Etext').html('Token sent to ');

				</script>";
				


			//create random token and update database 
			$mix = "1234567890";
			$token = substr(str_shuffle($mix), 0, 6);

			$stmt=$pdo->prepare("UPDATE users SET passwordReset=:token 
								WHERE email = :email OR username = :email");
			$stmt->bindParam(":token", $token, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();
			
			//send token to email
			require_once("mails/resetPasswordToken.php");

				
			}else{
				$errorMsg[] = "Username or email not registered";
			}
			
		}catch(PDOException $e){
			echo "Error in connection " . $e->getMessage();
		}
	}

 } 
 

 //error msg
if(isset($errorMsg)){
	foreach($errorMsg as $error){
	
		echo '<div class="alert mb-2 bg-danger-dim alert-dismissible alert-icon" data-bs-dismiss="alert"><em class="icon ni ni-alert"></em>'. $error .'<button class="close" data-bs-dismiss="alert"></div>';

	}
}

?>







<?php

//compare token to user token in db
if(isset($_POST["token"])){

			$token = htmlspecialchars(strip_tags($_POST["token"]));
			$email = htmlspecialchars(strip_tags($_POST["email"]));

			$query="SELECT * FROM users WHERE ";
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$query .="email=:email";
			}else{
				$query .="username=:email";
			}
			$stmt=$pdo->prepare($query);
			$stmt->bindValue(":email",$email,PDO::PARAM_STR);
			$stmt->execute();
			$row=$stmt->fetch();
			$userToken = $row["passwordReset"];

		if($userToken == $token){
			echo "<script>
					$('.nk-block-des p').html('Correct Token Supplied <em class=\'ni ni-check\'></em>').css({'color':'#0e8251'});
					$('#successCon').fadeOut();
					$('#pCon').removeClass('display-none').fadeIn();
				</script>";
		}else{
			echo "<script>
			$('div#tokenResult').html(\"<div class='alert mb-2 bg-danger-dim alert-dismissible alert-icon' data-bs-dismiss='alert'><em class='icon ni ni-alert'></em>Invalid token supplied<button class='close' data-bs-dismiss='alert'></div>\")
			</script>";
		}
}












	if(isset($_POST["password"])){

		$password = $_POST["password"];
		$email = $_POST["email"];
		$passwordReset = "";


		//hash password
		$newPassword = password_hash($password, PASSWORD_DEFAULT);

			$stmt=$pdo->prepare("UPDATE users SET password=:password, passwordReset=:passwordReset WHERE email = :email OR username = :email");
			$stmt->bindParam(":password", $newPassword, PDO::PARAM_STR);
			$stmt->bindParam(":passwordReset", $passwordReset, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt){
				echo "<script>
						$('.nk-block-des p').html('Changed Successfully <em class=\'ni ni-shield\'></em>').css({'color':'#0e8251'});
						$('#pCon').fadeOut();
						$('#sucOnchange').removeClass('display-none').fadeIn();
						setTimeout(()=>{
							location.href='login.php';
						},4000);
					</script>";
			}

	}




?>

