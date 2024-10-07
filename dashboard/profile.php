<?php
include("../include/config.php");
session_start();

if (isset($_SESSION["user_login"])) {
$userid = $_SESSION["user_login"];
} else {
header("location: ../login.php");
}



// Check if get Parameter isset for Tabs
if(!empty($_GET["tab"])){
$GetParameter = htmlspecialchars($_GET["tab"]);
}





//get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch();
$userimage = (!empty($row["profilepix"]) ? "../images/users/" . $row["profilepix"] : "../images/avatar.svg");


// Preferences
$stmt = $pdo->prepare("SELECT * FROM preference WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$pref = $stmt->fetch();


//redirect incase it was admin
if ($row["type"] == "admin") {
header("location: ../admin");
}



include("timeZone-countries.php");


	//Get User Account Balance
	$stmt="SELECT * FROM account WHERE userid = :userid";
	$stmt=$pdo->prepare($stmt);
	$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
	$stmt->execute();
	$actBal=$stmt->fetch();



// Get default Timezone Label (GMT +6:00) Based on timezone
$defaultTimeZone  = date_default_timezone_get();
function timeZoneLabel($timezoneIdentify) {
	$timezone = new DateTimeZone($timezoneIdentify);
	$offset = $timezone->getOffset(new DateTime());
	$hours = intval($offset / 3600);
	$minutes = abs(intval($offset % 3600 / 60));
	$symbol = ($offset < 0) ? '-' : '+';
	return "(GMT {$symbol}{$hours}:" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ")";
  }
  $getzoneLabel = timeZoneLabel($defaultTimeZone);



//get solana Wallet
$stmt=$pdo->prepare("SELECT * FROM solana WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$exists = $stmt->rowCount();
$solana=$stmt->fetch();
?>







<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
<?php require_once("../metaTags.php");?>
<title>Profile | Medtrix</title>


<link rel="stylesheet" href="../assets/css/dashlite.css">
<link id="skin-default" rel="stylesheet" href="../assets/css/theme.css">

<style>
	.accordion-button:not(.collapsed) {
    color: var(--bs-accordion-active-color);
    background-color: transparent!important;
    box-shadow: inset 0 calc(-1* var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color);
}
</style>
</head>

<body class="nk-body npc-invest bg-lighter  
<?php 
if(!empty($pref["skin"])){ echo " ".$pref["skin"]." ";}
if(!empty($pref["uiDesign"])){echo " ". $pref["uiDesign"] ." ";}
?> ">


<div class="nk-app-root">
	
<!-- Sidebar -->
<?php include "sidebar.php";?>



<div class="nk-wrap ">
<!-- Header Nav -->
<?php include("header.php"); ?>



<div class="nk-content nk-content-fluid">
<div class="container-xl wide-xl">
<div class="nk-content-inner <?php if(empty($pref["headerFixed"])){ echo 'nk-content-margin';}else{
	if($pref["headerFixed"]  == 'nk-header-fixed'){ echo 'nk-content-margin';}else{echo 'nk-content-marginR';}}?> ">
<div class="nk-content-body">



<div class="nk-block">
<div class="card card-bordered">
<div class="card-aside-wrap">



<!-- Append {Page Results} -->
<div class="card-inner card-inner-lg">
<div class="nk-block-head nk-block-head-lg">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h4 class="nk-block-title">Personal Information</h4>
<div class="nk-block-des">
<p>Basic info, like your name, address and country</p>
</div>
</div>
<div class="nk-block-head-content align-self-start d-lg-none">
<a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside">
<em class="icon ni ni-menu-alt-r"></em>
</a></div>
</div>
</div>


<div class="nk-block fetchResult">

<div class="nk-data data-list">
<div class="data-head">
<h6 class="overline-title">Basics</h6>
</div>
<div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
<div class="data-col"><span class="data-label">Full Name</span>
<span class="data-value"><?php echo htmlspecialchars($row["fullName"]);?></span></div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>
<div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
<div class="data-col"><span class="data-label">Display Name</span>
<span class="data-value">
<span class="toggleVal">
<?php if($pref["displayName"] == "fullName"){echo htmlspecialchars($row["fullName"]);}else{echo htmlspecialchars($row["username"]);}?>
</span>
</span></div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>
<div class="data-item">
<div class="data-col"><span class="data-label">Email</span>
<span class="data-value"><?php echo htmlspecialchars($row["email"]);?></span></div>
<div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
</div>
<div class="data-item">
<div class="data-col"><span class="data-label">Username</span>
<span class="data-value"><?php echo htmlspecialchars($row["username"]);?></span></div>
<div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
</div>
<div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
<div class="data-col"><span class="data-label">Phone Number</span>
<span class="data-value"><?php if(empty($row["phone"])){echo "Not added";}else{echo htmlspecialchars($row["phone"]);}?></span></div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>
<div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
<div class="data-col"><span class="data-label">Date of Birth</span>
<span class="data-value"><?php if(empty($row["dob"])){echo "Not added";}else{echo htmlspecialchars($row["dob"]);}?></span></div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>
<div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" data-tab-target="#address">
<div class="data-col"><span class="data-label">Address</span>
<span class="data-value"><?php if(empty($row["address"])){echo "Not added";}else{echo htmlspecialchars($row["address"]);}?></span></div>
<div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
</div>
</div>
<div class="nk-data data-list">
<div class="data-head">

<h6 class="overline-title">Preferences </h6>
</div>
<!-- <div class="data-item">
<div class="data-col"><span class="data-label">Language</span><span class="data-value">English (United State)</span></div>
<div class="data-col data-col-end"><a href="#" class="link link-primary">Change Language</a></div>
</div> -->

<div class="data-item">
<div class="data-col"><span class="data-label">Date Format</span>
<span class="data-value text-uppercase"><?php echo htmlspecialchars($pref["dateFormat"]);?></span></div>
<div class="data-col data-col-end">
<a href="#" class="link link-primary">Change</a>
</div>
</div>
<div class="data-item">
<div class="data-col"><span class="data-label">Timezone</span>
<span class="data-value upzone"><?php echo htmlspecialchars($pref["timezone"]." ".$pref["timezoneLabel"]);?></span></div>
<div class="data-col data-col-end">
<a data-bs-toggle="modal" href="#timezone" class="link link-primary">
<span class="ms-1">Change</span>
</a>
</div>
</div>

<div class="data-item">
<div class="data-col"><span class="data-label">Display Name</span>
<span class="data-value">
<label for="displayName" class="toggleVal text-capitalize"><?php if($pref["displayName"] == "fullName"){echo htmlspecialchars($row["fullName"]);}else{echo htmlspecialchars($row["username"]);}?></label>
</span>
</div>
<div class="data-col data-col-end"><div class="custom-control custom-switch">
<input type="checkbox" name="displayName" class="custom-control-input" id="displayName" 
<?php if($pref["displayName"] == "fullName"){echo "checked";}?> >
<label class="custom-control-label" for="displayName"></label>
</div></div>
</div>



</div>

</div>
</div>



























<!-- SIDEBAR -->
<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
<div class="card-inner-group" data-simplebar="init">
<div class="simplebar-wrapper" style="margin: 0px;">
<div class="simplebar-height-auto-observer-wrapper">
<div class="simplebar-height-auto-observer"></div>
</div>
<div class="simplebar-mask">
<div class="simplebar-offset" style="right: 0px; bottom: 0px;">
<div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
<div class="simplebar-content" style="padding: 0px;">
<div class="card-inner">
<div class="user-card">
<div class="user-avatar bg-primary">
<span>

<img class="ProfilePixResult" src="<?php echo $userimage;?>" alt="User Avatar" style="height: 40px !important;width: 40px !important;">
<input type='file' name='profilepix' class='display-none' id='profilepix' accept="image/*" />
</span>
</div>

<div class="user-info">
<span class="lead-text"><?php echo htmlspecialchars($row["fullName"]);?></span>
<span class="sub-text"><?php echo htmlspecialchars($row["email"]);?></span>
</div>

<div class="user-action">
<div class="dropdown"><a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
<div class="dropdown-menu dropdown-menu-end">
<ul class="link-list-opt no-bdr">

<li class="changeImg">
<a href="#">
<em class="icon ni ni-camera-fill"></em><span>Change Photo</span>
</a>
</li>


<li data-bs-toggle="modal" data-bs-target="#profile-edit">
<a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="card-inner">
<div class="user-account-info py-0">

<img class="logo-dark position-absolute" src="../images/solana-dark.png" width="100px">
<img class="logo-light" src="../images/solanaLogo.svg" width="100px">

<div href="../index.php?solana=request" class="user-balance" style="font-size:17px">
<?php if(isset($solana["balance"])){echo htmlspecialchars($solana["balance"]) .' <small class="currency currency-btc">SOL</small>';}else{echo "<a class='text-blue' href='../index.php?solana=request'>Connect wallet <em class='icon ni ni-chevron-right'></em></a>";}?> 
</div>
<br>
<h6 class="overline-title-alt">Account Balance</h6>
<div class="user-balance" style="font-size:17px"><?php echo number_format($actBal["deposit"],2);?> <small class="currency currency-btc">NGN</small></div>
<br>
<h6 class="overline-title-alt">Token Balance</h6>
<div class="user-balance" style="font-size:17px"><?php echo intval($actBal["token"]);?></div>


</div>
</div>
<div class="card-inner p-0">
<ul class="link-list-menu">
<li>
<a class="active pTab" href="profile.php" data-content="profile">
<em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a>
</li>

<li>
<a href="#" class="slideTab activity" data-content="activity">
<em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span>
</a>
</li>
<li>
<a href="#" class="slideTab security" data-content="security">
<em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span>
</a>
</li>
<li>
<a href="#" class="slideTab notifications" data-content="notifications">
<em class="icon ni ni-notify"></em><span>notifications</span>
</a>
</li>
<!-- <li><a href="/demo6/user-profile-social.html"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li> -->
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="simplebar-placeholder" style="width: auto; height: 504px;"></div>
</div>
<div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
<div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
</div>
<div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
<div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>









<!-- Profile Modal -->

<div class="modal fade" role="dialog" id="profile-edit">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
<div class="modal-body modal-body-md">
<h4 class="title wlcm">Update Profile</h4>

<ul class="nk-nav nav nav-tabs" role="tablist">
<li class="nav-item" role="presentation">
<a class="nav-link active navPersonal" data-bs-toggle="tab" href="#personal" aria-selected="true" role="tab">Personal</a>
</li>
<li class="nav-item" role="presentation">
<a class="nav-link navAddress" data-bs-toggle="tab" href="#address" aria-selected="false" tabindex="-1" role="tab">Address</a>
</li>
</ul>


<div class="tab-content">
<div class="tab-pane active navPersonal" id="personal">

<!--Personal  info  form -->
<form class="form-validate is-alter form-profile">

<div class="result"></div>

<!-- Success -->
<div style='margin:20px 0px; font-size:14px;' class="alert alert-success display-none p-2 suc">
Updated Successfully <i class="icon ni ni-check"></i> <span class="close times" style="cursor:pointer">&times;</span>
</div>

<div class="row gy-4">
<div class="col-md-6">
<div class="form-group">
<div class="form-label-group">
<label class="form-label" for="fullName">Full Name <span class="text-danger">*</span></label>
</div>
<div class="form-control-wrap">
<input type="text" name="fullName" class="form-control form-control-lg" id="fullName" value="<?php echo htmlspecialchars($row["fullName"]) ?>" placeholder="Enter full name">
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<div class="form-label-group">
<label class="form-label" for="username">Username<span class="text-danger">*</span></label>
</div>
<div class="form-control-wrap">
<input type="text" name="username" readonly class="form-control form-control-lg" id="username" value="<?php echo htmlspecialchars($row["username"]) ?>" placeholder="Enter a username">
</div>
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<div class="form-label-group">
<label class="form-label" for="email">Email <span class="text-danger">*</span></label>
</div>
<div class="form-control-wrap">
<input type="email" required name="email" class="form-control form-control-lg" readonly id="email" value="<?php echo htmlspecialchars($row["email"]) ?>">
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<div class="form-label-group">
<label class="form-label" for="phone">Phone Number <span class="text-danger">*</span></label>
</div>
<div class="form-control-wrap">
<input type="text" name="phone" value="<?php if(!empty($row["phone"])){echo htmlspecialchars($row["phone"]);}?>" class="form-control form-control-lg" id="phone" placeholder="Phone Number">
</div>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label class="form-label" for="dob">Date of Birth <span class="text-danger">*</span></label>
<input type="text" name="dob" data-date-start-date="-85y" data-date-end-date="-12y" class="form-control form-control-lg date-picker-alt" id="dob" placeholder="Select Date of Birth"  value="<?php if(!empty($row["dob"])){echo $row["dob"];}?>" >
</div>
</div>


<div class="col-12">
<ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2 pt-2">
<li>
<button class="btn btn-lg btn-primary update" type="button">
<span>Update Profile</span> &nbsp; &nbsp; 
<span class="spinner-border spinner-border-sm display-none spinLoader"></span>
</button>
</li>
<li>
<a href="#" data-bs-dismiss="modal" class="btn btn-danger btn-dim">Cancel</a>
</li>
</ul>
</div>
</div>
</form>
<!-- end Personal  info  form -->






<!-- Address Form -->
</div>
<div class="tab-pane navAddress" id="address">
<form class="form-validate is-alter form-profile" id="profile-address-form">
<div class="result"></div>
<!-- Success -->
<div style='margin:20px 0px; font-size:14px;' class="alert alert-success display-none p-2 suc">
Updated Successfully <i class="icon ni ni-check"></i> <span class="close times" style="cursor:pointer">&times;</span>
</div>
<div class="row gy-4">
<div class="col-md-6 col-lg-6">
<div class="form-group">
<div class="form-label-group">
<label class="form-label" for="city">City <span class="text-danger">*</span></label>
</div>
<div class="form-control-wrap">
<input type="text" name="city" class="form-control form-control-lg" id="city" value="<?php if(!empty($row["city"])){echo htmlspecialchars($row["city"]);}?>" placeholder="Enter city">
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="residentialCountry">Country <span class="small">(Residential)</span> <span class="text-danger">*</span></label>
<select name="residentialCountry" class="form-select form-control-lg" id="residentialCountry" data-ui="lg" data-placeholder="Please select" data-search="on">

<?php
$count =1;
 foreach ($countries as $country) {
	$selected = ($row['residentialCountry'] == $country) ? 'selected' : '';
	
	if($count  ==1){
		echo "<option value=''>Please select</option>";
		}
	echo "<option $selected value='$country'>$country</option>";
	$count++;
}?>
</select>
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="country">Country <span class="small">(Nationality)</span> <span class="text-danger">*</span></label>
<select name="country" class="form-select form-control-lg" id="country" data-ui="lg" data-search="on">

<?php
$count =1;
 foreach ($countries as $country){
	$selected = ($row['country'] == $country) ? 'selected' : '';

	if($count  ==1){
	echo "<option $selected value='same'>Same as Residential</option>";
	}

	echo "<option $selected value='$country'>$country</option>";
$count++;
}?>
</select>
</div>
</div>



<div class="col-md-6">
<div class="form-group">
<div class="form-label-group">
<label class="form-label" for="Laddress">Residential Address <span class="text-danger">*</span></label>
</div>
<div class="form-control-wrap">
<input type="text" name="address" class="form-control form-control-lg" id="Laddress" placeholder="Enter address" value="<?php if(!empty($row["address"])){echo htmlspecialchars($row["address"]);}?>">
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="bankName">Bank Name <!--<span class="text-danger">*</span>--></label>
<input type="text" name="bankName" class="form-control form-control-lg" id="bankName" placeholder="Enter your bank name" value="<?php if(!empty($row["bankName"])){echo htmlspecialchars($row["bankName"]);}?>">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="accountNumber">Account Number <!--<span class="text-danger">*</span>--></label>
<input type="text" name="accountNumber" class="form-control form-control-lg" id="accountNumber" placeholder="Enter wallet address" value="<?php if(!empty($row["accountNumber"])){echo htmlspecialchars($row["accountNumber"]);}?>">
</div>
</div>


</div>

<div class="row gy-4">
<div class="col-12">
<ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2 pt-2">
<li>
<button class="btn btn-lg btn-primary update" type="button">
<span>Update Profile</span> &nbsp; &nbsp; 
<span class="spinner-border spinner-border-sm display-none spinLoader"></span>
</button>
</li>
<li>
<a href="#" data-bs-dismiss="modal" class="btn btn-danger btn-dim">Cancel</a>
</li>
</ul>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>








<!-- TimeZone Modal Select -->
<div class="modal fade" tabindex="-1" role="dialog" id="timezone">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<a href="#" class="close" data-bs-dismiss="modal">
<em class="icon ni ni-cross-sm"></em>
</a>
<div class="modal-body modal-body-md">
<h5 class="title mb-4">Select Timezone</h5>
<div class="nk-country-region">

<?php

echo '<div class="accordion" id="timezoneAccordion">';
foreach ($continents as $continent => $timezones) {
    echo '<div class="accordion-item">';
    echo "<h2 class='accordion-header' id='heading{$continent}'>";
    echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse{$continent}' aria-expanded='true' aria-controls='collapse{$continent}'>";
    echo $continent;
    echo '</button>';
    echo '</h2>';
    echo "<div id='collapse{$continent}' class='accordion-collapse collapse' aria-labelledby='heading{$continent}' data-bs-parent='#timezoneAccordion'>";
    echo '<div class="accordion-body">';
    $count = 1;
    foreach ($timezones as $timezone => $label) {
        echo "<ul class='gy-2 list-odd1'>";
        echo "<li data-timezone='$timezone' data-label='$label' class='updateTimeZone'>";
        echo "<a href='javascript:void(0)' class='country-item'>";
        echo "<span class='country-name'>$count. &nbsp; $label</span>";
        echo '</a>';
        echo '</li>';
        echo '</ul>';
        $count++;
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';


?>

</div>
<br>



<button class="btn btn-primary btn-block updateTimeZone" data-timezone="<?php echo $defaultTimeZone;?>" data-label="<?php echo $getzoneLabel;?>">
Use Default Timezone
</button>
</div>
</div>
</div>
</div>










<!-- Footer -->
<?php include("footer.php"); ?>


</div>
</div>


<script src="../assets/js/bundle.js"></script>
<!-- <script src="../assets/js/bundles.js"></script> -->

<script src="../assets/js/scripts.js?ver=3.2.3"></script>
<script src="../assets/js/charts/chart-invest.js?ver=3.2.3"></script>

<!-- /Jquery Confirm -->
<script src="../assets/js/jquery-confirm.min.js"></script>
<!-- /Jquery Confirm -->




<script>

// $.alert({
// 	title: 'Display name changed',
// 	content: 'Augustine Gabriel',
// 	animation: 'scale',
//     animationBounce: 2, // default is 1.2 whereas 1 is no bounce.
// 	closeAnimation: 'bottom',
// 	backgroundDismiss: true,
// 	type: 'green',
// 	draggable: true,
// 		buttons: {
// 	Done: {
// 		text: 'Done!',
// 		btnClass: 'btn-dark',
// 		action: function(){
// 		// do nothing
// 			}
// 		}
// 	}
// });



   $(document).ready(function(){
	
	
	$(".changeImg").click(function(){
		$("#profilepix").trigger("click");
	});

	$(".times").click(function(){ $(this).parent().fadeOut(); });

	$("input").keypress(function(){
		$("input").removeClass('error');
		$("select").removeClass('error');
	 });

	$("input, select").change(function(){
		$("input").removeClass('error');
		$("select").removeClass('error');
	 });
	 








//Update profile picture

 $('#profilepix').change(function(){
  var form_data = new FormData();
  var files = $('#profilepix')[0].files;


   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("profilepix").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {

	//Toast error
   alert('Please select a valid image file');
	
	return false;
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("profilepix").files[i]);
    var f = document.getElementById("profilepix").files[i];
    var fsize = f.size||f.fileSize;
    if(fsize > 9194304) //9mb
    {
      
	//Toast error
   alert('Image is too large. Allowed max size is 9MB');
   
return false;
    }
    else
    {
     form_data.append("profilepix[]", document.getElementById('profilepix').files[i]);
    }
   }
  

	if(files.length > 0){
   $.ajax({
    url:"function.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
		// NLoader show
		NProgress.start();
	},   
    success:function(data){
			
		// NLoader hide
		NProgress.done();
		
		//Embed image
		$(".result").html(data);
		console.log(data);
		
		
		
    }
   });
	}


 });
 
 
 
 





//Toggle display name
$("#displayName").click(function(){

	// If checked
	if($("#displayName").prop("checked")){
		
	let toggleDisplayName = "toggle";
	let value = "fullName";
	$.ajax({
		url:"function.php",
		method:"POST",
		data: {value:value,toggleDisplayName:toggleDisplayName},
		beforeSend:function(){
			$(".toggleVal").addClass("display-none");
			// NLoader show
			NProgress.start();
		},   
		success:function(data){
				
			$(".toggleVal").removeClass("display-none");
			// NLoader hide
			NProgress.done();
			
			//result
			$(".result").html(data);
			console.log(data);
    }
   });

	}else{
		


		//If unchecked
	let toggleDisplayName = "toggle";
	let value = "username";
	$.ajax({
		url:"function.php",
		method:"POST",
		data: {value:value,toggleDisplayName:toggleDisplayName},
		beforeSend:function(){
			$(".toggleVal").addClass("display-none");
			// NLoader show
			NProgress.start();
		},   
		success:function(data){
				
			$(".toggleVal").removeClass("display-none");
			// NLoader hide
			NProgress.done();
			
			//result
			$(".result").html(data);
			console.log(data);
    }
   });
	}
});










 
 //UPDATE User
 
 $(".update").click(function(e){
	 e.preventDefault();

	
		let updateProfile = "update";
			
		let fullName = $("#fullName").val();
		let username = $("#username").val();
		let email = $("#email").val();
		let phone = $("#phone").val();
		let dob = $("#dob").val();
		let address = $("#Laddress").val();
		let country = $("#country").val();
		let residentialCountry = $("#residentialCountry").val();
		let city = $("#city").val();
		let accountNumber = $("#accountNumber").val();
		let bankName = $("#bankName").val();
		

		$.ajax({
			url:'function.php',
			method:'POST',
			data:{fullName:fullName,username:username,email:email,phone:phone,address:address,country:country,accountNumber:accountNumber,bankName:bankName,dob:dob,city:city,residentialCountry:residentialCountry,updateProfile:updateProfile},
			beforeSend:function(){
				//nprogress
				NProgress.start();
				$(".spinLoader").removeClass("display-none");
				$(".update").attr("disabled", true);
			},
			success:function(data){
				$(".result").html(data);
				$(".spinLoader").addClass("display-none");
				$(".update").attr("disabled", false);

					//nprogress
					NProgress.done();

				
			}
		});
		
		});









		// Update TimeZone
		$(".updateTimeZone").click(function(){

			let timezone = $(this).data("timezone");
			let timezoneLabel = $(this).data("label");
			let setTimezone = "setTimezone";

			$.ajax({
				url:"function.php",
				method:"POST",
				data: {timezone:timezone, timezoneLabel:timezoneLabel, setTimezone:setTimezone},
				beforeSend:function(){
					// NLoader show
					NProgress.start();
				},   
				success:function(data){
					// NLoader hide
					NProgress.done();

					//result
					$(".result").html(data);
					console.log(data);


					//Success
					if(data ==1){

						$(".upzone").html(timezone  + " " + timezoneLabel);

						$.alert({
							title: 'Timezone Changed!',
							content: '<b>To ' + timezoneLabel + ' </b> ',
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
								$('#timezone').modal('hide');
									}
								}
							}
						});

					}
				}
			});
			

		});






















