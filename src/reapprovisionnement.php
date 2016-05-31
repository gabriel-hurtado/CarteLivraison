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
    Nouveau réapprovisionnement :<select name="jour" id="jour">
          <option value="">Jour</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
      </select>

      <select name="mois" id="mois" >
          <option value="" >Mois</option>
          <option value="1">Janvier</option>
          <option value="2">Février</option>
          <option value="3">Mars</option>
          <option value="4">Avril</option>
          <option value="5">Mai</option>
          <option value="6">Juin</option>
          <option value="7" >Juillet</option>
          <option value="8">Août</option>
          <option value="9">Septembre</option>
          <option value="10">Octobre</option>
          <option value="11">Novembre</option>
          <option value="12">Décembre</option>
      </select>

      <select  name="annee" id="annee">
        <option value="">Ann&eacute;e</option>
        <option value="2019">2019</option>
        <option value="2018">2018</option>
        <option value="2017">2017</option>
        <option value="2016">2016</option>
      </select>
      <br><br>

    <input type="submit">
    </div>
  </form>



    </body>
  </html>
