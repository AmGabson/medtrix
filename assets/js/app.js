
//Subscription Tabs
$(".monthly").click("click", function () {
    //For monthly, swap class
    $(this).removeClass("bg-blue/5");
    $(this).removeClass("text-grey-600/30");
    $(this).addClass("bg-blue/15");
    $(this).addClass("active");

    //get the id of th container housing both btn
    let containerId = $(this).parent().attr("id");

    //now using the id of the container, point to the yearly btn and disable
    $("#" + containerId + " .yearly").addClass("bg-blue/5");
    $("#" + containerId + " .yearly").addClass("text-grey-600/30");
    $("#" + containerId + " .yearly").removeClass("bg-blue/15");
    $("#" + containerId + " .yearly").removeClass("active");

    // Get price from the clicked Btn
    let price = $(this).attr("data-monthly");
    let newPrice = parseInt(price).toLocaleString();

    //  Swap Price to monthly
    $("." + containerId + " .dprice").html("&#8358; " + newPrice);
    $("." + containerId + " .mprice").addClass("display-none");

});


$(".yearly").click("click", function () {
    //For Yearly, swap class
    $(this).removeClass("bg-blue/5");
    $(this).removeClass("text-grey-600/30");
    $(this).addClass("bg-blue/15");
    $(this).addClass("active");

    //get the id of th container housing both btn
    let containerId = $(this).parent().attr("id");

    //now using the id of the container, point to the monthyl btn and disable
    $("#" + containerId + " .monthly").addClass("bg-blue/5");
    $("#" + containerId + " .monthly").addClass("text-grey-600/30");
    $("#" + containerId + " .monthly").removeClass("bg-blue/15");
    $("#" + containerId + " .monthly").removeClass("active");

    // Get price from the clicked Btn
    let price = $(this).attr("data-yearly");
    let newPrice = parseInt(price).toLocaleString();

    //  Swap Price to Yearly
    $("." + containerId + " .dprice").html("&#8358; " + newPrice);
    //show striken discount
    $("." + containerId + " .mprice").removeClass("display-none");

});





// Scroll users list - Home
// let forwardInterval;
// let userScroll = document.getElementById("userScroll");
// let scroller = 1;

// function startScroll() {
//     forwardInterval = setInterval(() => {
//         userScroll.scrollLeft += scroller;
//         if (userScroll.scrollLeft >= userScroll.scrollWidth - userScroll.clientWidth) {
//             clearInterval(forwardInterval);
//         }
//     }, 30);

// }
// startScroll()

// // on mouse on, stop scroll
// userScroll.addEventListener("mouseover", ()=>{
//     clearInterval(forwardInterval);
// });

// // on mouse out, stop scroll
// userScroll.addEventListener("mouseleave", ()=>{
//     startScroll();
// });





// Control Backdrops and Dialog
// Connect Wallet Modal
$(".connectModal").click(function(){
    $("#connect-wallet-modal").attr("open","open");
    $(".backdrop").removeClass("display-none");
    $("#solana-dialog").removeAttr("open");
});

//Close pop Dialog
$(".dialog-close").click(function(){
    $(this).parents().removeAttr("open");
    $(".backdrop").addClass("display-none");
});









// Load Med categories on page load
$(document).ready(function(){
    let category = "all";
    $.ajax({
        url: "fetch/fetchMedCategory.php",
        type: "POST",
        data: {category:category},
        beforeSend:function(){},
        success:function(data){
            $(".loadList").html(data);
            // console.log(data);
        }
    });

// Get Category Id when a category is clicked and fetch category from ajax page
$(".switchCat").click(function(){
    
  $(".switchCat").removeClass("is-active");
  $(".switchCat").addClass("md:text-card-300");

  $(this).addClass("is-active");
  $(this).removeClass("md:text-card-300");

    let category = $(this).data("category");
    $.ajax({
        url: "fetch/fetchMedCategory.php",
        type: "POST",
        data: {category:category},
        beforeSend:function(){
          NProgress.start();
        },
        success:function(data){
            NProgress.done();

            $(".loadList").html(data);
            // console.log(data);
        }
    });
});

});











//OPEN small solana home dialogue
$('.sol-container').click(function() {
 $("#solana-dialog").attr("open", "open")
 $(".backdrop").removeClass("display-none");
});












