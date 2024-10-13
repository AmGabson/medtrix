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
<title>Consultation | Medtrix</title>
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




<div class="nk-app-root">
<div class="nk-main ">


<!-- Sidebar -->
<?php include "sidebar.php";?>



<div class="nk-wrap">
<!-- header -->
<?php include "header.php";?>


<div class="nk-content nk-content-fluid">
<div class="container-xl wide-xl">

<div class="nk-content-body here">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">
Book Consultation
</h3>
<div class="nk-block-des text-soft">
<p>Select from the list off appointments</p>
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
<a href="index.php" class="btn btn-white btn-dim btn-outline-light">
<em class="icon ni ni-chevron-left"></em>
<span>
<span class="d-md-none">Dashboard</span>
<span class="d-none d-md-block">Dashboard</span>
</span>
</a>
</li>
<li class="nk-block-tools-opt">
<a href="#" class="btn btn-primary">
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
    



<?php 
//Count Docs
$stmt=$pdo->prepare("SELECT COUNT(*) AS docs FROM doctors");
$stmt->execute();
$countDoc=$stmt->fetch();

//Get Specialists
$stmt=$pdo->prepare("SELECT * FROM doctors LIMIT 3");
$stmt->execute();
$docs=$stmt->fetchAll();

$states = ["Abia","Adamawa","Akwa Ibom","Anambra","Bauchi","Bayelsa","Benue","Borno","Cross River","Delta","Ebonyi","Edo","Ekiti","Enugu","Gombe","Imo","Jigawa","Kaduna","Kano","Katsina","Kebbi","Kogi","Kwara","Lagos","Nasarawa","Niger","Ogun","Ondo","Osun","Oyo","Plateau","Rivers","Sokoto","Taraba","Yobe","Zamfara"
];



//Get consultation Type
$stmt=$pdo->prepare("SELECT * FROM consultationType");
$stmt->execute();
$consultations=$stmt->fetchAll();
foreach($consultations as $consult){
?>




<!-- Consultations -->
<div class="col-sm-6 col-xl-6">
<div class="card h-100">
<div class="card-inner">
<div class="project">
<div class="project-head border-bottom pb-3">
<a data-bs-toggle="modal" href="#consult" class="project-title consultType" data-type="<?php echo htmlspecialchars($consult["type"]);?>" data-icon="<?php echo htmlspecialchars($consult["icon"]);?>" data-consultid="<?php echo intval($consult["consultId"]);?>">
<div class="user-avatar sq <?php echo htmlspecialchars($consult["bg"]);?>">
<em class="icon ni <?php echo htmlspecialchars($consult["icon"]);?>" style="font-size:25px"></em>
</div>
<div class="project-info"><h6 class="title text-capitalize">
<?php echo htmlspecialchars($consult["type"]);?> Consultation</h6>
<span class="sub-text"><?php echo htmlspecialchars($consult["subText"]);?></span></div></a>
<div class="drodown">
<a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 me-n1" data-bs-toggle="dropdown">
<em class="icon ni ni-more-h"></em></a><div class="dropdown-menu dropdown-menu-end">
<ul class="link-list-opt no-bdr">
<li>
<a data-bs-toggle="modal" href="#consult" data-type="<?php echo htmlspecialchars($consult["type"]);?>" data-icon="<?php echo htmlspecialchars($consult["icon"]);?>" class="consultType" data-consultid="<?php echo intval($consult["consultId"]);?>">
<em class="icon ni ni-edit"></em><span>Book Now</span></a>
</li>
<li>
<a href="../specialists.php"><em class="icon ni ni-users"></em><span>View Doctors</span></a>
</li>
</ul>
</div>
</div>
</div>
<div class="project-details">
<p><?php echo htmlspecialchars($consult["desc"]);?></p>
</div>
<div class="project-progress-details">
<div class="project-progress-task">
<em class="icon ni ni-sign-kobo-alt"></em><span> <?php echo number_format($consult["nairaPrice"], 2, '.', ',')?></span></div>
<div class="project-progress-percent text-success"><?php echo htmlspecialchars($consult["nairaPercent"]);?>%  off</div>
</div>
<div class="project-progress-details border-bottom pb-1">
<div class="project-progress-task">
<img src="../images/solanaPNG.png" width="15px"> &nbsp; &nbsp; <span> 
<?php echo htmlspecialchars($consult["solPrice"])?></span></div>
<div class="project-progress-percent text-success"><?php echo htmlspecialchars($consult["solPercent"]);?>%  off</div>
</div>
<div class="project-meta">
<ul class="project-users g-1">

<?php 
foreach($docs as $doctor){
$docImage = !empty($doctor["image"]) ? "../images/doctors/".$doctor["image"]: "../images/avatar.svg";
$docName = htmlspecialchars($doctor['title'] ." ".$doctor['fname'] ." ".$doctor['lname']);
?>

<li>
<div class="user-avatar sm bg-blue">
<img src="<?php echo $docImage;?>" alt="<?php echo $docName;?>" data-bs-toggle="tooltip" height="30px" width="30px" data-bs-placement="top" aria-label="<?php echo $docName;?>" data-bs-original-title="<?php echo $docName;?>">
</div>
</li>
<?php }?>

<li>
<a href="../specialists.php" class="user-avatar bg-light sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View all specialist" data-bs-original-title="View all specialist"><span>+<?php echo intval($countDoc["docs"]-3);?></span></a>
</li>
</ul>
<span class="badge badge-dim bg-warning">
<em class="icon ni ni-clock"></em><span><?php echo htmlspecialchars($consult["timing"]);?></span></span></div>
</div>
</div>
</div>
</div>
<?php }?>
<!--Consultation -->








