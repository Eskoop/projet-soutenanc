<?php
// Connexion à la BDD
require_once 'inc/init.inc.php';

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
  session_destroy();
  $contenu .= '<div class="alert alert-success">Vous avez bien été déconnecté<a href="connexion.php">Se reconnecter</a></div>';
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
  <link rel="stylesheet" href="Css/style.css">


</head>

<body>

  <?php
  require_once 'inc/nav.php'
  ?>
  <?php echo $contenu; ?>

  <main class="w-75 mx-auto p-3">

    <!-- CAROUSEL -->
    <div id="carouselExampleIndicators" data-ride="carousel" class="carousel slide col-8 mx-auto py-3 ">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/sans_titre_6.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item ">
          <img src="img/Sans titre.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="img/Type-de-manga_1024x.webp" class="d-block w-100" alt="...">
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
        <a href="actu.php" class="align-items-center ms-3 btn btn-outline-primary">voir tout</a>
      </div>

      <?php while ($article = $requeteActu->fetch(PDO::FETCH_ASSOC)) {

        echo ' <div class="card my-3 m-auto" style="max-width: 90%;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <a href="articleActu.php?id_article=' . $article['id_article'] . '"><img src="' . $article['photo-1'] . '" class="img-fluid rounded-start" alt="..."></a>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <a href="articleActu.php?id_article=' . $article['id_article'] . '"><h5 class="card-title">' . $article['titre'] . '</h5></a>
                      <p class="card-text">' . html_entity_decode(substr($article['contenu'], 0, 50)) . ' ...</p>
                      <a href="articleActu.php?id_article=' . $article['id_article'] . '" class="btn btn-primary">Lire l\'article </a>
                    </div>
                  </div>
                </div>
              </div>';
      }
      ?>

    </div>
    <div class="row mt-3">
      <div class="d-flex">
        <h3>Manga</h3>
        <a href="mangas.php" class="btn btn-outline-primary ms-3">voir tout</a>
      </div>


      <?php
      while ($article = $requeteManga->fetch(PDO::FETCH_ASSOC)) {

        echo '
        <div class="col-4 ">
        <div class="card p-1 my-3">
          <img src="' . $article['photo_1'] . '" class="card-img-top w-50 m-auto" alt="...">
          <div class="card-body">
            <h4 class="card-title"><a href="articleProduit.php?id_produit=' . $article['id_produit'] . '">' . $article['titre'] . '</a></h4>


            <p class="card-text">' . html_entity_decode(substr($article['description'], 0, 100)) . ' ...</p>';

        // if (estConnecte() && estAdmin()) {
        // echo '<a href="supprimer-article.php?action=suppression&id_article=' . $article['id_produit'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cet article?\'))">Supprimer l\'article</a>';

        // }

        echo '
            <a href="article.php?id_produit=' . $article['id_produit'] . '" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-minecart" viewBox="0 0 16 16">
                <path d="M4 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm8-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM.115 3.18A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 14 12H2a.5.5 0 0 1-.491-.408l-1.5-8a.5.5 0 0 1 .106-.411zm.987.82 1.313 7h11.17l1.313-7H1.102z" />
              </svg></i> Ajouter au panier</a>



          </div>
        </div>
      </div>';
      }
      ?>
    </div>





  </main>
  <footer>

  </footer>

  <script src="Css/script.js"></script>
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