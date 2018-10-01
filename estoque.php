<?php 
require "header.html";
?>

<body>
    <div id="wrapper">
        <div id="filter-c">
            <p>Filtrar por:</p>
            <form class="form">
            <div class="filter-section-c">
                <hr>
                <p class="filter-p">Marca:</p>
                
                    <input type="checkbox" class="checkbox" name="peugeot">Peugeot
                
            </div>
            <div class="filter-section-c">
                <hr>
                <p class="filter-p">Cambio:</p>
                
                    <input type="checkbox" class="checkbox" name="peugeot">Automatico
                
            </div>
            </form>
        </div>
        <div id="results-c">
            <div class="stock-item-c">
                <div class="side-shadow">

                </div>
                <div class="car-image-c">
                    <img src="resources/peujeot.jpg" class="car-image">
                </div>
                <div class="info-text-c">
                    <div class="info-top-c">
                        <p>Peugeot 208 1.2 Allure 12V FLEX</p>
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
            </div>
        </div>
    </div>
</body>

<?php
require "footer.html";
?>