<?php
// Connexion à la BDD
require_once 'inc/init.inc.php';

$requete = $pdoManga->query("SELECT * FROM produit WHERE genre = 'livre'");


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tengoku - Manga</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/style.css">

</head>

<body>
  <?php require_once 'inc/nav.php' ?>

  <main>
    <div class="pt-3 w-75 m-auto">
      <h2>Manga</h2>

      <section class="row">
        <?php while ($article = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
          <div class="col-4">
            <div class="card py-1 mt-3">
              <img src="<?php echo $article['photo_1'] ?>" class="card-img-top w-50 m-auto" alt="...">
              <div class="card-body">
                <h4 class="card-title"><a href="articleProduit.php?id_produit=<?php echo $article['id_produit'] ?>"><?php echo $article['titre'] ?></a></h4>
                <p class="card-text"><?php echo html_entity_decode(substr($article['description'], 0, 100)) ?></p>

                <form action="panier.php" method="POST">
                  <input type="hidden" name="quantité" value="1">
                  <input type="hidden" name="id_produit" value="<?= $article['id_produit'] ?>">
                  <input type="hidden" name="titre" value="<?= $article['titre'] ?>">
                  <input type="hidden" name="prix" value="<?= $article['prix'] ?>">
                  <button type="submit" name="add-to-cart" onclick="increaseQuantity()" class="btn btn-success">Ajouter au panier</button>
                </form>
              </div>
            </div>
          </div>
        <?php } ?>
      </section>
    </div>
  </main>
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
  <script src="Css/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>