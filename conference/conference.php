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
<html lang="zxx" class="js">
<head>
<title>Patient Consultation | Medtrix</title>
<?php include("../metaTags.php");?>


<link rel="stylesheet" href="../assets/css/dashlite.css">
<link id="skin-default" rel="stylesheet" href="../assets/css/theme.css">
</head>





<body class="nk-body ui-rounder has-sidebar ui-rounder
<?php 
if(isset($_GET["wallet"]) && $_GET["wallet"] =="connected"){echo 'modal-open';}
if(isset($pref["skin"])){ echo $pref["skin"];}
if(!isset($pref["uiDesign"])){echo "ui-default";}else{echo $pref["uiDesign"];}
?>
">



<div class="nk-app-root">
<div class="nk-main ">


<!-- Sidebar -->
<?php include "../dashboard/sidebar.php";?>



<div class="nk-wrap">
<!-- header -->
<?php include "../dashboard/header.php";?>


<div class="nk-content nk-content-fluid">
<div class="container-xl wide-xl">
<div class="nk-content-body">






<div class="nk-block">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<a href="../index.php" class="btn btn-white btn-dim btn-outline-light">
<em class="icon ni ni-dashboard"></em>
<span>
<span class="d-md-none">Dashboard</span>
<span class="d-none d-md-block">Dashboard</span>
</span>
</a>
</div>
</div>
<div class="row g-gs">



<!-- Meet Con -->
<div class="col-md-12">
<div class="card card-preview mt-n1 border">
<div class="card-inner here">
    
<div class="row g-gs">

<div class="col-lg-4">
<img src="static/media/appointment.jpg">
</div>


<div class="col-lg-6">
<div class="nk-block-head-content">
<h3 class="nk-block-title fw-normal">Start Consultation</h3>
<div class="nk-block-des">
<p>To comply with regulation each participant will have to go through indentity verification (KYC/AML) to prevent fraud causes. 
<p>
With Medtrix your data and personal information is secure and safeguard your privacy. Medtrix video conferences are encrypted in transit, and our array of safety measures are continuously updated for added protection.
</p>
</div>
</div>
</div> 


</div>
</div>

<div class="card-footer bg-white border-top">
<h4 class="nk-block-title fw-normal mt-3">Ready To Go?</h4>

<a href="index.php" class="btn btn-danger btn-lg proceed">Proceed to meeting &nbsp;
<em class="icon ni ni-chevron-right"></em></a>
</div>
</div>
</div>
<!-- /Meet Con -->








</div>
</div>


</div>
</div>
</div>


<!-- Footer -->
<?php include("../dashboard/footer.php");?>



<script src="../assets/js/bundle.js?ver=3.2.3"></script>
<script src="../assets/js/scripts.js?ver=3.2.3"></script>




<script>

$(".proceed").click(function(){

    $(this).addClass("display-none");
    $.ajax({
        url: 'index.php',
        type: 'POST',
        // data: {consultId:consultId,userid:userid},
        beforeSend:function(){
        // Nprogress start
        NProgress.start();
        },

        success:function(data){
            //Scroll to result
            $('html, body').animate({
                scrollTop: $(".nk-wrap").offset().top
            }, 500);
            
            $(".here").html(data);

            // Nprogress hiode
            NProgress.done();
            
    }

    });
});


</script>


</body>
</html>
