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
<!-- <link rel="stylesheet" href="assets/css/app-CD2.css"> -->
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


<title inertia="">About | MedTrix</title>
</script>
</head>


<body class="leading-normal">
<div id="app" data-page="" data-v-app="">

<div id="root" class="page w-screen page-dark">
<div class="xl:flex-1">
<div>
<main>


<?php
// Header
include "include/header.php";

// SideBar
include "include/sidebar.php";


?>




<section class="py-15 md:pt-[150px]">
<div class="container" style="max-width: 1166px;">
<div class="grid grid-cols-12 items-center lg:mx-12 2xl:mx-0">
<div class="order-2 col-span-12 md:order-1 md:col-span-6">
<h1 class="text-balance text-center text-6xl font-semibold leading-tighter tracking-tighter md:text-left xl:text-[67px]"> About Medtrix And <span class="inline-block bg-gradient-to-r from-[#617efe] to-blue-300 bg-clip-text text-transparent"> Why Us...</span></h1>

<div class="mx-auto mt-8 flex flex-row  items-center gap-4 md:flex-row lg:mx-0 lg:max-w-sm">
<a class="btn btn-base btn-primary py-4" href="register.php">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Join Us Today</span></a>

<a class="btn btn-base btn-secondary has-icon py-4" href="dashboard/kyc.php">
<svg height="15" viewBox="0 0 18 19" class="mr-2">
<g class="fill-current" fill-rule="nonzero">
<path d="M13.284 10.215a.672.672 0 0 0-.475-.823L6.123 7.601a.672.672 0 1 0-.348 1.298l6.686 1.791a.672.672 0 0 0 .823-.475zM5.427 10.197a.672.672 0 1 0-.347 1.298l4.06 1.088a.672.672 0 1 0 .348-1.298l-4.06-1.088z"></path>
<path d="M5.283 16.837l-2.17-.581a1.346 1.346 0 0 1-.951-1.646L5.223 3.185a1.346 1.346 0 0 1 1.646-.95l7.98 2.138c.716.192 1.143.93.95 1.646l-1.069 3.992a.672.672 0 1 0 1.298.348l1.07-3.992a2.691 2.691 0 0 0-1.9-3.292L7.216.937a2.691 2.691 0 0 0-3.292 1.9L.864 14.262a2.691 2.691 0 0 0 1.9 3.292l2.171.581a.672.672 0 1 0 .348-1.298z"></path>
<path d="M16.425 13.477a2.018 2.018 0 0 0-2.753-.738l-4.517 2.6a.672.672 0 0 0-.235.228l-1.46 2.347a.672.672 0 0 0 .576 1.027l2.814-.024a.672.672 0 0 0 .33-.09l4.507-2.596a2.018 2.018 0 0 0 .738-2.754zm-5.763 4.098l-1.416.012.726-1.167 3.048-1.755.672 1.164-3.03 1.746zm4.354-2.508l-.16.092-.672-1.164.16-.092a.673.673 0 0 1 .672 1.164zM13.505 6.796L6.819 5.004a.672.672 0 1 0-.348 1.299l6.686 1.791a.672.672 0 1 0 .348-1.298z"></path>
</g>
</svg><span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Update KYC </span>
</a>
</div>
</div>
<div class="order-1 col-span-12 translate-x-[-30px] md:order-2 md:col-span-6 md:translate-x-0">
<img src="images/about-img.png" alt=""></div>
</div>
</div>





<?php
$stmt = $pdo->prepare("SELECT * FROM content");
$stmt->execute();
$content = $stmt->fetch();
?>

<div class="user-content md:m-auto md:w-4/5 md:px-6 mt-10">
<div class="inherits-color mt-5 text-2lg text-gray-300">
    
<?php echo $content["about"];?>

</div>
</div>

</section>












</main>
</div>
<?php include "include/footer.php"; ?>




<!-- Jquery -->
<script src="assets/js/jquery-3.7.js"></script>

<!-- Custom Js -->
<script src="assets/js/app.js"></script>

<!-- Autotype Js -->
<script src="assets/js/typed.min.js"></script>




<script>
// Autotype Heading text
// var typing = new Typed(".profession", {
//     strings: [" ","Search Landmarks",  "Popular Loactions", "Get Easily Located", "Site Business Location", "Hotels Around You", "Site Restaurants Nearby"],
//     typeSpeed: 70,
//     backSpeed: 30,
//     loop: true,
// });



// On page Load
NProgress.start();

$(document).ready(function() {
//after load
NProgress.done();
});
</script>





</body>

</html>