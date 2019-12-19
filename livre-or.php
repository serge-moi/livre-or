<?php

session_start();



$connexion = mysqli_connect("localhost", "root", "", "livreor");
$requete = "SELECT date_format(date,'%d/%m/%Y'),login, commentaire FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY date DESC";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);

require("partials/header.phtml");?>
    <main id="main-goldbook">
<?php foreach($resultat as $key => $value): ?>
    <div id="div-coment">
        <div id="post-coment">Posté le <div id="value-date"><?php echo $value[0] ?></div> par <div id="value-name"><?php echo $value[1] ?></div></div>
        <div id="com"><?php echo $value[2] ?></div>
    </div>
<?php endforeach; ?>
    </main>
<?php require("partials/footer.phtml"); ?>


