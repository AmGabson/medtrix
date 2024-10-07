<div id="forum" class="wrapper dark text-white">
<div class="section pt-0 md:pt-2">
<div>
<div id="forum-wrapper" class="mx-auto flex flex-col-reverse justify-between md:flex-row lg:gap-x-10 max-w-[1400px]">
<aside class="hidden flex-none lg:sticky lg:block lg:self-start" style="width: 210px; top: 40px;">
<div class="lg:sticky lg:text-center">
<a href="dashboard/consultation.php" class="btn btn-base btn-primary mx-auto mb-3 block w-full" id="js-forum-reply-button" data-js="reply-button">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
Book Appointment </span>
</a>

<a href="specialists.php" class="btn btn-base btn-secondary mb-8 w-full py-4">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
All Specialists &nbsp; <em class="ni ni-chevron-right text-lg"></em></span>
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
<header class="container mx-auto mb-4 max-w-[800px] pb-4 px-6 text-center text-white">
<h3 class="mb-2 text-5xl head-text leading-none text-white">Medical Specialists</h3>
<p class="text-grey-700"> Reach out to experts. Start your appointment request here.</p>
</header>
<div id="forum-main-top" class="mb-6 empty:hidden"></div>


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
<em class="icon ni ni-users" style="font-size: large;"></em> &nbsp;&nbsp; 
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">Med Specialists </span>
</button></div></div>
</div>




<!-- Side Ads -->
<div class="sticky hidden h-screen max-w-[266px] 2xl:block" style="height: 426px; top: 40px;">
<div class="max-h-screen space-y-4 overflow-auto pb-15">
<a class="block" href="">
<div class="panel relative transition-colors duration-300 hoverable rounded-xl mx-auto px-0 py-0 text-center" heading="" style="height: 240px; background: linear-gradient(148deg, rgb(33, 200, 246) -11%, rgba(33, 200, 246, 0) 42%); width: 100%;">
<div class="flex h-full flex-col justify-between gap-y-3 rounded-2xl px-5 py-4 items-start" style="background-image: radial-gradient(circle at 0% 2%, rgb(0, 117, 255), rgb(31, 64, 106) 100%); border-radius: inherit;">
<div class="flex flex-col items-center mr-2 text-left">
<div class="flex-1">
<img loading="lazy" class="absolute right-4 w-[174px]" src="images/strip.png" aria-hidden="">
<img loading="lazy" class="absolute right-0 top-0" src="images/lil-doc.png" width="80" alt="Stethoscope">
<h5 class="-mt-1 text-left font-semibold leading-tighter tracking-normal text-white w-[65%] text-sm xl:text-xl">A Medical Personnel? <span class="text-blue-300">Medtrix</span>
</h5>
<p class="mt-5 text-xs text-white">Register as a practitioner today & start attending to patients.</p>
</div>
</div>
<a href="register.php" class="btn btn-base btn-primary mb-2 w-full py-4">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">Join Medtrix Today!</span>
</a>
</div>
</div>
</a>




<div class="panel relative transition-colors duration-300 hoverable px-4 lg:px-8 py-4 rounded-xl flex flex-col items-center justify-between gap-y-2 text-center" style="height: 245px;"><a class="inherits-color block flex-1" href="/series/laravel-and-vite">
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
</a><a href="medicines.php" class="w-full max-w-[200px] rounded-xl px-4 py-1 text-center text-2xs font-medium leading-loose bg-card-400 text-grey-600"> Buy Drugs </a>
</div>



</div>
</div>



</div>
</div>
</div>
</div>