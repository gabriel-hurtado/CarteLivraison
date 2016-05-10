<?php
session_start();

if(isset($_POST['go']) && $_POST['go']=="Modifier")
{
  $numRue = $_POST['num_rue'];
  $route = $_POST['nomrue'];
  $batiment = $_POST['batiment'];
  $etage = $_POST['etage'];
  $digicode = $_POST['digicode'];

  $id_user = $_SESSION['id'];
  $id_adresse = $_SESSION['id_adresse'];

  $pattern = '/[][(){}<>\/+²"*%&=?`"\'^\!$_:;,]/';

    $AllAnswersOk = true;

    /*On vérifie que le nom et le prénom ne contiennent pas de caractères spéciaux*/
    if (preg_match($pattern, $route, $matches)){
        echo "Le nom contient des caractères spéciaux <br>";
        echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
        $AllAnswersOk = false;
    }

    else if (preg_match('/[0-9]/', $route, $matches)){
        echo "Le nom contient des chiffres <br>";
        echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
        $AllAnswersOk = false;
    }

    else if (preg_match($pattern, $batiment, $matches)){
        echo "Le prénom contient des caractères spéciaux <br>";
        echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
        $AllAnswersOk = false;
    }

    else if (preg_match('/[0-9]/', $batiment, $matches)){
        echo "Le prénom contient des chiffres <br>";
        echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
        $AllAnswersOk = false;
    }

    /*On vérifie que le nom et le prénom ne sont pas seulement un ou des espaces*/
    else if ((trim($route, ' ')) == ''){
       echo "Vous n'avez rentré que des espaces pour le nom <br>";
       echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
       $AllAnswersOk = false;
    }

    else if ((trim($batiment, ' ')) == ''){
        echo "Vous n'avez rentré que des espaces pour le prénom <br>";
        echo "<input type='button' value='Retour' onClick='history.go(-1)'>";
        $AllAnswersOk = false;
    }

    else if($AllAnswersOk){
      include "connect.php";

      $vConnect = fConnect();
      $query = "UPDATE proAdresse a set numero_rue='$numRue', route_nom='$route', batiment='$batiment', etage='$etage', digicode='$digicode' WHERE id='$id_adresse'";
      echo $query;
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
