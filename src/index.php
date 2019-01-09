<?php
include('base.php');

$YouTubeData = json_decode(file_get_contents("YouTubeData.txt"), true);
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
	<?php include('favicon.php');?>

	<!-- JS
================================================================================================= -->
	<script src="js/libs/modernizr.min.js"></script>
	<script src="js/libs/jquery-1.8.3.min.js"></script>
	<script src="js/libs/jquery.easing.1.3.min.js"></script>
	<script src="js/libs/jquery.fitvids.js"></script>
	<script src="js/script.js"></script>

</head>

<body>


	<div class="container">

		<?php include('header.php');?>

		<!-- Work page begins ======================================================================= -->
		<div id="work">

			<div id="overview" class="sixteen columns">
				<h3 style="font-size: 20px;">This project aims to create an intuitive platform for users to view Jimmy Diresta's content.</h3>
				<hr />
			</div>
			<div id="overview" class="sixteen columns">
				<h3 style="font-size: 15px;">Recently analyzed videos:</h3>
			</div>

			<div class="eight columns" id="col1">
				<!-- Project begins ================================================================= -->
				<?php
				$result = mysql_query("SELECT * FROM Projects WHERE 1=1 order by ID desc limit 10");
				while($row = mysql_fetch_array($result)){
					$YouTubeID = $row['YouTube_ID'];
					if((time() - $YouTubeData[$YouTubeID]["time"])<3600){
						$name = $YouTubeData[$YouTubeID]["name"];
						$description = $YouTubeData[$YouTubeID]["description"];
						$date = $YouTubeData[$YouTubeID]["date"];
						$views = $YouTubeData[$YouTubeID]["views"];
						$likes = $YouTubeData[$YouTubeID]["likes"];
					}
					else{
						$YouTubeData[$YouTubeID]["time"] = time();
						
						$page1 = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id='.$YouTubeID.'&key=AIzaSyAzevVR38myHxT7DisAAUF-AK4HgMBZyu0');
						$page2 = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics&id='.$YouTubeID.'&key=AIzaSyAzevVR38myHxT7DisAAUF-AK4HgMBZyu0');
						$data1 = json_decode($page1, true);
						$data2 = json_decode($page2, true);

						$name = $data1['items'][0]['snippet']['title'];
						$description = $data1['items'][0]['snippet']['description'];
						$date = date("F j, Y", strtotime(substr($data1['items'][0]['snippet']['publishedAt'], 0, 10)));
						$views = number_format($data2['items'][0]['statistics']['viewCount']);
						$likes = number_format($data2['items'][0]['statistics']['likeCount']);
						
						$YouTubeData[$YouTubeID]["name"] = $name;
						$YouTubeData[$YouTubeID]["description"] = $description;
						$YouTubeData[$YouTubeID]["date"] = $date;
						$YouTubeData[$YouTubeID]["views"] = $views;
						$YouTubeData[$YouTubeID]["likes"] = $likes;
						
						file_put_contents("YouTubeData.txt", json_encode($YouTubeData));
					}
					
				?>
				<div class="project">

					<div class="projectThumbnail">
						<svg class="thumbnailMask"></svg>
						<div class="projectThumbnailHover">
							<h4><?php echo $name;?></h4>
						</div>

						<div style="width: 460px; height: 284px; overflow: hidden; background-size: 110% auto; background-image: url('<?php echo $row['Image_URL'];?>'); background-position: center;" class="thumbnailImage"></div>
					</div>

					<div class="projectInfo">
						<ul>
							<li><strong><a style="font-size: 20px;" href="video/<?php echo $row['ID'];?>"><?php echo $name;?></a></strong></li>
							<li><p><?php echo $description;?></p></li>
							<li><strong>Date: </strong><?php echo $date;?></li>
							<li><strong>Views: </strong><?php echo $views;?></li>
							<li><strong>Like Count: </strong><?php echo $likes;?></li>
						</ul>
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
		
		<?php include('footer.php');?>

	</div>
	<!-- container -->
</body>

</html>