
<header class="mx-auto max-w-sm px-6 text-center text-white" style="--0e22d4f9: 760px;margin-top:100px">
<div class="pointer-events-none absolute left-0 top-0 mx-auto w-full max-w-full overflow-hidden">
<img src="images/svgs/grid.svg" class="opacity-75" alt="" aria-hidden="true" style="max-width: 1400px; margin-top: 72px;"></div>
<img loading="lazy" class="relative -mt-15" src="images/med.png" alt="logo" width="200" height="200">

<h1 class="group text-5xl font-semibold">Health <span class="relative inline-block cursor-pointer text-blue-400" data-tooltip="A recommended pathway through Laracasts to learn a new skill from scratch. Upon completion, you'll receive a new Path-specific achievement badge.">Care</span>
</h1>
<p class="-mt-1 mb-10 text-balanc font-medium text-grey-600">
Knowing the path & walking the path.</p>
</header>




<section class="mx-auto pt-0" style="max-width: 1200px; --a12602d6: #F8B02B;">
<div class="container">
<div class="flex flex-col-reverse gap-8 pb-10 text-white lg:flex-row lg:justify-center">


<!-- Main with Lists -->
<div class="flex-1 space-y-2.5">
<div class="panel relative transition-colors duration-300 px-4 lg:px-8 py-4 rounded-xl series-header pt-7 md:pt-5 pb-7 overflow-hidden flex">
<div class="relative z-20 flex flex-col">
<div class="md:flex text-center md:text-left relative z-10 flex-1">
<div class="flex-1">
<div class="md:hidden mb-2">
<img loading="lazy" class="lay" src="images/diagnosis.png"
alt="PHP For Beginners thumbnail" width="194" height="194">
</div>
<div class="hidden md:flex gap-2 mb-9 z-10 relative" style="height: 28px;"><a
class="btn btn-base btn-secondary is-small flex-center text-2xs py-2 px-3 mr-auto gap-x-1 border-transparent bg-card-300"
href="/series">
<svg width="15" height="26"
viewBox="0 0 26 26" fill="none">
<path clip-rule="evenodd" d="M25 1v24H1V1h24z" stroke="#000"
stroke-opacity=".012" stroke-width=".514"></path>
<path class="fill-current" fill-rule="evenodd" clip-rule="evenodd"
d="M16.704 4.764c.605.605.606 1.587 0 2.193L10.676 13l6.03 6.043a1.552 1.552 0 0 1-2.196 2.193l-7.387-7.388a1.2 1.2 0 0 1 0-1.697l7.387-7.387a1.552 1.552 0 0 1 2.195 0z">
</path>
</svg><span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
Browse Our Services </span></a>
<span class="text-2xs border border-card-300 rounded-full px-3 py-1 font-medium text-grey-600 leading-none inline-flex items-center gap-x-1">Proving answers to your health</span>
<a class="btn btn-base is-small border-inherit text-2xs hover:border-transparent hover:text-white text-languages hover:bg-languages rounded-full px-5 py-1 font-normal leading-none flex-center"
href="" style="width: auto;">Languages</a>
</div>
<h1 class="text-balance reduce-font text-3xl font-semibold leading-tight">Healing Starts Here</h1>
<div class="series-custom-url mb-4">
<a href="" class="link text-[15px] font-medium text-grey-600">Find Doctors Nearby</a></div>
<div class="mx-auto mt-6 md:mx-0">
<div class="generic-content text-center font-normal lg:pr-10" style="font-size: 16px;">
<p>Availing Traditional and quality healthcare to empower Nigerians live healthier.
Striving to ensure Nigerians irrespective of remote location or distance barrier are provided with adequate access to effective healthcare services both online and offline with no or little financial hassle.
</p>
<p>Join our platform today to enjoy healthcare efficiency at your comfort and convenience.
</p>
</div>
</div>
</div>
<div
class="relative hidden md:flex md:flex-col md:items-center md:justify-center text-languages">
</div>
</div>


