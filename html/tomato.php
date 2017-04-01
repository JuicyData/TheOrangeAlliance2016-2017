<?php
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
			echo "<td class='pink'>" . $stuffToPutIn . "</td>";
		}else{
		echo "<td>" . $stuffToPutIn . "</td>";
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
	function RankingsTable($datePlace, $dataValidation){
		$manager = new MongoDB\Driver\Manager();
		$query = new MongoDB\Driver\Query(['MetaData.MetaData' => 'RankingsOutput' ,'MetaData.InputID' => $dataValidation]);
		$cursor = $manager->executeQuery('TheOrangeAlliance.'.$datePlace, $query);
		$cursor->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);

		foreach($cursor as $document){
			PrintTable($document['Rankings']);
		}
	}
	function MatchHistoryTable($datePlace, $dataValidation){
		$manager = new MongoDB\Driver\Manager();
		$query = new MongoDB\Driver\Query(['MetaData.MetaData' => 'MatchOutput' ,'MetaData.InputID' => $dataValidation]);
		$cursor = $manager->executeQuery('TheOrangeAlliance.'.$datePlace, $query);
		$cursor->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);

		foreach($cursor as $document){
			PrintTable($document['MatchHistory']);
		}
	}
	function AverageScoresTable($datePlace, $dataValidation){
		$manager = new MongoDB\Driver\Manager();
		$query = new MongoDB\Driver\Query(['MetaData.MetaData' => 'AverageScoresOutput' ,'MetaData.InputID' => $dataValidation]);
		$cursor = $manager->executeQuery('TheOrangeAlliance.'.$datePlace, $query);
		$cursor->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);

		foreach($cursor as $document){
			PrintTable($document['AverageScores']);
		}
	}
?>