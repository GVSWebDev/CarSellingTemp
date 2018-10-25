<?php
require "dbconnect.php";

$sql = "SELECT * FROM gvswebde_pdb.carros WHERE nomefull LIKE '%".$_GET['q']."%'";

$result = $con->query($sql);
if($result->num_rows > 0){
echo "<div id='searchbox-results'>";
while($row = $result->fetch_assoc()){
    echo "<div class='searchbox-resitem' onclick='window.location=\"estoque.php?id=".$row["carroid"]."&c=".$row["nome"]."\";'>
    <p>".$row['nomefull']."</p>
</div>";
}
} else exit("");
echo "</div>";
?>