<?php
	/*
		file: 	deletePatrolConfirmed.php
		author: Beno�t Uffer
		
		Si on arrive � ce fichier, �a veut dire que l'utilisateur a confirm� qu'on pouvait d�truire la patrouille concern�e
		(on la distingue gr�ce � son "id")
	*/
include_once("globals.php");
include_once("sql.php");


// on r�cup�re les variables GET dans des variables locales pour ce script
$patrolId = getParameterGET("id");
$bsNum = getParameterGET("bsNum"); // on garde le bsNum pour retourner automatiquement � la page de la bonne troupe apres destruction


// connection � la DB:
connect();


// on d�truit la patrouille:
$query = 'delete from t_patrol where id="'.$patrolId.'"';
if(!mysql_query($query))
{
	exit("la destruction a �chou�");
}

// on detruit tous les gars/filles de cette patrouille:
$query = 'delete from t_biker where patrol_id="'.$patrolId.'"';
if(!mysql_query($query))
{
	exit("la destruction a �chou�");
}

// on redirige automatiquement vers la page d'�dition de la patrouille
header('Location: editTroop.php?bsNum='.$bsNum);

?>