<html>

<head>
	<LINK rel="stylesheet" HREF="miseenforme2.css" type="text/css">
	<meta charset="UTF-8">
</head>

<body>
<h2> Mise à jour de route</h2>


<div align="center">
<?php 

	include "connect.php";
 	$vConnect = fConnect();
	$vSql ="SELECT * from proRoute ORDER BY route_nom";
	$vResult =pg_query($vConnect, $vSql);
	echo "<form action='editRouteform.php' method='POST'>";
	echo "<TABLE>";
		echo "<TH>Route</TH><TH>Selection</TH>";
		while ($row = pg_fetch_array($vResult))
			{ 
			echo "<TR align='center'><TD>$row[1] $row[0]</TD><TD><input type='radio' name='choixrue' value ='$row[0]'></TD></TR>";
			}
	echo "</TABLE>";
	echo "<BR>";
	echo "<table>";
		echo "<tr>";
	      echo "<td>Accessibilité : </td><td><select name='access' id='access'> <option value=''>-</option>
	          <option value='TRAFFIC NORMAL'>TRAFFIC NORMAL</option>
	          <option value='TRAVAUX'>TRAVAUX</option>
	          <option value='ACCIDENT'>ACCIDENT</option>*</td><br>";
	    echo "</tr>";
	echo "</table>";
	echo "<BR>";
		echo "<INPUT type='submit' value='Mettre à jour'>";

	pg_close($vConnect);
?>
</div>
</body>
</html>