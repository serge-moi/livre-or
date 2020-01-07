<?php

session_start();

if(isset($_SESSION["login"])){
    header("Location: index.php");
    die;
}

if(isset($_POST["formconnexion"])){
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password");
    $hash = password_hash($password, PASSWORD_DEFAULT);
    if(!empty($login) && !empty($password)){
        $connexion = mysqli_connect("localhost", "root", "", "livreor");
        $requete = "SELECT * FROM utilisateurs WHERE login = \"$login\"";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);
        if(!empty($resultat)){
            if(password_verify($password, $resultat[0][2])){
                $_SESSION['message3'] = "connexion effectué";
                $_SESSION["login"] = $login;
                $_SESSION["password"] = $password;
                header("Location:index.php");
            }
            else{
                $erreur = "Mauvais login ou mot de passe !";
            }
        }
        else{
            $erreur = "Cet identifiant n'existe pas";
        }
    }
    else{
        $erreur = "Tous les champs doivent être complétés !";
    }
}

if(!isset($_SESSION["login"])):
    require("partials/header.phtml"); ?>
    <main id="main-connect">
        <div>
            <h2 id="co-h2">Connexion</h2>
        </div>
        <form id="form-connect2" method="POST" action="">
            <div id="inp-log">
                <input type="text" name="login" placeholder="Login">
                <input type="password" name="password" placeholder="Mot de passe">
                <input type="submit" name="formconnexion" value="Se connecter !">
            </div>
        </form>
        <?php if(isset($erreur)):
            echo $erreur;
        endif; ?>
    </main>
<?php require("partials/footer.phtml"); 
endif;

?>