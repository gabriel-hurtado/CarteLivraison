<?php
  include('connect.php');

  $vConnect = fConnect();

  $vSql ="SELECT id, denomination, stock, prix FROM proMarchandise ORDER BY id ;";
  $result =pg_query($vConnect, $vSql);
  $nbr_lignes = pg_num_rows($result);

 ?>

 <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8" />
    </head>
   <body>
      <h1>Réapprovisionnement</h1>
      <hr>
      Veuillez choisir le produit à réapprovisionner ainsi que la quantité.
      <br><br>
    <form method="POST" action="reapprovisionnementForm.php">
      <table align="center" border="1">
        <tr>
          <td><strong>ID</strong></td><td><strong>Denomination</strong></td><td><strong>Stock</strong></td><td><strong>Prix</strong></td><td><strong></strong></td>
        </tr>
       <?php
        while ($row = pg_fetch_row($result))//Parcourir toutes les lignes -> Tant que $row != NULL
        {
          echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td> <td> <input type='radio' name='produit' value='$row[0]''> </td></tr>";
        }
        ?>
    </table><br>
    <div align=center>
    Quantité reçue : <input type="numeric" name="qte"><br><br>
    <input type="submit">
    </div>
  </form>



    </body>
  </html>
