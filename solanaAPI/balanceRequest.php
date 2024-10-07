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
if(isset($_POST["walletAddress"])){

$client = new \GuzzleHttp\Client();
$walletAddress = htmlspecialchars($_POST["walletAddress"]);


//vaildate wallet is upto 32 to 44 characters
if(strlen($walletAddress) < 32 || strlen($walletAddress) > 44) {
    echo '<script>
            $(".waError, .no-address").removeClass("display-none");
            $(".no-address").html("Invalid wallet address");
            $(".error-text").html("Address must be a valid SOL address. Solana address must be in base58 format and must contain characters of a length between 32 and 44.");
         </script>';
} 
// Check if valid base 58 Character
elseif (!preg_match('/^[123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz]+$/', $walletAddress)) {
    
    echo '<script>
            $(".waError, .no-address").removeClass("display-none");
            $(".no-address").html("Invalid wallet address format");
            $(".error-text").html("Address must be a valid SOL address. Solana address must be in base58 format and must contain characters of a length between 32 and 44.");
        </script>';
} else {


    
// Make API request

// Main NET API: t-66dc04f1c0623b1cee2bd6c3-620b464b5e044277ac1aea3a
// Test Net API: t-66dc04f1c0623b1cee2bd6c3-d00d4cc4a6744e69b6e95283

try {
    // Make the API request
    $response = $client->request('GET', 'https://api.tatum.io/v3/solana/account/balance/' . $walletAddress, [
    'headers' => [
        'accept' => 'application/json',
        'x-api-key' => 't-66dc04f1c0623b1cee2bd6c3-620b464b5e044277ac1aea3a',
      ],
    ]);

    $data = json_decode($response->getBody(), true);

    // check if status code is 200 (transaction successful)
    if ($response->getStatusCode() === 200) {
        $solAmount = $data['balance'];
        $balance = number_format($solAmount, 2, '.', ',');

        //INSERT
        $stmt = $pdo->prepare("INSERT INTO solana (walletAddress,balance,userid) 
                                VALUES (:walletAddress,:balance,:userid)");
        $stmt->bindParam(":balance", $balance, PDO::PARAM_STR);
        $stmt->bindParam(":walletAddress", $walletAddress, PDO::PARAM_STR);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt){
            // Success MSG 
            
       echo '<script> 
            $(".hideW").addClass("display-none"); 
            $(".animation-ctn").removeClass("display-none"); 
            $(".successText").html("Wallet Connected").css({"color":"#41d078"}); 
            $(".solBal").html("SOL Balance: &nbsp;'.$balance.'"); 
            $(".solImg").css({"margin-top":"10px", "width":"60%"});
            $(".conn").html("'.$balance.'");
            $(".sideBal").html("SOL Balance: '.$balance.'");

            $(".solDetails").html(\'<img src="images/solanaLogo.svg"><div class="text-center mt-5 mb-3 text-grey-600 font-bold"> Account Overview </div><div class="hover:text-blue-400 rounded px-2 p-2 flex-center flex-shrink-0 text-grey-600 text-xs" style="background:#202736;"><span class="flex-shrink-0 text-grey-600 text-sm">'.htmlspecialchars(substr($walletAddress,0,8).".....".substr($walletAddress,-8)).'</span></div><figcaption class="panel rounded px-2 flex items-center justify-between w-full py-2 mt-2" style="background:#202736"><span class="flex-shrink-0 text-grey-600 text-sm">SOL Balance</span><span class="text-xs font-bold text-white text-right">'.$balance.'  SOL</span></figcaption><div class="mt-4"><button class="btn text-xs btn-base btn-secondary has-icon w-full mb-1 px-3"><span class="flex-center flex-shrink-0 text-wrap">Refresh</span></button><a class="btn text-xs btn-base btn-primary has-icon w-full px-3"><span class="flex-center flex-shrink-0 text-wrap">Transactions &nbsp; <em class="ni ni-chevron-right"></em></span></a></div>\');
            </script>';

            if(!empty($_POST["fromDashboard"])){
            echo '<script>
            //if user is coming from dashboard redirect accordingly
            $(".dialog-close").attr("href", "dashboard/'.$_POST["fromDashboard"].'");
            
            </script>';
            }  
        
        
                
}
    }

} catch (GuzzleHttp\Exception\ConnectException $e) {

    //Incase of network connection (Data turned off)
    echo '<script>
            $(".waError").removeClass("display-none");
            $(".error-text").html("Unable to connect to the server.  Check connection and try again.");
            $(".no-address").addClass("display-none");
        </script>';

    //Handle Error
} catch (GuzzleHttp\Exception\ClientException $e) {
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


} //validate wallet character

} //POST isset