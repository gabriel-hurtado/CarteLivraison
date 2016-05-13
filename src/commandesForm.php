<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
	<form method="POST" action="addCommandeIntermediaire.php">

	<h2>Ajout d'un client</h2>
	<div align="center">
	<table>
    <tr>
    <?php
      include "connect.php";
      $vConnect = fConnect();
      $vQuery = "SELECT numero_client, nom , prenom , email FROM proClients ORDER BY nom, prenom";
      $vResult=pg_query($vConnect, $vQuery);
      echo "<TR>";
      echo "<TD>Client:</TD><TD><select name='numero_cl'>";
      while ($row = pg_fetch_array($vResult)){
        echo "<option value='$row[0]'> $row[1] $row[2] $row[3]</option>";
      }
      echo "</select></TD>";
      echo "</TR>";

      $vQuery = "SELECT id, denomination, stock FROM proMarchandise WHERE stock>0 ORDER BY denomination";
      $vResult=pg_query($vConnect, $vQuery);
      echo "<TR>";
      echo "<TD>Produits :</TD><TR>";
      while ($row = pg_fetch_array($vResult)){
        echo "<TR><TD></TD><TD> $row[1] </TD><TD> Stock: $row[2]</TD><TD><INPUT type='checkbox' name='products[]' value='$row[0]'></TD></TR>";
      }
      echo "</TR>";
      echo "</TR>";
      pg_close($vConnect);
    ?>


    <tr>
      <td>Date de livraison :</td><td><select name="jour" id="jour">  <option value="">Jour</option>
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

			<select name="mois" id="mois" >  <option value="" >Mois</option>
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

			<select  name="annee" id="annee">  <option value="">Ann&eacute;e</option>
				<option value="2019">2019</option>
				<option value="2018">2018</option>
				<option value="2017">2017</option>
				<option value="2016">2016</option><br>
    </tr>
    
    
	</table>

	<br>
	<br>
	<br>
		<input type="submit" value="Valider">
		<input type="reset" value="Annuler">
	</div>
	</form>
</body>

</html>
