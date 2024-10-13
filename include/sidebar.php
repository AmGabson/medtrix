<style>
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
left: 4000;
}

.closeBTN{
    border-radius: 0;
    position: absolute;
    bottom: 80;
    height: 35;
    width: 50%;
    background: rgb(28 86 172);
    /* border-top: 1px solid #131c2a; */
    right: 7;
    border-bottom-right-radius: 50px;
    border-bottom-left-radius: 50px;
}

.closeBTN:hover{
    background: #14315c!important;
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


<?php 
//get Token and account Bal
$stmt=$pdo->prepare("SELECT * FROM account WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$acc=$stmt->fetch();
?>


<div data-v-2836fdb5="" class="vfm vfm--inset vfm--fixed" style="z-index: 1000;">
<div data-v-2836fdb5="" class="vfm__overlay vfm--overlay closeMenu vfm--absolute vfm--inset"></div>

<div data-v-2836fdb5="" class="vfm__container vfm--absolute vfm--inset vfm--outline-none flex justify-end" style="max-width: 625px;justify-self:flex-end">
<div data-v-2836fdb5="" class="vfm__content account-slideout-menu rounded-none bg-[#0d131d] flex flex-col px-6 py-4 max-w-full mb-20 md:mb-0">
    
<header class="flex justify-between text-white">
<div class="flex-1 text-center strip-indicator" data-tab="searchTab">
<div class="mb-2 h-1 w-full rounded-l bg-card-400 searchStrip"></div>
<button  class="font-grotesk font-medium hover:text-white text-card-200 searchBTN">
<span class="hidden md:inline"><em class="ni ni-search"></em></span> Search </button>
</div>

<div class="flex-1 text-center strip-indicator" data-tab="chatTab">
<div class="mb-2 h-1 w-full bg-card-400 chatStrip"></div>
<button class="font-grotesk font-medium hover:text-white text-card-200 chatBTN">
<span class="hidden md:inline"><em class="ni ni-msg-circle"></em></span> Chat Trix </button>
</div>

<?php if(!empty($userid)){?>
<div class="flex-1 text-center strip-indicator" data-tab="notiTab">
<div class="mb-2 h-1 w-full rounded-r bg-blue notiStrip"></div>
<button class="font-grotesk font-medium hover:text-white notiBTN">
<span class="hidden md:inline"><em class="ni ni-notify"></em></span> Notifications </button>
</div>
<?php }else{ ?>

<div class="flex-1 text-center strip-indicator" data-tab="notiTab">
<div class="mb-2 h-1 w-full rounded-r bg-blue"></div>
<button class="font-grotesk font-medium hover:text-white">
<span class="hidden md:inline"><em class="ni ni-user"></em></span> Account </button>
</div>

<?php }?>
</header>


<div data-v-2836fdb5-s="" class="pt-6 text-white notiTab">
<div class="flex items-start">
<div class="flex-shrink-0 md:block overflow-hidden">
<header class="mb-6 pt-8">
<div class="flex items-center">
<a class="inline-flex flex-shrink-0" href="">
<img src="<?php if(!empty($userid)){echo $userimage;}else{echo 'images/113.webp';}?>" alt="<?php if(!empty($userid)){echo $row["username"]." Avatar";}else{echo 'Avatar';}?>" width="60" height="60" style="border-radius: 9px;"></a>
<div class="ml-5">

<?php if(!empty($userid)){?>
<h5 class="text-[14px] capitalize font-medium"><?php echo htmlspecialchars($row["username"]);?></h5>
<a class="inline-flex text-2xs font-medium text-blue-400"><span>Open <span class="text-white">Profile</span></span></a>
<?php }else{?>
<h5 class="text-[14px] capitalize font-medium">Create | Login</h5>
<a href="login.php?login=request" class="inline-flex text-2xs font-medium text-blue-400"><span>Medtrix <span class="text-white">Account</span></span></a>
 <?php }?>

</div>
</div>
</header>
<nav class="mt-10">
<ul class="-ml-8 flex h-full flex-col space-y-7">
<li class="account-slideout-link relative font-medium"><a class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400 text-red" href="index.php">Home <div class="text-2xs text-card-300 group-hover:text-blue-400">// Welcome to Medtrix</div></a></li>

<li class="account-slideout-link relative font-medium">

<?php if(empty($userid)){?>
<a class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400" href="login.php?login=request">
<img src="images/solanaLogo.svg" width="120px">
<div class="text-2xs text-card-300 group-hover:text-blue-400 mt-1">
// Login to view balance</div>
</a>
<?php }else{?>

<a class="sol-container group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400" href="javascript:void(0)">
<img src="images/solanaLogo.svg" width="120px">
<div class="text-2xs text-card-300 group-hover:text-blue-400 mt-2 sideBal">
<?php if(isset($solona["balance"])){echo "SOL Balance: ". htmlspecialchars($solona["balance"]);}else{echo "Connect Solana Wallet &nbsp;<em class='ni ni-wallet-out'></em>";}?>
</div>
</a>

<?php }?>
</li>

<li class="account-slideout-link relative font-medium">
<a class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400" href="#">What's New <div class="text-2xs text-card-300 group-hover:text-blue-400">// latest</div></a></li>
<li class="account-slideout-link relative font-medium">
<a class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400" href="specialist.php">Specialist <div class="text-2xs text-card-300 group-hover:text-blue-400">// get in touch</div></a>
</li>
<li class="account-slideout-link relative font-medium"><a class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400" href="">Social Feed <div class="text-2xs text-card-300 group-hover:text-blue-400">// talk with people like you</div></a></li>
<li class="account-slideout-link relative font-medium"><a class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400" href="medicines.php">Medicines <div class="text-2xs text-card-300 group-hover:text-blue-400">// is that drug scarce?</div></a></li>
<li class="account-slideout-link relative font-medium">
<a class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400" href="dashboard/profile.php">Profile <div class="text-2xs text-card-300 group-hover:text-blue-400">// manage your account</div></a></li>
<li class="account-slideout-link relative font-medium">
<a class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400" href="dashboard/consultation.php">Consultation <div class="text-2xs text-card-300 group-hover:text-blue-400">// speak to a specialist</div></a></li>

<li class="account-slideout-link relative font-medium">

<?php if(empty($userid)){?>   
<a href="login.php?login=request" class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400">
Login
<div class="text-2xs text-card-300 group-hover:text-blue-400">// lets do this!</div></a>
<?php }else{?>
<a href="logout.php" class="group ml-8 block text-left font-grotesk text-xl font-medium hover:text-blue-400">
Logout
<div class="text-2xs text-card-300 group-hover:text-blue-400">// so long champ</div></a>
<?php }?>
</li>
</ul>
</nav>
</div>


<div class="self-center ml-8 flex-1 overflow-y-auto hide-scrollbar" style="width:px; max-height: calc(-95px + 100vh);">
<header class="flex items-center justify-end text-white">
</header>
<div class="mt-4 h-full">
<div class="flex h-full flex-col items-center justify-center text-card-200 text-xs">
<canvas width="160"></canvas>
<p class="mt-4 text-center">You'll be notified here when you're mentioned or tagged in the forum </p>
</div>
</div>
</div>
</div>
</div> 









<!-- Chat Tab-->
<div data-v-2836fdb5-s="" id="account-menu-chat-wrapper" class="grid h-full grid-rows-6 overflow-auto overflow-hidden pt-8 text-white display-none chatTab">
<article id="account-menu-chat-messages" class="row-span-5 mb-8 space-y-4 overflow-y-auto" style="background: url(images/trix.png) center 60% / 70% no-repeat;">
<div class="gap-x-2 text-center flex-center h-full flex-col">
<div class="mb-auto flex items-start gap-x-2">
<div class="panel relative transition-colors duration-300 hoverable rounded-xl flex-1 px-5 py-3 text-left text-sm">
<div class="content mb-0 text-grey-600">
<strong>Mind-blowing tip</strong>: press the <code class="font-bold text-blue-400">?</code> key to quickly open this chat window from any page. Amazing, right? </div>
</div>
</div>
<p class="mx-auto mb-auto max-w-2/3 text-base text-grey-600"> Hi! I'm <strong class="text-white">TRIX</strong>, your personal medical assistant. Feel free to relieve your queries here but you'll need to have an <a class="link" href="/join"> active Medtrix subscribed account. </a></p>
</div>
</article>
<form class="relative row-span-2 flex opacity-50">
<div class="relative w-full">
<div class="pointer-events-none absolute flex flex-col items-center text-center left-4 top-4 w-[37px]"><span class="mt-2 text-3xs font-medium text-card-200">0/1200</span></div><textarea data-js="chat-textarea" placeholder="You must be subscribed to ask me questions." class="h-full w-full rounded-xl bg-card-800 p-4 text-xs text-white placeholder-card-300 focus:outline-none" required="" maxlength="1200" disabled="" style="padding-right: 130px; padding-left: 67px;"></textarea>
</div>
<div class="absolute right-4 top-4 flex gap-1"><button class="btn btn-base btn-secondary px-2 py-2 disabled:bg-blue/3 disabled:hover:bg-blue/3 disabled:hover:text-card-200" type="submit" title="Cmd + Return" data-js="chat-submit-button"><span class="flex-center h-full flex-shrink-0 text-wrap leading-none"><svg width="20" height="15" viewBox="0 0 22 17" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M9.966 4.391V3.318l8.028 4.724-8.028 4.724v-3.5h2.129a1.213 1.213 0 0 0 0-2.429H5.456a1.213 1.213 0 0 0 0 2.428h2.128v5.48c-.026.246.022.503.153.734l.01.016a1.188 1.188 0 0 0 1.626.423L20.95 9.106c.393-.232.61-.65.605-1.076a1.227 1.227 0 0 0-.605-1.052L9.462.218A1.184 1.184 0 0 0 8.244.125a1.184 1.184 0 0 0-.507.48c-.131.232-.179.488-.153.735V4.39a1.192 1.192 0 1 0 2.382 0zM1.212 9.265h.998a1.213 1.213 0 0 0 0-2.428h-.998a1.213 1.213 0 0 0 0 2.428z" fill="url(#lbd11yxlva)"></path>
<defs>
<linearGradient id="lbd11yxlva" x1="21.555" y1="8.041" x2="0" y2="8.041" gradientUnits="userSpaceOnUse">
<stop stop-color="#21C8F6"></stop>
<stop offset="1" stop-color="#637BFF"></stop>
</linearGradient>
</defs>
</svg></span></button></div>
</form>
</div>






<!-- Search Tab -->
<div data-v-2836fdb5-s="" class="display-none hide-scrollbar flex-1 overflow-auto rounded-2xl pt-6 shadow-inner searchTab" style="max-height: 90vh;">
<div class="container relative">
<div class="lg:mx-auto"><div id="autocomplete"><div class="aa-Autocomplete" role="combobox" aria-expanded="true" aria-haspopup="listbox" aria-labelledby="autocomplete-0-label" aria-owns="autocomplete-0-querySuggestionsPlugin-list autocomplete-0-lessons-list">

<form class="aa-Form" role="search">
<div class="aa-InputWrapperPrefix">
<label class="aa-Label" for="autocomplete-0-input" id="autocomplete-0-label">
<button class="aa-SubmitButton" type="submit" title="Submit">
<svg class="aa-SubmitIcon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
<path d="M16.041 15.856c-0.034 0.026-0.067 0.055-0.099 0.087s-0.060 0.064-0.087 0.099c-1.258 1.213-2.969 1.958-4.855 1.958-1.933 0-3.682-0.782-4.95-2.050s-2.050-3.017-2.050-4.95 0.782-3.682 2.050-4.95 3.017-2.050 4.95-2.050 3.682 0.782 4.95 2.050 2.050 3.017 2.050 4.95c0 1.886-0.745 3.597-1.959 4.856zM21.707 20.293l-3.675-3.675c1.231-1.54 1.968-3.493 1.968-5.618 0-2.485-1.008-4.736-2.636-6.364s-3.879-2.636-6.364-2.636-4.736 1.008-6.364 2.636-2.636 3.879-2.636 6.364 1.008 4.736 2.636 6.364 3.879 2.636 6.364 2.636c2.125 0 4.078-0.737 5.618-1.968l3.675 3.675c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414z"></path></svg>
</button></label>

<div class="aa-LoadingIndicator" hidden="">
<svg class="aa-LoadingIcon" viewBox="0 0 100 100" width="20" height="20">
<circle cx="50" cy="50" fill="none" r="35" stroke="currentColor" stroke-dasharray="164.93361431346415 56.97787143782138" stroke-width="6">
<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;90 50 50;180 50 50;360 50 50" keyTimes="0;0.40;0.65;1">
</animateTransform>
</circle></svg></div></div>

<div class="aa-InputWrapper">
<input class="aa-Input"  id="autocomplete-0-input" autocomplete="off" autocorrect="off" autocapitalize="off" enterkeyhint="search" spellcheck="false" autofocus="true" placeholder="Consultation Service" maxlength="512" type="search">
</div>

<div class="aa-InputWrapperSuffix">
<button class="aa-ClearButton" type="reset" title="Clear" hidden="">
<svg class="aa-ClearIcon" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M5.293 6.707l5.293 5.293-5.293 5.293c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l5.293-5.293 5.293 5.293c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414l-5.293-5.293 5.293-5.293c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-5.293 5.293-5.293-5.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path></svg>
</button>
</div>
</form>
</div>
</div>

<div id="aa-panel" class="mt-1">
<div class="aa-Panel" style="top: 128px; left: 528px; right: 24px; width: unset; max-width: unset;">
<div class="aa-PanelLayout aa-Panel--scrollable">
<section class="aa-Source" data-autocomplete-source-id="querySuggestionsPlugin">
<div class="aa-SourceHeader">
<h5 class="mb-2 text-base font-semibold text-white">Suggested Searches</h5>
</div>

<ul class="aa-List">
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">Specialists</a>
</li>
<li class="aa-Item">
<a href="medicine.php" class="px-4 py-2 text-xs font-medium text-grey-600">Medicines</a>
</li>
<li class="aa-Item">
<a href="medicine.php" class="px-4 py-2 text-xs font-medium text-grey-600">Subscription</a>
</li>
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">Forum</a>
</li>
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">Solana</a>
</li>
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">About</a>
</li>
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">Registration</a>
</li>
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">Account</a>
</li>
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">Funding</a>
</li>
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">Consultaion</a>
</li>
<li class="aa-Item">
<a href="specialists.php" class="px-4 py-2 text-xs font-medium text-grey-600">Chat</a>
</li>

</ul>

</section>
<section class="aa-Source" ><div class="aa-SourceHeader">
<h5 class="mb-2 text-base font-semibold text-white">Recommended Results</h5>
</div>

<ul class="aa-List" role="listbox" aria-labelledby="autocomplete-0-label" id="autocomplete-0-lessons-list">

<li class="aa-Item" id="autocomplete-0-lessons-item-10" role="option" aria-selected="false">
<div class="aa-ItemWrapper">
<div class="aa-ItemContent px-4 py-2">
<div class="aa-ItemIcon flex w-[40px]">
<img src="images/sol.png" width="40" height="40" class="inline-block">
</div>
<div class="aa-ItemContentBody aa-suggestion-body ml-2 flex-1">
<h4 class="clamp one-line text-sm font-medium text-white md:text-base">Connecting Solana Wallet</h4>
<p class="-mt-px text-3xs font-medium leading-normal text-card-200">Updated September 10, 2024</p>
</div></div>
</div>
</li>

<li class="aa-Item" id="autocomplete-0-lessons-item-10" role="option" aria-selected="false">
<div class="aa-ItemWrapper">
<div class="aa-ItemContent px-4 py-2">
<div class="aa-ItemIcon flex w-[40px]">
<img src="images/hospital2.png" width="40" height="40" class="inline-block">
</div>
<div class="aa-ItemContentBody aa-suggestion-body ml-2 flex-1">
<h4 class="clamp one-line text-sm font-medium text-white md:text-base">Nearby Hospitals</h4>
<p class="-mt-px text-3xs font-medium leading-normal text-card-200">Updated September 8, 2024</p>
</div></div>
</div>
</li>

<li class="aa-Item" id="autocomplete-0-lessons-item-10" role="option" aria-selected="false">
<div class="aa-ItemWrapper">
<div class="aa-ItemContent px-4 py-2">
<div class="aa-ItemIcon flex w-[40px]">
<img src="images/hel.png" width="40" height="40" class="inline-block">
</div>
<div class="aa-ItemContentBody aa-suggestion-body ml-2 flex-1">
<h4 class="clamp one-line text-sm font-medium text-white md:text-base">Doctors and Specialists</h4>
<p class="-mt-px text-3xs font-medium leading-normal text-card-200">Updated September 14, 2024</p>
</div></div>
</div>
</li>

<li class="aa-Item" id="autocomplete-0-lessons-item-10" role="option" aria-selected="false">
<div class="aa-ItemWrapper">
<div class="aa-ItemContent px-4 py-2">
<div class="aa-ItemIcon flex w-[40px]">
<img src="images/FABox.png" width="40" height="40" class="inline-block">
</div>
<div class="aa-ItemContentBody aa-suggestion-body ml-2 flex-1">
<h4 class="clamp one-line text-sm font-medium text-white md:text-base">Get Medical Equipments</h4>
<p class="-mt-px text-3xs font-medium leading-normal text-card-200">Updated September 13, 2024</p>
</div></div>
</div>
</li>

</ul>
</section>
</div>
<div class="aa-GradientBottom"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<button class="btn btn-base btn-secondary md:hidden closeMenu closeBTN">
Close menu &nbsp;  &nbsp; <em class="icon ni ni-menu-alt"></em>
</button>
</div>






