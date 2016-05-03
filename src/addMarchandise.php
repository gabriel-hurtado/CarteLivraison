<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>


<?php
	$denominationination = $_POST['denominationination'];
	$prix= $_POST["prix"];
	$stock= $_POST["stock"];
	$delai = $_POST["delai"];
	$pattern = '/[][(){}<>\/+²"*%&=?`"\'^\!$_:;,]/';
echo "<h2>Ajout d'une marchandise</h2>";
echo "<div align=center>";

 	/*On vérifie que la dénominationination ne contiennent pas de caractères spéciaux*/
if (preg_match($pattern, $denomination, $matches)){
  	echo "Le denomination contient des caractères spéciaux <br>";
  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
if (preg_match('/[0-9]/', $denomination, $matches)){
  	echo "Le denomination contient des chiffres <br>";
  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}

	/*On vérifie que le denomination n'est pas seulement un ou des espaces*/
if ((trim($denomination, ' ')) == ''){
 	 echo "Vous n'avez rentré que des espaces pour le denomination <br>";
	 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}

	/*On vérifie que le stock et prix sont des nombres */
if(!is_numeric($stock) ){
	echo "Vous n'avez correctement saisi le stock <br>";
	 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}	

if(!is_numeric($prix) or floatval($prix)>99999.99 or strlen(substr(strrchr($prix, "."), 1))>2 ){
	echo "Vous n'avez correctement saisi le prix <br>";
	 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}	

	/*On vérifie que délai livraison est une date*/
if(!(bool)strtotime($delai)){
	echo "Vous n'avez correctement saisi la date <br>";
	 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";	
}




	/*Si aucune erreur, alors on peut enregistrer dans la BDD*/
else{
	include "connect.php";
	
		$vConnect = fConnect();
    //Ajout de la Marchandise
    $vSql3 = "INSERT INTO proMarchandise(id, denomination, prix, stock, delai_reapprovisionnement) VALUES (DEFAULT, '$denomination', 'floatval($prix)', 'intval($stock)', '$delai')";
		$vResult3 = pg_query($vConnect, $vSql3);
		echo "la marchandise a bien été ajouté !";
		pg_close($vConnect);
	}
 
echo "</div>";
?>


</body>

</html>
