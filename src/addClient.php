<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>

<?php
			date_default_timezone_set('Europe/Paris');
			/*Récupération des variables du formualaire*/
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

		  	$debut = $_POST['debut'];
		  	$fin = $_POST['fin'];
		  	$h1=strtotime($debut);
			$h2=strtotime($fin);
			/*---------------------------------------*/
			/*Pattern = PAS DE CARACTERES SPECIAUX DANS LE NOM & PRENOM*/
			$pattern = '/[][(){}<>\/+²"*%&=?`"\'^\!$_:;,]/';

			$AllAnswersOk = true;

	echo "<h2>Ajout d'un client</h2>";
	echo "<div align=center>";

 	/*On vérifie que le nom et le prénom ne contiennent pas de caractères spéciaux*/
	if (preg_match($pattern, $nom, $matches)){
	  	echo "Le nom contient des caractères spéciaux <br>";
	  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			$AllAnswersOk = false;
	}

	else if (preg_match('/[0-9]/', $nom, $matches)){
	  	echo "Le nom contient des chiffres <br>";
	  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			$AllAnswersOk = false;
	}

	else if (preg_match($pattern, $prenom, $matches)){
	  	echo "Le prénom contient des caractères spéciaux <br>";
	  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			$AllAnswersOk = false;
	}

	else if (preg_match('/[0-9]/', $prenom, $matches)){
	  	echo "Le prénom contient des chiffres <br>";
	  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			$AllAnswersOk = false;
	}

	/*On vérifie que le nom et le prénom ne sont pas seulement un ou des espaces*/
	else if ((trim($nom, ' ')) == ''){
	 	 echo "Vous n'avez rentré que des espaces pour le nom <br>";
		 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
		 $AllAnswersOk = false;
	}

	else if ((trim($prenom, ' ')) == ''){
	  	echo "Vous n'avez rentré que des espaces pour le prénom <br>";
	  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			$AllAnswersOk = false;
	}
	else if ($h2-$h1 <= 0){
	  	echo "Les horaires de livraisons sont invalides <br>";
	  	echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			$AllAnswersOk = false;
	}

	/*Si $AllAnswersOk -> Tous les filtres du formulaire sont favorables*/

	else if($AllAnswersOk){

			include "connect.php";//Fichier de connection à la BD

		  $vConnect = fConnect(); //Connexion initiale ?
			$vSql ="SELECT * from proClients where email='$email'";
			$result =pg_query($vConnect, $vSql);
			$rowCnt = pg_num_rows($result);

			if($rowCnt == 1){
			 echo"Client déjà enregistré ! <br>";
			 echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
			}
			else{

				echo "Vous êtes $nom "."$prenom, habitant le $numero $typerue $nomrue";


		    /*Ajout de l'adresse si nouvelle*/
		    $vSqlCheck= "SELECT * FROM proAdresse WHERE numero_rue='$numero' AND route_nom='$nomrue' AND batiment ='$batiment' AND etage = '$etage' AND digicode='$digicode'";
		    $result=pg_query($vConnect, $vSqlCheck);

		    if(pg_num_rows($result) == 0){
		    	$vSql2 = "INSERT INTO proAdresse(id, numero_rue, route_nom, batiment, etage, digicode) VALUES (DEFAULT,'$numero', '$nomrue', '$batiment', '$etage', '$digicode')";
		    	$vResult2 = pg_query($vConnect, $vSql2);
		    }
				/*------------------------------*/

		    /*recuperation de l'id de l'adresse pour ajout du client*/
		    $vSqlAdresse = "SELECT id FROM proAdresse WHERE numero_rue='$numero' AND route_nom ='$nomrue' AND batiment ='$batiment' AND etage = '$etage' AND digicode='$digicode'";
		    $idAdresse = pg_query($vConnect, $vSqlAdresse);
		    $adresse = pg_fetch_array($idAdresse);//Sauvegarde des résultats de la requête dans le tableau $adresse
				/*------------------------------------------------------*/

		    /*Ajout du client*/
		    $vSql3 = "INSERT INTO proClients(numero_client, prenom, nom, telephone, email, adresse) VALUES (DEFAULT, '$prenom', '$nom', '$telephone', '$email', '$adresse[0]')";
			$vResult3 = pg_query($vConnect, $vSql3);

			/*recuperation de l'id du client pour ajout des disponibilités*/
			$vSql= "SELECT numero_client FROM proClients WHERE email = '$email'";
			$idClient = pg_query($vConnect, $vSql);
		    $idclient = pg_fetch_array($idClient);

		    $vSql = "INSERT INTO proDisponibilite(debut, fin, client) VALUES ('$debut', '$fin', $idclient[0])";
		    $vResult = pg_query($vConnect, $vSql);
			echo " <br>le client a bien été ajouté !";
				/*---------------*/

				pg_close($vConnect);
	}
 }
echo "</div>";
?>


</body>

</html>
