<?php

session_start();


$connexion = mysqli_connect("localhost", "root", "", "livreor");
$requete="SELECT * from utilisateurs WHERE login = '".$_SESSION['login']."' ";
$query=mysqli_query($connexion,$requete);
$resultat=mysqli_fetch_assoc($query);

require("partials/header.phtml"); ?>
<main id="profil-main">
<form action="profil.php" id="edit-form" method="POST">
    <h1 id="edit-title">Edit your profile</h1>
    <label>Username :</label>
    <input class="prof-put" type="text" name="login" value="<?php echo $resultat['login'] ?>">
    <label>Password :</label>
    <input id="prof-passput" class="prof-put" type="password" name="password">
    <button id="but-edit" type="submit" name="modifier" value="modifier">Edit</button>
</form>
</main>
<?php require("partials/footer.phtml");

if(isset($_POST["modifier"])){
    $requete2 = "UPDATE utilisateurs SET login='".$_POST['login']."' WHERE login='".$_SESSION['login']."'";

        if($resultat['login'] != $_POST['login']){
            mysqli_query($connexion,$requete2);
            $_SESSION['login'] = $_POST['login'];
            header('Location:profil.php');
        }
        else if($resultat['password'] != $_POST['password']){
            if($_POST['password'] != NULL){
                $pass=$_POST['password'];
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $requete2 = "UPDATE utilisateurs SET password='".$hash."' WHERE login = '".$_SESSION['login']."'";
                mysqli_query($connexion,$requete2);
                header("Location:profil.php"); 
            }
        } else {
            echo "Erreur lors du changement d'informations";
        }
}

?>