<?php
$stmt=$pdo->prepare("SELECT COUNT(*) AS count FROM doctors");
$stmt->execute();
$cntDocs=$stmt->fetch();
?>

<div class="series-buttons flex w-full flex-wrap justify-start items-end gap-4 mt-4 md:-mt-2" style="
    align-items: center;
">
<div class="basis-full md:basis-auto">
<a class="btn btn-base btn-primary has-icon w-full mx-auto" href="">
<em class="icon ni ni-users text-bold"></em> &nbsp;
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
Over <?php echo intval($cntDocs["count"]);?> Specialists</span>
</a>
</div>

<div class="basis-full md:basis-auto">
<button class="btn btn-base btn-secondary has-icon flex-1 mx-auto w-full"
solid="">
<em class="ni ni-activity text-bold"></em>&nbsp; 
<a href="specialists.php" class="flex-center h-full flex-shrink-0 text-wrap leading-none">
View Specialists &nbsp;<em class="ni ni-chevron-right"></em> <!--Electronic Health Records(EHRs)--></a></button>
</div>
<div class="basis-full md:basis-auto">
</div>
<figure class="ml-auto hidden md:block translate-y-2">
<img loading="lazy" class="" src="images/diagnosis.png" alt="Diagnosis Doc" width="140" height="140">
</figure>
</div>
</div>
<div class="absolute inset-0 z-10 pointer-events-none mix-blend-luminosity hidden lg:block">

<img loading="lazy" class="absolute bottom-0 right-0 translate-x-32 translate-y-1/4 pointer-events-none opacity-10" src="images/hel2.png" alt="" width="700" height="700">
<div
class="bg-gradient-to-b from-transparent via-transparent via-60% to-card-500 absolute inset-0">
</div>
</div>
</div>
<div
class="relative hidden before:absolute before:top-[49%] before:ml-[2%] before:block before:h-[3px] before:w-[96%] before:bg-card-300 md:block py-2">
<div class="relative z-10 flex w-full flex-nowrap justify-between gap-3">
<a transparent="" class="flex h-auto rounded-xl bg-card-600 px-3 py-2 font-grotesk text-xs font-normal transition-colors duration-300 hover:bg-card-500"
href="/path">
<span class="text-blue-400">MedTrixLab </span>
<span class="relative text-grey-600">&nbsp;Path</span>
</a>

<a transparent="" class="flex h-auto flex-wrap rounded-xl border bg-card-600 px-3 py-2 font-grotesk text-xs font-normal transition-colors duration-300 hover:bg-card-500 border-blue-400"
title="Start by creating account" href="">
<span class="inline-block max-w-[205px] overflow-hidden overflow-ellipsis whitespace-nowrap text-grey-600">Register | Create Profile</span></a>

<a transparent="" class="flex h-auto flex-wrap rounded-xl border bg-card-600 px-3 py-2 font-grotesk text-xs font-normal transition-colors duration-300 hover:bg-card-500 border-transparent"
title="Tell us the symptoms" href="">
<span class="inline-block max-w-[205px] overflow-hidden overflow-ellipsis whitespace-nowrap text-grey-600">Identify your health Status</span></a>

<a transparent="" class="flex h-auto flex-wrap rounded-xl border bg-card-600 px-3 py-2 font-grotesk text-xs font-normal transition-colors duration-300 hover:bg-card-500 border-transparent"
title="Live consultancy" href="">
<span class="inline-block max-w-[205px] overflow-hidden overflow-ellipsis whitespace-nowrap text-grey-600">Book Live | Chat consultancy</span></a></div>
</div>

<div class="panel relative transition-colors duration-300 py-4 rounded-xl px-8" id="series-details">
<div class="container">
<div class="flex text-2xs text-white">
<div class="left flex flex-1 gap-x-4">
<div class="flex items-center font-medium">
    
