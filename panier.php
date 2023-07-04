<?php
require_once 'inc/init.inc.php';
/* Si l'utilisateur a cliqué sur le bouton "Ajouter au panier" sur la page du produit, nous pouvons vérifier les données du formulaire.*/
if (isset($_POST['id_produit'], $_POST['stock']) && is_numeric($_POST['id_produit']) && is_numeric($_POST['stock'])) {
    /* Définissez les variables post afin que nous puissions les identifier facilement, assurez-vous également qu'elles sont entières.*/
    $produit_id = (int)$_POST['id_produit'];
    $quantité = (int)$_POST['stock'];
    /* Préparez l'instruction SQL, nous vérifions essentiellement si le produit existe dans notre base de données.*/
    $stmt = $pdoManga->prepare('SELECT * FROM produit WHERE id_produit = ?');
    $stmt->execute([$produit_id]);
    /* Récupère le produit depuis la base de données et renvoie le résultat sous forme de tableau.*/
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    // Vérifier si le produit existe (le tableau n'est pas vide)   
    if ($produit && $quantité > 0) {
        /*Le produit existe dans la base de données, maintenant nous pouvons créer/mettre à jour la variable de session pour le panier.*/
        if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
            if (array_key_exists($produit_id, $_SESSION['panier'])) {
                // Le produit existe dans le panier, il suffit de mettre à jour la quantité.   
                $_SESSION['panier'][$produit_id] += $quantité;
            } else {
                // Le produit n'est pas dans le panier, ajoutez-le   
                $_SESSION['panier'][$produit_id] = $quantité;
            }
        } else {
            /* Il n'y a aucun produit dans le panier, ceci ajoutera le premier produit au panier.*/
            $_SESSION['panier'] = array($produit_id => $quantité);
        }
    }
    // Empêcher la resoumission des formulaires...   
    header('Location: Home.php');
    exit;
}


/* Retirez le produit du panier, vérifiez le paramètre "remove" de l'URL, c'est l'identifiant du produit, assurez-vous qu'il s'agit d'un numéro et vérifiez s'il est dans le panier.*/
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['panier']) && isset($_SESSION['panier'][$_GET['remove']])) {
    // Remove the produit from the shopping panier   
    unset($_SESSION['panier'][$_GET['remove']]);
}


/* Mettre à jour les quantités de produits dans le panier si l'utilisateur clique sur le bouton "Mettre à jour" sur la page du panier d'achat*/
if (isset($_POST['update']) && isset($_SESSION['panier'])) {
    /* Boucle à travers les données postales afin de mettre à jour les quantités pour chaque produit du panier.*/
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantité-') !== false && is_numeric($v)) {
            $id = str_replace('quantité-', '', $k);
            $quantité = (int)$v;
            // Effectuez toujours des contrôles et des validations   
            if (is_numeric($id) && isset($_SESSION['panier'][$id]) && $quantité > 0) {
                // Mise à jour de la nouvelle quantité   
                $_SESSION['panier'][$id] = $quantité;
            }
        }
    }
    // Empêcher la re-soumission de formulaires...   
    header('Location: panier.php');
    exit;
}

/* Vérification de la variable de session pour les produits en panier*/
$produits_in_panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : array();
$produits = array();
$subtotal = 0.00;
// // S'il y a des produits dans le panier   
if ($produits_in_panier) {
    //     /* Il y a des produits dans le panier, nous devons donc sélectionner ces produits dans la base de données.*/
    //     /* Mettre les produits du panier dans un tableau de chaîne de caractères avec point d'interrogation, nous avons besoin que l'instruction SQL inclue  ( ?,?, ?,...etc).*/
    $array_to_question_marks = implode(',', array_fill(0, count($produits_in_panier), '?'));
    $stmt = $pdoManga->prepare('SELECT * FROM produit WHERE id_produit IN (' . $array_to_question_marks . ')');
    //     /* Nous avons uniquement besoin des clés du tableau, pas des valeurs, les clés sont les identifiants des produits. */
    $stmt->execute(array_keys($produits_in_panier));
    //     /* Récupérer les produits de la base de données et retourner le résultat sous la forme d'un tableau.*/
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculez le total partiel   
    foreach ($produits as $produit) {
        $subtotal += (float)$produit['prix'] * (int)$produits_in_panier[$produit['id_produit']];
    }
}


