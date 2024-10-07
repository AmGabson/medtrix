<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("include/config.php");
session_start();
if (isset($_SESSION["user_login"])) {
$userid = $_SESSION["user_login"];

//get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch();
$userimage = !empty($row["profilepix"]) ? "images/users/" . $row["profilepix"] : "images/avatar.svg";
}
?>



<html lang="en" style="--vh: 8.47px;">

<head>
<?php include "metaTags.php" ?>

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#328af1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link
href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&amp;family=Kanit:wght@800&amp;display=swap"
rel="stylesheet">


<style type="text/css">
.vfm--fixed[data-v-2836fdb5] {
position: fixed;
}

.vfm--absolute[data-v-2836fdb5] {
position: absolute;
}

.vfm--inset[data-v-2836fdb5] {
top: 0;
right: 0;
bottom: 0;
left: 0;
}

.vfm--overlay[data-v-2836fdb5] {
background-color: rgba(0, 0, 0, 0.5);
}

.vfm--prevent-none[data-v-2836fdb5] {
pointer-events: none;
}

.vfm--prevent-auto[data-v-2836fdb5] {
pointer-events: auto;
}

.vfm--outline-none[data-v-2836fdb5]:focus {
outline: none;
}

.vfm-enter-active[data-v-2836fdb5],
.vfm-leave-active[data-v-2836fdb5] {
transition: opacity 0.2s;
}

.vfm-enter-from[data-v-2836fdb5],
.vfm-leave-to[data-v-2836fdb5] {
opacity: 0;
}

.vfm--touch-none[data-v-2836fdb5] {
touch-action: none;
}

.vfm--select-none[data-v-2836fdb5] {
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}

.vfm--resize-tr[data-v-2836fdb5],
.vfm--resize-br[data-v-2836fdb5],
.vfm--resize-bl[data-v-2836fdb5],
.vfm--resize-tl[data-v-2836fdb5] {
width: 12px;
height: 12px;
z-index: 10;
}

.vfm--resize-t[data-v-2836fdb5] {
top: -6px;
left: 0;
width: 100%;
height: 12px;
cursor: ns-resize;
}

.vfm--resize-tr[data-v-2836fdb5] {
top: -6px;
right: -6px;
cursor: nesw-resize;
}

.vfm--resize-r[data-v-2836fdb5] {
top: 0;
right: -6px;
width: 12px;
height: 100%;
cursor: ew-resize;
}

.vfm--resize-br[data-v-2836fdb5] {
bottom: -6px;
right: -6px;
cursor: nwse-resize;
}

.vfm--resize-b[data-v-2836fdb5] {
bottom: -6px;
left: 0;
width: 100%;
height: 12px;
cursor: ns-resize;
}

.vfm--resize-bl[data-v-2836fdb5] {
bottom: -6px;
left: -6px;
cursor: nesw-resize;
}

.vfm--resize-l[data-v-2836fdb5] {
top: 0;
left: -6px;
width: 12px;
height: 100%;
cursor: ew-resize;
}

.vfm--resize-tl[data-v-2836fdb5] {
top: -6px;
left: -6px;
cursor: nwse-resize;
}
</style>


<link rel="stylesheet" href="assets/css/app-6T.css">
<link rel="stylesheet" href="assets/css/app-CD2.css">
<link rel="stylesheet" href="assets/css/app-C_13nmBj.css">
<link rel="stylesheet" href="assets/css/RadialProgressBar.css">
<link rel="stylesheet" href="assets/css/EpisodeListItem.css">
<link rel="stylesheet" href="assets/css/Layout-9.css">
<link rel="stylesheet" href="assets/css/Header-H.css">
<link rel="stylesheet" href="assets/css/LazyImg-7.css">
<link id="skin-default" rel="stylesheet" href="assets/css/ni-icons.css">

<!-- nprogress -->
<script src="assets/js/nprogress.min.js"></script>
<link rel="stylesheet" href="assets/css/nprogress.min.css">


<title inertia="">Specialists | MedTrix</title>
</script>
</head>


<body class="leading-normal">

<div id="root" class="page w-screen page-dark">
<div>
<main>


<?php
// Header
include "include/header.php";

// SideBar
include "include/sidebar.php";
?>








