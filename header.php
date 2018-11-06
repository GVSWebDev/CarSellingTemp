<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>CarSell</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <script src="js/fixing.js"></script>
    <script src="js/form-validation.js"></script>
    <script src="js/destaque-slide.js"></script>
    <script src="js/map-sizer.js"></script>
    <script src="js/slide.js"></script>
    <script src="js/javacalls.js"></script>
    <script src="resources/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
</head>
<div id="navbar">
    <div id="logo-c">
        <img src="resources/logo-temp.png" id="logo">
    </div>
    <div id="searchbox-c">
        <div id="searchbox-wrapper">
            <div id="searchbox-input-c">
                <form id="searchbox-form" action="estoque.php">
                    <input id="searchbox-input" name="s" type="text" autocomplete="off" onkeyup="getStr(this.value)">
                </form>
            </div>
        </div>
        <div id="searchbox-icon-c">
            <i class="fa fa-search" aria-hidden="true"></i>
        </div>
    </div>
    <div id="navbtn-container">
        <div class="navbtn" onclick="location.reload();location.href='index.php'">
            <p>Home</p>
        </div>
        <div class="navbtn" onclick="location.reload();location.href='estoque.php'">
            <p>Estoque</p>
        </div>
        <div class="navbtn">
            <p>Contato</p>
        </div>
        <div class="navbtn">
            <p>Em breve</p>
        </div>
    </div>
</div>