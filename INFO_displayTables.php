<?php
	/*
		file: 	INFO_displayTables.php
		author: Beno�t Uffer
		
		On affiche les tables et leur contenu
	*/
include_once("sql.php");
include_once("globals.php");

// connection � la DB:
connect();


?>

<html>
	<head>
		<title>TABLES</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	
	<body>
		
		<?php
			displayTable("t_biker");
			echo "<br>";
			displayTable("t_troop");
			echo "<br>";
			displayTable("t_patrol");
			echo "<br>";
			displayTable("t_year");
			echo "<br>";
			displayTable("t_limits");
			echo "<br>";
			
			displayFooter();
		?>
		
	</body>
</html>