<?php

include("../include/config.php");
session_start();

if (isset($_SESSION["user_login"])) {
$userid = $_SESSION["user_login"];
} 


//get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE userid = :userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch();
$userimage = (!empty($row["profilepix"]) ? "../images/users/" . $row["profilepix"] : "../images/avatar.svg");

// explode name
$names = explode(" ", $row["fullName"]);
$fname = htmlspecialchars($names[0]);
$lname = htmlspecialchars($names[1]);


if(isset($_POST["getKyc"])){
?>



<div class="container-xl wide-xl">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between g-3">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">KYCs / <strong class="text-primary small">
<?php echo htmlspecialchars($row["fullName"]);?></strong></h3>
<div class="nk-block-des text-soft">
<ul class="list-inline">
<!-- <li>Application ID: <span class="text-base">KID000844</span></li> -->
<li>Submited: <span class="text-base"><?php echo date("jS M, Y h:i a", strtotime($row["kycDate"]));?></span></li>
</ul>
</div>
</div>
<div class="nk-block-head-content">
<a href="kyc.php" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
<em class="icon ni ni-arrow-left"></em><span>Back</span></a>
<a href="kyc.php" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none">
<em class="icon ni ni-arrow-left"></em></a></div>
</div>
</div>
<div class="nk-block">
<div class="row gy-5">
<div class="col-lg-5">
<div class="nk-block-head">
<div class="nk-block-head-content">
<h5 class="nk-block-title title">Application Info</h5>
<p>Submission date, approve date, status etc.</p>
</div>
</div>
<div class="card">
<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Submitted By</div>
<div class="data-value"><?php echo htmlspecialchars($row["fullName"]);?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Submitted At</div>
<div class="data-value"><?php echo date("jS M, Y h:i a", strtotime($row["kycDate"]));?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Status</div>

<div class="data-value">
<?php if($row["kycVerify"] =="pending"){?>
<span class="badge badge-dim badge-sm bg-outline-warning">Pending</span>
<?php }elseif($row["kycVerify"] =="approved"){?>
<span class="badge badge-dim badge-sm bg-outline-success">Approved</span>
<?php }else{?>
<span class="badge badge-dim badge-sm bg-outline-danger">Declined</span>
<?php }?>
</div>

</div>
</li>
<!-- <li class="data-item">
<div class="data-col">
<div class="data-label">Last Checked</div>
<div class="data-value">
<div class="user-card">
<div class="user-avatar user-avatar-xs bg-orange-dim"><span>AB</span></div>
<div class="user-name"><span class="tb-lead">Saiful Islam</span></div>
</div>
</div>
</div>
</li> 
<li class="data-item">
<div class="data-col">
<div class="data-label">Last Checked At</div>
<div class="data-value">19 Dec, 2019 05:26 AM</div>
</div>
</li>
-->
</ul>
</div>
<div class="nk-block-head">
<div class="nk-block-head-content">
<h5 class="nk-block-title title">Uploaded Documents</h5>
<p>Here is user uploaded documents.</p>
</div>
</div>
<div class="card">
<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">Document Type</div>
<div class="data-value text-uppercase"><?php echo htmlspecialchars($row["kycIdType"]);?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Front Side</div>
<div>
<a target="_blank" href="../images/kyc/<?php if(!empty($row["idFront"])){echo htmlspecialchars($row["idFront"]);}else{echo "#";}?>" class="btn btn-primary btn-dim btn-sm">Preview &nbsp;<em class="ni ni-external"></em></a>
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Back Side</div>
<div>
<a target="_blank" href="../images/kyc/<?php if(!empty($row["idBack"])){echo htmlspecialchars($row["idBack"]);}else{echo "#";}?>" class="btn btn-primary btn-dim btn-sm">Preview &nbsp;<em class="ni ni-external"></em></a>
</div>
</div>
</li>
<!-- <li class="data-item">
<div class="data-col">
<div class="data-label">Proof/Selfie</div>
<div class="data-value">National ID Card</div>
</div>
</li> -->
</ul>
</div>
</div>
<div class="col-lg-7">
<div class="nk-block-head">
<div class="nk-block-head-content">
<h5 class="nk-block-title title">Applicant Information</h5>
<p>Basic info, like name, phone, address, country etc.</p>
</div>
</div>
<div class="card">
<ul class="data-list is-compact">
<li class="data-item">
<div class="data-col">
<div class="data-label">First Name</div>
<div class="data-value"><?php echo htmlspecialchars($fname);?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Last Name</div>
<div class="data-value"><?php echo htmlspecialchars($lname);?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Email Address</div>
<div class="data-value"><?php echo htmlspecialchars($row["email"]);?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Phone Number</div>
<div class="data-value text-soft"><?php echo htmlspecialchars($row["phone"]);?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Date of Birth</div>
<div class="data-value"><?php echo date("jS M, Y", strtotime($row["dob"]));?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Full Address</div>
<div class="data-value"><?php echo htmlspecialchars($row["address"]);?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Country of Residence</div>
<div class="data-value"><?php echo htmlspecialchars($row["residentialCountry"]);?></div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Bank Name</div>
<div class="data-value">
<?php if(!empty($row["bank"])){echo htmlspecialchars($row["bank"]);}else{
    echo "<em>Not Available</em>";
}?>
</div>
</div>
</li>
<li class="data-item">
<div class="data-col">
<div class="data-label">Account Number</div>
<div class="data-value text-break">
<?php if(!empty($row["accountNumber"])){echo htmlspecialchars($row["accountNumber"]);}else{
    echo "<em>Not Available</em>";
}?>
</div>
</div>
</li>

</ul>
</div>
</div>
</div>
</div>
</div>
</div>




<?php } ?>