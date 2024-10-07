<?php 
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../../../include/config.php");
session_start();

$userid = $_SESSION["user_login"];


if(isset($_POST["tokenPrice"])){


$consultId = $_POST["consultId"]; //id of the row of book consultaion
$consultTypeId = $_POST["consultTypeId"]; //id of consultation type (video, text, .....)
$userImage = $_POST["userImage"];
$adminWallet = $_POST["adminWallet"];
$consultType = $_POST["consultType"];
$amount = $_POST["amount"];
$nairaPrice = $_POST["nairaPrice"];
$tokenPrice = $_POST["tokenPrice"];



//Get User Account Balance
$stmt=$pdo->prepare("SELECT * FROM account WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$actBal=$stmt->fetch();
$userToken = intval($actBal["token"]);

?>
<link rel="stylesheet" href="paymentMethods/card/style.css">





<div class="nk-content-body">
<div class="buysell wide-xs m-auto">


<div class="nk-block-head-content text-center mt-5">
<h3 class="nk-block-title page-title text-capitalize">
<?php echo htmlspecialchars($consultType);?> Consultation
</h3>
<div class="nk-block-des text-soft">
<p>You're about to pay <?php echo $tokenPrice ." Tokens for <b class='text-capitalize'>". htmlspecialchars($consultType) . " Consultation</b>";?></p>
</div>
</div>





<div class="buysell-field form-group mt-5">

<h3 class="nk-block-title page-title text-capitalize mb-4 text-center">
<?php if($userToken < $tokenPrice){?>
<span class="text-danger">
You've <?php echo $userToken;?> Token
</span>
<?php }else{?>
<span class="text-primary">
You've <?php echo $userToken;?> Token
</span>
<?php }?>
</h3>


<?php if($userToken < $tokenPrice){?>
<div class="form-label-group">
<label class="form-label text-danger" for="buysell-amount">
Insufficient Token
</label>
</div>
<?php }else{?>
<label class="form-label" for="buysell-amount">Consultation Charge</label>
<?php }?>

<div class="form-control-group">
<input type="text" value="<?php echo $tokenPrice;?> Token" class="form-control form-control-lg form-control-number <?php if($userToken < $tokenPrice){echo 'error text-danger';}?>" id="price" name="price" readonly="">
<div class="form-dropdown">

</div>
</div>
<div class="form-note-group">
<span class="buysell-min form-note-alt">
<?php echo $amount . " SOL | &#8358;" . number_format($nairaPrice, 2, '.', ',')?>
</span>
</div>

<div class="btn btn-white btn-dim btn-outline-light mb-3 mt-3 continue" data-typeid="<?php echo intval($consultTypeId);?>" style="width:100%">
<span>
<span class="d-md-none">Change Payment Method</span>
<span class="d-none d-md-block">Change Payment Method</span>
</span>
</div>


<div class="buysell-field form-action btn btn-lg btn-block btn-primary process <?php if($userToken < $tokenPrice){echo 'disabled';}?>">Pay With Token</div>
</div>









  </div>
  </div>

  




  
  
  
<script>


// Change Consultaion type
$(".continue").click(function(){

  let consultId = $(this).data("typeid");
  let newConsultId = $(this).data("typeid");


  //incase user is coming from solpay page
  let fromSolana = "<?php if(isset($_POST['fromSolana'])){echo 'solana';}else{echo '';}?>"
    if(fromSolana == "solana"){
        var page = "../dashboard/fetch/payment.php";
    }else{
        var page = "fetch/payment.php";
    }


$.ajax({
    url: page,
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












// Process payment
$(".process").click(function(){

let consultId = <?php echo intval($consultId);?>;
let userToken = <?php echo intval($userToken);?>;
let tokenPrice = <?php echo intval($tokenPrice);?>;


  //incase user is coming from solpay page
  let fromSolana = "<?php if(isset($_POST['fromSolana'])){echo 'solana';}else{echo '';}?>"
    if(fromSolana == "solana"){
        var page = "../dashboard/paymentMethods/token/processTransaction.php";
    }else{
        var page = "paymentMethods/token/processTransaction.php";
    }


$.ajax({
  url: page,
  type: 'POST',
  data: {consultId:consultId, userToken:userToken, tokenPrice:tokenPrice,fromSolana:fromSolana},
  beforeSend:function(){
      
    // Nprogress start
    NProgress.start();

  },
  success:function(data){

    $(".here").html(data);

    console.log(data);
    // Nprogress hiode
    NProgress.done();
      
}

});
});

  </script>




<?php }?>