<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
	<form method="POST" action="deleteClient.php">

	<h2>Suppression d'un Client</h2>

	ATTENTION : La suppression d'un client de la base de données entraine la suppression de toute donnée en rapport avec ce dernier (commandes, disponibilités, etc.). Soyez vigilants !
	<div align="center">
	<table>
    <tr>
    <?php include "connect.php";
      $vConnect = fConnect();
      $vQuery = "SELECT numero_client, nom , prenom , email FROM proClients ORDER BY nom, prenom";
      $vResult=pg_query($vConnect, $vQuery);
      echo "<TR>";
      echo "<TD>Client:</TD><TD><select name='id'>";
      while ($row = pg_fetch_array($vResult)){
        echo "<option value='$row[0]'> $row[1] $row[2] $row[3]</option>";
      }
      echo "</select></TD>";
      echo "</TR>";


      pg_close($vConnect);
    ?>
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
