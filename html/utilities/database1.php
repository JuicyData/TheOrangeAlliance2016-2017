<!DOCTYPE html>
<html>
	<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "css/styles.css" rel = "stylesheet" type="text/css">
		<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAH3yAACM/wDb7P8AAC4DAABo3gAAWd4ADGsAABfEAAAAO7MAYq71AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABVWVQAAAAAhEVaVlQAAAiIhFWZVUAACIiIRVZWQACIiIiERVlUAIiIiIiFWlQCiMiIiIhVlACIiIiIiIVUAojIyIiIhFQAqIiIiIiISAAKiMjIiIiAAACoqIiIiAAAAAAB3dAAAAAAAAAeHQAAAAAAABHhwAAAAAAAAB3cAD4HwAA4AcAAMADAADAAwAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAwAMAAOAHAAD+HwAA/w8AAP8PAAD/xwAA" rel="icon" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="apple-touch-icon" sizes="152x152" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/apple-touch-icon.png?v=vMrqOno5qk">
<link rel="icon" type="image/png" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/favicon-32x32.png?v=vMrqOno5qk" sizes="32x32">
<link rel="icon" type="image/png" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/favicon-16x16.png?v=vMrqOno5qk" sizes="16x16">
<link rel="manifest" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/manifest.json?v=vMrqOno5qk">
<link rel="mask-icon" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/safari-pinned-tab.svg?v=vMrqOno5qk" color="#ff9500">
<link rel="shortcut icon" href="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/favicon.ico?v=vMrqOno5qk">
<meta name="apple-mobile-web-app-title" content="The Orange Alliance">
<meta name="application-name" content="The Orange Alliance">
<meta name="msapplication-config" content="https://sites.google.com/site/filehostdummysite1234/files/theorangealliance/browserconfig.xml?v=vMrqOno5qk">
<meta name="theme-color" content="#ff9500">
	</head>
	<body>
				<header>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="nav-brand" href="http://theorangealliance.tk:8080/"> 
					<img style="max-width:50px" src="images/logo.png"> Juicy Data!
					<?php
						/*
						function Juicy($juicyAddBool){
							$m = new MongoClient();
							$db = $m->TheOrangeAllianceTest;
							$subCollection = "Juicy";
							$collection = $db->$subCollection;
							$document = $collection->find(['MetaData.MetaData' => 'Juicy']);
							$juicyValue = 0;

							if($juicyAddBool == true){
								foreach($cursor as $document){
									$juicyValue = $cursor['Juicy'] + 1;
								}
							}

							echo " " . " " . $juicyValue;
							$inserting = array(
								"MetaData" => array(
									"MetaData" => "Juicy"
								),
								"Juicy" => $juicyValue
							);
							$collection->update($inserting);
						}
						*/
					?>
					</a>
					<a class="nav-brand" href="http://theorangealliance.tk:8080/"></a>
					<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
						<span class = "icon-bar"></span>
						<span class = "icon-bar"></span>
						<span class = "icon-bar"></span>
					</button>
				</div>
				<div class = "collapse navbar-collapse navHeaderCollapse">
					<ul class = "nav navbar-nav navbar-right">
						<li class = "active"><a href = "http://theorangealliance.tk:8080/database.php">DataBase</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-data.php">Input Data</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-results.php">Input Results</a></li>
						<li ><a href = "http://theorangealliance.tk:8080/input-schedule.php">Input Schedule</a></li>
						
					</ul>
				</div>
			</div>
		</div>
		</header>
		<div class="test">
			<div class="container">
				<form action="database.php" method="post">
				<div/>
				<input  class="form-control" id="inputID" name="databaseInput">
				<div/>
				<button type="submit" class="btn btn-primary btn-block raised">Submit</button>
				</form>
				<?php
					
					$m = new MongoClient();
					$db = $m->TheOrangeAlliance;
					$subCollection = "DataValidation";
					$collection = $db->$subCollection;
					//$document = $collection->find();
					
					$keys = array(
						/*
						array(
							"Type" => "",
							"Key" => "",
							"FirstName" => null,
							"LastName" => null,
							"TeamType" => "FTC",
							"TeamNumber" => "",
							"KeyType" => "",
							"KeyRank" => 50.0
						)
						*/
						array(
							"Type" => "Person",
							"Key" => "pi",
							"FirstName" => "Ryan",
							"LastName" => "N",
							"TeamType" => null,
							"TeamNumber" => null,
							"KeyType" => "Default",
							"KeyRank" => 50.0
						),
						array(
							"Type" => "Person",
							"Key" => "bagel7",
							"FirstName" => "Cameron",
							"LastName" => "D",
							"TeamType" => null,
							"TeamNumber" => null,
							"KeyType" => "Admin",
							"KeyRank" => 50.0
						),
						array(
							"Type" => "Person",
							"Key" => "kat",
							"FirstName" => "Mitha",
							"LastName" => "S",
							"TeamType" => null,
							"TeamNumber" => null,
							"KeyType" => "Default",
							"KeyRank" => 50.0
						),
						array(
							"Type" => "Team",
							"Key" => "level",
							"FirstName" => null,
							"LastName" => null,
							"TeamType" => "FTC",
							"TeamNumber" => 9261,
							"KeyType" => "Default",
							"KeyRank" => 50.0
						)
					);
					
					if($_POST["databaseInput"] == "yes"){
						foreach($keys as $key){
							$document = array(
								"MetaData" => array(
									"MetaData" => "ValidationKey",
									"TimeStamp" => date("YmdHis"),
									"InputID" => "rainbow"
								),	
								"ValidationKey" => array(
									"KeyIdentity" => array(
										"KeyVersion" => 1,
										"Key" => $key["Key"],
										"Association" => array(
											"Type" => $key["Type"],
											"TeamType" => $key['TeamType'],
											"TeamNumber" => $key['TeamNumber'],
											"Person" => array(
												"FirstName" => $key["FirstName"],
												"MiddleInitial" => null,
												"LastName" => $key["LastName"],
												"Email" => null
											),
											"Group" => array(
												"GroupName" => null,
												"GroupEmail" => null
											)
										)
									),
									"KeyInformation" => array(
										"KeyType" => $key["KeyType"],
										"KeyStatus" => "Default",
										"KeyRank" => $key["KeyRank"]
									)
								)
								
							);
							$collection->insert($document);
						}
					}
					

					/*
					function InsertPlaces(){
						$m = new MongoClient();
						$db = $m->TheOrangeAllianceTest;
						$subCollection = "Places";
						$collection = $db->$subCollection;
						//$document = $collection->find();

						$placeAddressAndIDArray = array(
							//"placeComplex1" => array(
							//	"placeID" => 1,
							//	"placeAddress" => "2230 E Jewett St, San Diego, CA 92111"
							//),
							"placeComplex2" => array(
								"placeID" => 2,
								"placeAddress" => "1615 Mater Dei Dr, Chula Vista, CA 91913"
							),
							//"placeComplex2" => array(
							//	"placeID" => 3,
							//	"placeAddress" => "302 Emerald Dr, Vista, CA 92083"
							//),
							//"placeComplex2" => array(
							//	"placeID" => 4,
							//	"placeAddress" => "1500 S El Camino Real, Encinitas, CA 92024"
							//),
						);
						foreach($placeAddressAndIDArray as $placeComplex){
							$document = array(
								"MetaData" => array(
									"MetaData" => "Places",
									"TimeStamp" => date('YmdHis'),
									"InputID" => 'rainbow'
								),
								"PlaceInformation" => array(
									"PlaceFullAddress" => $placeComplex['placeAddress'],
									"PlaceID" => $placeComplex['placeID'],
									"PlaceLocation" => array(
										"Address" => 'lol',
										"City" => 'lol',
										"State" => 'lol',
										"Code" => 101
									)
								)
							);
							$collection->insert($document);
						}
					}

					InsertPlaces();
					*/
					/*
					function AggregateTesting(){
						$m = new MongoClient();
						$c = $m->selectDB('DatabaseTesting')->selectCollection('DatabaseTesting');
						$data = array (
						    'title' => 'this is my title',
						    'author' => 'bob',
						    'posted' => new MongoDate,
						    'pageViews' => 5,
						    'tags' => array ( 'fun', 'good', 'fun' ),
						    'comments' => array (
						      array (
						        'author' => 'joe',
						        'text' => 'this is cool',
						      ),
						      array (
						        'author' => 'sam',
						        'text' => 'this is bad',
						      ),
						    ),
						    'other' =>array (
						      'foo' => 5,
						    ),
						);
						//$d = $c->insert($data);
						$ops = array(
						    array(
						        '$project' => array(
						            "author" => 1,
						            "tags"   => 1,
						        )
						    ),
						    array('$unwind' => '$tags'),
						    array(
						        '$group' => array(
						            "_id" => array("tags" => '$tags'),
						            "authors" => array('$addToSet' => '$author'),
						        ),
						    ),
						);
						$results = $c->aggregate($ops);
						echo "<br/>";
						var_dump($results);
					}
					AggregateTesting();
					function PrintDocuments(){
						$crit = array(
							"MatchInput" => array(
								"MetaData.MetaData",
								"MetaData.TimeStamp",
								"MetaData.InputID",

								"MatchInformation.MatchNumber",
								"MatchInformation.RobotAlliance",
								"MatchInformation.TeamNumber",

								"GameInformation.AUTO.RobotParking",
								"GameInformation.AUTO.ParticlesCenter",
								"GameInformation.AUTO.ParticlesCorner",
								"GameInformation.AUTO.CapBall",
								"GameInformation.AUTO.ClaimedBeacons",
								"GameInformation.DRIVER.ParticlesCenter",
								"GameInformation.DRIVER.ParticlesCorner",
								"GameInformation.END.AllianceClaimedBeacons",
								"GameInformation.END.CapBall"
								),
							"ResultsInput" => array(
								"MetaData.MetaData",
								"MetaData.TimeStamp",
								"MetaData.InputID",

								"MatchNumber",
								"Winner",
								"Score.Total.Red",
								"Score.Total.Blue",
								"Score.Penalty.Red",
								"Score.Penalty.Blue",
								"Score.Final.Red",
								"Score.Final.Blue"
								)
						);
						$cursor = $collection->find();
						foreach ($cursor as $document) {
							foreach ($crit["ResultsInput"] as $i){
								echo $i . " : " . $document[$i] . "<br />";
							}
							foreach ($crit["MatchInput"] as $i){
								echo $i . " : " . $document[$i][$i] . "<br />";
							}
						echo "<br />";
						}
					}
					function InputTeamNumberName(){
						//Team Number and Name
							$teamNumberArray = array(
								2885,
								3513,
								3650,
								3712,
								3848,
								4216,
								4262,
								4278,
								5015,
								5131,
								5135,
								5136,
								5229,
								5540,
								5828,
								6003,
								6016,
								6074,
								6137,
								6226,
								7159,
								7214,
								7542,
								7696,
								8000,
								8039,
								8097,
								8380,
								8471,
								8472,
								8605,
								8606,
								8742,
								8906,
								9022,
								9049,
								9164,
								9261,
								9266,
								9367,
								9441,
								9837,
								9892,
								9920,
								10092,
								10221,
								10390,
								10564,
								10793,
								10809,
								11107,
								11128,
								11212,
								11278,
								11285,
								11288,
								11328,
								11350,
								11411,
								11445,
								11656,
								11764,
								11840,
								11938,
								12073,
								12405,
								12406
							);
							$teamNameArray = array(
								'Kronos',
								'Domo Arigato',
								'Torrey Techies Blue',
								'Purple F.E.A.R.',
								'Shockwave',
								'Rise of Hephaestus',
								'Ridgebots',
								'De.Evolution',
								'Buffalo Wings',
								'PL Robotics',
								'Team Uncopyrightable',
								'Crusader Creators',
								'Dragons',
								'Skynet',
								'E.M.P. Chaos',
								'Techno Eagles',
								'Ironwolves',
								'R.A.W.A.L.A',
								'RoBowties',
								'Bambusa',
								'Robo Ravens',
								'The Cruzers',
								'OLP Microchicks',
								'RSF Singularity',
								'Team Paradox',
								'Return of the Adrenaline Snails',
								'Botcats',
								'UC Robotics',
								'The Ducks',
								'Robotatoes',
								'RSF Logitechies',
								'RSF Intergalactic Dragons',
								'MVMS Robotechs',
								'ROARbots',
								'T-Wrecks',
								'Robopuffs',
								'Zorrobots',
								'Level Up',
								'Pyrobots',
								'Torrey Techies White',
								'Syndicate',
								'Ravenettes',
								'EngiNERDs',
								'Furious Falcons',
								'Green.Griffins',
								'Robotx',
								'STEM Scouts',
								'iMiddle Robotics',
								'Voltrons',
								'Crow Force 5',
								'Wired Up',
								'Inspiration',
								'The Clueless',
								'Virtually Creative',
								'PATENT PENDING',
								'Seminerds',
								'Foothills Engineers',
								'Sloth Slowbotics',
								'Cherry Pi',
								'Crusader Creators #2',
								'Neutron Stars',
								'UC High Centurions',
								'MTM (Tbd)',
								'GPA Eagles',
								'The Trisectors',
								'Game of Drones',
								'Hakuna Automata'
							);
						//Accociation
						$TeamInformationArray = array();
						
						for ($row = 0; $row < count($teamNumberArray); $row++){
							$TeamInformationArray += array(
								$teamNumberArray[$row] => $teamNameArray[$row]
							);
						}
						$document = array(
							"MetaData" => array(
								"MetaData" => "TeamList"
							),
							"TeamInformation" => $TeamInformationArray
						);
						//$collection->insert($document);
					}
					function FunctionRun($functionCommand){
						echo "This is the function help line; how may I help you?<br/>";
						echo "If you're looking to toggle juicy data then type 'Juicy'<br/>";
						echo "To run InputTeamNumberName() [submits all time number names] type InputTeamNumberName <br/>";
						echo "PrintDocuments() prints stuff, come to think of it... it wont work<br/>";
						switch ($functionCommand) {
							case 'InputTeamNumberName':
								InputTeamNumberName();
								break;
							case 'Juicy':
								Juicy(true);
								break;
							default:
								echo 'SOMETHINGS WRONG? <br/>';
								break;
						}
					}
					//FunctionRun($_POST['databaseInput']);
					*/
				?>
			</div>
		</div>
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>