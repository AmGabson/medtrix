<?php
include "../include/config.php";
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST["category"])){

$category = $_POST["category"];

if($category == "all"){
    $state = "";
}else{
    $state = "AND c.cat_id =". $category;
}
?>


<!-- Doctors List-->
<?php
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
WHERE d.cat_id = c.cat_id $state LIMIT 2");

$stmt->execute();
$getDoctors=$stmt->fetchAll();
if($stmt->rowCount() > 0){

foreach($getDoctors as $doctor){
	$docImage = !empty($doctor["image"]) ? "images/doctors/".$doctor["image"]: "images/avatar.svg";
?>
<div>
<div class="panel relative transition-colors duration-300 hoverable px-4 lg:px-8 mb-3 flex items-center justify-between conversation-stats rounded-xl py-4 pl-5 pr-6 border-none" style="border-radius: 12px; height: 49px;">
<div>
<p class="hidden text-xs font-normal text-card-200 lg:block">
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
</svg><span class="text-xs font-semibold text-card-200">29</span></div>
<div class="mr-4 flex items-center"><svg width="13" height="12" viewBox="0 0 15 14" class="mr-1 text-card-200">
<path class="fill-current" fill-rule="evenodd" d="M7.5 0C3.344 0 0 2.818 0 6.286c0 1.987 1.094 3.757 2.781 4.914l.117 2.35c.022.438.338.58.704.32l2.023-1.442c.594.144 1.219.18 1.875.18 4.156 0 7.5-2.817 7.5-6.285C15 2.854 11.656 0 7.5 0z"></path>
</svg><span class="text-xs font-semibold text-card-200">3</span></div>
<a class="btn btn-base is-channel is-small px-6 text-2xs py-2 is-forge" href="profile.php?sp=<?php echo intval($doctor["id"]);?>" style="--channel-color: #5db3b7;">Show Profile</a>
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
<h1 id="conversation-title" class="mb-4 rounded-xl px-6 py-4 text-lg font-normal bg-card-400 text-white font-kanit" style="word-break: break-word;"><?php echo htmlspecialchars($doctor["hospital"]);?></h1>
<div class="content user-content text-grey-100">
<div class="content user-content">
<p class="text-card-200">
<?php echo htmlspecialchars(substr($doctor["desc"], 0, 150)."..");?>
</p>
</div>
</div>

</div>
</div>
</div>
</div>
<!-- Doctors -->


<?php } }else{
    echo 
    '<p class="inherits-color hidden translate-y-4 xl:translate-y-2 font-kanit md:text-3xl text-center lg:text-[75px] font-bold uppercase text-card-500 md:block">No Specialist</p>';
} 






// disable next btn for pagination if doc row < 3
if($category == "all"){
    $checkState = "";
}else{
    $checkState = "WHERE cat_id =". $category ;
}
    //Count total rows
    $stmt = $pdo->prepare("SELECT COUNT(*) AS numrow FROM doctors $checkState");
    $stmt->execute();
    $num = $stmt->fetch();

    if($num["numrow"] < 3){ ?>

            <script>
            $('#next').prop('disabled', true);
            $('#next').addClass('cursor-not-allowed');
            $('#next').removeClass('hover:border-blue');
            $('#next').removeClass('focus:border-blue');
            $('#next').removeClass('focus:text-blue');
            </script>

  <?php }else{ ?>

        <script>
        $('#next').prop('disabled', false);
        $('#next').removeClass('cursor-not-allowed');
        $('#next').addClass('hover:border-blue');
        $('#next').addClass('focus:border-blue');
        $('#next').addClass('focus:text-blue');
        </script>

<?php  } } ?>

<!-- Disable previous btn once new category is clicked -->
<script>
$('#previous').prop('disabled', true);
$('#previous').addClass('cursor-not-allowed');
$('#previous').removeClass('hover:border-blue');
$('#previous').removeClass('focus:border-blue');
$('#previous').removeClass('focus:text-blue');
</script>