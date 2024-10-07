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


<title inertia="">Doctors | MedTrix</title>
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







<section><div class="container"><div class="mx-auto max-w-xl text-center text-white"><header class="container mx-auto mb-4 max-w-[800px] px-6 pb-4 text-center text-white"><h3 class="inherits-color relative z-10 text-balance text-3xl font-semibold leading-tighter tracking-tight md:text-6xl">Search Medicines</h3><!----></header><div class="flex space-x-4 mx-auto max-w-sm"><div class="relative flex-1 rounded-full px-6" style="background: rgb(241, 243, 246);"><label class="flex h-12 text-card-200 focus-within:text-blue-400"><svg width="20" viewBox="0 0 15 15" fill="currentColor"><g fill="none" fill-rule="evenodd"><path d="M-2-2h20v20H-2z"></path><path class="fill-current" d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z"></path></g></svg><form class="flex-1 text-left"><input id="filter-input" type="text" class="ml-3 h-12 w-full bg-transparent text-black placeholder-grey-800" minlength="3" maxlength="100" required=""></form><!----></label></div><!----></div><!---->



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