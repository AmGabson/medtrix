<?php
//sidebar link for solPay
$base = basename($_SERVER["PHP_SELF"]);

if(!empty($_GET["consultTypeId"]) || $base == "conference.php"){
    $link = "../dashboard/";
}else{
    $link = "";
}
?>



<!-- Jquery Confirm -->
<link rel="stylesheet" href="../assets/css/jquery-confirm.min.css">
<!-- /Jquery Confirm -->

<!-- nprogress -->
<script src="../assets/js/nprogress.min.js"></script>
<link rel="stylesheet" href="../assets/css/nprogress.min.css">



<?php
// Timezone
include("timezoneSet.php");

//Get User Account Balance
$stmt="SELECT * FROM account WHERE userid = :userid";
$stmt=$pdo->prepare($stmt);
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$actBal=$stmt->fetch();



// Check if user is disabled
if($row["disable"]=="true"){
        echo '<script>location.href="../lockscreen.php"</script>';
}




//Check if site is locked - Effect site lock if pin is not set from "underMaintenance.php"
//This is code is also pasted on "register-login.php", "index.php", user "dashboard/sidebar.php" and admin "admin/sidebar.php" 
//to redirect user once site is blocked since sidebars appears in all pages

$stmt=$pdo->prepare("SELECT * FROM maintenance");
$stmt->execute();
$value = $stmt->fetch();

if($stmt->rowCount() > 0 && $value["locked"] == "locked"){

if(!isset($_SESSION["site_lock"])){
echo '<script>location.href="../underMaintenance.php"</script>';
}

//if pass code from Session does not match code from "maintenance" table, bounce back and unset session
//if eventually admin changed the passcode, and users previous pass Code session is set, it'll bounce them out
elseif($_SESSION["site_lock"] !== $value["passCode"]){

unset($_SESSION["site_lock"]);
echo '<script>location.href="../underMaintenance.php"</script>';			

}
}
?>



<span class="request"></span>

<div class="nk-header nk-header-fluid 
<?php if(empty($pref["headerFixed"])){ echo 'nk-header-fixed';}else{ echo $pref["headerFixed"];}?> 
<?php   if(empty($pref["headerBg"])){ echo 'is-light';}else{
        if($pref["headerBg"] == "is-light"){ echo 'is-light';}
        if($pref["headerBg"] == "is-default"){ echo 'is-default';}
        if($pref["headerBg"] == "is-dark"){ echo 'is-dark';}
        if($pref["headerBg"] == "is-theme"){ echo 'is-theme';}
}       
?> ">

<div class="container-xl wide-xl">
<div class="nk-header-wrap">
<div class="nk-menu-trigger d-xl-none ms-n1 me-3">
<a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
<em class="icon ni ni-menu"></em>
</a>
</div>
<div class="nk-header-brand d-xl-none">
<a href="<?= $link;?>index.php" class="logo-link">
<img class="logo-light logo-img" src="../images/logo.png" srcset="../images/logo2x.png" alt="logo">
<img class="logo-dark logo-img" src="../images/logo-dark.png" srcset="../images/logo-dark2x.png" alt="logo-dark">
</a>
</div>
<div class="nk-header-menu is-light">
<div class="nk-header-menu-inner">
<ul class="nk-menu nk-menu-main"> 

<li class="nk-menu-item">
<a href="../#/" class="nk-menu-link">
<span class="nk-menu-text"><em class="icon ni ni-home-alt"></em> &nbsp;Home</span>
</a>
</li>

<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-text">Fast Links</span>
</a>
<ul class="nk-menu-sub">
<li class="nk-menu-item">
<a href="<?= $link;?>index.php" class="nk-menu-link">
<span class="nk-menu-text">Dashboard</span>
</a>
</li>
<li class="nk-menu-item">
<a href="<?= $link;?>profile.php" class="nk-menu-link">
<span class="nk-menu-text">Profile</span>
</a>
</li>
<li class="nk-menu-item">
<a href="<?= $link;?>consultation.php" class="nk-menu-link">
<span class="nk-menu-text">Book Appointment</span>
</a>
</li>
<li class="nk-menu-item">
<a href="../conference/conference.php" class="nk-menu-link">
<span class="nk-menu-text">Start Conference</span>
</a>
</li>
<li class="nk-menu-item">
<a href="../games/games.php" class="nk-menu-link">
<span class="nk-menu-text">Games</span>
</a>
</li>
</ul>
</li>


</ul>
</div>
</div>






