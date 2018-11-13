<?php
    require "header.html";
    require "navbar.php";
    require "dbconnect.php";

    $resultun = file_get_contents("http://fipeapi.appspot.com/api/1/carros/marcas.json");
    $result = json_decode($resultun, true);
    print_r($result[0]["id"]);
?>

<div id="fipe-block">
    <div id="fipe-select-container">
        <select id="fipe-select-brand">
        <?php
            if (!isset($_GET["m"])){
            foreach($result as $key){
                echo "<option value='".$key["id"]."'>".$key["fipe_name"]."</option>";
            }
        } else {
            /* $keyid = array_search($_GET["m"], array_column($result, 'id')); */
            foreach($result as $key){
                if ($key["id"] == $_GET["m"]){
                    echo "<option value='".$key["id"]."' selected>".$key["fipe_name"]."</option>";
                } else {
                echo "<option value='".$key["id"]."'>".$key["fipe_name"]."</option>";
            }
        }
            
        }
         ?>
        </select>
        <select id="fipe-select-model">
        <?php 
        if (isset($_GET["m"])){

            $resultun = file_get_contents("http://fipeapi.appspot.com/api/1/carros/veiculos/".$_GET["m"].".json");
            $result = json_decode($resultun, true);

            foreach($result as $key){
                echo "<option value='".$key["id"]."'>".$key["fipe_name"]."</option>";
            }
            if (isset($_GET["mo"])){
                foreach($result as $key){
                    if ($key["id"] == $_GET["mo"]){
                        echo "<option value='".$key["id"]."' selected>".$key["fipe_name"]."</option>";
                    } else {
                    echo "<option value='".$key["id"]."'>".$key["fipe_name"]."</option>";
                }
            }
        }
     } ?>
        </select>
        <select id="fipe-select-year">

        </select>
    </div>
    <div id="fipe-results-container">

    </div>
</div>