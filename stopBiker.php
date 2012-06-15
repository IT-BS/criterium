<?php
/*
	file: 	stopBiker.php
	author: Beno�t Uffer
	
	Ce fichier permet � l'utilisateur d'entrer l'heure d'arriv�e d'un dossard � une �tape.
	Pour arriver � ce fichier une premi�re fois, l'utilisateur � cliqu� sur un lien qui est diff�rent pour l'�tape du matin
	ou de l'apres midi. L'�tape est ainsi d�ja connue par la m�thode GET quand ce script est execut�.
	Le num�ro de dossard et l'heure d'arriv�e vont �tre choisie par l'utilisateur sur cette page.
*/

include_once("globals.php");

// on r�cup�re le timefield (sivant � quelle etape on arrive, on change pas le meme champs dans la base de donn�e)
$timeField = getParameterGET("timeField");	

?>

<html>
	<head>
		<title>CRITERIUM DE CHANDELARD</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
		
		<script type="text/javascript">
			function setFocus() {
				document.forms['stopBiker'].elements['dossard'].focus();		
			}
		</script>
	</head>
	
	<body onload="setFocus()">
	
	
	<?php
		// on affiche un titre diff�rent suivant la "phase"
		if($timeField=="endTime1")
		{
			echo '<h3>Etape du matin</h3>';
		}
		if($timeField=="endTimeAttack")
		{
			echo '<h3>Contre le montre</h3>';
		}
		if($timeField=="endTime2")
		{
			echo '<h3>Etape de l\'apres-midi</h3>';
		}
	
	
	/*
	Voici le formulaire qui permet d'entrer le num�ro du dossard, et le temps d'arriv�e:
	a choix: en utilisant le temps de l'ordinateur, ou en entrant une heure manuellement.
	on passe le timefield en GET
	*/
echo '	<form name="stopBiker" action="stopBikerCheck.php?timeField='.$timeField.'" method="POST">';
echo '		<h3>1) Numero du dossard:</h3>                ';
echo '		<label for="pmId">Numero du dossard:</label>';
echo '		<input type="text" name="dossard" id="dossardId" size="3">';
echo '		<br>';
echo '		<h3>2) Choisissez la m�thode:</h3>';
echo '		<input type="radio" name="method" value="system" id="systemId" checked>';
echo '		<label for="systemId">Utiliser le temps de l\'ordinateur</label>';
echo '		<br>';
echo '		<input type="radio" name="method" value="manual" id="manualId">';
echo '		<label for="manualId">Entrez un temps manuellement:</label>';
echo '		<br><br>';
echo '		<input type="text" name="hh" value="HH" size="2">:<input type="text" name="mm" value="MM" size="2">:<input type="text" name="ss" value="SS" size="2">';
echo '	<br></br>';
echo '		<input type="submit" value="STOP">';
echo '	</form>';
	
	

	// affichage du pied de page:
	displayFooter()
	?>
		
	</body>
</html>