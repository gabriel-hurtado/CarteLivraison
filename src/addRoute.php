<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>

<?php
	echo "<h2>Ajouter une route</h2>";
	echo "<div align=center>";

	$typerue= $_POST['typerue'];
	$nom= $_POST['nom'];
	$access= $_POST['access'];

	include "connect.php";//Fichier de connection à la BD

	$vConnect = fConnect(); //Connexion initiale ?
			$vSql ="SELECT * from proRoute where route_nom='$nom'";
			$result =pg_query($vConnect, $vSql);
			$rowCnt = pg_num_rows($result);

			if($rowCnt == 1){
			 echo"Route déjà enregistré ! <br>";
			 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			}
			else{
			  	$vConnect = fConnect();
				$vSql ="INSERT INTO proRoute(route_nom, type, accessibilite) VALUES ('$nom', '$typerue', '$access')";
				$vResult =pg_query($vConnect, $vSql);
				echo "la route a bien été ajoutée ! <a href='addJonction.php'>Raccordez la à la carte grâce à une jonction </a>";
				echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			}
	/*---------------*/

	pg_close($vConnect);
	echo "</div>";
?>
</body>
</html>
