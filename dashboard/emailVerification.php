<?php
include("../config.php");

// If verify is set, means user clicked mail Link
if(!empty($_GET["mail"])){

    $userEmail = base64_decode($_GET["mail"]);


//We are using the ref-key to check if  email is verified Check 
$stmt=$pdo->prepare("SELECT fullName, verify FROM users WHERE email = :email");
$stmt->bindParam(":email", $userEmail, PDO::PARAM_STR);
$stmt->execute();
$getVerify = $stmt->fetch();
if($stmt->rowCount()>0){

// Check if user already verified before
if(isset($getVerify["verify"]) && $getVerify["verify"] == 1){

    // Already Verified
    $msg = "<h4 class='text-warning mt-4 text-center'><em class='icon ni ni-alert'></em> Account already been verified</h4>";

}else{

    // Update user to verified
    $stmt=$pdo->prepare("UPDATE users SET verify='1' WHERE email=:email");
    $stmt->bindParam(":email", $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt){
        $msg = "<h4 class='text-success mt-4 text-center'>Account Verified Successfully <em class='icon ni ni-check'></em></h4>";
    }
}

}else{

    if(!empty($_GET["mail"])){
    // If link is invalid
    $msg = "<h4 class='text-danger mt-4 text-center'>Invalid verification link</h4>";
}

}


}else{
    $msg = "<h4 class='text-danger mt-4 text-center'>Enter a valid verification link</h4>";
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
<title>Email Verification | XeroCapitals</title>
<?php include("../metaTags.php");?>

<link rel="stylesheet" href="../assets/css/dashlite.css?ver=3.2.3">
</head>


<body class="authentication-bg" style="font-size:16px;">

<div class="account-pages mt-5 mb-5">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="text-center">

</div>
<div class="card">
<div class="card-body p-4">

<div class="text-center mb-4">
<h4 class="text-uppercase mt-0">Email Verification</h4>
</div>

<div class="dropdown-divider"></div>
<?php 
if(isset($getVerify["fullName"])){
    echo "<h5 class='text-center mb-2 mt-4'>".htmlspecialchars($getVerify["fullName"])."</h5>";
}
echo $msg;
?>













</div>
</div>





<div class="dropdown-divider mt-5 mb-2"></div>
<div class="text-center">
<a href="index.php"><b>Continue to Dashboard</b></a>
<br>
<a href="../index.php"><b>Back Home</b></a>
</div> 

</div> <!-- end col -->
</div>
<!-- end row -->
</div>
<!-- end container -->
</div>
<!-- end page -->




</body>

</html>