</div>
</div>
</div>
</div>
</div>









<!--Form modal -->
<div class="result"></div>
<div class="modal fade" tabindex="-1" id="consult">
<div class="modal-dialog modal-dialog-centered modal-md">
<div class="modal-content bg-white">
<a class="close" data-bs-dismiss="modal" data-bs-toggle="modal" href="#consult">
<em class="icon ni ni-cross-sm"></em></a>
<div class="modal-body modal-body-lg text-center">
<div class="nk-modal">
<!-- Header -->
<div class="project-head border-bottom pb-3 mt-n3">
<div href="" class="project-title text-left">
<div class="user-avatar sq bg-white border">
<img src="<?php echo $userimage;?>">
</div>
<div class="project-info" style="text-align: left;">
<h6 class="title text-left"><?php echo htmlspecialchars($row["fullName"]);?></h6>
<span class="sub-text textSpan">Continue by filling the form below</span></div>
</div>
</div>



<!-- Success -->
<div class="nk-modal mt-3 display-none success">
<em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
<h4 class="nk-modal-title">Booking Pending</h4>
<div class="nk-modal-text">
<p class="sub-text">You're almost there!</p>
<p class="sub-text"><strong>Proceed to make payment</strong></p>
</div>
<div class="nk-modal-action-lg">
<ul class="btn-group flex-wrap justify-center g-4 mt-n5">
<li>
<a href="bookings.php" class="btn btn-lg btn-sm btn-danger">View Bookings</a>
</li>
<li>
<a class="btn btn-lg btn-sm btn-success continue" data-bs-dismiss="modal" data-bs-toggle="modal" href="#consult">Make payment &nbsp; <em class="icon ni ni-chevron-right"></em></a>
</li>
</ul>
</div>
</div>
<!--/ Success -->




