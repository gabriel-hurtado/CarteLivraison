<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
	<form method="POST" action="deleteMarchandise.php">

	<h2>Suppression d'une marchandise</h2>
	<div align="center">
	<table>
    <tr>
    <?php
      include "connect.php";
      $vConnect = fConnect();
      $vQuery = "SELECT id, denomination FROM proMarchandise ORDER BY denomination";
      $vResult=pg_query($vConnect, $vQuery);
      echo "<TR>";
      echo "<TD>Marchandise à supprimer:</TD><TD><select name='id'>";
      while ($row = pg_fetch_array($vResult)){
        echo "<option value='$row[0]'> $row[1]</option>";
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
