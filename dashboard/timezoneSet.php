<?php


    // Set timezone  Based on user settings in the preference table
	// get preferences
	$stmt=$pdo->prepare("SELECT * FROM preference WHERE userid = :userid");
	$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	$stmt->execute();
	$pref=$stmt->fetch();

	if(isset($pref["timezone"])){
		$getTimeZone = $pref["timezone"];
	}
	else{
		$getTimeZone = date_default_timezone_get();
	}


	// Set timezone  based on user preference updated in DB
	date_default_timezone_set($getTimeZone);

	

	// Get Timezone Label (GMT +6:00) Based on timezone
	function getTimeZoneLabel($timezoneIdentifier) {
		$timezone = new DateTimeZone($timezoneIdentifier);
		$offset = $timezone->getOffset(new DateTime());
		$hours = intval($offset / 3600);
		$minutes = abs(intval($offset % 3600 / 60));
		$symbol = ($offset < 0) ? '-' : '+';
		return "(GMT {$symbol}{$hours}:" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ")";
	  }
	  $timezoneLabel = getTimeZoneLabel($getTimeZone); // Example usage
	  // Output: (GMT +6:00)
	