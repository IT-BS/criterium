<?php
	/*
		file: 	deleteTroopConfirmed.php
		author: Beno�t Uffer
		
		Si on arrive � ce fichier, �a veut dire que l'utilisateur a confirm� qu'on pouvait d�truire la patrouille concern�e
		(on la distingue gr�ce � son "bsNum")
	*/
include_once("globals.php");
include_once("sql.php");


//on r�cup�re les bsNum:
$bsNum = getParameterGET("bsNum");


// connection � la DB:
connect();


// on d�truit la troupe:
$query = 'delete from t_troop where bsNum="'.$bsNum.'"';
if(!mysql_query($query))
{
	exit("la destruction de la troupe a �chou�");
}

// on r�cup�re la liste des patrol_id de cette troupe:
$query = 'select id from t_patrol where troop_id="'.$bsNum.'"';
$res = mysql_query($query);
$number_of_patrol = mysql_num_rows($res);
for($i=0;$i<$number_of_patrol;$i++)
{
	$row = mysql_fetch_assoc($res);
	$patrolId[$i]= $row["id"];
}

// on detruit toutes les patrouilles de cette troupe:
// on d�truit la troupe:
$query = 'delete from t_patrol where troop_id="'.$bsNum.'"';
if(!mysql_query($query))
{
	exit("la destruction des patrouilles de la troupe a �chou�");
}

// on detruit tous les bikers de la troupe (grace aux id de patrouilles r�cup�r�s:
for($i=0;$i<$number_of_patrol;$i++)
{
	$query = 'delete from t_biker where patrol_id="'.$patrolId[$i].'"';
	if(!mysql_query($query))
	{
		exit("la destruction d'un biker de la troupe a �chou�");
	}
}


// on detruit tous les gars/filles de cette troupe:

// on redirige automatiquement vers la page d'�dition de la patrouille
header('Location: admin.php');

?>