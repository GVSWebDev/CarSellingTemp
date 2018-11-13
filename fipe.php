<?php
    require "header.html";
    require "navbar.php";
    require "dbconnect.php";

    $resultun = file_get_contents("http://fipeapi.appspot.com/api/1/carros/marcas.json");
    $result = json_decode($resultun, true);
    
?>

<div id="fipe-block">
    <div id="fipe-select-container">
        <select id="fipe-select">
        <?php foreach($result as $key){
            echo "<option value='".$key["name"]."'>".$key["fipe_name"]."</option>";
        } ?>
        </select>
    </div>
    <div id="fipe-results-container">

    </div>
</div>