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
$level1Img = !empty($level1["profilepix"]) ? "../../images/users/".$level1["profilepix"]: "../../images/avatar.svg";

//Level 2 Champion
$stmt = $pdo->prepare("SELECT u.fullName, u.profilepix, 
                        l.gameId, l.trials, l.timeFrame, l.gameLevel, l.dateTime
                        FROM users u 
                        JOIN
                        leaderboard l
                        WHERE u.userid = l.userid 
                        AND
                        l.gameId = 1 AND l.gameLevel = 2");
$stmt->execute();
$level2 = $stmt->fetch();
$level2Img = !empty($level2["profilepix"]) ? "../../images/users/".$level2["profilepix"]: "../../images/avatar.svg";


//Level 3 Champion
$stmt = $pdo->prepare("SELECT u.fullName, u.profilepix, 
                        l.gameId, l.trials, l.timeFrame, l.gameLevel, l.dateTime
                        FROM users u 
                        JOIN
                        leaderboard l
                        WHERE u.userid = l.userid 
                        AND
                        l.gameId = 1 AND l.gameLevel = 3");
$stmt->execute();
$level3 = $stmt->fetch();
$level3Img = !empty($level3["profilepix"]) ? "../../images/users/".$level3["profilepix"]: "../../images/avatar.svg";
?>


<!-- Pass Previous DB Record to JS -->
<script>
// level 1 values
var recordFlip1 = <?php echo intval($level1["trials"]);?>;
var recordTime1 = <?php echo intval($level1["timeFrame"]);?>;

// level 2 values
var recordFlip2 = <?php echo intval($level2["trials"]);?>;
var recordTime2 = <?php echo intval($level2["timeFrame"]);?>;
  
// level 3 values
var recordFlip3 = <?php echo intval($level3["trials"]);?>;
var recordTime3 = <?php echo intval($level3["timeFrame"]);?>;
</script>




<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Cards Game - Splash Screen</title> 

  <link href="https://fonts.googleapis.com/css?family=Lexend+Deca|Be+Vietnam|Montserrat&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/splashStyle.css">
<link rel="stylesheet" href="css/game-style.css">
<link id="skin-default" rel="stylesheet" href="../../assets/css/ni-icons.css">
<script src="../../assets/js/jquery.min.js"></script>

</head>
<body>  



  <nav id="gameNav" class="mtop">
  <section>
  <img src="<?php echo $userimage;?>" class="userImg">
  <h3><?php echo htmlspecialchars($row["username"]);?></h3>
  </section>

  <h3 id="token">
  <em class="icon ni ni-light-fill"></em> Token Earned: <span id="tokenCount"><?php echo number_format($token["token"]);?></span>
  </h3>
  </nav>
  
  <div id="timeUp" class="mtop"><span id="timeText">Time - </span> <span>0:</span><span id="sec">00</span></div>



<!-- MEDTRIX TEXT -->
<div class="container">
  <span class="sTitle">M</span>
  <span class="sTitle">E</span>
  <span class="sTitle">D</span>
  <span class="sTitle">T</span>
  <span class="sTitle">R</span>
  <span class="sTitle">I</span>
  <span class="sTitle">X</span>
</div> 
<!-- /MEDTRIX TEXT -->



<!-- IMAGE SPLASH SCREEN -->
<div class="splash-screen hide" id="splash-screen">
<img src="images/mem.png" class="img">
<h2 id="title">Memory Test <br> Beat the Records to gain Tokens</h2> 

<?php 
//if user is logged in
if(isset($_SESSION["user_login"])){
?>
<button id="start-button">Start Game</button>
<br>
<div class="bLinks">
<a href="../../index.php"><em class="icon ni ni-home-alt"></em> Home</a>
&nbsp; &nbsp; &nbsp; &nbsp;
<a href="#"><em class="ni ni-windows"></em> More Games </a>
</div>


<?php }else{?>
<a style="text-decoration: none;font-size:medium" href="../../login.php?game=MemoryCards" id="start-button">Login to Continue</a>
<?php }?>
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

<!-- Banner to show if all pages completed -->
<section class="gameCompleted display-none">
<center>
<img src="images/memComplete.png" width="100%">
</center>
<div class="statBtn">
<a onclick="location.reload();" class="controlBtn" style="text-decoration:none; text-align:center;width:46%;font-size:13px">
Restart Game <em class="ni ni-undo"></em>
</a>
<button style="text-align:center;width:46%!important;font-size:13px" class="dropBtn">
<text>Leader Board</text> <em class="ni ni-award"></em></button>
</div>
<!--when game ends, embed leader board on div -->
<div id="leaderBoardContent" style="margin-top:-30px"></div>

<div class="bLinks" style="margin-top:20px">
<a href="../../index.php"><em class="icon ni ni-home-alt"></em> Home</a>
<a href="../games.php"><em class="ni ni-windows"></em> More Games </a>
</div>
</section>



<!-- Game Container -->
<section class="game-container">
<center>
<img src="images/cardMem.png" width="200px" style="margin-bottom:20px">
<section id="successMsg">
<img src="images/levelUp.png" alt="Level Up" style="width:100px; margin-top:-40px">
<br>
<h2 class="congrats">Congratulations</h2>

<!-- Show award if new record broken -->
<div id="award" class="display-none">
<div class="newR">New Record</div>
<img src="images/trophy.gif" alt="trophy" style="width:100px; margin-top:-10px">
</div>
<div style="color:#fff;font-size: 13px;text-shadow: 0.1px 0.1px 2px #21448b;margin-top:10px">Time Elapsed: <span id="elapsed">20</span>s
</div>

<!-- User Score Board -->
<div class="details" style="height:auto;padding:20px;justify-content:space-around">
<p class="sTime" style="border:none">Countdown: <span>
<b>40</b>s</span></p>
<div style="color:#ccc;">|</div>
<p class="sFlips" style="border:none">Flips: <span>
<b>0</b></span></p>
</div>

<div class="statBtn">
<button id="hideBlast" class="controlBtn">
Replay &nbsp;<em class="ni ni-undo"></em>
</button>

<button class="nextlevelBtn controlBtn" data-level="2">
Next Level &nbsp;<em class="ni ni-forward-alt"></em>
</button>

<button class="nextlevelBtn controlBtn display-none" data-level="3">
Final Level &nbsp;<em class="ni ni-forward-alt"></em>
</button>

<button id="putBoard" class="lastBtn controlBtn display-none">
Continue &nbsp;<em class="ni ni-forward-alt"></em>
</button>

</div>
</section>
</center>



<ul class="cards" id="flipCards">

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>





<!-- Level tow (+ level one cards)-->
<li class="card card2 display-none">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card card2 display-none">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card card2 display-none">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card card2 display-none">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li> 
<!-- /Level two -->






<!-- Level Three (+ level one cards and level 2 cards)-->
<li class="card card3 display-none">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card card3 display-none">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card card3 display-none">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li>

<li class="card card3 display-none">
<div class="view front-view">
<img src="images/que_icon.svg" alt="icon">
</div>
<div class="view back-view">
<img src="" alt="card-img">
</div>
</li> 
<!-- /Level Three -->

<div class="details">
<p class="time">Time: <span><b>40</b>s</span></p>
<p class="flips">Flips: <span><b>0</b></span></p>
<button>Refresh</button>
</div>
</ul>





<!-- Leader Board -->

 <!-- Level 1 -->
<section id="leaderBoard">
<section class="statsDrop hideLead">
<span id="gameAjaxResult"></span>
<div class="block hideB display-none"></div>
<div class="desc">
<span id="nLevel1"><em class="icon ni ni-layers"></em> 
Level: <?php echo intval($level1["gameLevel"]);?></span>
<span id="nElapsed1"><em class="icon ni ni-clock"></em> 
Elapsed: <?php echo intval($level1["timeFrame"]);?>s</span>
<span id="nFlips1"><em class="icon ni ni-cards"></em> 
Flips: <?php echo intval($level1["trials"]);?></span>
</div>
<div class="leadBoard flex">
<img id="nImg1" src="<?php echo $level1Img?>" class="userImg">
<div>
<h3 id="nText1" class="leadText">
<?php echo htmlspecialchars($level1["fullName"]);?> <em class="icon ni ni-award"></em>
</h3>
<div id="nDate1" class="won">On 
<?php echo date("jS F, Y", strtotime($level1["dateTime"]));?>
</div>
</div>
<img src="images/trophy.gif" class="trophy">
</div>
</section>



 <!-- Level 2 -->
<section class="statsDrop hideLead">
<div class="block hideB display-none"></div>
<div class="desc">
<span id="nLevel2"><em class="icon ni ni-layers"></em> 
Level: <?php echo intval($level2["gameLevel"]);?></span>
<span id="nElapsed2"><em class="icon ni ni-clock"></em> 
Elapsed: <?php echo intval($level2["timeFrame"]);?>s</span>
<span id="nFlips2"><em class="icon ni ni-cards"></em> 
Flips: <?php echo intval($level2["trials"]);?></span>
</div>
<div class="leadBoard flex">
<img id="nImg2" src="<?php echo $level2Img?>" class="userImg">
<div>
<h3 id="nText2" class="leadText">
<?php echo htmlspecialchars($level2["fullName"]);?> <em class="icon ni ni-award"></em>
</h3>
<div id="nDate2" class="won">On 
<?php echo date("jS F, Y", strtotime($level2["dateTime"]));?>
</div>
</div>
<img src="images/trophy.gif" class="trophy">
</div>
</section>


 <!-- Level 3 -->
<section class="statsDrop hideLead">
<div class="block hideB display-none"></div>
<div class="desc">
<span id="nLevel3"><em class="icon ni ni-layers"></em> 
Level: <?php echo intval($level3["gameLevel"]);?></span>
<span id="nElapsed3"><em class="icon ni ni-clock"></em> 
Elapsed: <?php echo intval($level3["timeFrame"]);?>s</span>
<span id="nFlips3"><em class="icon ni ni-cards"></em> 
Flips: <?php echo intval($level3["trials"]);?></span>
</div>
<div class="leadBoard flex">
<img id="nImg3" src="<?php echo $level3Img?>" class="userImg">
<div>
<h3 class="leadText" id="nText3">
<?php echo htmlspecialchars($level3["fullName"]);?> <em class="icon ni ni-award"></em>
</h3>
<div class="won" id="nDate3">On 
<?php echo date("jS F, Y", strtotime($level3["dateTime"]));?>
</div>
</div>
<img src="images/trophy.gif" class="trophy">
</div>
</section>
</section>

<button class="dropBtn">
<text>Leader Board</text> <em class="ni ni-award"></em>
</button>

<div class="bLinks">
<a href="../../index.php"><em class="icon ni ni-home-alt"></em> Home</a>
<a href="../games.php"><em class="ni ni-windows"></em> More Games </a>
</div>

<script>
  $(document).ready(function(){

    //when game ends, embed leader board on div
    $("#putBoard").click(()=>{
      $("#leaderBoardContent").html($("#leaderBoard").html())
    });

  // Drop Leader Board
  $(".dropBtn").click(()=>{
    $(".block").toggleClass("display-none");
    $(".block").toggleClass("hideB");
    $(".block").toggleClass("showB");
    
    $(".statsDrop").css({"display":"block"});
    $(".statsDrop").toggleClass("hideLead");
    $(".statsDrop").toggleClass("showLead");
    console.log($(".dropBtn").html());
    
    if($(".dropBtn text").html() == "Leader Board"){
      $(".dropBtn text").html("Hide Board");
    }else{
      $(".dropBtn text").html("Leader Board");
    }
  });
});
</script>

</section>
<!-- /End Game Container -->


</div>
<script src="js/game-script.js"></script>
<!-- /THE GAME -->





<!-- Celebration Blast -->
 <?php include "blast.html";?>


</body>
</html>
