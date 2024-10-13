<!-- nprogress -->
<link rel="stylesheet" href="assets/css/SearchAlgoliaInput.css">
<script src="assets/js/nprogress.min.js"></script>
<link rel="stylesheet" href="assets/css/nprogress.min.css">


<?php 
//Modals
include "include/modals.php";
?>
<!-- Modal Backdrop -->
<div class="backdrop display-none"></div>



<div>
<div class="header-wrap relative" style="border-bottom: 1px solid #ffffff08;">

<nav class="section new-nav z-50 w-full max-w-none py-4 md:py-4">
<div class="relative flex items-center justify-between">

<div id="header-logo-arrow"
class="mr-4 flex lg:mr-8 2xl:mr-0 2xl:w-1/4 flex-shrink-0 has-animation">
<a class="relative inline-block cursor-pointer leading-none" href="index.php">
<img src="images/logo.png" width="100" alt="MedtrixLab Logo"></a>
</div>

<div class="navbar-links relative mr-auto hidden font-grotesk lg:flex lg:justify-around 2xl:mr-0 xl:w-full"
style="flex: 0 1 0%;">

<a class="navbar-link group block flex-shrink-0 text-md font-medium uppercase text-card-200 hover:text-white md:px-3 xl:px-5 xl:text-center navHome"
href="index.php"> Home </a>

<a class="navbar-link block flex-shrink-0 text-md font-medium uppercase text-grey-600/50 hover:text-white md:px-3 xl:px-5 xl:text-center navAbout"
href="about.php"> About </a>

<a class="navbar-link block flex-shrink-0 text-md font-medium uppercase text-grey-600/50 hover:text-white md:px-3 xl:px-5 xl:text-center navMed"
href="medicines.php"> Meds </a>

<a class="navbar-link block flex-shrink-0 text-md font-medium uppercase text-grey-600/50 hover:text-white md:px-3 xl:px-5 xl:text-center navDoc" href="specialists.php"> Doctors </a>

<a class="navbar-link block flex-shrink-0 text-md font-medium uppercase text-grey-600/50 hover:text-white md:px-3 xl:px-5 xl:text-center navForum" href="forum.php"> Forum </a>

<a class="navbar-link block flex-shrink-0 text-md font-medium uppercase text-grey-600/50 hover:text-white md:px-3 xl:px-5 xl:text-center navBlog  " href="blog.php"> Blog </a>
</div>


<div class="relative xl:w-1/4">

