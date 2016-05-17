<?php
include('connect.php');
$vConnect = fConnect();

$id_commande = $_GET['id'];
$requete = "SELECT date_commande, date_livraison, reponse_enquete_satisfaction from proCommande where id=".$id_commande;

$requete_2 = "SELECT m.denomination, mc.quantite, (mc.quantite * m.prix), m.prix from proCommande c, proMarchandise m, ProMarchandiseCommande mc where m.id=mc.numero_id and c.id=mc.commande_id and c.id=".$id_commande;

$result = pg_query($vConnect, $requete);
$result_2 = pg_query($vConnect, $requete_2);
?>

 <html>
 <head>
   <meta charset="UTF-8" />
 </head>

   <body>
     <h1>Détails de la commande numéro <?php echo $id_commande; ?></h1>
     <hr>
     <br>

     <table align="center" border="1">
       <tr>
         <td><strong>Date commande</strong></td><td><strong>Date livraison</strong></td><td><strong>Réponse enquete</strong></td>
       </tr>
       <?php
        while($row = pg_fetch_row($result)){
          echo '<tr>
                  <td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td>
                </tr>';
        }
        ?>
     </table>
     <br>
     <br>
     <table align="center" border="1">
       <tr>
         <td><strong>Nom article</strong></td><td><strong>Quantité</strong></td><td><strong>Prix unitaire</strong></td><td><strong>Sous total</strong></td>
       </tr>
       <?php
        $total = 0;
          while($row = pg_fetch_row($result_2)){
            echo '<tr>
                    <td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[3].'</td><td>'.$row[2].'</td>
                  </tr>';
                $total = $total + $row[2];
          }
        ?>
     </table>
     <br>
     <hr>
     <h3>Total de la comande : <?php echo $total; ?> € </h3>

   </body>

 </html>
