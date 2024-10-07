const cards = document.querySelectorAll(".card"),
timeTag = document.querySelector(".time b"),
flipsTag = document.querySelector(".flips b"),
refreshBtn = document.querySelector(".details button"),
scoreTime = document.querySelector(".sTime b"),
scoreFlips = document.querySelector(".sFlips b");

// current Stage Level
var level = "1";

function updateLevel(){
if(level == "2"){
    maxTime = 50;               //Allowed time
    numCards = 8;               //Number of cards
    //Cards and it's twin (stg 1)
    arr = [1, 2, 3, 4, 5, 6, 7, 8, 1, 2, 3, 4, 5, 6, 7, 8];  
    imageLocation = "stage2";

    //show cards two
    $(".card2").removeClass("display-none");
    
    //increase cards height
    $(".cards").css({"height":"400px"});
    $(".cards .card").css({"height":"calc(100% / 4 - 30px)"});

    // DB Prev Rercord (variable on game index page)
    dbFlip = recordFlip2;
    dbTime = recordTime2;

}

else if(level == "3"){
    maxTime = 65;               //Allowed time
    numCards = 10;               //Number of cards
    //Cards and it's twin (stg 1)
    arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];  
    imageLocation = "stage3";

       //show cards two
       $(".card3").removeClass("display-none");
    
       //increase cards height
       $(".cards").css({"height":"550px"});
       $(".cards .card").css({"height":"calc(100% / 4 - 60px)"});
    //    $(".details").css({"height":"calc(100% / 4 - 75px)"});

       
    // DB Prev Rercord (variable on game index page)
    dbFlip = recordFlip3;
    dbTime = recordTime3;
}
}



// Call Next Level and update data-level to next level number 
$(".nextlevelBtn").click(function(){

    // hide level 2 btn and show level 3 btn
    $(".nextlevelBtn").toggleClass("display-none");

    //Change Level
    level = $(this).data("level");
    if(level == "3"){
        $(".nextlevelBtn").addClass("display-none");
        $(".lastBtn").removeClass("display-none");
    }

    updateLevel();
    shuffleCard();
    confetti.stop();
    // Show flip Cards
    $("#flipCards").css({"margin-top":"0px"});
     // hide Success msg
    $("#successMsg").css({"margin-top":"-30000px"});

    //reset timeUp banner and hide
   $("#timeText").html("Time - ");
   document.getElementById("timeUp").classList.add("mtop");

});





var maxTime = 40;               //Allowed time
var numCards = 6;               //Number of cards
//Cards and it's twin (stg 1)
var arr = [1, 2, 3, 4, 5, 6,   1, 2, 3, 4, 5, 6];  
var imageLocation = "stage1";
// DB Prev Rercord (variable on game index page)
var dbFlip = recordFlip1;
var dbTime = recordTime1;


let timeLeft = maxTime;
let flips = 0;
let matchedCard = 0;
let disableDeck = false;
let isPlaying = false;
let cardOne, cardTwo, timer;

 


function initTimer() {
    if(timeLeft <= 0) {
        // alert("timeUp");
        document.getElementById("timeText").innerText = "Time Up - ";
        return clearInterval(timer);
    }
    timeLeft--;
    timeTag.innerText = timeLeft;
    scoreTime.innerText = timeLeft;

    //show time reading warning banner
    if(timeLeft < 6){
        document.getElementById("sec").innerText = timeLeft;
        document.getElementById("timeUp").classList.remove("mtop");
    }
}

function flipCard({target: clickedCard}) {
    if(!isPlaying) {
        isPlaying = true;
        timer = setInterval(initTimer, 1000);
    }
    if(clickedCard !== cardOne && !disableDeck && timeLeft > 0) {
        flips++;
        flipsTag.innerText = flips;
        scoreFlips.innerText = flips;
        clickedCard.classList.add("flip");
        if(!cardOne) {
            return cardOne = clickedCard;
        }
        cardTwo = clickedCard;
        disableDeck = true;
        let cardOneImg = cardOne.querySelector(".back-view img").src,
        cardTwoImg = cardTwo.querySelector(".back-view img").src;
        matchCards(cardOneImg, cardTwoImg);
    }
} 

