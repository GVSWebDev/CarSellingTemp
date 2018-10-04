<?php 
require "header.html";
require "dbconnect.php";
if(!isset($_GET["id"]) && !isset($_GET["c"])){
echo '<body>
    <div id="wrapper">
        <div id="filter-c">
            <div id="filter-wrapper">
            <p>Filtrar por:</p>
            <div id="filter-show">';
                foreach ($_GET as $id => $value){
                    $pastqueries = $_SERVER["QUERY_STRING"];
                    $array = explode('&', $pastqueries);
                    $filterout = array_diff($array, array($id.'='.$value));
                    $linkfinal = "'estoque.php"."?".implode('&', $filterout)."'";
                    echo '<div onclick="window.location='.$linkfinal.';" class="filter">
                    <i class="fa fa-times" aria-hidden="true"></i><p>'.$value.'</p>
                        </div>';
                }
            echo '</div>
            <form class="form">';

                $condition = 'WHERE ';
                $conditioncounter = 0;

                if(isset($_GET["m"])){
                    $_GET["m"] = $con->real_escape_string($_GET['m']);
                    $condition .= 'marca = "'.$_GET["m"].'"';
                    $conditioncounter++;
                }

                if(isset($_GET["a"])){
                    
                    if($conditioncounter > 0){
                        $condition .= ' AND ano = "'.$_GET["a"].'"';
                    } else {
                        $condition .= 'ano = "'.$_GET["a"].'"';
                    }
                    $conditioncounter++;
                }

                if(isset($_GET["p"])){
                    
                    if($conditioncounter > 0){
                        $condition .= ' AND cor = "'.$_GET["p"].'"';
                    } else {
                        $condition .= 'cor = "'.$_GET["p"].'"';
                    }
                    $conditioncounter++;
                }

                if(isset($_GET["t"])){
                    
                    if($conditioncounter > 0){
                        $condition .= ' AND cambio = "'.$_GET["t"].'"';
                    } else {
                        $condition .= 'cambio = "'.$_GET["t"].'"';
                    }
                    $conditioncounter++;
                }

                if(isset($_GET["g"])){
                    
                    if($conditioncounter > 0){
                        $condition .= ' AND combustivel = "'.$_GET["g"].'"';
                    } else {
                        $condition .= 'combustivel = "'.$_GET["g"].'"';
                    }
                    $conditioncounter++;
                }

                if ($conditioncounter == 0){
                    $condition = '';
                }
                
               

                $pastconditions = '';

                if(isset($_SERVER["QUERY_STRING"])){
                    $pastconditions = '&'.$_SERVER["QUERY_STRING"];
                    $pastconditions = implode('&', array_unique(explode('&', $pastconditions)));
                }

                $sql = "SELECT DISTINCT marca FROM pdb.carros ".$condition;
                
                $result = $con->query($sql);
                if($result->num_rows === 0) exit ("0 matches");
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Fabricante:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'?m='.$row["marca"].$pastconditions.'">'.$row["marca"].'</a><br>';
                } echo '</div>';

                $sql = "SELECT DISTINCT ano FROM pdb.carros ".$condition;
                
                $result = $con->query($sql);
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Ano:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'?a='.$row["ano"].$pastconditions.'">'.$row["ano"].'</a><br>';
                } echo '</div>';

                $sql = "SELECT DISTINCT cor FROM pdb.carros ".$condition;
                
                $result = $con->query($sql);
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Cor:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'?p='.$row["cor"].$pastconditions.'">'.$row["cor"].'</a><br>';
                } echo '</div>';

                $sql = "SELECT DISTINCT cambio FROM pdb.carros ".$condition;
                
                $result = $con->query($sql);
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Cambio:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'?t='.$row["cambio"].$pastconditions.'">'.$row["cambio"].'</a><br>';
                } echo '</div>';

                $sql = "SELECT DISTINCT combustivel FROM pdb.carros ".$condition;
    
                $result = $con->query($sql);
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Combustível:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'?g='.$row["combustivel"].$pastconditions.'">'.$row["combustivel"].'</a><br>';
                } echo '</div>';
            ?>
            <!-- <div class="filter-section-c">
                <hr>
                <p class="filter-p">Marca:</p>
                
                    <input type="checkbox" class="checkbox" name="peugeot">Peugeot
                
            </div>
            <div class="filter-section-c">
                <hr>
                <p class="filter-p">Cambio:</p>
                
                    <input type="checkbox" class="checkbox" name="peugeot">Automatico
                
            </div> -->
            
            </form>
            </div>
        </div>
        <div id="results-c">
            <?php
                $sql = "SELECT * FROM pdb.carros ".$condition;
                /* echo $sql; */
                $result = $con->query($sql);

                if($result->num_rows === 0) exit ("0 matches");
                while($row = $result->fetch_assoc()){
                    $sqlimg = $con->prepare("SELECT * FROM pdb.carros_img WHERE isprincipal = 1 AND carroid = ".$row["carroid"]);
                    $sqlimg->execute();
                    $resultimg = $sqlimg->get_result();
                    if ($resultimg->num_rows === 0){
                        $imagelink = 'resources/placeholder.png';
                    } else {
                    $rowimg = $resultimg->fetch_assoc();
                    $imagelink = $rowimg["imglink"];
                }

                    $sqlopc = $con->prepare("SELECT * FROM pdb.carros_opc WHERE carroid = ".$row["carroid"]);
                    $sqlopc->execute();
                    $resultopc = $sqlopc->get_result();
                    $semopcionais = false;

                    $opccounter = 0;

                    $nomet = trim($row["nome"]);
                    $link = "'estoque.php?id=".$row["carroid"]."&c=".preg_replace('/\s+/', '-', $nomet)."'";
                    
                    echo '<div class="stock-item-c">
                    <div class="side-shadow">
    
                    </div>
                    <div class="car-image-c">
                        <img src="'.$imagelink.'" class="car-image">
                    </div>
                    <div class="info-text-c">
                    <div class="info-top-c">
                        <h2>'.$row["marca"].' '.$row["nome"].'</h2>
                        <hr>
                    </div>
                    <div class="info-bottom-c">
                        <ul class="carinfo-c">
                            <li class="carinfo-li carinfo-km">'.$row["kilometragem"].'km</li>
                            <li class="carinfo-li carinfo-cam">Cambio '.$row["cambio"].'</li>
                            <li class="carinfo-li carinfo-ano">'.$row["ano"].'</li>
                            <li class="carinfo-li carinfo-por">'.$row["portas"].' Portas</li>
                        </ul>
                        <ul class="extras-c">';
                            if($resultopc->num_rows == 0) {echo "Sem opcionais :("; $semopcionais = true;}
                            else {
                            while($rowopc = $resultopc->fetch_assoc()){
                            if ($opccounter < 3){
                            echo '<li class="extras-li">'.$rowopc["opcional"].'</li>';
                            $opccounter++;
                            } else {
                            $rowopccount = mysqli_num_rows($resultopc) - $opccounter;
                            }  
                        }    
                    } if ($semopcionais != true){
                    echo '<a class="extras-anchor">+'.$rowopccount.' opcionais</a>';}
                    echo '</ul>
                    </div>
                </div>
                <div class="side-separator">

                </div>
                <div class="price-c">
                    <h1 class="price">R$'.$row["preco"].'</h1>
                    <p class="finance-p">Simule um financiamento</p>
                    <div onclick="window.location='.$link.';" class="saiba-mais-c">
                        <h2>Saiba mais</h2>
                    </div>
                </div>
            </div>';


                }
            } else {
                
            }
