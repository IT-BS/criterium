<?php
	/*
		file: 	WARNING_createVirginDB.php
		author: Beno�t Uffer
	*/

include_once("sql.php");
include_once("globals.php");

// connect db:
connect();

$createBikerTable  	=	"CREATE TABLE t_biker (id INTEGER NOT NULL AUTO_INCREMENT, dossard INTEGER, firstName TEXT, lastName TEXT, birthYear INTEGER, patrol_id INTEGER, startTime1 INTEGER, endTime1 INTEGER, startTimeAttack INTEGER, endTimeAttack INTEGER, startTime2 INTEGER, endTime2 INTEGER, PRIMARY KEY(id))";
$createpatrolTable 	= "CREATE TABLE t_patrol (id INTEGER NOT NULL AUTO_INCREMENT, name TEXT, troop_id INTEGER, PRIMARY KEY(id))";
$createtroopTable 	= "CREATE TABLE t_troop (bsNum INTEGER, name TEXT, type INTEGER)";
$createYearTable		= "CREATE TABLE t_year (year INTEGER)";
$createLimitsTable		= "CREATE TABLE t_limits (minBiker INTEGER, maxBiker INTEGER, bonusSeconds INTEGER)";
$createTimeAttackFactor		= "CREATE TABLE t_factor (timeAttackFactor INTEGER)";


// 1) drop existing tables;
mysql_query("drop table t_biker");
mysql_query("drop table t_patrol");	
mysql_query("drop table t_troop");
mysql_query("drop table t_year");
mysql_query("drop table t_factor");


// 2) create new tables:
if(!mysql_query($createBikerTable))			{exit("la cr�ation de la table des bikers a �chou�");}
if(!mysql_query($createpatrolTable)){exit("la cr�ation de la table des patrouilles a �chou�");}
if(!mysql_query($createtroopTable))		{exit("la cr�ation de la table des troupes a �chou�");}
if(!mysql_query($createYearTable))		{exit("la cr�ation de la table des ann�es a �chou�");}
if(!mysql_query($createLimitsTable))		{exit("la cr�ation de la table des limites a �chou�");}
if(!mysql_query($createTimeAttackFactor))		{exit("la cr�ation de la table des temps TA a �chou�");}

