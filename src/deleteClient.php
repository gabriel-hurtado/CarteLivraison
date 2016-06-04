<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>

<h2>Supression d'un client</h2>
<?php
echo "<div align=center>";

	$id = $_POST['id'];
	include "connect.php";
	$vConnect = fConnect();
    //Suppression de la Marchandise
    $vSql3 = "DELETE FROM proClients WHERE numero_client='$id'";
		$vResult3 = pg_query($vConnect, $vSql3);

    $vSql2 = "DELETE FROM proDisponibilite WHERE client='$id'";
		$vResult2 = pg_query($vConnect, $vSql2);


    $vSql = "DELETE FROM proCommande WHERE numero_client='$id'";
		$vResult = pg_query($vConnect, $vSql);
		echo "le client a bien été supprimée !";
		pg_close($vConnect);
		?>


</body>
</html>