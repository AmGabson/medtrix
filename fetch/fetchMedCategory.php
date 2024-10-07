<?php
include("../include/config.php");
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST["category"])){
$category = $_POST["category"];

//Set row Arrangement of fetched lists
if($category == "all"){
    $arrangement = 2;
}else{
    $arrangement = 1;
}
?>

<div class="mx-auto mb-3 mt-8 grid grid-flow-col gap-x-4 gap-y-5 overflow-auto px-[30px] hide-scrollbar justify-start md:mt-[65px]"
style="grid-template-rows: repeat(<?php echo $arrangement;?>, 1fr);grid-auto-columns: 225px;">

<?php 
if($category == "all"){

//Get All Category based on user selection or page Load
$stmt=$pdo->prepare("SELECT medical_lists.title,medical_lists.image,med_category.category FROM medical_lists, med_category WHERE medical_lists.cat_id = med_category.cat_id");
$stmt->execute();
$medLists=$stmt->fetchAll();
foreach($medLists as $medList){
$icon = "images/medicals/".$medList["image"];
?>

<div class="topic-card flex flex-1 justify-center text-center md:max-w-[225px]">
<a class="panel relative transition-colors duration-300 dark  text-white bg-panel-800 hover:bg-panel-700 flex h-full w-full flex-shrink-0 flex-col justify-between rounded-2xl px-3 py-1 cursor-pointer bg-blue/7 hover:bg-blue/13" href="" style="height: 84px; min-width: 192px;">
<div class="flex flex-1 items-center">
<div class="mr-4 flex flex-shrink-0 justify-center">
<img width="50" height="50" src="<?php echo $icon;?>" alt="<?php echo htmlspecialchars($medList["category"]);?> icon" class="h-full" loading="lazy"></div>
<div class="w-full lg:w-auto flex justify-between md:block">
<h2 class="text-left text-base font-semibold leading-tight">
<?php echo htmlspecialchars($medList["title"]);?> </h2>
<div class="hidden text-left md:block text-sm md:text-3xs text-white md:text-grey-600/50">
<span class="relative inline-block text-xs" style="top: 1px;"> • <?php echo htmlspecialchars($medList["category"]);?></span> </div>
</div>
</div>
</a>
</div>


<!-- If not all, fetch according to selected category -->
<?php } }else{
    
$stmt=$pdo->prepare("SELECT * FROM medical_lists WHERE cat_id =:cat_id");
$stmt->bindParam(":cat_id",$category,PDO::PARAM_INT);
$stmt->execute();
$medLists=$stmt->fetchAll();
foreach($medLists as $medList){
$icon = "images/medicals/".$medList["image"];
?>

<div class="topic-card flex flex-1 justify-center text-center md:max-w-[225px]">
<a class="panel relative transition-colors duration-300 dark  text-white bg-panel-800 hover:bg-panel-700 flex h-full w-full flex-shrink-0 flex-col justify-between rounded-2xl px-3 py-1 cursor-pointer bg-blue/7 hover:bg-blue/13" href="" style="height: 84px; min-width: 192px;">
<div class="flex flex-1 items-center">
<div class="mr-4 flex flex-shrink-0 justify-center">
<img width="50" height="50" src="<?php echo $icon?>" alt="alpine-logo.svg topic icon" class="h-full" loading="lazy"></div>
<div class="w-full lg:w-auto flex justify-between md:block">
<h2 class="text-left text-base font-semibold leading-tight">
<?php echo htmlspecialchars($medList["title"]);?> </h2>
<div class="hidden text-left md:block text-sm md:text-3xs text-white md:text-grey-600/50">
<span class="relative inline-block text-xs" style="top: 1px;"><?php echo htmlspecialchars($medList["subtitle"]);?></span> </div>
</div>
</div>
</a>
</div>


<?php } }?>








</div>
<?php }?>