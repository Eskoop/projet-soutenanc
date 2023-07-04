<?php

require_once '../inc/init.inc.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM blog WHERE id_article = :id';

    $query = $pdoManga->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $article = $query->fetch();

    if (!$article) {
        $_SESSION['erreur'] = "Cet id n'existe pas ";
        header('Location: index-article.php');
    }
} else {

    $_SESSION['erreur'] = "URL invalise";
    header('Location: index-article.php');
}

if ($_POST) {
    if (
        isset($_POST['id_a']) && !empty($_POST['id_article'])
        && isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['contenu']) && !empty($_POST['contenu'])
        && isset($_POST['photo_1']) && !empty($_POST['photo_1'])
        



    ) {
        $id = strip_tags($_POST['id_article']);
        $titre = strip_tags($_POST['titre']);
        $contenu = strip_tags($_POST['contenu']);
        $photo_1 = strip_tags($_POST['photo_1']);




        $sql = ' UPDATE blog SET  titre = :titre, contenu = :contenu, photo_1 = :photo_1 WHERE id_article = :id';
        $query = $pdoManga->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':contenu', $contenu, PDO::PARAM_STR);
        $query->bindValue(':Photo_1', $photo_1, PDO::PARAM_STR);
       

        $query->execute();


        $_SESSION['message'] = "Article modifié ";
        header('Location: index-article.php');
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
    <title>Modifier un produit</title>
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
                $_SESSION['erreur'] = " ";
            }
            ?>
            <section class="col-12">
                <h1>Modifié un produit</h1>
                <form method="post">

                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control" value="<?php echo $article['titre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="contenu">Contenu</label>
                        <textarea id="contenu" name="contenu" class="form-control"> <?php echo $article['contenu'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo_1">Photo</label>
                        <input type="text" id="photo_1" name="photo_1" class="form-control" value="<?php echo $article['photo_1'] ?>">
                    </div>
                    

                    <input type="hidden" value="<?php echo $article['id_article'] ?>" name="id_article">



                    <button class="btn btn-primary">Envoyer</button>
                </form>
                    <a href="index-article.php" class="btn btn-primary">retour</a>


            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>