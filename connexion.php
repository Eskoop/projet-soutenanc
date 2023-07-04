<?php
require_once 'inc/init.inc.php';

//2- traitement du formulaire 
if (!empty($_POST)) {
    if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {
        //On verifie que pseudo et mdp sont vide// s'ils sont vides, donc on met un message d'erreur grâce à la variable $contenu
        $contenu .= '<div class="alert alert-warning">Le pseudo et le mot de passe sont requis</div>';
    }
    if (empty($contenu)) { // Si la variable $contenu est vide c'est que je n'ai pas d'erreur, je peux donc lancer la connexion 
        $resultat = $pdoManga->prepare("SELECT * FROM client WHERE pseudo = :pseudo"); //je sélectionne toutes les infos de l'utilisateur dont le pseudo correspond à celui du formulaire

        $resultat->execute(array(
            ':pseudo' => $_POST['pseudo'],
        ));

        if ($resultat->rowCount() == 1) { // si le programme renvoie une ligne c'est que le memre (le pseudo) existe
            $membre = $resultat->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST['mdp'], $membre['mdp'])) {
                /* password_verify prend deux arguments : 
                1- le mot de passe du formulaire saisie
                2- le mot de passe de la BDD
                password_verify permet de vérifier que le premier correspond au deuxième$s
            */
                $_SESSION['client'] = $membre; // on crée une session avec les infos de l'utilisateur dans un tableau multidimentionnel.


                header('location:Home.php');
                exit();
            } else { //Si le mot de passe n'est pas bon

                $contenu .= '<div class="alert alert-warning">Vous n\'avez pas le bon mot de passe !</div>';
            }
        } else { //si le pseudo n'est pas bon
            $contenu .= '<div class="alert alert-warning">Ce pseudo n\'existe pas !</div>';
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



    <title>Tengoku - Connexion</title>
</head>

<body class="h-100">

    <?php require_once 'inc/nav.php'; 
    ?>
    

    <main class="container p-5">
        <h2>Connexion</h2>
        <section class="row p-5">
        
            <div class="col-12 col-md-7 mx-auto">
                <?php echo $contenu; ?>

                <form action="#" method="POST" class="alert alert-info">

                    <div class="mb-3">
                        <label for="pseudo">Pseudonyme</label>
                        <input type="text" name="pseudo" id="pseudo" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" name="mdp" id="mdp" class="form-control">
                    </div>

                    <input type="submit" value="Se connecter" class="btn btn-outline-light">

                </form>
            </div>
        </section>
    </main>
    <!-- FOOTER -->

    <?php require_once 'inc/footer.php' ?>

    <script src="asset/js/script.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>