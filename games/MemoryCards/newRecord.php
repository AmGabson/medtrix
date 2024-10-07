<?php
//show all error
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../include/config.php";
session_start();

$userid = intval($_SESSION["user_login"]);


// flips: userFlips, time:userElapsed, leve:level
if(isset($_POST["flips"])){

    $trials = intval($_POST["flips"]);
    $timeFrame = intval($_POST["time"]);
    $gameLevel = intval($_POST["level"]);
    $dateTime = date("Y-m-d H:i:s");
    $gameId = 1;

    //Update Leaderboard
    $stmt = $pdo->prepare("UPDATE leaderboard SET 
                            trials=:trials, timeFrame=:timeFrame, dateTime=:dateTime, userid=:userid WHERE gameLevel=:gameLevel AND gameId=:gameId");
    $stmt->bindParam(":trials", $trials, PDO::PARAM_INT);
    $stmt->bindParam(":timeFrame", $timeFrame, PDO::PARAM_INT);
    $stmt->bindParam(":dateTime", $dateTime, PDO::PARAM_STR);
    $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
    $stmt->bindParam(":gameLevel", $gameLevel, PDO::PARAM_INT);
    $stmt->bindParam(":gameId", $gameId, PDO::PARAM_INT);
    $stmt->execute();


        // Update token
        //get prev Token and Add new one
        $stmt=$pdo->prepare("SELECT token FROM account WHERE userid = :userid");
        $stmt->bindParam("userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        $prevToken=$stmt->fetch();
        $token = intval($prevToken["token"] + 2);

        $stmt = $pdo->prepare("UPDATE account SET token=:token WHERE userid=:userid");
        $stmt->bindParam(":token", $token, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        if($stmt){
        
            //Update token on the screen
            echo "<script>
                $('#tokenCount').html(".$token.");
                $('#token').addClass('tokenAni');
                setTimeout(()=>{
                $('#token').removeClass('tokenAni');
                },4000);

                </script>"; 


		//get user info
		$stmt=$pdo->prepare("SELECT fullName, profilepix FROM users WHERE userid = :userid");
		$stmt->bindParam("userid", $userid, PDO::PARAM_INT);
		$stmt->execute();
		$getUser=$stmt->fetch();
		$userimage = !empty($getUser["profilepix"]) ? "../../images/users/".$getUser["profilepix"]: "../../images/avatar.svg";

        // If level 1
        if($gameLevel == 1){
        echo "<script>
                $('#nLevel1').html('<em class=\"icon ni ni-layers\"></em> Level: ".$gameLevel."');
                $('#nElapsed1').html('<em class=\"icon ni ni-clock\"></em> Elapsed: ".$timeFrame."s');
                $('#nFlips1').html('<em class=\"icon ni ni-cards\"></em> Flips: ".$trials."s');
                $('#nText1').html('".$getUser['fullName']."  <em class=\"icon ni ni-award\"></em>');
                $('#nDate1').html('On ".date("jS F, Y")."');
                $('#nImg1').attr('src', '".$userimage."');
            </script>";
        }
        // If level 2
        elseif($gameLevel == 2){
        echo "<script>
                $('#nLevel2').html('<em class=\"icon ni ni-layers\"></em> Level: ".$gameLevel."');
                $('#nElapsed2').html('<em class=\"icon ni ni-clock\"></em> Elapsed: ".$timeFrame."s');
                $('#nFlips2').html('<em class=\"icon ni ni-cards\"></em> Flips: ".$trials."s');
                $('#nText2').html('".$getUser['fullName']."  <em class=\"icon ni ni-award\"></em>');
                $('#nDate2').html('On ".date("jS F, Y")."');
                $('#nImg2').attr('src', '".$userimage."');
            </script>";
        }
        // If level 3
        else{
        echo "<script>
                $('#nLevel3').html('<em class=\"icon ni ni-layers\"></em> Level: ".$gameLevel."');
                $('#nElapsed3').html('<em class=\"icon ni ni-clock\"></em> Elapsed: ".$timeFrame."s');
                $('#nFlips3').html('<em class=\"icon ni ni-cards\"></em> Flips :".$trials."s');
                $('#nText3').html('".$getUser['fullName']."  <em class=\"icon ni ni-award\"></em>');
                $('#nDate3').html('On ".date("jS F, Y")."');
                $('#nImg3').attr('src', '".$userimage."');
            </script>";
        }
}

}

