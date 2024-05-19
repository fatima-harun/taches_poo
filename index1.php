<?php
require_once "connexion.php";
require_once "taches.php";
session_start();
if(!$_SESSION['pass']){
  header('location:authentification.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <title>Tâches</title>
</head>
<body>
    <header>
        <div class="img_logo"><img src="images\logoTask.png" alt="logo de l'entreprise" class="logo"></div>
        <div class="top_header">
          <div><input type="text" placeholder="Rechercher" class="recherche"></div>
        </div>
        <div>
          <button onclick="openModal()" class="bouton">Ajouter une Tâche</button>

          <!-- Modal -->
          <div id="modal" class="modal">
            <div class="modal-content">
              <form action="add.php" method="POST">
                <input type="text" name="nom" placeholder="Nom de la tache">
                <div class="details">
                  <div>
                    <p><label for="date">Date d'échéance</label></p>
                    <input type="date" name="date" >
                  </div>
                  <div>
                    <p><label for="priorite">Priorité</label></p>
                    <select name="id_priorite" >
                      <?php foreach ($priority as $priorities) { ?>
                      <option value="<?php echo $priorities['id']; ?>"><?php echo $priorities['libelle']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div>
                    <p><label for="statut">Statut</label></p>
                    <select name="id_statut" >
                      <?php foreach ($status as $statu) { ?>
                      <option value="<?php echo $statu['id']; ?>"><?php echo $statu['libelle']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div>
                  <p><label for="texte">Description</label></p>
                  <p><textarea name="description" id="texte" cols="50" rows="10"></textarea></p>
                </div>
                <input type="submit" name="submit" value="Ajouter">
              </form>
            </div>
          </div>
          <!-- Fond sombre derrière le modal -->
          <div id="modal-background" class="modal-background"></div>
      </div>
        <div class="top_header">
            <box-icon name='bell' animation='tada' color='#d35400' ></box-icon> <?php echo "Bienvenue ".$_SESSION['nom']?><a href="authentification.php"><box-icon name='power-off' color='#e67e22' title="Déconnexion" class="off"></box-icon></a>
            
            </select>
            
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
        
        <div class="contain1">
          <h1>Projets</h1>
          <div class="contain">
          <div class="square" id="square1"><h2>Projet 1</h2></div>
          <div class="square" id="square2"><h2>Projet 2</h2></div>
          <div class="square" id="square3"><h2>Projet 3</h2></div>
        </div>
        <h3>Tableau des taches</h3>
        <hr>
        <div class="caisse">
          <table>
              <tr>
                  <th>Tache</th>
                  <th>Date Limite</th>
                  <th>Description</th>
                  <th>Priorités</th>
                  <th>Statut</th>
                  <th></th>
              </tr>
              <?php if($resultats !== null) { ?>
                <?php foreach($resultats as $tache) { ?>
                    <tr>
                        <td><?php echo $tache['nom'] ?></td>
                        <td><?php echo $tache['date'] ?></td>
                        <td><?php echo $tache['description'] ?></td>
                        <td><?php echo $tache['priorite_nom'] ?></td>
                        <td><?php echo $tache['statut_nom'] ?></td>
                        <td><a href="update.php?id_tache=<?php echo $tache['id_tache'];?>"><box-icon name='edit-alt'></box-icon></a></td>
                        <td><a href="delete.php?id_tache=<?php echo $tache['id_tache'];?>"><box-icon name='message-rounded-x'></box-icon></a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </table>
          </div>
    </div>
    
 <style>
    body{
    margin:0;
}
/* Style du header */
.logo{
    width: 50%;
    height: auto;
}
.img_logo{
    margin-bottom: 4%;
}
.recherche{
    padding-right: 35%; 
    text-align: left;
    border-radius:12px;
    border-width: thin;
}
.recherche:focus{
    outline:none;
}
header{
    display:flex;
    justify-content: space-evenly;
    margin-top: 1%;
}
.top_header{
    margin-top: 1%;
    display: flex; 
}
 .bouton{
    margin-top :10% ;
    color: white;
    background-color: #e67e22;
    border:none;
    border-radius: 7px;
 }
 
 
 li{
    list-style: none;
    margin-bottom: 50px;
    color:#e67e22
 }
 /* Styliser la partie des projets */
 .div_list{
    margin-right: 12%;
    margin-top: 1.5%;
    margin-left: 4%;
 }
 .container{
    display: flex;
 }
 h1{
       color:#1e272e
 }
 .projet{
    background-color: #f5f6fa;
 }
 
 .box_tache {
    display:flex;
    border-style: dashed;
    /* padding: 40px;
    background-color: #e67e22;
    color:white;
    border-color: white; */
 }
 /* Style du modal*/
 .details{
    display:flex;
    justify-content: space-between;
 }
 .modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.5);
    width: 30%;
    height: 50%;
    z-index: 1000;
  }
  
  /* Style pour le contenu du modal */
  .modal-content {
    background-color:#e67e22;
    padding: 20px;
    border-radius: 5px;
    color:white;
  }
  
  /* Style pour le formulaire dans le modal */
  .modal-content form {
    display: flex;
    flex-direction: column;
  }
  
  /* Style pour le fond sombre */
  .modal-background {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 900;
  }
  /* Style de la carte pour lire les données */
  table{
   width: 100%;
   border-collapse:collapse
  }
  td{
    text-align:center;
    padding: 15px;
  }
  th{
   text-align: center;
   padding: 25px;
   background-color:#1B9CFC;
   color: white;
  }
  /* style de mes projets */
  .contain {
    display: flex;
  }
  .contain1{
    background-color: #ecf0f3;
    padding: 30px;
    border-radius: 8px;
  }
  .square {
    width: 100px;
    height: 210px;
    background-color: #ccc;
    margin-right: 90px; 
    padding: 60px;
    border-radius: 8px;
    margin-bottom: 30px;
  }
  #square1{
    background-color: #8c7ae6;
  }
  #square2{
    background-color:#f368e0;
  }
  #square3{
    background-color:#f39c12;
  }
  h1{
    color:#222f3e
  }
  /* style deconnexion */
  .off{
    margin-left:10px
  }
</style>
    <script src="script.js"></script>

</body>
</html>