<div id="forum" class="wrapper dark text-white mt-5">
<div class="section pt-0 md:pt-2">
<div>
<div id="forum-wrapper" class="mx-auto flex flex-col-reverse justify-between md:flex-row lg:gap-x-10 max-w-[1400px]">


<aside class="hidden flex-none lg:sticky lg:block lg:self-start" style="width: 210px; top: 40px;">
<div class="lg:sticky lg:text-center">
<a href="dashboard/consultation.php" class="btn btn-base btn-primary mx-auto mb-3 block w-full" id="js-forum-reply-button">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
Book Appointment </span>
</a>

<a href="specialists.php" class="btn btn-base btn-secondary mb-8 w-full py-4">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
Dr. & Specialists</span>
</a>


<!-- Doctor Sidebar categories -->
<ul class="hide-scrollbar flex flex-col gap-y-2 mobile:hidden lg:max-h-[80vh] lg:overflow-y-auto text-white">
<li class="list-none">
<a class="font-none selectCat group flex items-center rounded-[12px] px-3 py-2 text-left text-sm hover:bg-card-700 hover:text-blue-400 text-blue-400 bg-card-700" href="javascript:void(0)" data-category="all">
<span aria-hidden="true" class="sel selall inline-block h-[16px] rounded-xl group-hover:scale-y-125 group-hover:bg-blue-400 bg-blue-400" style="transition: transform 0.3s 0.1s, background-color 0.3s; margin-right: 9px; width: 9px;"></span>All Categories</a>
</li>
<?php
//get all categories
$stmt=$pdo->prepare("SELECT * FROM doc_category");
$stmt->execute();
$docCats=$stmt->fetchAll();
foreach($docCats as $cat){
?>
<li class="list-none">
<a class="font-none selectCat group flex items-center rounded-[12px] px-3 py-2 text-left text-sm hover:bg-card-700 hover:text-blue-400 text-white" href="javascript:void(0)" data-category="<?php echo intval($cat["cat_id"]);?>">
<span aria-hidden="true" class="sel sel<?php echo intval($cat["cat_id"]);?> inline-block h-[16px] rounded-xl group-hover:scale-y-125 group-hover:bg-blue-400 bg-card-600" style="transition: transform 0.3s 0.1s, background-color 0.3s; margin-right: 9px; width: 9px;"></span>
<?php echo htmlspecialchars($cat["category"]);?></a>
</li>
<?php }?>
</ul>
<!-- /Doctor Sidebar categories -->
</div>
</aside>


<div id="forum-main" class="forum-main mx-auto w-full md:flex-1 xl:max-w-[835px]">
<div id="forum-main-top" class="mb-6 empty:hidden"></div>
<div class="text-white">
<div class="mb-6 flex flex-wrap justify-center gap-x-4 md:mb-8 md:justify-between">
<div class="flex flex-1 gap-x-4">
<div class="md:hidden lg:block">
<div class="select-wrap">
<select class="flex cursor-pointer items-center rounded-xl px-5 py-3 text-xs leading-none bg-card-500 text-grey-600" style="width: 114px;">
<option class="bg-card-900 text-grey-600" value="">Latest</option>
<option class="bg-card-900 text-grey-600" value="specialists.php">Specialists</option>
<option class="bg-card-900 text-grey-600" value="?trending=1">Radiologists</option>
<option class="bg-card-900 text-grey-600" value="?popular=1">Dermatologist</option>
<option class="bg-card-900 text-grey-600" value="?answered=1">Psychiatrist</option>
</select><svg width="20" height="16" class="fill-current text-grey-600" viewBox="0 0 10 16">
<path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path>
</svg>
</div>
</div>

<div>
<div class="select-wrap">
<select class="cursor-pointer rounded-xl px-5 text-xs bg-card-500 text-grey-600">
<option class="bg-card-900 text-grey-600" value="all"> All </option>
<option class="bg-card-900 text-grey-600" value="Medical Specialists">Medical Specialists</option>
<option class="bg-card-900 text-grey-600" value="Surgical Specialists">Surgical Specialists</option>
<option class="bg-card-900 text-grey-600" value="Primary Care Physicians">Primary Care Physicians</option>
<option class="bg-card-900 text-grey-600" value="Diagnostic Specialists">Diagnostic Specialists</option>
<option class="bg-card-900 text-grey-600" value="Mental Health Profs">Mental Health Profs</option>
</select><svg width="20" height="16" class="fill-current text-grey-600" viewBox="0 0 10 16">
<path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path>
</svg></div>
</div>
</div>



