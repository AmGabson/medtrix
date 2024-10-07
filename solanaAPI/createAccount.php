<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../include/config.php");
session_start();
$userid = intval($_SESSION["user_login"]);

require_once('vendor/autoload.php');
//Docs HERE
https://docs.tatum.io/reference/solanagetbalance


//  Get Wallet Balance - solana address
if(isset($_POST["createWallet"])){

$client = new \GuzzleHttp\Client();



// Make API request

// Main NET API: t-66dc04f1c0623b1cee2bd6c3-620b464b5e044277ac1aea3a
// Test Net API: t-66dc04f1c0623b1cee2bd6c3-d00d4cc4a6744e69b6e95283

try {
$response = $client->request('GET', 'https://api.tatum.io/v3/solana/wallet', [
  'headers' => [
    'accept' => 'application/json',
    'x-api-key' => 't-66dc04f1c0623b1cee2bd6c3-620b464b5e044277ac1aea3a',
  ],
]);


    $data = json_decode($response->getBody(), true);

   // check if status code is 200 (transaction successful)
   if ($response->getStatusCode() === 200) {
        $mnemonic = explode(' ', $data['mnemonic']);
        $walletAddress = $data['address'];
        $privateKey = $data['privateKey'];

        $cnt = 1;
        foreach($mnemonic as $phrase){?>
   
            <script>
                div  =  document.createElement("div");
                div.classList.add("topic-card", "flex", "flex-1", "text-center", "md:max-w-[225px]");

                div.innerHTML='<div class="flex-1" style="flex-basis: 180px;margin-bottom:3px"><button class="btn btn-secondary text-xs" style="height: 30px;border-radius:4px; padding: 8px;min-width:110px;text-align:left"><span class="text-xs flex-shrink-0 text-wrap leading-none"><span style="color: #6a81a7;"><?php echo $cnt.". "?></span> &nbsp;<?php echo htmlspecialchars($phrase);?></span></button></div>';
                $(".phrase").append(div);
            </script>

        <?php $cnt++; }

        echo '<script>

                $("#privateKey").val("'.$privateKey.'");
                $("#address").val("'.$walletAddress.'");
                $("#keyPhrase").val("'.implode(separator: " ", array: $mnemonic).'");

                $(".mnemonics").removeClass("display-none");
                $(".createWallet").addClass("display-none");
                //$(".animation-ctn").removeClass("display-none");
                $(".successText").html("Your Recovery Phrase").css({"font-size":"23px"});
                $(".solImg").css({"margin-top":"10px", "width":"60%"});
            </script>';

            if(!empty($_POST["fromDashboard"])){
              echo '<script>
              //if user is coming from dashboard redirect accordingly
              $(".dialog-close").attr("href", "dashboard/'.$_POST["fromDashboard"].'");
              
              </script>';
              }
        
}

}catch (GuzzleHttp\Exception\ConnectException $e) {

    //Incase of network connection (Data turned off)
    echo '<script>
            $(".waError").removeClass("display-none");
            $(".error-text").html("Unable to connect to the server. Check connection and try again.");
            $(".no-address").addClass("display-none");
        </script>';

}catch (GuzzleHttp\Exception\ClientException $e) {
    // Handle the error
    $responseBody = $e->getResponse()->getBody();
    $errorData = json_decode($responseBody, true);

     $errorDetails = $errorData['data'][0];    //Reason for error
     $errorMessage = $errorData['message'];    //status code error msg

     echo '<script>
            $(".waError, .no-address").removeClass("display-none");
            $(".error-text").html("'.$errorDetails.'");
            $(".no-address").html("'.$errorMessage.'");
          </script>';

    // HTTP RETURN CODES
    // 200 - OK
    //400 - Bad Request
    // 401 - Unauthorized. Not valid or inactive subscription key present in the HTTP Header.
    // 500 - Internal server error. There was an error on the server during the processing of the request.

    // if ($e->getResponse()->getStatusCode() === 400) {
    //     // Handle error specifically
    // } 

    }



}






// Process insert when done BTN is clicked
if(isset($_POST["address"])){

  $walletAddress = htmlspecialchars($_POST["address"]);
  $privateKey = htmlspecialchars($_POST["privateKey"]);
  $balance = "0.0";

 //INSERT
 $stmt = $pdo->prepare("INSERT INTO solana (walletAddress,balance,privateKey,userid) 
 VALUES (:walletAddress,:balance,:privateKey,:userid)");
$stmt->bindParam(":walletAddress", $walletAddress, PDO::PARAM_STR);
$stmt->bindParam(":balance", $balance, PDO::PARAM_STR);
$stmt->bindParam(":privateKey", $privateKey, PDO::PARAM_STR);
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
if($stmt){
// Success MSG 
echo '<script>
        $(".successText").html("Wallet Created").css({"color":"#41d078"});
        $(".solBal").html("'.$walletAddress.'").css({"font-size":"12px"});
        $(".phrase, .continueAfterPhrase, #copyButton").addClass("display-none");
        $(".animation-ctn, .walletInput").removeClass("display-none");
        $(".solBal").html("Your wallet address &nbsp; <em class=\"text-lg ni ni-chevron-down\"></em>");
      
      
            $(".conn").html("'.$balance.'");
            $(".sideBal").html("SOL Balance: '.$balance.'");

            $(".solDetails").html(\'<img src="images/solanaLogo.svg"><div class="text-center mt-5 mb-3 text-grey-600 font-bold"> Account Overview </div><div class="hover:text-blue-400 rounded px-2 p-2 flex-center flex-shrink-0 text-grey-600 text-xs" style="background:#202736;"><span class="flex-shrink-0 text-grey-600 text-sm">'.htmlspecialchars(substr($walletAddress,0,8).".....".substr($walletAddress,-8)).'</span></div><figcaption class="panel rounded px-2 flex items-center justify-between w-full py-2 mt-2" style="background:#202736"><span class="flex-shrink-0 text-grey-600 text-sm">SOL Balance</span><span class="text-xs font-bold text-white text-right">'.$balance.'  SOL</span></figcaption><div class="mt-4"><button class="btn text-xs btn-base btn-secondary has-icon w-full mb-1 px-3"><span class="flex-center flex-shrink-0 text-wrap">Refresh</span></button><a class="btn text-xs btn-base btn-primary has-icon w-full px-3"><span class="flex-center flex-shrink-0 text-wrap">Transactions &nbsp; <em class="ni ni-chevron-right"></em></span></a></div>\');
      
        </script>';


}

}