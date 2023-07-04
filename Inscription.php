<?php
require_once 'inc/init.inc.php';


if (!empty($_POST)) {
    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
        $contenu .= '<div class=" alert alert-warning">Votre prénom doit faire entre 2 et 20 caractères.</div>';
    }
    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
        $contenu .= '<div class=" alert alert-warning">Votre nom doit faire entre 2 et 20 caractères.</div>';
    }
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $contenu .= '<div class=" alert alert-warning">Votre mail n\'est pas conforme.</div>';
        // Ici je vérifie que le mail n'est pas vide et je passe en revue le mail entré en disant de le vérifier frâce au filtre et au paramètre FILTER_VALIDATE_EMAIL. Le premier, filter_var est une fonction prédéfinie qui prendra en paramètre la chaine de caractère que l'on veut vérifier et en second paramètre la constante FILTER_VALIDATE_EMAIL qui vérifie, sur le même principe qu'un regex l'email entré par la personne.
    }
    if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) {
        $contenu .= '<div class=" alert alert-warning">Votre pseudo doit faire entre 4 et 20 caractères.</div>';
    }

    if (empty($contenu)) { // si la variable $contenu est vide, alors la personne a remplie correctement le formulaire, on peut entrer les infos maintenant en BDD.
        //Je veux que le pseudo soit unique dans la BDD.

        $membre = $pdoManga->prepare("SELECT * FROM client WHERE pseudo = :pseudo");
        $membre->execute(
            array(
                ':pseudo' => $_POST['pseudo'],

            )
        ); // Je demande à mon exécuteur de PHP de vérifier que le pseudo entré par l'utilisateur n'est pas déja existant dans la BDD
        if ($membre->rowCount() > 0) {
            //Je demande à exécuteur si la requête précedente renvoie des résultats.Si elle renvoie des résultats, sa signifie de l'utilisateur doit choisir un autre pseudo car cleui-ci existe déjà.
            $contenu .= '<div class=" alert alert-warning">Ce pseudo est indispensable, choississez-en un autre.</div>';
        } else { // sinon : le pseudo est disponible, on rentre les informations en BDD
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            //grâce à la focntion prédéfinie password_hash, je dis à mon code de hascher le mdp et lui précise ensuite selon quel le méthode ici grâce à la, constante PASSWORD_DEFAULT.Vous pouvez aussi définir vous même votre algorithme à la place d'utiliser la constante PASSWORD_DEFAULT

            $insertion = $pdoManga->prepare('INSERT INTO client(prenom, nom, genre, pseudo, email, mdp, statut) VALUES (:prenom, :nom, :genre, :pseudo, :email, :mdp, 0)');

            // Je prépare ma requete avec mes marqueurs vides qui vont correspondre a ce que mon utilisateur va mettre dans le formulaire.
            // Le Seul champ différent est le statut, qui va être automatiquement 0(utilisateur lambda)


            $insertion->execute(
                array(
                    ':prenom' => $_POST['prenom'],
                    ':nom' => $_POST['nom'],
                    ':genre' => $_POST['genre'],
                    ':pseudo' => $_POST['pseudo'],
                    ':email' => $_POST['email'],
                    ':mdp' => $mdp, // ici on récupère le mot de passe qu'on a hasherun peu plus haut dans le code
                )
            );
            if ($insertion) {
                $contenu .= '<div class=" alert alert-success">Vous êtes inscrit sur le site.
                    <a href="connexion.php">Cliquez ici pour vous connecter.</a>
            </div>';
            } else {
                $contenu .= '<div class=" alert alert-warning">Erreur lors de l\'inscription.</div>';
            }
        }
    }
}


?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.1/litera/bootstrap.min.css" integrity="sha512-VytuSEcywyOk3/TgzUvYclfS5MrwPLUhVZHMGpN4O81Cu/LguN+MxiFUZOkem4VkRVAPC8BVqaGziJ+xUz2BZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="asset/Css/style.css">


    <title>Tengoku - inscription</title>
</head>

<body>


    <header>
        <?php require_once 'inc/nav.php'; ?>
    </header>

    <!-- main.container>section.row>.col-12.col-md-7.mx-auto -->
    <main class="container">
        <section class="row">
            <div class="col-12 col-md-7 mx-auto">
                <?php echo $contenu; ?>
                <form action="#" method="POST">

                    <div class="mb-3">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="genre">Genre</label>
                        <select name="genre" id="genre" class="form-select">
                            <option value="f">Femme</option>
                            <option value="m">Homme</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pseudo">Pseudonyme</label>
                        <input type="text" name="pseudo" id="pseudo" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="email">Courriel</label>
                        <input type="text" name="email" id="email" class="form-control" required >
                    </div>

                    <div class="mb-3">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" name="mdp" id="mdp" class="form-control">
                    </div>

                    <div class="mb-3">
                        <input type="submit" name="submit" value="S'inscrire" class="btn btn-primary">
                    </div>
                </form>
                <div class="alert alert-secondary">
                    <p style="font-size: 1.2em;">Si vous êtes déjà inscrit.e, <a href="connexion.php">connectez-vous
                            !</a></p>
                </div>
            </div>
        </section>
    </main>


    <!-- FOOTER -->

    <?php require_once 'inc/footer.php' ?>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="asset/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>