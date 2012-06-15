<?php
	/*
		file: 	deletePatrol.php
		author: Beno�t Uffer
		
		Si on arrive � ce fichier, �a veut dire que l'utilisateur a cliqu� sur le lien "supprimer" � cot� d'une patrouille
		dans la page d'�dition d'une troupe.
		
		On prend dans la DB le nom de la patrouille, et on demande confirmation � l'utilisateur de la supprimer
	*/
include_once("globals.php");
include_once("sql.php");

// on r�cup�re les variables GET dans des variables locales pour ce script
$patrolId = getParameterGET("id");
$bsNum = getParameterGET("bsNum"); // on garde le bsNum pour retourner automatiquement � la page de la bonne troupe apres destruction

// connection � la base de donn�es:
connect();


// On r�cup�re le nom de la patrouille qu'on veut afficher pour l'utilisateur:
$query = 'select name from t_patrol where id="'.$patrolId.'"';
$res = mysql_query($query);
// on regarde si on a bien 1 et 1 seul patrouille avec cet id:
$number_of_patrol = mysql_num_rows($res);
if($number_of_patrol!=1)
{
	exit('error: Il y a '.$number_of_patrol.' patrouille avec id="'.$id.'" dans la base de donn�e (alors qu\'il devrait y en avoir 1)');
}
$row = mysql_fetch_assoc($res);
$name = $row["name"];

?>

<html>
	<head>
		<title>CRITERIUM DE CHANDELARD</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	
	<body>
	<?php
		// on affiche une demande de confirmation de la suppression � l'utilisateur:
		echo '<h2>Etes-vous sur de vouloir supprimer la patrouille '.$name.'?</h2>';
		echo '<br><br>';
		echo '<a href="deletePatrolConfirmed.php?id='.$patrolId.'&bsNum='.$bsNum.'">OUI, SUPPRIMER</a>';
		echo '<br><br>';
		echo '<a href="editTroop.php?bsNum='.$bsNum.'">NON, ANNULER</a>';
	?>
	</body>
</html>