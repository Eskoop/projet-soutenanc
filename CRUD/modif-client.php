<?php

require_once '../inc/init.inc.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM client WHERE id_client = :id';

    $query = $pdoManga->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $client = $query->fetch();

    if (!$client) {
        $_SESSION['erreur'] = "Cet id n'existe pas ";
        header('Location: index-client.php');
    }
} else {

    $_SESSION['erreur'] = "URL invalise";
    header('Location: index-client.php');
}

if ($_POST) {
    if (
        isset($_POST['id_client']) && !empty($_POST['id_client'])
        && isset($_POST['genre']) && !empty($_POST['genre'])
        && isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['prenom']) && !empty($_POST['prenom'])
        && isset($_POST['pseudo']) && !empty($_POST['pseudo'])
        && isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['adresse']) && !empty($_POST['adresse'])
        && isset($_POST['ville']) && !empty($_POST['ville'])
        && isset($_POST['statut']) && !empty($_POST['statut'])
        // && isset($_POST['alt-photo-1']) && !empty($_POST['alt-photo-1'])
        // && isset($_POST['photo-2']) && !empty($_POST['photo-2'])
        // && isset($_POST['alt-photo-2']) && !empty($_POST['alt-photo-2'])


    ) {
        $id = strip_tags($_POST['id_client']);
        $genre = strip_tags($_POST['genre']);
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $pseudo = strip_tags($_POST['pseudo']);
        $email = strip_tags($_POST['email']);
        $adresse = strip_tags($_POST['adresse']);
        // $altPhoto1 = strip_tags($_POST['alt-photo-1']);
        // $photo2 = strip_tags($_POST['photo-2']);
        // $altPhoto2 = strip_tags($_POST['alt-photo-2']);
        $ville = strip_tags($_POST['ville']);
        $statut = strip_tags($_POST['statut']);



        $sql = ' UPDATE client SET  genre = :genre, nom = :nom, prenom = :prenom,  pseudo = :pseudo, email = :email, adresse = :adresse , ville = :ville, statut = :statut WHERE id_client = :id';
        $query = $pdoManga->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':genre', $genre, PDO::PARAM_STR);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        // $query->bindValue(':alt-photo-1', $altPhoto1, PDO::PARAM_STR);
        // $query->bindValue(':photo-2', $photo2, PDO::PARAM_STR);
        // $query->bindValue(':alt-photo-2', $altPhoto2, PDO::PARAM_STR);
        $query->bindValue(':ville', $ville, PDO::PARAM_STR);
        $query->bindValue(':statut', $statut, PDO::PARAM_STR);

        $query->execute();


        $_SESSION['message'] = "Produit modifié ";
        header('Location: index-client.php');
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
                        <select id="genre" name="genre" class="form-control" value="<?php echo $client['genre'] ?>">
                            <option value="">Veuillez choisir le genre du produit</option>
                            <option value="f" <?php if ($client['genre'] === 'f') echo 'selected'; ?>>Femme</option>
                            <option value="m" <?php if ($client['genre'] === 'm') echo 'selected'; ?>>Homme</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $client['nom'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo $client['prenom'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="pseudo">pseudo</label>
                        <input type="text" id="pseudo" name="pseudo" class="form-control" value="<?php echo $client['pseudo'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">E mail</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $client['email'] ?>">

                    </div>
                    <div class="form-group">
                        <label for="adresse">adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control" value="<?php echo $client['adresse'] ?>">
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
                        <label for="ville">ville</label>
                        <input type="text" id="ville" name="ville" class="form-control" value="<?php echo $client['ville'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="statut">Genre</label>
                        <select id="statut" name="statut" class="form-control" value="<?php echo $client['statut'] ?>">
                            <option value="">Veuillez choisir le genre du produit</option>
                            <option value="0" <?php if ($client['statut'] =='0') echo 'selected'; ?>>client</option>
                            <option value="1" <?php if ($client['statut'] === '1') echo 'selected'; ?>>admin</option>
                        </select>
                    </div>

                    <input type="hidden" value="<?php echo $client['id_client'] ?>" name="id_client">



                    <button class="btn btn-primary">Envoyer</button>
                </form>
                    <a href="index-client.php" class="btn btn-primary">retour</a>


            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>