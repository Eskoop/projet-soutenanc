<?php
// Connexion à la BDD
require_once 'inc/init.inc.php';

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
  session_destroy();
  $contenu .= '<div class="alert alert-success">Vous avez bien été déconnecté<a href="connexion.php">Se reconnecter</a></div>';

}




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

  <main>
    <div id="carouselExampleIndicators" data-ride="carousel" class="carousel slide col-8 mx-auto my-3 ">
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



  </main>
  <footer>

  </footer>
  
  <script src="Css/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



</body>

<!-- <script>
  // Code d'initialisation du carrousel
  var myCarousel = document.querySelector('#carouselExampleIndicators');
  var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 2000,  // Spécifiez l'intervalle de temps entre chaque diapositive
    wrap: true       // Définit si le carrousel boucle en continu ou s'arrête à la dernière diapositive
  });
</script> -->

</html>