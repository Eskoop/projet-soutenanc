<?php

require_once 'inc/init.inc.php';


if (!empty($_POST)) {
    $update = $pdoManga->prepare("UPDATE client SET nom=:nom, prenom=:prenom, adresse=:adresse, ville=:ville, code_postal=:code_postal, pays=:pays, tel=:tel, genre=:genre WHERE id_client=:id_client");
    $update->execute(array(
        ':id_client' => $_SESSION['client']['id_client'],
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        // ':mdp' => $_POST['mdp'],
        ':adresse' => $_POST['adresse'],
        ':ville' => $_POST['ville'],
        ':code_postal' => $_POST['code_postal'],
        ':pays' => $_POST['pays'],
        ':tel' => $_POST['tel'],
        ':genre' => $_POST['genre'],

    ));
}






?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tengoku - Profil de <?php echo $_SESSION['client']['prenom'] . ' ' . $_SESSION['client']['nom']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Link CSS -->
    <link rel="stylesheet" href="asset/Css/style.css">
    <style>
        .hide {
            display: none;
        }
    </style>

</head>

<body>
    <header>
        <?php require_once 'inc/nav.php' ?>
    </header>


    <main>

        <div class="card-header w-75 m-auto" >
            <h5 class="card-title">
                <?php

                // if($_SESSION['client']['genre'] === 'f'){ 
                //     echo 'Madame'; 
                // }else{echo'Monsieur';
                // }   
                echo '<h3 class="fw-bold">Bienvenue sur votre profil ' . $_SESSION['client']['pseudo'] . '</h3>';
                ?>

            </h5>
            <div>
                <p> Prenom : <?php echo $_SESSION['client']['prenom'] ?></p>
                <p> Nom : <?php echo $_SESSION['client']['nom'] ?></p>
                <p> E-mail : <?php echo $_SESSION['client']['email'] ?></p>
                <p> Adresse : <?php echo $_SESSION['client']['adresse'] ?></p>
                <p> Ville : <?php echo $_SESSION['client']['ville'] ?></p>
                <p> Code Postal : <?php echo $_SESSION['client']['code_postal'] ?></p>
                <p> Pays : <?php echo $_SESSION['client']['pays'] ?></p>

            </div>


            <div class="card-footer text-muted pb-3">
                <button type="buton" class="btn btn-outline-info modif-bouton">Modifier</button>
                <a href="Home.php?action=deconnexion" class="btn btn-dark">Me déconnecter</a>
            </div>

        </div>

        <form action="#" method="POST" class="modif-profil hide">
            <div class="mb-3">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $_SESSION['client']['nom'] ?>">
            </div>
            <div class="mb-3">
                <label for="prenom">Prenom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $_SESSION['client']['prenom'] ?>">
            </div>

            <div class="mb-3">
                <label for="pseudo">Pseudonyme</label>
                <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?php echo $_SESSION['client']['pseudo'] ?>">
            </div>

            <!-- <div class="mb-3">
                <label for="mdp">Mot de passe</label>
                <input type="text" name="mdp" id="mdp" class="form-control" value="<?php echo $_SESSION['client']['mdp'] ?>">
            </div> -->

            <div class="mb-3">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="form-control" value="<?php echo $_SESSION['client']['adresse'] ?>">
            </div>

            <div class="mb-3">
                <label for="ville">Ville</label>
                <input type="text" name="ville" id="ville" class="form-control" value="<?php echo $_SESSION['client']['ville'] ?>">
            </div>

            <div class="mb-3">
                <label for="code_postal">Code Potal</label>
                <input type="text" name="code_postal" id="code_postal" class="form-control" value="<?php echo $_SESSION['client']['code_postal'] ?>">
            </div>

            <div class="mb-3">
                <label for="pays">Pays</label>
                <input type="countryfield" name="pays" id="pays" class="form-control" value="<?php echo $_SESSION['client']['pays'] ?>">
            </div>

            <div class="mb-3">
                <label for="tel">Telephone</label>
                <input type="text" name="tel" id="tel" class="form-control" value="<?php echo $_SESSION['client']['tel'] ?>">
            </div>

            <div class="mb-3">
                <label for="genre">Genre</label>
                <select name="genre" id="genre" class="form-control">
                    <option value="f" <?php if ($_SESSION['client']['genre'] === 'f') echo 'selected'; ?>>Femme</option>
                    <option value="m" <?php if ($_SESSION['client']['genre'] === 'm') echo 'selected'; ?>>Homme</option>
                </select>
            </div>
            <input type="submit" value="Modification du profil" class="btn btn-outline-primary">

        </form>
    </main>

    <!-- FOOTER -->

    <?php require_once 'inc/footer.php' ?>

    <script>
        let btn = document.querySelector('.modif-bouton');
        let rect = document.querySelector('.modif-profil');

        function AfficherCacher(paramEvent, paramAction, nomClasse) {
            paramEvent.addEventListener('click', function() {
                paramAction.classList.toggle(nomClasse);
            });

        }
        AfficherCacher(btn, rect, 'hide');
    </script>
    <script src="asset/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>