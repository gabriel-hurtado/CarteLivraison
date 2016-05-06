<?php
session_start();

if(isset($_POST['go']) && $_POST['go']=="Modifier")
{
  $nom = $_POST['nom'];
  $prenom= $_POST["prenom"];
  $email= $_POST["email"];
  $telephone= $_POST["telephone"];

  if($telephone == ""){$telephone = 0;}//Erreur si je veux insérer un numéro de téléphone vierge

  $id = $_SESSION['id'];

  $pattern = '/[][(){}<>\/+²"*%&=?`"\'^\!$_:;,]/';

    $AllAnswersOk = true;

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

    else if($AllAnswersOk){
      include "connect.php";

      $vConnect = fConnect();
      $query = "UPDATE proClients SET prenom='$prenom', nom='$nom', telephone='$telephone', email='$email' WHERE numero_client='$id'";

      $result =pg_query($vConnect, $query);

      if($result != FALSE){
        echo "<h1>MODIFICATION DONE</h1><br>";
        echo "<a href=\"listClient.php\"><input type='button' value='Retour'>";
      }
      else{
        echo "<strong>ERROR UPDATE DATABASE</strong>";
      }
    }
  }
  else {
    echo "ERROR";
  }
 ?>
