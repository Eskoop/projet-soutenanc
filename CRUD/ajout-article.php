<?php
require_once '../inc/init.inc.php';

if ($_POST) {
    if (
        isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['contenu']) && !empty($_POST['contenu'])
        && isset($_POST['photo_1']) && !empty($_POST['photo_1'])
    ) {
        $titre = strip_tags($_POST['titre']);
        $contenu = strip_tags($_POST['contenu']);
        $photo_1 = strip_tags($_POST['photo_1']);

        $sql = 'INSERT INTO blog (titre, photo_1, contenu, id_client) VALUES (:titre, :photo_1, :contenu, :id_client)';
        $query = $pdoManga->prepare($sql);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':photo_1', $photo_1, PDO::PARAM_STR);
        $query->bindValue(':contenu', $contenu, PDO::PARAM_STR);
        $query->bindValue(':id_client', $_SESSION['client']['id_client'], PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Article ajouté";
        header('Location: index-article.php');
        exit;
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <main class="container">
        <div class="row">
            <?php
            if (!empty($_SESSION['erreur'])) {
                echo '<div class="alert alert-danger" role="alert">
                            ' . $_SESSION['erreur'] . '
                        </div>';
                $_SESSION['erreur'] = "";
            }
            ?>
            <section class="col-12">
                <h1>Ajouter un article</h1>
                <form method="post" action="">

                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contenu">Contenu</label>
                        <textarea id="contenu" name="contenu" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo_1">Photo N°1</label>
                        <input type="text" id="photo_1" name="photo_1" class="form-control">
                    </div>

                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
