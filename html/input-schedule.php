<!DOCTYPE html>
<html>
	<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "css/styles.css" rel = "stylesheet" type="text/css">
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
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js-webshim/minified/polyfiller.js"></script>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="nav-brand" href="http://theorangealliance.tk:8080/"> 
					<img style="max-width:50px" src="/images/logo.png"> 
					<span class="logo hidden-xs">The Orange Alliance</span>
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
						<li ><a href = "http://theorangealliance.tk:8080/">Home</a></li>
						<li><a href = "http://theorangealliance.tk:8080/events/velocity-vortex.php">Events</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-data.php">Input Data</a></li>
						<li><a href = "http://theorangealliance.tk:8080/input-results.php">Input Results</a></li>
						<li class = "active"><a href = "http://theorangealliance.tk:8080/input-schedule.php">Input Schedule</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<form action="input-schedule.php" method="post">
		<div class="content">
		<div class="container">
			<h1>Input Schedule</h1>
			<hr></hr>
			<table class="table table-striped table-bordered">
			<tr>
				<th colspan="2">Event Information</th>
			</tr>
			<tr>
				<td>Event Date</td>
				<td><select class="form-control" id="inputID" name="matchDate" required>
						<option>02/25/17</option>
					</select>
				</td>
				
			</tr>
				<td>Event Location</td>
					<td><select class="form-control" id="inputID" name="matchPlace" required>
						<option>6501 Linda Vista Rd, San Diego, CA 92111</option>
					</select>
					</td>
				<tr>
					<td>Validation Code</td>
					<td ><input type="text" class="form-control" id="inputID" name="dataValidation" required></td>
				</tr>
			</table>
			
			<table id="inputTable" class="table table-striped table-bordered">
				<tr>
					<th>Match Number</th>
					<th>Red 1 </th>
					<th>Red 2</th>
					<th>Blue 1</th>
					<th>Blue 2</th>
				</tr>
				<tr>
					<td>1</td>
					<td class="red"><input type="number" class="form-control" name="1red1" required></td>
					<td class="red"><input type="number" class="form-control" name="1red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="1blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="1blue2" required></td>
				</tr>
				<tr>
					<td>2</td>
					<td class="red"><input type="number" class="form-control" name="2red1" required></td>
					<td class="red"><input type="number" class="form-control" name="2red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="2blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="2blue2" required></td>
				</tr>
				<tr>
					<td>3</td>
					<td class="red"><input type="number" class="form-control" name="3red1" required></td>
					<td class="red"><input type="number" class="form-control" name="3red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="3blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="3blue2" required></td>
				</tr>
				<tr>
					<td>4</td>
					<td class="red"><input type="number" class="form-control" name="4red1" required></td>
					<td class="red"><input type="number" class="form-control" name="4red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="4blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="4blue2" required></td>
				</tr>
				<tr>
					<td>5</td>
					<td class="red"><input type="number" class="form-control" name="5red1" required></td>
					<td class="red"><input type="number" class="form-control" name="5red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="5blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="5blue2" required></td>
				</tr>
				<tr>
					<td>6</td>
					<td class="red"><input type="number" class="form-control" name="6red1" required></td>
					<td class="red"><input type="number" class="form-control" name="6red2" required ></td>
					<td class="blue"><input type="number" class="form-control" name="6blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="6blue2" required></td>
				</tr>
				<tr>
					<td>7</td>
					<td class="red"><input type="number" class="form-control" name="7red1" required></td>
					<td class="red"><input type="number" class="form-control" name="7red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="7blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="7blue2" required></td>
				</tr>
				<tr>
					<td>8</td>
					<td class="red"><input type="number" class="form-control" name="8red1" required></td>
					<td class="red"><input type="number" class="form-control" name="8red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="8blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="8blue2" required></td>
				</tr>
				<tr>
					<td>9</td>
					<td class="red"><input type="number" class="form-control" name="9red1" required></td>
					<td class="red"><input type="number" class="form-control" name="9red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="9blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="9blue2" required></td>
				</tr>
				<tr>
					<td>10</td>
					<td class="red"><input type="number" class="form-control" name="10red1" required></td>
					<td class="red"><input type="number" class="form-control" name="10red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="10blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="10blue2" required></td>
				</tr>
				<tr>
					<td>11</td>
					<td class="red"><input type="number" class="form-control" name="11red1" required></td>
					<td class="red"><input type="number" class="form-control" name="11red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="11blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="11blue2" required></td>
				</tr>
				<tr>
					<td>12</td>
					<td class="red"><input type="number" class="form-control" name="12red1" required></td>
					<td class="red"><input type="number" class="form-control" name="12red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="12blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="12blue2" required></td>
				</tr>
				<tr>
					<td>13</td>
					<td class="red"><input type="number" class="form-control" name="13red1" required></td>
					<td class="red"><input type="number" class="form-control" name="13red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="13blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="13blue2" required></td>
				</tr>
				<tr>
					<td>14</td>
					<td class="red"><input type="number" class="form-control" name="14red1" required></td>
					<td class="red"><input type="number" class="form-control" name="14red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="14blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="14blue2" required></td>
				</tr>
				<tr>
					<td>15</td>
					<td class="red"><input type="number" class="form-control" name="15red1" required></td>
					<td class="red"><input type="number" class="form-control" name="15red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="15blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="15blue2" required></td>
				</tr>
				<tr>
					<td>16</td>
					<td class="red"><input type="number" class="form-control" name="16red1" required></td>
					<td class="red"><input type="number" class="form-control" name="16red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="16blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="16blue2" required></td>
				</tr>
				<tr>
					<td>17</td>
					<td class="red"><input type="number" class="form-control" name="17red1" required></td>
					<td class="red"><input type="number" class="form-control" name="17red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="17blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="17blue2" required></td>
				</tr>
				<tr>
					<td>18</td>
					<td class="red"><input type="number" class="form-control" name="18red1" required></td>
					<td class="red"><input type="number" class="form-control" name="18red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="18blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="18blue2" required></td>
				</tr>
				<tr>
					<td>19</td>
					<td class="red"><input type="number" class="form-control" name="19red1" required></td>
					<td class="red"><input type="number" class="form-control" name="19red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="19blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="19blue2" required></td>
				</tr>
				<tr>
					<td>20</td>
					<td class="red"><input type="number" class="form-control" name="20red1" required></td>
					<td class="red"><input type="number" class="form-control" name="20red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="20blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="20blue2" required></td>
				</tr>
				<tr>
					<td>21</td>
					<td class="red"><input type="number" class="form-control" name="21red1" required></td>
					<td class="red"><input type="number" class="form-control" name="21red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="21blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="21blue2" required></td>
				</tr>
				<tr>
					<td>22</td>
					<td class="red"><input type="number" class="form-control" name="22red1" required></td>
					<td class="red"><input type="number" class="form-control" name="22red2" required></td>
					<td class="blue"><input type="number" class="form-control" name="22blue1" required></td>
					<td class="blue"><input type="number" class="form-control" name ="22blue2" required></td>
				</tr>
				<tr>
					<td>23</td>
					<td class="red"><input type="number" class="form-control" name="23red1"></td>
					<td class="red"><input type="number" class="form-control" name="23red2"></td>
					<td class="blue"><input type="number" class="form-control" name="23blue1"></td>
					<td class="blue"><input type="number" class="form-control" name ="23blue2"></td>
				</tr>
			</table>
				<script type="text/javascript" language="Javascript">
				var match = 24;
				function addInput(){
					
					var table = document.getElementById("inputTable");
					var row = table.insertRow(match);
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					var cell3 = row.insertCell(2);
					var cell4 = row.insertCell(3);
					var cell5 = row.insertCell(4);
					
					cell1.innerHTML = match;
					cell2.innerHTML = '<input type="number" class="form-control" name="'+match+'red1" required>';
					cell2.className="red";
					cell3.innerHTML = '<input type="number" class="form-control" name="'+match+'red2" required>';
					cell3.className="red";
					cell4.innerHTML = '<input type="number" class="form-control" name="'+match+'blue1" required>';
					cell4.className="blue";
					cell5.innerHTML = '<input type="number" class="form-control" name="'+match+'blue2" required>';
					cell5.className="blue";
					match++;
					
				}
				
				function removeInput(){
					var table = document.getElementById("inputTable");
					match--;
					table.deleteRow(match)
				}
				</script>
	
					
			<div class="col-md-12" style="padding-bottom: 10px">
			<div class="col-md-6" style="padding-bottom: 10px">
			<center><input style="padding-left:40px; padding-right: 40px;" class="btn btn-primary raised" type="button" value="Add Match" onClick="addInput();"></center>
			</div>
			<div class="col-md-6">
			<center><input class="btn btn-primary raised" type="button" value="Remove Match" onClick="removeInput();"></center>
			</div>
			</div>
			
			<center><button type="submit" class="btn btn-primary btn-block raised">Submit</button></center>
		</div>
		</div>
		</form>
		
				<div class="footer">
			<div class="container">
				<div class="col-md-6" style="padding-bottom: 10px;">
				<center>
				Designed by:
				Team 8097 Botcats,
				Team 9261 Level Up,
				Team 10809 Crow Force 5
				</center>
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-3" >
				<center>
					© TheOrangeAlliance 2017
					</cetner>
				</div>
			</div>
		</div>
		<?php
			require 'input.php';
			//MongoDBSetup
				// connect to mongodb
				$m = new MongoClient();
				// select a database
				$db = $m->TheOrangeAlliance;
				$collectionName = "Y" . TimeTime($_POST['matchDate']) . PlaceID($_POST['matchPlace'], 'rainbow') . 'Raw';
				$collection = $db->$collectionName;

			//Generates the Match array for documentation
			
			$maxRows = 123; //intiger
			for($row = 1; $_POST[$row . "red1"] != "" ; $row++){
				$maxRows = $row;
			};
			$colNames = array("red1", "red2", "blue1", "blue2");
			
			$matchArray = array();
			for($row = 1; $row <= $maxRows; $row++){
				$matchArray['Match' . $row] = array(
						"Red1" => intval($_POST[$row . "red1"]),
						"Red2" => intval($_POST[$row . "red2"]),
						"Blue1" => intval($_POST[$row . "blue1"]),
						"Blue2" => intval($_POST[$row . "blue2"])
					);
			};
			

			//Creates the document to submit
			$document = array(
				"MetaData" => array(
					"MetaData" => "ScheduleInputRaw",
					"TimeStamp" => date('YmdHis'),
					"DatePlace" => $collectionName,
					"ScreenStatus" => "Unscreened",
					"InputID" => $_POST['dataValidation']
				),

				"DataValidation" => array(
					"ValidationKey" => $_POST['dataValidation'],
					"ValidationValue" => ValidationValue($_POST['dataValidation'])
				),

				"Match" => $matchArray
			);
			$collection->insert($document);
			CreateDBLog(
				$collectionName,
				"ScheduleInput",
				date('YmdHis'),
				$_POST['dataValidation'],
				"Testing",
				$_POST['dataValidation']
			);

		?>
		
		<script> 
        webshim.activeLang('en');
        webshims.polyfill('forms');
        webshims.cfg.no$Switch = true;
    </script>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>