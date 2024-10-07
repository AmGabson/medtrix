<header class="container mx-auto mb-4 max-w-[800px] pb-4 px-6 text-center text-white">
<img loading="lazy" class="lazy absolute hidden translate-x-[20%] lg:inline-block lg:w-[550px] lazyloaded" src="images/map-id.png" alt="Map" style="margin-top: -20px; width:1000px; opacity:0.5">

<h3 class="pp inherits-color relative z-10 text-6xl font-semibold leading-tighter text-balance tracking-tight">
<span class="bg-gradient-to-r from-[#49dbff] to-[#0587eb] bg-clip-text" style="-webkit-text-fill-color: transparent;">Popular Locations</span></h3>
<p class="inherits-color mt-3 text-grey-600 text-balance font-medium text-lg">Don't miss out. <a href="">Get connected</a></p>
</header>



<!-- 
    bg-gradient-testing
    bg-gradient-techniques
    bg-gradient-languages
    bg-gradient-tooling
    bg-gradient-frameworks
 -->


<div id="userScroll" class="flex items-start gap-4 overflow-x-scroll overflow-y-hidden px-[30px] hide-scrollbar">

<?php
//Popular Locations
$stmt=$pdo->prepare("SELECT * FROM locations WHERE verified=1");
$stmt->execute();
$getLocation=$stmt->fetchAll();
for ($i = 0; $i < count($getLocation); $i += 2) {
?>

<div class="space-y-4">
<?php 
if ($i < count($getLocation)) {
$locationImg = (!empty($getLocation[$i]['image']) ? "images/location-img/".$getLocation[$i]['image']: "images/noimage.jpg");
?>
<div class="panel relative hover:bg-panel-700 transition-colors duration-300 dark  text-white bg-panel-800 py-4 rounded-xl flex-shrink-0 px-4" style="width: 390px;">
<a class="relative transition-colors duration-300 text-white py-4 rounded-xl instructor-card group px-4 lg:h-[210px]" href="/series/javascript-the-first-steps">
<div class="flex gap-8">
<aside class="w-32" style="flex: 0 1 0%;">
<div class="absolute top-0 left-0 rounded-full instructor-swoosh <?php echo $getLocation[$i]['color']?>" style="width: 115px;height: 115px;">
</div>
<div class="photo-wrap relative border-6 border-blue-darkest" style="width: 105px; height: 154px; margin-top: -21px; margin-left: -5px; border-radius: 66px;">
<img loading="lazy" class="lazy h-full w-full object-cover lazyloaded" src="<?php echo $locationImg;?>" alt="<?php echo htmlspecialchars($getLocation[$i]['title']);?> " width="105" height="164" style="border-radius: inherit; box-shadow: rgba(120, 144, 156, 0.07) 0px 0px 0px 1px;">
</div></aside>
<div>
<h4 class="text-xl font-medium leading-tight tracking-tight">
<?php echo htmlspecialchars($getLocation[$i]['title']);?> 
<img src="images/svgs/verified-badge.svg" width="15">
</h4>
<p class="mt-1 text-xs text-grey-600"><?php echo htmlspecialchars($getLocation[$i]['subtitle']);?> </p>
<p class="!font-normal mt-2 clamp text-sm xl:text-base" title="<?php echo htmlspecialchars($getLocation[$i]['desc']);?>" style="-webkit-line-clamp: 8;">
<?php echo htmlspecialchars($getLocation[$i]['desc']);?></p></div>
</div></a>
</div>

<?php }
if ($i + 1 < count($getLocation)) {
$locationImg2 = (!empty($getLocation[$i+1]['image']) ? "images/location-img/".$getLocation[$i+1]['image']: "images/noimage.jpg");
?>

<div class="panel relative hover:bg-panel-700 transition-colors duration-300 dark  text-white bg-panel-800 py-4 rounded-xl flex-shrink-0 px-4" style="width: 390px;">
<a class="relative transition-colors duration-300 text-white py-4 rounded-xl instructor-card group px-4 lg:h-[210px]" href="/series/javascript-the-first-steps">
<div class="flex gap-8">
<aside class="w-32" style="flex: 0 1 0%;">
<div class="absolute top-0 left-0 rounded-full instructor-swoosh <?php echo $getLocation[$i+1]['color']?>" style="width: 115px;height: 115px;"></div>
<div class="photo-wrap relative border-6 border-blue-darkest" style="width: 105px; height: 154px; margin-top: -21px; margin-left: -5px; border-radius: 66px;">
<img loading="lazy" class="lazy h-full w-full object-cover lazyloaded" src="<?php echo $locationImg2;?>" alt="<?php echo htmlspecialchars($getLocation[$i + 1]['title']);?>" width="105" height="164" style="border-radius: inherit; box-shadow: rgba(120, 144, 156, 0.07) 0px 0px 0px 1px;"></div>
</aside>
<div>
<h4 class="text-xl font-medium leading-tight tracking-tight">
<?php echo htmlspecialchars($getLocation[$i + 1]['title']);?> 
<img src="images/svgs/verified-badge.svg" width="15"></h4>
<p class="mt-1 text-xs text-grey-600"><?php echo htmlspecialchars($getLocation[$i + 1]['subtitle']);?> </p>
<p class="!font-normal mt-2 clamp text-sm xl:text-base" title="<?php echo htmlspecialchars($getLocation[$i + 1]['subtitle']);?>" style="-webkit-line-clamp: 8;">
<?php echo htmlspecialchars($getLocation[$i + 1]['desc']);?> </p>
</div>
</div></a>
</div>
<?php }?>
</div>

<?php }?>




</div>
