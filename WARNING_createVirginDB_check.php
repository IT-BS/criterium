<?php
	
	
?>

<html>
	<head>
		<title>CRITERIUM DE CHANDELARD</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	
	<body>
		
		<?php
		
		echo '<span class="alert">';
		echo 'ATTENTION:<br>';
		echo 'Ceci aura pour effet de remettre � z�ro la base de donn�e,<br>';
		echo 'De cr�er les troupes et les patrouilles selon le mod�le<br>';
		echo 'Et d\'effacer tous les gars/filles<br>';
		echo '<br>Etes-vous s�r??<br>';
		echo '</span>';
		
		echo '<a href="WARNING_createVirginDB.php">OUI</a><br><br>';
		echo '<a href="admin.php">NON</a><br><br>';
		
		
		?>
		
	</body>
</html>