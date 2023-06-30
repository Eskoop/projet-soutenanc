<?php 

require_once '../inc/init.inc.php';
// session_start();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM produit WHERE id_produit = :id';

    $query = $pdoManga->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query -> execute();

    $produit = $query->fetch();

    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas ";
        header('Location: index-produit.php');
    }
  

}else{

    $_SESSION['erreur'] = "URL invalise";   
    header('Location: index-produit.php');

    
}
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Details du produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails du produit <?php echo $produit['titre'] ?></h1>
                <p>ID : <?php echo $produit['id_produit'] ?></p>
                <p>Genre : <?php echo $produit['genre'] ?></p>              
                <p>Produit : <?php echo $produit['titre'] ?></p>
                <p>Prix : <?php echo $produit['prix'] ?></p>
                <p>Photo 1 : <?php echo $produit['photo_1'] ?></p>
                <p>Alt photo 1 : <?php echo $produit['alt_photo_1'] ?></p>
                <p>Photo 2 : <?php echo $produit['photo_2'] ?></p>
                <p>Alt photo 2 : <?php echo $produit['alt_photo_2'] ?></p>
                <p>Photo 3 : <?php echo $produit['photo_3'] ?></p>
                <p>Alt photo 3 : <?php echo $produit['alt_photo_3'] ?></p>
                <p>Photo 4 : <?php echo $produit['photo_4'] ?></p>
                <p>Alt photo 4 : <?php echo $produit['alt_photo_4'] ?></p>       
                <p>Nombre : <?php echo $produit['stock'] ?></p>
                <p><a href="index-produit.php">Retour</a> <a href="modif-produit.php?id=<?php echo $produit['id_produit'] ?>">Modifier</a></p>


            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>