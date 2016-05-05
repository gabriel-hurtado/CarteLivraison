<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>

<?php

	
	echo "<h2>Mise à jour de route</h2>";
	echo "<div align=center>";

	$nom= $_POST['choixrue'];
	$access= $_POST['access'];
 	
	include "connect.php";//Fichier de connection à la BD

	$vConnect = fConnect(); //Connexion initiale ?

	$vSql ="UPDATE proRoute SET accessibilite = '$access' WHERE route_nom = '$nom'";
	$vResult =pg_query($vConnect, $vSql);
	echo "la route a bien été modifiée !";
	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";

	/*---------------*/

	pg_close($vConnect);
	echo "</div>";
?>
</body>
</html>
