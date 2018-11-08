<?php
require "dbconnect.php";



$sql = "SELECT * FROM gvswebde_pdb.carros WHERE nomefull LIKE '%".$_GET['q']."%'";

$result = $con->query($sql);
if($result->num_rows > 0){
echo "<div id='searchbox-results'>";
while($row = $result->fetch_assoc()){
    echo "<a tabindex='0' class='searchbox-resitem' href='estoque.php?id=".$row["carroid"]."&c=".preg_replace('/\s+/', '-', $row["nome"])."'>
    <p>".$row['nomefull']."</p>
</a>";

}
} else exit("");
echo "</div>";
?>