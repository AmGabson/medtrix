<?php 
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../include/config.php");

session_start();
$userid = $_SESSION["user_login"];




if(isset($_POST["consultId"])){

 $consultId = intval($_POST["consultId"]);

// first get last row of consultation
$stmt=$pdo->prepare("SELECT id,ref FROM consultations WHERE userid = :userid ORDER BY id DESC LIMIT 1");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
$getPrev=$stmt->fetch();


 //get consultation type and it's info
 $stmt=$pdo->prepare("SELECT * FROM consultationType WHERE consultId = :consultId");
 $stmt->bindParam(":consultId", $consultId, PDO::PARAM_INT);
 $stmt->execute();
 $consultType=$stmt->fetch();
 $type = htmlspecialchars($consultType["type"]);
 $amount = htmlspecialchars($consultType["solPrice"]);
 

 //get admin wallet
 $stmt=$pdo->prepare("SELECT * FROM control");
 $stmt->execute();
 $admin=$stmt->fetch();
 $qr = "../images/qrcode/".$admin["solanaQR"];

?>





<div class="nk-content-body">
<div class="page-dw wide-xs m-auto">
<div class="nk-pps-apps">

<div class="nk-pps-title text-center mb-4">
<h3 class="title title-text">Make Your Payment</h3>
<p class="caption-text">Your order <strong class="text-dark"><?php echo htmlspecialchars($getPrev["ref"]);?></strong> for 
<strong class="text-dark text-capitalize">
<?php echo htmlspecialchars($type);?> Consultaion</strong> has been placed. To complete, please send the exact amount of <strong class="text-dark"><?php echo htmlspecialchars($amount);?> SOL</strong> to the address below.</p>
</div>

<div class="nk-pps-card card card-bordered popup-inside">
<div class="card-inner-group">
<div class="card-inner card-inner-sm">
<div class="card-head mb-0">
<h6 class="title mb-0 t-text">Pay SOL</h6>
<div class="card-opt">
<a href="index.php?consultTypeId=<?php echo intval($consultId);?>" class="counter">Connect Wallet</a></div>
</div>
</div>
<div class="card-inner cardCon">

<div class="qr-media mx-auto mb-3 w-max-100px">
<img src="<?php echo  $qr;?>">
</div>
<div class="pay-info text-center">
<h5 class="title text-dark mb-0 clipboard-init" data-clipboard-text=">
<?php echo htmlspecialchars($amount);?>">
<?php echo htmlspecialchars($amount);?>  SOL <em class="click-to-copy icon ni ni-copy-fill nk-tooltip" title="" data-original-title="Click to Copy"></em>
</h5>
</div>
<div class="form-group">
<div class="form-label overline-title-alt lg text-center">Solana Address</div>
<div class="form-control-wrap">
<div class="form-clip clipboard-init nk-tooltip" data-clipboard-target="#wallet-address" title="" data-original-title="Copy">
<em class="click-to-copy icon ni ni-copy"></em>
</div>
<div class="form-icon" style="margin-top: 3px;">
<img src="../images/solanaPNG.png" width="17px">
</div>
<input readonly="" type="text" class="form-control form-control-lg" id="wallet-address" value="<?php echo htmlspecialchars($admin["adminWallet"]);?>">
</div>


</div>

<div class="nk-pps-action">
<a href="#crypto-paid" class="btn btn-block btn-primary popup-open">
<span>Paid Solana</span></a>
</div>

<div class="nk-pps-action text-center mb-3">
<a href="../dashboard/transactions.php" class="btn btn-white btn-dim btn-outline-light mt-3">Pay Later</a>
</div>

<div id="crypto-paid" class="popup">
<div class="popup-content">
<h6 class="mb-2">Confirm your payment</h6>
<p>If you already paid, please provide us your payment reference to speed up verification procces.</p>

<div class="pb-4">
<!-- Error & warning-->
<div class="errorParent alert alert-danger alert-icon alert-dismissible display-none">
<em class="icon ni ni-cross-circle"></em> <strong>Error: </strong> 
<span class="error-text">Enter Transaction Hash</span>
</div>

<div class="errorNet alert alert-light alert-icon alert-dismissible display-none">
<em class="icon ni ni-cross-circle"></em> <strong>Network: </strong> 
Unable to connect to the server. Check connection and try again.
</div>

<div class="form-group">
<div class="form-label">Payment Reference <span class="text-danger">*</span></div>
<div class="form-control-wrap">
<input id="hash" type="text" class="form-control" placeholder="Enter your reference id / hash / signature">
</div>
</div>
<ul class="btn-group justify-between align-center gx-4">
<li>
<button type="button" id="confirm-payment" class="btn btn-primary btn-block">
Confirm Payment</button>
</li>
<li>
<a href="index.php?consultTypeId=<?php echo intval($consultId);?>" class="link link-btn link-secondary popup-close">Close</a></li>
</ul>                                    
</div>


<div class="alert alert-light alert-icon mt-4">
<em class="icon ni ni-alert-circle"></em> <strong>Payment will be approved</strong> once we confirm that payment has been received.
</div>

<div class="popup-overlay"></div>
</div>
</div>


<div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em> <strong>WARNING: </strong> This order will be cancelled, if you send any other SOL amount.<button class="close" data-bs-dismiss="alert"></button>
</div>


</div>
</div>




<div class="beforeBtn">
<ul class="preview-list g-1 justify-center mb-3">
<li class="preview-item">
<a href="index.php?consultTypeId=<?php echo intval($consultId);?>" class="btn btn-white btn-dim btn-outline-light mb-3 mt-3" style="width:100%">
<span>
<span class="d-md-none">Connect Wallet</span>
<span class="d-none d-md-block">Connect Wallet</span>
</span>
</a>
</li>

<li class="preview-item">
<div class="btn btn-white btn-dim btn-outline-light mb-3 mt-3 continue" style="width:100%" data-typeid="<?php echo intval($consultId);?>">
<span>
<span class="d-md-none">Payment Method</span>
<span class="d-none d-md-block">Payment Method</span>
</span>
</div>
</li>
</ul>
</div>



<!-- Success Btn -->
<div class="display-none afterBtn">
<ul class="preview-list g-1 justify-center mb-3">
<li class="preview-item">
<a href="../dashboard/index.php" class="btn btn-info btn-dim mb-3 mt-3" style="width:100%">
Dashboard
</a>
</li>

<li class="preview-item">
<a href="../dashboard/transactions.php" class="btn btn-success btn-dim mb-3 mt-3" style="width:100%">
Transactions
</a>
</li>
</ul>
</div>


</div>
</div>
</div>






<div data-bs-toggle="modal" href="#successModal" class="result"></div>
<div class="modal fade" id="successModal">
<div class="modal-dialog modal-dialog-centered modal-md">
<div class="modal-content bg-white">
<a class="close" data-bs-dismiss="modal" data-bs-toggle="modal" href="#successModal">
<em class="icon ni ni-cross-sm"></em></a>
<div class="modal-body modal-body-lg text-center">
<div class="nk-modal">
<!-- Header -->
<div class="project-head border-bottom pb-3 mt-n3">
<div href="" class="project-title text-left">
<div class="user-avatar sq bg-white border">
<img src="../images/solanaPNG.png">
</div>
<div class="project-info" style="text-align: left;">
<h6 class="title text-left">Payment Received</h6>
<span class="sub-text textSpan">Continue with options below</span></div>
</div>
</div>



<!-- Success -->
<div class="nk-modal mt-3 display-non success">
<em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
<h4 class="nk-modal-title reAmount"></h4>
<div class="nk-modal-text">
<p class="sub-text"><strong class="subMsg"></strong></p>
<p class="sub-text reMsg"></p>
</div>
<div class="nk-modal-action-lg">

<ul class="btn-group flex-wrap justify-center g-4 mt-n5">
<li>
<a href="../dashboard/transactions.php" class="btn btn-lg btn-sm btn-success receiptBtn">
Transactions</a>
<a href="../dashboard/contact.php" class="btn btn-block btn-sm btn-primary display-none contactBtn">
Contact Us
</a>
</li>
<li>
<a href="../dashboard/receipt.php?id=<?php echo intval($getPrev["id"]);?>" class="btn btn-lg btn-sm btn-danger">Receipt</a>
</li>
</ul>




</div>
</div>
<!--/ Success -->



</div>

</div>
</div>
</div>
</div>
<!-- / -->







<script>


$(document).ready(function(){


    // Confirm  Transaction
    $("#confirm-payment").click(function(){

    let hash = $("#hash").val().trim();
    let id = <?php echo intval($getPrev["id"]);?>;
    let amount = <?php echo  $amount;?>;
    let ref = "<?php echo htmlspecialchars($getPrev["ref"]);?>";
    let adminWallet = "<?php echo htmlspecialchars($admin["adminWallet"]);?>";

    if(hash == ""){
        $(".errorParent").removeClass("display-none");
    }
    else{
        $(".errorParent").addClass("display-none");

    $.ajax({
    url: '../solanaAPI/transactionRequest.php',
    type: 'POST',
    data: {hash:hash,id:id,amount:amount,ref:ref,adminWallet:adminWallet},
    beforeSend:function(){
        // Nprogress start
        NProgress.start();

    },
    success:function(data){
        $(".result").html(data);

        console.log(data);
        // Nprogress hiode
        NProgress.done();
        
    }
   

    });
 }

});













// Change Consultaion type
$(".continue").click(function(){

  let consultId = $(this).data("typeid");
  let newConsultId = $(this).data("typeid");

  //incase user is coming from solpay page
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




});



</script>








<?php }?>