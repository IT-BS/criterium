<?php
	/*
		file: 	editBikerDone.php
		author: Beno�t Uffer
		
		On arrive � ce script si on veut modifier des donn�es d'un biker. (changer son numero de dossard par exemple)
	*/

include_once("sql.php");
include_once("globals.php");



// connection � la base de donn�e
connect();


//On prend les info entr�es par l'utilisateur dans le forumlaire et envoy�es par la m�thode POST:
$minYear = getParameterPOST("minYear");

// SI ET SEULEMENT SI l'ann�e a �t� entr�, alors:
if(trim($minYear)!="")
{	
	// 1) on v�rifie que c'est un nombre entier:
	if(!is_a_number($minYear))
	{
		exit("erreur: l\'ann�e doit etre un nombre entier");
	}
}
else
{
	exit('il faut pas laisser le champ libre, nigaud!');
}


//Modification dans la DB:
setMinimalYear($minYear);

//4) on redirige automatiquement � la page d'admin 
header('Location: admin.php');
?>
