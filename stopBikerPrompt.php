<?php
/*
	file: 	stopBikerPrompt.php
	author: Beno�t Uffer
	
	ce fichier est automatiquement appel� (gr�ce � la fonction header) par le fichier "stopBiker.php" si l'utilisateur entre un dossard
	qui a d�ja �t� stopp�. On laisse � l'utilisateur le choix d'�craser (entrer un nouveau temps pour l'arriv�e de ce m�me dossard) ou 
	d'annuler (on retourne � la page qui permet d'entrer le numero du dossard sans toucher � la base de donn�e
*/

include_once("globals.php");

// On r�cup�re le num�ro du dossard qu'on est en train de traiter (pour affichage)
$dossard = getParameterGET("dossard");
$timeField = getParameterGET("timeField");
$arrivalTime = getParameterGET("arrivalTime");

?>

<html>
	<head>
		<title>CRITERIUM DE CHANDELARD</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	
	<body>
		<?php
		echo '<h2>Attention: le dossard '.$dossard.' est d�ja arriv� � cette �tape. Voulez-vous l\'�craser?</h2>';
		echo '<br><br>';
		echo '<a href="stopBikerDone.php?timeField='.$timeField.'&dossard='.$dossard.'&arrivalTime='.$arrivalTime.'">OUI, ECRASER</a>';
		echo '<br><br>';
		echo '<a href="stopBiker.php?timeField='.$timeField.'>NON, ANNULER</a>';
		?>
	</body>
</html>