// Load Doctors categories on page load
$(document).ready(function(){
  let category = "all";
  $.ajax({
      url: "fetch/fetchDocCategory.php",
      type: "POST",
      data: {category:category},
      beforeSend:function(){},
      success:function(data){
          $(".placeDoctorsHere").html(data);
          // console.log(data);
      }
  });

// Get Category Id when a category is clicked and fetch category from ajax page
$(".selectCat").click(function(){
let category = $(this).data("category");

  //add Cat Id to pagination 
  $("#catId").val(category);

$(".sel").removeClass("bg-blue-400");
$(".sel").addClass("bg-card-600");

$(".sel"+category).addClass("bg-blue-400");
$(".sel"+category).removeClass("bg-card-600");

$(".selectCat").addClass("text-white");
$(".selectCat").removeClass("bg-card-700");
$(this).removeClass("text-white");
$(this).addClass("text-blue-400");
$(this).addClass("bg-card-700");
  
  $.ajax({
      url: "fetch/fetchDocCategory.php",
      type: "POST",
      data: {category:category},
      beforeSend:function(){
        NProgress.start();
      },
      success:function(data){
          NProgress.done();
          $(".placeDoctorsHere").html(data);
          // console.log(data);


          // Scroll to div
          $('html, body').animate({
            scrollTop: $("#forum-main").offset().top
        }, 500);


      }
  });
});

});







//Doctors Pagination

//if next or previous btn was cliked
$("#next, #previous").click(function(){

  let pageNumber = $("#page").val();
  let catId =  $("#catId").val();
  let action = this.id;
 
  $.ajax({
      url: 'fetch/docPagination.php',
      type: 'POST',
      data: {pageNumber:pageNumber, action:action, catId:catId},
      beforeSend: function(){
        NProgress.start();
      },
      success: function(data){

          $(".placeDoctorsHere").html(data);
          // console.log(data);

          NProgress.done();

          // Scroll to div
          $('html, body').animate({
            scrollTop: $("#forum-main").offset().top
        }, 500);

      }

  });

});
  


















// Control Sickness Drop downs
$(".toggleDrop").click(function(){

    let id = $(this).data("id");
    // Drop Items
    $(".sicknessList"+id).toggleClass("display-none");

    //Hide open chevron and show close chevron
    $(".opened"+id).toggleClass("display-none");
    $(".closed"+id).toggleClass("display-none");

});

// Control Sickness Drop downs
$(".toggleDropAll").click(function(){

    // Drop Items
    $("#allSickness").toggleClass("display-none");

    //Hide open chevron and show close chevron
    $(".openAll").toggleClass("display-none");
    $(".closeAll").toggleClass("display-none");

});
















  // Connect Solana Wallet API - BAL
  $("#connectWallet").click(()=>{
    
    //incase user is coming from dashboard, pass in GET to redirect correctly when  done

    if(typeof getVal !== 'undefined'){
        var fromDashboard  = getVal;
    }else{
      var fromDashboard  = "";
    }

    let walletAddress = $("#walletAddress").val().trim();

        if(walletAddress == ""){
          $(".no-address").removeClass("display-none");
        }else{
          $(".no-address").addClass("display-none");

          $.ajax({
            url: "solanaAPI/balanceRequest.php",
            type: "POST",
            data: {walletAddress:walletAddress, fromDashboard:fromDashboard},
            beforeSend:()=>{
              $("#connectWallet").addClass("pointer-events-none is-loading");
              $("#connectWallet").attr("disabled", true);
            },
            success:(data)=>{
              $("#connectWallet").removeClass("pointer-events-none is-loading");
              $("#connectWallet").attr("disabled", false);

              $("#result").html(data);
            }
          });
        }
  });







   // Create Solana Wallet API
   $("#processCreateWallet").click(()=>{
      $(this).addClass("display-none");
      $(".hideW").addClass("display-none");
      $(".createWallet").removeClass("display-none");
      // hide prev error
      $(".waError, .no-address").addClass("display-none");
      $(".successText").html("Safety Precautions").css({"color":"rgb(89 223 255)"});
   });
   


   $("#createWallet").click(()=>{
    let createWallet = "createWallet";

        //incase user is coming from dashboard, pass in GET to redirect correctly when  done
       
    if(typeof getVal !== 'undefined'){
        var fromDashboard  = getVal;
    }else{
      var fromDashboard  = "";
    }

        // Hide precautions
        $(".walletTabs").fadeOut();
  
          $.ajax({
            url: "solanaAPI/createAccount.php",
            type: "POST",
            data: {createWallet:createWallet, fromDashboard:fromDashboard},
            beforeSend:()=>{
              $("#createWallet").addClass("pointer-events-none is-loading");
              $("#createWallet").attr("disabled", true);
            },
            success:(data)=>{
              $("#createWallet").removeClass("pointer-events-none is-loading");
              $("#createWallet").attr("disabled", false);

              $("#result").html(data);
            }
          });
  });





    // Cancel Create Wallet action
    $(".cancelCreate").click(()=>{
      $(this).addClass("display-none");
      $(".hideW").removeClass("display-none");
      $(".createWallet").addClass("display-none");
      // hide prev error
      $(".waError, .no-address").addClass("display-none");
      $(".successText").html("Create | Connect Wallet").css({"color":"#fff"});
   });
   


    // Continue after user copied phrase
    $(".continueAfterPhrase").click(()=>{
      
      let address = $("#address").val();
      let privateKey = $("#privateKey").val();

      $.ajax({
        url: "solanaAPI/createAccount.php",
        type: "POST",
        data: {address:address,privateKey:privateKey},
        beforeSend:()=>{
          $(".continueAfterPhrase").addClass("pointer-events-none is-loading");
          $(".continueAfterPhrase").attr("disabled", true);
        },
        success:(data)=>{
          $(".continueAfterPhrase").removeClass("pointer-events-none is-loading");
          $(".continueAfterPhrase").attr("disabled", false);

          $("#result").html(data);
        }
      });

   });
   






   $(".leadScroll").click(function() {
    const tabIndex = parseInt($("#tabIndex").val());
    const indicators = $(".stage-indicator div");
    const buttons = $(".stage-indicator button");
  
    // Reset indicators
    indicators.removeClass("bg-blue").addClass("bg-card-400");
    buttons.addClass("text-card-200");
  
    // Update active tab
    switch (tabIndex) {
      case 2:
        $("#index2").addClass("bg-blue").removeClass("bg-card-400");
        $(".index2-text").removeClass("text-card-200");
        // Twig content
        $(".walletTabs h4").html("Write it down!");
        $(".walletTabs p").html("It's highly recommended to write down your recovery phrase and store it in a safe place so you don't risk losing your funds.");
        $(".tabIcon").html('<em class="icon ni ni-cc-alt2"></em>');
        break;
      case 3:
        $("#index3").addClass("bg-blue").removeClass("bg-card-400");
        $(".index3-text").removeClass("text-card-200");
        // Twig content
        $(".walletTabs h4").html("Never share your recovery phrase with anyone!");
        $(".walletTabs p").html("Anyone who has it can access your funds anywhere. Keep it secure.");
        $(".tabIcon").html('<em class="icon ni ni-cc-secure"></em>');
        break;
      default:
        // Twig content
        $(".walletTabs h4").html("Continue");
        $(".walletTabs p").html("Proceed to create Solana wallet");
        $(".tabIcon").html('<em class="icon ni ni-wallet-out"></em>');
        // Show Create wallet Btn
        $("#createWallet").removeClass("display-none").css({"min-width":"200px"});
        $(".leadScroll").addClass("display-none");
        $(".walletStages").addClass("display-none");
        $(".successText").html("Create Wallet");
        $(".cancelCreate").addClass("display-none");
    }
  
    // Increment tab index
    $("#tabIndex").val(tabIndex + 1);
  });
  
  














  // SIDEBAR