<svg width="15" height="15" viewBox="0 0 15 15" class="mr-2 text-grey-600">
<g fill="none" fill-rule="evenodd">
<path d="M-1-1h18v18H-1z"></path>
<path class="fill-current" d="M6 10.875L10.5 7.5 6 4.125v6.75zM7.5 0C3.36 0 0 3.36 0 7.5 0 11.64 3.36 15 7.5 15c4.14 0 7.5-3.36 7.5-7.5C15 3.36 11.64 0 7.5 0zm0 13.5c-3.307 0-6-2.693-6-6s2.693-6 6-6 6 2.693 6 6-2.693 6-6 6z">
</path>
</g>
</svg>
<span class="text-xs">Live Chat</span></div>
<div class=" font-medium lg:flex ">
<div class="flex items-center">
<div class="difficulty-meter mr-2 flex space-x-1 is-beginner">
<span class="block rounded bg-grey-600" style="width: 5px; height: 11px;"></span>
<span class="block rounded bg-grey-600/25" style="width: 5px; height: 11px;"></span>
<span class="block rounded bg-grey-600/25" style="width: 5px; height: 11px;"></span></div>
<span class="text-xs font-medium mobile:text-left">Quality Services</span>
</div>
</div>
</div>
<div class="right flex space-x-2"><!----></div>
</div>
</div>
</div>



<!-- Pharmist Drugs -->
<div class="mh panel relative transition-colors duration-300 hoverable rounded-xl mx-auto px-0 py-0 text-center" heading="" style="background: linear-gradient(148deg, rgb(33, 200, 246) -11%, rgba(33, 200, 246, 0) 42%); width: 100%;">
<div class="flex h-full flex-col justify-between gap-y-3 rounded-2xl px-5 py-4 items-start" style="background-image: radial-gradient(circle at 0% 2%, rgb(4 68 145), rgb(20 42 70) 100%); border-radius: inherit;">
<div class="flex flex-col items-center mr-15 text-left">
<div class="flex-1">
<img loading="lazy" class="absolute right-4 w-[174px]" src="images/strip.png">
<img loading="lazy" class="absolute right-4 top-5" src="images/drugs.png" width="50" alt="Medicines & Vitamins">
<h5 class="-mt-1 text-left font-semibold leading-tighter tracking-normal text-white text-2xl xl:text-[30px]">Looking for Medicines?</h5>
<p class="mt-5 text-xs text-white">
Browse through lists of Medicines that are rarely found. <br>Check out lists of available Pharmacies near you. 
</p>
</div>
</div>
<a href="medicines.php" class="btn btn-base btn-primary mb-8 pt-2 pb-2">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">Find Medicines</span>
</a>
</div>
</div>



<!-- Common Sickness from DB -->
<br>
<ol class="episode-list">


<div class="toggleDropAll panel relative transition-colors duration-300 px-4 lg:px-8 py-4 rounded-xl relative flex w-full cursor-pointer items-center mb-2.5" style="background-image: radial-gradient(circle at 0% 2%, rgb(20 51 91), rgb(36 45 63) 100%)">
<h3 class="flex items-center text-xl font-bold" title="Constructs">
<span class=" mr-4 hidden pr-4 md:inline">
<em class="ni ni-activity"></em></span>
<span class="flex items-center font-semibold">
<span class="circle mr-3 hidden h-6 w-6 md:flex md:flex-shrink-0 md:items-center bg-languages text-languages" style="display: none;"><span class="position flex h-full w-full items-center justify-center text-white hover:text-black md:text-lg">
<svg width="40%" height="100%" viewBox="0 0 21 16" class="relative inline-block" style="top: 0.7px;">
<g fill="#FFF" fill-rule="evenodd"><path fill="none" d="M-3-5h27v27H-3z"></path><path d="M7.439 12.152l-5.037-5.36c-.447-.477-1.119-.477-1.566 0a1.204 1.204 0 0 0 0 1.667l6.603 7.03L20.086 2.025a1.204 1.204 0 0 0 0-1.668c-.447-.476-1.12-.476-1.567 0L7.44 12.152z"></path></g></svg>
</span></span> Common Sicknesses</span></h3>

