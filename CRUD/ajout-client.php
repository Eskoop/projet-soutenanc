<?php
if ($_POST) {
    if (
        isset($_POST['genre']) && !empty($_POST['genre'])
        && isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['prenom']) && !empty($_POST['prenom'])
        && isset($_POST['pseudo']) && !empty($_POST['pseudo'])
        && isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['adresse']) && !empty($_POST['adresse'])
        && isset($_POST['ville']) && !empty($_POST['ville'])
        && isset($_POST['mdp']) && !empty($_POST['mdp'])
        && isset($_POST['code_postal']) && !empty($_POST['code_postal'])
        && isset($_POST['tel']) && !empty($_POST['tel'])
        && isset($_POST['pays']) && !empty($_POST['pays'])
        && isset($_POST['statut']) && !empty($_POST['statut'])
    ) {
        require_once '../inc/init.inc.php';
        $genre = strip_tags($_POST['genre']);
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $pseudo = strip_tags($_POST['pseudo']);
        $email = strip_tags($_POST['email']);
        $mdp = strip_tags($_POST['mdp']);
        $adresse = strip_tags($_POST['adresse']);
        $ville = strip_tags($_POST['ville']);
        $code_postal = strip_tags($_POST['code_postal']);
        $pays = strip_tags($_POST['pays']);
        $tel = strip_tags($_POST['tel']);
        $statut = strip_tags($_POST['statut']);

        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        $sql = 'INSERT INTO produit (genre, nom, prenom, pseudo, email, mdp, adresse, ville, code_postal, pays, tel, statut) VALUES (:genre, :nom, :prenom, :pseudo, :email, :mdp, :adresse, :ville, :code_postal, :pays, :tel, :statut)';
        $query = $pdoManga->prepare($sql);

        $query->bindValue(':genre', $genre, PDO::PARAM_STR);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindValue(':ville', $ville, PDO::PARAM_STR);
        $query->bindValue(':code_postal', $code_postal, PDO::PARAM_INT);
        $query->bindValue(':pays', $pays, PDO::PARAM_STR);
        $query->bindValue(':tel', $tel, PDO::PARAM_INT);
        $query->bindValue(':statut', $statut, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Produit ajouté";
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
                $_SESSION['erreur'] = " ";
            }
            ?>
            <section class="col-12">
                <h1>Ajouter un produit</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select id="genre" name="genre" class="form-control">
                            <option value="">Veuillez choisir le genre du produit</option>
                            <option value="f">Femme</option>
                            <option value="m">Homme</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prenom">prenom</label>
                        <input id="prenom" name="prenom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pseudo">pseudo</label>
                        <input type="text" id="pseudo" name="pseudo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" name="mdp" id="mdp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="adresse">adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Ville">Ville</label>
                        <input type="text" id="Ville" name="Ville" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="code_postal">code_postal</label>
                        <input type="number" id="code_postal" name="code_postal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="statut">statut</label>
                        <input type="number" id="statut" name="statut" class="form-control">
                    </div>




                    <button class="btn btn-primary">Envoyer</button>
                </form>


            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>