<?php
class Statut{
    private $connexion;
    private $libelle;

    public function __construct($connexion,$libelle){
        $this->connexion=$connexion;
        $this->libelle=$libelle;
    }
    public function getLibelle(){
        return $this->libelle;
    }
    public function setLibelle(){
        $this->libelle=$libelle;
   }

    public function CocherStatut(){
       try{
        //selectionne toutes les priorités
        $sql="SELECT * FROM statut";
        //prepare la requete
        $stmt=$this->connexion->prepare($sql);
        //execute la requete
        $stmt->execute();
        //recupere toutes les lignes de la table
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
       }catch(PDOException $e) {
        
        die("Erreur : Impossible d'insérer une classe. " . $e->getMessage());
    }
    }
    
}