$(".show-sidebar").click(function(){

// Navigate to a specific tab on sidebar depending on the clicked button 
  // Get the data-tab value of the clicked button
  let tabToShow = $(this).data('tab');

  // Find the tab that matches the data-tab value and trigger a click on it
  $('.strip-indicator').each(function() {
      if ($(this).data('tab') === tabToShow) {
          $(this).trigger('click');
      }
  });



  //  slide the whole container (SHOW SIDEBAR)
    setTimeout(() => {
        $(".vfm--inset[data-v-2836fdb5]").css({ "left": "0px" });
    }, 0);

    //After some milesec, slide the container contents
    setTimeout(() => {
        $(".slide-menu").css({ "margin-right": "0px" });
           // Hide Browser scroll bar
          $("body").css({"overflow":"hidden"});
    }, 150);
});





// Close SIDEBAR menu
$(".closeMenu").click(function(){
    
    //  slide the whole container
    setTimeout(() => {
        $(".vfm--inset[data-v-2836fdb5]").css({ "left": "4000" });
    }, 150);

    //After some milesec, slide the container contents
    setTimeout(() => {
        $(".slide-menu").css({ "margin-right": "-20000px" });
    }, 20);
    
    setTimeout(() => {
        // restore Browser scroll bar
          $("body").css({"overflow":"visible"});
    }, 500);

});







//KEYBORD CLICK EVENT FOR CHAT AND SERACH BAR
$(document).keydown(function(event) {
  // Check if the pressed key is "?" (Shift + / on most keyboards)
  if (event.shiftKey && event.which === 191) {
      // Trigger the click event on the button
      $('.openChat').trigger("click");
  }
});


$(document).keydown(function(event) {
  // Check if the pressed the key "s" 
  if (event.which === 83) {
      // Trigger the click event on the button
      $('.openSearch').trigger("click");
  }
});






  $(".strip-indicator").click(function() {
    const tab = $(this).data("tab");
    const strip = $(this).find("div");
    const textBtn = $(this).children("button");

    // Reset indicators
    $(".strip-indicator div").removeClass("bg-blue").addClass("bg-card-400");
    $(".strip-indicator button").addClass("text-card-200");
  
    // Update active tab
    strip.removeClass("bg-card-400").addClass("bg-blue");
    textBtn.removeClass("text-card-200");

    //hide preceeding Tabs
    $(".notiTab, .searchTab, .chatTab").addClass("display-none");

    //show current tab
    $("."+tab).removeClass("display-none");
  });
  