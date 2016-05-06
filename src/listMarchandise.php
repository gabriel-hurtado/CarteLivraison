<?php
  if ($_POST['tri'] == '' || $_POST['tri'] == 'nomCROI')
    $methode = 'denomination';
  if ($_POST['tri'] == 'nomDESC')
    $methode = 'denomination DESC';
  if ($_POST['tri'] == 'uniCROI')
    $methode = 'stock';
  if ($_POST['tri'] == 'uniDESC')
    $methode = 'stock DESC';
  if ($_POST['tri'] == 'prixCROI')
    $methode = 'prix';
  if ($_POST['tri'] == 'prixDESC')
    $methode = 'prix DESC';
  if ($_POST['tri'] == 'reaCROI')
    $methode = 'delai_reapprovisionnement';
  if ($_POST['tri'] == 'reaDESC')
    $methode = 'delai_reapprovisionnement DESC';

  include('connect.php');

  $vConnect = fConnect();

  $vSql ="SELECT denomination, stock, prix, delai_reapprovisionnement from promarchandise ORDER BY $methode";
  $result =pg_query($vConnect, $vSql);

  date_default_timezone_set('Europe/Paris');
  $today = date("Ymd");
  $today = new DateTime( $today );
  $today = $today->format("Ymd");
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8" />
  </head>
  <body>
  <h1>Liste des produits</h1>

  <table align='right'>
    <form method="POST" action="listMarchandise.php"
    <tr><td>Trier par : </td>
      <td><select name='tri'>";
          <option value='nomCROI'>Nom du produit croissant</option>";
          <option value='nomDESC'>Nom du produit décroissant</option>";
          <option value='uniCROI'>Unité en stock croissant</option>";
          <option value='uniDESC'>Unité en stock décroissant</option>";
          <option value='prixCROI'>Prix croissant</option>";
          <option value='prixDESC'>Prix décroissant</option>";
          <option value='reaCROI'>Réapprovisionnement croissant</option>";
          <option value='reaDESC'>Réapprovisionnement décroissant</option>";
      </select></td>
    </tr>
  </table>
  <br><br>
  <table border="1" align="center">
    <tr>
      <td><strong>Produit</strong></td><td><strong>Unités en stock</strong></td><td><strong>Prix</strong></td><td><strong>Réapprovisionnement</strong></td>
    </tr>
  <?php
    while ($row = pg_fetch_array($result)){
      echo "<tr align='center'><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>";
      if($row[3] == '1970-01-01')
        echo "-";
      else{
        $dateR = new DateTime( $row[3] );
        $dateR = $dateR->format("Ymd");
        if ($today > $dateR){
          $row[3] = new DateTime( $row[3] );
          $row[3] = $row[3]->format("d/m/Y");
          echo "<font color='red'>$row[3]</color>";
        }

        else{
          $row[3] = new DateTime( $row[3] );
          $row[3] = $row[3]->format("d/m/Y");
          echo "$row[3]";
        }
      }
      echo "</td></tr>";
    }
  echo "</table>";
  pg_close($vConnect);
  ?>
  <br><br>
  <div align="center">
    <input type="submit" value="Retrier">
  </form>
  </div>
</body>
</html>
