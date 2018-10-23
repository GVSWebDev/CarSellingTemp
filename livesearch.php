<?php
require "dbconnect.php";

$sql = "SELECT * FROM gvswebde_pdb.carros WHERE nome LIKE '%".$_GET['q']."%'";

$result = $con->query($sql);
if ($result->num_rows === 0) exit ("");
echo "<div id='searchbox-results'>";
while($row = $result->fetch_assoc()){
    echo "<div class='searchbox-resitem'>
    <p>".$row['nome']."</p>
</div>";
}
echo "</div>";
?>