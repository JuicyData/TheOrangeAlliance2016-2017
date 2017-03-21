<!DOCTYPE html>
<html>
	<head>
		<title>Baka</title>
	</head>
	<script type="text/javascript">
var countDownDate = new Date("July 9, 2017 00:00:00").getTime();

var x = setInterval(function() {

  var now = new Date().getTime();

  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("timmer").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timmer").innerHTML = "EXPIRED";
  }
}, 1000);
	</script>
	<div class="bgimg">
  <div class="middle">
    <h1>COMING SOON ^^</h1>
    <hr>
    <p id='timmer'></p>
  </div>
</div>
<style type="text/css">
	body, html {
    height: 100%
}

.bgimg {
    background-color: #FFB6C1;
    height: 100%;
    background-position: center;
    background-size: cover;
    position: relative;
    color: white;
    font-family: "Courier New", Courier, monospace;
    font-size: 25px;
}

.middle {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
hr {
    margin: auto;
    width: 40%;
}

</style>
</html>