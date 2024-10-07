<?php
include "include/config.php";
session_start();

			function validate($str){
			return trim(htmlspecialchars(strip_tags(($str))));
		}


	$email = htmlspecialchars(strip_tags($_POST["email"]));
	$password = validate($_POST["password"]);

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
				
			if($email = $result["username"] OR $email = $result["email"]){
				
				if(password_verify($password, $result["password"])){
					$success = "Successful";

				$_SESSION["user_login"] = $result["userid"];
				
				
			
				//if user coming from game page, redirect back
				if(!empty($_POST["game"])){
					echo "
				<script>
		 		window.setTimeout(function(){
					location.href='games/".htmlspecialchars($_POST["game"])."'
				}, 4000);
				</script>";
				}
				
				//Login request from homepage, redirect back
				elseif(!empty($_POST["login"])){
					echo "
				<script>
				window.setTimeout(function(){
				location.href='index.php'
				}, 4000);
				</script>";
				}
				
				
				//check if admin or user then redirect
				elseif($result["type"] == "admin"){
					echo "
					<script>
					window.setTimeout(function(){
						location.href='admin';
					}, 5000);
					</script>
					";
					}else{

					echo "
				<script>
				window.setTimeout(function(){
					location.href='dashboard';
				}, 5000);
				</script>
				";
					
				}
		
				
				
				echo "
				<script>
				$('span#log').hide();
				$('span#roll').removeClass('display-none');

				</script>
				";
				
				}else{
					$errorMsg[] = "Access Denied! Invalid Details";
				}
				
			}else{
				$errorMsg[] = "Username or email not registered";
			}
				
			}else{
				$errorMsg[] = "Username or email not registered";
			}
			
		}catch(PDOException $e){
			echo "Error in connection " . $e->getMessage();
		}
	}

?>




<?php 

	//Success Message
	
	if(isset($success)){
	
		$userid = $_SESSION["user_login"];
		
		$stmt="SELECT * FROM users WHERE userid = :userid";
		$stmt=$pdo->prepare($stmt);
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch();
		$userimage = (!empty($row["profilepix"]) ? "images/users/".$row["profilepix"]: "images/avatar.png");

?>

	
	<div class="display-none text-center" id="successLoginRegContainer">
	<img style="width:100px; height:100px; border-radius:50%;border:2px solid #526484" src='<?php echo $userimage;?>'>
	
	<h4 class="nk-block-title mt-4 text-center text-capitalize">
	Welcome Back <?php echo htmlspecialchars($row["username"]);?>!
	</h4>

	<div class='alert mb-2 bg-success-dim alert-dismissible alert-icon' data-bs-dismiss='alert'><em class='icon ni ni-user'></em> Access Granted <button class='close' data-bs-dismiss='alert'></div>

	<div style="font-size:17px;font-weight:500" class='logs'>Please wait
	</div>
	<span id="roll" class="display-none">
	<div class="spinner-border m-5" role="status"><span class="visually-hidden">Loading...</span></div>
	</span>
	</div>

	<script>
	//hide form
	$("#loginform, .nk-block-head, .overline-title, .form-note-s2").fadeOut("fast");
	$("#successLoginRegContainer").removeClass("display-none").fadeIn(2000);
	</script>

  <?php } ?>
<!-- /Success Message -->





<!-- ERROR IF WRONG CREDENTIALS-->
<?php
if(isset($errorMsg)){
	foreach($errorMsg as $error){
	
	echo 
	'<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> '.$error.'<button class="close" data-bs-dismiss="alert"></button></div>';
	}
}
?>
