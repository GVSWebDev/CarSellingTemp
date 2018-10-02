<?php 
require "header.html";
require "dbconnect.php";
if(!isset($_GET["id"]) && !isset($_GET["c"])){
echo '<body>
    <div id="wrapper">
        <div id="filter-c">
            <div id="filter-wrapper">
            <p>Filtrar por:</p>
            <form class="form">';
            
                $sql = $con->prepare("SELECT DISTINCT marca FROM pdb.carros");
                $sql->execute();
                $result = $sql->get_result();
                if($result->num_rows === 0) exit ("0 matches");
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Fabricante:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'&?m='.$row["marca"].'">'.$row["marca"].'</a><br>';
                } echo '</div>';

                $sql = $con->prepare("SELECT DISTINCT ano FROM pdb.carros");
                $sql->execute();
                $result = $sql->get_result();
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Ano:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'&?a='.$row["ano"].'">'.$row["ano"].'</a><br>';
                } echo '</div>';

                $sql = $con->prepare("SELECT DISTINCT cor FROM pdb.carros");
                $sql->execute();
                $result = $sql->get_result();
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Cor:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'&?c='.$row["cor"].'">'.$row["cor"].'</a><br>';
                } echo '</div>';

                $sql = $con->prepare("SELECT DISTINCT cambio FROM pdb.carros");
                $sql->execute();
                $result = $sql->get_result();
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Cambio:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'&?t='.$row["cambio"].'">'.$row["cambio"].'</a><br>';
                } echo '</div>';

                $sql = $con->prepare("SELECT DISTINCT combustivel FROM pdb.carros");
                $sql->execute();
                $result = $sql->get_result();
                echo '<div class="filter-section-c">
                <hr>
                <p class="filter-p">Combustível:</p>';
                while($row = $result->fetch_assoc()){
                    echo '<a href="'.$_SERVER["PHP_SELF"].'&?g='.$row["combustivel"].'">'.$row["combustivel"].'</a><br>';
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
            <input type="submit" value="Submit">
            </form>
            </div>
        </div>
        <div id="results-c">
            <?php
                $sql = $con->prepare("SELECT * FROM pdb.carros");
                $sql->execute();
                $result = $sql->get_result();

                if($result->num_rows === 0) exit ("0 matches");
                while($row = $result->fetch_assoc()){
                    $sqlimg = $con->prepare("SELECT * FROM pdb.carros_img WHERE isprincipal = 1 AND carroid = ".$row["carroid"]);
                    $sqlimg->execute();
                    $resultimg = $sqlimg->get_result();
                    $rowimg = $resultimg->fetch_assoc();
                    $imagelink = $rowimg["imglink"];

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
        </div>
    </div>
</body>

<?php
require "footer.html";
?>