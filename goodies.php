<?php

require_once 'inc/init.inc.php';

$requete = $pdoManga->query("SELECT * FROM produit WHERE genre = 'goodies'");


// SELECT produit.* FROM produit JOIN categorie ON produit.id_categorie = categorie.id_categorie WHERE categorie.nom = 'goodies'



?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TENGOKU</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="asset/Css/style.css">
</head>

<body>

  <?php require_once 'inc/nav.php' ?>

  <main>
    <div class="pt-3 w-75 m-auto">
      <h2>Goodies</h2>
      <?php if (estConnecte() && estAdmin()) { ?>
        <p><a href="CRUD/ajout-produit.php?id=<?php echo $produit['id_produit'] ?>" class="btn btn-outline-success">Ajouter un produit</a></p>
      <?php } ?>
      <section class="row">

        <?php
        while ($article = $requete->fetch(PDO::FETCH_ASSOC)) {


          echo '<div class="col-sm-6 col-md-4">
    <div class="card py-1 mt-3">
      <img src="' . $article['photo_1'] . '" class="card-img-top w-50 m-auto" alt="...">
      <div class="card-body">
      <h4 class="card-title"><a href="articleProduit.php?id_produit=' . $article['id_produit'] . '">' . $article['titre'] . '</a></h4>


        <p class="card-text">' . html_entity_decode(substr($article['description'], 0, 100)) . '</p>';

          if (estConnecte() && estAdmin()) {
            echo '<p> 
                    <a href="crud/suppr-produit.php?action=suppression&id=' . $article['id_produit'] . '" class="btn btn-outline-danger" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cet article?\'))">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                    </a>
                    <a href="crud/modif-produit.php?id=' . $article['id_produit'] . '" class="btn btn-outline-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg></a>
                    
                    
                <p>';
          }


          echo '<form action="panier.php" method="POST">
                  <input type="hidden" name="quantité" value="1">
                  <input type="hidden" name="id_produit" value="' . $article['id_produit'] . '">
                  <input type="hidden" name="titre" value="' . $article['titre'] . '">
                  <input type="hidden" name="prix" value="' . $article['prix'] . '">
                  <button type="submit" name="add-to-cart" onclick="increaseQuantity()" class="btn btn-outline-info">Ajouter au panier</button>
                </form>



      </div>
    </div>
  </div>';
        }


        ?>
      </section>


      <!-- <div class="card mt-4" style="width: 18rem;" >
    <img class="card-img-top" src="<?php $article['photo_1'] ?>" alt="<?php $article['alt_photo_1'] ?>">
    <div class="card-body">
      <h5 class="card-title"><?php $article['titre'] ?></h5>
      <p class="card-text"><?php $article['description'] ?></p>
      <a href="#" class="btn btn-primary">Payer</a>
    </div>
  </div> -->

    </div>
  </main>
  <!-- FOOTER -->

  <?php require_once 'inc/footer.php' ?>

  
  <script>
    function increaseQuantity() {
      var input = document.querySelector('input[name="quantité"]');
      var currentValue = parseInt(input.value);
      var maxValue = parseInt(input.max);

      if (currentValue < maxValue) {
        input.value = currentValue + 1;
      }
    }
  </script>
  <script src="asset/js/script.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>

</html>