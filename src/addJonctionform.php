<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>

<?php

	
	echo "<h2>Jonction de route</h2>";
	echo "<div align=center>";

	$typejonc= $_POST['typejonc'];
 	
	include "connect.php";//Fichier de connection à la BD

  	$vConnect = fConnect(); 
	$vSql ="INSERT INTO proJonction(id, type) VALUES (DEFAULT, '$typejonc')";
	$vResult =pg_query($vConnect, $vSql);
	
	$vSql ="SELECT MAX(id) FROM proJonction";
	$idJonction =pg_query($vConnect, $vSql);
	$id = pg_fetch_array($idJonction);
	echo "$idJonction[0]";

	if(isset($_POST['route'])){
	    foreach($_POST['route'] as $route){
	        $vSql ="INSERT INTO proJonctionRoute(jonction_id, route_nom) VALUES ('$id[0]', '$route')";
			$vResult =pg_query($vConnect, $vSql);
	    }
	}
	
	echo "la jonction a bien été ajoutée !";
	/*---------------*/

	pg_close($vConnect);
	echo "</div>";
?>
</body>
</html>
