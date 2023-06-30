<?php
require_once 'init.inc.php';

function debug($mavar){
    //Declaration de fonction
    echo '<pre class = "alert alert-warning">'; 
    var_dump($mavar);
    echo '</pre>';
}

function estConnecte(){
    if(isset($_SESSION['client'])){
        // si je récupère un indice 'users' dans la superGlobale $_SESSION, cela signifie qu'un utilisateur est connecté
        return true;
    }else{// sinon personne n'est connecté
        return false;
    }
}

function estAdmin(){
    if(estConnecte() && $_SESSION['client']['statut'] == 1){
        // je vérifie que l'utilisateur est connecté et que son statut correspond à 1 dans la BDD
        return true;
    }else{
        return false; // sinon, c'est un utilisateur lambda ou la personne n'est pas connecté.
    }
}

if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = array();
}
?>