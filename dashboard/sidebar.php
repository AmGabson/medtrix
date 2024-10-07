
<?php
//sidebar link for solPay
$base = basename($_SERVER["PHP_SELF"]);

if(!empty($_GET["consultTypeId"]) || $base == "conference.php"){
    $link = "../dashboard/";
}else{
    $link = "";
}

?>

<div class="nk-sidebar is-light nk-sidebar-fixed is-light " data-content="sidebarMenu">
<div class="nk-sidebar-element nk-sidebar-head">
<div class="nk-sidebar-brand">
<a href="../index.html" class="logo-link nk-sidebar-logo">
<img class="logo-light logo-img" src="../images/logo.png" srcset="../images/logo2x.png 2x" alt="logo">
<img class="logo-dark logo-img" src="../images/logo-dark.png" srcset="../images/logo-dark2x.png 2x" alt="logo-dark">
<img class="logo-small logo-img logo-img-small" src="../images/logo-small.png" srcset="../images/logo-small2x.png 2x" alt="logo-small">
</a>
</div>
<div class="nk-menu-trigger me-n2">
<a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
<em class="icon ni ni-arrow-left"></em>
</a>
</div>
</div>

<div class="nk-sidebar-element">
<div class="nk-sidebar-content">
<div class="nk-sidebar-menu" data-simplebar>
<ul class="nk-menu">


<li class="nk-menu-heading">
<h6 class="overline-title text-primary-alt">Dashboard</h6>
</li>

<li class="nk-menu-item">
<a href="<?= $link;?>index.php" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-dashboard"></em>
</span>
<span class="nk-menu-text">Dashboard</span>
</a>
</li>
<li class="nk-menu-item">
<a href="<?= $link;?>profile.php" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-user"></em>
</span>
<span class="nk-menu-text">Profile</span>
</a>
</li>

<li class="nk-menu-item">
<a href="<?= $link;?>consultation.php" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-video"></em>
</span>
<span class="nk-menu-text">Create Appointment</span>
<span class="nk-menu-badge" style="right:15px!important;">HOT</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?= $link;?>kyc.php" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-user-list"></em>
</span>
<span class="nk-menu-text">Patient KYC</span>
</a>
</li>
<li class="nk-menu-item">
<a href="<?= $link;?>transactions.php" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-swap-alt"></em>
</span>
<span class="nk-menu-text">Transactions</span>
</a>
</li>

<li class="nk-menu-item">
<a href="<?= $link;?>deposit.php" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-wallet-out"></em>
</span>
<span class="nk-menu-text">Deposit</span>
</a>
</li>

<li class="nk-menu-item">
<a href="../conference/conference.php" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-monitor"></em>
</span>
<span class="nk-menu-text">Start Consultation</span>
</a>
</li>



<li class="nk-menu-heading">
<h6 class="overline-title text-primary-alt">Applications</h6>
</li>

<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-icon">
<em class="icon ni ni-block-over"></em>
</span>
<span class="nk-menu-text">Games</span>
</a>
<ul class="nk-menu-sub">

<?php
$stmt=$pdo->prepare("SELECT * FROM games");
$stmt->execute();
$games=$stmt->fetchAll();
foreach($games as $game){
?>
<li class="nk-menu-item">
<a href="../games/<?php echo $game["folderName"];?>" class="nk-menu-link">
<span class="nk-menu-text"><?php echo htmlspecialchars($game["title"]);?></span>
</a>
</li>
<?php }?>


</ul>
</li>
<li class="nk-menu-item">
<a href="../#/" class="nk-menu-link hmm">
<span class="nk-menu-icon">
<em class="icon ni ni-home-alt"></em>
</span>
<span class="nk-menu-text">Home</span>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>


