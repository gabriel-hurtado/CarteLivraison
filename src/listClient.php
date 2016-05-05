<?php
  include('connect.php');

  $vConnect = fConnect();

  $vSql ="SELECT * from proClients";
  $result =pg_query($vConnect, $vSql);
  $client_list = pg_fetch_array($result);

  $nbr_lignes = pg_num_rows($result);

 ?>

 <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8" />
    </head>
   <body>
      <h1>Liste des clients</h1>

      <table border="1">
        <tr>
          <td><strong>ID</strong></td><td><strong>PRENOM</strong></td><td><strong>NOM</strong></td>
        </tr>
       <?php
       for($i=1;$i<=$nbr_lignes;$i++){
         echo '<tr>';
          echo '<td>'.$client_list[0].'</td>';
          echo '<td>'.$client_list[1].'</td>';
          echo '<td>'.$client_list[2].'</td>';
         echo '</tr>';
       }
       ?>
    </table>

    </body>
  </html>
