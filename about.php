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







<section><div class="container"><div class="mx-auto max-w-xl text-center text-white"><header class="container mx-auto mb-4 max-w-[800px] px-6 pb-4 text-center text-white"><h3 class="inherits-color relative z-10 text-balance text-3xl font-semibold leading-tighter tracking-tight md:text-6xl">About Medtrix</h3><!----></header>



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