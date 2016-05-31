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

      $jour= $_POST["jour"];
    	$mois= $_POST["mois"];
    	$annee= $_POST["annee"];

	    echo "<h2>Réaprovisionnement</h2>";
	    echo "<div align=center>";

			include "connect.php";//Fichier de connection à la BD

      if (empty($jour) or empty($mois) or empty($annee)) {
      		$jour = '01';
      		$mois = '01';
      		$annee = '1970';
      }

      	$date=$annee."-".$mois."-".$jour;

      	if($date != '1970-01-01'){
      		/* Date du jour */
      		date_default_timezone_set('Europe/Paris');
      		$today = date("Ymd");
      		// on formate les dates selon le format Ymd
      		$today = new DateTime( $today );
      		$today = $today->format("Ymd");
      		$date = new DateTime( $date );
      		$date = $date->format("Ymd");
      		/* On vérifie que la date de la séance est valide*/
      		if (!checkdate($mois, $jour, $annee)){
      				echo "Veuillez rentrer une date valide <br>";
      				echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
      			}
      		else if( $today > $date ) {
      			echo "Le délai de réapprovisionnement ne peut etre dans le passé...<br>";
      		  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
      		}
        }
      if ($date == '1970-01-01' || $today < $date){
        $vConnect = fConnect(); //Connexion initiale ?

        $vSql = "UPDATE proMarchandise SET stock = stock + '$qte', delai_reapprovisionnement='$date' WHERE id= '$produit' ";
        $result =pg_query($vConnect, $vSql);

        if($result != FALSE){
          echo "<h1>Réapprovisionnement effectué !</h1><br>";
          echo "<a href=\"reapprovisionnement.php\"><input type='button' value='Retour'>";
        }
        else{
          echo "<strong>ERROR UPDATE DATABASE</strong>";
        }
      }
      echo "</div>";
?>


</body>

</html>
