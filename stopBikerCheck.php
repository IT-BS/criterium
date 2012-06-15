<?php
/*
	file: 	stopBikerCheck.php
	author: Beno�t Uffer
	
	L'utilisateuir a entr� dans la page pr�c�dente le num�ro de dossard et l'heure d'arriv�e.
	On les r�cup�re ici et on va les entrer dans la base de donn�e.
	On v�rifie que le numero de dossard est diff�rent de "UNKNOWN". ( -1, c'est le numero qu'on met quand on ne connait pas encore
	Le vrai num�ro et qu'on veut d�ja entrer le biker dans la base de donn�e. C'est donc le seul num�ro pour lequel un
	doublon est accept�.
	Ensuite on va s'assurer que l'heure d'arriv�e de l'�tape courante n'as pas d�ja �t� fix� pour le dossard courant:
	On v�rifie dans la base de donn�e. si l'heure vaut "0" c'est qu'elle n'a pas encore �t� fix�e. On passe donc directement au
	fichier stopBikerDone.php qui va fair les modifs dans la base de donn�e
	Si elle a d�ja �t� fix�e, on passe par une �tape interm�diaire: stopBikerPrompt.php qui notifie l'utilisateur que l'heure � d�ja �t�
	fix�e pour ce dossard, et il peut choisir d'annuler ou de continuer.
*/


include_once("globals.php");
include_once("sql.php");


//set local variable from form:
$dossard = getParameterPOST("dossard");
if($dossard == UNKNOWN)
{
	exit("erreur: numero de dossard invalide!");
}

$timeField = getParameterGET("timeField");


// on regarde quelle m�thode � �t� choisie
if(isset($_POST['method']))
{
	$method = $_POST['method'];
}
else
{
	// normalement, � ce stade il est impossible que $timeField ne soit pas "sett�", mais mieux vaut v�rifier.
	exit('erreur: vous n\'avez pas choisi la m�thode');
}

if($method=="system")
{
	// L'utilisateur a choisi d'utiliser l'heure de l'ordinateur:
	$arrivalTime = time();
}
else if($method=="manual")
{
	// L'utilisateur a choisi d'entrer une heure manuellement. On lit l'heure qu'il a entr� (method POST)
	$h = $_POST["hh"];
	$m = $_POST["mm"];
	$s = $_POST["ss"];
	$arrivalTime=mktime($h,$m,$s);
}
else
{
	// normalement c'set impossible que la m�thode n'ai pas �t� d�finie car ce sont des boutons radio avec une valeur par d�faut,
	// mais v�rifions tout de m�me:
	exit("erreur: la methode n'as pas �t� d�finie");
}


// connection � la base de donn�e:
connect();


// On v�rifie que ce num�ro de dossard existe bel et bien dans la base de donn�e, et qu'il existe une seule fois!
$query = 'select '.$timeField.' from t_biker where dossard="'.$dossard.'"';
$res = mysql_query($query);
// on regarde le nombre de ligne de la r�ponse (= au nombre de fois que ce dossard existe dans la DB)
$number_of_biker = mysql_num_rows($res);
if($number_of_biker!=1)
{
	// erreur: le nombre de fois que le dossard existe dans la DB n'est pas 1
	exit('erreur: Il y a '.$number_of_biker.' bikers avec id="'.$dossard.'" dans la base de donn�e (alors qu\'il devrait y en avoir 1)');
}

// On v�rifie que le temps d'arriv�e du dossard courant � l'�tape courante est -1. (= pas encore initialis�)
$row = mysql_fetch_assoc($res);
$fieldValue = $row[$timeField];
if($fieldValue != UNKNOWN)
{
	// attention: il y a d�ja un temps d'arriv�e pour ce dossard et pour cette etape. Il faut averitir l'utilisateur plutot
	// que de modifier la DB directement:
	header('Location: stopBikerPrompt.php?timeField='.$timeField.'&dossard='.$dossard.'&arrivalTime='.$arrivalTime.'');
}
else
{
	// c'est bon. On peut directement modifier la DB
	header('Location: stopBikerDone.php?timeField='.$timeField.'&dossard='.$dossard.'&arrivalTime='.$arrivalTime.'');
}

