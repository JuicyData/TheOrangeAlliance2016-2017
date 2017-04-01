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
				"RobotParking" => InputTranslator($_POST['autoRobotParking']),
				"ParticlesCenter" => intval($_POST['autoParticlesCenter']),
				"ParticlesCorner" => intval($_POST['autoParticlesCorner']),
				"CapBall" => InputTranslator($_POST['autoCapBall']),
				"ClaimedBeacons" => intval($_POST['autoClaimedBeacons'])
			),
			"DRIVER" => array(
				"ParticlesCenter" => intval($_POST['driverParticlesCenter']),
				"ParticlesCorner" => intval($_POST['driverParticlesCorner'])
			),
			"END" => array(
				"AllianceClaimedBeacons" => intval($_POST['endAllianceClaimedBeacons']),
				"CapBall" => InputTranslator($_POST['endCapBall'])
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