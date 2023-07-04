<?php
// Connexion à la BDD
require_once 'inc/init.inc.php';

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
  session_destroy();

  $contenu .= '<div class="alert alert-success">Vous avez bien été déconnecté<a href="connexion.php">Se reconnecter</a></div>';
  header("Location: ".$_SERVER['PHP_SELF']);
exit();
}



$requeteManga = $pdoManga->query("SELECT * FROM produit WHERE genre ='livre' ORDER BY id_produit DESC LIMIT 0, 6");


$requeteActu = $pdoManga->query('SELECT * FROM blog ORDER BY id_article DESC LIMIT 0,3');





?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tengoku - Home
  </title>
  <!-- Link boostrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <!-- Link CSS -->
  <link rel="stylesheet" href="asset/Css/style.css">


</head>

<body class="h-100">

  <?php
  require_once 'inc/nav.php'
  ?>
  <?php echo $contenu; ?>

  <main class="w-75 mx-auto p-3 ">

    <!-- CAROUSEL -->
    <div id="carouselExampleIndicators" data-ride="carousel" class="carousel slide col-8 mx-auto py-3 ">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="asset/img/histoire_du_manga.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item ">
          <img src="asset/img/manga.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="asset/img/Type-de-manga_1024x.webp" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon " aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>



    <div>
      <div class="d-flex">
        <h3>Actu</h3>
        <a href="actu.php" class="align-items-center ms-3 btn btn-outline-info">voir tout</a>
      </div>

      <?php while ($article = $requeteActu->fetch(PDO::FETCH_ASSOC)) { ?>

        <div class="card my-3 m-auto" style="max-width: 90%;">
          <div class="row g-0">
            <div class="col-md-4">
              <a href="articleActu.php?id_article=<?php echo $article['id_article'] ?>"><img src="<?php echo $article['photo_1'] ?>" class="img-fluid rounded-start" alt="..."></a>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <a href="articleActu.php?id_article=<?php echo $article['id_article'] ?>">
                  <h5 class="card-title"><?php echo $article['titre'] ?>'</h5>
                </a>
                <p class="card-text"><?php echo html_entity_decode(substr($article['contenu'], 0, 150)) ?> ...</p>
                <a href="articleActu.php?id_article=<?php echo $article['id_article'] ?>" class="btn btn-outline-info">Lire l'article </a>
              </div>
            </div>
          </div>
        </div>
      <?php }
      ?>

    </div>
    <div class="row mt-3">
      <div class="d-flex ">
        <h3>Manga</h3>
        <a href="mangas.php" class="btn btn-outline-info ms-3">voir tout</a>
      </div>


      <?php while ($article = $requeteManga->fetch(PDO::FETCH_ASSOC)) { ?>


        <div class="col-sm-6 col-md-4 m-auto ">
          <div class="card p-1 my-3" style="max-height: 100%; overflow: hidden;">
            <img src="<?= $article['photo_1'] ?>" class="card-img-top w-75 m-auto" alt="...">
            <div class="card-body">
              <h4 class="card-title"><a href="articleProduit.php?id_produit=<?= $article['id_produit'] ?>"><?= $article['titre'] ?></a></h4>


              <p class="card-text"><?= html_entity_decode(substr($article['description'], 0, 100)) ?> ...</p>

              <form action="panier.php" method="POST">
                  <input type="hidden" name="quantité" value="1">
                  <input type="hidden" name="id_produit" value="<?= $article['id_produit'] ?>">
                  <input type="hidden" name="titre" value="<?= $article['titre'] ?>">
                  <input type="hidden" name="prix" value="<?= $article['prix'] ?>">
                  <button type="submit" name="add-to-cart" onclick="increaseQuantity()" class="btn btn-outline-info">Ajouter au panier</button>
                </form>



            </div>
          </div>
        </div>
      <?php   } ?>
    </div>





  </main>
  
  <!-- FOOTER -->

  <?php require_once 'inc/footer.php' ?>

  <script src="asset/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>


</body>

<script>
  // Code d'initialisation du carrousel
  var myCarousel = document.querySelector('#carouselExampleIndicators');
  var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 2000, // Spécifiez l'intervalle de temps entre chaque diapositive
    wrap: true // Définit si le carrousel boucle en continu ou s'arrête à la dernière diapositive
  });
</script>

</html>