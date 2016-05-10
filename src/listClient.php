<?php
  include('connect.php');

  $vConnect = fConnect();

  $vSql ="SELECT * from proClients";
  $result =pg_query($vConnect, $vSql);
  $nbr_lignes = pg_num_rows($result);

 ?>

 <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8" />
    </head>
   <body>
      <h1>Liste des clients</h1>
      <hr>
      <br>
      <table align="center" border="1">
        <tr>
          <td><strong>ID</strong></td><td><strong>PRENOM</strong></td><td><strong>NOM</strong></td><td><strong>NUMERO</strong></td><td><strong>MAIL</strong></td>
        </tr>
       <?php
        while ($row = pg_fetch_row($result))//Parcourir toutes les lignes -> Tant que $row != NULL
        {
	         echo '<tr>';
	          $count = count($row);//On compte combien de valeurs
	           $y = 0;
            	while ($y < $count-1)
            	{
            		$c_row = current($row);//On recupère la première valeur

                if($y == 0){
                  echo'<td><a href="modifClientForm.php?id='.$c_row.'">'.$c_row.'</a></td>';
                }else{
                  echo '<td>' . $c_row . '</td>';//On affiche la valeur
                }

            		next($row);//On passe à la suivante
            		$y = $y + 1;
            	}
            	echo '</tr>';
            }
            pg_free_result($result);
       ?>
    </table>

    </body>
  </html>
