<link rel="stylesheet" href="assets/css/FlashDialog-B92EWtKV.css">


<div id="result"></div>
<dialog id="connect-wallet-modal" class="overflow-auto hide-scrollbar bg-card-800 py-6 text-white md:my-auto md:rounded-2xl md:border border-card-300  md:py-9 md:shadow-lg" style="width: 100%; --0e351c3d: 600px; --b3ad0d3c: max-content; --7460586e: slideUp; max-height: calc(var(--vh, 1vh) * 100);
background-image: radial-gradient(ellipse closest-side, #181e2ae6, #181e2afc), url(images/solanaLogo.svg);
background-repeat: no-repeat;
background-size: cover;" <?php if(!isset($solana["balance"]) && isset($_GET["solana"]) && $_GET["solana"] =="request"){echo "open";}?>>


<!--Connect wallet Part 1 -->
<a <?php if(isset($_GET["solana"]) && $_GET["solana"] =="request"){echo "href='dashboard'";}?> class="dialog-close pin-0 absolute right-5 top-5 z-10 flex h-12 w-12 items-center justify-center rounded-xl bg-blue/10 text-white transition-colors duration-300 hover:bg-grey-500 hover:text-blue-400 focus-visible:outline-none focus-visible:ring md:right-[20px] md:top-[20px] md:h-10 md:w-10">
<svg width="14" viewBox="0 0 25 25" class="fill-current">
<path d="M22.222 0 25 2.778l-9.723 9.721L25 22.222 22.222 25 12.5 15.277 2.778 25 0 22.222 9.722 12.5 0 2.778 2.778 0 12.5 9.722 22.222 0z" class="fill-current" fill-rule="evenodd"></path>
</svg>
</a>
<section class="space-y-8" autocomplete="off" style="height: auto;">
<header class="px-8 text-center md:px-12">
<img src="images/solanaLogo.svg" width="50%" class="solImg" style="transition:1s;">
<h2 class="text-xl mt-2 font-semibold successText" style="transition:1s">Create | Connect Wallet</h2>
</header>


<div class="my-auto">
    <!-- Check -->
    <div class="animation-ctn display-none" style="width:300px; margin: auto;">
    <div class="icon icon--order-success svg mt-5">
    <svg xmlns="http://www.w3.org/2000/svg" width="77px" height="77px"> <!-- Reduced size -->
    <g fill="none" stroke="#22AE73" stroke-width="2">
    <circle cx="38.5" cy="38.5" r="35" style="stroke-dasharray:480px; stroke-dashoffset: 960px;"></circle>
    <circle id="colored" fill="#22AE73" cx="38.5" cy="38.5" r="35" style="stroke-dasharray:480px; stroke-dashoffset: 960px;"></circle>
    <polyline class="st0" stroke="#fff" stroke-width="5" points="22,39 32,49 56,25" style="stroke-dasharray:100px; stroke-dashoffset: 200px;"/>
    </g>
    </svg>
    </div>

    <div class="topic-card flex flex-1 justify-center text-center mt-5">
    <button class="btn btn-base btn-secondary has-icon">
    <span class="flex-center text-xs flex-shrink-0 text-wrap solBal"></span>
    </button>
    </div>

    <!-- Copy Wallet -->
    <div class="flex-center flex-col walletInput display-none mt-2">
    <div class="mx-auto flex w-full max-w-full flex-1 flex-col gap-y-2 rounded-xl md:flex-row md:bg-card-400 md:p-1 lg:mx-0">
    <input class="rounded-lg bg-transparent bg-white px-4 py-3 text-base text-black placeholder-grey-800 md:mr-1 md:flex-1 md:rounded-xl md:bg-transparent md:py-0 md:text-white" type="text" id="address" readonly>
    <button class="btn btn-base btn-primary w-full max-w-none rounded-lg copyBtnWitdh text-base">
    <span id="cpyAddr" class="flex-center text-xs h-full flex-shrink-0 text-wrap"> Copy </span>
    </button></div>
    </div>

    <a class="dialog-close btn btn-base btn-primary focus:ring focus:ring-2 mx-auto mt-10">
    <span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
    Continue to Site </span>
    </a>
    </div>




<!-- Error -->
<div class="hideW dialog-footer px-8 md:px-12 flex flex-wrap justify-start">
<div class="waError flex gap-3 bg-card-600 p-1 text-card-200 rounded md:border border-card-500 display-none" style="margin:20px auto 15px auto;">
<div class="flex-2 mt-1"><em class="text-lg ni ni-info"></em></div>
<div class="error-text"></div>
</div>

<div class="control w-full">
<input id="walletAddress" type="text" class="input is-minimal text-sm text-white" placeholder="Enter wallet address" style="padding:25px">
<p class="help mt-2 text-xs text-red no-address display-none">Enter wallet address</p>
</div>
</div>


<footer class="hideW dialog-footer px-8 md:px-12 flex flex-wrap justify-start gap-4 mt-3">
<button id="connectWallet" class="btn btn-base btn-primary focus:ring focus:ring-2 w-full mx-auto">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">
<em class="text-lg ni ni-link"></em> &nbsp; Connect Wallet</span>
</button>
<button class="text-sm w-full -mb-2 mt-5 font-medium text-grey-600/60 position-absolute">Don't have wallet?</button>

<button id="processCreateWallet" class="btn btn-base btn-secondary focus:ring focus:ring-2 w-full mx-auto">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Create Solana Wallet </span>
</button>
<!-- <div class="mt-5 flex flex-1 justify-center">
<button class="block text-sm text-grey-600 hover:underline"> Forgot Your Password? </button>
<button class="block text-sm text-grey-600 hover:underline"> Sign Up! </button>
</div> -->
</footer>
<img src="images/logo.png" class="hideW" style="width:100;margin:auto;display:block;margin-top:40px">
</div>
<!--/Connect wallet Part 1 -->






<!--Create wallet Part 2 -->
<div class="my-auto createWallet display-none">
<div class="dialog-footer px-8 py-1 md:px-12 flex flex-wrap justify-start gap-4">
<div class="waError flex gap-3 bg-card-600 p-1 text-card-200 rounded md:border border-card-500 display-none" style="margin:20px auto 2px auto;">
<div class="flex-2 mt-1"><em class="text-lg ni ni-info"></em></div>
<div class="error-text"></div>
</div>
<p class="help text-xs w-full text-red no-address display-none"></p>


<!-- Steps -->
<header class="walletStages flex justify-between text-white w-full">
<div class="flex-1 text-center stage-indicator">
<div class="mb-2 h-1 w-full rounded-l bg-blue" id="index1"></div>
<button class="font-grotesk font-medium hover:text-white text-xs index1-text">Mnemonics</button>
</div>
<div class="flex-1 text-center stage-indicator">
<div class="mb-2 h-1 w-full bg-card-400" id="index2"></div>
<button class="font-grotesk font-medium hover:text-white text-card-200 text-xs index2-text">Note</button>
</div>
<div class="flex-1 text-center stage-indicator">
<div class="mb-2 h-1 w-full rounded-r bg-card-400" id="index3"></div>
<button class="font-grotesk font-medium hover:text-white text-card-200 text-xs index3-text">Protection</button>
</div>
</header>

<style>
.tabIcon{
    font-size: 35px;
    border-radius: 50%;
    background: #182132;
    width: 70px;
    height: 70px;
    display: flex;
    place-content: center;
    color: #809ec0;
    padding: 15px;
    border: 4px solid #1e293f;
    margin: auto;
}

.walletTabs{
    background-image: radial-gradient(ellipse closest-side, #1f2b4066, #131927c7);
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 10px;
    transition: 0.3s;
    text-align: center;
}
</style>

<!-- Tab 1 -->
<div class="tabContent w-full">
<div class="walletTabs p-5">
<div class="tabIcon mb-4"><em class="icon ni ni-cc-new"></em></div>
<h4 class="font-bold text-lg mt-2">
Your recovery phrase is your backup key for your  wallet.
</h4>
<p class="text-xs text-card-200 mt-2">
You'll be able  to login into your wallet with a  passcode, but you will need your recovery phrase to access it.
</p>
</div>
</div> 


<div class="flex flex-wrap justify-center gap-x-3 w-full">
<!-- Back to connect wallet -->
<button class="cancelCreate leading-4 flex h-8 items-center justify-center rounded-xl border border-transparent p-4 text-2xs font-semibold bg-card-600 hover:bg-card-400" style="min-width: 100px;">
<em class="ni ni-chevron-left"></em> &nbsp; Connect Wallet
</button>

<!-- next -->
<input type="hidden" id="tabIndex" value="2">
<button class="leadScroll flex h-8 items-center justify-center rounded-xl border border-transparent p-4 text-2xs font-semibold bg-card-600 hover:bg-card-400 hover:border-blue focus:border-blue focus:text-blue" style="min-width: 100px;">Next &nbsp; <em class="ni ni-chevron-right"></em></button>

<button id="createWallet" class="display-none flex h-8 items-center justify-center rounded-xl border border-transparent p-4 text-2xs font-semibold btn btn-primary" style="min-width: 100px;">Create Wallet</button>
</div>

</div>
<img src="images/logo.png" style="width:100;margin:auto;display:block;margin-top:40px">
</div>
<!--/Create wallet Part 2 -->



<!-- Mnemonics Infos Part 3-->
<div class="my-auto mnemonics display-none">
<div class="mx-auto grid grid-flow-col gap-x-1 overflow-auto hide-scrollbar justify-center phrase" style="grid-template-rows: repeat(8, 1fr);grid-auto-columns: 110px;">
</div>
<div class="dialog-footer px-8 py-1 md:px-12 flex flex-wrap justify-start gap-4">
<button id="copyButton" class="btn btn-base btn-secondary focus:ring focus:ring-2 w-full mx-auto mt-2">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Copy </span>
</button>

<button class="continueAfterPhrase btn btn-base btn-primary focus:ring focus:ring-2 w-full mx-auto">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none"> Continue &nbsp; <em class="ni ni-chevron-right"></em></span>
</button>
</div>

<!-- returned vals -->
<input type="hidden" id="keyPhrase" class="text-black">
<input type="hidden" id="privateKey" class="text-black">
<img src="images/logo.png" style="width:100;margin:auto;display:block;margin-top:40px">
</div>
<!--/ Mnemonics Infos -->


</section>
</dialog>







<!-- Flash -->
<dialog id="solana-dialog" class="overflow-auto hide-scrollbar bg-card-800 py-6 text-white md:my-auto md:rounded-2xl md:border border-card-300 md:py-9 md:shadow-lg rounded-2xl m-auto" style="width: 300px; height: max-content; align-content: center; --0e351c3d: 800px; --b3ad0d3c: max-content; --7460586e: bounce; max-height: calc(var(--vh, 1vh) * 100);">

<div class="my-auto">
<div class="dialog-main px-8 py-1 text-center">

<div class="solDetails">
<img src="images/solanaLogo.svg">

<?php if($exists > 0){?>
<div class="text-center mt-5 mb-3 text-grey-600 font-bold"> Account Overview </div>
<div class="hover:text-blue-400 rounded px-2 p-2 flex-center flex-shrink-0 text-grey-600 text-xs" style="background:#202736;">
<span class="flex-shrink-0 text-grey-600 text-sm">
<?php echo htmlspecialchars(substr($solona["walletAddress"],0,8).".....".substr($solona["walletAddress"],-8));?> 
</span>
</div>
<figcaption class="panel rounded px-2 flex items-center justify-between w-full py-2 mt-2" style="background:#202736">
<span class="flex-shrink-0 text-grey-600 text-sm">SOL Balance</span>
<span class="text-xs font-bold text-white text-right"><?php echo htmlspecialchars($solona["balance"]);?>  SOL</span>
</figcaption>

<div class="mt-4">
<button class="btn text-xs btn-base btn-secondary has-icon w-full mb-1 px-3">
<span class="flex-center flex-shrink-0 text-wrap">Refresh</span>
</button>

<a class="btn text-xs btn-base btn-primary has-icon w-full px-3">
<span class="flex-center flex-shrink-0 text-wrap">Transactions &nbsp; <em class="ni ni-chevron-right"></em></span>
</a>
</div>


<?php }else{?>
<div class="mt-5 text-center mb-2 text-grey-600 font-bold text-xs"> Wallet not connected</div>
<button class="connectModal btn btn-base btn-primary mb-8 pt-2 pb-2 w-full">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">Connect Wallet
&nbsp; <em class="ni ni-chevron-right"></em>
</span>
</button>

<?php }?>
</div>

<div class="mt-5 space-y-2">
<button class="btn btn-base btn-secondary focus:ring focus:ring-2  w-full mx-auto" value="Cancel">
<span class="dialog-close flex-center h-full flex-shrink-0 text-wrap leading-none">Cancel</span></button>
</div>
</div>


</div>
</dialog>












<!-- Notice Modal Flash -->
<!-- <dialog id="flash-dialog" class="overflow-auto hide-scrollbar bg-card-800 py-6 text-white md:my-auto md:rounded-2xl md:border md:border-grey-600/10 md:py-9 md:shadow-lg rounded-2xl m-auto" data-js="flash-dialog" data-v-owner="330" style="width: 300px; height: max-content; align-content: center; --0e351c3d: 800px; --b3ad0d3c: max-content; --7460586e: bounce; max-height: calc(var(--vh, 1vh) * 100);">
<div class="my-auto">
<form method="dialog">
<div class="dialog-main px-8 py-1 text-center">
<img loading="lazy" class="lazy" src="/images/icons/flash/info.svg" alt="" width="96" height="96">
<h1 class="mt-2 text-xl font-semibold"></h1>
<p id="flash-dialog-message" class="mt-3 text-sm"></p>
<div class="mt-5 space-y-2"><button class="btn btn-base btn-secondary focus:ring focus:ring-2  w-full mx-auto" value="Cancel">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">Cancel</span></button>
<button class="btn btn-base btn-primary focus:ring focus:ring-2  w-full mx-auto" value="OK">
<span class="flex-center h-full flex-shrink-0 text-wrap leading-none">OK</span>
</button></div>
</div>
</form>
</div>

</dialog> -->




<script src="assets/js/clipboard.js"></script>
<script>

var clipboard = new ClipboardJS('#copyButton');
// Copy Mnemonics
document.getElementById("copyButton").addEventListener("click", function() {
    var copyText = document.getElementById("keyPhrase").value;
    var textarea = document.createElement("textarea");
    textarea.value = copyText;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand("copy");
    document.body.removeChild(textarea);
    this.innerHTML = 'Copied &nbsp;<em class="icon ni ni-check-thick"></em>';
});

// Copy address
document.getElementById("cpyAddr").addEventListener("click", function() {
    var copyText = document.getElementById("address").value;
    var textarea = document.createElement("textarea");
    textarea.value = copyText;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand("copy");
    document.body.removeChild(textarea);
    this.innerHTML = 'Copied';
});
</script>



    
<!-- //incase user is coming from dashboard, pass in GET to JS to redirect correctly when done-->
<?php if(isset($_GET["solana"]) && $_GET["solana"] =="request"){?>
<script>
var getVal = "?wallet=connected";
</script>
<?php }?>