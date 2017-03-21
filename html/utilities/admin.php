<!DOCTYPE html>
<html>
	<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "css/styles.css" rel = "stylesheet" type="text/css">
		<link href = "css/jquery.dataTables.min.css" rel = "stylesheet" type="text/css">
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
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script> 
		<script type="text/javascript">$(document).ready(function() { $("#inputTable1").DataTable({paging: false}); $("#inputTable2").DataTable({paging: false}); $("#inputTable3").DataTable({paging: false}); } );</script>
	</head>	
	<body>
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<a class="nav-brand" href="http://theorangealliance.tk:8080/"> 
							<img style="max-width:50px" src="/images/logo.png"> The Orange Alliance
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
							<li class = "active"><a href = "http://theorangealliance.tk:8080/">Home</a></li>
							<li><a href = "http://theorangealliance.tk:8080/input-data.php">Input Data</a></li>
							<li><a href = "http://theorangealliance.tk:8080/input-results.php">Input Results</a></li>
							<li ><a href = "http://theorangealliance.tk:8080/input-schedule.php">Input Schedule</a></li>
						</ul>
					</div>
				</div>
			</div>
		
		<div class="content">
			<form action="admin.php" method="post" >
			<div class="container">
				<h1>ADMIN PAGE!!!!!!!!!</h1><h1> <input type="number" class="form-control" id="inputID" name="removeValue"> </h1>
				<hr> <input class="btn btn-primary raised" type="submit"> </hr>
				
			
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a data-toggle="tab" href="#rankings">Rankings</a></li>
					<li role="presentation"><a data-toggle="tab" href="#match-history">Match History</a></li>
					<li role="presentation"><a data-toggle="tab" href="#average-scores">Average Scores</a></li>
				</ul>
			
				<div class="tab-content">
					<div style="padding-top: 10px;" id="rankings" class="tab-pane fade in active table-responsive">
						<table class="table table-striped table-bordered" id="inputTable1">
							<thead>
								<tr>
									<th>Team Number</th>
									<th>Team Name</th>
									<th>Ranking</th>
									<th>Record</th>
									<th>Games Played</th>
									<th>QP</th>
									<th>RP</th>
									<th>OPR</th>
								</tr>
							</thead>
						</table>
					</div>
					
					<div style="padding-top: 10px;" id="match-history" class="tab-pane fade table-responsive">
						<table class="table table-striped table-bordered" id="inputTable2">
							<thead>
								<tr>
									<th>Match Number</th>
									<th>Alliance</th>
									<th>Team Number</th>
									<th>Team Name</th>
									<th>Result Red-Blue</th>
									<th>RP</th>
									<th class="red">Robot Parking</th>
									<th class="red">Particles in Center</th>
									<th class="red">Particles in Corner</th>
									<th class="red">Cap Ball</th>
									<th class="red">Beacons</th>
									<th class="blue">Particles in Center</th>
									<th class="blue">Particles in Corner</th>
									<th class="green">Beacons</th>
									<th class="green">Cap Ball</th>
									<th>Admin</th>
								</tr>
							</thead>
							<tbody>
							</form>
							<?php
							require 'mikal.php';
								MatchHistoryTableAdmin($_POST['removeValue']);
								?>
							</tbody>
						</table>
					</div>
					<div style="padding-top: 10px;" id="average-scores"  class="tab-pane fade table-responsive">
						<table class="table table-striped table-bordered" id="inputTable3">
							<thead>
								<tr>
									<th>Team Number</th>
									<th>Team Name</th>
									<th class="red">Partially on Center</th>
									<th class="red">Partially on Corner</th>
									<th class="red">Fully on Center</th>
									<th class="red">Fully on Corner</th>
									<th class="red">Particles in Center Vortex</th>
									<th class="red">Particles in Corner Vortex</th>
									<th class="red">Cap Balla</th>
									<th class="red">Claimed Beacons</th>
									<th class="blue">Particles in Center Vortex</th>
									<th class="blue">Particles in Corner Vortex</th>
									<th class="green">Claimed Beacons</th>
									<th class="green">Cap Ball on Ground</th>
									<th class="green">Cap Ball Raised</th>
									<th class="green">Cap Ball Above Center</th>
									<th class="green">Cap Ball in Center</th>
								</tr>
							</thead>
							<tbody>
							
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
			</div>
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
		<script src = "js/bootstrap.js"></script>
	</body>
</html>