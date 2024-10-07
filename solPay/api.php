<?php
//error_reporting(0);
define('DB_SERVER', 'portal.blankipanel.com');
define('DB_USERNAME', 'medtrix');
define('DB_PASSWORD', 'Medtrix@2939');
define('DB_DATABASE', 'medtrix');


	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	
	try{
		
	$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$pdo->exec("set names utf8mb4");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		die("Error: Can Not Connect" . $e->getMessage());
	}

	
	
  
session_start();
$userid = $_SESSION["user_login"];


// Get Transaction Parameters
$stmt=$pdo->prepare("SELECT * FROM solanaParams WHERE userid = :userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$getData=$stmt->fetch();




// Allow from any origin
header('Access-Control-Allow-Origin: *'); // Change '*' to a specific origin for more security
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Allow specific methods
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, X-Token-Auth, Authorization'); // Allow specific headers
header('Content-type: application/json');


// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
// Admin Wallet and amount from backend for security reasons
header('Content-Type: application/json');




//Modify Inputs
$consultType = htmlspecialchars($getData["consultType"]);
$adminWallet = htmlspecialchars($getData["adminWallet"]);
$amount = $getData["amount"];
$user = htmlspecialchars($getData["user"]);
$userImage = $getData["userImage"];
$consultId = intval($getData["consultId"]); //id of the row of booked consultaion;


switch($consultType){
case $consultType == "video":
    $icon  = "ni-video";
break;

case $consultType == "call":
    $icon  = "ni-call-alt";
break;

case $consultType == "text":
    $icon  = "ni-chat-circle";
break;

case $consultType == "physical":
    $icon  = "ni-users";
break;
}

// Return the wallet and amount from the server-side logic
echo json_encode([
    'toPubkey' => $adminWallet, //my mobile solana wallet
    'amount' => $amount, // Or retrieve this from a secure server-side source
     'icon' => $icon,
     'consultType' => $consultType,
     'user' => $user,
     'userImage' => $userImage,
     'consultId' => $consultId,
]);
?>