<?php 
require "header.html";
?>

<body>
    <div id="wrapper">
        <div id="filter-c">
            <p>Filtrar por:</p>
            <div class="filter-section-c">
                <hr>
                <p class="filter-p">Marca:</p>
                <form class="form">
                    <input type="checkbox" class="checkbox" name="peugeot">Peugeot
                </form>
            </div>
            <div class="filter-section-c">
                <hr>
                <p class="filter-p">Cambio:</p>
                <form class="form">
                    <input type="checkbox" class="checkbox" name="peugeot">Automatico
                </form>
            </div>
        </div>
        <div id="results-c">

        </div>
    </div>
</body>

<?php
require "footer.html";
?>