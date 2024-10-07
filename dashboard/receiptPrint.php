<?php

include("../include/config.php");
session_start();

if (isset($_SESSION["user_login"])) {
$userid = $_SESSION["user_login"];
} else {
header("location: ../login.php");
}




// Check receipt GET 
if (!empty($_GET["id"])) {
$id = intval($_GET["id"]);
} else {
header("location:index.php");
}




//get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE userid = :userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch();
$userimage = (!empty($row["profilepix"]) ? "../images/users/" . $row["profilepix"] : "../images/avatar.svg");



//get preferences
$stmt = $pdo->prepare("SELECT * FROM preference WHERE userid = :userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$pref = $stmt->fetch();




//CONSULT RECEIPT DETAILS
$stmt = $pdo->prepare(
    "SELECT c.*, t.* 
    FROM 
    consultations c
    JOIN
    consultationType t
    ON c.consultId = t.consultId
    WHERE c.id = :id
    ");
$stmt->bindParam(":id", $id, PDO::PARAM_STR);
$stmt->execute();
$info = $stmt->fetch();
?>





<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
<title>Receipt | Medtrix</title>
<?php include("../metaTags.php"); ?>


<link rel="stylesheet" href="../assets/css/dashlite.css">
<link id="skin-default" rel="stylesheet" href="../assets/css/theme.css">
</head>




<body class="bg-white 
<?php 
if(!empty($pref["skin"])){ echo " ".$pref["skin"]." ";}
if(!empty($pref["uiDesign"])){echo " ". $pref["uiDesign"] ." ";}
?>
" onload="printPromot()">


<div class="nk-block">
    
<div class="invoice invoice-print">

<div class="invoice-wrap">
<div class="invoice-brand text-center">
<img class="logo-dark position-absolute" src="../images/logo-dark2x.png" width="100px">
<img class="logo-light" src="../images/logo.png" width="100px">
</div>
<div class="invoice-head">
<div class="invoice-contact">
<span class="overline-title">Receipt To</span>
<div class="invoice-contact-info">
<a href="profile.php">
<h4 class="title"><?php echo htmlspecialchars($row["fullName"])?></h4>
</a>
<ul class="list-plain">
<li><em class="icon ni ni-map-pin-fill"></em><span>
<?php if(!empty($row["address"])){echo htmlspecialchars($row["address"]);}?>,
<br><?php if(!empty($row["city"])){echo htmlspecialchars($row["city"]);}?>,
<?php if(!empty($row["country"])){echo htmlspecialchars($row["country"]);}?></span>
</li>
<li>
<em class="icon ni ni-call-fill"></em><span>
<?php if(!empty($row["phone"])){echo htmlspecialchars($row["phone"]);}?>
</span></li>
</ul>
</div>
</div>
<div class="invoice-desc">
<h3 class="title">Receipt</h3>

<?php 
if($info["status"] =="pending"){
    echo "<button class='btn btn-outline-danger'>PAY NOW</button>";
}
elseif($info["status"] =="declined"){
    echo "<button class='btn btn-danger'>DECLINED</button>";
}
?>

<ul class="list-plain">
<li class="invoice-id"><span>Receipt ID</span>:<span>
<?php 
$reId = explode("-", $info["ref"]);
echo htmlspecialchars($reId[1]);?>
</span>
</li>

<li class="invoice-date"><span>Date Issued</span>:<span>
<?php 
if(!empty($info["signDate"])){
    echo date("jS M, Y", strtotime($info["signDate"]));
}else{
    echo date("jS M, Y", strtotime($info["created"])); 
}
?>
</span>
</li>

<li class="invoice-id"><span>Status</span>:<span>
<?php 
if($info["status"] =="pending"){
    echo "<text class='text-warning'>Pending</text>";
}
elseif($info["status"] =="approved"){
    echo "<text class='text-success'>Approved</text>";
}else{
    echo "<text class='text-danger'>Declined</text>";
}
?>
</span>
</li>

</ul>
</div>
</div>
<div class="invoice-bills">
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>TXN ID</th>
<th>Description</th>
<th>&#8358; Price</th>
<th>Qty</th>
<th>Amount</th>
</tr>
</thead>
<tbody>

<tr>
<td><?php echo htmlspecialchars($info["ref"]);?></td>
<td style="display:flex; align-items:center; border:none">
<em class="icon ni <?php echo ($info["icon"]);?>"></em>&nbsp; <?php echo htmlspecialchars($info["subText"]);?>
</td>
<td><?php echo number_format($info["nairaPrice"], 2, '.', ',');?></td>
<td>1</td>
<td>
<?php 
if($info["payMethod"] =="token"){
    echo $info["tokenPrice"] . " Token";
}
elseif($info["payMethod"] =="solana Qr" || $info["payMethod"] =="solana"){
    echo $info["solPrice"] . " SOL";
}
else{
    echo "&#8358;" .number_format($info["nairaPrice"], 2, '.', ',');
}
?>
</td>
</tr>

</tbody>
<tfoot>
<tr>
<td colspan="2"></td>
<td colspan="2" class="text-primary">Payment Method</td>
<td>
<?php 
if($info["payMethod"] =="token"){
    echo "Token";
}
elseif($info["payMethod"] =="solana Qr" || $info["payMethod"] =="solana"){
    echo "Solana";
}
else{
    echo "Naira";
}
?>
</td>
</tr>
<tr>
<td colspan="2"></td>
<td colspan="2"><b>Subtotal</b></td>
<td><b><?php echo "&#8358;" .number_format($info["nairaPrice"], 2, '.', ',');?></b></td>
</tr>
<tr>
<td colspan="2"></td>
<td colspan="2">Processing fee</td>
<td><?php echo "&#8358;" .number_format($info["fee"], 2, '.', ',');?></td>
</tr>
<tr>
<td colspan="2"></td>
<td colspan="2">Grand Total</td>
<td><?php echo "&#8358;" .number_format($info["fee"]+$info["nairaPrice"], 2, '.', ',');?></td>
</tr>
</tfoot>
</table>
<!-- <div class="nk-notes ff-italic fs-12px text-soft"> Invoice was created on a computer and is valid without the signature and seals. 
</div> -->
</div>
</div>
</div>
</div>
</div>


<script>function printPromot() { window.print(); }</script>
</body>

</html>