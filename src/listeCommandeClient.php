<?php
session_start();

if(isset($_GET['id'])){
  $id = $_GET['id'];

  include('connect.php');
  $vConnect = fConnect();

  $query = "SELECT com.date_livraison, com.date_commande, m.denomination, m.prix
    FROM proCommande com , proClients c , proMarchandise m, proMarchandiseCommande
    WHERE c.numero_client = ".$id."
          AND c.numero_client = com.numero_client
          AND com.id = proMarchandiseCommande.commande_id
          AND m.id = proMarchandiseCommande.numero_id";

          //echo $query;

  $result = pg_query($vConnect, $query);


}
else {
  echo "<h1>ERROR CLIENT</h1>";
}
 ?>

 <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8" />
    </head>
   <body>
      <h1>Liste des Commandes du client numéro <?php echo $id ?></h1>
      <hr>
      <br>
      <table align="center" border="1">
        <tr>
          <td><strong>Date livraison</strong></td><td><strong>Date commande</strong></td><td><strong>Nom de marchandise</strong></td><td><strong>Prix</strong></td>
        </tr>
       <?php
        while ($datas_client = pg_fetch_row($result))
        {
          //$date_livraison = new DateTime($row[0]);
          //$date_commande = new DateTime($row[1]);

          //$date_commande = $date_commande->format("d/m/Y");
          //$date_livraison = $date_livraison->format("d/m/Y");

          echo '<tr><td>'.$datas_client[0].'</td><td>'.$datas_client[1].'</td><td>'.$datas_client[2].'</td><td>'.$datas_client[3].'</td></tr>';
        }
       ?>
    </table>

    </body>
  </html>
