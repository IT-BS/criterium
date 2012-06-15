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
$bikerId = getParameterPOST("bikerId");
$dossard = getParameterPOST("dossard");
$firstName = getParameterPOST("firstName");
$lastName = getParameterPOST("lastName");
$birthYear = getParameterPOST("birthYear");
$patrolId = getParameterPOST("patrolId"); // on a besoin de �a pour rediriger vers la bonne page

$firstName = formatCase($firstName);
$lastName = formatCase($lastName);

// on v�rifie que tous les champs on �t� remplis:
if(trim($firstName)=="" || trim($lastName)=="")
{
	exit("Erreur: au moins un champs n'a pas �t� rempli");
}

// SI ET SEULEMENT SI le numero de dossard a �t� entr�, alors:
if(trim($dossard)!="")
{
	
	// 1) on v�rifie que c'est un nombre entier:
	if(!is_a_number($dossard))
	{
		exit("erreur: le dossard doit etre un nombre entier");
	}
	
	// 2) numero de dossard: il peut d�ja exister pour le m�me biker, si
	// on est en train d'�diter seulement le nom ou le pr�nom.
	// on doit donc v�rifier que le numero de dossare n'existe pas POUR UN AUTRE BIKER ID:
	$query = 'select * from t_biker where dossard="'.$dossard.'" and id!="'.$bikerId.'"';
	$res = mysql_query($query);
	// on regarde combien de record existent d�ja dans la DB (�a devrait �tre 0):
	$number_of_biker = mysql_num_rows($res);
	if($number_of_biker >= 1)
	{
		exit('erreur: ce numero de dossard existe deja dans la base de donn�es pour un autr biker');
	}
}
else
{
	// si le dossard n'a pas �t� entr�, on met un -1 (qui signifie "inconnu")
	$dossard=UNKNOWN;
}

// SI ET SEULEMENT SI l�nn�e a �t� entr�, alors:
if(trim($birthYear)!="")
{	
	// 1) on v�rifie que c'est un nombre entier:
	if(!is_a_number($birthYear))
	{
		exit("erreur: l\'ann�e doit etre un nombre entier");
	}
}
else
{
	// si le dossard n'a pas �t� entr�, on met un -1 (qui signifie "inconnu")
	$birthYear=UNKNOWN;
}

//Modification dans la DB:


$query = 'update t_biker set dossard="'.$dossard.'", firstName="'.$firstName.'", lastName="'.$lastName.'", birthYear="'.$birthYear.'" where id="'.$bikerId.'"';
if(!mysql_query($query))
{
	exit('erreur lors de la requete SQL');
}

//4) on redirige automatiquement � la page d'�dition de la patrouille courante (ce qui affichera le nouveau gars et qui 
//		permettra d'en ajouter encore d'autres):

// il se peut qu'un param�tre de plus, src, soit pr�sent.
// c'est si on arrive ici en ayant fait admin->tests plutot que admin->edit troupe->edite patrouille->edit biker.
if(isset($_POST["src"]))
{
	$src=$_POST["src"];
	header('Location: '.$src.'.php');
}
else
{
	header('Location: editPatrol.php?patrol_id='.$patrolId);
}
?>