<!-- check if profile is updated before showing form -->
 <?php 
 if(empty($row["residentialCountry"]) || empty($row["city"]) || empty($row["dob"]) || empty($row["phone"]) || empty($row["phone"])){
  echo '<h5 class="mb-4 mt-10">Please Update Profile</h5>
  <a href="profile.php" class="btn btn-block btn-primary">Update Profile &nbsp; <em class="icon ni ni-chevron-right"></em></a>';
 }elseif(empty($row["profilepix"])){
  echo '<h5 class="mb-4 mt-10">Update Profile Photo</h5>
  <a href="profile.php" class="btn btn-block btn-primary">Update Profile &nbsp; <em class="icon ni ni-chevron-right"></em></a>'; 
 }else{
 ?>

<!-- Form -->
<section class="consultForm">
<div class="alert alert-danger alert-icon alert-dismissible display-none" id="vidErr">
<strong></strong>
<button class="close"></button>
</div>


<h5 class="mb-4 consultTitle text-capitalize"></h5>
<div class="row gy-4">
<div class="col-lg-6 col-sm-6">
<div class="form-group">
<div class="form-control-wrap">
<div class="form-icon form-icon-right">
<em class="icon ni ni-calendar-alt"></em></div>
<input type="text" class="form-control form-control-xl form-control-outlined date-picker" id="date">
<label class="form-label-outlined" for="date">Preferred Date</label></div>
</div>
</div>

<div class="col-lg-6 col-sm-6">
<div class="form-group">
<div class="form-control-wrap has-timepicker">
<div class="form-icon form-icon-right"><em class="icon ni ni-clock"></em></div>
<input type="text" class="form-control form-control-xl form-control-outlined time-picker" id="time">
<label class="form-label-outlined rounded" for="time">Preferred Time</label>
</div></div>
</div>

<div class="row gy-4">
<div class="col-lg-6 col-sm-6">
<div class="form-group">
<ul class="custom-control-group">
<li>
<div class="custom-control custom-radio custom-control-pro no-control">
<input type="radio" class="custom-control-input valid" name="sex" id="male" value="male">
<label class="custom-control-label" for="male">Male</label>
</div>
</li>
</ul>
</div>
</div>

<div class="col-lg-6 col-sm-6">
<div class="form-group">
<ul class="custom-control-group">
<li>
<div class="custom-control custom-radio custom-control-pro no-control">
<input type="radio" class="custom-control-input valid" name="sex" id="female" value="female">
<label class="custom-control-label" for="female">Female</label>
</div>
</li>
</ul>
</div>
</div>

</div>


<div class="col-md-12">
<div class="form-group" style="text-align:left">
<label class="form-label sub-text">Contacting from</label>
<div class="form-control-wrap">
<select class="form-select js-select2 select2-hidden-accessible" data-search="on" id="contactFrom">
<option value="">Contacting from</option>
<?php
foreach($states as $state){?>
<option value="<?php echo $state;?>"><?php echo $state;?></option>
<?php }?>
</select>
</div>
</div>
</div>


<div class="col-md-12 mb-n4">
<div class="form-group" style="text-align:left">
<label class="form-label sub-text" for="issue">Max Characters (<span id="countdown">1000</span>)</label>
<div class="form-control-wrap mt-n1">
<textarea class="form-control no-resize" id="issue" placeholder="Briefly State Your Issue"></textarea>
</div></div>
</div>

</div>

<div class="nk-modal-action-lg">
<button class="btn btn-lg btn-mw btn-danger btn-block bookBtn bt-icon" type="button">
<em class="icon ni ni-video"></em> <span>Conitnue</span> &nbsp; &nbsp; 
<span class="spinner-border spinner-border-sm display-none" id="loader"></span>
</button>
</div>
</section>

<?php }?>
<!--/ Form -->

<!-- Place consultation type id here -->
<input type="hidden" id="consultType">
</div>

</div>
</div>
</div>
</div>
<!-- / -->









<!-- Footer -->
<?php include("footer.php");?>



<script src="../assets/js/bundle.js?ver=3.2.3"></script>
<script src="../assets/js/scripts.js?ver=3.2.3"></script>
<script src="../assets/js/charts/chart-invest.js?ver=3.2.3"></script>
<script src="../assets/js/charts/gd-default.js"></script>


<!-- Load View for Card Payment -->
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
  


<script>

