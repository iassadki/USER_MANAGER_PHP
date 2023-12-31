<?php
$pdoBuilder = new Connection();
$db = $pdoBuilder->getDb();

require_once('./Model/UserManager.php');
$userManager = new UserManager($db);
?>

<header>
    <div id="info-bar">
        <p>My wonderful platform</p>
    </div>

    <div id="banner-bloc">
        <h1>TP Authentification et MVC</h1>
    </div>

    <div id="account_bar">
        <?php if(isset($_SESSION['user'])) { ?>
        <div class="connection center">
        	<div class="text">Bonjour <?php echo $_SESSION['user']['firstName']; ?></div>
            <a href="./index.php?ctrl=UserController&action=doLogout" class="no-deco" title="Logout account">
                <i class="fas fa-user"></i>
                <div class="text">Logout</div>
            </a>
        </div>
        <?php } else { ?>
        <div class="connection center">
            <a href="./index.php?ctrl=UserController&action=login" class="no-deco" title="Login or create account">
                <i class="fas fa-user"></i>
                <div class="text">Login</div>
            </a>
        </div>
        <?php } ?>
    </div>

    <ul id="menu_bar">
        <a href="./index.php?ctrl=UserController&action=usersList" class="no-deco"><li>Liste des utilisateurs</li></a>
        <a href="./" class="no-deco"><li>Le mémoire</li></a>
        <a href="./" class="no-deco"><li>La soutenance</li></a>
        <a href="./" class="no-deco"><li>Le carnet de liaison</li></a>
        <a href="./" class="no-deco"><li>Les espaces de travail</li></a>
    </ul>
</header>