<?php
  include('connect.php');

  $vConnect = fConnect();

  $vSql ="SELECT * FROM listCommandes";
  $result = pg_query($vConnect, $vSql);

  date_default_timezone_set('Europe/Paris');
 ?>

 <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8" />
    </head>
   <body>
      <h1>Liste des Commandes</h1>
      <hr>
      <br>
      <table align="center" border="1">
        <tr>
          <td><strong>NOM</strong></td><td><strong>PRENOM</strong></td><td><strong>DATE DE LIVRAISON</strong></td><td><strong>Voir détails</strong></td>
        </tr>
       <?php
        while ($row = pg_fetch_row($result))
        {
        $date = $row[2];
        $date= new DateTime($date);
      	$date=$date->format("d/m/Y");
          echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$date.'</td><td><a href="detailCommande.php?id='.$row[3].'">Details</a></td></tr>';
        }
       ?>
    </table>

    </body>
  </html>
