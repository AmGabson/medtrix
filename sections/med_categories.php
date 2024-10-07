<section class="py-0 mb-6">
<div class="banner is-topic relative mx-auto mb-6 lg:mb-0">
<header class="container mt-10 mx-auto mb-4 max-w-[800px] pb-4 px-6 text-center text-white">


<!-- <h3 class="inherits-color relative z-10 text-6xl font-semibold leading-tighter text-balance tracking-tight">
<span class="pp profession bg-gradient-to-r from-[#49dbff] to-[#0587eb] bg-clip-text" style="-webkit-text-fill-color: transparent;">Browse Resources</span></h3> -->
<h1 class="mb-2 head-text text-5xl leading-none text-white">Browse Resources</h1>
<p class="text-grey-700"> Access all Medical Resources Here </p>
</header>

<div>
<section id="topics-nav" class="p-0 max-w-none">
<!-- Category List -->
<nav class="container" aria-label="Topics Menu">
<ul class="hide-scrollbar px-[30px] flex min-h-[40px] items-center gap-x-2 overflow-x-auto overflow-y-hidden from-transparent via-[rgba(50,138,241,0.15)] to-transparent pr-[20px] text-center leading-loose after:absolute after:bottom-[-20px] after:hidden after:h-px after:w-full after:flex-shrink-0 after:bg-gradient-to-r md:mx-auto md:mx-auto md:min-h-0 md:justify-center overflow-auto md:gap-x-8 md:overflow-x-visible md:overflow-y-visible md:pr-0 after:md:block lg:gap-x-12"
style="max-width: 800px;">

<li class="relative inline-block flex-shrink-0">
<a class="taxonomy-nav-link rounded-full px-4 py-2 text-2lg font-medium hover:text-white md:px-0 md:py-0 md:text-lg is-active bg-blue text-white md:bg-transparent switchCat" href="javascript:void(0)" data-category="all"> All Resource </a></li>

<?php
//get all categories
$stmt=$pdo->prepare("SELECT * FROM med_category");
$stmt->execute();
$categories=$stmt->fetchAll();
foreach($categories as $category){
?>

<li class="relative inline-block flex-shrink-0">
<a class="taxonomy-nav-link rounded-full px-4 py-2 text-base font-medium hover:text-white md:px-0 md:py-0 md:text-lg text-white md:bg-transparent md:text-card-300 switchCat"
href="javascript:void(0)" data-category="<?php echo intval($category["cat_id"]);?>">
<?php echo htmlspecialchars($category["category"]);?>
</a></li>

<?php }?>
</ul>
</nav>

<!-- Load Category Lists (Locations) -->
<div class="flex loadList"></div>

</section>
</div>
</div>
</section>


