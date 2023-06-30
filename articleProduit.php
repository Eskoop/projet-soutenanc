<?php
//1- Connection au BDD

require_once 'inc/init.inc.php';

if (isset($_GET['id_produit'])) {
    $article = $pdoManga->prepare('SELECT * FROM produit WHERE id_produit = :id_produit');
    $article->execute(array(
        ':id_produit' => $_GET['id_produit'],
    ));
    //3- Si la personne arrive sur la page avec un id_article dans l'url  qui n'existe pas // redirection vers la page articles.php 
    if ($article->rowCount() == 0) {
        header('location:Home.php');
        exit();
    }
    $ficheArticle = $article->fetch(PDO::FETCH_ASSOC);
} else {
    //si la personne arrive dans id_article dans l'url // rediretion vers la parge articles.php
    header('location:mangas.php');
    exit();
}
// ...

if (isset($_GET['id_produit'])) {
    // ...

    // Requête pour récupérer le nom de la catégorie dans la table "categorie"
    $categorie = $pdoManga->prepare('SELECT categorie.type
                                    FROM produit
                                    JOIN categorie ON produit.id_categorie = categorie.id_categorie
                                    WHERE produit.id_produit = :id_produit');
    $categorie->execute(array(':id_produit' => $_GET['id_produit']));
    $resultatCategorie = $categorie->fetch(PDO::FETCH_ASSOC);

    // Accès au type de catégorie récupéré
    // $typeCategorie = $resultatCategorie['type'];

    // ...
}


// Requete pour recuperer le nom de l'id_categorie dans la table categorie
// $categorie = $pdoManga->query("SELECT categorie.type
// FROM produit
// JOIN categorie ON produit.id_categorie = categorie.id_categorie
// WHERE produit.id_produit = 5");

// $result = $categorie ->fetch(PDO::FETCH_ASSOC)

// if (isset($_POST['ajouter_anier'])) {
//     if (isset($_SESSION['panier'])) {

//     } else {
//         $session_array = array(
//             "id_produit" => $_GET['id_produit'],
//             "titre" => $_POST['titre'],
//             "prix" => $_POST['prix'],
//             "quantity" => $_POST['quantity']
//         );
//         $_SESSION['panier'][] = $session_array;
//     }
// }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tengoku - <?php echo $ficheArticle['titre']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
</head>

<body>
        <?php require_once 'inc/nav.php' ?>
        <?php
        // echo '<pre>';
        //  var_dump($ficheArticle);
        // echo '</pre>'; ?>
    <main>
        <h3><?php echo $ficheArticle['titre']; ?></h3>
        <div class="d-flex ">
            <div class="d-flex col-5 p-0 ">
                <figure class="d-flex flex-column w-75">
                    <img src="<?php echo $ficheArticle['photo_1']; ?>" alt="<?php echo $ficheArticle['alt_photo_1']; ?>" class="w-25  miniImage">
                    <img src="<?php echo $ficheArticle['photo_2']; ?>" alt="<?php echo $ficheArticle['alt_photo_2']; ?>" class="w-25 miniImage my-2">
                    <img src="<?php echo $ficheArticle['photo_3']; ?>" alt="<?php echo $ficheArticle['alt_photo_3']; ?>" class="w-25 miniImage">
                    <img src="<?php echo $ficheArticle['photo_4']; ?>" alt="<?php echo $ficheArticle['alt_photo_4']; ?>" class="w-25 miniImage">
                </figure>

                <figure class="grandImage">

                </figure>
            </div>
            <div class="col-5 mx-2">
                <h5>Résumé</h5>
                <p><?php echo $ficheArticle['description'] ?></p>

                <p><a href="">Voir les caractéristique</a></p>

            </div>
            <div class="col-2 flex-column ">
                <p class="m-auto">Prix</p>
                <p><?php echo $ficheArticle['prix'] . ' €' ?></p>
                <form action="panier.php?page=panier" method="post">
	             <input type="number" name="quantité" value="1" min="1" max="<?=$ficheArticle['stock']?>" placeholder="Quantité" required>
	             <input type="hidden" name="produit_id" value="<?=$ficheArticle['id_produit']?>">            <input type="submit" value="Ajouter au panier">
	         </form>
            </div>
        </div>
        <div>
            <h3>Caractéristique</h3>
            <div>
                <p>Auteur : <?php echo $ficheArticle['auteur'] ?></p>
                <!-- <p> Editeur : <?php echo $ficheArticle['editeur'] ?></p> -->
                <!-- <p> Date de parution : <?php echo $ficheArticle['date_de_parution'] ?></p> -->
                <p>Collection : <?php echo $ficheArticle['genre'] ?></p>
            </div>
        </div>
    </main>

    <script src="Css/article.script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>


</html>