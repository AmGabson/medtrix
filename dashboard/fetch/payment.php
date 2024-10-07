<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../../include/config.php");

session_start();
$userid = $_SESSION["user_login"];



if($_POST["consultId"]){
    
    $consultId  = intval($_POST["consultId"]);

    //get user info
    $stmt=$pdo->prepare("SELECT fullName, profilepix FROM users WHERE userid = :userid");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
    $stmt->execute();
    $userInfo=$stmt->fetch();
    $userimage = (!empty($userInfo["profilepix"]) ? "../images/users/".$userInfo["profilepix"]: "../images/avatar.svg");



        // incase user is Swapping new consultation
        if(isset($_POST["newConsultId"])){
        $newConsultId = intval($_POST["newConsultId"]);

        //run PHP Update DB once consultation type is changed
        // first get last row
        $stmt=$pdo->prepare("SELECT id FROM consultations WHERE userid = :userid ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        $getPrev=$stmt->fetch();

        $stmt = $pdo->prepare("UPDATE consultations SET consultId=:consultId WHERE id=:id");
        $stmt->bindParam(":consultId", $newConsultId, PDO::PARAM_INT);
        $stmt->bindParam(":id", $getPrev["id"], PDO::PARAM_INT);
        $stmt->execute();
        }






    //get consultation type and it's info
    $stmt=$pdo->prepare("SELECT * FROM consultationType WHERE consultId = :consultId");
    $stmt->bindParam(":consultId", $consultId, PDO::PARAM_INT);
    $stmt->execute();
    $consultType=$stmt->fetch();
    $type = htmlspecialchars($consultType["type"]);
    $solPrice = htmlspecialchars($consultType["solPrice"]);
    

    //get admin wallet
    $stmt=$pdo->prepare("SELECT * FROM control");
    $stmt->execute();
    $admin=$stmt->fetch();
     

    //Get User Account Balance
    $stmt=$pdo->prepare("SELECT * FROM account WHERE userid = :userid");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
    $stmt->execute();
    $actBal=$stmt->fetch();

    

    //check previous record
     $stmt=$pdo->prepare("SELECT created FROM consultations WHERE userid = :userid AND consultId =:consultId AND DATE(created) != CURDATE() ORDER BY id DESC LIMIT 1");
     $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
     $stmt->bindParam(":consultId", $consultId, PDO::PARAM_INT);
     $stmt->execute();
     $prev=$stmt->fetch();



    //Generate unique transcation ID
    $gen = "1234ABCDEFGHI567890JKLMNOPQRSTUVWXYZ";
    $shuff = str_shuffle($gen);
    $transId = "PYT-" . substr($shuff,0,8) . $userid;



    ?>


<div class="nk-content-body">

<div class="buysell wide-xs m-auto">
<div class="buysell-nav text-center">
<ul class="nk-nav nav nav-tabs nav-tabs-s2">
<li class="nav-item active current-page">
<a class="nav-link" href="#">Payment Method</a></li>
<li class="nav-item">
<a class="nav-link" href="#">Processs payment</a></li>
</ul>
</div>
<div class="buysell-title text-center">
<h4 class="title text-capitalize"><?php echo $type . " Consultation";?></h4>
</div>
<div class="buysell-block">
<form action="#" class="buysell-form">
<div class="buysell-field form-group">
<div class="form-label-group">
<label class="form-label">Change appointment type</label></div>
<input type="hidden" value="btc" name="bs-currency" id="buysell-choose-currency">
<div class="dropdown buysell-cc-dropdown">
<a href="#" class="buysell-cc-choosen dropdown-indicator" data-bs-toggle="dropdown" aria-expanded="false">

<div class="coin-item">
<div class="coin-icon circle p-1 <?php echo htmlspecialchars($consultType['bg']);?>">
<em class="icon ni <?php  echo htmlspecialchars($consultType['icon']);?>"></em>
</div>
<div class="coin-info"><span class="coin-name text-capitalize">
<?php echo htmlspecialchars($type . " Consultation");?></span>
<span class="coin-text">
<?php if(!empty($prev["created"])){echo "Last Order: " . date("M j, Y", strtotime($prev["created"]));}
        else{echo "Not ordered yet";}?></span>
</div>
</div>
</a>


<div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
<ul class="buysell-cc-list">

<?php
//Get consultation Type
$stmt=$pdo->prepare("SELECT * FROM consultationType");
$stmt->execute();
$consultations=$stmt->fetchAll();
foreach($consultations as $consult){

//check previous record
$stmt=$pdo->prepare("SELECT created FROM consultations WHERE userid = :userid AND consultId =:consultId AND DATE(created) != CURDATE() ORDER BY id DESC LIMIT 1");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->bindParam(":consultId", $consult["consultId"], PDO::PARAM_INT);
$stmt->execute();
$prevs=$stmt->fetch();
?>

<li class="buysell-cc-item continue" <?php if($consultId == $consult["consultId"]){echo 'style="background: aliceblue;"';}?> data-consultid="<?php echo intval($consult["consultId"]);?>">
<a href="#" class="buysell-cc-opt">
<div class="coin-item">
<div class="coin-icon circle p-1 <?php echo htmlspecialchars($consult['bg']);?>">
<em class="icon ni <?php echo htmlspecialchars($consult['icon']);?>"></em>
</div>
<div class="coin-info">
<span class="coin-name text-capitalize">
<?php echo htmlspecialchars($consult['type'] . " Consultation");?></span>
<span class="coin-text">
<?php if(!empty($prevs["created"])){echo "Last Order: " . date("M j, Y", strtotime($prevs["created"]));}
        else{echo "Not ordered yet";}?></span></div>
</div>
</a>
</li>

<?php }?>


</ul>
</div>
</div>
</div>
<div class="buysell-field form-group">
<div class="form-label-group"><label class="form-label" for="buysell-amount">Consultaion Charge</label></div>
<div class="form-control-group">
<input type="text" value="<?php echo htmlspecialchars($consultType["solPrice"]);?> SOL" class="form-control form-control-lg form-control-number" id="price" name="price" readonly>
<div class="form-dropdown">
<!-- <div class="text">BTC<span>/</span></div> -->
<div class="dropdown">
<a href="#" class="dropdown-indicator-caret embeded" data-bs-toggle="dropdown" data-offset="0,2">
<img src="../images/solanaPNG.png" width="25px">
</a>
<div class="dropdown-menu dropdown-menu-xxs dropdown-menu-end text-center">
<ul class="link-list-plain">

<li>
<a href="javascript:void(0)" class="currencyType" data-price="<?php echo htmlspecialchars($consultType["solPrice"]);?>">
<img src="../images/solanaPNG.png" width="25px">
</a>
</li>

<li><a href="javascript:void(0)" class="currencyType" data-price="<?php echo htmlspecialchars($consultType["nairaPrice"]);?>" data-type="ngn">
<em class="icon ni ni-sign-kobo-alt" style="font-size:25px;"></em></a>
</li>

<li><a href="javascript:void(0)" class="currencyType" data-price="<?php echo htmlspecialchars($consultType["tokenPrice"]);?>" data-type="token">
<em class="icon ni ni-tumblr" style="font-size:25px;"></em></a>
</li>


</ul>

<script>
    // swap currency
$(".currencyType").click(function(){

    // embed price on input
    // for naira
    if($(this).data("type")  === "ngn"){
    let price = parseInt($(this).data("price"));
    $("#price").val(price.toLocaleString('en-US') + " NGN");
    }
    else if($(this).data("type")  === "token"){
        // for token
        $("#price").val($(this).data("price") + " Token" );
    }
    else{
        // For solana
        $("#price").val($(this).data("price") + " SOL" );
    }

    //swap input icon
    $(".embeded").html($(this).html());
});

</script>

</div>
</div>
</div>
</div>
<div class="form-note-group">
<span class="buysell-min form-note-alt">1 SOL = 242,225.90 NGN</span>
<!-- <span class="buysell-rate form-note-alt">1 USD = 0.000016 BTC</span> -->
</div>
</div>





<div class="buysell-field form-group">
<div class="form-label-group"><label class="form-label">Payment Method</label></div>
<div class="form-pm-group">

<ul class="buysell-pm-list">
<li class="buysell-pm-item">
<input class="buysell-pm-control" type="radio" name="payMethod" id="solana">
<label class="buysell-pm-label" for="solana">
<span class="pm-name">Solana</span><span class="pm-icon">
<img src="../images/solanaPNG.png" width="20px"></span>
</label>
</li>

<!-- <li class="buysell-pm-item">
<input class="buysell-pm-control" type="radio" name="payMethod" id="transfer">
<label class="buysell-pm-label" for="transfer">
<span class="pm-name">Bank Transfer</span>
<span class="pm-icon"><em class="icon ni ni-building-fill"></em></span>
</label>
</li> -->

<li class="buysell-pm-item">
<input class="buysell-pm-control" type="radio" name="payMethod" id="token">
<label class="buysell-pm-label" for="token">
<span class="pm-name">Token</span>
<span class="pm-icon"><em class="icon ni ni-tumblr"></em></span>
</label>
</li>

<li class="buysell-pm-item">
<input class="buysell-pm-control" type="radio" name="payMethod" id="card">
<label class="buysell-pm-label" for="card">
<span class="pm-name">Card / Transfer</span>
<span class="pm-icon"><em class="icon ni ni-cc-secure-fill"></em></span>
</label>
</li>
</ul>

</div>
</div>
<div class="buysell-field form-action btn btn-lg btn-block btn-primary pay" data-typeid="<?php echo intval($_POST["consultId"]);?>">Continue with payment</a></div>

<div class="form-note text-base text-center">Note: our transfer fee included, <a href="#">see our fees</a>.</div>
</form>
</div>
</div>
</div>








<?php 
 //get the current id for consultation for JS
 $stmt=$pdo->prepare("SELECT id FROM consultations WHERE userid = :userid ORDER BY id DESC LIMIT 1");
 $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
 $stmt->execute();
 $getPrev=$stmt->fetch();
?>
<?php }?>









<script>




// Connect to the payment method selected

//auto select solana as payment method
$("#solana").trigger("click");

page = "../solPay/index.php"; //set ajax page 

//incase another paymethod is changed
$('input[name="payMethod"]').change(function(){

let fromSolana = "<?php if(isset($_POST['fromSolana'])){echo 'solana';}else{echo '';}?>";

    if($(this).attr('id') == "solana"){
        page = "../solPay/index.php";
    }
    else if(fromSolana =="solana"){
        page = "../dashboard/paymentMethods/" + $(this).attr('id') + "/index.php"
    }
    else{
        page = "paymentMethods/" + $(this).attr('id') + "/index.php"
    }

    console.log(page);
});






$(".pay").click(function(){

    // for Solana
    let consultId = <?php echo intval($getPrev["id"]);?>;
    let userImage = "<?php echo $userimage;?>";
    let adminWallet = "<?php echo $admin["adminWallet"];?>";
    let user = "<?php echo $userInfo["fullName"];?>";
    let consultType = "<?php echo $type;?>";

    let amount = <?php echo $consultType["solPrice"];?>;
    let nairaPrice = <?php echo $consultType["nairaPrice"];?>;
    let tokenPrice = <?php echo $consultType["tokenPrice"];?>;
    let fromSolana = "<?php if(isset($_POST['fromSolana'])){echo 'solana';}else{echo '';}?>"


    
    //consultation type id for back btn
    let consultTypeId = $(this).data("typeid");

    if(page == "../solPay/index.php"){
        location.href="../solPay/index.php?consultTypeId="+consultTypeId;
    }
    else{
    $.ajax({
        url: page,
        // url: 'paymentMethods/card.php',
        type: 'POST',
        data: {consultId:consultId, userImage:userImage, adminWallet:adminWallet, user:user, consultType:consultType, amount:amount, nairaPrice:nairaPrice, consultTypeId:consultTypeId,tokenPrice:tokenPrice,fromSolana:fromSolana},
        beforeSend:function(){
            
            // Nprogress start
            NProgress.start();
            $(".pay").attr("disabled", true);
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

         $(".pay").attr("disabled", false);


    }
});

}


 });












// Change Consultaion type
$(".continue").click(function(){

let consultId = $(this).data("consultid");
let newConsultId = $(this).data("consultid");

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

        $(".continue").attr("disabled", true);
    },
    success:function(data){
        //Scroll to result
        $('html, body').animate({
            scrollTop: $(".nk-wrap").offset().top
        }, 500);
        
        $(".here").html(data);

// Nprogress hiode
NProgress.done();

        $(".continue").attr("disabled", false);

        
}

});
});





</script>






<!-- Update Parameters for Solana and Fetch in solPay/api.php-->
<?php
$consultId = $getPrev["id"];
$userImage = $userimage;
$adminWallet = $admin["adminWallet"];
$user = $userInfo["fullName"];
$consultType = $type;


//Delete previous record incase there is
$stmt = $pdo->prepare("DELETE FROM solanaParams WHERE userid=:userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
if($stmt){

$stmt = $pdo->prepare("INSERT INTO solanaParams (userid, consultId, userImage, adminWallet, user, consultType, amount) VALUES (:userid, :consultId, :userImage, :adminWallet, :user, :consultType, :amount)");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->bindParam(":consultId", $consultId, PDO::PARAM_INT);
$stmt->bindParam(":userImage", $userImage, PDO::PARAM_STR);
$stmt->bindParam(":adminWallet", $adminWallet, PDO::PARAM_STR);
$stmt->bindParam(":user", $user, PDO::PARAM_STR);
$stmt->bindParam(":consultType", $consultType, PDO::PARAM_STR);
$stmt->bindParam(":amount", $solPrice, PDO::PARAM_STR);
$stmt->execute();

}
 ?>