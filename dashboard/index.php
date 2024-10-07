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


// Include user Activity Browser/Device Track
include("storeUserBrowserInfo.php");


// START REFERRAL 

//Get and credit the referer if this user was invited or referred
//ref Session from Reg Page
if(isset($_SESSION["ref"])){
$refID = htmlspecialchars($_SESSION["ref"]);		//result will look like : "ref=eEF3d_22"

//split to get the referer user ID (the user who referred somebody) 
$refererID = explode("_", $refID)[1];

//Check if the referer ID is valid and not same user inviting himself
$stmt=$pdo->prepare("SELECT invite_ref, userid FROM users WHERE userid = :refererID");
$stmt->bindParam(":refererID", $refererID, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount()>0){

$check = $stmt->fetch();
if($check["invite_ref"] == $refID && $check["userid"] !== $userid){


//check if referee(the one invited) has been referred before
$stmt=$pdo->prepare("SELECT * FROM referral WHERE referee = :userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount()<1){


//Insert refs to referral table
$bonus = 3;		//$3 per ref
$status = "pending";		
$query=$pdo->prepare("INSERT INTO referral(userid,referee,bonus,status)VALUES(:refererID,:referee,:bonus,:status)");
$query->bindParam(":refererID", $refererID, PDO::PARAM_STR);
$query->bindParam(":referee", $userid, PDO::PARAM_STR);
$query->bindParam(":bonus", $bonus, PDO::PARAM_STR);
$query->bindParam(":status", $status, PDO::PARAM_STR);
$query->execute();

}
}
}
}



//Check if the referred user (referee) have made payment so you can credit the referer(one who invited)

//Get the referred user (referee) id using the userid
$stmt=$pdo->prepare("SELECT * FROM referral WHERE referee = :userid AND status='pending'");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount()>0){

$checkRef = $stmt->fetch();

$refereeId = $checkRef["referee"];		//referee ID
$theRow = $checkRef["id"];				//The row Id of the selected row above (will be used to update row staus as paid)
$theReferrer = $checkRef["userid"];


//if there's any pending referee, then get the referee id and check if he has a deposit history

//Check Referee transactions history if there's any approved deposit
$query=$pdo->prepare("SELECT * FROM transactions WHERE userid = :userid AND type='investment' AND status='approved' ");
$query->bindParam("userid", $refereeId, PDO::PARAM_STR);
$query->execute();
if($query->rowCount()>0){

//if user has transacted b4, then credit the referer (one who referred) with $3

//Get his account Bal and Add $3
$stmt=$pdo->prepare("SELECT * FROM account WHERE userid = :userid");
$stmt->bindParam(":userid",$theReferrer, PDO::PARAM_STR);
$stmt->execute();
$refBal=$stmt->fetch();


//Get Ref Bonus
$stmt=$pdo->prepare("SELECT refBonus FROM control");
$stmt->execute();
$getRefBonus=$stmt->fetch();

//Increment balance with $3
$newBal = $refBal["balance"] + $getRefBonus["refBonus"];


//Update the Acct. Balance of referer (one who referred somebody) 
$query=$pdo->prepare("UPDATE account SET balance = :balance WHERE userid=:userid");
$query->bindParam(":balance", $newBal, PDO::PARAM_STR);
$query->bindParam(":userid", $theReferrer, PDO::PARAM_STR);
$query->execute();

if($query){
//Now mark Ref status as paid by upating ref table
$stmt=$pdo->prepare("UPDATE referral SET status ='paid' WHERE id=:id");
$stmt->bindParam(":id", $theRow, PDO::PARAM_STR);
$stmt->execute();
}


}	
}


// END REFERRAL







//Get Ref Bonus
$stmt=$pdo->prepare("SELECT refBonus FROM control");
$stmt->execute();
$getRefBonus=$stmt->fetch();
$getRefBonus = $getRefBonus["refBonus"];


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


//redirect incase it was admin
if($row["type"]=="admin"){
header("location: ../admin");
}
elseif($row["type"]=="specialist"){
header("location: ../specialist");
}



