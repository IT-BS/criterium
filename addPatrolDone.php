<?php
	/*
		file: 	addPatrolDone.php
		author: Beno�t Uffer
		
		On arrive a ce script apres avoir "cr�e" une nouvelle patrouille dans le fichier "addPatrol.php"
		On v�rifie que le champ n'est pas vide, et que la patrouille n'existe pas d�ja, ensuite c'est bon:
		On modifie la DB
	*/

include_once("sql.php");
include_once("globals.php");

// recuperation des param�tres GET:
$patrolName = getParameterGET("patrolName");
$bsNum = getParameterGET("bsNum");

// on v�rifie que le nom de la patrouille a �t� rempli:
if(trim($patrolName)=="")
{
	exit("Erreur: le nom de la patrouille ne peut pas �tre vide");
}

// connection � la base de donn�e
connect();


// On v�rifie que cette patrouille n'existe pas d�ja dans la base de donn�e:
// PROBLEMES: cette v�rification est case-sensitive:
// donc si on veut ajouter "aigles" et que dans la base il y a "Aigles", alors
// �a va marcher. Pour y remedier, on utilise la fonction formatCase() qui retourne
// une cha�ne dont la premiere lettre uniquement est en majuscule. On fait de m�me quand on
// ajoute une cha�ne dans la base, donc on utilise QUE des cha�nes qui ont ce format.
// un autre probl�me est le pluriel: "Aigle" est diff�rent de "Aigles"
// pour y remedier, on ne peut que demander � l'utilisateur d'�crire le nom de la patrouille
// au pluriel � chaque fois et esp�rer qu'il le fait.
// le dernier probl�me est les accents. Je ne suis pas sur de la fa�on dont ils sont g�r�s
// (est-ce que l'encodage dans le navigateur est le m�me que dans la base? quel impact �a a?
// c'est un domaine dans lequel je ne suis pas � l'aise)
$query = 'select * from t_patrol where name="'.formatCase($patrolName).'"';
$res = mysql_query($query);
// on regarde combien de record existent d�ja dans la DB (�a devrait �tre 0):
$number_of_patrol = mysql_num_rows($res);
if($number_of_patrol >= 1)
{
	exit('erreur: il y a d�ja une patrouille avec le m�me nom dans la base de donn�es.');
}


//3) Insertion dans la DB:
$query = 'insert into t_patrol values("NULL", "'.formatCase($patrolName).'","'.$bsNum.'")';
if(!mysql_query($query))
{
	exit('erreur lors de la requete SQL');
}

//4) on redirige automatiquement � la page d'�dition de la patrouille courante (ce qui affichera le nouveau gars et qui 
//		permettra d'en ajouter encore d'autres):
header('Location: editTroop.php?bsNum='.$bsNum);
?>