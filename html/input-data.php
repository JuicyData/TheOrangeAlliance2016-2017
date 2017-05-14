<?php
	require 'input.php';
	function AllOfIt(){
	//Loading and setting up the mongodb PHP
	$manager = new MongoDB\Driver\Manager();
	//$m = new MongoClient();

	$collectionName = "Y" . TimeTime($_POST['matchDate']) . PlaceID($_POST['matchPlace'], 'rainbow') . "Raw";
	$document = array(
		"MetaData" => array(
			"MetaData" => "MatchInputRaw",
			"TimeStamp" => date('YmdHis'),
			"DatePlace" => $collectionName,
			"ScreenStatus" => "Unscreened",
			"InputID" => $_POST['dataValidation']
		),
		
		"DataValidation" => array(
			"ValidationKey" => $_POST['dataValidation'],
			"ValidationValue" => ValidationValue($_POST['dataValidation'])
		),

		"MatchInformation" => array(
			"MatchNumber" => intval($_POST['matchNumber']),
			"RobotAlliance" => $_POST['robotAlliance'],
			"TeamNumber" => intval($_POST['teamNumber'])
		),

		"GameInformation" => array(
			"AUTO" => array(
				"Parking" => $_POST['autoRobotParking'],
				"CenterParticles" => intval($_POST['autoParticlesCenter']),
				"CornerParticles" => intval($_POST['autoParticlesCorner']),
				"CapBall" => $_POST['autoCapBall'],
				"Beacons" => intval($_POST['autoClaimedBeacons'])
			),
			"DRIVER" => array(
				"CenterParticles" => intval($_POST['driverParticlesCenter']),
				"CornerParticles" => intval($_POST['driverParticlesCorner'])
			),
			"END" => array(
				"Beacons" => intval($_POST['endAllianceClaimedBeacons']),
				"CapBall" => $_POST['endCapBall']
			)
		)
	);
	$bulk = new MongoDB\Driver\BulkWrite();
	$bulk->insert($document);
	$manager->executeBulkWrite('TheOrangeAlliance.'.$collectionName, $bulk);
	CreateDBLog(
		$collectionName,
		"MatchInput",
		date('YmdHis'),
		$_POST['dataValidation'],
		"Testing",
		$_POST['dataValidation']
	);
	}
	AllOfIt();
?>