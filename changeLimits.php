<?php
	/*
		file: 	changeLimits.php
		author: Beno�t Uffer
		
	*/

include_once("globals.php");
include_once("sql.php");      


// connection � la base de donn�e
connect();


// on r�cup�re les limites:
$minBiker 	= getMinBiker();
$maxBiker 	= getMaxBiker();
$bonus			= getBonus();

?>

<html>
	<head>
		<title>CRITERIUM DE CHANDELARD</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	
	<body>
		
		<?php
		
		// on affiche un formulaire avec les champs d�ja remplis avec les champs actuels		
		echo '<form action="changeLimitsDone.php" method="post">';
		
		echo 'les patrouilles qui ont MOINS QUE ';
		echo '<input type="text" name="minBiker" id="minBikerId" value="'.$minBiker.'" size="2">';
		echo ' participants n\'apparaissent pas au classement des patrouilles<br>';
		
		echo 'les patrouilles qui ont PLUS QUE ';
		echo '<input type="text" name="maxBiker" id="maxBikerId" value="'.$maxBiker.'" size="2">';
		echo ' participants re�oivent un bonus<br>';
		
		echo 'le bonus est une r�duction de ';
		echo '<input type="text" name="bonus" id="bonusId" value="'.$bonus.'" size="4">';
		echo ' secondes par participant de plus<br>';
		
		echo '<input type="Submit" value="MODIFIER">';
		echo '</form>';
		
		displayFooter();
		
		?>
		
	</body>
</html>