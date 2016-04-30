<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>

<?php
	$nom = $_POST['nom'];
	$prenom= $_POST["prenom"];
	$email= $_POST["email"];
	$telephone= $_POST["telephone"];
	$typerue= $_POST["typerue"];
	$nomrue = $_POST['nomrue'];
	$numero = $_POST['numero'];
  $batiment = $_POST['batiment'];
  $etage = $_POST['etage'];
  $digicode = $_POST['digicode'];
	$pattern = '/[][(){}<>\/+²"*%&=?`"\'^\!$_:;,]/';
echo "<h2>Ajout d'un client</h2>";
echo "<div align=center>";

 	/*On vérifie que le nom et le prénom ne contiennent pas de caractères spéciaux*/
elseif (preg_match($pattern, $nom, $matches)){
  	echo "Le nom contient des caractères spéciaux <br>";
  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
elseif (preg_match('/[0-9]/', $nom, $matches)){
  	echo "Le nom contient des chiffres <br>";
  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
elseif (preg_match($pattern, $prenom, $matches)){
  	echo "Le prénom contient des caractères spéciaux <br>";
  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
elseif (preg_match('/[0-9]/', $prenom, $matches)){
  	echo "Le prénom contient des chiffres <br>";
  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
	/*On vérifie que le nom et le prénom ne sont pas seulement un ou des espaces*/
elseif ((trim($nom, ' ')) == ''){
 	 echo "Vous n'avez rentré que des espaces pour le nom <br>";
	 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
elseif ((trim($prenom, ' ')) == ''){
  	echo "Vous n'avez rentré que des espaces pour le prénom <br>";
  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
}
	/*Si aucune erreur, alors on peut enregistrer dans la BDD*/
else{
	include "connect.php";
  $vConn = fConnect();
	$vSql ="SELECT * from proClients where email='$email'";
	$result =pg_query( $vConn;, $vSql);
	$rowCnt = pg_num_rows($result);
	if($rowCnt == 1){
	 echo"Client déjà enregistré !";
	 echo "<input type='button' value='Non' onClick='history.go(-1)'>";
	}
	else{
		$vConn = fConnect();
		echo "Vous êtes $nom "."$prenom, habitant le $numero $typerue $nomrue";
    $vSql1 = "INSERT INTO proRoute VALUES ('$nomrue', '$typerue', 'TRAFFIC NORMAL')";
		$vResult1 = pg_query($vConnect, $vSql1);
    $vSql2 = "INSERT INTO proAdresse VALUES ('$numero', '$nomrue', '$batiment', '$etage', '$digicode')";
    $vResult2 = pg_query($vConnect, $vSql2);
		$vSql3 = "INSERT INTO proClients VALUES (NULL, '$prenom', '$nom', '$telephone', '$email', '$nomrue', '$numero')";
		$vResult3 = pg_query($vConnect, $vSql3);
		if (!$vResult1 || !$vResult2 || !$vResult3) { echo "<br> pas bon ".pg_error($vConnect);}
		else{echo"le client a bien été ajouté !";}
		pg_close($vConnect);
	}
 }
echo "</div>";
?>


</body>

</html>
