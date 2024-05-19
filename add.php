<?php
require_once "connexion.php";

if(isset($_POST['submit'])){
    $nom=$_POST['nom'];   //on recupere la valeur du name qu'on stocke dans une avariable pour tous
    $date=$_POST['date'];
    $description=$_POST['description'];
    $priorite=$_POST['id_priorite'];
    $statut=$_POST['id_statut'];
// on verifie si les champs ne sont pas vides avec empty
    if(!empty($nom) && !empty($date) && !empty($description) && !empty($priorite) && !empty($statut)){

        $tache->addTache($nom,$date,$description,$priorite,$statut);
    }
}
