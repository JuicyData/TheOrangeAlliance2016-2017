<?php
	function GameObjectives($season){
		$manager = new MongoDB\Driver\Manager();
		$query = new MongoDB\Driver\Query(['MetaData.MetaData' => 'GameObjectives', 'SeasonInfo.Season' => $season]);
		$cursor = $manager->executeQuery('TheOrangeAlliance.GameObjectives', $query);
		$cursor->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);
		foreach($cursor as $document){
			return $document;
		}
		return null;
	}
	function PutItInATH($stuffToPutIn, $class = ''){
		if($class != ''){
			echo "<th class=" . $class . ">" . $stuffToPutIn . "</th>";
		}else{
			echo "<th>" . $stuffToPutIn . "</th>";
		}
	}
	function PutItInATD($stuffToPutIn, $class = ''){
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
		}
		if($isItListed == true){
			echo "<td class='pink'>" . $stuffToPutIn . "</td>";
		}else{
			if($class != ''){
				echo "<td class=" . $class . ">" . $stuffToPutIn . "</td>";
			}else{
				echo "<td>" . $stuffToPutIn . "</td>";
			}
		}
	}
	function PrintTable($table){
		foreach($table as $row){
			echo '<tr>';
			foreach($row as $value){
				PutItInATD($value);
			}
			echo '</tr>';
		}
	}
	function Growth($growth){
		$finalGrowthForm = '';
		if(abs($growth) == $growth){
			$finalGrowthForm = '+';
		}
		$finalGrowthForm .= strval(round($growth , 2));
		return $finalGrowthForm;
	}
	/*function GrowthClass($growth){
		$finalGrowthClass = '';
		if(abs($growth) == $growth){
			$finalGrowthClass = 'green';
		}
		if(abs($growth) == $growth * -1.0){
			$finalGrowthClass = 'red';
		}
		return $finalGrowthClass;
	}*/
	function MakeTheFloatHaveAPercent($value){
		$percentFormValue = $value * 100;
		$percentFormValue .= '%';
		return $percentFormValue;
	}
	function RoundValue($value){
		return round($value , 2);
	}
	function AllianceColor($alliance){
		$allianceColorClass = '';
		if($alliance == 'Red'){
			$allianceColorClass = 'red';
		}
		if($alliance == 'Blue'){
			$allianceColorClass = 'blue';
		}
		return $allianceColorClass;
	}
	function ResultsRB($resultRed, $resultBlue){
		$finalResult = '';
		$finalResult = $resultRed . '-' . $resultBlue;
		return $finalResult;
	}
	function ResultsRBClass($resultRed, $resultBlue){
		$finalResultClass = '';
		if($resultBlue > $resultRed){
			$finalResultClass = 'blue';
		}
		if($resultBlue < $resultRed){
			$finalResultClass = 'red';
		}
		if($resultBlue == $resultRed){
			$finalResultClass = 'green';
		}
		return $finalResultClass;
	}
	function RankingsTable($datePlace){
		$manager = new MongoDB\Driver\Manager();
		$query = new MongoDB\Driver\Query(['MetaData.MetaData' => 'RankingsOutput']);
		$cursor = $manager->executeQuery('TheOrangeAlliance.'.$datePlace, $query);
		$cursor->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);
		foreach($cursor as $document){
			foreach($document['Rankings'] as $rank){
				echo '<tr>';
				PutItInATD($rank['Rank']);
				PutItInATD($rank['TeamNumber']);
				PutItInATD($rank['TeamName']);
				PutItInATD($rank['RecordWin'] . '-' . $rank['RecordLose']  . '-' . $rank['RecordTie']);
				PutItInATD(RoundValue($rank['QP']));
				PutItInATD(RoundValue($rank['RP']));
				PutItInATD(RoundValue($rank['OPR']));
				PutItInATD(RoundValue($rank['CCWM']));
				//PutItInATD(Growth($rank['Growth']),GrowthClass($rank['Growth']));
				PutItInATD(RoundValue($rank['AverageAUTO']));
				PutItInATD(RoundValue($rank['AverageDRIVER']));
				PutItInATD(RoundValue($rank['AverageEND']));
				//PutItInATD(MakeTheFloatHaveAPercent(round($rank['AverageAccuracy'],4)));
				echo '</tr>';
			}
			break;
		}
	}
	function MatchHistoryTable($datePlace){
		$manager = new MongoDB\Driver\Manager();
		$query = new MongoDB\Driver\Query(['MetaData.MetaData' => 'MatchOutput']);
		$cursor = $manager->executeQuery('TheOrangeAlliance.'.$datePlace, $query);
		$cursor->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);
		foreach($cursor as $document){
			$gameObjectives = GameObjectives($document['MetaData']['Season']);
			$gameFields = $gameObjectives['DisplayOrder']['Fields'];
			echo '<thead>';
			echo '<tr>';
			PutItInATH('#');
			PutItInATH('Alliance');
			PutItInATH('Team Number');
			PutItInATH('Team Name');
			PutItInATH('Rank');
			PutItInATH('OPR*');
			PutItInATH('Result R-B');
			PutItInATH('Score');
			$gamePeriodHighlights = ['AUTO' => 'red', 'DRIVER' => 'blue', 'END' => 'green'];
			$gamePeriods = array('AUTO', 'DRIVER', 'END');
			foreach ($gamePeriods as $gamePeriod) {
				$fields = $gameFields[$gamePeriod];
				foreach ($fields as $field) {
					PutItInATH($gameObjectives['DisplayNames']['Fields'][$gamePeriod][$field], $gamePeriodHighlights[$gamePeriod]);
				}
			}
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach($document['MatchHistory'] as $matchNumber){
				foreach($matchNumber as $alliance){
					foreach($alliance as $teamNumber){
						echo '<tr>';
						PutItInATD($teamNumber['MatchNumber']);
						PutItInATD($teamNumber['Alliance'], AllianceColor($teamNumber['Alliance']));
						PutItInATD($teamNumber['TeamNumber']);
						PutItInATD($teamNumber['TeamName']);
						PutItInATD($teamNumber['TeamRank']);
						PutItInATD(RoundValue($teamNumber['OPR']));
						PutItInATD(ResultsRB($teamNumber['ResultRed'],$teamNumber['ResultBlue']), ResultsRBClass($teamNumber['ResultRed'],$teamNumber['ResultBlue']));
						PutItInATD($teamNumber['Score']);
						foreach ($gamePeriods as $gamePeriod) {
							$fields = $gameFields[$gamePeriod];
							foreach($fields as $field) {
								$fieldType = $gameObjectives['Scoring'][$gamePeriod][$field]['Type'];
								if($fieldType == 'String' || $fieldType == 'YesNo'){
									$value = $teamNumber[$gamePeriod][$field];
									PutItInATD($gameObjectives['DisplayNames']['Options'][$gamePeriod][$field][$value]);
								}else if($fieldType == 'Number'){
									PutItInATD($teamNumber[$gamePeriod][$field]);
								}
							}
						}
						echo '</tr>';
					}
				}
			}
			echo '</tbody>';
			break;
		}
	}
	function AverageScoresTable($datePlace){
		$manager = new MongoDB\Driver\Manager();
		$query = new MongoDB\Driver\Query(['MetaData.MetaData' => 'AverageScoresOutput']);
		$cursor = $manager->executeQuery('TheOrangeAlliance.'.$datePlace, $query);
		$cursor->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);
		foreach($cursor as $document){
			$gameObjectives = GameObjectives($document['MetaData']['Season']);
			$gameFields = $gameObjectives['DisplayOrder']['Fields'];
			echo '<thead>';
			echo '<tr>';
			PutItInATH('Team Number');
			PutItInATH('Team Name');
			PutItInATH('Average Score');
			$gamePeriodHighlights = ['AUTO' => 'red', 'DRIVER' => 'blue', 'END' => 'green'];
			PutItInATH('Average Auto', $gamePeriodHighlights['AUTO']);
			PutItInATH('Average Driver', $gamePeriodHighlights['DRIVER']);
			PutItInATH('Average End', $gamePeriodHighlights['END']);
			$gamePeriods = array('AUTO', 'DRIVER', 'END');
			foreach ($gamePeriods as $gamePeriod) {
				$fields = $gameFields[$gamePeriod];
				foreach ($fields as $field) {
					$fieldType = $gameObjectives['Scoring'][$gamePeriod][$field]['Type'];
					if($fieldType == 'String'){
						foreach ($gameObjectives['DisplayOrder']['Options'][$gamePeriod][$field] as $option) {
							PutItInATH($gameObjectives['DisplayNames']['Options'][$gamePeriod][$field][$option], $gamePeriodHighlights[$gamePeriod]);
						}
					}else if($fieldType == 'Number' || $fieldType == 'YesNo'){
						PutItInATH($gameObjectives['DisplayNames']['Fields'][$gamePeriod][$field], $gamePeriodHighlights[$gamePeriod]);
					}
				}
			}
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach($document['AverageScores'] as $teamNumber){
				echo '<tr>';
				PutItInATD($teamNumber['TeamNumber']);
				PutItInATD($teamNumber['TeamName']);
				//PutItInATD(MakeTheFloatHaveAPercent(RoundValue($teamNumber['AverageScores']['AverageAccuracy'])));
				PutItInATD($teamNumber['AverageScores']['AverageScore']);
				PutItInATD($teamNumber['AverageScores']['AverageAuto']);
				PutItInATD($teamNumber['AverageScores']['AverageDriver']);
				PutItInATD($teamNumber['AverageScores']['AverageEnd']);
				foreach ($gamePeriods as $gamePeriod) {
					$fields = $gameFields[$gamePeriod];
					foreach ($fields as $field) {
						$fieldType = $gameObjectives['Scoring'][$gamePeriod][$field]['Type'];
						if($fieldType == 'String'){
							foreach ($gameObjectives['DisplayOrder']['Options'][$gamePeriod][$field] as $option) {
								PutItInATD($teamNumber[$gamePeriod][$field][$option]);
							}
						}else if($fieldType == 'Number' || $fieldType == 'YesNo'){
							PutItInATD($teamNumber[$gamePeriod][$field]);
						}
					}
				}
				echo '</tr>';
			}
			echo '</tbody>';
			break;
		}
	}
?>