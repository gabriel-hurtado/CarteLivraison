<html>

<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
</head>

<body>

<h2>Supression d'une marchandise</h2>
<?php
echo "<div align=center>";

	$id = $_POST['id'];
	include "connect.php";
	$vConnect = fConnect();
    //Suppression de la Marchandise
    $vSql3 = "DELETE FROM proMarchandise WHERE id='$id'";
		$vResult3 = pg_query($vConnect, $vSql3);

    $vSql2 = "DELETE FROM proMarchandiseCommande WHERE numero_id='$id'";
		$vResult2 = pg_query($vConnect, $vSql3);
		echo "la marchandise a bien été supprimée !";
		pg_close($vConnect);
		?>


</body>
</html>