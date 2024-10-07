<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../include/config.php";
session_start();

if(isset($_SESSION["user_login"])){
	$userid = $_SESSION["user_login"];
    
		//get user info
		$stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch();
		$userimage = !empty($row["profilepix"]) ? "../../images/users/".$row["profilepix"]: "../../images/avatar.svg";

		//get user Tokens
		$stmt=$pdo->prepare("SELECT token FROM account WHERE userid = :userid");
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$token=$stmt->fetch();
}





// Get Game
//Level 1 Champion
$stmt = $pdo->prepare("SELECT u.fullName, u.profilepix, 
                        l.gameId, l.trials, l.timeFrame, l.gameLevel, l.dateTime
                        FROM users u 
                        JOIN
                        leaderboard l
                        WHERE u.userid = l.userid 
                        AND
                        l.gameId = 1 AND l.gameLevel = 1");
$stmt->execute();
$level1 = $stmt->fetch();
$level1Img = !empty($row["profilepix"]) ? "../../images/users/".$row["profilepix"]: "../../images/avatar.svg";
?>




<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Games | MEDTRIX</title> 

  <link href="https://fonts.googleapis.com/css?family=Lexend+Deca|Be+Vietnam|Montserrat&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/splashStyle.css">
<link rel="stylesheet" href="css/game-style.css">
<link id="skin-default" rel="stylesheet" href="../../assets/css/ni-icons.css">
<script src="../../assets/js/jquery.min.js"></script>
</head>
<body>  
  



<!-- MEDTRIX TEXT -->
<div class="container">
  <span class="title">M</span>
  <span class="title">E</span>
  <span class="title">D</span>
  <span class="title">T</span>
  <span class="title">R</span>
  <span class="title">I</span>
  <span class="title">X</span>
</div> 
<!-- /MEDTRIX TEXT -->



<!-- IMAGE SPLASH SCREEN -->
<div class="splash-screen hide" id="splash-screen">
<img src="images/quiz.png" class="img">
<h2 id="title">Test of Current Awareness</h2> 
<button id="start-button" class="start_btn">Start Quiz</button>
<br>
<div class="bLinks">
<a href="../../index.php"><em class="icon ni ni-home-alt"></em> Home</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href="../games.php"><em class="ni ni-windows"></em> More Games </a>
</div>
</div>




<script>
  let splash = document.getElementById('splash-screen');
  setTimeout(function(){
  splash.classList.remove("hide");
  }, 4100)

  document.getElementById('start-button').addEventListener('click', function() {
  // Fade out splash screen and then load the game
  document.querySelector('.splash-screen').style.animation = 'fadeOut 1s ease-out';
  setTimeout(() => {
  document.querySelector('.splash-screen').style.display = 'none';
  // Code to start or transition to the game
 // Replace with actual game logic
 document.getElementById("gameWraper").classList.remove("mtop");
  }, 1000);

  // Drop Nav
  setTimeout(() => {
 document.getElementById("gameNav").classList.remove("mtop");
  }, 1700);
  setTimeout(() => {
 document.getElementById("token").classList.add("tokenAni");
  }, 2400);
  setTimeout(() => {
 document.getElementById("token").classList.remove("tokenAni");
  }, 5000);


  });
</script>
<!-- IMAGE SPLASH SCREEN -->








<!-- THE GAME -->
<div class="wrapper mtop" id="gameWraper">









</div>
<script src="js/game-script.js"></script>
<script src="js/questions.js"></script>

<!-- /THE GAME -->





<!-- Celebration Blast -->
 <?php include "blast.html";?>


</body>
</html>