//Onclick TAB Fetch Pages
 $(".slideTab").click(function(e){
	 e.preventDefault();

	 $(".slideTab, .pTab").removeClass("active");
	 $(this).addClass("active");

	 
		let contentType = $(this).data("content");
		let userid = '<?php echo intval($userid);?>';


		$.ajax({
			url:'fetch/profileTabs.php',
			method:'POST',
			data:{contentType:contentType,userid:userid},
			beforeSend:function(){
				// NLoader show
				NProgress.start();
			},
			success:function(data){
				$(".fetchResult").html(data);
				// NLoader hide
				NProgress.done();

				//hide sidebar
				$(".toggle-screen-lg").removeClass("content-active");
				$(".toggle-overlay").css({"display":"none"});

				console.log(data);
				//Scroll to result
				$('html, body').animate({
					scrollTop: $("body").offset().top
				}, 1000);
			
				
			}
		});
		
		});







   });
   
   
   
   
   </script>
   
   
   




   
<?php if(!empty($_GET["tab"])){ ?>
   
  <script>
	// On page Load if Tab $_GET is set

function loadpage(GetParameter){
	$(".slideTab, .pTab").removeClass("active");
	 $("."+GetParameter).addClass("active");

		let contentType = GetParameter;
		let userid = '<?php echo intval($userid);?>';

		$.ajax({
			url:'fetch/profileTabs.php',
			method:'POST',
			data:{contentType:contentType,userid:userid},
			success:function(data){
				$(".fetchResult").html(data);

				console.log(data);
				//Scroll to result
				$('html, body').animate({
					scrollTop: $("body").offset().top
				}, 1000);	
				
			}
		});
}

loadpage('<?php echo $_GET["tab"];?>');

  </script>

<?php }?>






</body>
</html>