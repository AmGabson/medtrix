<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../include/config.php");
session_start();
$userid = intval($_SESSION["user_login"]);
    
require_once('vendor/autoload.php');

//Docs HERE
https://docs.tatum.io/reference/solanagetbalance


// Main NET API: t-66dc04f1c0623b1cee2bd6c3-620b464b5e044277ac1aea3a
// Test Net API: t-66dc04f1c0623b1cee2bd6c3-d00d4cc4a6744e69b6e95283


// Confirm Transaction
// using Transaction Signature
if(isset($_POST["hash"])){

    $client = new \GuzzleHttp\Client();
    $hash = htmlspecialchars($_POST["hash"]);
    
    
    //vaildate wallet is upto 87 to 88
    if(strlen($hash) < 87 || strlen($hash) > 88) {
        echo '<script>
                $(".errorParent").removeClass("display-none");
                $(".errorNet").addClass("display-none");
                $(".error-text").html("Enter a valid SOL Transaction Id (hash) with 87 to 88 characters");
             </script>';
    } 
    // Check if valid base 58 Character
    elseif (!preg_match('/^[123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz]+$/', $hash)) {
        
        echo '<script>
                $(".errorParent").removeClass("display-none");
                $(".errorNet").addClass("display-none");
                $(".error-text").html("Enter a valid SOL transaction id (hash). Length from 87 to 88 characters");
             </script>';
    } else {
    
    
 try {

$response = $client->request('GET', 'https://api.tatum.io/v3/solana/transaction/' . $hash, [
  'headers' => [
    'accept' => 'application/json',
    'x-api-key' => 't-66dc04f1c0623b1cee2bd6c3-d00d4cc4a6744e69b6e95283',
  ],
]);

// Success Returned
$data = $response->getBody();

// Convert JSON response to an associative array
$data = json_decode($data, true);

if (!$data) {
    die('Failed to decode JSON');
}

// Extract relevant information
$blockTime = $data['blockTime'];
$fee = $data['meta']['fee'];
$status = $data['meta']['status']['Ok'];

// Calculate amount sent (assuming it's the difference between postBalance and preBalance)
$postBalance = $data['meta']['postBalances'][0];
$preBalance = $data['meta']['preBalances'][0];
$amountSent = $postBalance - $preBalance;

// Format amount sent (convert to SOL)
$amountSent = ($preBalance - $postBalance) / 1e9;
// $amountSent = ceil($amountSent * 1000) / 1000;

 $id = intval($_POST['id']);



//Confirm it was sent to admin Wallet from DB
 $receiverWalletAddress = $_POST["adminWallet"]; // Replace with actual receiver wallet address

$destinationWalletAddress = $data['transaction']['message']['accountKeys'][1]; // Extract destination wallet address from transaction data

if ($receiverWalletAddress === $destinationWalletAddress) {

  
// Success message
if ($amountSent < $_POST["amount"]) {

    $status = "declined";
    $signDate = date("Y-m-d H:is");
    $payMethod ="solana Qr";

    $query = $pdo->prepare("UPDATE consultations SET status = :status, payMethod=:payMethod, signDate=:signDate WHERE id=:id");
    $query->bindParam(":status", $status, PDO::PARAM_STR);
    $query->bindParam(":payMethod", $payMethod, PDO::PARAM_STR);
    $query->bindParam(":signDate", $signDate, PDO::PARAM_STR);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();


    if($query){

    $subMsg = "Required amount was <b>" . $_POST["amount"] . " SOL</b>";
    echo '<script>
            $(".reAmount").html("' . $amountSent . ' SOL Received");
            $(".subMsg").html("' . $subMsg . '");
            $(".reMsg").html("Transaction will be cancelled & refunded! Click below to contact us");
            $(".icon-circle-xxl").removeClass("bg-success").addClass("bg-danger");
            $(".receiptBtn, .counter, .beforeBtn, .nk-pps-title p").addClass("display-none");
            $(".contactBtn, .afterBtn").removeClass("display-none");
            $(".t-text").html("Payment Received");
            $(".title-text").html("Process Completed");

            // click modal
            $(".result").trigger("click");

             //clear the page
            $(".cardCon").html("<div class=\"alert alert-info alert-icon\"><em class=\"icon ni ni-alert-circle\"></em> <strong>Payment Transaction Recorded.</strong> To view receipt click the link <a href=\"../dashboard/receipt.php?id='.$id.'\" class=\"alert-link\">View Receipt</a> for make deposit.</div>");
          </script>';
    }

} else {
    
    
    $status = "approved";
    $signDate = date("Y-m-d H:i:s");
    $payMethod ="solana Qr";

    $query = $pdo->prepare("UPDATE consultations SET status = :status, payMethod=:payMethod, signDate=:signDate WHERE id=:id");
    $query->bindParam(":status", $status, PDO::PARAM_STR);
    $query->bindParam(":payMethod", $payMethod, PDO::PARAM_STR);
    $query->bindParam(":signDate", $signDate, PDO::PARAM_STR);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();

    if($query){

    $subMsg = "Your payment was successful";
    echo '<script>
            $(".reAmount").html("Order Successful");
            $(".subMsg").html("' . $subMsg . '");
            $(".reMsg").html("Payment receipt for  <b>'.$_POST["ref"].'</b> updated");
             // click modal
            $(".result").trigger("click");
            $(".counter, .beforeBtn, .nk-pps-title p").addClass("display-none");
            $(".afterBtn").removeClass("display-none");
            $(".t-text").html("Payment Received");
            $(".title-text").html("Process Completed");


            //clear the page
            $(".cardCon").html("<div class=\"alert alert-info alert-icon\"><em class=\"icon ni ni-alert-circle\"></em> <strong>Payment Transaction Recorded.</strong> To view receipt click the link <a href=\"../dashboard/receipt.php?id='.$id.'\" class=\"alert-link\">View Receipt</a> for make deposit.</div>");
          </script>';
}

}

//if wallet address sent do not match admin's
} else {

  echo      '<script>
                $(".errorParent").removeClass("display-none");
                $(".error-text").html("Transaction exists but sent to wrong address! Make sure to use the specified Solana address above.");
              </script>';
}



}catch (GuzzleHttp\Exception\ConnectException $e) {

        //Incase of network connection (Data turned off)
        echo '<script>
                $(".errorParent").addClass("display-none");
                $(".errorNet").removeClass("display-none");
            </script>';
    
        //Handle Error
    } catch (GuzzleHttp\Exception\ClientException $e) {
        // Handle the error
        $responseBody = $e->getResponse()->getBody();
        $errorData = json_decode($responseBody, true);
    
         //$errorDetails = $errorData['data'][0];    //Reason for error
         $errorMessage = $errorData['message'];    //status code error msg
    
         echo '<script>
                $(".errorParent").removeClass("display-none");
                $(".error-text").html("'.$errorMessage.'");
              </script>';
    
        }

}

}
