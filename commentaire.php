<?php

session_start();

require("partials/header.phtml"); ?>
<main id="header-main">
<?php if(isset($_SESSION["id"])): ?>
    <h2 id="hey">Hey <?php echo $_SESSION['login']?></h2>
    <p class="policia">Ici, vous pouvez poster un commentaire</p>
    <form id="form-com" action="commentaire.php" method="post">
        <textarea name="comment" id="comment" cols="30" rows="10" ></textarea>
        <button type="submit">Envoyer</button>
    </form>
<?php else: ?>
    <p id="to-coment">To comment please login</p>
    <img id="told" src="img/toldyouso.gif" alt="told">
    <a id="co-coment" href="connexion.php">Connexion</a>
<?php endif; ?>
</main>
<?php require("partials/footer.phtml");


if(isset($_POST["comment"])&&$_POST["comment"]!="" && isset($_SESSION["id"])){
    $connexion = mysqli_connect("localhost", "root", "", "livreor");
    $requete = "INSERT INTO commentaires (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES (null, '".$_POST["comment"]."' ,'".$_SESSION["id"]."' , now())";
    $query = mysqli_query($connexion, $requete);
}

if(isset($_POST["comment"])): ?>
<section>
    <article id="if-sendcoment">
        <div id="gg-send">Félicitations, votre commentaire a été envoyé avec succès !</div>
        <div class="policia">Vous pouvez visiter la page</div> 
        <a href="livre-or.php" id="com-book">Golden Book</a> 
        <div class="policia">pour voir votre commentaire</div>
    </article>
</section>
<?php endif; ?>


