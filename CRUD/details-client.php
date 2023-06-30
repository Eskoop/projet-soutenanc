<?php

require_once '../inc/init.inc.php';
// session_start();

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM client WHERE id_client = :id';

    $query = $pdoManga->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $client = $query->fetch();

    if (!$client) {
        $_SESSION['erreur'] = "Cet id n'existe pas ";
        header('Location: index-produit.php');
    }
} else {

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
                <div class="d-flex justify-content-between">
                    <h1>Détails du client <?php echo $client['prenom'] . ' ' . $client['nom'] ?></h1>
                    <div>
                        <?php if ($client['statut'] === '0') {
                            echo '<p class="btn btn-success">Client</p>';
                        } else {
                            echo '<a class="btn btn-danger">Administrateur</a>';
                        } ?>
                    </div>

                </div>
                <p>ID : <?php echo $client['id_client'] ?></p>
                <p>Genre : <?php if ($client['genre'] === 'm') {
                                echo 'Homme';
                            } else {
                                echo 'Femme';
                            } ?></p>
                <p>Nom : <?php echo $client['nom'] ?></p>
                <p>Prenom : <?php echo $client['prenom'] ?></p>
                <p>E-mail : <?php echo $client['email'] ?></p>
                <p>Adresse : <?php echo $client['adresse'] ?></p>
                <p>Ville : <?php echo $client['ville'] ?></p>
                <p>Code Postal : <?php echo $client['code_postal'] ?></p>
                <p>Pays : <?php echo $client['pays'] ?></p>
                <p>Téléphone : <?php echo $client['tel'] ?></p>
                <p>statut : <?php if($client['statut']== 1){
                    echo $client['statut'] = 'Administrateur';
                }else{
                    echo $client['statut'] = 'Client';
                }  ?></p>
                <p><a href="index-client.php">Retour</a> <a href="modif-client.php?id=<?php echo $client['id_client'] ?>">Modifier</a></p>


            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>