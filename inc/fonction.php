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

?>