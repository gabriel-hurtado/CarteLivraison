<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>

<?php
			date_default_timezone_set('Europe/Paris');
			/*Récupération des variables du formulaire*/
			$qte = $_POST['qte'];
			$produit= $_POST["produit"];

	    echo "<h2>Réaprovisionnement</h2>";
	    echo "<div align=center>";

			include "connect.php";//Fichier de connection à la BD

		  $vConnect = fConnect(); //Connexion initiale ?

      $vSql = "UPDATE proMarchandise SET stock = stock + '$qte' WHERE id= '$produit' ";
      $result =pg_query($vConnect, $vSql);

      if($result != FALSE){
        echo "<h1>Réapprovisionnement effectué !</h1><br>";
        echo "<a href=\"reapprovisionnement.php\"><input type='button' value='Retour'>";
      }
      else{
        echo "<strong>ERROR UPDATE DATABASE</strong>";
      }

      echo "</div>";
?>


</body>

</html>
