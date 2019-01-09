<?php include( 'base.php'); ?>

<?php

$status = 0;

if($_POST){
	if(($_POST['url'] != "") && ($_POST['type'] != "") && ($_POST['thing'] != "")){	
		$to      = 'jarichman43@gmail.com';
		$subject = 'New Diresta Content';
		$message = 'http://jacobrichman.com/Diresta/admin-import?url='.urlencode($_POST['url']).'&type='.urlencode($_POST['type']).'&thing='.urlencode($_POST['thing']).'&startm='.urlencode($_POST['startm']).'&starts='.urlencode($_POST['starts']).'&endm='.urlencode($_POST['endm']).'&ends='.urlencode($_POST['ends']);
		$headers = 'From: jacob@jacobrichman.com\r\nX-Mailer: PHP/' . phpversion();

		$mailStatus = mail($to, $subject, $message, $headers);
		if($mailStatus){
			$status = 1;
		}
		else{
			$status = 2;
		}
	}
	else{
		$status = 2;
	}
}


$Techniques = (array) null;
$Tools = (array) null;
$Materials = (array) null;

$result = mysql_query("SELECT * FROM Instances WHERE 1=1");
while($row = mysql_fetch_array($result)){
	$type = $row['Type'];
	$name = $row['Name'];
	
	if($type == "Technique"){
		$i = false;
		foreach ($Techniques as &$value) {
			if($value == $name){
				$i = true;
			}
		}
		if($i == false){
			array_push($Techniques, $name);
		}
	}
	
	if($type == "Tool"){
		$i = false;
		foreach ($Tools as &$value) {
			if($value == $name){
				$i = true;
			}
		}
		if($i == false){
			array_push($Tools, $name);
		}
	}
	
	if($type == "Material"){
		$i = false;
		foreach ($Materials as &$value) {
			if($value == $name){
				$i = true;
			}
		}
		if($i == false){
			array_push($Materials, $name);
		}
	}
}

asort($Techniques);
asort($Tools);
asort($Materials);

?>




<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8">

	<!--
••••••••••••••••••••••••

Powered by Type & Grids™
www.typeandgrids.com

••••••••••••••••••••••••
-->

	<title>The Diresta Project</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
================================================================================================= -->
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/themes/type_05.css">
	<link rel="stylesheet" href="css/themes/color_06.css">

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

	<!-- Favicons
================================================================================================= -->
	<?php include( 'favicon.php');?>


	<!-- JS
================================================================================================= -->
	<script src="js/libs/modernizr.min.js"></script>
	<script src="js/libs/jquery-1.8.3.min.js"></script>
	<script src="js/libs/jquery.easing.1.3.min.js"></script>
	<script src="js/libs/jquery.fitvids.js"></script>
	<script src="js/script.js"></script>
	
	<style>
		input[type="submit"]:hover{
			border: 3px solid yellow;
		}
	</style>

</head>

