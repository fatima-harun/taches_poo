<?php
require_once "connexion.php";
//permet d'initialiser une session ou de reprendre une session déja ouverte
session_start();
if(isset($_POST['valider'])){
    if( !empty($_POST['nom']) AND !empty($_POST['pass'])){
        $nom=htmlspecialchars($_POST['nom']);
        $pass=sha1($_POST['pass']);
        $recupUser=$connexion->prepare('SELECT * FROM user WHERE nom=? AND pass=?');
        $recupUser->execute(array($nom,$pass));

        if($recupUser->rowCount()>0){
           $_SESSION['nom']=$nom;
           $_SESSION['pass']=$pass;
           $_SESSION['id']=$recupUser->fetch()['id'];
           echo $_SESSION['id'];
           header("location:index1.php");
        }else{
            echo "votre mot de passe ou email est incorrecte";
        }
    }else{
        echo "Veuillez complèter tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 0 auto;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2>Connexion</h2>
        <label for="">Prénom et nom:</label>
        <input type="text" id="" name="nom" required autocomplete="off">
        <label for="password">Mot de passe:</label>
        <input type="password"  name="pass" required autocomplete="off">
        <input type="submit" value="Se connecter" name="valider">
    </form>
</body>
</html>
