<html>
<head>
<meta charset="UTF-8" />
</head>

<body>

	<form method="POST" action="addCommandes.php">

	<h2>Ajout d'un client</h2>
	<div align="center">
	<table>
    <tr>
    <?php

	$id_produit = $_POST['products'];
	$numero_cl= $_POST["numero_cl"];
	$jour= $_POST["jour"];
	$mois= $_POST["mois"];

	$stock = $_POST['stock'];
	$annee= $_POST["annee"];
	foreach ($id_produit as $prod ) {
		
	 echo "<input type='hidden' value='$prod' name='products[]'/> ";
	}


	 echo "<input type='hidden' value='$annee' name='annee'/>";

	 echo "<input type='hidden' value='$mois' name='mois'/> ";

	 echo "<input type='hidden' value='$jour' name='jour'/> ";
	 echo "<input type='hidden' value='$numero_cl' name='numero_cl'/> ";

      include "connect.php";
      $vConnect = fConnect();

      $vQuery = "SELECT id, denomination, stock FROM proMarchandise ORDER BY denomination";
      $vResult=pg_query($vConnect, $vQuery);
      echo "<TR>";
      echo "<TD>Produits :</TD><TR>";
      $i=0;
      while ($row = pg_fetch_array($vResult)){
      	if(in_array($row[0],$id_produit)){
        echo "<TR><TD></TD><TD> $row[1] </TD><TD> Stock: $row[2]</TD><TD> Quantité : </TD><TD><INPUT type='text' maxlength='4' name='quantite[]' required>*</TD></TR>";

	 	echo "<input type='hidden' value='$row[2]' name='stock[]'/> ";
	 	echo "<input type='hidden' value='$row[1]' name='names[]'/> ";
        }
        $i++;
      }
      echo "</TR>";
      echo "</TR>";
      pg_close($vConnect);
    ?>
    
    
	</table>

	<br>
	<br>
	<br>
		<input type="submit" value="Valider">
		<input type="reset" value="Annuler">
	</div>
	</form>
</body>

</html>