<?php if(!isset($_SESSION["user_login"])){?>
<ul class="flex justify-end space-x-2 lg:space-x-3 leading-none">
        
<li class="flex-none show-sidebar openSearch" data-tab="searchTab">
<button class="btn btn-base btn-secondary leading-none has-icon rounded-lg w-[40px] h-[40px] px-0 bg-card-600 hover:bg-card-500 "title="Tip: press the 's' key to open this search window.">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<svg width="16" viewBox="0 0 15 15"><g fill="none" fill-rule="evenodd">
<path d="M-2-2h20v20H-2z"></path><path class="fill-current" d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z"></path></g></svg></span>
</button>
</li>

<li class="lg:hidden">
<div>
<button class="block leading-none">
<span class="hamburger-nav flex h-[40px] w-10 flex-col justify-center gap-1 rounded-lg bg-card-600 hover:bg-card-500 px-2 show-sidebar">
<span></span>
<span></span><span>
</span></span>
</button>
</div>
</li>

<li class="hidden flex-none self-center lg:inline-block">
<button class="btn btn-base btn-secondary flex-shrink-0 px-4" transparent="">
<a href="login.php" class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
Sign In </a>
</button></li>
<li class="hidden flex-none self-center lg:inline-block">
<button class="btn btn-base btn-primary flex-shrink-0 px-4 hidden lg:inline-block">
<a href="register.php" class="flex-center h-full flex-shrink-0 text-wrap leading-none"> 
Get Started<span class="hidden xl:inline">&nbsp;for Free</span></a>
</button></li>
</ul>

<?php }else{?>

<ul class="flex justify-end space-x-2 lg:space-x-3 leading-none">
        
<li class="flex-none show-sidebar openSearch" data-tab="searchTab">
<button class="btn btn-base btn-secondary leading-none has-icon rounded-lg w-[40px] h-[40px] px-0 bg-card-600 hover:bg-card-500 "  title="Tip: press the 's' key to open this search window.">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<svg width="16" viewBox="0 0 15 15"><g fill="none" fill-rule="evenodd"><path d="M-2-2h20v20H-2z"></path><path class="fill-current" d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z"></path></g></svg></span></button>
</li>

<li class="flex-none hidden lg:inline-block show-sidebar openChat" data-tab="chatTab">
<button class="btn btn-base btn-secondary has-icon xl:w-[40px] px-0 rounded-lg bg-card-600 hover:bg-card-500"  aria-label="Chat Trix bot">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<img src="images/svgs/mic.svg" width="30px">
</span>
</button>
</li>

<li class="flex-none lg:hidden show-sidebar" data-tab="notiTab">
<button class="btn btn-base btn-secondary flex-center w-[40px] h-[40px] rounded-lg bg-card-600 hover:bg-card-500" >
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<img src="<?php echo $userimage;?>" class="rounded-lg" alt="<?php echo htmlspecialchars($row["username"]);?> avatar" width="30"></span>
</button>
</li>

<li class="hidden show-sidebar flex-none lg:block" data-tab="notiTab">
<div>
<a class="relative block leading-none">
<button class="flex-center h-[40px] w-[40px] rounded-lg bg-card-600 hover:bg-card-500 transition-colors duration-300">
<img src="<?php echo $userimage;?>" class="rounded-md" alt="<?php echo htmlspecialchars($row["username"]);?> avatar" width="30">
</button>
</a></div>
</li>

<li class="lg:hidden">
<div>
<button class="block leading-none show-sidebar" id="mobile-hamburger">
<span class="hamburger-nav flex h-[40px] w-10 flex-col justify-center gap-1 rounded-lg bg-card-600 hover:bg-card-500 px-2"><span>
</span><span>
</span><span></span>
</span>
</button>
</div>
</li>

</ul>
<?php }?>

</div>

</div>
</nav>
</div>
</div>













<!-- Jquery -->
<script src="assets/js/jquery-3.7.js"></script>




<!-- Switch Active Link -->
<?php

    $url = basename($_SERVER["PHP_SELF"]);

    switch($url){
    case "index.php":
    echo "<script>
            $('.navbar-link ').removeClass('is-active text-white');
            $('.navHome').addClass('is-active text-white');
          </script>";
    break;

    case "about.php":
    echo "<script>
            $('.navbar-link ').removeClass('is-active text-white');
            $('.navAbout').addClass('is-active text-white');
         </script>";
    break;
    
    case "medicines.php":
    echo "<script>
            $('.navbar-link ').removeClass('is-active text-white');
            $('.navMed').addClass('is-active text-white');
         </script>";
    break;
    
    case "specialists.php":
    echo "<script>
            $('.navbar-link ').removeClass('is-active text-white');
            $('.navDoc').addClass('is-active text-white');
         </script>";
    break;
    
    case "forum.php":
    echo "<script>
            $('.navbar-link ').removeClass('is-active text-white');
            $('.navForum').addClass('is-active text-white');
         </script>";
    break;
    
    case "blog.php":
    echo "<script>
            $('.navbar-link ').removeClass('is-active text-white');
            $('.navBlog').addClass('is-active text-white');
         </script>";
    break;

    case "profile.php":
    echo "<script>
            $('.navbar-link ').removeClass('is-active text-white');
            $('.navDoc').addClass('is-active text-white');
         </script>";
    break;


    }
?>