function matchCards(img1, img2) {
    if(img1 === img2) {
        matchedCard++;
        if(matchedCard == numCards && timeLeft > 0) {

            //On Success - call Blast falls
            confetti.start();

            // Show success
            document.getElementById("successMsg").style.marginTop="0px";

            // Hide flip Cards
            document.getElementById("flipCards").style.marginTop="-30000px";

            
            // user time Elapsed and Flips
            let userElapsed = maxTime - timeLeft;
            let userFlips = flips;

            $("#elapsed").html(userElapsed);

            // check if user flips and elased time is lesser than DBs (new record broken)
            if(dbFlip > userFlips && dbTime > userElapsed){
            //show award and New Record Text
             document.getElementById("award").classList.remove("display-none");
             var newRecord  = "new";
            }
            else if(dbFlip >= userFlips && dbTime > userElapsed){
            //show award and New Record Text
             document.getElementById("award").classList.remove("display-none");
             var newRecord  = "new";
            }
            
            else if(dbFlip > userFlips && dbTime >= userElapsed){
            //show award and New Record Text
             document.getElementById("award").classList.remove("display-none");
             var newRecord  = "new";
            }
            
            
            if(newRecord){
            // Insert New Record to DB Here
    
                $.ajax({
                    url: "newRecord.php",
                    type: "POST",
                    data: {flips: userFlips, time:userElapsed, level:level},
                    success: function(data){
                        console.log(data);
                        $("#gameAjaxResult").html(data);
                    }

                });
           }

            return clearInterval(timer);

            //hide timeup Banner if visible
            document.getElementById("timeUp").classList.add("mtop");
        }
        cardOne.removeEventListener("click", flipCard);
        cardTwo.removeEventListener("click", flipCard);
        cardOne = cardTwo = "";
        return disableDeck = false;
    }

    // Close Success blast and refresh game if refresh clicked
    document.getElementById("hideBlast").addEventListener("click", function(){
        document.getElementById("successMsg").style.marginTop="-30000px";
          
        // hide Blast flower
        confetti.stop();

        // Show flip Cards
        document.getElementById("flipCards").style.marginTop="0px";

        //refresh game
          shuffleCard();

        //reset timeUp banner and hide
        $("#timeText").html("Time - ");
        document.getElementById("timeUp").classList.add("mtop");
    });


    setTimeout(() => {
        cardOne.classList.add("shake");
        cardTwo.classList.add("shake");
    }, 400);

    setTimeout(() => {
        cardOne.classList.remove("shake", "flip");
        cardTwo.classList.remove("shake", "flip");
        cardOne = cardTwo = "";
        disableDeck = false;
    }, 1200);
}

function shuffleCard() {
    timeLeft = maxTime;
    flips = matchedCard = 0;
    cardOne = cardTwo = "";
    clearInterval(timer);
    timeTag.innerText = timeLeft;
    scoreTime.innerText = timeLeft;
    flipsTag.innerText = flips;
    scoreFlips.innerText = flips;
    disableDeck = isPlaying = false;

    arr.sort(() => Math.random() > 0.5 ? 1 : -1);

    cards.forEach((card, index) => {
        card.classList.remove("flip");
        let imgTag = card.querySelector(".back-view img");
        setTimeout(() => {
            imgTag.src = `images/${imageLocation}/img-${arr[index]}.png`;
        }, 500);
        card.addEventListener("click", flipCard);
    });
}

shuffleCard();

refreshBtn.addEventListener("click", function(){
    shuffleCard();
   // hide Blast flower
   confetti.stop();
   // Show flip Cards
   document.getElementById("flipCards").style.marginTop="0px";

   //reset timeUp banner and hide
   $("#timeText").html("Time - ");
   document.getElementById("timeUp").classList.add("mtop");
});
    



cards.forEach(card => {
    card.addEventListener("click", flipCard);
});


// If game has been completed hide cards and show completion msg
$(".lastBtn").click(()=>{
    $(".game-container").fadeOut("slow",()=>{
        $(".gameCompleted").removeClass("display-none").fadeIn("slow");

        //hide timeUp banner 
        document.getElementById("timeUp").classList.add("mtop");
    });
    
});