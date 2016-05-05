<?php
session_start();

if(isset($_GET['id'])){
  $id = $_GET['id'];

  session_start();
  $_SESSION['id'] = $id;

  include('connect.php');
  $vConnect = fConnect();
  $vSql ="SELECT prenom, nom, telephone, email from proClients WHERE numero_client=".$id;
  $result =pg_query($vConnect, $vSql);

  $datas_client = pg_fetch_array($result);

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
  <form method="POST" action="ModifClient.php">
    <div align="center">
      <table>
        <tr>
          <td>Nom :</td><td><input type="text" name="nom" maxlength="25" value=<?php echo $datas_client[1]; ?> required> *</td><br>
        </tr>
        <tr>
    			<td>Prénom :</td><td><input type="text" name="prenom" maxlength="25" value=<?php echo $datas_client[0]; ?> required> *</td><br>
    		</tr>
        <tr>
          <td>E-mail :</td><td><input type="text" name="email" maxlength="50" value=<?php echo $datas_client[3]; ?> required> *</td><br>
        </tr>
        <tr>
          <td>Téléphone :</td><td><input type="text" name="telephone" length="10" value=<?php echo $datas_client[2]; ?>></td><br>
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
