<?php
include('../base.php');
?>

<?php

$Types = (array) null;

$result = mysql_query("SELECT * FROM Instances WHERE 1=1");
while($row = mysql_fetch_array($result)){
	$type = $row['Type'];
	$name = $row['Name'];
	
	if($type == rtrim(ucfirst($_GET['type']), "s")){
		$i = false;
		foreach ($Types as &$value) {
			if($value == $name){
				$i = true;
			}
		}
		if($i == false){
			array_push($Types, $name);
		}
	}
}

asort($Types);
$savedImages = json_decode(file_get_contents("../images/saved.txt"), true);

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
	<link rel="stylesheet" href="../css/base.css">
	<link rel="stylesheet" href="../css/themes/type_05.css">
	<link rel="stylesheet" href="../css/themes/color_06.css">

	<!--[if lt IE 9]>
	<script src="../http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

	<!-- Favicons
================================================================================================= -->
	<?php include('../favicon.php');?>

	<!-- JS
================================================================================================= -->
	<script src="../js/libs/modernizr.min.js"></script>
	<script src="../js/libs/jquery-1.8.3.min.js"></script>
	<script src="../js/libs/jquery.easing.1.3.min.js"></script>
	<script src="../js/libs/jquery.fitvids.js"></script>
	<script src="../js/script.js"></script>

</head>

<body>


	<div class="container">

		<?php include('../header.php');?>

		<!-- Work page begins ======================================================================= -->
		<div id="work">
			<div id="overview" class="sixteen columns">
				<h3 style="font-size: 20px;"><?php echo ucfirst($_GET['type']);?>:</h3>
			</div>

			<div class="eight columns" id="col1">
				<!-- Project begins ================================================================= -->
				<?php
				foreach ($Types as &$value) {
					if($savedImages[$value]){
						$imageURL = $savedImages[$value];
					}
					else{
						$url = preg_replace("/ /","+",'http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.$value);
						$json = file_get_contents($url);
						$data = json_decode($json);
						foreach ($data->responseData->results as $result) {
							$results[] = array('url' => $result->url, 'alt' => $result->title);
						}

						$imageURL = "";
						$i = 0;
						while(!getimagesize($imageURL)) {
							$imageURL = $results[$i]['url'];
							$i++;
						}
						unset($results);
						
						$savedImages[$value] = $imageURL;
						file_put_contents("../images/saved.txt", json_encode($savedImages));
					}
				?>
				<div class="project">

					<div class="projectThumbnail" onClick="window.location.href='../instances/<?php echo str_replace(" ","~",$value);?>'">
						<svg class="thumbnailMask"></svg>
						<div class="projectThumbnailHover">
							<h4><?php echo $value;?></h4>
						</div>

						<div style="width: 460px; height: 284px; overflow: hidden; background-size: 110% auto; background-image: url('<?php echo $imageURL;?>'); background-position: center;" class="thumbnailImage"></div>
					</div>

				</div>
				<?php } ?>
				<!-- Project ends =================================================================== -->
			</div>
			<!-- col1 -->

			<!-- Even numbered projects are dynamically moved into this second column via JS -->
			<div class="eight columns" id="col2">
			</div>

		</div>
		<!-- Work page ends ========================================================================= -->
		
		<?php include('../footer.php');?>

	</div>
	<!-- container -->
</body>

</html>