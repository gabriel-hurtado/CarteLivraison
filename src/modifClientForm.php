<?php
session_start();

if(isset($_GET['id'])){
  $id = $_GET['id'];

  session_start();
  $_SESSION['id'] = $id;

  include('connect.php');
  $vConnect = fConnect();


  $vSql = "SELECT numero_rue, route_nom, batiment, etage, digicode, id from proClients, proAdresse WHERE numero_client = ".$id." and proClients.adresse=proAdresse.id";

  $result =pg_query($vConnect, $vSql);

  $datas_client = pg_fetch_row($result);


}
else{
  echo "<h1>ERROR CLIENT</h1>";
}
?>

<html>
<head>
  <meta charset="UTF-8" />
</head>

<body>
  <h1>Modification client numéro <?php echo $id; ?></h1>
  <hr>
  <br>
  <a href="#" target="_blank"><input type="button" value="COMMANDES CLIENTS"></a>
  <br>

  <form method="POST" action="ModifClient.php">
    <div align="center">
      <table>
        <tr>
          <?php $c_row = current($datas_client) ; next($datas_client); next($datas_client);?>
          <td>Numéro de rue :</td><td><input type="text" name="num_rue" maxlength="25" value=<?php echo $c_row; ?> required> *</td><br>
        </tr>
        <?php
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
          <?php $c_row = current($datas_client) ; next($datas_client); ?>
          <td>Batiment :</td><td><input type="text" name="batiment" maxlength="50" value=<?php echo $c_row; ?>> </td><br>
        </tr>
        <tr>
          <?php $c_row = current($datas_client) ; next($datas_client); ?>
          <td>Etage :</td><td><input type="text" name="etage" length="10" value=<?php echo $c_row; ?> > </td><br>
        </tr>
        <tr>
          <?php $c_row = current($datas_client) ; next($datas_client); ?>
          <td>Digicode :</td><td><input type="text" name="digicode" length="10" value=<?php echo $c_row; ?>> </td><br>

          <?php
            $c_row = current($datas_client) ;
            $_SESSION['id_adresse'] = $c_row;
          ?>
          
        </tr>
      </table>

      <br>
      <br>
      <br>
        <input name="go" type="submit" value="Modifier">
    </div>
  </form>

</body>
</html
