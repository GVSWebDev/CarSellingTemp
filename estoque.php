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

        </div>
    </div>
</body>

<?php
require "footer.html";
?>