<div class="hidden gap-x-3 md:flex md:items-center">
<button class="forum-excerpt-toggle py-2 rounded-lg bg-card-500 text-card-200"><svg width="15" height="15" viewBox="0 0 15 15" class="mx-2">
<g class="forum-excerpt-toggle-lines fill-current" fill-rule="evenodd">
<rect class="forum-excerpt-toggle-line" width="15" height="6" rx="2"></rect>
<rect class="forum-excerpt-toggle-line" width="15" height="6" y="9" rx="2"></rect>
</g>
</svg></button><button disabled="" class="forum-excerpt-toggle py-2 rounded-lg hover:bg-card-600 is-active bg-blue-400"><svg width="15" height="15" viewBox="0 0 15 15" class="mx-2">
<g class="forum-excerpt-toggle-lines fill-current" fill-rule="evenodd">
<rect class="forum-excerpt-toggle-line" width="15" height="4" rx="2"></rect>
<rect class="forum-excerpt-toggle-line" width="8" height="4" y="11" rx="2"></rect>
<rect class="forum-excerpt-toggle-line" width="15" height="4" y="5.5" rx="2"></rect>
</g>
</svg></button></div>
<form class="search-form mt-5 flex h-[50px] md:h-[40px] w-full rounded-xl md:mt-0 md:w-52 bg-card-500" action="/discuss" autocomplete="off"><label for="q" class="flex px-4">
<svg width="16" viewBox="0 0 15 15" class="text-grey-600">
<g fill="none" fill-rule="evenodd">
<path d="M-2-2h20v20H-2z"></path>
<path class="fill-current" d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z"></path>
</g>
</svg><input id="q" name="q" class="ml-3 h-full w-full pt-0 text-sm lg:text-xs placeholder:text-grey-600" placeholder="Begin your search..."></label>
</form>
</div>


<div class="conversation-list">
<!--Ajax Doctors List-->
<div class="placeDoctorsHere"></div>


<?php
//Count Docs
$stmt = $pdo->prepare("SELECT COUNT(*) AS numrow FROM doctors");
$stmt->execute();
$num = $stmt->fetch();
?>

<!-- Pagination -->
 <!-- pagination number -->
<input type="hidden" id="page" value="0">
<input type="hidden" id="catId" value="all">

<div class="mt-6">
<div class="flex flex-wrap justify-center gap-x-2">
<!-- Prev -->
<button class="leading-4 flex h-8 items-center justify-center rounded-xl border border-transparent p-4 text-2xs font-semibold bg-card-600 hover:bg-card-400 cursor-not-allowed" disabled style="min-width: 40px;" id="previous">Previous
</button>
<!-- next -->
<button class="leading-4 flex h-8 items-center justify-center rounded-xl border border-transparent p-4 text-2xs font-semibold bg-card-600 hover:bg-card-400 hover:border-blue focus:border-blue focus:text-blue" 
<?php if($num["numrow"] < 3){echo 'disabled';}?>  style="min-width: 40px;" id="next">Next</button>
</div>
</div>


<!-- /Doctors -->
<!-- show on small screen -->
<div class="md:hidden mx-auto mt-8 flex flex-wrap items-center gap-2 self-center md:mt-0 md:max-w-2xs lg:mx-0 xl:max-w-[200px]">
<div class="flex-1" style="flex-basis: 180px;">
<a href="login.php?login=request" class="btn btn-base btn-primary has-icon py-4 w-full">
<em class="ni ni-user-list" style="font-size: large;"></em> &nbsp;&nbsp;
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Book Appointment </span>
</a></div>
<div class="flex-1" style="flex-basis: 180px;">
<button class="btn btn-base btn-secondary has-icon py-4 w-full">
<em class="icon ni ni-home-alt" style="font-size: large;"></em> &nbsp;&nbsp; 
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">Back Home </span>
</button></div></div>
</div>





