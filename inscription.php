<?php

session_start();


if(isset($_POST["login"])){
    $login = $_POST["login"];
} else {
    $login = "";
}

if(isset($_POST["password"])){
    $password = $_POST["password"];
    $hash = password_hash($password, PASSWORD_DEFAULT);
} else {
    $password = "";
}


if(isset($_POST["confirm"])){
    $connexion = mysqli_connect("localhost", "root", "", "livreor");
    $requete = "SELECT login FROM utilisateurs WHERE login = \"$login\" ";
    $query = mysqli_query($connexion, $requete);
    $resultat = mysqli_fetch_all($query);

    if(!empty($resultat)){
        echo "<mark id=\"login-used\">Ce login est déjà pris</mark>";
    } else {
        $requete = "INSERT INTO utilisateurs (login, password) VALUES('$login', '$password')";
        $query = mysqli_query($connexion, $requete);
        header("Location:connexion.php");
    }
}

?>


<?php require("partials/header.phtml"); ?>
    <main id="main-connect">
        <h2 id="sub-h2">Inscription</h2>
        <form id="form-connect" action="inscription.php" method="POST">
            <div id="inp-log">
                <input type="text" name="login" placeholder="Votre login" required>
                <input type="password" name="password" placeholder="password" minlength="5" maxlength="10" required>
            </div>
            <button type="submit" name="confirm">s'inscrire</button>
        </form>
    </main>
<?php require("partials/footer.phtml");