<div class="nk-header-tools">
<ul class="nk-quick-nav">
<li class="dropdown chats-dropdown hide-mb-sm">
<a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
<div class="icon-status icon-status-na">
<em class="icon ni ni-comments"></em>
</div>
</a>
<div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
<div class="dropdown-head">
<span class="sub-title nk-dropdown-title">Recent Chats</span>
<a href="#">Setting</a>
</div>
<div class="dropdown-body">
<ul class="chat-list">
<li class="chat-item">
<a class="chat-link" href="">
<div class="chat-media user-avatar">
<span>IH</span>
<span class="status dot dot-lg dot-gray"></span>
</div>
<div class="chat-info">
<div class="chat-from">
<div class="name">Iliash Hossain</div>
<span class="time">Now</span>
</div>
<div class="chat-context">
<div class="text">You: Please confrim if you got my last messages.</div>
<div class="status delivered">
<em class="icon ni ni-check-circle-fill"></em>
</div>
</div>
</div>
</a>
</li>
<li class="chat-item is-unread">
<a class="chat-link" href="">
<div class="chat-media user-avatar bg-pink">
<span>AB</span>
<span class="status dot dot-lg dot-success"></span>
</div>
<div class="chat-info">
<div class="chat-from">
<div class="name">Abu Bin Ishtiyak</div>
<span class="time">4:49 AM</span>
</div>
<div class="chat-context">
<div class="text">Hi, I am Ishtiyak, can you help me with this problem ?</div>
<div class="status unread">
<em class="icon ni ni-bullet-fill"></em>
</div>
</div>
</div>
</a>
</li>
<li class="chat-item">
<a class="chat-link" href="">
<div class="chat-media user-avatar">
<img src="" alt="">
</div>
<div class="chat-info">
<div class="chat-from">
<div class="name">George Philips</div>
<span class="time">6 Apr</span>
</div>
<div class="chat-context">
<div class="text">Have you seens the claim from Rose?</div>
</div>
</div>
</a>
</li>
<li class="chat-item">
<a class="chat-link" href="">
<div class="chat-media user-avatar user-avatar-multiple">
<div class="user-avatar">
<img src="" alt="">
</div>
<div class="user-avatar">
<span>AB</span>
</div>
</div>
<div class="chat-info">
<div class="chat-from">
<div class="name">Softnio Group</div>
<span class="time">27 Mar</span>
</div>
<div class="chat-context">
<div class="text">You: I just bought a new computer but i am having some problem</div>
<div class="status sent">
<em class="icon ni ni-check-circle"></em>
</div>
</div>
</div>
</a>
</li>
<li class="chat-item">
<a class="chat-link" href="">
<div class="chat-media user-avatar">
<img src="" alt="">
<span class="status dot dot-lg dot-success"></span>
</div>
<div class="chat-info">
<div class="chat-from">
<div class="name">Larry Hughes</div>
<span class="time">3 Apr</span>
</div>
<div class="chat-context">
<div class="text">Hi Frank! How is you doing?</div>
</div>
</div>
</a>
</li>
<li class="chat-item">
<a class="chat-link" href="">
<div class="chat-media user-avatar bg-purple">
<span>TW</span>
</div>
<div class="chat-info">
<div class="chat-from">
<div class="name">Tammy Wilson</div>
<span class="time">27 Mar</span>
</div>
<div class="chat-context">
<div class="text">You: I just bought a new computer but i am having some problem</div>
<div class="status sent">
<em class="icon ni ni-check-circle"></em>
</div>
</div>
</div>
</a>
</li>
</ul>
</div>
<div class="dropdown-foot center">
<a href="">View All</a>
</div>
</div>
</li>
<li class="dropdown notification-dropdown">
<a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
<div class="icon-status icon-status-info">
<em class="icon ni ni-bell"></em>
</div>
</a>






