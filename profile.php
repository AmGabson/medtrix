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


// GET DOCTOR
if (!empty($_GET["sp"])) {
    $docId = intval($_GET["sp"]);
   
    $stmt=$pdo->prepare("SELECT 
    d.image,
    d.title,
    d.fname,
    d.lname,
    d.hospital,	
    d.qualification,	
    d.location,
    d.profession,
    d.id,
    d.bio,
    c.category,
    c.desc

    FROM doctors d
    JOIN
    doc_category c 
    WHERE d.cat_id = c.cat_id AND d.id = :id");
    $stmt->bindParam(":id", $docId, PDO::PARAM_INT);
    $stmt->execute();
    $doc = $stmt->fetch();
    $docImage = !empty($doc["image"]) ? "images/doctors/" . $doc["image"] : "images/lil-doc.png";
}else{
    echo "<script>location.href='specialists.php'</script>";
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





<section class="pb-10 pt-0 mx-auto mt-10">
<div class="container">
<div class="flex flex-col gap-2.5 lg:gap-8 pb-10 text-white lg:flex-row">
<aside class="xl:sticky xl:top-[40px] xl:self-start flex flex-col gap-2.5 min-w-[300px] xl:min-w-[310px]" style="flex: 0 1 0%;">
<figure class="flex flex-col gap-2.5">
<figcaption class="panel relative transition-colors duration-300 rounded-xl px-5 flex items-center justify-between w-full py-3" style="height: 50px;">
<span class="flex-shrink-0 text-grey-600 text-xs">
<?php echo htmlspecialchars($doc["profession"]);?>
</span>
<h4 class="font-medium text-white text-right">
<a class="hover:underline" href="#">
<?php echo htmlspecialchars($doc["fname"]." ".$doc["lname"]);?> </a>
</h4>
</figcaption>
<div class="relative lg:max-w-sm flex flex-1 overflow-hidden rounded-xl" style="width: 100%; height: 426px;"><a href="/browse/instructors/jwmcpeak">
<img src="<?php echo $docImage;?>" class="mx-auto w-full lg:object-cover lg:h-[445px]" alt="<?php echo htmlspecialchars($doc["title"]." ".$doc["fname"]." ".$doc["lname"]);?> Image"></a></div>
</figure>
<div>


<div class="flex items-start gap-2.5 flex-wrap lg:flex-nowrap">
<div class="hide-mobile flex lg:flex-col gap-1 justify-between lg:w-[50px] w-full">
<a class="btn btn-base btn-secondary px-2 py-1 flex-center flex-1 hover:text-white bg-card-600" href="" target="_blank">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<svg class="transition-autoall p-1" viewBox="0 0 23 20" fill="none" width="32">
<path d="m.759 0 8.24 11.018-8.292 8.958h1.866l7.26-7.843 5.866 7.843h6.35L13.347 8.338 21.064 0h-1.866l-6.686 7.223L7.11 0H.759zm2.745 1.375H6.42L19.305 18.6h-2.918L3.504 1.375z" class="fill-current"></path>
</svg></span></a>
<a class="btn btn-base btn-secondary px-2 py-1 flex-center flex-1 hover:text-white bg-card-600" href="" target="_blank">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<em class="ni ni-facebook-fill text-2xl"></em>
</span></a>

<div class="flex-1">
<a class="btn btn-base btn-secondary lg:[writing-mode:vertical-lr] px-2 py-2 w-full text-xs font-medium h-full lg:h-auto flex justify-center bg-card-600" href="" transparent="" target="_blank">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
<em class="ni ni-instagram text-2xl"></em>
</span></a></div>
</div>
<div class="panel relative transition-colors duration-300 py-4 rounded-xl px-5 flex w-full flex-1 self-stretch">
<p class="content font-semibold mb-0 lg:text-xs line-clamp-6"><?php echo htmlspecialchars($doc["bio"]);?>
</p>
</div>
</div>



</div>
</aside>
<div class="flex-1">
<div class="flex">
<a class="btn btn-base btn-secondary hidden lg:inline-flex lg:items-center gap-2 mb-2.5 px-5 flex-shrink-0" href="specialists.php" style="height: 50px; z-index: 50;">
<em class="ni text-3lg ni-chevron-left"></em>
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
View All Specialists </span></a>
<header class="section-heading-secondary container relative mx-auto mb-4 flex items-center justify-between px-[30px] xl:px-0 hidden lg:flex">
<p class="inherits-color absolute right-0 z-10 hidden translate-y-4 xl:translate-y-2 font-kanit md:text-2xl lg:text-[75px] font-bold uppercase text-card-500 md:block">
<?php echo htmlspecialchars($doc["profession"]);?></p>
</header>
</div>







<div class="panel relative transition-colors duration-300 px-4 lg:px-8 py-4 rounded-xl series-header pt-7 md:pt-5 pb-7 overflow-hidden flex" style="z-index:30">
<div class="relative z-20 flex flex-col">
<div class="md:flex text-center md:text-left relative z-10 flex-1">
<div class="flex-1">
<!-- <div class="md:hidden mb-2">
<img loading="lazy" class="lay" src="images/diagnosis.png" alt="PHP For Beginners thumbnail" width="194" height="194">
</div> -->
<div class="hidden md:flex gap-2 mb-9 z-10 relative" style="height: 28px;">
<a class="btn btn-base btn-secondary is-small flex-center text-2xs py-2 px-3 mr-auto gap-x-1 border-transparent bg-card-300" href="index.php">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<em class="ni ni-home-alt"></em>&nbsp; Home</span></a>
<span class="text-2xs border border-card-300 rounded-full px-3 py-1 font-medium text-grey-600 leading-none inline-flex items-center gap-x-1"><?php echo htmlspecialchars(substr($doc["category"],0,-1));?></span>
</div>

<div class="md:hidden flex gap-2 mb-7 z-10 relative" style="height: 28px;">
<a class="btn btn-base btn-secondary is-small flex-center text-2xs py-2 px-3 mr-auto gap-x-1 border-transparent bg-card-300" href="index.php">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<em class="ni ni-home-alt"></em>&nbsp; Home</span></a>
<span class="text-2xs border border-card-300 rounded-full px-3 py-1 font-medium text-grey-600 leading-none inline-flex items-center gap-x-1"><?php echo htmlspecialchars(substr($doc["category"],0,-1));?></span>
<!-- <a class="btn btn-base is-small border-inherit text-2xs hover:border-transparent hover:text-white text-languages hover:bg-languages rounded-full px-5 py-1 font-normal leading-none flex-center" href="" style="width: auto;">Languages</a> -->
</div>


<h1 class="text-balance reduce-font text-3xl font-semibold leading-tight">Healing Starts Here</h1>
<div class="series-custom-url mb-4">
<a href="" class="link text-[15px] font-medium text-grey-600">
<?php echo htmlspecialchars($doc["title"]." ".$doc["fname"]." ".$doc["lname"]);?>
</a></div>
<div class="mx-auto mt-6 md:mx-0">
<div class="generic-content text-center font-normal lg:pr-10" style="font-size: 16px;">
<p>Availing Traditional and quality healthcare to empower Nigerians live healthier.
Striving to ensure Nigerians irrespective of remote location or distance barrier are provided with adequate access to effective healthcare services both online and offline with no or little financial hassle.
</p>
<h3 class="font-medium text-capitalize">
<?php echo htmlspecialchars($doc["hospital"]);?><br>
<?php echo htmlspecialchars($doc["location"]);?>
</h3>
</div>
</div>
</div>
<div class="relative hidden md:flex md:flex-col md:items-center md:justify-center text-languages">
</div>
</div>

<div class="series-buttons flex w-full flex-wrap justify-start items-end gap-4 mt-4 md:-mt-2">
<div class="basis-full md:basis-auto">
<a class="btn btn-base btn-primary has-icon w-full mx-auto" href="dashboard/consultation.php">
<em class="ni ni-calendar-alt text-lg"></em> &nbsp; &nbsp;
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
Book Appointment</span>
</a>
</div>

<div class="basis-full md:basis-auto">
<button class="btn btn-base btn-secondary has-icon flex-1 mx-auto w-full" solid="">
<em class="ni ni-cc-secure text-lg"></em> &nbsp; &nbsp; 
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">View Contact Details</span></button>
</div>
<div class="basis-full md:basis-auto">
</div>
<figure class="ml-auto hidden md:block translate-y-2 -mt-3">
<img loading="lazy" class="rounded-full border" src="<?php echo $docImage?>" alt="<?php echo htmlspecialchars($doc["title"]." ".$doc["fname"]." ".$doc["lname"]);?> Image" width="90" height="90">
</figure>
</div>
</div>

<div class="absolute inset-0 z-10 pointer-events-none mix-blend-luminosity hidden lg:block">
<img loading="lazy" class="absolute bottom-0 right-0 translate-x-32 translate-y-1/4 pointer-events-none opacity-10" src="images/sickness-icon/Gastroenteritis.png" alt="" width="700" height="700">
<div class="bg-gradient-to-b from-transparent via-transparent via-60% to-card-500 absolute inset-0">
</div>
</div>
</div>





<!-- <section class="pb-[60px] pt-0">
<div class="panel relative transition-colors duration-300 px-4 lg:px-8 rounded-xl bg-card-800 has-custom-bg py-8"><div class="mx-auto" style="max-width: 1100px;"><div class="mx-auto max-w-sm lg:mx-0 lg:flex lg:max-w-full lg:items-center"><div class="flex justify-center"><div class="profile-avatar pr-6"><div class="lg:block"><div class="relative flex flex-col items-center"><a class="relative flex items-start max-w-[fit-content] achievement is-elite mb-2 bg-deep-black/10 p-2" href="/@bobbybouwmann" style="width: 112px; height: 112px; padding: 2px; border-radius: 30px;"><span class="absolute z-10" style="right: -5px; top: 0px;"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-22"><img src="/images/badges/community-pillar.svg" width="30" alt="Community Pillar Achievement Badge"></div><div id="achievement-template-22" class="hidden"><h4 class="mb-1 text-sm font-bold">Community Pillar</h4><p>Earned once your experience points ranks in the top 10 of all Laracasts users.</p>
</div></span><img loading="lazy" class="relative text-deep-black/10 mb-4 lg:mb-0 p-1" src="https://laracasts.s3.us-east-1.amazonaws.com/avatars/bobby-bouwmann.jpg" alt="bobbybouwmann's avatar" width="112" height="112" data-tooltip="Laravel Fashionista. Top Contributor at Laracasts. Partner @ <a href=&quot;https://pingping.io&quot;>PingPing</a>. Lead Engineer @ <a href=&quot;https://hospitable.com&quot;>Hospitable</a>." style="width: 100%; max-width: none; border-radius: 24px;"></a><div class="flex justify-between gap-x-1"><a class="btn btn-base btn-secondary twitter group px-4 hover:text-white" href="http://twitter.com/bobbybouwmann" target="_blank" rel="noreferrer"><
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"><svg class="transition-all" viewBox="0 0 23 20" fill="none" width="20"><path d="m.759 0 8.24 11.018-8.292 8.958h1.866l7.26-7.843 5.866 7.843h6.35L13.347 8.338 21.064 0h-1.866l-6.686 7.223L7.11 0H.759zm2.745 1.375H6.42L19.305 18.6h-2.918L3.504 1.375z" class="fill-current"></path></svg></span></a><a class="btn btn-base btn-secondary github group px-4 hover:text-white" href="http://github.com/bobbybouwmann" target="_blank" rel="noreferrer">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"><svg viewBox="0 0 30 29" class="transition-all" width="22"><path class="fill-current" fill-rule="nonzero" d="M27.959 7.434a14.866 14.866 0 0 0-5.453-5.414C20.21.69 17.703.025 14.984.025c-2.718 0-5.226.665-7.521 1.995A14.864 14.864 0 0 0 2.01 7.434C.67 9.714 0 12.202 0 14.901c0 3.242.953 6.156 2.858 8.746 1.906 2.589 4.367 4.38 7.385 5.375.351.064.611.019.78-.136a.755.755 0 0 0 .254-.58l-.01-1.047c-.007-.658-.01-1.233-.01-1.723l-.448.077a5.765 5.765 0 0 1-1.083.068 8.308 8.308 0 0 1-1.356-.136 3.04 3.04 0 0 1-1.308-.58c-.403-.304-.689-.701-.858-1.192l-.195-.445a4.834 4.834 0 0 0-.614-.988c-.28-.362-.563-.607-.85-.736l-.136-.097a1.428 1.428 0 0 1-.253-.233 1.062 1.062 0 0 1-.176-.271c-.039-.09-.007-.165.098-.223.104-.059.292-.087.566-.087l.39.058c.26.052.582.206.965.465.384.258.7.594.947 1.007.299.53.66.933 1.082 1.21.423.278.85.417 1.278.417.43 0 .8-.032 1.112-.097a3.9 3.9 0 0 0 .878-.29c.117-.866.436-1.53.956-1.996a13.447 13.447 0 0 1-2-.348 7.995 7.995 0 0 1-1.833-.756 5.244 5.244 0 0 1-1.571-1.298c-.416-.516-.758-1.195-1.024-2.034-.267-.84-.4-1.808-.4-2.905 0-1.563.514-2.893 1.541-3.99-.481-1.176-.436-2.493.137-3.952.377-.116.936-.03 1.678.261.741.291 1.284.54 1.629.746.345.207.621.381.83.523a13.948 13.948 0 0 1 3.745-.503c1.288 0 2.537.168 3.747.503l.741-.464c.507-.31 1.106-.595 1.795-.853.69-.258 1.216-.33 1.58-.213.586 1.46.638 2.777.156 3.951 1.028 1.098 1.542 2.428 1.542 3.99 0 1.099-.134 2.07-.4 2.916-.267.846-.611 1.524-1.034 2.034-.423.51-.95.94-1.58 1.288a8.01 8.01 0 0 1-1.834.756c-.592.155-1.259.271-2 .349.676.58 1.014 1.498 1.014 2.75v4.087c0 .232.081.426.244.58.163.155.42.2.77.136 3.019-.994 5.48-2.786 7.386-5.375 1.905-2.59 2.858-5.504 2.858-8.746 0-2.698-.671-5.187-2.01-7.466z"></path></svg></span></a>
</div></div></div></div><div class="lg:mr-6"><div class="mb-8"><div class="flex w-full flex-col items-start text-white"><div class="flex"><h1 class="text-xl tracking-normal lg:mr-4">bobbybouwmann</h1><div class="hidden leading-none xl:flex xl:items-center xl:justify-center"><a href="https://hospitable.com/careers" class="ml-2 text-2xs font-bold text-grey-600"> Hire Me </a></div></div><p class="mb-2 text-sm tracking-normal text-grey-600 lg:text-xs">Laravel Evangelist  at Hospitable</p><p class="text-xs tracking-normal"> Member Since 9 years ago</p><p class="mt-1 flex items-center text-xs tracking-normal"><svg width="9" height="10" viewBox="0 0 9 10" class="mr-2"><g fill="#FFF" fill-rule="nonzero"><path d="M4.5 10a.331.331 0 0 1-.176-.05C4.15 9.84.094 7.25.003 4.482c-.042-1.26.394-2.368 1.26-3.202C2.106.467 3.286 0 4.5 0s2.393.467 3.238 1.28c.865.834 1.3 1.941 1.26 3.202C8.906 7.25 4.847 9.84 4.675 9.95A.331.331 0 0 1 4.5 10zm0-9.412C3.456.588 2.441.99 1.714 1.69.97 2.407.596 3.366.632 4.464.702 6.629 3.73 8.822 4.5 9.345c.77-.523 3.797-2.716 3.868-4.881.036-1.098-.338-2.057-1.082-2.774C6.559.99 5.544.588 4.5.588z"></path><path d="M4.506 5.72c-.928 0-1.682-.705-1.682-1.572 0-.866.754-1.571 1.682-1.571.927 0 1.682.705 1.682 1.571 0 .867-.755 1.572-1.682 1.572zm0-2.555c-.58 0-1.052.44-1.052.983 0 .542.472.983 1.052.983.58 0 1.052-.44 1.052-.983 0-.542-.472-.983-1.052-.983z"></path></g></svg> Lives In Apeldoorn</p>
</div></div></div></div><div class="lg:ml-auto"><div class="mb-4 mt-6 flex justify-between space-x-4 overflow-auto lg:ml-auto lg:mt-0 lg:justify-end"><div class="panel relative transition-colors duration-300 hoverable rounded-xl experience-level-card group flex-shrink-0 cursor-pointer p-2 text-center border border-transparent hover:border-blue/30 hover:text-blue-400 py-2 px-2" data-tooltip-template="experience-explanation-template"><div class="mb-2 flex items-center justify-center" style="height: 102px;"><img class="-mb-2 inline-block mix-blend-luminosity group-hover:mix-blend-normal" src="/images/profiles/xp-level.svg?id=2" alt="Experience Points"></div><strong class="mb-2 block text-2xl font-bold">2,172,045</strong><div class="text-sm leading-tight">Total <br>Experience</div></div><div id="experience-explanation-template" class="hidden"><div class="w-64 px-2"><p class="mb-3 border-b border-card-700 pb-2 italic"><strong class="text-blue-400">0</strong> experience to go until the next level! </p><p class="mb-2"><strong> In case you were wondering, you earn Laracasts experience when you: </strong></p><ul class="pl-4" style="list-style: disc;"><li> Complete a lesson <span class="font-bold text-blue-400">— 100pts</span></li><li> Create a forum thread <span class="font-bold text-blue-400"> — 100pts </span></li><li> Reply to a thread <span class="font-bold text-blue-400">— 100pts</span></li><li> Leave a reply that is liked <span class="font-bold text-blue-400">— 100pts</span></li><li> Receive a "Best Reply" <span class="font-bold text-blue-400">— 1000pts</span></li></ul></div></div><div class="panel relative transition-colors duration-300 hoverable rounded-xl experience-level-card group flex-shrink-0 cursor-pointer p-2 text-center border border-transparent hover:border-blue/30 hover:text-blue-400 py-2 px-2"><div class="mb-2 flex items-center justify-center" style="height: 102px;"><img class="-mb-2 inline-block mix-blend-luminosity group-hover:mix-blend-normal" src="/images/profiles/xp-lesson.svg?id=2" alt="Experience Points"></div><strong class="mb-2 block text-2xl font-bold">2477</strong><div class="text-sm leading-tight">Lessons <br>Completed</div></div><div class="panel relative transition-colors duration-300 hoverable rounded-xl experience-level-card group flex-shrink-0 cursor-pointer p-2 text-center border border-transparent hover:border-blue/30 hover:text-blue-400 py-2 px-2"><div class="mb-2 flex items-center justify-center" style="height: 102px;"><img class="-mb-2 inline-block mix-blend-luminosity group-hover:mix-blend-normal" src="/images/profiles/xp-stars.svg?id=2" alt="Experience Points"></div><strong class="mb-2 block text-2xl font-bold">2705</strong><div class="text-sm leading-tight">Best Reply <br>Awards</div></div></div></div></div><div class="mx-auto mt-2 max-w-md text-center"><blockquote class="profile-bio relative inline-block text-sm text-grey-600">Laravel Fashionista. Top Contributor at Laracasts. Partner @ &lt;a href="https://pingping.io"&gt;PingPing&lt;/a&gt;. Lead Engineer @ &lt;a href="https://hospitable.com"&gt;Hospitable&lt;/a&gt;.</blockquote></div><div class="mb-2 mt-6 flex justify-center"><ul class="achievement-list hidden lg:flex lg:flex-1 lg:justify-between lg:gap-x-1"><li class="achievement flex flex-1 items-center justify-center is-advanced has-not-been-awarded text-deep-black/10 opacity-40 mix-blend-luminosity transition-all hover:opacity-100 hover:mix-blend-normal mr-2"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-23"><img src="/images/badges/laravel-architect.svg" width="55" height="58" alt="Laravel Architect Achievement Badge"></div><div id="achievement-template-23" class="hidden"><h4 class="mb-1 text-sm font-bold">Laravel Architect</h4><p>Earned once you have completed the Laravel Path.</p><p>Click to learn more.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-advanced has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-22"><img src="/images/badges/community-pillar.svg" width="42" height="45" alt="Community Pillar Achievement Badge"></div><div id="achievement-template-22" class="hidden"><h4 class="mb-1 text-sm font-bold">Community Pillar</h4><p>Earned once your experience points ranks in the top 10 of all Laracasts users.</p>
</div></li><li class="achievement flex flex-1 items-center justify-center is-advanced has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-14"><img src="/images/badges/top50.svg" width="42" height="45" alt="Top 50 Achievement Badge"></div><div id="achievement-template-14" class="hidden"><h4 class="mb-1 text-sm font-bold">Top 50</h4><p>Earned once your experience points ranks in the top 50 of all Laracasts users.</p>
</div></li><li class="achievement flex flex-1 items-center justify-center is-advanced has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-12"><img src="/images/badges/laracasts-sensei.svg" width="42" height="45" alt="Laracasts Sensei Achievement Badge"></div><div id="achievement-template-12" class="hidden"><h4 class="mb-1 text-sm font-bold">Laracasts Sensei</h4><p>Earned once your experience points passes 1 million.</p>
</div></li><li class="achievement flex flex-1 items-center justify-center is-advanced has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-10"><img src="/images/badges/laracasts-tutor.svg" width="42" height="45" alt="Laracasts Tutor Achievement Badge"></div><div id="achievement-template-10" class="hidden"><h4 class="mb-1 text-sm font-bold">Laracasts Tutor</h4><p>Earned once your "Best Reply" award count is 100 or more.</p>
</div></li><li class="achievement flex flex-1 items-center justify-center is-advanced has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-9"><img src="/images/badges/laracasts-master.svg" width="42" height="45" alt="Laracasts Master Achievement Badge"></div><div id="achievement-template-9" class="hidden"><h4 class="mb-1 text-sm font-bold">Laracasts Master</h4><p>Earned once 1000 Laracasts lessons have been completed.</p>
</div></li><li class="achievement flex flex-1 items-center justify-center is-intermediate has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-16"><img src="/images/badges/ten-thousand-strong.svg" width="42" height="45" alt="Ten Thousand Strong Achievement Badge"></div><div id="achievement-template-16" class="hidden"><h4 class="mb-1 text-sm font-bold">Ten Thousand Strong</h4><p>Earned once your experience points hits 10,000.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-intermediate has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-11"><img src="/images/badges/laracasts-veteran.svg" width="42" height="45" alt="Laracasts Veteran Achievement Badge"></div><div id="achievement-template-11" class="hidden"><h4 class="mb-1 text-sm font-bold">Laracasts Veteran</h4><p>Earned once your experience points passes 100,000.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-intermediate has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-2"><img src="/images/badges/chatterbox.svg" width="42" height="45" alt="Chatterbox Achievement Badge"></div><div id="achievement-template-2" class="hidden"><h4 class="mb-1 text-sm font-bold">Chatterbox</h4><p>Earned once you have achieved 500 forum replies. (Current: 15,422)</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-24"><img src="/images/badges/many-year-member.svg" width="42" height="45" alt="Laracasts Loyalty Achievement Badge"></div><div id="achievement-template-24" class="hidden"><h4 class="mb-1 text-sm font-bold">9 Year Member</h4><p>Rewarded for being a Laracasts account holder for 9 years. Wow!</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-15"><img src="/images/badges/welcome-to-the-community.svg" width="42" height="45" alt="Welcome To The Community Achievement Badge"></div><div id="achievement-template-15" class="hidden"><h4 class="mb-1 text-sm font-bold">Welcome To The Community</h4><p>Earned after your first post on the Laracasts forum.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-21"><img src="/images/badges/laracasts-evangelist.svg" width="42" height="45" alt="Laracasts Evangelist Achievement Badge"></div><div id="achievement-template-21" class="hidden"><h4 class="mb-1 text-sm font-bold">Laracasts Evangelist</h4><p>Earned if you share a link to Laracasts on social media. Please email support@laracasts.com with your username and post URL to be awarded this badge.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-20"><img src="/images/badges/lifer.svg" width="42" height="45" alt="Lifer Achievement Badge"></div><div id="achievement-template-20" class="hidden"><h4 class="mb-1 text-sm font-bold">Lifer</h4><p>Earned if you have a lifetime subscription to Laracasts.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-19"><img src="/images/badges/subscriber.svg" width="42" height="45" alt="Subscriber Achievement Badge"></div><div id="achievement-template-19" class="hidden"><h4 class="mb-1 text-sm font-bold">Subscriber</h4><p>Earned if you are a paying Laracasts subscriber.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-18"><img src="/images/badges/pay-it-forward.svg" width="42" height="45" alt="Pay It Forward Achievement Badge"></div><div id="achievement-template-18" class="hidden"><h4 class="mb-1 text-sm font-bold">Pay It Forward</h4><p>Earned once you receive your first "Best Reply" award on the Laracasts forum.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-17"><img src="/images/badges/full-time-learner.svg" width="42" height="45" alt="Full Time Learner Achievement Badge"></div><div id="achievement-template-17" class="hidden"><h4 class="mb-1 text-sm font-bold">Full Time Learner</h4><p>Earned once 100 Laracasts lessons have been completed.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-1"><img src="/images/badges/start-your-engines.svg" width="42" height="45" alt="Start Your Engines Achievement Badge"></div><div id="achievement-template-1" class="hidden"><h4 class="mb-1 text-sm font-bold">Start Your Engines</h4><p>Earned once you have completed your first Laracasts lesson.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-13"><img src="/images/badges/school-in-session.svg" width="42" height="45" alt="School In Session Achievement Badge"></div><div id="achievement-template-13" class="hidden"><h4 class="mb-1 text-sm font-bold">School In Session</h4><p>Earned when at least one Laracasts series has been fully completed.</p></div></li><li class="achievement flex flex-1 items-center justify-center is-beginner has-been-awarded"><div class="flex flex-shrink-0 cursor-pointer" data-tooltip-template="achievement-template-3"><img src="/images/badges/first-thousand.svg" width="42" height="45" alt="First Thousand Achievement Badge"></div><div id="achievement-template-3" class="hidden"><h4 class="mb-1 text-sm font-bold">First Thousand</h4><p>Earned once you have earned your first 1000 experience points.</p></div></li></ul></div><div class="flex items-center text-xs font-bold uppercase text-white"><span>Level 88</span><div class="mx-4 flex-1 rounded-full bg-deep-black/10" style="height: 9px;"><div class="h-full rounded-full bg-blue" style="width: 63%;"></div></div><span>Max 200</span></div></div></div>
</section> -->

	

</div>
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