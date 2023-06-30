<?php

require_once '../inc/init.inc.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM produit WHERE id_produit = :id';

    $query = $pdoManga->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $produit = $query->fetch();

    if (!$produit) {
        $_SESSION['erreur'] = "Cet id n'existe pas ";
        header('Location: index-produit.php');
    }
} else {

    $_SESSION['erreur'] = "URL invalise";
    header('Location: index-produit.php');
}

if ($_POST) {
    if (
        isset($_POST['id_produit']) && !empty($_POST['id_produit'])
        && isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['genre']) && !empty($_POST['genre'])
        && isset($_POST['auteur']) && !empty($_POST['auteur'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['prix']) && !empty($_POST['prix'])
        && isset($_POST['stock']) && !empty($_POST['stock'])
        && isset($_POST['photo_1']) && !empty($_POST['photo_1'])
        // && isset($_POST['alt-photo-1']) && !empty($_POST['alt-photo-1'])
        // && isset($_POST['photo-2']) && !empty($_POST['photo-2'])
        // && isset($_POST['alt-photo-2']) && !empty($_POST['alt-photo-2'])


    ) {
        $id = strip_tags($_POST['id_produit']);
        $genre = strip_tags($_POST['genre']);
        $titre = strip_tags($_POST['titre']);
        $description = strip_tags($_POST['description']);
        $auteur = strip_tags($_POST['auteur']);
        $prix = strip_tags($_POST['prix']);
        $photo_1 = strip_tags($_POST['photo_1']);
        // $altPhoto1 = strip_tags($_POST['alt-photo-1']);
        // $photo2 = strip_tags($_POST['photo-2']);
        // $altPhoto2 = strip_tags($_POST['alt-photo-2']);
        $stock = strip_tags($_POST['stock']);



        $sql = ' UPDATE produit SET  genre = :genre, titre = :titre, description = :description,  auteur = :auteur, prix = :prix, photo_1 = :photo_1 , stock = :stock WHERE id_produit = :id';
        $query = $pdoManga->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':genre', $genre, PDO::PARAM_STR);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':auteur', $auteur, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':photo_1', $photo_1, PDO::PARAM_STR);
        // $query->bindValue(':alt-photo-1', $altPhoto1, PDO::PARAM_STR);
        // $query->bindValue(':photo-2', $photo2, PDO::PARAM_STR);
        // $query->bindValue(':alt-photo-2', $altPhoto2, PDO::PARAM_STR);
        $query->bindValue(':stock', $stock, PDO::PARAM_STR);

        $query->execute();


        $_SESSION['message'] = "Produit modifié ";
        header('Location: index-produit.php');
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
                        <label for="genre">Genre</label>
                        <select id="genre" name="genre" class="form-control" value="<?php echo $produit['genre'] ?>">
                            <option value="">Veuillez choisir le genre du produit</option>
                            <option value="livre" <?php if ($produit['genre'] === 'livre') echo 'selected'; ?>>Livre</option>
                            <option value="goodies" <?php if ($produit['genre'] === 'goodies') echo 'selected'; ?>>Goodies</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control" value="<?php echo $produit['titre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control"> <?php echo $produit['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="auteur">Auteur</label>
                        <input type="text" id="auteur" name="auteur" class="form-control" value="<?php echo $produit['auteur'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" value="<?php echo $produit['prix'] ?>">

                    </div>
                    <div class="form-group">
                        <label for="photo_1">Photo N°1</label>
                        <input type="text" id="photo_1" name="photo_1" class="form-control" value="<?php echo $produit['photo_1'] ?>">
                    </div>
                    <!-- 
                    <div class="form-group">
                        <label for="altPhoto1">Alt Photo n°1</label>
                        <input type="text" id="altPhoto1" name="altPhoto1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo2">Photo n°2</label>
                        <input type="text" id="photo2" name="photo2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="altPhoto2">Alt Photo n°2</label>
                        <input type="text" id="altPhoto2" name="altPhoto2" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" class="form-control" value="<?php echo $produit['stock'] ?>">
                    </div>

                    <input type="hidden" value="<?php echo $produit['id_produit'] ?>" name="id_produit">



                    <button class="btn btn-primary">Envoyer</button>
                </form>
                    <a href="index-produit.php" class="btn btn-primary">retour</a>


            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>