<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>


<?php
echo "<h2>Ajout d'une marchandise</h2>";
echo "<div align=center>";

	$denomination = $_POST['denomination'];
	$prix= $_POST["prix"];
	$stock= $_POST["stock"];
	$jour= $_POST["jour"];
	$mois= $_POST["mois"];
	$annee= $_POST["annee"];
	$pattern = '/[][(){}<>\/+²"*%&=?`"\'^\!$_:;,]/';


 	/*On vérifie que la dénominationination ne contiennent pas de caractères spéciaux*/
if (preg_match($pattern, $denomination, $matches)){
  	echo "Le denomination contient des caractères spéciaux <br>";
  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
//else if (preg_match('/[0-9]/', $denomination, $matches)){
//  	echo "Le denomination contient des chiffres <br>";
//  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
//}

	/*On vérifie que le denomination n'est pas seulement un ou des espaces*/
else if ((trim($denomination,' ')) == ''){
 	 echo "Vous n'avez rentré que des espaces pour la dénomination <br>";
	 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}

	/*On vérifie que le stock et prix sont des nombres */
else if(!is_numeric($stock) ){
	echo "Vous n'avez correctement saisi le stock <br>";
	 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}	

else if(!is_numeric($prix) or floatval($prix)>99999.99 or strlen(substr(strrchr($prix, "."), 1))>2 ){
	echo "Vous n'avez pas correctement saisi le prix <br>";
	 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
else if (empty($jour) or empty($mois) or empty($annee)) {
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
	/*Si aucune erreur, alors on peut enregistrer dans la BDD*/
	include "connect.php";
	$prix=floatval($prix);
	$stock=intval($stock);

	$vConnect = fConnect();
    //Ajout de la Marchandise
    $vSql3 = "INSERT INTO proMarchandise(id, denomination, prix, stock, delai_reapprovisionnement) VALUES (DEFAULT, '$denomination', '$prix', '$stock', '$date')";
		$vResult3 = pg_query($vConnect, $vSql3);
		echo "la marchandise a bien été ajouté !";
		pg_close($vConnect);
}

echo "</div>";
?>

</body>
</html>
