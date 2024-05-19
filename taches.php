<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "connexion.php";
require_once "directeur.php";
class Taches implements Directeur{
    private $connexion;
    private $nom;
    private $date;
    private $description;
    private $priorite;
    private $statut;

    public function __construct($connexion,$nom,$date,$description,$priorite,$statut){
        $this->connexion=$connexion;
        $this->nom=$nom;
        $this->date=$date;
        $this->description=$description;
        $this->priorite=$priorite;
        $this->statut=$statut;
    }
    public function getNom(){
        return $this->nom;
    }
    public function setNom(){
        $this->nom=$nom;
    }
    public function getDate(){
        return $this->date;
    }
    public function setDate(){
        $this->date=$date;
    }
    public function geDescription(){
        return $this->description;
    }
    public function setDescription(){
        $this->description=$description;
    }
    public function getPriorite(){
        return $this->priorite;
    }
    public function setPriorite(){
        $this->priorite=$priorite;
    }
    public function getStatut(){
        return $this->statut;
    }
    public function setStatut(){
        $this->statut=$statut;
    }
    public function addTache($nom,$date,$description,$priorite,$statut){

            try{
                $requete="INSERT INTO assign_tache(nom,date,description,id_priorite,id_statut) VALUES(:nom,:date,:description,:priorite,:statut)";
                // Préparation de la requête
                $stmtInsert = $this->connexion->prepare($requete);
        
                // Lier les valeurs qu'on veut insérer aux paramètres nommées
                $stmtInsert->bindparam(':nom',$nom);
                $stmtInsert->bindparam(':date', $date);
                $stmtInsert->bindparam(':description', $description);
                $stmtInsert->bindparam(':priorite', $priorite);
                $stmtInsert->bindparam(':statut', $statut);
        
                // Exécution de la requête
                $stmtInsert->execute();
        
                // Redirection de l'utilisateur vers une autre page
                header("Location: read.php");
                exit();
        
            } catch (PDOException $e) {
                // Gestion de l'erreur en la lançant à l'extérieur de la méthode
                throw new Exception("ERREUR: Impossible d'insérer des données. " . $e->getMessage());
            }
        }
        public function readTache(){
            try{
                $sql="SELECT assign_tache.id_tache,assign_tache.nom,assign_tache.date,assign_tache.description,priorite.libelle AS priorite_nom, statut.libelle AS statut_nom
            FROM assign_tache
            INNER JOIN priorite ON assign_tache.id_priorite=priorite.id
            INNER JOIN statut ON assign_tache.id_statut=statut.id
             ";

             //prepare la requete
             $stmt=$this->connexion->prepare($sql);

             //executer la requete
              $stmt->execute();

              //recuperer les resultats
              $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
              return $resultats;

            }catch(PDOexception $se){
              die("impossible de lire les taches".$se->getMessage());
            }

        }
        public function updateTache($id_tache, $nom, $date, $description, $priorite, $statut){
            try{
                $requete = "UPDATE assign_tache SET nom=:nom, date=:date, description=:description, id_priorite=:priorite, id_statut=:statut WHERE id_tache=:id_tache";
                
                // Préparation de la requête
                $stmtInsert = $this->connexion->prepare($requete);
        
                // Lier les valeurs qu'on veut insérer aux paramètres nommés
                $stmtInsert->bindparam(':nom', $nom);
                $stmtInsert->bindparam(':date', $date);
                $stmtInsert->bindparam(':description', $description);
                $stmtInsert->bindparam(':priorite', $priorite);
                $stmtInsert->bindparam(':statut', $statut);
                $stmtInsert->bindparam(':id_tache', $id_tache);
            
                // Exécution de la requête
                $stmtInsert->execute();
        
                // Redirection de l'utilisateur vers une autre page
                header("Location: index1.php");
                exit();
        
            } catch (PDOException $e) {
                // Gestion de l'erreur en la lançant à l'extérieur de la méthode
                throw new Exception("ERREUR: Impossible de modifier les données. " . $e->getMessage());
            }
        }
        
        public function deleteTache($id_tache){
            try {
                // Requête SQL de suppression avec des paramètres
                $sql = "DELETE FROM assign_tache WHERE id_tache = :id_tache";
                
                // Préparation de la requête
                $stmt = $this->connexion->prepare($sql);
                
                // Liaison de la valeur de l'matricule au paramètre
                $stmt->bindParam(':id_tache', $id_tache, PDO::PARAM_STR);
                
                // Exécution de la requête
                $stmt->execute();
                
                // Retourne true si la suppression a réussi
               
                header("location: index1.php");
            } catch(PDOException $e) {
                // Gestion de l'erreur en la lançant à l'extérieur de la méthode
                throw new Exception("ERREUR: Impossible de supprimer l'habitant. " . $e->getMessage());
            }
        }
        
    }

