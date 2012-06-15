<?php
	/*
		file: 	criterium.php
		author: Beno�t Uffer
		
		c'est le point d'entr�e de tout le programme criterium
	*/
include_once("sql.php");
include_once("globals.php");

// connection � la base de donn�e
connect();

// on essaye de cr�er les tables t_biker, t_troop et t_patrol (au cas ou c'est la toute premi�re utilisation)
// si elle existent d�ja, �a va simplement �chouer.
$createBikerTable  	=	"CREATE TABLE t_biker (id INTEGER NOT NULL AUTO_INCREMENT, dossard INTEGER, firstName TEXT, lastName TEXT, birthYear INTEGER, patrol_id INTEGER, startTime1 INTEGER, endTime1 INTEGER, startTime2 INTEGER, endTime2 INTEGER, PRIMARY KEY(id))";
$createpatrolTable 	= "CREATE TABLE t_patrol (id INTEGER NOT NULL AUTO_INCREMENT, name TEXT, troop_id INTEGER, PRIMARY KEY(id))";
$createtroopTable 	= "CREATE TABLE t_troop (bsNum INTEGER, name TEXT, type INTEGER)";
$createYearTable		= "CREATE TABLE t_year (year INTEGER)";
$createLimitsTable		= "CREATE TABLE t_limits (minBiker INTEGER, maxBiker INTEGER, bonusSeconds INTEGER)";
mysql_query($createBikerTable);
mysql_query($createpatrolTable);
mysql_query($createtroopTable);
if(mysql_query($createYearTable))
{
	// si la creation a reussi, il faut mettre des valeurs par d�faut:
	// minimum year:
	// l'ann�e minimum est l'ann�e de naissance des gars qui ont 15 ans cette ann�e
	$minimalYear = date("Y")-15;
	if(!mysql_query('insert into t_year values ("'.$minimalYear.'")')){exit("la cr�ation d'une year a �chou�");}
}
if(mysql_query($createLimitsTable))
{
	// si la creation a reussi, il faut mettre des valeurs par d�faut:
	// - en dessous de 3 gars/fille par patrouille, la patrouille ne compte pas au classement des patrouilles
	// - au dessus de 6 gars/fille par patrouille, il y a un bonus pour la patrouille
	// - le bonus est de 30 secondes par gars/fille en plus
	if(!mysql_query('insert into t_limits values ("3","6","30")')){exit("la cr�ation d'une patrol a �chou�");}
}

// on r�cup�re la liste de toutes les troupes existantes dans la base de donnn�es, leurs identificatuers (bsNum) et leurs noms:
$query = 'select * from t_troop order by bsNum';
$res = mysql_query($query);
// on r�cup�re le nombre d'enregistrement:
$number_of_troop = mysql_num_rows($res);
for($j=0;$j<$number_of_troop;$j++)
{
	$row = mysql_fetch_assoc($res);
	$troupe[$j]["bsNum"] = $row["bsNum"];
	$troupe[$j]["name"] = $row["name"];
}

?>

<html>
	<head>
		<title>CRITERIUM DE CHANDELARD</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
		
	</head>
	
	<body>
		
		<h3>Donner le signal de d�part d'une patrouille</h3>
		<?php
			if($number_of_troop>0)
			{
				for($j=0;$j<$number_of_troop;$j++)
				{
					echo '<a href="startTroop.php?bsNum='.$troupe[$j]["bsNum"].'">d�part d\'une patrouille de '.$troupe[$j]["name"].'</a><br>';
				}
			}
			else
			{
				echo '<span class="alert">Attention:</span>';
				echo 'il n\'existe encore aucune troupe dans la base de donn�e';
			}
		?>
		
		<h3>Arriv�e d'un participant</h3>
		<a href="stopBiker.php?timeField=endTime1">Etape du matin</a>
		<br>
		<a href="stopBiker.php?timeField=endTimeAttack">Contre la montre</a>
		<br>
		<a href="stopBiker.php?timeField=endTime2">Etape de l'apr�s-midi</a>
		
		<h3>Resultats</h3>
		(avant d'afficher les r�sultats, pensez � faire les tests propos�s dans la page d'administration)
		<?php
		br(2);
		echo '<a href="resultsPerYear.php">Classement des Gars/Filles/Rouges par ann�e de naissance</a><br>';
		echo '<a href="resultsBikers.php">Classement des Gars/Filles/Rouges tous ages confondus</a><br>';
		echo '<a href="resultsPatrols.php">Classement des Patrouilles</a><br>';
		echo '<a href="resultsTroops.php">Classement des Troupes</a><br>';

		displayFooter();
		?>

		
	</body>
</html>