<div class="-mr-2 h-10 w-10 bg-deep-black/10 flex-center absolute right-5 ml-auto self-center rounded-lg">
<button class="p-3 openAll display-none">
<svg viewBox="0 0 22 22" width="25"><g fill="none" fill-rule="evenodd"><path stroke-opacity=".012" stroke="#000" stroke-width=".5" d="M21 21H1V1h20z"></path><path class="fill-current" d="M14.825 13.911 11 10.094l-3.825 3.817L6 12.736l5-5 5 5z"></path></g></svg>
</button>
<button class="p-3 closeAll">
<svg width="25" height="16" class="fill-current" viewBox="0 0 10 16"><path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path></svg>
</button>
</div>
</div>

<li id="allSickness" class="display-none">  
<?php
    $stmt=$pdo->prepare(
    "SELECT 
    c.category AS category_name, 
    s.title AS sickness_name, 
    s.description AS sickness_desc, 
    s.id AS id, 
    s.icon AS sickness_icon 
    FROM 
    category c 
    JOIN 
    sicknesses s 
    ON 
    c.cat_id = s.cat_id");
    $stmt->execute();

$categories = [];
while($getCat = $stmt->fetch()){
    if(!isset($categories[$getCat["category_name"]])){
        $categories[$getCat["category_name"]] = [];
    }
    $categories[$getCat["category_name"]][] = [
        'sickness_name' =>$getCat["sickness_name"],
        'sickness_desc' =>$getCat["sickness_desc"],
        'id' =>$getCat["id"],
        'icon' =>$getCat["sickness_icon"]
    ];
}
$cnt = 1;
foreach($categories as $category => $sicknesses){
?>



<!-- Category Title-->
<div class="toggleDrop panel relative transition-colors duration-300 px-4 lg:px-8 py-4 rounded-xl relative flex w-full cursor-pointer items-center mb-2.5" style="" data-id="<?php echo $cnt;?>">
<h3 class="flex items-center text-xl font-bold" title="Sickness Category">
<span class="border-r mr-4 hidden border-card-400 pr-4 md:inline">
<em class="icon ni ni-virus text-grey-600"></em>
</span>
<span class="flex items-center font-semibold">

<?php echo $category;?>
</span>
</h3>

<div class="-mr-2 h-10 w-10 bg-deep-black/10 flex-center absolute right-5 ml-auto self-center rounded-lg ">

<!-- open btn-->
<button class="p-3 opened<?php echo $cnt;?> <?php if($cnt !==1){echo "display-none";}?>">
<svg viewBox="0 0 22 22" width="25">
<g fill="none" fill-rule="evenodd">
<path stroke-opacity=".012" stroke="#000" stroke-width=".5"
d="M21 21H1V1h20z"></path>
<path class="fill-current"
d="M14.825 13.911 11 10.094l-3.825 3.817L6 12.736l5-5 5 5z"></path>
</g>
</svg>
</button>

<!-- closed btn-->
<button class="p-3 closed<?php echo $cnt;?> <?php if($cnt ==1){echo "display-none";}?>">
<svg width="25" height="16" class="fill-current" viewBox="0 0 10 16"><path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path></svg>
</button>

</div>
</div>
<!-- /Category Title -->


<!-- Sickness List -->
<ol class="sicknessList<?php echo $cnt;?> <?php if($cnt !==1){echo "display-none";}?>">
<?php 
foreach($sicknesses as $sickness){ 
$icon = "images/sickness-icon/".$sickness["icon"]; ?>

<li class="panel relative transition-colors duration-300 hoverable rounded-xl episode-list-item group mb-[10px] flex cursor-pointer px-6 py-4 md:h-[170px] is-languages"
id="episode-2565" data-js="episode-number-10">
<div class="flex-center relative mr-5 pr-0 font-bold">
<div class="circle flex-center text-2xl font-medium tracking-tight text-white border-6 border-[#1a2230] bg-[#334159] transition-colors duration-300 group-hover:bg-card-300"
style="width: 70px; height: 70px;">
<img src="<?php echo $icon;?>" alt="<?php echo htmlspecialchars($sickness["sickness_name"]);?> Illustration">
</div>
</div>
<div class="episode-list-details flex flex-1 mobile:border-b-0 justify-around">
<div>
<div class="mb-2 items-center justify-between">
<h4
class="episode-list-title link inherits-color flex items-center text-xl font-medium md:text-xl lg:leading-none">
<a class="inherits-color line-clamp-2 leading-normal md:line-clamp-1"
title="Separate Logic From the Template"
href="/series/php-for-beginners-2023-edition/episodes/10">
<?php echo htmlspecialchars($sickness["sickness_name"]);?>
</a></h4>
</div>
</div>
<div
class="episode-list-excerpt generic-content text-xs md:text-[15px] lg:block lg:pr-10">
<p class="line-clamp-2">
<?php echo htmlspecialchars($sickness["sickness_desc"]);?>
</p>
</div>
<div class="mt-3 flex w-full items-center gap-3 btn-break">
<span class="md:inline-flex md:items-center text-grey-600/75 text-xs">
<!-- <em class="ni ni-puzzle"></em> -->
<span class="text-xs font-medium">
<?php echo $category;?></span>
</span>
<a class="flex items-center btn-secondary pb-1 pr-6 pt-1 rounded-xl" href="" style="font-weight:600; font-size:11px; padding-left:1.5rem"> 
<span>Read More</span>&nbsp;&nbsp;
<span><em class="ni ni-chevron-right"></em></span></a>
</div>
</div>
</li>

<?php $cnt++; } ?>
</ol>

<?php }?>
<!-- Sickness List -->


</li>
</ol>
<!-- Common Sickness from DB -->



</div>
<!--End Main with Lists -->









<!-- Aside Content -->
<aside class="xl:sticky s xl:top-[40px] xl:self-start flex flex-col gap-2.5 min-w-[300px] xl:min-w-[310px]"
style="flex: 0 1 0%;">
<figure class="flex flex-col gap-2.5">
<figcaption
class="panel relative transition-colors duration-300 rounded-xl px-5 flex items-center justify-between w-full py-3"
style="height: 50px;"><span class="flex-shrink-0 text-grey-600 text-sm">Services</span>
<h5 class="font-medium text-white text-lg text-right">
<a class="hover:underline" href="dashboard/consultation.php">Book Consultancy</a>

</h5>
</figcaption>
<div class="relative lg:max-w-sm flex flex-1 overflow-hidden rounded-xl"
style="width: 100%; height: 426px; justify-content: center;">

<a class="block" href="register.php">
<div class="panel relative transition-colors duration-300 hoverable rounded-xl mx-auto px-0 py-0 text-center" heading="" style="height: 240px; background: linear-gradient(148deg, rgb(33, 200, 246) -11%, rgba(33, 200, 246, 0) 42%); width: 100%;">
<div class="flex h-full flex-col justify-between gap-y-3 rounded-2xl px-5 py-4 items-start" style="background-image: radial-gradient(circle at 0% 2%, rgb(0, 117, 255), rgb(31, 64, 106) 100%); border-radius: inherit;">
<div class="flex flex-col items-center mr-15 text-left">
<div class="flex-1">
<img loading="lazy" class="absolute right-4 w-[174px]" src="images/strip.png" aria-hidden="">
<img loading="lazy" class="absolute right-0 top-0" src="images/call.png" width="130" alt="Stethoscope">
<h5 class="-mt-1 text-left font-semibold leading-tighter tracking-normal text-white text-2xl xl:text-[30px]">Talk to a Doctor</h5>
<p class="mt-5 text-xs text-white">Try our online consultation service today! Get professional medical reply ASAP</p>
</div>
</div>
<button class="btn btn-base btn-primary mb-2 w-full py-4">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">Sign Me Up!</span>
</button>
</div>
</div>
</a>
</div>


<div class="btn btn-base btn-secondary max-w-none bg-card-600 hide-mobile">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Connect with us
</span>
</div>



</figure>

<div>
<div class="flex items-start gap-2.5 flex-wrap lg:flex-nowrap">
<div class="hide-mobile flex lg:flex-col gap-1 justify-between lg:w-[50px] w-full">
<a class="btn btn-base btn-secondary px-2 py-1 flex-center flex-1 hover:text-white bg-card-600"
href="" target="_blank">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<svg class="transition-all p-1" viewBox="0 0 23 20" fill="none" width="32">
<path d="m.759 0 8.24 11.018-8.292 8.958h1.866l7.26-7.843 5.866 7.843h6.35L13.347 8.338 21.064 0h-1.866l-6.686 7.223L7.11 0H.759zm2.745 1.375H6.42L19.305 18.6h-2.918L3.504 1.375z"
class="fill-current"></path>
</svg></span></a>
<a class="btn btn-base btn-secondary px-2 py-1 flex-center flex-1 hover:text-white bg-card-600" href="" target="_blank">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<em class="ni ni-facebook-fill text-2xl"></em>
</span></a>

<div class="flex-1">
<a class="btn btn-base btn-secondary lg:[writing-mode:vertical-lr] px-2 py-2 w-full text-xs font-medium h-full lg:h-auto flex justify-center bg-card-600"
href="" transparent="" target="_blank">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
<em class="ni ni-instagram text-2xl"></em>
</span></a></div>
</div>
<div class="panel relative transition-colors duration-300 py-4 rounded-xl px-5 flex w-full flex-1 self-stretch">
<p class="content font-semibold mb-0 lg:text-xs line-clamp-6">The Effective treatment depends on getting the right diagnosis, the right answers the first time. <br>Our experts diagnose and treat the toughest medical challenges.
</p>
</div>
</div>
</div>






<div class="btn btn-base btn-secondary max-w-none bg-card-600 hide-mobile mt-2">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Payment Methods
</span>
</div>

<!-- <div class="bg-secondary">
<dl class="flex md:ml-1 gap-8 justify-center">
<div>
<dd class="text-center">
<img src="images/solanaPNG.png" width="30px">
</dd>
</div> 

<div>
<dd class="text-center">
<img src="images/mcard.png" width="30px">
</dd>
</div> 

<div>
<dd class="text-center">
<img src="images/token.png" width="30px">
</dd>
</div> 

</dl>
</div> -->



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



</aside>
<!-- Aside Content -->

</div>
</div>








<div class="panel mt-5 relative transition-colors duration-300 px-4 lg:px-8 rounded-xl lg:flex w-full py-0">
<div class="relative mx-auto basis-full items-center justify-between py-4 font-bold text-white md:flex md:justify-center lg:flex-1 lg:basis-0">
<div class="pointer-events-none absolute bottom-0 left-1/2 right-0 top-0 hidden -translate-x-1/2 transform opacity-10 mix-blend-luminosity md:block" style="background: url(<?php if(isset($userid)){echo $userimage;}else{ echo 'images/avatar.svg';}?>) 50% -3% / 410px no-repeat;">
</div>
<!-- <a class="hidden h-12 w-12 flex-1 flex-shrink-0 items-center justify-center rounded-full bg-card-400 transition-all hover:bg-blue 2xl:flex 2xl:flex-none cursor-not-allowed" title="" data-js="previous-episode-button" disabled="true" href="">
<svg width="40" height="26" viewBox="0 0 26 26" fill="none" class="text-white/10"><path clip-rule="evenodd" d="M25 1v24H1V1h24z" stroke="#000" stroke-opacity=".012" stroke-width=".514"></path>
<path class="fill-current" fill-rule="evenodd" clip-rule="evenodd" d="M16.704 4.764c.605.605.606 1.587 0 2.193L10.676 13l6.03 6.043a1.552 1.552 0 0 1-2.196 2.193l-7.387-7.388a1.2 1.2 0 0 1 0-1.697l7.387-7.387a1.552 1.552 0 0 1 2.195 0z"></path>
</svg></a> -->
<div class="flex-1 md:flex md:space-x-6 2xl:mx-8">
<div class="px-4 md:flex-1 md:px-0 flex flex-col justify-between">
<header class="mb-8">
<div class="flex items-center">
<!-- <button class="rounded-full transition-colors duration-200 flex items-center justify-center bg-card-700 mr-4" style="width: 60px;height: 60px;"> -->

<?php if(isset($userid)){?>
<img src="<?php echo $userimage;?>" class="rounded-full transition-colors duration-200 mr-4" style="width: 60px;height: 60px;border:4px solid #334059; background:#334059;">
<?php }else{ ?>
    <img src="images/avatar.svg" class="rounded-full transition-colors duration-200 mr-4" style="width: 60px;height: 60px;border:4px solid #334059; background:#334059;">
<?php }?>

<!-- </button> -->
<h1 class="text-2xl font-bold leading-tight widescreen:text-[30px] stat-name">
<?php 
if(isset($userid)){
echo htmlspecialchars($row["fullName"]);
}else{
    echo "Login to View Stats";
}?>
<br>
<div class="text-2xs font-medium text-grey-600/60">Play Games to Earn more Tokens</div>
</h1>
</div>
</header>

<?php 
//get solana Wallet
$stmt=$pdo->prepare("SELECT * FROM solana WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$exists = $stmt->rowCount();
$solana=$stmt->fetch();

//get Token and account Bal
$stmt=$pdo->prepare("SELECT * FROM account WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$acc=$stmt->fetch();

if(isset($userid)){
?>
<div>
<dl class="flex md:ml-1 gap-8">
<div>
<dt class="md:mb-2 text-2xs font-medium text-grey-600/60">Token(s)</dt>
<dd class="text-sm font-medium text-white"><?php echo intval($acc["token"]);?></dd>
</div> 
<div>
<dt class="md:mb-2 text-2xs font-medium text-grey-600/60">Balance(&#8358;)</dt>
<dd class="text-sm font-medium text-white"><?php echo number_format($acc["deposit"], 2, '.', ',');?></dd>
</div>

<div class="sol-container">
<dt class="md:mb-2 tooltip-show text-2xs font-medium text-grey-600/60 cursor-pointer">Solana(SOL)</dt>
<dd class="text-sm font-medium text-white">
<span class="conn cursor-pointer" tabindex="1">
<?php if(isset($solana["balance"])){echo htmlspecialchars($solana["balance"]);}else{echo "Connect";}?> 
</span>
</dd>
</div>

</dl>





</div>

<?php }else{?>
<div>
<dl class="flex md:ml-1 gap-8">
<div>
<dt class="md:mb-2 text-2xs font-medium text-grey-600/60">
Your Wallet Details
</dt>
<dd class="text-sm font-medium text-white">
<a class="link text-white" href="login.php?login=request">Login to preview</a></dd></div>
</dl>
</div>
<?php }?>

</div>
<div class="mx-auto mt-8 flex flex-wrap items-center gap-2 self-center md:mt-0 md:max-w-2xs lg:mx-0 xl:max-w-[200px]"><div class="flex-1" style="flex-basis: 180px;">

<?php if(isset($userid)){?>
<a href="dashboard" class="btn btn-base btn-secondary has-icon py-4 w-full">
<em class="icon ni ni-user" style="font-size: large;"></em> &nbsp;&nbsp;
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Go to Dashboard </span>
</a></div>
<?php }else{?>
<a href="login.php?login=request" class="btn btn-base btn-secondary has-icon py-4 w-full">
<em class="icon ni ni-user" style="font-size: large;"></em> &nbsp;&nbsp;
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Login to Continue </span>
</a></div>
<?php }?>

<div class="flex-1" style="flex-basis: 180px;">
<button class="btn btn-base btn-secondary has-icon py-4 w-full">
<em class="icon ni ni-building" style="font-size: large;"></em> &nbsp;&nbsp; 
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Hospitals Nearby </span>
</button></div></div>
</div>
<!-- <a class="hidden h-12 w-12 flex-1 flex-shrink-0 items-center justify-center rounded-full bg-card-400 transition-all 2xl:flex 2xl:flex-none hover:bg-blue" title="Next Episode: Tools of the Trade" data-js="next-episode-button" disabled="false" href="/series/php-for-beginners-2023-edition/episodes/2?autoplay=true"><svg width="40" height="26" viewBox="0 0 26 26" fill="none" class="text-white">
<path clip-rule="evenodd" d="M1 25V1h24v24H1z" stroke="#000" stroke-opacity=".012" stroke-width=".514"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M9.296 21.236a1.552 1.552 0 0 1 0-2.193L15.324 13l-6.03-6.043a1.552 1.552 0 0 1 2.196-2.193l7.387 7.388a1.2 1.2 0 0 1 0 1.697l-7.387 7.387a1.552 1.552 0 0 1-2.195 0z" class="fill-current"></path></svg></a> -->
</div>
</div>













<!-- GAME SECTION -->
<section class="px-0 xl:px-[30px]">
<header class="section-heading-secondary container relative mx-auto mb-4 flex items-center justify-between px-[30px] xl:px-0">
<div class="flex">

<!-- Scroll Control Btn -->
<div class="relative z-10 ml-6 hidden space-x-3 md:flex md:items-center md:justify-center">
<button class="hover:bg-card-300 flex-center h-8 w-8 rounded-full bg-card-500 p-2 transition-colors duration-300 hover:scale-105 disabled:cursor-not-allowed" disabled="" id="scrollBackBtn">
<em class="ni ni-chevron-left text-xl"></em>
</button>
<progress  data-v-26688bcb="" id="progress-bar" max="100" class="rounded-xl bg-card-600 cursor-pointer" value="" style="height: 10px;"></progress>

<button class="hover:bg-card-300 flex-center h-8 w-8 rounded-full bg-card-500 p-2 transition-colors duration-300 hover:scale-105 disabled:cursor-not-allowed" id="scrollFrontBtn">
<em class="ni ni-chevron-right text-xl"></em>
</button>
</div>
<!-- Scroll Control Btn -->

</div>
<p class="inherits-color absolute right-0 z-10 hidden translate-y-4 xl:translate-y-2 font-kanit md:text-3xl lg:text-[75px] font-bold uppercase text-card-500 md:block">Earn Tokens</p></header>
<!-- Scroll Games pix -->
<div class="container z-10">
<div class="grid auto-cols-max grid-flow-col gap-6 overflow-auto hide-scrollbar px-[30px] xl:px-0" id="gameScroll">

<?php
//get games
$stmt=$pdo->prepare("SELECT * FROM games");
$stmt->execute();
$games=$stmt->fetchAll();
$num =1;

foreach($games as $game){
$gamePix = (!empty($game["image"]) ? "images/games/".$game["image"]: "images/games/game.png");

if($num !==1){
  $link = "#";  
}else{
    $link = "games/".$game["folderName"];
}
?>

<a href="<?php echo $link;?>">
<figure class="relative group overflow-hidden h-full flex">
<img loading="lazy" class="rounded-xl transition-all duration-300 hover:grayscale-1" src="<?php echo $gamePix;?>" alt="<?php echo htmlspecialchars($game["title"]);?>" width="266" height="382">
<figcaption class="absolute bottom-0 w-full translate-y-0 text-center leading-none py-6 flex-center flex-col bg-black/50 font-semibold pointer-events-none">
<span class="text-lg lg:text-2xl"><?php echo htmlspecialchars($game["title"]);?></span><span class="text-grey-600 text-sm mt-1"><?php echo htmlspecialchars($game["desc"]);?></span>
</figcaption>
</figure></a>

<?php $num++; }?>

</div>
</div>
</section>

</section>