<?php
//count all
$stmt=$pdo->prepare("SELECT COUNT(*) AS count FROM notifications WHERE userid = :userid 
AND (type IS NULL || type='received')");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$getAll = $stmt->fetch();


//Get All notifications
$stmt=$pdo->prepare("SELECT * FROM notifications WHERE userid = :userid 
AND status ='unread' AND (type is null || type='received') ORDER BY id DESC LIMIT 5");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$cntNoti = $stmt->rowCount();
$notis=$stmt->fetchAll();

//Remove notification indicator if no unread
if(isset($cntNoti) && $cntNoti < 1){
?>
<style>
.icon-status-info:after{
display:none!important;
}
</style>
<?php }?>


<div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
<div class="dropdown-head">
<span class="sub-title nk-dropdown-title">Notifications(<?php if(isset($cntNoti)){echo intval($cntNoti);}else{echo 0;}?>)</span>
<div class="markRead btn text-primary">
<span class="readText">Mark All as Read</span>
<span class="readLoad display-none">
<div class="spinner-border spinner-border-sm" role="status">
<span class="visually-hidden">Loading...</span></div>
</span>
</div>
</div>

<div class="dropdown-body">
<div class="nk-notification readStat">

<?php foreach($notis as $noti){?>
<div class="nk-notification-item dropdown-inner">
<div class="nk-notification-icon">
<em class="icon icon-circle bg-<?php echo $noti["color"];?>-dim ni <?php echo $noti["icon"];?>"></em>
</div>
<div class="nk-notification-content">
<div class="nk-notification-text">
<?php 
if(str_word_count($noti["title"]) > 10){
       echo substr($noti["title"],0,60) . "...";
}else{
       echo $noti["title"];
}
if($noti["type"]=='received'){echo "&nbsp;&nbsp; <a href='".$link."contact.php'><b>Open Chat</b></a>";}
?>
</div>
<div class="nk-notification-time"><?php echo date("M jS, Y - h:i a", strtotime($noti["dateTime"]));?></div>
</div>
</div>
<?php }


// If no unread
if(isset($cntNoti) && $cntNoti < 1){?>
<div class="nk-notification-content">
<h5 class="text-gray text-center m-2">No Unread</h5>
</div>
<?php }?>

</div>
</div>
<div class="dropdown-foot center">
<a href="<?= $link;?>profile.php?tab=notifications">View All 
<?php if($getAll["count"] > 0){echo intval($getAll["count"]);}?></a>
</div>
</div>
</li>

<li class="hide-mb-sm">
<a href="<?= $link;?>logout.php" class="nk-quick-nav-icon">
<em class="icon ni ni-signout"></em>
</a>
</li>
<li class="dropdown user-dropdown order-sm-first">
<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
<div class="user-toggle">
<div class="user-avatar sm">
<img class="ProfilePixResult" src="<?php echo $userimage;?>" alt="User Avatar" style="height:32px!important; width:40px!important;">
</div>
<div class="user-info d-none d-xl-block">
<?php if($row["verify"] == 1){?>
<div class="user-status user-status-verified">Verified <i class="icon ni ni-check"></i></div>
<?php }else{?>
<div class="user-status user-status-unverified">Unverified </div>
<?php }?>

<div class="user-name dropdown-indicator"><?php echo htmlspecialchars($row["fullName"]);?></div>
</div>
</div>
</a>
<div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
<div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
<div class="user-card">
<div class="user-avatar">
<span><img src="<?php echo $userimage?>"></span>
</div>
<div class="user-info">
<span class="lead-text"><?php echo htmlspecialchars($row["fullName"]);?></span>
<span class="sub-text"><?php echo htmlspecialchars($row["email"]);?></span>
</div>
<div class="user-action">
<a class="btn btn-icon me-n2" href="<?= $link;?>profile.php">
<em class="icon ni ni-setting"></em>
</a>
</div>
</div>
</div>





<div class="dropdown-inner user-account-info">
<h6 class="overline-title-alt">Wallet Balance</h6>
<div class="user-balance">
300 <small class="currency currency-usd">NGN</small>
</div>

<a href="withdrawal.php" class="link">
<span>Credit Wallet</span>
<em class="icon ni ni-wallet-out"></em>
</a>
</div>
<div class="dropdown-inner">
<ul class="link-list">
<li>
<a href="<?= $link;?>profile.php">
<em class="icon ni ni-user-alt"></em>
<span>View Profile</span>
</a>
</li>
<li>
<a href="<?= $link;?>profile.php?tab=security">
<em class="icon ni ni-setting-alt"></em>
<span>Security Settings</span>
</a>
</li>
<li>
<a href="<?= $link;?>profile.php?tab=activity">
<em class="icon ni ni-activity-alt"></em>
<span>Login Activity</span>
</a>
</li>
<li>
<a href="<?= $link;?>profile.php?tab=notifications">
<em class="icon ni ni-bell"></em>
<span>All Notifications</span>
</a>
</li>
</ul>
</div>
<div class="dropdown-inner">
<ul class="link-list">
<li>
<a href="<?= $link;?>logout.php">
<em class="icon ni ni-signout"></em>
<span>Sign out</span>
</a>
</li>
</ul>
</div>
</div>
</li>
</ul>

</div>
</div>
</div>
</div>





<script src="../assets/js/jquery.min.js"></script>

<script>
$(document).ready(function(){
     
$(".markRead").click(function(e){
        e.preventDefault();
        
        let markRead = "read";

        $.ajax({
        type: 'POST',
        url: 'function.php',
        data: {markRead:markRead},
        beforeSend:function(){
        //nprogress
        NProgress.start();

        $(".readText").addClass("display-none");
        $(".readLoad").removeClass("display-none");
        },
        success: function(data){
        $(".readText").removeClass("display-none");
        $(".readLoad").addClass("display-none");

        $(".request").html(data);
        console.log(data);

        //nprogress
        NProgress.done();

        }
        });
});



});
</script>