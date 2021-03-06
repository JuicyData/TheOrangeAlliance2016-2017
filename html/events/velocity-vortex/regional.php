<!DOCTYPE html>
<html>
		<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "/css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "/css/styles.css" rel = "stylesheet" type="text/css">
		<link href = "/css/jquery.dataTables.min.css" rel = "stylesheet" type="text/css">
		<link href = "/css/fixedHeader.dataTables.min.css" rel = "stylesheet" type="text/css">
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
		<script src="/js/dataTables.fixedHeader.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() { 
			/*$("#rankingstable").load("rankingstable.php");
			refreshRankingsTable();*/
		
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
		
		/*function refreshRankingsTable()
		{
			setTimeout( function() {
				$("#rankingstable").fadeOut("slow").load("rankingstable.php").fadeIn("slow");
				refreshRankingsTable();
			}, 10000);
		}*/
		</script>
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
						<li class = "active"><a href = "/events/velocity-vortex.html">Events</a></li>
						<li ><a href = "/input-data.html">Input Match Results</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container">
				<h1>San Diego Regional Championship</h1><h1></h1>
				<hr></hr>
				<ul class="nav nav-tabs">
					<li role="presentation" class="active small"><a data-toggle="tab" href="#rankings">Rankings</a></li>
					<li role="presentation" class="small"><a data-toggle="tab" href="#match-history">Match History</a></li>
					<li role="presentation" class="small"><a data-toggle="tab" href="#average-scores">Average Scores</a></li>
				</ul>
			
				<div class="tab-content">
					<div style="padding-top: 10px;" id="rankings" class="tab-pane fade in active table-responsive">
					<div class="redcircle"></div><span class="key">= Autonomous Period</span><br>
					<div class="bluecircle"></div><span class="key">= Teleop Period</span><br>
					<div class="greencircle"></div><span class="key">= End Game Period</span>
						<table class="table table-striped table-bordered" id="inputTable1">
							<thead>
								<tr>
									<th>Rank</th>
									<th>Team Number</th>
									<th>Team Name</th>
									<th>Record W-L-T<br></th>
									<th>QP</th>
									<th>RP</th>
									<th>OPR*</th>
									<th>CCWM*</th>
									<th class="red">Average</th>
									<th class="blue">Average</th>
									<th class="green">Average</th>
								</tr>
							</thead>
							<tbody id = "rankingstable">
							<?php
								require '../../potato.php';
								RankingsTable('Y201702255');
							?>
							</tbody>
						</table>
					</div>
					
					<div style="padding-top: 10px;" id="match-history" class="tab-pane fade table-responsive">
					<div class="redcircle"></div><span class="key">= Autonomous Period</span><br>
					<div class="bluecircle"></div><span class="key">= Teleop Period</span><br>
					<div class="greencircle"></div><span class="key">= End Game Period</span>
					
						<table class="table table-striped table-bordered" id="inputTable2">
						<?php
							MatchHistoryTable('Y201702255');
						?>
						</table>
					</div>
					<div style="padding-top: 10px;" id="average-scores"  class="tab-pane fade table-responsive">
					<div class="redcircle"></div><span class="key">= Autonomous Period</span><br>
					<div class="bluecircle"></div><span class="key">= Teleop Period</span><br>
					<div class="greencircle"></div><span class="key">= End Game Period</span>
					
						<table class="table table-striped table-bordered" id="inputTable3">
						<?php
							AverageScoresTable('Y201702255');
						?>
						</table>
					</div>
				</div>
				<p style="font-size: 12px;">*Offensive Power Rating. An estimate of the number of points the team scores overall, on average. This number represents the offensive utility of a team.<br>
				*Calculated Contribution to Winning Margin.</p>
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