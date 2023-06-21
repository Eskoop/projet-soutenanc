<?php
// Connexion à la BDD
require_once 'inc/init.inc.php';

$requete = $pdoManga->query("SELECT produit.* FROM produit JOIN categorie ON produit.id_categorie = categorie.id_categorie WHERE categorie.nom = 'manga'");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tengoku - Manga</title>
  <!-- Lien bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Lien css -->
  <link rel="stylesheet" href="Css/style.css">
</head>

<body>
  <header>
    <?php
    require_once 'inc/nav.php'

    ?>
  </header>
  <main>
    <div class="container mt-3">
      <h2>Manga</h2>
      <?php
      while ($article = $requete->fetch(PDO::FETCH_ASSOC)) {

        echo '<div class="col-12 col-md-4">
    <div class="card p-1 my-3">
      <img src="' . $article['photo-1'] . '" class="card-img-top w-50 m-auto" alt="...">
      <div class="card-body">
      <h4 class="card-title"><a href="articleProduit.php?id_produit=' . $article['id_produit'] . '">' . $article['titre'] . '</a></h4>


        <p class="card-text">' . html_entity_decode(substr($article['description'], 0, 100)) . '</p>';

        // if (estConnecte() && estAdmin()) {
        // echo '<a href="supprimer-article.php?action=suppression&id_article=' . $article['id_produit'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cet article?\'))">Supprimer l\'article</a>';

        // }

        echo '
        <a href="article.php?id_produit=' . $article['id_produit'] . '" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-minecart" viewBox="0 0 16 16">
        <path d="M4 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm8-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM.115 3.18A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 14 12H2a.5.5 0 0 1-.491-.408l-1.5-8a.5.5 0 0 1 .106-.411zm.987.82 1.313 7h11.17l1.313-7H1.102z"/>
      </svg></i> Ajouter au panier</a>



      </div>
    </div>
  </div>';
      }


      ?>

      <!-- <div class="card mt-4" style="width: 18rem;" >
    <img class="card-img-top" src="<?php $article['photo-1'] ?>" alt="<?php $article['alt-photo-1'] ?>">
    <div class="card-body">
      <h5 class="card-title"><?php $article['titre'] ?></h5>
      <p class="card-text"><?php $article['description'] ?></p>
      <a href="#" class="btn btn-primary">Payer</a>
    </div>
  </div> -->

    </div>
  </main>
  <footer></footer>
  <script src="Css/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>






















































