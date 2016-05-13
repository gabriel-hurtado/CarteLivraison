<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>


<?php
echo "<h2>Ajout d'une commande'</h2>";
echo "<div align=center>";

	$id_produit = $_POST['products'];
	$quantite = $_POST['quantite'];
	$stock = $_POST['stock'];
	$numero_cl= $_POST["numero_cl"];
	$jour= $_POST["jour"];
	$mois= $_POST["mois"];
	$annee= $_POST["annee"];
	$pattern = '/[][(){}<>\/+²"*%&=?`"\'^\!$_:;,]/';

$i=0;
$flag=TRUE;
foreach ($quantite as $qt) {
			if($qt>$stock[$i]){
			if($flag)
			echo "La quantité dépasse le stock ...<br>";
		  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
		  	$flag=FALSE;
			}
		}



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
		/* On vérifie que la date est valide*/
		if (!checkdate($mois, $jour, $annee)){
				echo "Veuillez rentrer une date valide <br>";
				echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			}
		else if( $today > $date ) {
			echo "Le délai de livraison ne peut etre dans le passé...<br>";
		  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
		}
	}

if ($date == '1970-01-01' || $today <= $date){
	/*Si aucune erreur, alors on peut enregistrer dans la BDD*/
	include "connect.php";

	$vConnect = fConnect();
    //Ajout de la Marchandise
   // $vSql3 = "INSERT INTO proCommande(id, livree, date_livraison, date_commande, enquete_satisfaction_envoyee, reponse_enquete_satisfaction, numero_client) VALUES (DEFAULT, 'FALSE', '$date', '$today', 'FALSE', NULL, '$numero_cl')";
	//	$vResult3 = pg_query($vConnect, $vSql3);
		//echo "la marchandise a bien été ajoutée, il faudrait faire pareil avec les produits !";
		
		pg_close($vConnect);
}

echo "</div>";
?>

</body>
</html>
