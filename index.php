<?php
    require "contactstrip.html";
    require "header.php";
    require "footer.html";
    require "dbconnect.php";
?>

<body>
    <script>setTimer()</script>
    <div id="banner-block">
        <div id="banner-container">
                <div id="main-display-c">
                        
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
                        
                </div>
                <div id="image-preloader">
                    <img src="resources/cover2.png" class="thumbnail">
                    <img src="resources/cover2.png" class="thumbnail">
                    <img src="resources/cover2.png" class="thumbnail">
                
        </div>
    </div>
    </div>
    <div id="destaque-block">
        <div id="destaque-text">
            <div class="dest-slider-arrow-c" onclick="scrollToLeft(true)">
                <img src="resources/arrowwhite.png" class="dest-slider-arrow">
            </div>
            <h2>Carros em Destaque</h2>
            <div class="dest-slider-arrow-c" onclick="scrollToRight(true)">
                    <img src="resources/arrowwhite.png" class="dest-slider-arrow dsarotated">
                </div>
        </div>
        <div id="destaque-container">
            <div class="imfading"></div>
            <div id="destaque-item-container">
                <?php
                    $sql = "SELECT * FROM gvswebde_pdb.carros WHERE destaque = 1";
                    $result = $con->query($sql);

                    if($result->num_rows === 0) exit ("Não há carros em destaque!");
                    while($row = $result->fetch_assoc()){
                        $sqlimg = "SELECT * FROM gvswebde_pdb.carros_img WHERE carroid = ".$row["carroid"]." AND isprincipal = 1";
                        $resultimg = $con->query($sqlimg);
                        $rowimg = $resultimg->fetch_assoc();
                        echo '<div class="rec-item">
                                <div class="rec-img-c">
                                    <div class="rec-price">
                                        <h3>R$'.$row["preco"].'</h3>
                                    </div>
                                <img src="'.$rowimg["imglink"].'" class="rec-img">
                                </div>
                        <div class="rec-text-c">
                            <div class="rec-text-title">
                                <h4>'.$row["nomefull"].'</h4>
                            </div>
                            <div class="rec-specs-c">
                                <div class="rec-specs-item">
                                    <p>Ano</p>
                                    <div class="separator"></div>
                                    <p>'.$row["ano"].'</p>
                                </div>
                                <div class="rec-specs-item">
                                    <p>Kilometragem</p>
                                    <div class="separator"></div>
                                    <p>'.$row["kilometragem"].'km</p>
                                </div>
                                <div class="rec-specs-item">
                                    <p>Gasolina</p>
                                    <div class="separator"></div>
                                    <p>'.$row["combustivel"].'</p>
                                </div>
                            </div>
                        </div>
                        <div class="rec-shadow"></div>
                    </div>';
                    }
                ?>
                </div>
                <div class="imfading imfrotated"></div>
                <!-- <div class="rec-item">
                    <div class="rec-price">
                            <h3>R$30.000,00</h3>
                        </div>
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
            <div class="imfading imfrotated"></div> -->
        </div>
    </div>
    <div id="about-h-block">
        <div id="about-h-container">
            <div id="about-button-big-c" class="big-h-button">
                <h2>Sobre nós</h2>
            </div>
            <div id="estoque-button-big-c" class="big-h-button">
                <h2>Estoque</h2>
            </div>
            <div id="finance-button-big-c" class="big-h-button">
                <h2>Financiamentos</h2>
            </div>
        </div>
    </div>
    <div id="contact-block">
        <div id="contact-container" class="contact-section">
            <div id="contact-text">
                <h2>Contate-nos</h2>
            </div>
            <form id="contact-home-form" action="">
                <div id="contact-nome-c">
                    <div class="contact-nome">
                        <p>Nome:</p> 
                        <input name="nome" type="text" class="contact-home-input">
                    </div>
                    <div class="contact-nome">
                            <p>Sobrenome:</p> 
                            <input name="sobrenome" type="text" class="contact-home-input">
                        </div>
                </div>
                    <p>Email:</p> 
                    <input name="email" type="text" class="contact-home-input">
                    <p>Telefone:</p> 
                    <input name="telefone" type="text" class="contact-home-input">
                    <p>Mensagem:</p> 
                    <textarea name="mensagem" id="contact-home-message"></textarea>
                    <input type="submit" id="contact-home-submit" value="Enviar">
            </form>
        </div>
        <div id="map-container" class="contact-section">
            <div class="mapouter">
                <div class="map-canvas">
                    <iframe width="0" height="0" id="map-canvas" src="https://maps.google.com/maps?q=instacar%20multimarcas&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</body>