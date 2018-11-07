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
        <a href="index.php">
            <div class="navbtn">
                <p>Home</p>
            </div>
        </a>
        <a href="estoque.php">
        <div class="navbtn" onclick="location.reload();location.href='estoque.php'">
            <p>Estoque</p>
        </div>
        </a>
        <div class="navbtn">
            <p>Contato</p>
        </div>
        <div class="navbtn">
            <p>Em breve</p>
        </div>
    </div>
</div>