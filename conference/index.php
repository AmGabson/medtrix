
<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);


include("../include/config.php");
session_start();

if(isset($_SESSION["user_login"])){
$userid = $_SESSION["user_login"];
}else{
header("location: ../login.php");
}




//get user info
$stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch();
$userimage = (!empty($row["profilepix"]) ? "../images/users/".$row["profilepix"]: "../images/avatar.svg");



//get preferences
$stmt=$pdo->prepare("SELECT * FROM preference WHERE userid = :userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$pref=$stmt->fetch();

?>





<!DOCTYPE html>
<body lang="zxx" class="js">
<head>
<title>Patient Consultation | Medtrix</title>
<?php include("../metaTags.php");?>


<script defer="defer" src="static/js/main.2e13d363.js"></script>
<link href="static/css/main.c396dbb9.css" rel="stylesheet">
<noscript>You need to enable JavaScript to run this app.</noscript>

</head>


<body>
<style>
body{
    background: rgb(5 10 14)!important;
}
 .parent-con{
margin-top: 20px;
border: 2px solid #122130;
border-radius: 20px;
 }
 .logo{
    position: relative;
    z-index:400;
    width: 150px;
    margin: auto;
    margin-top: 50px;
 }
 .video-con{
    /* border: 2px solid #122130;
    border-radius: 10px; */
 }
</style>

<a href="conference.php"><img src="../images/logo.png" class="logo"></a>
<div id="root"></div>


</body>
</html>