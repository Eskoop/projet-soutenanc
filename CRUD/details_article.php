<?php 

require_once '../inc/init.inc.php';

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM blog WHERE id_article = :id';

    $query = $pdoManga->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query -> execute();

    $article = $query->fetch();

    if(!$article){
        $_SESSION['erreur'] = "Cet id n'existe pas ";
        header('Location: index-article.php');
    }
  

}else{

    $_SESSION['erreur'] = "URL invalise";   
    header('Location: index-article.php');

    
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
                <h1>Titre de l'article <?php echo $article['titre'] ?></h1>
                <p>Contenu : <?php echo $article['contenu'] ?></p>
                <p>Photo : <?php echo $article['photo_1'] ?></p>              
              
                <p><a href="index-article.php">Retour</a> <a href="modif-produit.php?id=<?php echo $article['id_article'] ?>">Modifier</a></p>


            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>