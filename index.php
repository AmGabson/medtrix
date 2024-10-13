<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("include/config.php");
session_start();
if(isset($_SESSION["user_login"])){
	$userid = $_SESSION["user_login"];
    
		//get user info
		$stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch();
		$userimage = !empty($row["profilepix"]) ? "images/users/".$row["profilepix"]: "images/avatar.svg";
}
?>



<html lang="en" style="--vh: 8.47px;">
<head>
<?php include "metaTags.php"?>

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#328af1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link
href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&amp;family=Kanit:wght@800&amp;display=swap"
rel="stylesheet">




<link rel="stylesheet" href="assets/css/app-6T.css">
<link rel="stylesheet" href="assets/css/app-CD2.css">
<link rel="stylesheet" href="assets/css/app-C_13nmBj.css">
<link rel="stylesheet" href="assets/css/RadialProgressBar.css">
<link rel="stylesheet" href="assets/css/EpisodeListItem.css">
<link rel="stylesheet" href="assets/css/Layout-9.css">
<link rel="stylesheet" href="assets/css/Header-H.css">
<link rel="stylesheet" href="assets/css/LazyImg-7.css">
<link id="skin-default" rel="stylesheet" href="assets/css/ni-icons.css">
<link rel="stylesheet" href="assets/css/app-_P3ukd9A.css">



<title inertia="">Home | Medtrix</title>
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

// Contents - From top to Games section
 include "sections/content.php";
 
// Category Drops
include "sections/doctors.php";

// Category Drops
include "sections/med_categories.php";


?>


<?php if(isset($_GET["solana"]) && empty($solana["balance"])){
	echo '<div class="backdrop"></div>';
}?>


 
</main>
</div>




<!-- Custom Js -->
<script src="assets/js/app.js"></script>

<!-- Autotype Js -->
<script src="assets/js/typed.min.js"></script>

<?php include "include/footer.php";?>













<script>

// Autotype Heading text
// var typing = new Typed(".profession", {
//     strings: [" ","Search Landmarks",  "Popular Loactions", "Get Easily Located", "Site Business Location", "Hotels Around You", "Site Restaurants Nearby"],
//     typeSpeed: 70,
//     backSpeed: 30,
//     loop: true,
// });












// Scroll Games
let userScroll = document.getElementById("gameScroll"); // the container
let forward = document.getElementById("scrollFrontBtn"); // Forward Scroll Btn
let backward = document.getElementById("scrollBackBtn"); // Back Scroll Btn
let progressBar = document.getElementById("progress-bar"); //progress Bar

let forwardInterval;
let backwardInterval;
let scroller = 1;
let percentScroll = 0;

// Scroll forward on mouse enter
forward.addEventListener("mouseenter", () => {

  forwardInterval = setInterval(() => {
        // get percent scroll and update progress bar
        percentScroll = (userScroll.scrollLeft / (userScroll.scrollWidth - userScroll.clientWidth)) * 100;
        progressBar.value = percentScroll;

    if (userScroll.scrollLeft >= userScroll.scrollWidth - userScroll.clientWidth) {
      clearInterval(forwardInterval);
      //Add disable prop on forward Btn
      forward.disabled = true;
    } else {
      userScroll.scrollLeft += scroller;
      //remove disable prop on backward Btn
      backward.disabled = false;
    }
  }, 5);
});

// on mouse out, stop scroll
forward.addEventListener("mouseleave", () => {
  clearInterval(forwardInterval);
});




// Scroll Backward on mouse enter
backward.addEventListener("mouseenter", () => {
    
  backwardInterval = setInterval(() => {

    // get percent scroll and update progress bar
    percentScroll = (userScroll.scrollLeft / (userScroll.scrollWidth - userScroll.clientWidth)) * 100;
    progressBar.value = percentScroll;

    if (userScroll.scrollLeft <= 0) {
      clearInterval(backwardInterval);
       //Add disable prop on backward Btn
       backward.disabled = true;
    } else {
      userScroll.scrollLeft -= scroller;
      //remove disable prop on forward Btn
      forward.disabled = false;
    }
  }, 5);
});

// on mouse out, stop scroll
backward.addEventListener("mouseleave", () => {
  clearInterval(backwardInterval);
});




// Onclick of progress bar
progressBar.addEventListener("click", (e) => {
    let progressbBar = e.target;
    let rect = progressbBar.getBoundingClientRect();
    let clickPosition = e.clientX - rect.left;
    let progressBarWidth = progressbBar.offsetWidth;

    let progressBarPadding = parseInt(getComputedStyle(progressbBar).paddingLeft);

    let scrollPosition = ((clickPosition - progressBarPadding) / (progressBarWidth - 2 * progressBarPadding)) * (userScroll.scrollWidth - userScroll.clientWidth);
    userScroll.scrollLeft = scrollPosition;

    // get percent scroll and update progress bar
    percentScroll = (userScroll.scrollLeft / (userScroll.scrollWidth - userScroll.clientWidth)) * 100;
    progressBar.value = percentScroll;

  });


</script>




</body>
</html>