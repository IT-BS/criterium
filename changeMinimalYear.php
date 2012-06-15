<?php
	/*
		file: 	changeMinimalYear.php
		author: Beno�t Uffer
		
	*/

include_once("globals.php");
include_once("sql.php");      


// connection � la base de donn�e
connect();


// on r�cup�re l'ann�e minimale actuelle:
$minYear = getMinimalYear();

?>

<html>
	<head>
		<title>CRITERIUM DE CHANDELARD</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	
	<body>
		
		<?php
		
		// on affiche un formulaire avec les champs d�ja remplis avec les champs actuels		
		echo '<form action="changeMinimalYearDone.php" method="post">';
		echo 'les gars et fille n�s AVANT ';
		echo '<input type="text" name="minYear" id="minYearId" value="'.$minYear.'" size="4">';
		echo ' ne sont pas pris en compte pour les classement des patrouilles et des troupes<br>';
		echo 'pour les classement par gars/filles, ils sont consid�r�s comme des rouges<br>';
		echo '<br>';
		echo '<input type="Submit" value="MODIFIER">';
		echo '</form>';
		
		displayFooter();
		
		?>
		
	</body>
</html>