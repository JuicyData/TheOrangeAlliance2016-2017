<!DOCTYPE html>
<html>
	<head>
		<title>The Orange Alliance</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<link href = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		<link href = "css/styles.css" rel = "stylesheet" type="text/css">
		<link href = "css/jquery.dataTables.min.css" rel = "stylesheet" type="text/css">
		<link href = "css/fixedHeader.bootstrap.min.css" rel = "stylesheet" type="text/css">
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
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/dataTables.fixedHeader.min.js"></script> 
		<script type="text/javascript">
		$(document).ready(function() { 
		$("#inputTable1").DataTable({
			paging: false
			}); 
		$("#inputTable2").DataTable({
			paging: false,
			fixedHeader: true
			}); 
		$("#inputTable3").DataTable({
			paging: false
			}); 
			});
		</script>
	</head>	
	<body>
			<div class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<a class="nav-brand" href="http://theorangealliance.tk:8080/"> 
							<img style="max-width:50px" src="/images/logo.png"> 
							<span class="logo hidden-xs">The Orange Alliance</span>
						</a>
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
		
		<div class="content"  style="font-size:6px">
			<div class="container">
				<h1>Testing</h1><h1></h1>
				<hr></hr>
			
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a data-toggle="tab" href="#rankings">Input</a></li>
					<li role="presentation"><a data-toggle="tab" href="#match-history">Inverse</a></li>
				</ul>
			
				<div class="tab-content">
					<div style="padding-top: 10px;" id="rankings" class="tab-pane fade in active table-responsive">
						<table class="table table-striped table-bordered" id="inputTable1">
							<thead>
								<tr>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
								</tr>
							</thead>
							<tbody  style="font-size:6px">
							<?php
								require 'mikal.php';
								RankingsTable1();
							?>
							</tbody>
						</table>
					</div>
					
					<div style="padding-top: 10px;" id="match-history" class="tab-pane fade table-responsive">
						<table class="table table-striped table-bordered" id="inputTable2">
							<thead>
								<tr>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
									<th>lol</th>
								</tr>
							</thead>
							<tbody>
							<?php
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			</div>
		<script src = "js/bootstrap.js"></script>
	</body>
</html>