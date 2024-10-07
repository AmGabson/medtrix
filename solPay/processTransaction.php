<?php

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type');
// header('Content-Type: application/json');


// Connect to DB
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




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$signature = $_POST['transactionSignature'];
$id = intval($_POST['consultId']);

  try {
    $status = "approved";
    $payMethod = "solana";
    $signDate = date("Y-m-d H:i:s");
    $query = $pdo->prepare("UPDATE consultations SET status = :status, signature=:signature, signDate=:signDate, payMethod=:payMethod WHERE id=:id");
    $query->bindParam(":status", $status, PDO::PARAM_STR);
    $query->bindParam(":signature", $signature, PDO::PARAM_STR);
    $query->bindParam(":signDate", $signDate, PDO::PARAM_STR);
    $query->bindParam(":payMethod", $payMethod, PDO::PARAM_STR);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();

    if($query){
    echo json_encode(['success' => true, 'message' => 'Transaction data received successfully']);
    }
  } catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
  }
} else {
  echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

