<!DOCTYPE html>
<html>
		<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "/css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "/css/styles.css" rel = "stylesheet" type="text/css">
		<link href = "/css/jquery.dataTables.min.css" rel = "stylesheet" type="text/css">
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
		<script src="/js/jquery.dataTables.min.js"></script>
		<script src="/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() { 
		$("#inputTable1").DataTable({
			paging: false
			}); 
		$("#inputTable2").DataTable({
			paging: false
			}); 
		$("#inputTable3").DataTable({
			paging: false
			}); 
			});
		</script>
	</head>	
	</head>	
	<body>
		<div style = "margin-bottom: 0px;" class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="nav-brand" href="/"> 
					<img style="max-width:50px" src="/images/logo.png"> 
					<span class="logo hidden-xs">The Orange Alliance</span>
					</a>
					<a class="nav-brand" href="/"></a>
					<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
						<span class = "icon-bar"></span>
						<span class = "icon-bar"></span>
						<span class = "icon-bar"></span>
					</button>
				</div>
				<div class = "collapse navbar-collapse navHeaderCollapse">
					<ul class = "nav navbar-nav navbar-right">
						<li ><a href = "/">Home</a></li>
						<li class = "active"><a href = "/events/velocity-vortex.php">Events</a></li>
						<li ><a href = "/input-data.php">Input Match Results</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container">
				<h1>Euclid League Championship</h1><h1></h1>
				<hr></hr>
			
				<ul class="nav nav-tabs">
					<li role="presentation" class="active small"><a data-toggle="tab" href="#rankings">Rankings</a></li>
					<li role="presentation" class="small"><a data-toggle="tab" href="#match-history">Match History</a></li>
					<li role="presentation" class="small"><a data-toggle="tab" href="#average-scores">Average Scores</a></li>
				</ul>
			
				<div class="tab-content">
					<div style="padding-top: 10px;" id="rankings" class="tab-pane fade in active table-responsive">
						<table class="table table-striped table-bordered" id="inputTable1">
							<thead>
								<tr>
									<th>Rank</th>
									<th>Team Number</th>
									<th>Team Name</th>
									<th>Record W-L-T</th>
									<th>QP</th>
									<th>RP</th>
									<th>OPR*</th>
								</tr>
							</thead>
							<tbody>
							<?php
								require '../../tomato.php';
								RankingsTable('Y201702041', 'rainbow');
								//Y201702041
							?>
							</tbody>
						</table>
					</div>
					
					<div style="padding-top: 10px;" id="match-history" class="tab-pane fade table-responsive">
					<div class="redcircle"></div><span class="key">= Autonomous Period</span><br>
					<div class="bluecircle"></div><span class="key">= Teleop Period</span><br>
					<div class="greencircle"></div><span class="key">= End Game Period</span>
					
						<table class="table table-striped table-bordered" id="inputTable2">
							<thead>
								<tr>
									<th>#</th>
									<th>Alliance</th>
									<th>Team Number</th>
									<th>Team Name</th>
									<th>OPR*</th>
									<th>Result R-B</th>
									<th>Score</th>
									<th class="red">Parking</th>
									<th class="red">Center Particles</th>
									<th class="red">Corner Particles</th>
									<th class="red">Cap Ball</th>
									<th class="red">Beacons</th>
									<th class="blue">Center Particles</th>
									<th class="blue">Corner Particles</th>
									<th class="green">Beacons</th>
									<th class="green">Cap Ball</th>
								</tr>
							</thead>
							<tbody>
							<?php
								MatchHistoryTable('Y201702041','rainbow');
							?>
							</tbody>
						</table>
					</div>
					<div style="padding-top: 10px;" id="average-scores"  class="tab-pane fade table-responsive">
					<div class="redcircle"></div><span class="key">= Autonomous Period</span><br>
					<div class="bluecircle"></div><span class="key">= Teleop Period</span><br>
					<div class="greencircle"></div><span class="key">= End Game Period</span>
					
						<table class="table table-striped table-bordered" id="inputTable3">
							<thead>
								<tr>
									<th>Team Number</th>
									<th>Team Name</th>
									<th class="red">No Parking</th>
									<th class="red">Partially Center</th>
									<th class="red">Partially Corner</th>
									<th class="red">Fully Center</th>
									<th class="red">Fully Corner</th>
									<th class="red">Center Particles</th>
									<th class="red">Corner Particles</th>
									<th class="red">Cap Ball</th>
									<th class="red">Beacons</th>
									<th class="blue">Center Particles</th>
									<th class="blue">Corner Particles</th>
									<th class="green">Beacons</th>
									<th class="green">Cap Ball on Floor</th>
									<th class="green">Cap Ball Raised</th>
									<th class="green">Cap Ball Above Center</th>
									<th class="green">Cap Ball in Center</th>
								</tr>
							</thead>
							<tbody>
								<?php
									AverageScoresTable('Y201702041', 'rainbow');
								?>
							</tbody>
						</table>
					</div>
				</div>
				<p>*Offensive Power Rating. An estimate of the number of points the team scores overall, on average. This number represents the offensive utility of a team. It is not always accurate.</p>
			</div>
			</div>
		<div class="footer">
			<div class="container">
				<div class="col-md-6" style="padding-bottom: 10px;">
				<center>
				Designed by:
				Cameron DeMille, 
				Michael Leonffu, 
				Ryan Nemiroff,
				Team 8097 Botcats,
				Team 9261 Level Up,
				and
				Team 10809 Crow Force 5
				</center>
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-3" >
				<center>
					&#169 TheOrangeAlliance 2017
					</cetner>
				</div>
			</div>
		</div>
		<script src = "/js/bootstrap.js"></script>
	</body>
</html>