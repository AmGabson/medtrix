<?php
include "../include/config.php";
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);




if(isset($_POST["pageNumber"])){

    $catId = htmlspecialchars($_POST["catId"]);
    $arrangemntFormat = htmlspecialchars($_POST["format"]);

    if($catId == "all"){
        $checkState = "";
    }else{
        $checkState = "WHERE cat_id =". $catId;
    }


    //Count total rows
    $stmt = $pdo->prepare("SELECT COUNT(*) AS numrow FROM doctors $checkState");
    $stmt->execute();
    $num = $stmt->fetch();

    $totalRow = $num["numrow"];         // Total rows on Table
    $action = $_POST["action"];         //Contain either of Next or Previous Btn
    $start = $_POST["pageNumber"];      //Fetch Start Point
    $limit = 4;                         //Row Fetch Limit
 

    //IF NEXT BUTTON WAS CLICKED
    if($action == "next"){

    //Enable Prev Btn   
    echo "<script>
            $('#previous').prop('disabled', false);
            $('#previous').removeClass('cursor-not-allowed');
            $('#previous').addClass('hover:border-blue');
            $('#previous').addClass('focus:border-blue');
            $('#previous').addClass('focus:text-blue');
        </script>";     
    
    //pagination start point = 2
    $start += $limit;       
  
    //When all rows is viewed, prevent further scroll
    if($start > $totalRow){
     $start -= 2;
    }
    
     //When all rows is viewed, disable
    if($start + 4 > $totalRow){
        echo "<script>
            $('#next').prop('disabled', true);
            $('#next').addClass('cursor-not-allowed');
            $('#next').removeClass('hover:border-blue');
            $('#next').removeClass('focus:border-blue');
            $('#next').removeClass('focus:text-blue');
            </script>";
    }
} 




//IF PREVIOUS BUTTON WAS CLIKED
elseif($action == "previous"){

    //Enable next btn
    echo "<script>
            $('#next').prop('disabled', false);
            $('#next').removeClass('cursor-not-allowed');
            $('#next').addClass('hover:border-blue');
            $('#next').addClass('focus:border-blue');
            $('#next').addClass('focus:text-blue');
        </script>";


    //remove "2" from the start point
    $start -= $limit;

    //If we're back of first 2 rows, set start point to 0 top stop scroll
    if($start < 0){
        $start = 0;
    };

    //Disable previous button if back on the first 2 rows
    if($start < 2){
        echo "<script>
            $('#previous').prop('disabled', true);
            $('#previous').addClass('cursor-not-allowed');
            $('#previous').removeClass('hover:border-blue');
            $('#previous').removeClass('focus:border-blue');
            $('#previous').removeClass('focus:text-blue');
            </script>";
    }
}






// <!-- Doctors List-->
if($catId == "all"){
    $state = "";
}else{
    $state = "AND c.cat_id =". $catId;
}
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
c.category,
c.desc

FROM doctors d
JOIN
doc_category c 
WHERE d.cat_id = c.cat_id $state LIMIT :start, :limit");

$stmt->bindParam(":start", $start, PDO::PARAM_INT);
$stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
$stmt->execute();
$getDoctors=$stmt->fetchAll();


if($arrangemntFormat =="column"){
    echo '<div class="md:mt-2">
    <div class="grid relative z-10 xl:grid-cols-2 gap-4">';
    }
    
    foreach($getDoctors as $doctor){
        $docImage = !empty($doctor["image"]) ? "images/doctors/".$doctor["image"]: "images/avatar.svg";
    
    // check if localStorage is column or row based on user settings
    if($arrangemntFormat =="row"){

?>


<!-- Doctors in Rows-->
<div>
<div class="panel relative transition-colors duration-300 hoverable px-3 lg:px-8 mb-3 flex items-center justify-between conversation-stats rounded-xl py-4 pl-4 pr-2 border-none" style="border-radius: 12px; height: 49px;">
<div>
<p class="text-xs font-normal text-card-200 lg:block">
<?php echo htmlspecialchars(substr($doctor["category"],0,-1));?>
</p>
</div>
<div class="flex flex-1 items-center justify-around lg:justify-end">
<div class="mr-4 items-center flex lg:hidden xl:flex">
<svg width="19" height="13" viewBox="0 0 19 13" class="mr-1 text-card-200">
<g fill="none" fill-rule="evenodd">
<path d="M0-3h19v19H0z"></path>
<path class="fill-current" d="M9.5.562C5.542.562 2.161 3.025.792 6.5c1.37 3.475 4.75 5.937 8.708 5.937s7.339-2.462 8.708-5.937C16.838 3.025 13.458.562 9.5.562zm0 9.896A3.96 3.96 0 0 1 5.542 6.5 3.96 3.96 0 0 1 9.5 2.542 3.96 3.96 0 0 1 13.458 6.5 3.96 3.96 0 0 1 9.5 10.458zm0-6.333A2.372 2.372 0 0 0 7.125 6.5 2.372 2.372 0 0 0 9.5 8.875 2.372 2.372 0 0 0 11.875 6.5 2.372 2.372 0 0 0 9.5 4.125z"></path>
</g>
</svg><span class="text-xs font-semibold text-card-200">29</span>
</div>

<a class="btn btn-base is-channel is-small text-lg px-3 text-2xs py-2 is-forge" href="profile.php?sp=<?php echo intval($doctor["id"]);?>" style="--channel-color: #5db3b7;"><em class="icon ni ni-user-alt"></em></a>
</div>
</div>
<div class="panel mb-6 forum-comment is-reply mb-3 rounded-xl px-0 py-0 transition-colors duration-300 text-white bg-card-500 relative light" data-js="forum-comment" id="forum-question">
<div class="flex px-6 py-4 lg:p-5">
<div class="mr-5 hidden max-w-min text-left md:block">
<a class="relative flex items-start max-w-[fit-content] mb-2 rounded-lg" href="profile.php?sp=<?php echo intval($doctor["id"]);?>" style="width: 78px; height: 85px; padding: 2px;">
<img loading="lazy" class="relative" src="<?php echo $docImage;?>" alt="<?php echo htmlspecialchars($doctor["title"]." ".$doctor["fname"]." ".$doctor["lname"]);?> Image"  style="width: 100%; border-radius: 9px;width:78; height:85"></a>
<div class="text-center leading-none text-card-200">
<div class="text-2xs font-semibold text-card-200">
<?php echo htmlspecialchars($doctor["location"]);?></div>
</div>
</div>


<div class="relative flex flex-1 flex-col">
<div class="flex items-center text-3xs font-semibold uppercase leading-loose mb-1 2xl:inline-block" style="letter-spacing: 1.2px; display:flex;">
<img src="images/med.png" alt="Med Specialist" width="20" class="mr-1">
<span class="text-white">Medtrix</span>&nbsp;<span class="text-blue-400">Specialist</span>
</div>

<header class="mb-4 flex items-center justify-between">
<div class="md:hidden">
<a class="relative mr-4 block overflow-hidden rounded-lg" href="profile.php?sp=<?php echo intval($doctor["id"]);?>">
<img src="<?php echo $docImage;?>" class="is-circle w-8 bg-white md:w-18" alt="<?php echo htmlspecialchars($doctor["title"]." ".$doctor["fname"]." ".$doctor["lname"]);?> Image" loading="lazy" style="border-radius: 9px;"></a></div>

<div class="flex-1 text-left leading-none">
<div class="flex items-center">
<a class="mr-2 block text-lg font-bold text-white" href="profile.php?sp=<?php echo intval($doctor["id"]);?>">
<?php echo htmlspecialchars($doctor["title"]." ".$doctor["fname"]." ".$doctor["lname"]);?>
</a>
<span class="ml-1 hidden rounded-2xl px-2 py-1 text-xs font-semibold bg-card-400 text-grey-600 md:inline" title="Conversation Original Poster"> <?php echo htmlspecialchars($doctor["qualification"]);?> </span></div>
<div class="mt-2 flex flex-wrap items-center gap-x-1 text-2xs font-medium">
<span class="text-2xs text-card-200">
<?php echo htmlspecialchars($doctor["profession"]);?></span>
</div>
</div>
<div class="relative ml-3 flex" style="top: -5px;">
<div class="ml-4 hidden md:block">
<ul class="achievement-list hidden lg:flex lg:flex-1 lg:justify-between lg:gap-x-1"></ul>
</div>
</div>
</header>

<div id="conversation-title" class="mb-1 rounded-xl px-4 py-2 font-normal bg-card-400 font-kanit" style="word-break: break-word;">
<em class="icon ni ni-map-pin"></em> <?php echo htmlspecialchars($doctor["hospital"]);?>
<p class="text-2xs text-card-200">
<?php echo htmlspecialchars(substr($doctor["desc"], 0, 70)."...");?>
</p>
</div>

</div>
</div>
</div>
</div>
<!--/ Doctors in Rows-->



<?php }else{ ?>


<!-- Doctors in Column-->


<div class="group">
<header class="flex items-center gap-x-2 -mb-4">
<div class="-translate-y-2.5">
<img src="images/MedtrixNoBg.png" width="90px">
</div>
<div class="panel relative transition-colors duration-300 py-4 bg-card-600 has-custom-bg w-full rounded-2xl rounded-br-none pt-4 pb-8 px-4">

<div class="flex items-center text-3xs font-semibold uppercase leading-loose mb-1 2xl:inline-block" style="letter-spacing: 1.2px;">
<img src="images/med.png" alt="Med Specialist" width="20" class="mr-1">
<span class="text-white">Medtrix</span>&nbsp;<span class="text-blue-400">Specialist</span>
</div>

<div class="flex gap-x-3">
<a href="profile.php?sp=<?php echo intval($doctor["id"]);?>" class="bg-card-400 rounded-xl px-3 hover:text-white hover:bg-blue-400 py-1 text-grey-600 font-semibold text-xs w-full">
<em class="icon ni ni-user"></em> &nbsp; <?php echo htmlspecialchars($doctor["title"]." ".$doctor["fname"]." ".$doctor["lname"]);?>
</a>
</div>

</div>
</header>
<div
class="panel relative transition-colors duration-300 rounded-xl grid auto-cols-auto md:grid-flow-col px-6 py-6 gap-3 lg:grid-flow-col lg:grid-cols-[auto,1fr] px-6 py-6"
style="transform: translate3d(0px, 0px, 0px);">
<a class="rounded-xl block overflow-hidden md:w-[200px] 2xl:h-[260px]" href="profile.php?sp=<?php echo intval($doctor["id"]);?>">
<img loading="lazy" class="h-full w-full rounded-xl object-cover mix-blend-luminosity block group-hover:mix-blend-normal" src="<?php echo $docImage;?>" alt="<?php echo htmlspecialchars($doctor["title"]." ".$doctor["fname"]." ".$doctor["lname"]);?> Image" style="max-height:260.92px">
</a>
<div class="grid min-w-[225px] xl:min-w-0 xl:min-w-0 mt-3">
<dl class="space-y-2.5 mb-8">
<div
class="flex justify-between odd:bg-card-300/20 even:bg-card-300/50 rounded-xl lg:text-2xs py-1 px-3 w-full">
<?php echo htmlspecialchars(substr($doctor["category"],0,-1));?>
</div>
<div class="flex justify-between odd:bg-card-300/20 even:bg-card-300/50 rounded-xl lg:text-2xs py-1 px-3 w-full">
<?php echo htmlspecialchars($doctor["profession"]);?>
</div>
<div class="flex justify-between items-center odd:bg-card-300/20 even:bg-card-300/50 rounded-xl lg:text-2xs py-1 px-3 w-full">
<dt>
<em class="icon ni ni-location"></em> <?php echo htmlspecialchars($doctor["hospital"]);?>
</dt>
</div>
<div class="flex justify-between odd:bg-card-300/20 even:bg-card-300/50 rounded-xl lg:text-2xs py-1 px-3 w-full">
<dt>Qualification</dt>
<dd class="text-right line-clamp-1" title="Apeldoorn">
<?php echo htmlspecialchars($doctor["qualification"]);?></dd>
</div>
<!-- <div class="flex justify-between odd:bg-card-300/20 even:bg-card-300/50 rounded-xl lg:text-2xs py-1 px-3 w-full">
<dt>Last Active</dt>
<dd class="text-right line-clamp-1" title="1 day ago">1 day ago</dd>
</div> -->
</dl>
<div class="mx-auto mt-auto flex items-stretch gap-x-2 lg:mx-0 lg:h-[32px]">
<a href="https://twitter.com" target="_blank" rel="noreferrer" class="flex-center h-10 w-10 lg:h-8 lg:w-8 flex-shrink-0 rounded-md bg-card-400 bg-card-300">
<svg class="transition-all w-full p-2 text-grey-600" viewBox="0 0 23 20" fill="none">
<path d="m.759 0 8.24 11.018-8.292 8.958h1.866l7.26-7.843 5.866 7.843h6.35L13.347 8.338 21.064 0h-1.866l-6.686 7.223L7.11 0H.759zm2.745 1.375H6.42L19.305 18.6h-2.918L3.504 1.375z"
class="fill-current"></path>
</svg>
</a>

<a href="https://facebook.com" target="_blank" rel="noreferrer" class="flex-center h-10 w-10 lg:h-8 lg:w-8 flex-shrink-0 rounded-md bg-card-400 bg-card-300">
<em class="ni ni-facebook-fill text-2xl"></em>
</a>

<a href="https://instagram.com" target="_blank" rel="noreferrer" class="flex-center h-10 w-10 lg:h-8 lg:w-8 flex-shrink-0 rounded-md bg-card-400 bg-card-300">
<em class="ni ni-instagram text-2xl"></em>
</a>
<!-- 
<a class="btn btn-base btn-secondary ml-auto h-auto rounded-md px-3 py-3 lg:text-2xs" href="https://hospitable.com/careers" target="_blank" rel="noreferrer">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
Website </span>
</a> -->
</div>
</div>
</div>
</div>


<!--/ Doctors in Column-->

<?php } ?>



<script>
    //return scrolled position count to index page (Ajax callback)
    $("#page").val(<?php echo $start; ?>);
</script>


<?php } 

if($arrangemntFormat =="column"){
    echo '</div></div>';
    }

}?>


