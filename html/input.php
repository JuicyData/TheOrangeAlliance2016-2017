<?php
	
	function PlaceID($placeFullAddress, $dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAlliance')->selectCollection('Places');
		$cursor = $c->find(['MetaData.MetaData' => 'Places', 'MetaData.InputID' => $dataValidation]);
		$placeID = 'ERROR';
		foreach($cursor as $document){
			if($document['PlaceInformation']['PlaceFullAddress'] == $placeFullAddress){
				$placeID = strval($document['PlaceInformation']['PlaceID']);
				break;
			}
		}
		return $placeID;
	}
	function TimeTime($time){
		$timeFinal = 0;
		$timeDay = 0;
		$timeMonth = 0;
		$timeYear = 0;
		$timeBad = explode('/',$time);
		$timeDay = $timeBad[1];
		$timeMonth = $timeBad[0];
		$timeYear = $timeBad[2];
		$timeFinal = '20' . $timeYear . $timeMonth . $timeDay;
		return $timeFinal;
	}
	function ValidationValue($validationKey){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAlliance')->selectCollection('DataValidation');
		$cursor = $c->find(['MetaData.MetaData' => 'ValidationKey', 'ValidationKey.KeyIdentity.Key' => $validationKey]);
		$validationKeyValue = 2;
		foreach($cursor as $document){
			$validationKeyValue = $document['ValidationKey']['KeyInformation']['KeyRank'];
			break;
		}
		return $validationKeyValue;
	}
	function InputTranslator($toTranslate){
		$translated = '';
		switch ($toTranslate){
			case 'Partially On Center Vortex':
				$translated = 'Partially Center';
				break;
			case 'Partially On Corner Vortex':
				$translated = 'Partially Corner';
				break;
			case 'Fully On Center Vortex':
				$translated = 'Fully Center';
				break;
			case 'Fully On Corner Vortex':
				$translated = 'Fully Corner';
				break;
			case 'Raised Off The Floor':
				$translated = 'Raised Off Floor';
				break;
			case 'Scored In Center Vortex':
				$translated = 'In Center Vortex';
				break;
			default:
				$translated = $toTranslate;
				break;
		}
		return $translated;
	}
	function CreateDBLog($datePlace, $data, $timeStamp, $inputID, $inputType, $dataValidation){
		$m = new MongoClient();
		$c = $m->selectDB('TheOrangeAlliance')->selectCollection('Log');
		$document = array(
			"MetaData" => array(
				"MetaData" => "LogInput",
				"TimeStamp" => 201700000000,
				"InputID" => "rainbow",
				"InputType" => "LogInput"
			),
			"Log" => array(
				"DatePlace" => $datePlace,
				"Data" => $data,
				"TimeStamp" => $timeStamp,
				"InputID" => $inputID,
				"InputType" => $inputType,
				"ArchiveFlag" => False
			)
		);
		if($datePlace != '20ERROR'){
			$c->insert($document);
		}
	}
?>