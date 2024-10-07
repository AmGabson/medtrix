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


?>





<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
<title>Consultation Fee | Medtrix</title>
<?php include("../metaTags.php");?>


<link rel="stylesheet" href="../assets/css/dashlite.css">
<link id="skin-default" rel="stylesheet" href="../assets/css/theme.css">
</head>





<body class="nk-body ui-rounder has-sidebar ui-rounder
<?php 
if(!empty($pref["skin"])){ echo " ".$pref["skin"]." ";}
if(!empty($pref["uiDesign"])){echo " ". $pref["uiDesign"] ." ";}
?>
"
<?php 
if(isset($_GET["wallet"]) && $_GET["wallet"] =="connected"){
echo 'style="overflow: hidden; padding-right: 0px;"';
}
?>
>


<?php if(isset($solana["balance"]) && isset($_GET["wallet"]) && $_GET["wallet"] =="connected"){echo '<div class="modal-backdrop fade show walletDrop"></div>';}?>


<div class="nk-app-root">
<div class="nk-main ">


<!-- Sidebar -->
<?php include "../dashboard/sidebar.php";?>



<div class="nk-wrap">
<!-- header -->
<?php include "../dashboard/header.php";?>





<div class="nk-content nk-content-fluid">
<script type="module" crossorigin src="assets/index-95qQHnYn.js"></script>
<link rel="stylesheet" crossorigin href="../assets/css/dashlite.css">
<noscript>You need to enable JavaScript to run this app.</noscript>


<div class="container-xl wide-lg mt-5">
<div class="nk-content-body here">
<div class="kyc-app wide-sm m-auto">

<div class="nk-block-head nk-block-head-lg wide-xs mx-auto">
<div class="nk-block-head-content text-center">
<img class="logo-dark position-absolute" src="../images/solana-dark.png" alt="Solana Logo" width="200px"/>
<img class="logo-light" src="../images/solanaLogo.svg"  alt="Solana Logo" width="200px"/>
</div>
</div>


<div class="nk-block">
<div class="card card-bordered">
<div class="nk-kycfm">

<div class="nk-kycfm-head">
<div class="nk-kycfm-count">
<img src="../images/solanaPNG.png" alt="solna" width="30px"/>
</div>
<div class="nk-kycfm-title">
<h5 class="title">Process With Solana</h5>
<p class="sub-title" id="titleText">You'll be redirected to connect your wallet</p>
</div>
</div>


<p class="text-center mt-3" id="desc">
Using this option, you'll need your wallet browser extension. Click button to continue
</p>
<div id="root"></div>


<div class="nk-kycfm-footer">
<div class="title text-center pb-4" id="fText">
On Mobile? Scan QR Code 
</div>

<ul class="nk-block-tools g-3 justify-center">
<li class="nk-block-tools-opt">

<button class="btn btn-primary scanCode">
<em class="icon ni ni-scan-fill"></em>
<span>Scan Code</span>
</button>
</li>

<li>
<span class="btn btn-white btn-dim btn-outline-light continue">
<span>Change Pay Method</span>
</span>
</a>
</li>
</ul>

</div>

</div>
</div>
</div>
</div>
</div>
</div>



</div>


















<!-- Footer -->
<?php include "../dashboard/footer.php";?>



<script src="../assets/js/bundle.js?ver=3.2.3"></script>
<script src="../assets/js/scripts.js?ver=3.2.3"></script>
<script src="../assets/js/charts/chart-invest.js?ver=3.2.3"></script>
<script src="../assets/js/charts/gd-default.js"></script>



<!-- Load View for Card Payment -->
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
  









<?php 

//get the $_GET
//id of consultation type (video, text, .....)
$consultId = intval($_GET["consultTypeId"]);  
?>

<script>

  $(".w3a-header__subtitle").html("Medtrix wallet login");

// Change Consultaion type
$(".continue").click(function(){

let consultId = <?php echo $consultId;?>;
let newConsultId = <?php echo $consultId;?>;
let fromSolana = "solana";

$.ajax({
  url: '../dashboard/fetch/payment.php',
  type: 'POST',
  data: {consultId:consultId,newConsultId:newConsultId,fromSolana:fromSolana},
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




















$(".scanCode").click(function(){

let consultId = <?php echo $consultId;?>;

$.ajax({
    url: 'scanCode.php',
    type: 'POST',
    data: {consultId:consultId},
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
        // console.log(data);

    // Nprogress hiode
    NProgress.done();


}
});


});
</script>


</body>
</html>
