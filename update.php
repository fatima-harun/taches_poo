<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// require_once "taches.php";
require_once "connexion.php";
require_once "priorite.php";
require_once "statut.php";

// Vérifier si le formulaire est soumis
if(isset($_POST['submit'])) {
  // Récupérer les données du formulaire
  $id_tache = $_POST['id_tache'];
  $nom = $_POST['nom'];
  $date = $_POST['date'];
  $description = $_POST['description'];
  $priorite = $_POST['id_priorite'];
  $statut = $_POST['id_statut'];
  // Appeler la fonction de mise à jour de la tache
  $tache->updateTache($id_tache, $nom, $date, $description, $priorite, $statut);
  // Redirection vers la page index1.php après la mise à jour réussie
  header("Location: index1.php");
  exit(); // Arrêter l'exécution du script après la redirection
}

// Vérification si l'id_tache est fourni dans la requête GET
if (!isset($_GET['id_tache'])) {
  // Gérer le cas où aucun l'id n'est pas fourni
  echo "Aucun identifiant n'est fourni.";
  exit();
}

//requete sql pour selectionner les données de la tache à partir de l'id_tache

$sql="SELECT * FROM assign_tache WHERE id_tache = :id_tache";
 //prepareation de la requete
$stmt=$connexion ->prepare($sql);
//liaison des valeurs aux parametre
$stmt->bindParam(':id_tache', $_GET['id_tache'], PDO::PARAM_STR);
 //execution de la requete
if($stmt->execute()){
//preparation du resultat
$assign_tache=$stmt->fetch(PDO::FETCH_ASSOC);
 }else{
      echo"Erreur lors de la recuperation des données";
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <title>Business Task</title>
</head>
<body>
        <header>
        <div class="img_logo"><img src="images\logoTask.png" alt="logo de l'entreprise" class="logo"></div>
        <div class="top_header">
          <div><input type="text" placeholder="Rechercher" class="recherche"></div>
        </div>
        <div class="bouton"><button><a href="">Ajouter un nouveau projet</a></button></div>
        <div class="top_header">
            <box-icon name='bell' animation='tada' color='#d35400' ></box-icon>
            <!-- on mettra ici le code qui va permettre de mettre le nom de la personne qui s'est authentifiée -->
        </div>
    </header>
    <div class="container">
        <div class="div_list">
          <ul>
            <li ><a href=""><box-icon name='dashboard' type='solid' color='#e67e22' title="Tableau de bord"></box-icon></a></li>
            <li><a href=""><box-icon name='archive'color='#e67e22' title="Projets" ></box-icon></a></li>
            <li><a href=""><box-icon name='bar-chart' color='#e67e22' title="Suivi du projet"></box-icon></a></li>
            <li><a href=""><box-icon type='solid' name='comment-detail' color='#e67e22'title="Messages"></box-icon></a></li>
            <li><a href=""><box-icon type='solid' name='calendar'color='#e67e22'title="Calendrier"></box-icon></box-icon></a></li>
            <li><a href=""><box-icon type='solid' name='wrench'color='#e67e22' title="Paramètres"></box-icon></a></li>
          </ul>
        </div>
              <div class="modal-content">
                
                <form action="update.php" method="POST">
                <input type="hidden" value="<?php echo $id_tache ?>">
                  <input type="text" name="nom"  value="<?php echo $assign_tache['nom'] ;?>">
                  <div class="details">
                    <div>
                      <p><label for="date">Date d'échéance</label></p>
                      <input type="date" name="date" value="<?php echo $assign_tache['date'] ;?>">
                    </div>
                    <div>
                      <p><label for="priorite">Priorité</label></p>
                      <select name="id_priorite" >
                      <?php foreach ($priority as $priorities) : ?>
                <option value="<?php echo $priorities['id']; ?>" <?php if($priorities['id'] == $assign_tache['id_priorite']) echo 'selected'; ?>>
                <?php echo $priorities['libelle'] ?>
                </option>
            <?php endforeach; ?>
                      </select>
                    </div>
                    <div>
                      <p><label for="statut">Statut</label></p>
                      <select name="id_statut" >
                        <?php foreach ($status as $statu) { ?>
                        <option value="<?php echo $statu['id']; ?>"<?php if($statu['id'] === $assign_tache['id_statut']) echo 'selected' ; ?>>
                        <?php echo $statu['libelle'] ?>
                      </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div>
                    <p><label for="texte">Description</label></p>
                    <p><textarea name="description" id="texte" cols="50" rows="10" ><?php echo $assign_tache['description']; ?></textarea></p>
                  </div>
                  <input type="submit" name="submit"  value="submit">
                </form>
              </div>
            </div>
            <!-- Fond sombre derrière le modal -->
            <div id="modal-background" class="modal-background"></div>
        </div>
            </body>
            </html>