?>
            <!-- <div class="stock-item-c">
                <div class="side-shadow">

                </div>
                <div class="car-image-c">
                    <img src="resources/peujeot.jpg" class="car-image">
                </div>
                <div class="info-text-c">
                    <div class="info-top-c">
                        <h2>Peugeot 208 1.2 Allure 12V FLEX</h2>
                        <hr>
                    </div>
                    <div class="info-bottom-c">
                        <ul class="carinfo-c">
                            <li class="carinfo-li">30.000km</li>
                            <li class="carinfo-li">Cambio Manual</li>
                            <li class="carinfo-li">Ano 2007</li>
                            <li class="carinfo-li">4 Portas</li>
                        </ul>
                        <ul class="extras-c">
                            <li class="extras-li">Ar-condicionado</li>
                            <li class="extras-li">Vidros eletricos</li>
                            <li class="extras-li">Travas eletricas</li>
                            <a class="extras-anchor">+5 opcionais</a>
                        </ul>
                    </div>
                </div>
                <div class="side-separator">

                </div>
                <div class="price-c">
                    <h1 class="price">R$38,000.00</h1>
                    <p class="finance-p">Simule um financiamento</p>
                    <div class="saiba-mais-c">
                        <h2>Saiba mais</h2>
                    </div>
                </div>
            </div> -->
        
</body>

<?php
require "footer.html";
?>