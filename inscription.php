<?php

session_start();

if(isset($_SESSION["login"])){
    header("Location: index.php");
    die;
}

if(isset($_POST["inscription"])){
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password");
    $password2 = filter_input(INPUT_POST, "password2");
    $hash = password_hash($password, PASSWORD_DEFAULT);



    // Si elles ne sont pas vide
    if(!empty($_POST['login']) && !empty($_POST['password'])){
        


        $loginsize = strlen($login);
        if($loginsize <= 255){
            $connexion = mysqli_connect("localhost", "root", "", "livreor");
            $requete = "SELECT login FROM utilisateurs WHERE login = \"$login\" ";
            $query = mysqli_query($connexion, $requete);
            $resultat = mysqli_fetch_all($query);
            if(!empty($resultat)){
                echo "Ce login est déjà pris";
            }else{
                if($password == $password2){
                    $requete = "INSERT INTO utilisateurs(login, password) VALUES ('$login','$hash')";
                    $query = mysqli_query($connexion, $requete);
                    $_SESSION['message'] = "Votre compte a bien été créé";
                    header("Location:index.php");
                }
                else{
                    
                    $erreur = "Vos mots de passes ne correspondent pas !";
                }
            }
        }
        else
        {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères";
        }
    } else {
        $erreur = "Tous les champs doivent être completé";
    }
}


require("partials/header.phtml"); ?>
<main id="main-connect">
    <div>
        <h2 id="sub-h2">Inscription</h2>
    </div>
    <form id="form-connect" method="POST" action="">
        <table>
            <tr>
                <td align="right">
                    <label for="login">Login :</label>
                </td>
                <td>
                    <input type="text" placeholder="Votre login" id="login" name="login" value="<?php if(isset($login)){echo $login; } ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="password">Mot de passe :</label>
                </td>
                <td>
                    <input type="password" placeholder="Votre mot de passe" id="password" name="password" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="password2">Confirmation du mot de passe :</label>
                </td>
                <td>
                    <input type="password" placeholder="Confirmez votre mdp" id="password2" name="password2" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td align="center">
                    <input type="submit" name="inscription" value="je m'inscris">
                </td>
            </tr>
        </table>
    </form>
    <?php if(isset($erreur)):
        echo $erreur;
    endif; ?>
</main>
<?php require("partials/footer.phtml");