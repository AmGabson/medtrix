<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../../../include/config.php");
session_start();
$userid = $_SESSION["user_login"];





if ($_POST['consultId']) {


    $id = intval($_POST['consultId']);

    $status = "approved";
    $signDate = date("Y-m-d H:is");
    $payMethod ="token";

    $query = $pdo->prepare("UPDATE consultations SET status = :status, payMethod=:payMethod, signDate=:signDate WHERE id=:id");
    $query->bindParam(":status", $status, PDO::PARAM_STR);
    $query->bindParam(":payMethod", $payMethod, PDO::PARAM_STR);
    $query->bindParam(":signDate", $signDate, PDO::PARAM_STR);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();

    if($query){ 

     //Debit token 
     $newToken = $_POST['userToken'] - $_POST['tokenPrice'];
     $query = $pdo->prepare("UPDATE account SET token = :token WHERE userid=:userid");
     $query->bindParam(":token", $newToken, PDO::PARAM_STR);
     $query->bindParam(":userid", $userid, PDO::PARAM_INT);
     $query->execute();
      
      ?>


   

<div class="row justify-center">
<div class="col-md-8">


<div class="example-alert mt-5">
<div class="alert alert-pro alert-success">
<div class="alert-text">
<h4>Payment Successfull</h4>
<p>Thanks for your deposit. Now you can see your transaction history. Your account has been updated accordingly.</p>

<ul class="preview-list g-1 mt-3">
<li class="preview-item">
<a href="<?php if(isset($_POST['fromSolana'])){echo '../dashboard/';}?>transactions.php" class="btn btn-primary btn-dim">Transactions</a>
</li>
<li class="preview-item">
<a href="<?php if(isset($_POST['fromSolana'])){echo '../dashboard/';}?>receipt.php?id=<?php echo $id;?>" class="btn btn-danger btn-dim">View Receipt</a>
</li>
</ul>

</div>
</div>
</div>

</div>
</div>





<?php } }?>
