<?php
$Things = (array) null;

$result = mysql_query("SELECT * FROM Instances WHERE 1=1");
while($row = mysql_fetch_array($result)){
	$type = $row['Type'];
	$i = false;
	
	foreach ($Things as &$value) {
		if($value == $type){
			$i = true;
		}
	}
	if($i == false){
		array_push($Things, $type);
	}
}

asort($Things);
?>

<!-- Header begins ========================================================================== -->
<header class="sixteen columns">
	<div id="logo" onclick="window.location='http://jacobrichman.com/Diresta/';">
		<h1 style="display:inline; font-size: 50px;">The </h1>
		<img src="http://jacobrichman.com/Diresta/images/logo.png" width="179" height="35" alt="Logo" style="display:inline;"/>
		<h1 style="display:inline; font-size: 50px;"> Project</h1>
	</div>
	<nav>
		<ul><?php foreach ($Things as &$value) {?>
			<li>
				<button onclick="window.location='http://jacobrichman.com/Diresta/type/<?php echo strtolower($value);?>s';"><?php echo $value;?>s</button>
			</li>
		<?php }?></ul>
	</nav>
	<hr />
</header>
<!-- Header ends ============================================================================ -->