$(document).ready(function(){

// hide error
$('.alert-danger button').click(()=>{
    $('.alert-danger').addClass("display-none");
});


// Twick Consultation title on modal
$(".consultType").click(function(){
  var type = $(this).data("type");
  var icon = $(this).data("icon");
  var consultId = $(this).data("consultid");


  $(".consultTitle").html(type + " Consultation");
  $('.bookBtn em').attr("class", "icon ni " + icon);
  $("#consultType").val(consultId);

});





// Validate textarea
$('#issue').on('input', function() {
  var textarea = $(this).val().trim();
  var minChars = 100;
  var maxChars = 1000;
  var charsLeft = maxChars - textarea.length;

  $('#countdown').text(charsLeft);

  if (textarea.length < minChars) {
    $('.alert-danger strong').html(`Minimum ${minChars} characters required`);
    $('#vidErr').removeClass("display-none");
  } 
  
  else if (textarea.length > maxChars) {
    $('.alert-danger strong').html(`Maximum ${maxChars} characters allowed`);
    $('#vidErr').removeClass("display-none");
  } else {
    $('#vidErr').addClass("display-none");
  }
});



// Book
$('.bookBtn').click(function(){
  var date = $('input#date').val();
  var time = $('input#time').val();
  var patientDesc = $('#issue').val().trim();
  var contactFrom = $('#contactFrom').val();
  var sex = $("input[name='sex']:checked").val();
  var minChars = 100;
  var maxChars = 1000;
  var consultId = $("#consultType").val();


  if(date ==''){
    $('.alert-danger strong').html('Select Preferred Date');
    $('#vidErr').removeClass("display-none");
    $('input#date').focus();
    return false;
  } 
  else if(time ==''){
    $('.alert-danger strong').html('Select preferred time');
    $('#vidErr').removeClass("display-none");
    $('input#time').focus();
    return false;
  } 
  else if(!sex){
    $('.alert-danger strong').html('Select gender');
    $('#vidErr').removeClass("display-none");
    return false;
  } 
  else if(contactFrom ==""){
    $('.alert-danger strong').html('Select contact state');
    $('#vidErr').removeClass("display-none");
    return false;
  } 
  else if(patientDesc === ''){
    $('.alert-danger strong').html('Please state your issue');
    $('#vidErr').removeClass("display-none");
    $('#issue').focus();
    return false;
  } 
  else if(patientDesc.length < minChars){
    $('.alert-danger strong').html(`Minimum ${minChars} characters required`);
    $('#vidErr').removeClass("display-none");
    return false;
  } 
  else if(patientDesc.length > maxChars){
    $('.alert-danger strong').html(`Maximum ${maxChars} characters allowed`);
    $('#vidErr').removeClass("display-none");
    return false;
  } 
  else {

    //hide errors
    $('#vidErr').addClass("display-none");

    $.ajax({
      type: 'POST',
      url: 'function.php',
      data: {sex:sex, contactFrom:contactFrom, preferredDate:date, preferredTime:time, patientDesc:patientDesc,	consultId:consultId},
      beforeSend: function(){
        $('#loader').removeClass("display-none");
        $('.bookBtn').prop("disabled", true);
      },
      success: function(data){
        $('#loader').addClass("display-none");
        $('.bookBtn').prop("disabled", false);

        $('.result').html(data);
            console.log(data);
      }
    });
  }
});






$(".continue").click(function(){

    var consultId = $("#consultType").val();
		let userid = "<?php echo intval($userid);?>";
		
		$.ajax({
			url: 'fetch/payment.php',
			type: 'POST',
			data: {consultId:consultId,userid:userid},
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












});







//  function validateFutureDate(dateString) {
//   const dateParts = dateString.split('/');
//   const month = parseInt(dateParts[0], 10) - 1; // months are 0-based
//   const day = parseInt(dateParts[1], 10);
//   const year = parseInt(dateParts[2], 10) + (dateParts[2].length === 2 ? 2000 : 0); // handle 2-digit year

//   const selectedDate = new Date(year, month, day);
//   const today = new Date();

//   if (selectedDate < today) {
//     return false; // date is in the past
//   } else {
//     return true; // date is today or in the future
//   }
// }

// // Example usage:
// const dateString = '12/25/2023'; // mm/dd/yy
// if (validateFutureDate(dateString)) {
//   console.log('Date is valid');
// } else {
//   console.log('Date is not valid');
// }
</script>

</body>
</html>
