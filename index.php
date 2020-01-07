<?php

session_start();



require("partials/header.phtml"); ?>
        <main id="header-main">
<?php   if(isset($_SESSION["login"])): ?>
            <div id="welcome">Welcome <?php echo $_SESSION["login"] ?></div>
            <img src="img/welcome.gif"/>
        <?php else : ?>
            <p id="plz-log">Please Login !</p>
            <img src="img/please" id="please" alt="please">
            <a id="log-index" href="connexion.php">Connexion</a>
            <p id="if-not-acc">if you dont have an account sign up</p>
            <a id="sign" href="inscription.php">Sign Up</a>
            <p></p>
        <?php endif; ?>
        </main>
<?php require("partials/footer.phtml");

if(isset($_SESSION["message"])){
    echo $_SESSION["message"];
}

unset($_SESSION['message']);


if(isset($_SESSION["message2"])){
    echo $_SESSION["message2"];
}
unset($_SESSION["message2"]);

if(isset($_SESSION["message3"])){
    echo $_SESSION["message3"];
}
unset($_SESSION["message3"]);

    
?>