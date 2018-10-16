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
                echo '<body>
                <script src="js/slide.js"></script>
                <script src="js/tab-controller.js"></script>
                <div id="wrapper">
                    <div id="info-section">';
                    $sql = "SELECT * FROM pdb.carros WHERE carroid = ".$_GET["id"];
                    $result = $con->query($sql);

                    if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                    } else {
                        echo "0 results";
                    }
                        echo '<div id="name-block">
                            <div id="name-c">
                                <h1>'.$row['marca']." ".$row['nome'].'</h1>
                            </div>
                            <div id="id-c">
                                <p>ID '.$row['carroid'].'</p>
                            </div>
                        </div>
                        <div id="picture-block">
                            <div id="main-display-c">
                                <div class="display-arrow" onclick="nextLeft()">
                                    <img src="resources/arrow.png" class="arrow-img">
                                </div>
                                <div id="image-c">
                                    <div class="blockifier left-block">
                                        <img src="" id="prevImg" class="notrans left-ready main-image">
                                    </div>
                                    <div class="blockifier middle-block">
                                    <img src="" class="notrans showing main-image" id="main-display">
                                </div>
                                <div class="blockifier right-block">
                                    <img src="" id="nextImg" class="notrans right-ready main-image">
                                </div>
                                </div>
                                <div class="display-arrow dsparrow-r" onclick="nextRight()">
                                    <img src="resources/arrow.png" class="arrow-img right-r">
                                </div>
                            </div>
                            <div id="preview-c">';
                                $sqlthumb = "SELECT * FROM pdb.carros_img WHERE carroid = ".$_GET['id'];
                                $resultthumb = $con->query($sqlthumb);

                                if($resultthumb->num_rows > 0){
                                    while($rowthumb = $resultthumb->fetch_assoc()){
                                        echo "<img src='".$rowthumb['imglink']."' class='thumbnail'>";
                                    }
                            
                                } else {
                                    echo "<img src='resources/placeholder.png' class='thumbnail'>";
                                }
                            echo '</div>
                        </div>
                        <div id="about-block">
                            <div id="tabs-c">
                                <div id="des-c" onclick="setTab('."'".'des-c'."'".'); setContent('."'".'content-d'."'".')" class="tab tab-show">
                                    <p>Descrição</p>
                                </div>
                                <div id="specs-c" onclick="setTab('."'".'specs-c'."'".'); setContent('."'".'content-e'."'".')" class="tab">
                                    <p>Especificações</p>
                                </div>
                                <div id="opc-c" onclick="setTab('."'".'opc-c'."'".'); setContent('."'".'content-o'."'".')" class="tab">
                                    <p>Opcionais</p>
                                </div>
                            </div>
                            <div id="divider"></div>
                            <div id="content-d" class="about-content" style="display: flex;">
                                <p>'.$row["descricao"].'</p>
                            </div>
                            <div id="content-e" class="about-content" style="display: none;">
                                <div id="km-container" class="about-section">
                                        <i class="fa fa-tachometer fa-3x" aria-hidden="true"></i>
                                        <div class="about-text">
                                    <p>Kilometragem: '.$row['kilometragem'].'km</p>
                                    <p>Gasolina: '.$row['combustivel'].'</p>
                                </div>
                                </div>
                                <div id="color-container" class="about-section">
                                        <i class="fa fa-paint-brush fa-3x" aria-hidden="true"></i>
                                        <div class="about-text">
                                    <p>Cor exterior: '.$row['cor'].'</p>
                                    <p>Cor interior: '.$row['corint'].'</p>
                                </div>
                                </div>
                                <div id="engine-container" class="about-section">
                                        <i class="fa fa-cogs fa-3x" aria-hidden="true"></i>
                                        <div class="about-text">
                                    <p>'.$row['motor'].' '.$row['cavalaria'].'</p>
                                    <p>Tração '.$row['tracao'].'</p>
                                    <p>Transmissão '.$row['cambio'].'</p>
                                </div>
                                </div>
                                <div id="year-container" class="about-section">
                                        <i class="fa fa-calendar fa-3x" aria-hidden="true"></i>
                                    <div class="about-text">
                                        <p>Ano: '.$row['ano'].'</p>
                                    </div>
                                </div>
                            </div>
                            <div id="content-o" class="about-content" style="display: none;">
                                    <ul class="extras-c">';
                                        $sqlop = "SELECT * FROM pdb.carros_opc WHERE carroid = ".$_GET['id'];
                                        $resultop = $con->query($sqlop);

                                        if($resultop->num_rows > 0){
                                            while($rowop = $resultop->fetch_assoc()){
                                                if ($rowop["destaque"] == 1){
                                                    echo "<li class='extras-li li-imp'>".$rowop["opcional"]."</li>";
                                                } else {
                                                    echo "<li class='extras-li'>".$rowop["opcional"]."</li>";
                                                }
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        
                                    echo '</ul>
                            </div>
                        </div>
                        <div id="rec-container">
                            <div id="rec-text">
                                <h2>Recomendado para você:</h2>
                            </div>
                      
                            <div id="rec-list">
                                <div class="rec-item">
                                    <div class="rec-img-c">
                                        <img src="resources/focus.jpg" class="rec-img">
                                    </div>
                                    <div class="rec-text-c">
                                        <div class="rec-text-title">
                                            <h4>Peugeot 206 12V</h4>
                                        </div>
                                        <div class="rec-specs-c">
                                            <div class="rec-specs-item">
                                                <p>Ano</p>
                                                <div class="separator"></div>
                                                <p>2016</p>
                                            </div>
                                            <div class="rec-specs-item">
                                                <p>Kilometragem</p>
                                                <div class="separator"></div>
                                                <p>30000km</p>
                                            </div>
                                            <div class="rec-specs-item">
                                                <p>Gasolina</p>
                                                <div class="separator"></div>
                                                <p>Flex</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rec-shadow"></div>
                                </div>
                                <div class="rec-item">
                                    <div class="rec-img-c">
                                        <img src="resources/focus.jpg" class="rec-img">
                                    </div>
                                    <div class="rec-text-c">
                                        <div class="rec-text-title">
                                            <h4>Peugeot 206 12V</h4>
                                        </div>
                                        <div class="rec-specs-c">
                                            <div class="rec-specs-item">
                                                <p>Ano</p>
                                                <div class="separator"></div>
                                                <p>2016</p>
                                            </div>
                                            <div class="rec-specs-item">
                                                <p>Kilometragem</p>
                                                <div class="separator"></div>
                                                <p>30000km</p>
                                            </div>
                                            <div class="rec-specs-item">
                                                <p>Gasolina</p>
                                                <div class="separator"></div>
                                                <p>Flex</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rec-shadow"></div>
                                </div>
                                <div class="rec-item">
                                    <div class="rec-img-c">
                                        <img src="resources/focus.jpg" class="rec-img">
                                    </div>
                                    <div class="rec-text-c">
                                        <div class="rec-text-title">
                                            <h4>Peugeot 206 12V</h4>
                                        </div>
                                        <div class="rec-specs-c">
                                            <div class="rec-specs-item">
                                                <p>Ano</p>
                                                <div class="separator"></div>
                                                <p>2016</p>
                                            </div>
                                            <div class="rec-specs-item">
                                                <p>Kilometragem</p>
                                                <div class="separator"></div>
                                                <p>30000km</p>
                                            </div>
                                            <div class="rec-specs-item">
                                                <p>Gasolina</p>
                                                <div class="separator"></div>
                                                <p>Flex</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rec-shadow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="buy-section" class="buy-fixed">
                        <div id="price-block">
                            <div id="price-h2">
                                <h2>Preço</h2>
                            </div>
                            <div id="price">
                                <h1>R$'.$row["preco"].'</h1>
                            </div>
                        </div>
                        <div id="proposal-block">
                            <div id="proposal-button" class="prop-btn" onclick="setForm('."'".'proposal'."'".')">
                                <div class="side-color"></div>
                                <p>Fazer Proposta</p>
                            </div>
                            <div class="prop-c" id="proposal-c">
                                <div class="form-c">
                                    <form class="form" id="form-test" name="proposta-normal">
                                        <p>Nome:</p>
                                        <input name="nome" type="text" class="input-full">
                                        <p>Telefone:</p>
                                        <input name="telefone" type="text" class="input-full">
                                        <p>Email:</p>
                                        <input name="email" type="email" class="input-full">
                                        <p>Mensagem:</p>
                                        <textarea name="mensagem" class="input-big"></textarea>   
                                        <input class="submit-btn" type="submit" value="Enviar">
                                    </form>
                                </div>
                            </div>
                            <div id="troca-button" class="prop-btn" onclick="setForm('."'".'troca'."'".')">
                                <div class="side-color"></div>
                                <p>Fazer Proposta de Troca</p>
                            </div>
                            <div class="prop-c" id="troca-c">
                                <div class="form-c">
                                    <form class="form" action="">
                                        <p>Nome:</p>
                                        <input name="nome" type="text" class="input-full">
                                        <p>Telefone:</p>
                                        <input name="telefone" type="text" class="input-full">
                                        <p>Email:</p>
                                        <input name="email" type="email" class="input-full">
                                        <p>Mensagem:</p>
                                        <textarea name="mensagem" class="input-big"></textarea>
                                        <input class="submit-btn" type="submit" value="Enviar">
                                    </form>
                                </div>
                            </div>
                            <script src="js/form-validation.js"></script>
                            <div id="finance-button" class="prop-btn" onclick="setForm('."'".'finance'."'".')">
                                <div class="side-color"></div>
                                <p>Simular Financiamento</p>
                            </div>
                            <div id="contact-c">
                                <h3>Contato:</h3>
                                <div class="tel-btn">
                                        <div class="tel-btn-content">
                                    <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                                    <h4> (43) 3304-0132</h4>
                                </div>
                                </div>
                                <div class="tel-btn zip-zop">
                                    <div class="tel-btn-content">
                                        <i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i>
                                        <h4>(43) 99824-4337</h4>
                                    </div>
                                    </div>
                            </div>
            
                        </div>
                    </div>
                </div>
                
            </body>';
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