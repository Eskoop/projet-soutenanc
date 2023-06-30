<?php 
require_once '../inc/init.inc.php';

if(!estAdmin()){
    header('Location:../Home.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body class="row affix-row">
    <?php require_once 'nav/nav-crud.php'; ?>
    <main class="col-sm-9 col-md-10 affix-content">
        <div class="container">
            <h1>Tengoku-Admin</h1>
            <section>
                <h2>Produit</h2>
            <?php 
            // notre première requête
            $requete = $pdoManga->query("SELECT * FROM produit ORDER BY id_produit DESC LIMIT 0,5");
            // pour cette requête je vais chercher ma variable de connexion et grâce à la flèche -> j'indique que je veux une requête dans cette BDD. J'écris ensuite simplement ma requête en SQL.
            ?>
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <!-- th*7 -->
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Genre</th>
                        <th>Service</th>
                        <!-- <th>Date d'embauche</th> -->
                        <th>Salaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($employes = $requete->fetch(PDO::FETCH_ASSOC)){
                        // debug($employes);
                        //FETCH_ASSOC est une méthode qui permet de récupérer les informations dans notre BDD en les liant par enregistrement
                        echo "<tr>";
                        echo "<td>". $employes['id_produit'] ."</td>"; // je récupère l'id qui correspond au premier enregistrement de ma requête
                        echo "<td>". $employes['titre'] ."</td>";
                        echo "<td>". $employes['auteur'] ."</td>";
                        
                        echo "<td>";
                                               
                        //on fait une condition en PHP 
                        /* si le sexe est f dans la bdd alors je dis d'afficher femme sinon c'est forcément h et je demande d'afficher homme */
                        if($employes['genre'] == 'livre'){
                            echo "Livre";
                        }else {
                            echo "Goodies";
                        }
                                            
                        echo "</td>";
                        
                        echo "<td>". $employes['description'] ."</td>";
                        // echo "<td>". date('d/m/y', strtotime($employes['date_embauche'])) ."</td>";
                        // ici on utilise une fonction prédéfinie date(). Cette fonction PHP prend deux arguments : le format de la date, deuxième argument la date que l'on veut modifier. On peut préciser une date nous-même ou alors récupérer une date depuis la BDD. 
                        echo "<td>". $employes['stock'] ." €</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            </section>
            <section>

            </section>

        </div>
    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</html>