<body onLoad="setInterval(check, 1000); getType();">

	<div class="container">

		<?php include( 'header.php');?>

		<!-- About page begins ====================================================================== -->
		<div id="about">
			<center>
				<div id="headStatus" style="color: <?php if($status == 1){echo " green ";}elseif($status == 2){ echo "red ";};?>; font-size: 40px;"><center><?php if($status==1 ){echo $_POST[ 'thing']. " Submitted";}elseif($status==2 ){ echo "There was an error";};?></center></div>
				<br>
				<br>
				<iframe width="600" height="340" src="" frameborder="3" allowfullscreen id="video"></iframe>
				<br>
			</center>
			
			<form action="" method="post">
				<ul class="linedList">
					<li>Youtube URL:
						<input style="display: inline;" type="text" name="url" id="url" value="<?php if($_GET['YouTubeID']){echo "https://www.youtube.com/watch?v=".$_GET['YouTubeID'];}else{echo $_POST['url'];}?>">
					</li>

					<li>Type:
						<select name="type" onchange="getType()" id="type" style="display: inline;">
							<option value="Technique" <?php if($_POST[ 'type']=="Technique" ){echo 'selected="selected"';}?>>Technique</option>
							<option value="Tool" <?php if($_POST[ 'type']=="Tool" ){echo 'selected="selected"';}?>>Tool</option>
							<option value="Material" <?php if($_POST[ 'type']=="Material" ){echo 'selected="selected"';}?>>Material</option>
						</select>
					</li>

					<li>Thing:
						<input style="display: inline; height: 20px;" list="list" name="thing" autocomplete="off" value="<?php echo $_POST['thing'];?>">
						<datalist id="list">
							<!--<option value="Sample">-->
						</datalist>
						<br><br>
					</li>

					<li><u>Start Time</u>
						<br>Minute:
						<input type="number" name="startm" id="startm" value="<?php echo $_POST['startm'];?>">Second:
						<input type="number" name="starts" id="starts" value="<?php echo $_POST['starts'];?>">
						
						<br><br><button onclick="swap(); return false;">Swap</button>
						
						<br><br><u>End Time</u>
						<br>Minute:
						<input type="number" name="endm" id="endm" value="<?php echo $_POST['endm'];?>">Second:
						<input type="number" name="ends" id="ends" value="<?php echo $_POST['ends'];?>">
						<br><br>
					</li>
				</ul>
				
				<input type="submit" value="Submit" style="height: 30px; width: 100%; background-color: blue; color: white;">
			</form>


		</div>
		<!-- About page ends ======================================================================== -->

		<?php include( 'footer.php');?>

	</div>
	<!-- container -->
	<script type="text/javascript">
		var lastURL = "";
		var lastSM = 0;
		var lastSS = 0;
		var lastEM = 0;
		var lastES = 0;

		function check() {
			var currentURL = document.getElementById('url').value;
			var currentSM = document.getElementById('startm').value;
			var currentSS = document.getElementById('starts').value;
			var currentEM = document.getElementById('endm').value;
			var currentES = document.getElementById('ends').value;

			if ((currentURL != lastURL) || (lastSM != currentSM) || (lastSS != currentSS) || (lastEM != currentEM) || (lastES != currentES)) {
				var start = currentSM * 60 + parseInt(currentSS);
				var end = currentEM * 60 + parseInt(currentES);

				var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
				var match = currentURL.match(regExp);
				document.getElementById('video').src = "https://www.youtube.com/embed/" + match[7] + "?start=" + start + "&end=" + end + "&version=3";
			}

			lastURL = currentURL;
			lastSM = currentSM;
			lastSS = currentSS;
			lastEM = currentEM;
			lastES = currentES;
		}

		function getType() {
			if (document.getElementById('type').value == "Technique") {
				setList([ <?php foreach($Techniques as & $value) {
					echo "'".htmlspecialchars($value, ENT_QUOTES)."',";
				} ?> ]);
			}
			if (document.getElementById('type').value == "Tool") {
				setList([ <?php foreach($Tools as & $value) {
					echo "'".htmlspecialchars($value, ENT_QUOTES)."',";
				} ?> ]);
			}
			if (document.getElementById('type').value == "Material") {
				setList([ <?php foreach($Materials as & $value) {
					echo "'".htmlspecialchars($value, ENT_QUOTES)."',";
				} ?> ]);
			}
		}

		function setList(arr) {
			var options = '';
			for (var i = 0; i < arr.length; i++) {
				options += '<option value="' + arr[i] + '" />';
			}
			document.getElementById('list').innerHTML = options;
		}

		function swap() {
			document.getElementById('startm').value = document.getElementById('endm').value;
			document.getElementById('starts').value = document.getElementById('ends').value;
			document.getElementById('endm').value = "";
			document.getElementById('ends').value = "";
		}
	</script>

</body>

</html>
