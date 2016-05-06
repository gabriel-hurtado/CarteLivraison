<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8" />
  </head>
  <body>
  <h1>Liste des marchandises en rupture de stock</h1>

<?php
include('connect.php');

$vConnect = fConnect();

$vSql ="SELECT denomination, delai_reapprovisionnement FROM promarchandise WHERE stock='0'";
$vResult =pg_query($vConnect, $vSql);
$nbr_lignes = pg_num_rows($vResult);

date_default_timezone_set('Europe/Paris');
$today = date("d/m/Y");
echo "Voici la liste des produits indisponibles à ce jour ( $today ) <br><br> En <font color='red'> rouge</font> sont affichés les produits dont la date de réapprovisionnement est dépassée (retard) <br><br>";
$today = new DateTime( $today );
$today = $today->format("Ymd");


if($nbr_lignes == 0)
  echo "Aucune marchandise en rupture de stock !";
else{
  echo "<TABLE align='center' bordel='1'>";
  echo "<TR align='center'><TH>Nom</TH><TH>Prochain réapprovisionnement</TH></TR>";
  while ($row = pg_fetch_array($vResult)){
    echo "<TR align='center'><TD >$row[0]</TD><TD>";
      if($row[1] == '1970-01-01')
        echo "-";
      else{
        $dateR = new DateTime( $row[1] );
        $dateR = $dateR->format("Ymd");
        if ($today > $dateR){
          $row[1] = new DateTime( $row[1] );
          $row[1] = $row[1]->format("d/m/Y");
          echo "<font color='red'>$row[1]</color>";
        }

        else{
          $row[1] = new DateTime( $row[1] );
          $row[1] = $row[1]->format("d/m/Y");
          echo "$row[1]";
        }
      }
    echo "</TD></TR>";
  }
}
pg_close($vConnect);

?>
</body>
</html>