<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
	<form method="POST" action="addClient.php">

	<h2>Ajout d'un client</h2>
	<div align="center">
	<table>
		<tr>
			<td>Nom :</td><td><input type="text" name="nom" maxlength="25" required> *</td><br>
		</tr>
		<tr>
			<td>Prénom :</td><td><input type="text" name="prenom" maxlength="25" required> *</td><br>
		</tr>
    <tr>
      <td>E-mail :</td><td><input type="text" name="email" maxlength="50" required> *</td><br>
    </tr>
    <tr>
      <td>Téléphone :</td><td><input type="text" name="telephone" length="10"></td><br>
    </tr>
    <tr>
    <?php
      include "connect.php";
      $vConnect = fConnect(); 
      $vQuery = "SELECT * FROM proRoute ORDER BY route_nom";
      $vResult=pg_query($vConnect, $vQuery);
      echo "<TR>";
      echo "<TD>Adresse:</TD><TD><select name='nomrue'>";
      while ($row = pg_fetch_array($vResult)){
        echo "<option value='$row[0]'> $row[1] $row[0] </option>";
      }
      echo "</select></TD>";
      echo "</TR>";
      pg_close($vConnect);
    ?>
    <tr>
      <td>N° rue :</td><td><input type="text" name="numero" maxlength="4" required>*</td><br>
    </tr>
    <tr>
      <td>Bâtiment :</td><td><input type="text" name="batiment" maxlength="25"></td><br>
    </tr>
    <tr>
      <td>Etage :</td><td><input type="text" name="etage" maxlength="2"></td><br>
    </tr>
    <tr>
      <td>Digicode :</td><td><input type="text" name="digicode" maxlength="15"></td><br>
    </tr>
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
