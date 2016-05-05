<html>

<head>
	<LINK rel="stylesheet" HREF="miseenforme2.css" type="text/css">
	<meta charset="UTF-8">
</head>

<body>
<h2> Jonction de routes </h2>


<div align="center">
<?php 
	include "connect.php";
 	$vConnect = fConnect();
	$vSql ="SELECT * from proRoute ORDER BY route_nom";
	$vResult =pg_query($vConnect, $vSql);
echo "<form action='addJonctionform.php' method='POST'>";
echo "<TABLE>";
echo "<TH>Route</TH><TH>Selection</TH>";
		while ($row = pg_fetch_array($vResult)){
			echo "<TR><TD> $row[1] $row[0]</TD><TD><input type='checkbox' name='route[]' value='$row[0]'></TD></TR>";			
		}
		echo "</select></TD>";
	echo "</TR>";?>
	<tr>
      <td>Type de jonction :</td><td><select name="typejonc" id="typejonc">  <option value="">-</option>
          <option value="CARREFOUR">CARREFOUR</option>
          <option value="INTERSECTION">INTERSECTION</option>
          <option value="ROND-POINT">ROND-POINT</option>*</td><br>
    </tr>
    <?php
echo "</TABLE>";
echo "<BR>";
echo "<INPUT type='submit' value='Enregistrer'>";
echo "<INPUT type='reset' value='Effacer'>";
echo"</FORM>";
pg_close($vConnect);
?>
</div>
</body>
</html>