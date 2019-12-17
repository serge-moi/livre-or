<?php

session_start();

$connexion = mysqli_connect("localhost", "root", "", "livreor");
$requete = "SELECT * FROM utilisateurs";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);

$account = false;

if(isset($_POST["connexion"]) == true){
    foreach($resultat as $key => $value){
        if($resultat[$key][1] == $_POST["login"] && password_verify($_POST["password"], $resultat[$key][2])){
            $account = true;
            $_SESSION['id']=$resultat[$key][0] ;
        break;
        }
    }
    if($account == true){
        $_SESSION["login"] = $_POST["login"];
        header("Location:index.php");
        echo "Bienvenue".$_SESSION['login'];
    } else {
        echo "Login ou mot de passe incorrect";
    }
}

if(!isset($_SESSION["login"])):
    require("partials/header.phtml"); ?>
    <main id="main-connect">
        <h2 id="co-h2">Connexion</h2>
        <form id="form-connect" action="" method="POST">
            <div id="inp-log">
                <input type="text" name="login" placeholder="login">
                <input type="password" name="password" placeholder="password">
            </div>
            <button type="submit" name="connexion">se connecter</button>
        </form>
    </main>
<?php require("partials/footer.phtml"); 
endif;

if(isset($_POST["login"])){
    $login = $_POST["login"];
} else {
    $login = "";
}

mysqli_close($connexion);

?>