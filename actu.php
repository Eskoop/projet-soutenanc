<?php
// Lien vers la BDD
require_once 'inc/init.inc.php';

$requete = $pdoManga ->query('SELECT * FROM blog ORDER BY id_article DESC')
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tengoku - Actualité</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
</head>

<body>
    <header>
        <?php require_once 'inc/nav.php' ?>
    </header>
    <main>
        <h2>Les actu</h2>
    <?php while($article = $requete -> fetch(PDO::FETCH_ASSOC)){
          echo  '<div class="col-12 col-md-4">
                <div class="card p-1 my-3">
                    <img src="' . $article['photo-1'].'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="articleActu.php?id_article=' . $article['id_article'] . '">' . $article['titre'] . '</a></h5>
                        <p class="card-text">' .html_entity_decode(substr($article['contenu'],0 , 100)) . '</p>'
                        .// Il faut mettre un bouton pour se diriger vers l\'article
                    '</div>
                </div>
            </div>';
}
?>

    </main>
    <footer>

    </footer>
    <script src="Css/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>

</html>