//Get User Account Balance
$stmt="SELECT * FROM account WHERE userid = :userid";
$stmt=$pdo->prepare($stmt);
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$actBal=$stmt->fetch();


//get solana Wallet
$stmt=$pdo->prepare("SELECT * FROM solana WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$exists = $stmt->rowCount();
$solana=$stmt->fetch();


//Count User pending Withdrawal transactions
$stmt="SELECT COUNT(*) AS withdraw FROM transactions WHERE userid = :userid AND type='withdrawal' AND status='pending' ";
$stmt=$pdo->prepare($stmt);
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$withdraw=$stmt->fetch();



//Get Total Referal Earnings
$stmt = $pdo->prepare("SELECT SUM(bonus) AS bonus FROM referral WHERE userid=:userid AND status ='paid'");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
$countRefs = $stmt->rowCount();
$refBonuses = $stmt->fetch();
if(isset($refBonuses["bonus"])){ $refBonus = $refBonuses["bonus"];}else {$refBonus = 0;}


//Delete previous temp solana pay record incase there is
$stmt = $pdo->prepare("DELETE FROM solanaParams WHERE userid=:userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
?>





<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
<title>Dashboard | Medtrix</title>
<?php include("../metaTags.php");?>


<link rel="stylesheet" href="../assets/css/dashlite.css">
<link id="skin-default" rel="stylesheet" href="../assets/css/theme.css">
</head>






<body class="nk-body ui-rounder has-sidebar ui-rounder 
<?php 
if(!empty($_GET["wallet"]) && $_GET["wallet"] =="connected"){echo 'modal-open ';}

if(!empty($pref["skin"])){ echo " ".$pref["skin"]." ";}
if(!empty($pref["uiDesign"])){echo " ". $pref["uiDesign"] ." ";}

?>
"
<?php 
if(!empty($_GET["wallet"]) && $_GET["wallet"] =="connected"){
echo 'style="overflow: hidden; padding-right: 0px;"';
} 
?>
>



<?php if(isset($solana["balance"]) && isset($_GET["wallet"]) && $_GET["wallet"] =="connected"){echo '<div class="modal-backdrop fade show walletDrop"></div>';}?>


<div class="nk-app-root">
<div class="nk-main ">


<!-- Sidebar -->
<?php include "sidebar.php";?>



<div class="nk-wrap">
<!-- header -->
<?php include "header.php";?>


<div class="nk-content nk-content-fluid">
<div class="container-xl wide-xl">
<div class="nk-content-body">


<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title text-capitalize">
<?php if($pref["displayName"] == "fullName"){echo htmlspecialchars($row["fullName"]);}else{echo htmlspecialchars($row["username"]);}?>
</h3>
<div class="nk-block-des text-soft">
<p>Welcome to Medtrix Labs</p>
</div>
</div>
<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
<a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
<em class="icon ni ni-more-v"></em>
</a>
<div class="toggle-expand-content" data-content="pageMenu">
<ul class="nk-block-tools g-3">
<li>
<a href="consultation.php" class="btn btn-white btn-dim btn-outline-light">
<em class="icon ni ni-video"></em>
<span>
<span class="d-md-none">Consultation</span>
<span class="d-none d-md-block">Book Consultation</span>
</span>
</a>
</li>
<li class="nk-block-tools-opt">
<a href="deposit.php" class="btn btn-primary">
<em class="icon ni ni-sign-kobo-alt"></em>
<span>Deposit</span>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>



<div class="nk-block">
<div class="row g-gs">



<!-- Account and Wallet Balance Section -->
<div class="col-md-6">
<div class="card"><div class="card-inner">
<div class="card-title-group align-start mb-2">
<div class="card-title">
<h6 class="title">Account | Token Balance</h6>
<p>Percentage deposit In last 30 days.</p>
</div>
<div class="card-tools"><em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Total wallet and token balance" data-bs-original-title="Total wallet and token balance"></em></div>
</div>
<div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
<div class="nk-sale-data-group flex-md-nowrap g-4"><div class="nk-sale-data">
<span class="amount">&#8358;<?php echo number_format($actBal["deposit"], 2, '.', ',');?>
<span class="change down text-danger">
<em class="icon ni ni-arrow-long-down"></em>16.93%</span>
</span>
<span class="sub-title">Wallet Balance</span>
</div>
<div class="nk-sale-data">
<span class="amount"><?php echo intval($actBal["token"]);?> <span class="change up text-success">
<em class="icon ni ni-arrow-long-up"></em>4.26%</span></span>
<span class="sub-title">Tokens Earned</span></div></div>
</div>
</div>
</div>
</div>


<div class="col-md-6">
<div class="card">
<div class="card-inner">
<div class="card-title-group align-start mb-2">
<div class="card-title">
<h6 class="title">
<img class="logo-dark position-absolute" src="../images/solana-dark.png" width="100px">
<img class="logo-light" src="../images/solanaLogo.svg" width="100px">
</h6>
<p>
<?php if(isset($solana["balance"])){echo "Deposit chart from transactions";}else{echo "Connect wallet to retrieve balance";}?></p>

</div>
<div class="card-tools"><em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Connected Wallet Balance" data-bs-original-title="Connected Wallet Balance"></em>
</div>
</div>
<div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
<div class="nk-sale-data">
<span class="amount">
<?php if(isset($solana["balance"])){?> 
<?php echo htmlspecialchars($solana["balance"]);?> SOL</span>
<span class="sub-title">
<span class="change down text-danger">
<em class="icon ni ni-sign-usd"></em>0.00</span>Paid from wallet
</span>
<?php }else{?>
<a data-bs-dismiss="modal" data-bs-toggle="modal" href="#confirmConnect" class="btn btn-primary">Connect Solana &nbsp; <em class="icon ni ni-link"></em></a>
<div class="sub-title mt-1">
<div class="change down text-danger">
Wallet not connected 
</div>
</div>
<?php }?>
</div>
<div class="nk-sales-ck text-right">
<?php if(isset($solana["balance"])){?> 
<canvas class="sales-bar-chart" id="activeSubscription" width="389" height="112" style="display: block; box-sizing: border-box; height: 56px; width: 194px;"></canvas>
<?php }else{?>
<div class="mt-n3" style="display:flex; justify-content: center;opacity:0.2">
<img src="../images/solanaPNG.png" width="90px">
</div>
<?php }?>

</div>
</div>
</div>
</div>
</div>
<!--/ Account and Wallet Balance Section -->








<!--1st Confirm connect  wallet modal -->
<div class="modal fade" tabindex="-1" id="confirmConnect" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-md">
<div class="modal-content">
<a href="#" class="close" data-bs-dismiss="modal" data-bs-toggle="modal" href="#confirmConnect">
<em class="icon ni ni-cross-sm"></em></a>
<div class="modal-body modal-body-lg text-center">
<div class="nk-modal">
<img class="logo-dark position-absolute" src="../images/solana-dark.png" width="300px">
<img class="logo-light" src="../images/solanaLogo.svg" width="300px">
<div class="nk-modal-text">
<p class="sub-text mt-3">Proceed to connect <strong>Solana wallet</strong>.</p>
</div>
<div class="nk-modal-action-lg">
<ul class="btn-group flex-wrap justify-center g-4">
<li>
<a href="#" class="btn btn-lg btn-mw btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" href="#confirmConnect">Cancel</a>
</li>
<li>
<a href="../index.php?solana=request" class="btn btn-lg btn-mw btn-primary btn-dim">
Continue &nbsp; <em class="icon ni ni-external-alt"></em></a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- / -->






<!--Success Wallet Connected Modal -->
<?php if(isset($solana["balance"]) && isset($_GET["wallet"]) && $_GET["wallet"] =="connected"){?>

<div class="modal fade show" tabindex="-1" id="walletModal" aria-hidden="true" style="display: block;">
<div class="modal-dialog modal-dialog-centered modal-md">
<div class="modal-content loadingCon">
<div class="card card-bordered card-preview">
<div class="card-inner">
<div class="text-center">
<div class="spinner-border" role="status">
<span class="visually-hidden">Loading...</span></div>
</div>
</div>
</div>
</div>

<div class="modal-content display-none successCon" id="successCon">
<a href="#" class="close closeWalletModal"><em class="icon ni ni-cross-sm"></em></a>
<div class="modal-body modal-body-lg text-center">
<div class="nk-modal"><em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
<h4 class="nk-modal-title">Wallet Connected!</h4>
<div class="nk-modal-text">
<p class="sub-text">You've successfully connected your <strong>Solana wallet</strong>.</p>
<p class="sub-text"><strong>SOL Balance: <?php echo htmlspecialchars($solana["balance"]);?></strong></p>
</div>
<div class="nk-modal-action-lg">
<ul class="btn-group flex-wrap justify-center g-4">
<li>
<a href="#" class="btn btn-lg btn-mw btn-danger">Disconnect</a>
</li>
<li>
<a class="btn btn-lg btn-mw btn-primary closeWalletModal" id="closeWalletModal">Continue</a>
</li>
</ul>
</div>
</div>
</div>
<div class="modal-footer bg-lighter">
<div class="text-center w-100"><p>Earn upto $3 for each friend your refer! <a href="referral.php">Invite friends</a></p>
</div>
</div>
</div>
</div>
</div>


<script>
$(document).ready(function(){
//close pop success wallet connect modal
$(".closeWalletModal").click(function(){
$("body").attr("style", "").removeClass("modal-open");
$(".walletDrop").hide();
$("#walletModal").hide();
});

//show loader before wallet connected success popup
setTimeout(()=>{
$(".loadingCon").addClass("display-none");
$(".successCon").removeClass("display-none");
}, 1000);
});



//remove the url parameter when modal close btn is clicked
document.getElementById('successCon').addEventListener('click', function() {
const url = new URL(window.location);
url.search = ''; // Remove query parameters
history.replaceState({}, '', url);
});
</script>

<?php }?>









<!-- Hospitals and Booking Section -->
<div class="col-xxl-6 col-lg-7">
<div class="card card-full">
<div class="card-inner">
<div class="card-title-group">
<div class="card-title">
<h6 class="title">Top Channels</h6></div>
<div class="card-tools">
<a href="#" class="link">View All</a>
</div>
</div>
</div>
<div class="card-inner pt-0">
<ul class="gy-4">
<li class="justify-between align-center border-bottom border-0 border-dashed">
<div class="align-center"><div class="user-avatar sq bg-transparent" style="width:60px">
<img src="../images/call.png" alt="">
</div>
<div class="ms-2">
<div class="lead-text">Request Appointment </div>
<div class="sub-text">Apply to meet a Specialist</div>
</div>
</div>
<div class="align-center">
<a href="consultation.php" class="btn btn-white btn-dim btn-outline-light">
<span>Apply Now</span>
</a>
</div>
</li>
<li class="justify-between align-center border-bottom border-0 border-dashed">
<div class="align-center">
<div class="user-avatar sq bg-transparent" style="width:60px">
<img src="../images/FABox.png" alt="">
</div>
<div class="ms-2">
<div class="lead-text">Medical Records </div>
<div class="sub-text">Complete update your EHrs</div>
</div></div>
<div class="align-center">
<div class="sub-text me-2">70%</div>
<div class="progress rounded-pill w-80px">
<div class="progress-bar bg-success rounded-pill" data-progress="25" style="width: 25%;"></div>
</div>
</div>
</li>
<li class="justify-between align-center border-bottom border-0 border-dashed"><div class="align-center">
<div class="user-avatar sq bg-transparent" style="width:60px">
<img src="../images/lil-doc.png" alt="" width="45px"></div><div class="ms-2">
<div class="lead-text">Secure Messaging </div>
<div class="sub-text">Communicate with healthcare providers</div></div>
</div>
<div class="align-center">
<a href="#" class="btn btn-primary">
<span>Start</span>
<em class="icon ni ni-msg-circle"></em>
</a>
</div>
</li>
</ul>
</div>
</div>
</div>



<div class="col-xxl-6 col-lg-5">
<div class="card card-full"><div class="card-inner">
<div class="card-title-group">
<div class="card-title"><h6 class="title">Nearby Hospitals | Labs</h6>
</div><div class="card-tools me-n1 mt-n1">
<div class="dropdown"><a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" aria-expanded="false">
<em class="icon ni ni-more-h"></em></a>
<div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
<ul class="link-list-opt no-bdr">
<li>
<a href="#" class="active"><span>First 5 rows</span></a>
</li>
<li>
<a href="#"><span>Next 5 rows</span></a>
</li>
<li>
<a href="#"><span>View All</span></a></li>
</ul></div>
</div></div>
</div></div>
<div class="card-inner pt-0">
<ul class="my-n2">
<li class="align-center justify-between py-1 gx-1 border-bottom border-0 border-dashed"><div class="lead-text">Specialist (DASH)</div>
<div class="sub-text">About 50 Doctors</div>
</li>
<li class="align-center justify-between py-1 gx-1 border-bottom border-0 border-dashed">
<div class="lead-text">Bafawat Lab</div>
<div class="sub-text">About 25 Specialist</div>
</li>
<li class="align-center justify-between py-1 gx-1 border-bottom border-0 border-dashed"><div class="lead-text">Namo Clinic</div>
<div class="sub-text">21 Doctors</div>
</li>
<li class="align-center justify-between py-1 gx-1 border-bottom border-0 border-dashed"><div class="lead-text">M & D</div>
<div class="sub-text">28 Doctors</div>
</li>
<li class="align-center justify-between py-1 gx-1 border-bottom border-0 border-dashed"><div class="lead-text">Police Clinic</div>
<div class="sub-text">15 Doctors</div>
</li>
</ul>
</div>
<div class="align-center p-2">
<a href="consultation.php" class="btn btn-white btn-dim btn-outline-light btn-block">
<span>View all locations </span>
</a>
</div>
</div>
</div>
<!-- /Hospitals and Booking Section -->









<!-- Game Section -->
<div class="col-md-12 mb-1">
<!-- Head -->
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">
Play Games</h3>
<div class="nk-block-des text-soft">
<p>Earn more tokens by playing games</p>
</div>
</div>
<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
<a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
<em class="icon ni ni-more-v"></em>
</a>
<div class="toggle-expand-content" data-content="pageMenu">
<ul class="nk-block-tools g-3">
<li>
<a href="../games/games.php" class="btn btn-white btn-dim btn-outline-light">
<em class="icon ni ni-play-circle"></em>
<span>
<span class="d-md-none">More Games</span>
<span class="d-none d-md-block">More Games</span>
</span>
</a>
</li>

</ul>
</div>
</div>
</div>
</div>
</div>
<!-- /Head -->


<div class="slider-init" data-slick='{"arrows": false, "dots": true, "slidesToShow": 3, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}} ]}'>

<?php
$stmt=$pdo->prepare("SELECT * FROM games");
$stmt->execute();
$games=$stmt->fetchAll();
foreach($games as $game){
$gamePix = !empty($game["image"]) ? "../images/games/".$game["image"]: "../images/games/game.png";

$stmt=$pdo->prepare("SELECT u.fullName, u.profilepix, l.* 
                        FROM users u JOIN leaderboard l 
                        WHERE u.userid = l.userid AND gameId =:gameId");
$stmt->bindParam(":gameId", $game["gameId"], PDO::PARAM_INT);
$stmt->execute();
$lead=$stmt->fetch();
$leadPix = (!empty($lead["profilepix"]) ? "../images/users/".$lead["profilepix"]: "../images/avatar.svg");

// Breaker
if(isset($lead["fullName"])){
    $name = 
    '<div class="d-flex mt-n1" style="align-items:center">
    <img src="'.$leadPix.'" alt="'.$lead["fullName"].'"  style="height:30px; width:30px;border-radius:100px" class="border"> &nbsp;&nbsp;  <strong data-bs-placement="top" aria-label="'.$lead["fullName"].'" data-bs-toggle="tooltip" data-bs-original-title="'.$lead["fullName"].'"> ' . htmlspecialchars($lead["fullName"]) . "</strong></div>";
}else{$name = "<div class='mt-n1'><strong>Nobody</strong></div>";}
?>  

<div class="col">
<div class="card">
<img src="<?php echo $gamePix;?>" alt="<?php echo htmlspecialchars($game["title"]);?>" class="card-img-top" style="padding:10px; height:290px;border-radius:20px!important">
<div class="card-inner mt-n3">
<h5 class="card-title"><?php echo htmlspecialchars($game["title"]);?></h5>
<p class="card-text border-top"><?php echo $name;?> Is currently holding the record. Break the record to gain tokens.</p>
<a href="../games/<?php echo $game["folderName"];?>" class="btn btn-white btn-dim btn-outline-light">
<em class="icon ni ni-play-circle"></em> &nbsp; PLAY NOW </a>
</div>
</div>
</div>

<?php }?>

</div>
</div>
<!--/ Game Section -->













<!-- Transaction table -->
<div class="col-md-12">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">
Appointment Transactions</h3>
<div class="nk-block-des text-soft">
<p>Approved, Declined and Pending Appointments</p>
</div>
</div>
<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
<a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
<em class="icon ni ni-more-v"></em>
</a>
<div class="toggle-expand-content" data-content="pageMenu">
<ul class="nk-block-tools g-3">
<li>
<a href="transactions.php" class="btn btn-white btn-dim btn-outline-light">
<span>
<span class="d-md-none">Transactions</span>
<span class="d-none d-md-block">Transactions</span>
</span>
<em class="icon ni ni-chevron-right"></em>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>



<div class="card card-preview mt-n1">
<div class="card-inner">
<table class="datatable-init-export table">
<thead>
<tr>
<th>Appointment</th>
<th>Action</th>
<th>Date</th>
<th>Time</th>
<th>Ref</th>
<th>Status</th>
</tr>
</thead>
<tbody>

<?php
$stmt=$pdo->prepare(
                    "SELECT c.*, ct.type FROM consultations c 
                    JOIN consultationType ct
                    ON c.consultId  = ct.consultId
                    WHERE c.userid=:userid");

$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
$appointments=$stmt->fetchAll();
foreach($appointments as $appointment){
?>  

<tr>
<td class="text-capitalize">
<strong class="text-blue"><?php echo htmlspecialchars($appointment["type"]) . "</strong>";?></td>
<td><a href="" class="btn btn-sm btn-success btn-dim p-1 pt-0 pb-0">Details</a></td>
<td><?php echo htmlspecialchars($appointment["preferredDate"]);?></td>
<td><?php echo htmlspecialchars($appointment["preferredTime"]);?></td>
<td><?php echo htmlspecialchars($appointment["ref"]);?></td>
<td class='text-capitalize <?php if($appointment["status"]=="pending"){echo "text-warning";}
            elseif($appointment["status"]=="declined"){echo "text-danger";}else{echo "text-success";}?>'>
<?php echo htmlspecialchars($appointment["status"]);?>
</td>
</tr>

<?php }?>

</tbody>
</table>
</div>
</div>
</div>
<!-- /Transaction table -->








</div>
</div>


</div>
</div>
</div>


<!-- Footer -->
<?php include("footer.php");?>


<script src="../assets/js/bundle.js?ver=3.2.3"></script>
<script src="../assets/js/scripts.js?ver=3.2.3"></script>
<script src="../assets/js/charts/chart-invest.js?ver=3.2.3"></script>
<script src="../assets/js/charts/gd-default.js"></script>
<script src="../assets/js/data-table/datatable-btns.js"></script>



<script>
$(".hmm").removeClass("active");
</script>

</body>
</html>