<div class="participate-button fixed right-[20px] z-40 lg:idden bottom-[20px]">
<button class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-400 text-center shadow-lg hover:bg-blue-dark"><em class="icon ni ni-send"></em></button>
</div>
</div>
</div>

<div class="sticky hidden h-screen max-w-[266px] 2xl:block" style="top: 40px;">
<div class="max-h-screen space-y-4 overflow-auto pb-15"><a class="inherits-color block flex-1" href="/signup">
<div class="panel relative transition-colors duration-300 hoverable rounded-xl mx-auto px-0 py-0 text-center" heading="" style="height: 240px; background: linear-gradient(148deg, rgb(33, 200, 246) -11%, rgba(33, 200, 246, 0) 42%); width: 100%;">
<div class="flex h-full flex-col justify-between gap-y-3 rounded-2xl px-5 py-4 items-start" style="background-image: radial-gradient(circle at 0% 2%, rgb(0, 117, 255), rgb(31, 64, 106) 100%); border-radius: inherit;">
<div class="flex flex-col items-center mr-15 text-left">
<div class="flex-1">
<img loading="lazy" class="absolute right-4 w-[174px]" src="images/strip.png" aria-hidden="">
<img loading="lazy" class="absolute right-0 top-0" src="images/call.png" width="130" alt="Stethoscope">
<h5 class="-mt-1 text-left font-semibold leading-tighter tracking-normal text-white text-2xl xl:text-[30px]">Talk to a Doctor</h5>
<p class="mt-5 text-xs text-white">Try our online consultation service today!</p>
</div>
</div>
<button class="btn btn-base btn-primary mb-2 w-full py-4">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">Sign Me Up!</span>
</button>
</div>
</div>
</a>

<a class="inherits-color block flex-1" href="/series/laravel-and-vite">
<div class="panel relative transition-colors duration-300 hoverable px-4 lg:px-8 py-4 rounded-xl flex flex-col items-center justify-between gap-y-2 text-center" style="height: 245px;">
<div class="flex flex-col items-center">
<div class="flex w-full flex-col items-center justify-between">
<img loading="lazy" class="" src="images/redPills.png" alt="Red Pills" width="85" height="85"></div>
<div class="mt-3 flex-1">
<h5 class="clamp one-line text-sm font-bold tracking-normal text-white">
Telepharmacy System
</h5>
<p class="clamp two-lines mt-1 text-xs text-grey-100">
Leverage from our online sales of medicine. Get drugs delivered to your doorsteps.
</p>
</div>
</div>
<a href="medicines.php" class="w-full max-w-[200px] rounded-xl px-4 py-1 text-center text-2xs font-medium leading-loose bg-card-400 text-grey-600"> Buy Drugs </a>
</div>
</a>


<a class="inherits-color block flex-1" href="/series/laravel-and-vite">
<div class="panel relative transition-colors duration-300 hoverable px-4 lg:px-8 py-4 rounded-xl flex flex-col items-center justify-between gap-y-2 text-center" style="height: 245px;">
<div class="flex flex-col items-center">
<div class="flex w-full flex-col items-center justify-between">
<img loading="lazy" class="" src="images/sol.png" alt="SOLANA LOGO" width="85" height="85" style="border-radius: 10px;"></div>
<div class="mt-3 flex-1">
<h5 class="clamp one-line text-sm font-bold tracking-normal text-white">
Leverage from SOLANA Today!
</h5>
<p class="clamp two-lines mt-1 text-xs text-grey-100">
Setup your Solana wallet!<br> Receive & Send SOL
</p>
</div>
</div>
<a href="#" class="w-full max-w-[200px] rounded-xl px-4 py-1 text-center text-2xs font-medium leading-loose bg-card-400 text-grey-600"> Create | Connect </a>
</div>
</a>




</div>
</div>

</div>
</div>
</div> 
</div>








</main>
</div>

<!-- Custom Js -->
<script src="assets/js/app.js"></script>

<!-- Autotype Js -->
<script src="assets/js/typed.min.js"></script>


<?php include "include/footer.php"; ?>



<script>

// On page Load
NProgress.start();

$(document).ready(function() {
//after load
NProgress.done();
});
</script>





</body>
</html>