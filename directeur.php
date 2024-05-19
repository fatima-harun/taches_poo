<?php
require_once "connexion.php";
interface Directeur{
    public function addTache($nom,$date,$description,$priorite,$statut);
    public function readTache();
    public function updateTache($id_tache,$nom,$date,$description,$priorite,$statut);
    public function deleteTache($id_tache);
}