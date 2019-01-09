<?php
include('../base.php');
?>

<?php
$title = str_replace("~"," ",$_GET['instance']);
 
$AllData = (array) null;

$result = mysql_query("SELECT * FROM Instances WHERE 1=1");
while($row = mysql_fetch_array($result)){
	$name = $row['Name'];
	$PID = $row['Project_ID'];
	$id = $row['ID'];
	
	if($name == $title){
		$AllData[$PID][] = $id;
	}
}

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
				<h3 style="font-size: 20px;"><?php echo ucfirst($title);?>:</h3>
			</div>

			<div class="eight columns" id="col1">
				<!-- Project begins ================================================================= -->
				<?php
				foreach ($AllData as $PID => $value1) {
					$result = mysql_query("SELECT * FROM Projects WHERE ID=".$PID);
					$row = mysql_fetch_assoc($result);
					
					$page1 = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id='.$row['YouTube_ID'].'&key=AIzaSyAzevVR38myHxT7DisAAUF-AK4HgMBZyu0');
					$data1 = json_decode($page1, true);
				?>
				<div class="project">

					<div class="projectThumbnail">
						<svg class="thumbnailMask"></svg>
						<div class="projectThumbnailHover">
							<h4><?php echo $data1['items'][0]['snippet']['title'];?></h4>
						</div>

						<div style="width: 460px; height: 284px; overflow: hidden; background-size: 110% auto; background-image: url('<?php echo $row['Image_URL'];?>'); background-position: center;" class="thumbnailImage"></div>
					</div>

					<div class="projectInfo">
						<h4><a href="../video/<?php echo $row['ID'];?>"><?php echo $data1['items'][0]['snippet']['title'];?></a></h4>
						<div class="projectNavCounter"></div>
						<div class="projectNav">
							<ul>
								<?php
								$i=1;
								foreach ($value1 as &$id) {
									$result = mysql_query("SELECT * FROM Instances WHERE ID=".$id);
									$row2 = mysql_fetch_assoc($result);
									$start = gmdate("i:s", $row2['Start']);
									$end = gmdate("i:s", $row2['End']);
									echo '<li><strong>'.$i.') </strong><a href="../video/'.$row['ID'].'~'.$id.'">'.$start.' - '.$end.'</a></li>';
									$i++;
								}?>
							</ul>
						</div>
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