<?php 

require_once '../inc/init.inc.php';
// session_start();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM produit WHERE id_produit = :id';

    $query = $pdoManga->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query -> execute();

    $produit = $query->fetch();

    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas ";
        header('Location: index_produit.php');
        die();
    }

    $sql = 'DELETE FROM produit WHERE id_produit = :id';

    $query = $pdoManga->prepare($sql);
    
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query -> execute();
    $_SESSION['erreur'] = "produit supprimer";
        header('Location: index-produit.php');

}else{

    $_SESSION['erreur'] = "URL invalise";   
    header('Location: index-produit.php');

    
}
?>