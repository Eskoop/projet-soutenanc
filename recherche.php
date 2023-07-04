<?php
require_once 'inc/init.inc.php';

$recherche = $pdoManga ->query("SELECT * FROM produit ORDER BY id_produit DESC");
if(isset($_GET['recherche']) && !empty($_GET['recherche'])){
    $search = htmlspecialchars($_GET['recherche']);
    $recherche = $pdoManga->query("SELECT * FROM produit WHERE titre LIKE '%".$search."%' ORDER BY id_produit DESC ");

}
$rechercheA = $pdoManga ->query("SELECT * FROM blog ORDER BY id_article DESC");
if(isset($_GET['recherche']) && !empty($_GET['recherche'])){
    $search = htmlspecialchars($_GET['recherche']);
    $rechercheA = $pdoManga->query("SELECT * FROM blog WHERE titre LIKE '%".$search."%' ORDER BY id_article DESC ");

}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier un produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/Css/style.css">
</head>

<body>

    <?php require_once 'inc/nav.php' ?>
    <main>
        <!-- <?php var_dump($produit) ?> -->
        <h2>Manga/Goodies</h2>
        <section>
            <?php
            if(empty($_GET['recherche'])){
                echo '<p>La recherche est vide</p>';
            }else{
            if ($recherche->rowCount() > 0) {
                foreach ($recherche as $produit ) {
            ?>
                    <div>
                        <p><a href="articleProduit.php?id_produit=<?php echo $produit['id_produit'] ?>"><?php echo $produit['titre'] ?></a></p>

                    </div>

                <?php
                }
            } else { 
                ?>
                <p>Ce produit n'existe pas</p>
            <?php     
             }}
            ?>

        </section>
        <h2>Actu</h2>
        <section>
        <?php
            if(empty($_GET['recherche'])){
                echo '<p>La recherche est vide</p>';
            }else{
            if ($recherche->rowCount() > 0) {
                foreach ($rechercheA as $article ) {
            ?>
                    <div>
                        <p><a href="articleActu.php?id_article=<?php echo $article['id_article'] ?>"><?php echo $article['titre'] ?></a></p>

                    </div>

                <?php
                }
            } else { 
                ?>
                <p>Ce produit n'existe pas</p>
            <?php     
             }}
            ?>
        </section>
    </main>

    <!-- FOOTER -->

    <?php require_once 'inc/footer.php' ?>
    
    <script src="asset/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>

</html>