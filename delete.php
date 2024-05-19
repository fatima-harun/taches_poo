<?php

require_once "connexion.php";
require_once "taches.php";
// Vérification si l'ID de la tache à supprimer est passé dans la requête GET
if(isset($_GET['id_tache'])) {
    // Récupération de l'id  à supprimer
    $id_tache = $_GET['id_tache'];
    
    // Appel de la méthode deleteTache pour supprimer une tache
    $tache->deleteTache($id_tache);
    
    // Redirection vers la page read.php après la suppression réussie
    header("Location: read.php");
    exit(); // arrêter l'exécution du script après la redirection
} else {
    // Gérer le cas où l'id de la tache n'est pas disponible dans la requête GET
    echo "Impossible de récupérer l'id de la tache.";
}
?>