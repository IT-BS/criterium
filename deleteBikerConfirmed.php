<?php
	/*
		file: 	deleteBikerConfirmed.php
		author: Beno�t Uffer
		
		Si on arrive � ce fichier, �a veut dire que l'utilisateur a confirm� qu'on pouvait d�truire le biker concern�
		(on le distingue gr�ce � son "id"
	*/
include_once("globals.php");
include_once("sql.php");



// On r�cup�re l'id du biker � d�truire:
$id = getParameterGET("id");

// connection � la DB:
connect();


// il faut r�cup�rer la patrol_id � laquelle le biker appartient de sorte � pouvoir rediriger directement
// vers la bonne patrouille
$query = 'select patrol_id from t_biker where id="'.$id.'"';
$res = mysql_query($query);
$row = mysql_fetch_assoc($res);
$patrolId = $row["patrol_id"];

// on d�truit le biker:
$query = 'delete from t_biker where id="'.$id.'"';
if(!mysql_query($query))
{
	exit("la destruction a �chou�");
}

// on redirige automatiquement vers la page d'�dition de la patrouille
// il se peut qu'un param�tre de plus, src, soit pr�sent.
// c'est si on arrive ici en ayant fait admin->tests->supprimer plutot que admin->edit troupe->edite patrouille->supprimer.
if(isset($_GET["src"]))
{
	$src=$_GET["src"];
	header('Location: '.$src.'.php');
}
else
{
	header('Location: editPatrol.php?patrol_id='.$patrolId);
}



?>