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
				<h1 style="text-align: left;">Velocity Vortex Events</h1>
				<div class="dropdown">
					<button style="padding-left: 12px; padding-right: 12px;" class="btn btn-lg btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Velocity Vortex
						<span class="caret"></span>
					</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<li><a href="/events/velocity-vortex.php">Velocity Vortex</a></li>
				</ul>
				</div>
				
				<table class="table events table-striped" style="margin-top: 10px;">
					<thead>
						<tr>
							<th>Event</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="/events/velocity-vortex/regional.php">San Diego Regional Championship</a><br>
							<span class="location">Francis Parker School</span>
							</td>
							<td style="color: black">February 25, 2017</td>
						</tr>
						<tr>
							<td><a href="/events/velocity-vortex/turing.php">Turing League Championship</a><br>
							<span class="location">Mater Dei High School</span>
							</td>
							<td style="color: black">February 5, 2017</td>
						</tr>
						<tr>
							<td><a href="/events/velocity-vortex/euclid.php">Euclid League Championship</a><br>
							<span class="location">Boys and Girls Club</span>
							</td>
							<td style="color: black">February 4, 2017</td>
						</tr>
						<tr>
							<td><a href="/events/velocity-vortex/gauss.php">Gauss League Champsionship</a><br>
							<span class="location">Tri-City Christian</span>
							</td>
							<td style="color: black">February 4, 2017</td>
						</tr>
						<tr>
							<td><a href="/events/velocity-vortex/descartes.php">Descartes League Championship</a><br>
							<span class="location">Grauer School</span>
							</td>
							<td style="color: black">February 4, 2017</td>
						</tr>
					</tbody>
					
				</table>
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