// Vérifier si le formulaire a été soumis
if (isset($_POST['add-to-cart'])) {
    // Vérifier les valeurs soumises
    if (isset($_POST['id_produit'], $_POST['quantité']) && is_numeric($_POST['id_produit']) && is_numeric($_POST['quantité'])) {
        // Convertir les valeurs en entiers
        $produit_id = (int)$_POST['id_produit'];
        $quantité = (int)$_POST['quantité'];

        // Récupérer les informations du produit depuis la base de données en fonction de l'ID du produit
        $stmt = $pdoManga->prepare('SELECT * FROM produit WHERE id_produit = ?');
        $stmt->execute([$produit_id]);
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le produit existe dans la base de données
        if ($produit) {
            // Ajouter le produit au panier en utilisant les valeurs récupérées
            if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
                if (array_key_exists($produit_id, $_SESSION['panier'])) {
                    // Le produit existe déjà dans le panier, mettre à jour la quantité
                    $_SESSION['panier'][$produit_id] += $quantité;
                } else {
                    // Le produit n'est pas dans le panier, l'ajouter
                    $_SESSION['panier'][$produit_id] = $quantité;
                }
            } else {
                // Aucun produit dans le panier, ajouter le premier produit
                $_SESSION['panier'] = array($produit_id => $quantité);
            }

            // Rediriger l'utilisateur vers la page du panier
            header('Location: panier.php');
            exit;
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/Css/style.css">
</head>
<?php require_once 'inc/nav.php'; ?>

<body>
    <main class="h-100">
        <div class="panier content-wrapper">
            <h1>Panier d'achat</h1>
            <form action="#" method="POST" class="m-auto">
                <table class="bg-light border m-auto mw-100 w-75">
                    <thead>
                        <tr class="border">
                            <td class="border fw-bold text-center">Produit</td>
                            <td class="border fw-bold text-center">Descriptif</td>
                            <td class="border fw-bold text-center">Prix</td>
                            <td class="border fw-bold text-center">Quantité</td>
                            <td class="border fw-bold text-center">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($produits)) : ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">Vous n'avez aucun produit ajouté dans votre panier</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($produits as $produit) : ?>
                                <tr>
                                    <td class="img col-4 border text-center">
                                        <a href="articleProduit.php?id_produit=<?= $produit['id_produit'] ?>">
                                            <img src="<?= $produit['photo_1'] ?>" width="120" height="120" alt="<?= $produit['titre'] ?>">
                                        </a>
                                        <a href="articleProduit.php?id_produit=<?= $produit['id_produit'] ?>"><?= $produit['titre'] ?></a>
                                    </td>
                                    <td class="col-3 text-center">
                                        <a href="panier.php?page=panier&remove=<?= $produit['id_produit'] ?>" class="remove">
                                            <i class="fas fa-trash">&nbsp;</i>Supprimer
                                        </a>
                                    </td>
                                    <td class="col-1 m-auto border text-center"><?= $produit['prix'] ?> €</td>
                                    <td class="quantité col-2 ">
                                        <input type="number" name="quantité-<?= $produit['id_produit'] ?>" value="<?= $produits_in_panier[$produit['id_produit']] ?>" min="1" max="<?= $produit['stock'] ?>" class="form-control w-50 ms-5    " placeholder="Quantité" required>
                                    </td>
                                    <td class="prix col-1 border text-center"><?= intval($produit['prix']) * intval($produits_in_panier[$produit['id_produit']]) ?> €</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <table class="bg-light border m-auto mw-100 w-75">
                    <thead>
                        <tr>
                            <td class="border fw-bold text-center">Prix total HT</td>
                            <td class="border fw-bold text-center">TVA</td>
                            <td class="border fw-bold text-center">Prix Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border text-center"><?= $subtotal/1.2 ?> €</td>
                            <td class="border text-center">20%</td>
                            <td class="border text-center"><?= $subtotal ?> €</td>
                        </tr>
                    </tbody>
                </table>
                <div class="buttons p-3">
                    <input type="submit" value="Mettre à jour" name="update" class="btn btn-outline-primary">
                    <input type="submit" value="Passer la commande" name="passerCommande" class="btn btn-outline-success">
                </div>
            </form>
        </div>
    </main>
</body>
<!-- FOOTER -->

<?php require_once 'inc/footer.php' ?>

<script src="asset/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</html>