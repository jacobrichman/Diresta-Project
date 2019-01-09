<?php include( '../base.php'); ?>

<?php

$Pid = strtok($_GET['video'], '~');
$Iid = substr($_GET['video'], strpos($_GET['video'], "~")+1);

$result = mysql_query("SELECT * FROM Projects WHERE ID=".$Pid);
$row = mysql_fetch_assoc($result);
$YouTubeID = $row['YouTube_ID'];
$Instagram_ID = $row['Instagram_ID'];
$Make_URL = $row['Make_URL'];


if($Iid != ""){
	$result = mysql_query("SELECT * FROM Instances WHERE ID=".$Iid);
	$row = mysql_fetch_assoc($result);
	$IPID = $row['Project_ID'];
	if($IPID == $Pid){
		$MasterStart = $row['Start'];
		$MasterEnd = $row['End'];
	}
}

$YouTubeData = json_decode(file_get_contents("..YouTubeData.txt"), true);
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
	
	file_put_contents("..YouTubeData.txt", json_encode($YouTubeData));
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
	<?php include( '../favicon.php');?>


	<!-- JS
================================================================================================= -->
	<script src="../js/libs/modernizr.min.js"></script>
	<script src="../js/libs/jquery-1.8.3.min.js"></script>
	<script src="../js/libs/jquery.easing.1.3.min.js"></script>
	<script src="../js/libs/jquery.fitvids.js"></script>
	<script src="../js/script.js"></script>

	<style>
		.infoButton {
			width: 13px;
			height: 13px;
			background-image: url(../images/info.png);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;
			display: inline-block;
			cursor: pointer;
		}
		
		.playButton {
			width: 13px;
			height: 13px;
			background-image: url(../images/play.png);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;
			display: inline-block;
			cursor: pointer;
		}
	</style>

</head>

<body>

	<div class="container">

		<?php include( '../header.php');?>

		<!-- About page begins ====================================================================== -->
		<div id="about">

			<!-- Column 1 begins ==================================================================== -->
			<div class="eight columns"><!--
				<?php
					if($start){
						echo '<iframe id="YouTubeVideo" width="460" height="290" src="https://www.youtube.com/v/'.$YouTubeID.'&start='.$start.'&end='.$end.'&version=3&enablejsapi=1" frameborder="0" allowfullscreen></iframe>';
					}
					else{
						echo '<iframe id="YouTubeVideo" width="460" height="290" src="https://www.youtube.com/v/'.$YouTubeID.'&version=3&enablejsapi=1" frameborder="0" allowfullscreen></iframe>';
					}
				?>-->
				<div id="player" style="max-width: 100%; max-height: 100%;"></div>
				
				<ul class="linedList">
					<li><strong>Description: </strong><?php echo $description;?></li>
					<li><strong>Date: </strong><?php echo $date;?></li>
					<li><strong>Views: </strong><?php echo $views;?></li>
					<li><strong>Like Count: </strong><?php echo $likes;?></li>
				</ul>
				
				<button onclick="location.href='../import?YouTubeID=<?php echo $YouTubeID;?>';" style="width: 100%; background-color: #2fb775; color: white; font-size: 20px;">Edit</button>

			</div>
			<!-- Column 1 ends ====================================================================== -->

			<!-- Column 2 begins ==================================================================== -->
			<div class="eight columns">
			<?php
			$AllData = (array) null;

			$result = mysql_query("SELECT * FROM Instances WHERE 1=1");
			while($row = mysql_fetch_array($result)){
				$PID2 = $row['Project_ID'];

				if($PID2 == $Pid){
					$Iid2 = $row['ID']; 
					$name = $row['Name']; 
					$type = $row['Type'];
					$start = $row['Start'];
					$end = $row['End'];
					
					$AllData[$type][] = array($name, $start, $end, $Iid2);
				}
			}
			foreach ($AllData as $thisType => $typeValue) {
				echo "<h4><u>".$thisType."s</u></h4>";
				
				array_sort_by_column($typeValue, 1);
			?>
				
				<ul class="disc" style="list-style-type: none;">
					<?php
						foreach ($typeValue as &$rowValue) {
							$jsStarts[$rowValue[3]] = $rowValue[1];
							$jsEnds[$rowValue[3]] = $rowValue[2];
							
							echo '<li><div id="'.$rowValue[3].'"><strong><a style="text-decoration:none;" href="../instances/'.str_replace(" ","~",$rowValue[0]).'" target="_blank">'.$rowValue[0].'</a></strong> <a href="https://en.wikipedia.org/wiki/'.strtolower($rowValue[0]).'" target="_blank"><div class="infoButton"></div></a> <a href="http://jacobrichman.com/Diresta/video/'.$Pid.'~'.$rowValue[3].'"><div class="playButton"></div></a></div></li>';
						}
					?>
				</ul>
			<?php
			}
			?>
			</div>
			<!-- Column 2 ends ====================================================================== -->

		</div>
		<!-- About page ends ======================================================================== -->

		<?php include( '../footer.php');?>

	</div>
	<!-- container -->
	<script>
		var starttimes = {
			<?php
			foreach ($jsStarts as $id => $startTime) {
				echo $id.":".$startTime.",";
			}
			?>
		};
		var endtimes = {
			<?php
			foreach ($jsEnds as $id => $startTime) {
				echo $id.":".$startTime.",";
			}
			?>
		};
		
		var tag = document.createElement('script');
		tag.src = "https://www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		var player;

		function onYouTubeIframeAPIReady() {
			player = new YT.Player('player', {
				events: {
					'onReady': onPlayerReady,
				}
			});
		}
		
		function onPlayerReady(event) {
			player.loadVideoById({videoId:"<?php echo $YouTubeID;?>",
								<?php if($MasterStart){ echo "startSeconds:".$MasterStart.",";}?>
								/*<?php if($MasterEnd){ echo "endSeconds:".$MasterEnd.",";}?>*/
								});
			<?php if($MasterStart){ echo "player.playVideo();";}else{ echo "player.stopVideo();";}?>
			
			setInterval(function(){
				for (var k in starttimes) {
					if((player.getCurrentTime()>=starttimes[k]) && (player.getCurrentTime()<endtimes[k])){
						document.getElementById(k).style.backgroundColor = "yellow";
					}
					else{
						document.getElementById(k).style.backgroundColor = "";
					}
				}
			},100);
		}
	</script>
</body>

</html>

<?php

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

?>