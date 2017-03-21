<?php
	//Matrix Functions
	function identity_matrix($n){
		$I = array();
		for ($i = 0; $i < $n; ++ $i) {
			for ($j = 0; $j < $n; ++ $j) {
				$I[$i][$j] = ($i == $j) ? 1 : 0;
			}
		}
		return $I;
	}
	function invert($A, $debug = FALSE){
		$n = count($A);
		// get and append identity matrix
		$I = identity_matrix($n);
		for ($i = 0; $i < $n; ++ $i) {
			$A[$i] = array_merge($A[$i], $I[$i]);
		}
		if ($debug) {
			echo "\nStarting matrix: ";
			print_matrix($A);
		}
		// forward run
		for ($j = 0; $j < $n-1; ++ $j) {
			// for all remaining rows (diagonally)
			for ($i = $j+1; $i < $n; ++ $i) {
				// if the value is not already 0
				if ($A[$i][$j] !== 0) {
					// adjust scale to pivot row
					// subtract pivot row from current
					$scalar = $A[$j][$j] / $A[$i][$j];
					for ($jj = $j; $jj < $n*2; ++ $jj) {
						$A[$i][$jj] *= $scalar;
						$A[$i][$jj] -= $A[$j][$jj];
					}
				}
			}
			if ($debug) {
				echo "\nForward iteration $j: ";
				print_matrix($A);
			}
		}
		// reverse run
		for ($j = $n-1; $j > 0; -- $j) {
			for ($i = $j-1; $i >= 0; -- $i) {
				if ($A[$i][$j] !== 0) {
					$scalar = $A[$j][$j] / $A[$i][$j];
					for ($jj = $i; $jj < $n*2; ++ $jj) {
						$A[$i][$jj] *= $scalar;
						$A[$i][$jj] -= $A[$j][$jj];
					}
				}
			}
			if ($debug) {
				echo "\nReverse iteration $j: ";
				print_matrix($A);
			}
		}
		// last run to make all diagonal 1s
		for ($j = 0; $j < $n; ++ $j) {
			if ($A[$j][$j] !== 1) {
				$scalar = 1 / $A[$j][$j];
				for ($jj = $j; $jj < $n*2; ++ $jj) {
					$A[$j][$jj] *= $scalar;
				}
			}
			if ($debug) {
				echo "\n1-out iteration $j: ";
				print_matrix($A);
			}
		}
		// take out the matrix inverse to return
		$Inv = array();
		for ($i = 0; $i < $n; ++ $i) {
			$Inv[$i] = array_slice($A[$i], $n);
		}
		return $Inv;
	}
	function print_matrix($A, $decimals = 3){
			foreach ($A as $row) {
				echo "\n\t[";
				foreach ($row as $i) {
					echo "\t" . sprintf("%01.{$decimals}f", round($i, $decimals));
				}
				echo "\t]";
			}
	}	
	//SOLID Puts Stuff In A <Td> <Td>
	function PutItInATD($stuffToPutIn){
		$HIGHLIGHTLIST = array(
			8097,
			9261,
			10809,
			'Crow Force 5',
			'Level Up',
			'Botcats'
		);
		$isItListed = false;
		foreach($HIGHLIGHTLIST as $highlight){
			if($highlight == $stuffToPutIn and gettype($stuffToPutIn) == gettype($highlight)){
				$isItListed = true;
			}
			if($highlight ){

			}
		}
		if($isItListed == true){
			echo "<td class='purple'>" . $stuffToPutIn . "</td>";
		}else{
		echo "<td>" . $stuffToPutIn . "</td>";
		}
	}
	//Transforms a liniar model into its division of 4 peridodicaly ex: 4 = 1, 5 = 1... 8 = 2
	function TrueMatchNumberTransformer($trueMatchNumber){
		return intval($trueMatchNumber / 4);
	}
	//SOLID Serches though TheOrangeAlliance.Teams to convert a team number into a team name
	function TeamNumberName($teamNumber){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Teams');
		$cursor = $c->find(['MetaData.MetaData' => 'TeamList']);
		$teamName = "TeamNamePlaceHolder";
		foreach($cursor as $document){
			$teamName = $document["TeamInformation"][strval($teamNumber)];
		}
		if($teamName == ""){
			$teamName = "NO NAME";
		}
		return  $teamName;
	}
	//SOLID Countes the amount of matches in schedule then times it by four
	function CountMatchesScheduleInputTimesFour($dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		foreach ($cursor as $document) {
			$amountOfMatchesTimesFour = count($document['Match']);
		}
		$amountOfMatchesTimesFour *= 4; 
		return $amountOfMatchesTimesFour;
	}
	//SOLID Takes in Number 1-4... Peridocically giving it 'Red1', 'Red2', 'Blue1', 'Blue2'
	function MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour){
			switch ($matchNumberInFour % 4) {
				case 1 % 4:
					$interpertedMatchNumberInFour = 'Red1';
					break;
				case 2 % 4:
					$interpertedMatchNumberInFour = 'Red2';
					break;
				case 3 % 4:
					$interpertedMatchNumberInFour = 'Blue1';
					break;
				case 4 % 4:
					$interpertedMatchNumberInFour = 'Blue2';
					break;
				default:
					$interpertedMatchNumberInFour = 'Pink';
					break;
			}
		return $interpertedMatchNumberInFour;
	}
	//SOLID Changes Red1 ... Blue2 into Red ... Blue and adds class='red' HAS ITS OWN TD AND ECHO 
	function AllianceColorNumberInterperterToColor($allianceColorNumber){
		switch ($allianceColorNumber) {
			case 'Red1':
				$interpertedAllianceColor = '<td class="red">Red</td>';
				break;
			case 'Red2':
				$interpertedAllianceColor = '<td class="red">Red</td>';
				break;
			case 'Blue1':
				$interpertedAllianceColor = '<td class="blue">Blue</td>';
				break;
			case 'Blue2':
				$interpertedAllianceColor = '<td class="blue">Blue</td>';
				break;
			default:
				$interpertedAllianceColor = '<td class="pink">Pink</td>';
				break;
		}
		echo $interpertedAllianceColor;
	}
	// Calculates RP from Data in Input Data outputs int
	function CalculatesRPFromData($dataValidation, $matchNumberInFour){
		$r = new MongoClient();
		$t = $r->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursort = $t->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$currentTeamForRP = 0;
			foreach($cursort as $document){
				$currentTeamForRP = $document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)];
			}
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'MatchInput', 'MatchInformation.MatchNumber' => TrueMatchNumberTransformer($matchNumberInFour + 3) , 'MatchInformation.TeamNumber' => $currentTeamForRP]);
		//To calculate RP via their gameplay
			$checkIfItWorked = 0;
			foreach($cursor as $document){
				$checkIfItWorked++;
				//AUTO
					$AUTORP = 0;
					//RobotParking
					switch($document["GameInformation"]["AUTO"]["RobotParking"]){
						case "Did Not Park":
							$AUTORP += 0;
						break;
						case "Partially On Center Vortex":
							$AUTORP += 5;
						break;
						case "Partially On Corner Vortex":
							$AUTORP += 5;
						break;
						case "Fully On Center Vortex":
							$AUTORP += 10;
						break;
						case "Fully On Corner Vortex":
							$AUTORP += 10;
						break;
						default:
							$AUTORP += 9000;
					}
					//Particles In Center
					$AUTORP += 15 * $document["GameInformation"]["AUTO"]["ParticlesCenter"];
					//Particles In Corner
					$AUTORP += 5 * $document["GameInformation"]["AUTO"]["ParticlesCorner"];
					//CapBall
					switch($document["GameInformation"]["AUTO"]["CapBall"]){
						case "No":
							$AUTORP += 0;
						break;
						case "Yes":
							$AUTORP += 5;
						break;
						default:
							$AUTORP += 9000;
					}
					//Beacons
					$AUTORP += 30 * $document["GameInformation"]["AUTO"]["ClaimedBeacons"];
				//DRIVER
					$DRIVERRP = 0;
					//Particles In Center
					$DRIVERRP += 5 * $document["GameInformation"]["DRIVER"]["ParticlesCenter"];
					//Particles In Corner
					$DRIVERRP += 1 * $document["GameInformation"]["DRIVER"]["ParticlesCorner"];
				//END
					$ENDRP = 0;
					//Allaince Calimed Beacons
					$ENDRP += 10 * $document["GameInformation"]["END"]["AllianceClaimedBeacons"];
					switch($document["GameInformation"]["END"]["CapBall"]){
						case "On The Ground":
							$ENDRP += 0;
						break;
						case "Raised Off The Floor":
							$ENDRP += 10;
						break;
						case "Raised Above Vortex":
							$ENDRP += 20;
						break;
						case "Scored In Center Vortex":
							$ENDRP += 40;
						break;
						default:
							$AUTORP += 9000;
					}
				}
			$calcRP = $AUTORP + $DRIVERRP + $ENDRP;
			if($checkIfItWorked == 0){
				$calcRP = '';
			}
		return $calcRP;
	}
	// Does all the Match Number Aliance Team Number Team Name For Match History
	function MatchHistoryMatchAllianceTeam($dataValidation , $matchNumberInFour){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		foreach($cursor as $document){
			PutItInATD(TrueMatchNumberTransformer($matchNumberInFour + 3));
			AllianceColorNumberInterperterToColor(MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour));
			PutItInATD($document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)]);
			PutItInATD(TeamNumberName($document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3)][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)]));
		}
	}
	// Does All the Results into format HAS ITS DOWN TD and ECHO
	function MatchHistoryResults($matchNumberInFour){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput' , 'MatchNumber' => TrueMatchNumberTransformer($matchNumberInFour + 3)]);
		$matchHistoryResultsFormated = '<td ';	
		foreach($cursor as $document){
			switch ($document['Winner']) {
				case 'Red':
					$matchHistoryResultsFormated .= 'class="red">';
					break;
				case 'Blue':
					$matchHistoryResultsFormated .= 'class="blue">';
					break;
				case 'Tie':
					$matchHistoryResultsFormated .= 'class="green">';
					break;
				default:
					$matchHistoryResultsFormated .= 'class="pink">';
					break;
			}
			$matchHistoryResultsFormated .= $document['Score']['Final']['Red'] . "-" . $document['Score']['Final']['Blue'] . '</td>';
		}
		if(is_null($document['Score']['Final']['Red']) or is_null($document['Score']['Final']['Blue'])){
			$matchHistoryResultsFormated = "<td class='pink'> NOT POSTED </td>";
		}
		echo $matchHistoryResultsFormated;
	}
	function MatchHistoryGameScoreTranslator($toTranslate){
		$translation = $toTranslate;
		$translationArray = array(
			'Untranslated' => array(
				'Partially On Corner Vortex',
				'Partially On Center Vortex',
				'Fully On Center Vortex',
				'Fully on Corner Vortex',
				'On The Ground',
				'Raised Off The Floor',
				'Scored In Center Vortex'
			),
			'Translated' => array(
				'Partially Corner',
				'Partially Center',
				'Fully Center',
				'Fully Corner',
				'Floor',
				'Raised',
				'Center'
			)
		);
		for($translationUnit = 0; $translationUnit <= count($translationArray['Untranslated']); $translationUnit++){
			if($toTranslate == $translationArray['Untranslated'][$translationUnit]){
				$translation = $translationArray['Translated'][$translationUnit];
				break;
			}
		}
		return $translation;
	}
	// Does The RP and all the game speificic stuff from input Data
	function MatchHistoryGameScore($dataValidation,$matchNumberInFour){
		$r = new MongoClient();
		$t = $r->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursort = $t->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$currentTeamForRP = 0;
			foreach($cursort as $document){
				$currentTeamForRP = $document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)];
			}
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'MatchInput', 'MatchInformation.MatchNumber' =>  TrueMatchNumberTransformer($matchNumberInFour + 3) , 'MatchInformation.TeamNumber' => $currentTeamForRP ]);

		$checkIfItWorked = 0;
		PutItInATD(CalculatesRPFromData($dataValidation, $matchNumberInFour));
		foreach($cursor as $document){
			$checkIfItWorked++;
			PutItInATD(MatchHistoryGameScoreTranslator($document["GameInformation"]["AUTO"]["RobotParking"]));
			PutItInATD($document["GameInformation"]["AUTO"]["ParticlesCenter"]);
			PutItInATD($document["GameInformation"]["AUTO"]["ParticlesCorner"]);
			PutItInATD($document["GameInformation"]["AUTO"]["CapBall"]);
			PutItInATD($document["GameInformation"]["AUTO"]["ClaimedBeacons"]);
			PutItInATD($document["GameInformation"]["DRIVER"]["ParticlesCenter"]);
			PutItInATD($document["GameInformation"]["DRIVER"]["ParticlesCorner"]);
			PutItInATD($document["GameInformation"]["END"]["AllianceClaimedBeacons"]);
			PutItInATD(MatchHistoryGameScoreTranslator($document["GameInformation"]["END"]["CapBall"]));
		}
		if($checkIfItWorked == 0 ){
			for($i=1; $i <= 9 ; $i++) { 
				PutItInATD("");
			}
		}
	}
	// Removes a Match Hostyr Match Input fullfilling criteria
	function RemoveMatchHistoryMatchInput($dataValidation,$matchNumberInFour){
		$r = new MongoClient();
		$t = $r->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursort = $t->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$currentTeamForRP = 0;
			foreach($cursort as $document){
				$currentTeamForRP = $document['Match']['Match' . TrueMatchNumberTransformer($matchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($matchNumberInFour)];
			}
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$c->remove(['MetaData.MetaData' => 'MatchInput', 'MatchInformation.MatchNumber' => TrueMatchNumberTransformer($matchNumberInFour + 3) , 'MatchInformation.TeamNumber' => $currentTeamForRP]);
	}
	//Puts Together all the Functions to make up all of Match History
	function MatchHistoryTable(){
		$DATAVALIDATION = 'rainbow';
		
		for($currentMatchNumberInFour = 1; $currentMatchNumberInFour <= CountMatchesScheduleInputTimesFour($DATAVALIDATION); $currentMatchNumberInFour++){
			echo "<tr>";
			MatchHistoryMatchAllianceTeam($DATAVALIDATION,$currentMatchNumberInFour);
			MatchHistoryResults($currentMatchNumberInFour);
			MatchHistoryGameScore($DATAVALIDATION,$currentMatchNumberInFour);
			echo "</tr>";
		}	
	}
	//Puts Together all the Functions to make up all of Match History ALTERNATE FOR ADMIN
	function MatchHistoryTableAdmin($removeValue){
		$DATAVALIDATION = 'rainbow';
		for($currentMatchNumberInFour = 1; $currentMatchNumberInFour <= CountMatchesScheduleInputTimesFour($DATAVALIDATION); $currentMatchNumberInFour++){
			echo "<tr>";
			MatchHistoryMatchAllianceTeam($DATAVALIDATION,$currentMatchNumberInFour);
			MatchHistoryResults($currentMatchNumberInFour);
			MatchHistoryGameScore($DATAVALIDATION,$currentMatchNumberInFour);
			PutItInATD('<input class="btn btn-primary raised" type="submit" value=": 3">');
			echo "</tr>";
		}
		RemoveMatchHistoryMatchInput($DATAVALIDATION,$removeValue);
	}
	// Generates a Unique List from a un unique list 
	function GenerateUniqueList($ununiqueList){
		$uniqueList = array();
		foreach($ununiqueList as $ununique){
			$checkIfUnique = false;
			foreach($uniqueList as $unique){ 
				if($unique == $ununique){
					$checkIfUnique = true;
				}
			}
			if($checkIfUnique == false){
				$uniqueList[count($uniqueList)] = $ununique;
			}			
		}
		return $uniqueList;
	}
	//Generates a unique list of teams from data Validation
	function UniqueTeamList($dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$ununiqueTeamList = array();
		for($currentMatchNumberInFour = 1; $currentMatchNumberInFour <= CountMatchesScheduleInputTimesFour($dataValidation); $currentMatchNumberInFour++){
			foreach($cursor as $document){
				$ununiqueTeamList[count($ununiqueTeamList)] = $document['Match']['Match' . TrueMatchNumberTransformer($currentMatchNumberInFour + 3) ][MatchNumberInFourToInterpertAsAllianceNumber($currentMatchNumberInFour)];
			}
		}
		return GenerateUniqueList($ununiqueTeamList);
	}
	//Makes an array of the matches that team played
	function WhichMatchesDidThatTeamPlayAndWhatAlliance($dataValidation, $teamToSearchFor){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$matchesPlayedByThatTeamAndAlliance = array();
		$redRedCombination = array(
			'Red1',
			'Red2'
		);
		$blueBlueCombination = array(
			'Blue1',
			'Blue2'
		);
		foreach($cursor as $document){
			for($matchNumber = 1; $matchNumber <= CountMatchesScheduleInputTimesFour($dataValidation)/4; $matchNumber++){
				foreach($redRedCombination as $currentColorRed){
					if($document['Match']['Match' . $matchNumber][$currentColorRed] == $teamToSearchFor){
						$matchesPlayedByThatTeamAndAlliance['Red'][count($matchesPlayedByThatTeamAndAlliance['Red'])] = $matchNumber;
					}
				}
				foreach($blueBlueCombination as $currentColorBlue){
					if($document['Match']['Match' . $matchNumber][$currentColorBlue] == $teamToSearchFor){
						$matchesPlayedByThatTeamAndAlliance['Blue'][count($matchesPlayedByThatTeamAndAlliance['Blue'])] = $matchNumber;
					}
				}
			}
		}
		return $matchesPlayedByThatTeamAndAlliance;
	}
	//Will Count and Complie whic teams ahd waht record they have
	function RankingsTableRecord($dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput' ,'MetaData.InputID' => $dataValidation]);

		$listOfTeamsToRank = UniqueTeamList($dataValidation);
		$listOfTeamsRecords = array();
		$allianceColors = array(
			'Red',
			'Blue'
			);
		foreach($listOfTeamsToRank as $teamToRank){
			$teamToRankWins = 0;
			$teamToRankLoss = 0;
			$teamToRankTie = 0;
			$matchesThatTeamPlayedWithAlliance = WhichMatchesDidThatTeamPlayAndWhatAlliance($dataValidation, $teamToRank);
			foreach($allianceColors as $allianceColor){
				foreach($matchesThatTeamPlayedWithAlliance[$allianceColor] as $matchThatTeamPlayed){
					foreach($cursor as $document){
						if($document['MatchNumber'] == $matchThatTeamPlayed and $document['Winner'] == $allianceColor){
							$teamToRankWins++;
						}
						if($document['MatchNumber'] == $matchThatTeamPlayed and $document['Winner'] != $allianceColor and $document['Winner'] != 'Tie'){
							$teamToRankLoss++;
						}
						if($document['MatchNumber'] == $matchThatTeamPlayed and $document['Winner'] == 'Tie'){
							$teamToRankTie++;
						}
					}
				}
			}
			$listOfTeamsRecords['TeamNumber' . $teamToRank] = array(
				'TeamNumber' => $teamToRank,
				'Wins' => $teamToRankWins,
				'Loss' => $teamToRankLoss,
				'Tie' => $teamToRankTie,
				'GamesPlayed' => $teamToRankWins + $teamToRankLoss + $teamToRankTie,
				'Present' => $teamToRankWins . '-' . $teamToRankLoss . '-' . $teamToRankTie,
				'QP' => ($teamToRankWins * 2) + ($teamToRankTie)
			);
		}
		return $listOfTeamsRecords;

			/*
								$gate = array(
									array(
										'match' => array(
										)
									)
								);

								$mei = $c->aggregate();
								
								//$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput']);
								
								$cursor = $c->aggregateCursor(
									[	
										['$group' => ['_id' => '$MatchNumber', 'points' =>['$sum' => '$Score']]],
										['$sort' => ['points' => -1]]
									]
								);
								PutItInATD($cursor['_id']['points']);
								//foreach($cursor as $thing){
									//PutItInATD('hi');
									//PutItInATD({$thing['_id']}:{$thing['points']}\n);
								//}
								
								
						$ops = array(
						    array(

						    	'$match' => array(
						    		'MetaData.MetaData' => 'ResultsInput'
						    	)
						    ),
						    
						    array(
						    	
						        '$project' => array(
						            "Score.Total.Red" => 1,
						            '_id' => 0
						        )
						    )
						    
						    array('$unwind' => '$MetaData'),
						    array(
						        '$group' => array(
						            "_id" => array("MetaData" => '$MetaData'),
						            "authors" => array('$addToSet' => '$author'),
						        ),
						    ),
						    
						);
						$results = $c->aggregate($ops);
						$c->insert($results);
							
						
						foreach($results as $pump){
							echo $pump; 
							echo '<br/><br/><br/><br/><br/><br/><br/>';
							var_dump($pump);
						}
						
						//var_dump($results);
		*/
	}
	function MatchNumberAndRP($dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ResultsInput' ,'MetaData.InputID' => $dataValidation]);
		$matchNumberAndRP = array();
		foreach($cursor as $document){
			if('Red' == $document['Winner']){
				$matchNumberAndRP['MatchNumber' . $document['MatchNumber']] = $document['Score']['Total']['Blue'];
			}
			if('Blue' == $document['Winner']){
				$matchNumberAndRP['MatchNumber' . $document['MatchNumber']] = $document['Score']['Total']['Red'];
			}
			if('Tie' == $document['Winner']){
				$matchNumberAndRP['MatchNumber' . $document['MatchNumber']] = $document['Score']['Total']['Red'];
			}
		}
		return $matchNumberAndRP;
	}
	function RankingsTableRP($dataValidation, $teamToSearchFor){
		$matchesTeamPlayedInWithAlliance = WhichMatchesDidThatTeamPlayAndWhatAlliance($dataValidation, $teamToSearchFor);
		$matchNumberAndRP = MatchNumberAndRP($dataValidation);
		$teamRP = 0;
		foreach($matchesTeamPlayedInWithAlliance as $matchTeamPlayed){
			foreach($matchTeamPlayed as $matchTeam){
				$teamRP += $matchNumberAndRP['MatchNumber' . $matchTeam];
			}
		}
		return $teamRP;
	}
	//Enters Example data into the mongodb if no example data is detected
	function EnsureExampleData(){
		$DATAVALIDATION = 'rainbow';
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $DATAVALIDATION]);
		$checkForExample = false;
		$EXMAPLEDATA = array(
			array(
				'MetaData' => array(
					'MetaData' => 'ScheduleInput',
					'TimeStamp' => 'EXAMPLEDATA!!!!',
					'InputID' => 'rainbow'
				),
				'Match' => array(
					'Match1' => array(
						'Red1' => 6226,
						'Red2' => 8097,
						'Blue1' => 5229,
						'Blue2' => 11107
					),
					'Match2' => array(
						'Red1' => 11107,
						'Red2' => 6226,
						'Blue1' => 8097,
						'Blue2' => 5229
					),
					'Match3' => array(
						'Red1' => 5229,
						'Red2' => 11107,
						'Blue1' => 6226,
						'Blue2' => 8097
					),
					'Match4' => array(
						'Red1' => 8097,
						'Red2' => 5229,
						'Blue1' => 11107,
						'Blue2' => 6226
					)
				)
			),
			array(
				'MetaData' => array(
					'MetaData' => 'ResultsInput',
					'TimeStamp' => 'EXAMPLEDATA',
					'InputID' => 'rainbow'
				),
				'MatchNumber' => 1,
				'Winner' => 'Blue',
				'Score' => array(
					'Total' => array(
						'Red' => 12,
						'Blue' => 23
						),
					'Penalty' => array(
						'Red' => 0,
						'Blue' => 0
						),
					'Final' => array(
						'Red' => 12,
						'Blue' => 23
						)
				)
			),
			array(
				'MetaData' => array(
					'MetaData' => 'ResultsInput',
					'TimeStamp' => 'EXAMPLEDATA',
					'InputID' => 'rainbow'
				),
				'MatchNumber' => 4,
				'Winner' => 'Blue',
				'Score' => array(
					'Total' => array(
						'Red' => 40,
						'Blue' => 90
						),
					'Penalty' => array(
						'Red' => 0,
						'Blue' => 0
						),
					'Final' => array(
						'Red' => 40,
						'Blue' => 90
						)
				)
			)
		);
		foreach($cursor as $document){
			if($document['MetaData']['InputID'] == $DATAVALIDATION){
				$checkForExample = true;
			}
		}
		if($checkForExample == false){
			foreach($EXMAPLEDATA as $data){
				$c->insert($data);
			}
		}
	}
	//Will remove non validated datapoints atuomatically
	function PurgeOfTheNonValidations($DATAVALIDATION){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find();
		$toAggregate = array(
			array(
				'project' => array(
					'invalid' => array(
						'$ne' => array(
							'$MetaData.MetaData' => 'rainbow'
						)
					)
				)
			)
		);
		$notValid = $cursor->aggregate($toAggregate);
		foreach($notValid as $document){
			if($document['invalid'] == true){
			}
		}
	}
	//Determines the rank of a certain team returns as array of teams and their rank
	function RankingsRank($dataValidation){
		$uniqueTeamList = UniqueTeamList($dataValidation);
		$rankingsTableRecordInstance = RankingsTableRecord($dataValidation);
		$teamRanksScore = array();
		$teamRanks = array();
		$teamRank = 0;
		foreach($uniqueTeamList as $uniqueTeam){
			$teamRanksScore['Team' . $uniqueTeam] = $rankingsTableRecordInstance['TeamNumber' . $uniqueTeam]['QP'] * 1000 + RankingsTableRP($dataValidation, $uniqueTeam);
		}
		foreach($uniqueTeamList as $uniqueTeam){
			$teamRank = 1;
			foreach($uniqueTeamList as $uniqueTeam1){
				if($teamRanksScore['Team' . $uniqueTeam] < $teamRanksScore['Team' . $uniqueTeam1]){
					$teamRank++;
				}
			}
			$teamRanks['Team' . $uniqueTeam] = $teamRank;
		}
		return $teamRanks;
	}
	function OPRTestingInput(){

		$THEMATRIX = array(
			array(1,2,2),
			array(1,4,3),
			array(7,2,5)
		);

		echo "<tr>";
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
		echo "</tr>";

		return $THEMATRIX;
	}
	function MatrixMultiplication($a, $b){

		echo 'A::::::: <br />';
		MatrixPrint($a);
		echo 'A::::::: <br />';
		echo 'B::::::: <br />';
		MatrixPrint($b);
		echo 'B::::::: <br />';

		$r=count($a);
		$c=count($b[0]);
		$p=count($b);
		if(count($a[0]) != $p){
		    echo "Incompatible matrices";
		    exit(0);
		}
		$result=array();
		for ($i=0; $i < $r; $i++){
		    for($j=0; $j < $c; $j++){
		        $result[$i][$j] = 0.0;
		        for($k=0; $k < $p; $k++){
		            $result[$i][$j] += $a[$i][$k] * $b[$k][$j];
		        }
		    }
		}
		return $result;
	}
	function OPRTestingInverse(){
		
		$a = Array( Array(1,2),Array(4,5));
		$b = Array( Array(7,5), Array(3,2));

		$r=count($a);
		$c=count($b[0]);
		$p=count($b);
		if(count($a[0]) != $p){
		    echo "Incompatible matrices";
		    exit(0);
		}
		$result=array();
		for ($i=0; $i < $r; $i++){
		    for($j=0; $j < $c; $j++){
		        $result[$i][$j] = 0;
		        for($k=0; $k < $p; $k++){
		            $result[$i][$j] += $a[$i][$k] * $b[$k][$j];
		        }
		    }
		}
		print_r($result);



		$A = array(
			array(1,2,2),
			array(1,4,3),
			array(7,2,5)
		);
		echo "\nMatrix:";
		print_matrix($A);
		echo "\n";
		$B = invert($A);
		echo "\nInversion result:";
		print_matrix($B);
		echo "\n\n";

		$THEMATRIX = array(
			array(1,2,2),
			array(1,4,3),
			array(7,2,5)
		);

		echo "<tr>";
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
			PutItInATD('hi');
		echo "</tr>";
	}
	function TeamMatchups($dataValidation, $allianceSet){
		$teamMatchupsList = array();
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAllianceTest')->selectCollection('Y201701211');
		$cursor = $c->find(['MetaData.MetaData' => 'ScheduleInput' ,'MetaData.InputID' => $dataValidation]);
		$allianceColors = array(
				'Red',
				'Blue'
		);
		foreach($cursor as $document){
			foreach($document['Match'] as $match){
				foreach($allianceColors as $allianceColor){
					$teamMatchupsList[count($teamMatchupsList)] = $match[$allianceColor . $allianceSet];
				}
			}	
		}
		return $teamMatchupsList;
	}
	function RankingsOPRMatchesMatrix($dataValidation){
		$rankingsOPRMatchesMatrix = array();
		$uniqueTeamList = UniqueTeamList($dataValidation);
		$teamMatchups1 = TeamMatchups($dataValidation, 1);
		$teamMatchups2 = TeamMatchups($dataValidation, 2);
		for($columns = 0; $columns < count($uniqueTeamList) ; $columns++){
			for($rows = 0; $rows < count($uniqueTeamList); $rows++){
				$rankingsOPRMatchesMatrix[$rows][$columns] = 0;
				if($columns == $rows){
					foreach($teamMatchups1 as $teamMatch1){
						if($uniqueTeamList[$rows] == $teamMatch1){
							$rankingsOPRMatchesMatrix[$rows][$columns]++;
						}
					}
					foreach($teamMatchups2 as $teamMatch2){
						if($uniqueTeamList[$columns] == $teamMatch2){
							$rankingsOPRMatchesMatrix[$rows][$columns]++;
						}
					}
				}else{
					for($teamIndex = 0; $teamIndex <= count($teamMatchups1) ; $teamIndex++){
						if($uniqueTeamList[$columns] == $teamMatchups1[$teamIndex] and $teamMatchups2[$teamIndex] == $uniqueTeamList[$rows] ){
							$rankingsOPRMatchesMatrix[$rows][$columns]++;
						}
					}
					for($teamIndex = 0; $teamIndex <= count($teamMatchups1) ; $teamIndex++){
						if($uniqueTeamList[$columns] == $teamMatchups2[$teamIndex] and $teamMatchups1[$teamIndex] == $uniqueTeamList[$rows] ){
							$rankingsOPRMatchesMatrix[$rows][$columns]++;
						}
					}
				}
			}
		}
		return $rankingsOPRMatchesMatrix;
	}
	function MatrixPrint($matrix){
		for($rows = 0; $rows <= 30; $rows++){
			for($columns = 0; $columns <= 30; $columns++){
				echo  ' ' . $matrix[$rows][$columns] . ' ';
			}
			echo '<br />';
		}
	}
	//Dose all the OPR for rankings table
	function MatrixRankingsOPR($dataValidation){
		$listOfUniqueTeams = UniqueTeamList($dataValidation);
		$teamRPList = array();
		for($uniqueTeamIndex = 0; $uniqueTeamIndex < count($listOfUniqueTeams); $uniqueTeamIndex++){
			$teamToSearchFor = $listOfUniqueTeams[$uniqueTeamIndex];
			$teamRPList[$uniqueTeamIndex] = RankingsTableRP($dataValidation, $teamToSearchFor);
		}
		return $teamRPList;
	}
	function matrix_inverse($m1)
		{
		    $rows = $this->rows($m1);
		    $cols = $this->columns($m1);
		    if ($rows != $cols)
		    {
		        die("Matrim1 is not square. Can not be inverted.");
		    }

		    $m2 = $this->eye($rows);

		    for ($j = 0; $j < $cols; $j++)
		    {
		        $factor = $m1[$j][$j];
		        if ($this->debug)
		        {
		            fms_writeln('Divide Row [' . $j . '] by ' . $m1[$j][$j] . ' (to
		                                                  give us a "1" in the desired position):');
		        }
		        $m1 = $this->rref_div($m1, $j, $factor);
		        $m2 = $this->rref_div($m2, $j, $factor);
		        if ($this->debug)
		        {
		            $this->disp2($m1, $m2);
		        }
		        for ($i = 0; $i < $rows; $i++)
		        {
		            if ($i != $j)
		            {
		                $factor = $m1[$i][$j];
		                if ($this->debug)
		                {
		                    $this->writeln('Row[' . $i . '] - ' . number_format($factor, 4) . ' ×
		                                                Row[' . $j . '] (to give us 0 in the desired position):');
		                }
		                $m1 = $this->rref_sub($m1, $i, $factor, $j);
		                $m2 = $this->rref_sub($m2, $i, $factor, $j);
		                if ($this->debug)
		                {
		                    $this->disp2($m1, $m2);
		                }
		            }
		        }
		    }
		    return $m2;
		}
	function RankingsMatrixOPR($dataValidation){
		$listOfTeamsRPInOrder = MatrixRankingsOPR($dataValidation);
		echo 'Let 1 <br />';
		$matrixOfMatchesAndTeams = RankingsOPRMatchesMatrix($dataValidation);
		echo 'Let 2 <br />';
		echo 'LETUS';
		MatrixPrint($matrixOfMatchesAndTeams);
		$invertMatrixOfMatches = invert($matrixOfMatchesAndTeams);
		echo 'Let 3 <br />';

		MatrixPrint($invertMatrixOfMatches);
		echo 'RPS!#!#!#!#!#!#!#!##!#: ';
		$invertMatrixOfMatches = matrix_inverse($matrixOfMatchesAndTeams);
		echo 'Let 3!#!#!#!#!#!# <br />';

		MatrixPrint($invertMatrixOfMatches);
		echo 'RPSR%^&^%$#$%^$: ';
		foreach($listOfTeamsRPInOrder as $n){
			echo  $n . ' <br />';
		}
		$listOfTeamsRPInOrderAsFloat = array();
		foreach($listOfTeamsRPInOrder as $teamAndRP){
			$listOfTeamsRPInOrderAsFloat[$teamAndRP] = $listOfTeamsRPInOrder[$teamAndRP] * 1.0;
		}


		$resultingMatrix = MatrixMultiplication($invertMatrixOfMatches, $listOfTeamsRPInOrder);
		echo 'Let 4 <br />';
		$matrixOPR = array();
		for($matrixIndex = 0; $matrixIndex <= count($listOfTeamsRPInOrder); $matrixIndex++){
			$team = $listOfTeamsRPInOrder[$matrixIndex];
			$matrixOPR[$team] = $resultingMatrix[$matrixIndex];
		}
		echo 'RankingsMatrixOPR before return';
		foreach($matrixOPR as $ex){
			echo '$ex: ' . $ex . '<br />';
			foreach($ex as $er){
				echo '$er: ' . $er . '<br />';
			}
		}
		echo $matrixOPR;
		return $matrixOPR;
	}
	//The Table Ranking For all of Rankings
	function RankingsTable(){
		$DATAVALIDATION = 'rainbow';
		$uniqueTeamListInstance = UniqueTeamList($DATAVALIDATION);
		$rankingsTableRecordInstance = RankingsTableRecord($DATAVALIDATION);
		$rankingsRank = RankingsRank($DATAVALIDATION);

		foreach($uniqueTeamListInstance as $uniqueTeam){		
			echo "<tr>";
			PutItInATD($rankingsRank['Team' . $uniqueTeam]);
			PutItInATD($uniqueTeam);
			PutItInATD(TeamNumberName($uniqueTeam));
			PutItInATD($rankingsTableRecordInstance['TeamNumber' . $uniqueTeam]['Present']);
			PutItInATD($rankingsTableRecordInstance['TeamNumber' . $uniqueTeam]['QP']);
			PutItInATD(RankingsTableRP($DATAVALIDATION, $uniqueTeam));
			PutItInATD('testing');
			echo "</tr>";
		}
		//EnsureExampleData();
	}
	function RankingsTable1(){
		$DATAVALIDATION = 'rainbow';
		$uniqueTeamListInstance = UniqueTeamList($DATAVALIDATION);
		$rankingsTableRecordInstance = RankingsTableRecord($DATAVALIDATION);
		$rankingsRank = RankingsRank($DATAVALIDATION);
		//$OPRMatrix = RankingsOPRMatchesMatrix($DATAVALIDATION);
		//MatrixPrint($OPRMatrix);
		echo 'Before Matris OPR $RankingsMatrixOPR($DATAVALIDATION) ' . '<br />';
		$matrixOPR = RankingsMatrixOPR($DATAVALIDATION);
		echo 'Matrix print before' . '<br />';
		echo 'PRINTMARIS HERE '. '<br />';
		MatrixPrint($matrixOPR);
		echo  '<br />' . 'PRINTMARIS BEFORE HERE HERE '. '<br />';
		echo 'Matrix total RP' . '<br />';
		$temp = MatrixRankingsOPR($DATAVALIDATION);
		//echo MatrixPrint($temp);
		foreach($temp as $qwe){
			echo $qwe . '<br />';
		}
		foreach($uniqueTeamListInstance as $uniqueTeam){
			echo "<tr>";
			//PutItInATD($rankingsRank['Team' . $uniqueTeam]);
			//PutItInATD($uniqueTeam);
			//PutItInATD(TeamNumberName($uniqueTeam));
			//PutItInATD($rankingsTableRecordInstance['TeamNumber' . $uniqueTeam]['Present']);
			//PutItInATD($rankingsTableRecordInstance['TeamNumber' . $uniqueTeam]['QP']);
			//PutItInATD(RankingsTableRP($DATAVALIDATION, $uniqueTeam));
			PutItInATD($uniqueTeam);
			PutItInATD($matrixOPR[$uniqueTeam]);
			echo "</tr>";
		}
		//EnsureExampleData();
	}
?>