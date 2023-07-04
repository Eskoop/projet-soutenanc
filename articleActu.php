<?php
require_once 'inc/init.inc.php';


if (isset($_GET['id_article'])) {
    $actu = $pdoManga->prepare('SELECT * FROM blog WHERE id_article = :id_article');
    $actu->execute(array(
        ':id_article' => $_GET['id_article'],
    ));
    //3- Si la personne arrive sur la page avec un id_article dans l'url  qui n'existe pas // redirection vers la page articles.php
    if ($actu->rowCount() == 0) {
        header('location:Home.php');
        exit();
    }
    $ficheActu = $actu->fetch(PDO::FETCH_ASSOC);
} else {
    //si la personne arrive dans id_article dans l'url // rediretion vers la parge articles.php
    header('location:actu.php');
    exit();
}


?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootswatch CSS v5.2.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.1/litera/bootstrap.min.css" integrity="sha512-VytuSEcywyOk3/TgzUvYclfS5MrwPLUhVZHMGpN4O81Cu/LguN+MxiFUZOkem4VkRVAPC8BVqaGziJ+xUz2BZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="asset/Css/style.css">


    <title>Tengoku - <?php echo $ficheActu['titre'];  ?></title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>

</head>

<body>




    <!-- HEADER -->
    <?php require_once "inc/nav.php" ?>


    <main class="container mw-100 mh-100">
        <section class="row my-5">
            <h3 class="pb-2"><?php echo $ficheActu['titre'] ?></h3>
            <div class="w-75">
                <img src="<?php echo $ficheActu['photo_1'] ?>" class="img-fluid">
            </div>
            <p class="pt-2"> <?php echo html_entity_decode($ficheActu['contenu']); ?></p>



        </section>
    </main>

    <!-- FOOTER -->

    <?php require_once 'inc/footer.php' ?>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="asset/js/script.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

</body>

</html>