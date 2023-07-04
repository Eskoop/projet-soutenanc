<?php
//1- Connection au BDD

require_once 'inc/init.inc.php';

if (isset($_GET['id_produit'])) {
    $article = $pdoManga->prepare('SELECT * FROM produit WHERE id_produit = :id_produit');
    $article->execute(array(
        ':id_produit' => $_GET['id_produit'],
    ));
    //Si la personne arrive sur la page avec un id_article dans l'url  qui n'existe pas // redirection
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


if (isset($_GET['id_produit'])) {

    // Requête pour récupérer le nom de la catégorie dans la table "categorie"
    $categorie = $pdoManga->prepare('SELECT categorie.type
                                    FROM produit
                                    JOIN categorie ON produit.id_categorie = categorie.id_categorie
                                    WHERE produit.id_produit = :id_produit');
    $categorie->execute(array(':id_produit' => $_GET['id_produit']));
    $resultatCategorie = $categorie->fetch(PDO::FETCH_ASSOC);


}


$produits_in_panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : array();
$subtotal = 0.00;
if ($produits_in_panier) {
    /* Il y a des produits dans le panier, nous devons donc sélectionner ces produits dans la base de données.*/
    /* Mettre les produits du panier dans un tableau de chaîne de caractères avec point d'interrogation, nous avons besoin que l'instruction SQL inclue  ( ?,?, ?,...etc).*/
    $array_to_question_marks = implode(',', array_fill(0, count($produits_in_panier), '?'));
    $stmt = $pdoManga->prepare('SELECT * FROM produit WHERE id_produit IN (' . $array_to_question_marks . ')');
    /* Nous avons uniquement besoin des clés du tableau, pas des valeurs, les clés sont les identifiants des produits. */
    $stmt->execute(array_keys($produits_in_panier));
    /* Récupérer les produits de la base de données et retourner le résultat sous la forme d'un tableau.*/
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculez le total partiel   
    foreach ($produits as $produit) {
        $subtotal += (float)$produit['prix'] * (int)$produits_in_panier[$produit['id_produit']];
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tengoku - <?php echo $ficheArticle['titre']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/Css/style.css">
    <style>
           body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body class="">
    <?php require_once 'inc/nav.php' ?>

    <main class="h-100">
        <h3 class="ps-2"><?php echo $ficheArticle['titre']; ?></h3>
        <div class="d-flex flex-column flex-md-row">
            <div class="d-flex   col-md-5 p-0 ">
                <figure class="d-flex flex-column w-25 p-0">
                    <img src="<?php echo $ficheArticle['photo_1']; ?>" alt="<?php echo $ficheArticle['alt_photo_1']; ?>" class="w-75  miniImage">
                    <img src="<?php echo $ficheArticle['photo_2']; ?>" alt="<?php echo $ficheArticle['alt_photo_2']; ?>" class="w-25 miniImage my-2">
                    <img src="<?php echo $ficheArticle['photo_3']; ?>" alt="<?php echo $ficheArticle['alt_photo_3']; ?>" class="w-25 miniImage">
                    <img src="<?php echo $ficheArticle['photo_4']; ?>" alt="<?php echo $ficheArticle['alt_photo_4']; ?>" class="w-25 miniImage">
                </figure>

                <figure class="grandImage m-auto">

                </figure>
            </div>
            <div class="col-md-5 mx-2">
                <h5>Résumé</h5>
                <p><?php echo $ficheArticle['description'] ?></p>

                <p><a href="#ancre-1">Voir les caractéristique</a></p>

            </div>
            <div class="col-md-2 flex-column ">
                <h5 class="m-auto">Prix</h5>
                <p><?php echo $ficheArticle['prix'] . ' €' ?></p>
                <form action="panier.php?page=panier" method="post">
                <input type="hidden" name="quantité" value="1">
                  <input type="hidden" name="id_produit" value="<?= $ficheArticle['id_produit'] ?>">
                  <input type="hidden" name="titre" value="<?= $ficheArticle['titre'] ?>">
                  <input type="hidden" name="prix" value="<?= $ficheArticle['prix'] ?>">
                  <input type="number" name="quantité-<?= $ficheArticle['id_produit'] ?>" value="<?= $produits_in_panier[$produit['id_produit']] ?>" min="1" max="<?= $ficheArticle['stock'] ?>" class="form-control w-50 ms-5    " placeholder="Quantité" required>
                  <button type="submit" name="add-to-cart" onclick="increaseQuantity()" class="btn btn-outline-info">Ajouter au panier</button>
                </form>
            </div>
        </div>
        <div>
            <h3 id="ancre-1">Caractéristique</h3>
            <div>
                <p>Titre:<?php echo $ficheArticle['titre'] ?></p>
                <p>Auteur : <?php echo $ficheArticle['auteur'] ?></p>
                <p>Collection : <?php echo $resultatCategorie['type'] ?></p>
                
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <?php require_once 'inc/footer.php' ?>

    <script src="asset/js/article.script.js"></script>
    <script src="asset/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>


</html>