// 3) fill tables (we fill only troops and patrols as biker will be filled manually before criterium starts
//troops gars:
if(!mysql_query('insert into t_troop values ("'.ZANFLEURON.'", "Zanfleuron", "'.ECLAIREUR.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.MANLOUD.'", 		"Manloud",    "'.ECLAIREUR.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.NEUVAZ.'", 		"Neuvaz",     "'.ECLAIREUR.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.CHANDELARD.'", "Chandelard", "'.ECLAIREUR.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.BERISAL.'", 		"Berisal",    "'.ECLAIREUR.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.MONTFORT.'", 	"Montfort",   "'.ECLAIREUR.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.LOVEGNO.'", 		"Lovegno",    "'.ECLAIREUR.'")')){exit("la cr�ation d'une troop a �chou�");}
//troops filles:
if(!mysql_query('insert into t_troop values ("'.SOLALEX.'", "Solalex",   "'.ECLAIREUSE.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.GRAMMONT.'", "Grammont",  "'.ECLAIREUSE.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.ARMINA.'", "Armina",    "'.ECLAIREUSE.'")')){exit("la cr�ation d'une troop a �chou�");}
//troops rouges gar�ons:
if(!mysql_query('insert into t_troop values ("'.ROVEREAZ.'", "Rovereaz",    "'.ROUGE_G.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.ORZIVAL.'", "Orzival",    "'.ROUGE_G.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.TSALION.'", "Tsalion",    "'.ROUGE_G.'")')){exit("la cr�ation d'une troop a �chou�");}
//troops rouges filles:
if(!mysql_query('insert into t_troop values ("'.SESAL.'", "Sesal",    "'.ROUGE_F.'")')){exit("la cr�ation d'une troop a �chou�");}
if(!mysql_query('insert into t_troop values ("'.TAMARO.'", "Tamaro",    "'.ROUGE_F.'")')){exit("la cr�ation d'une troop a �chou�");}
//le clan
if(!mysql_query('insert into t_troop values ("'.CLAN.'", "Le Clan",    "'.CLANS.'")')){exit("la cr�ation d'une troop a �chou�");}
//patrol gars:
if(!mysql_query('insert into t_patrol values ("NULL", "Aigles", 				"'.ZANFLEURON.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Castors", 			"'.ZANFLEURON.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Lynx", 					"'.ZANFLEURON.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Bouquetins", 		"'.ZANFLEURON.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Loups", 				"'.MANLOUD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Hermines", 			"'.MANLOUD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Eperviers", 		"'.MANLOUD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Taureaux", 			"'.MANLOUD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Cigognes", 			"'.NEUVAZ.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Antilopes", 		"'.NEUVAZ.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Loutres", 			"'.NEUVAZ.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "H�rons", 				"'.NEUVAZ.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Renards", 			"'.NEUVAZ.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Chauves-souris","'.NEUVAZ.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Rennes",				"'.CHANDELARD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Marmottes",			"'.CHANDELARD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Poussins-Coqs",	"'.CHANDELARD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Cygnes",				"'.CHANDELARD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Yacks",					"'.CHANDELARD.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Pantheres",			"'.BERISAL.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Koalas",				"'.BERISAL.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Cerfs",					"'.BERISAL.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Faucons",				"'.BERISAL.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Jean-Bart",			"'.MONTFORT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Fregate",				"'.MONTFORT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Surcouf",				"'.MONTFORT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Galion",				"'.MONTFORT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Cobras",				"'.LOVEGNO.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Phenix",				"'.LOVEGNO.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Tigres",				"'.LOVEGNO.'")')){exit("la cr�ation d'une patrol a �chou�");}
//patrol filles:
if(!mysql_query('insert into t_patrol values ("NULL", "Hirondelles",		"'.SOLALEX.'")')){exit("la cr�ation d'une patrol a �chou�");}   
if(!mysql_query('insert into t_patrol values ("NULL", "Ratons-Laveurs","'.SOLALEX.'")')){exit("la cr�ation d'une patrol a �chou�");}   
if(!mysql_query('insert into t_patrol values ("NULL", "Goelands",			"'.SOLALEX.'")')){exit("la cr�ation d'une patrol a �chou�");}   
if(!mysql_query('insert into t_patrol values ("NULL", "Pandas",				"'.SOLALEX.'")')){exit("la cr�ation d'une patrol a �chou�");}   
if(!mysql_query('insert into t_patrol values ("NULL", "Gazelles",			"'.SOLALEX.'")')){exit("la cr�ation d'une patrol a �chou�");}   
if(!mysql_query('insert into t_patrol values ("NULL", "Licornes",			"'.GRAMMONT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Chevreuils",		"'.GRAMMONT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Fennecs",				"'.GRAMMONT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Okapis",				"'.GRAMMONT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Kangourous",		"'.GRAMMONT.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Impalas",				"'.ARMINA.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Mangoustes",		"'.ARMINA.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Coyotes",				"'.ARMINA.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "Cameleons",				"'.ARMINA.'")')){exit("la cr�ation d'une patrol a �chou�");}

//dummy patrols for Rouges:
if(!mysql_query('insert into t_patrol values ("NULL", "tout Rovereaz",				"'.ROVEREAZ.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "tout Orzival",				"'.ORZIVAL.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "tout Tsalion",				"'.TSALION.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "tout Sesal",				"'.SESAL	.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "tout Tamaro",				"'.TAMARO	.'")')){exit("la cr�ation d'une patrol a �chou�");}
if(!mysql_query('insert into t_patrol values ("NULL", "tout le Clan",				"'.CLAN	.'")')){exit("la cr�ation d'une patrol a �chou�");}

// minimum year:
// l'ann�e minimum est l'ann�e de naissance des gars qui ont 15 ans cette ann�e
$minimalYear = date("Y")-15;
if(!mysql_query('insert into t_year values ("'.$minimalYear.'")')){exit("la cr�ation d'une year a �chou�");}
	
// limits: creer les limites par d�faut:
// - en dessous de 3 gars/fille par patrouille, la patrouille ne compte pas au classement des patrouilles
// - au dessus de 6 gars/fille par patrouille, il y a un bonus pour la patrouille
// - le bonus est de 30 secondes par gars/fille en plus
if(!mysql_query('insert into t_limits values ("3","6","30")')){exit("la cr�ation d'une limit a �chou�");}

// time attack factor:
// nombre par lequel le temps du contre la montre doit �tre multipli�. Par d�faut le contre la montre vaut 5 fois plus.
if(!mysql_query('insert into t_factor values ("5")')){exit("la cr�ation du facteur a �chou�");}

?>

<html>
	<head>
		<title>create virgin DB</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	<body>

	
<?php
	echo '<br><br>';
	echo '<span class="prompt">Done!</span>';
	echo '<br><br>';

	displayFooter();	
?>
		
	</body>
</html>
