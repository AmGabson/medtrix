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
<title>Transactions | Medtrix</title>
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
if(!empty($_GET["wallet"]) && $_GET["wallet"] =="connected"){
echo 'style="overflow: hidden; padding-right: 0px;"';
}
?>
>


<div class="nk-app-root">
<div class="nk-main ">


<!-- Sidebar -->
<?php include "sidebar.php";?>



<div class="nk-wrap">
<!-- header -->
<?php include "header.php";?>


<div class="nk-content nk-content-fluid">
<div class="container-xl wide-xl">
<div class="nk-content-body">


<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title text-capitalize">
Transaction History
</h3>
<div class="nk-block-des text-soft">
<p><p>Approved, Declined and Pending Appointments</p></p>
</div>
</div>
<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
<a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
<em class="icon ni ni-more-v"></em>
</a>
<div class="toggle-expand-content" data-content="pageMenu">
<ul class="nk-block-tools g-3">
<li>
<a href="consultation.php" class="btn btn-white btn-dim btn-outline-light">
<em class="icon ni ni-video"></em>
<span>
<span class="d-md-none">Consultation</span>
<span class="d-none d-md-block">Book Consultation</span>
</span>
</a>
</li>
<li class="nk-block-tools-opt">
<a href="deposit.php" class="btn btn-primary">
<em class="icon ni ni-sign-kobo-alt"></em>
<span>Deposit</span>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>



<div class="nk-block">
<div class="row g-gs">

<!-- Transaction table -->
<div class="col-md-12">
<div class="card card-preview mt-n1">
<div class="card-inner">
<table class="datatable-init-export table">
<thead>
<tr>
<th>Appointment</th>
<th>Action</th>
<th>Date</th>
<th>Time</th>
<th>Ref</th>
<th>Status</th>
</tr>
</thead>
<tbody>

<?php
$stmt=$pdo->prepare(
                    "SELECT c.*, ct.type FROM consultations c 
                    JOIN consultationType ct
                    ON c.consultId  = ct.consultId
                    WHERE c.userid=:userid");

$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
$appointments=$stmt->fetchAll();
foreach($appointments as $appointment){
?>  

<tr>
<td class="text-capitalize">
<strong class="text-blue"><?php echo htmlspecialchars($appointment["type"]) . "</strong>";?></td>
<td><a href="receipt.php?id=<?php echo intval($appointment["id"]);?>" class="btn btn-sm btn-success btn-dim p-1 pt-0 pb-0">Details</a></td>
<td><?php echo htmlspecialchars($appointment["preferredDate"]);?></td>
<td><?php echo htmlspecialchars($appointment["preferredTime"]);?></td>
<td><?php echo htmlspecialchars($appointment["ref"]);?></td>
<td class='text-capitalize <?php if($appointment["status"]=="pending"){echo "text-warning";}
            elseif($appointment["status"]=="declined"){echo "text-danger";}else{echo "text-success";}?>'>
<?php echo htmlspecialchars($appointment["status"]);?>
</td>
</tr>

<?php }?>

</tbody>
</table>
</div>
</div>
</div>
<!-- /Transaction table -->








</div>
</div>


</div>
</div>
</div>


<!-- Footer -->
<?php include("footer.php");?>



<script src="../assets/js/bundle.js?ver=3.2.3"></script>
<script src="../assets/js/scripts.js?ver=3.2.3"></script>
<script src="../assets/js/charts/chart-invest.js?ver=3.2.3"></script>
<script src="../assets/js/charts/gd-default.js"></script>
<script src="../assets/js/data-table/datatable-btns.js"></script>





</body>
</html>
