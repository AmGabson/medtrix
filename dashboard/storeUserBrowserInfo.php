<?php
if(isset($_SESSION["user_os"])){
    $browserLogin = $_SESSION["user_os"];
}else{
    $browserLogin = 0;
    $rand = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $shuf = str_shuffle($rand).rand();
    $keys = substr($shuf, 0, 20).$userid;

    $_SESSION["user_os"] = $keys;
}


$stmt = $pdo->prepare("SELECT sessionString FROM activities WHERE userid=:userid AND sessionString=:keys 
                        ORDER BY id DESC LIMIT 1");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->bindParam(":keys", $browserLogin, PDO::PARAM_STR);
$stmt->execute();
$getS = $stmt->rowCount();


if($getS == 0){

//Create Browser History Session (create a random string, if user is still online the browser and os will not be inserted except user logs out)






// Function to get the user's browser and OS
function getBrowserOS() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";
    $os = "Unknown OS";
    $os_version = "";

    // Get browser
    if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
        $browser = 'Internet Explorer';
    } elseif (preg_match('/Firefox/i', $user_agent)) {
        $browser = 'Mozilla Firefox';
    } elseif (preg_match('/Chrome/i', $user_agent) && !preg_match('/Edge/i', $user_agent)) {
        $browser = 'Google Chrome';
    } elseif (preg_match('/Safari/i', $user_agent) && !preg_match('/Edge/i', $user_agent)) {
        $browser = 'Apple Safari';
    } elseif (preg_match('/Opera/i', $user_agent)) {
        $browser = 'Opera';
    } elseif (preg_match('/Netscape/i', $user_agent)) {
        $browser = 'Netscape';
    }


    // Get OS and OS version
    if (preg_match('/Windows/i', $user_agent)) {
        $os = 'Windows';
        preg_match('/Windows NT (\d+\.\d+)/i', $user_agent, $matches);
        if (!empty($matches[1])) {
            $os_version = $matches[1];
        }
    } elseif (preg_match('/Macintosh|Mac OS X/i', $user_agent)) {
        $os = 'Mac OS X';
        preg_match('/Mac OS X (\d+([_\.\s]\d+)*)/i', $user_agent, $matches);
        if (!empty($matches[1])) {
            $os_version = str_replace('_', '.', $matches[1]);
        }
    } elseif (preg_match('/Linux/i', $user_agent)) {
        $os = 'Linux';
    } elseif (preg_match('/Android/i', $user_agent)) {
        $os = 'Android';
        preg_match('/Android (\d+(\.\d+)?)/i', $user_agent, $matches);
        if (!empty($matches[1])) {
            $os_version = $matches[1];
        }
    } elseif (preg_match('/iOS/i', $user_agent)) {
        $os = 'iOS';
        preg_match('/OS (\d+([_\.\s]\d+)*) like Mac OS X/i', $user_agent, $matches);
        if (!empty($matches[1])) {
            $os_version = str_replace('_', '.', $matches[1]);
        }
    }

    return array($browser, "$os $os_version");
}

// Get user's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Get user's browser and OS
list($browser, $os) = getBrowserOS();



// Google Chrome
// Opera
// Netscape
// Apple Safari
// Mozilla Firefox
// Internet Explorer
// Unknown Browser

if($browser == "Google Chrome"){ $icon = 'ni-b-chrome';}
elseif($browser == "Opera"){$icon = 'ni-b-opera';}
elseif($browser == "Netscape"){$icon = 'ni-b-si';}
elseif($browser == "Apple Safari"){$icon = 'ni-b-safari';}
elseif($browser == "Mozilla Firefox"){$icon = 'ni-b-firefox';}
elseif($browser == "Internet Explorer"){$icon = 'ni-b-ie';}
else{$icon = 'ni-b-si';}


// UPDATE DB - Check if user turned On  save Activity first
// Get activity log Status
$stmt = $pdo->prepare("SELECT saveActivity FROM preference WHERE userid=:userid ");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
$Actstatus = $stmt->fetch();

if($Actstatus["saveActivity"] == "yes"){
$stmt = $pdo->prepare("INSERT INTO activities (browser, ip, os, sessionString, icon, userid) 
                        VALUES (:browser, :ip, :os, :sessionString, :icon, :userid) ");
$stmt->bindParam(":browser", $browser, PDO::PARAM_STR);
$stmt->bindParam(":ip", $ip_address, PDO::PARAM_STR);
$stmt->bindParam(":os", $os, PDO::PARAM_STR);
$stmt->bindParam(":sessionString", $browserLogin, PDO::PARAM_STR);
$stmt->bindParam(":icon", $icon, PDO::PARAM_STR);
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();

}

}

