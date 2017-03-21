<?php
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
	function GrowthClass($growth){
		$finalGrowthClass = '';
		if(abs($growth) == $growth){
			$finalGrowthClass = 'green';
		}
		if(abs($growth) == $growth * -1.0){
			$finalGrowthClass = 'red';
		}
		return $finalGrowthClass;
	}
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
		if($alliance = 'Red'){
			$allianceColorClass = 'red';
		}
		if($alliance = 'Blue'){
			$allianceColorClass = 'blue';
		}
		return $allianceColorClass;
	}
	function RankingsTable($datePlace){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAlliance')->selectCollection($datePlace);
		$cursor = $c->find(['MetaData.MetaData' => 'RankingsOutput']);
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
				PutItInATD(Growth($rank['Growth']),GrowthClass($rank['Growth']));
				PutItInATD(RoundValue($rank['AverageAUTO']));
				PutItInATD(RoundValue($rank['AverageDRIVER']));
				PutItInATD(RoundValue($rank['AverageEND']));
				PutItInATD(MakeTheFloatHaveAPercent(round($rank['AverageAccuracy'],4)));
				echo '</tr>';
			}
		}
	}
	function MatchHistoryTable($datePlace){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAlliance')->selectCollection($datePlace);
		$cursor = $c->find(['MetaData.MetaData' => 'MatchOutput']);
		foreach($cursor as $document){
			foreach($document['MatchHistory'] as $matchNumber){
				foreach($matchNumber as $alliance){
					foreach($alliance as $teamNumber){
						echo '<tr>';
						PutItInATD($teamNumber['MatchNumber']);
						PutItInATD($teamNumber['Alliance'] ,AllianceColor($teamNumber['Alliance']));
						PutItInATD($teamNumber['TeamNumber']);
						PutItInATD($teamNumber['TeamName']);
						PutItInATD($teamNumber['TeamName']);
						echo '</tr>';
					}
				}
			}
		}
	}
	function AverageScoresTable($datePlace, $dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAlliance')->selectCollection($datePlace);
		$cursor = $c->find(['MetaData.MetaData' => 'AverageScoresOutput' ,'MetaData.InputID' => $dataValidation]);

		foreach($cursor as $document){
			PrintTable($document['AverageScores']);
		}
	}
	
?>