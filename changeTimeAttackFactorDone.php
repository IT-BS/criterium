<?php
	/*
		file: 	changeTimeAttackFactorDone.php
		author: Christian Muller
	*/

include_once("globals.php");
include_once("sql.php");


// connection � la base de donn�e
connect();


//On prend les info entr�es par l'utilisateur dans le forumlaire et envoy�es par la m�thode POST:
$timeAttackFactor = getParameterPOST("timeAttackFactor");

// verification des param�tres entr�s:
if(trim($timeAttackFactor)!="")
{	
	// 1) on v�rifie que c'est un nombre entier:
	if(!is_a_number($timeAttackFactor))
	{
		exit("erreur: le facteur de multiplication doit etre un nombre entier");
	}
}
else
{
	exit('il faut pas laisser le champ libre, nigaud!');
}

//Modification dans la DB:
setTimeAttackFactor($timeAttackFactor);

//4) on redirige automatiquement � la page d'admin 
header('Location: admin.php');
?>
