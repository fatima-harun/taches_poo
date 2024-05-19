<?php
session_start();
require_once "connexion.php";
if(isset($_POST['valider'])){
    if(!empty($_POST['nom']) AND  !empty($_POST['email']) AND !empty($_POST['pass'])){
        $nom=htmlspecialchars($_POST['nom']);
        $email=htmlspecialchars($_POST['email']);
        $pass=sha1($_POST['pass']);
        $insertUser=$connexion->prepare('INSERT INTO user(nom,email,pass)VALUES(?,?,?) ');
        $insertUser->execute(array($nom,$email,$pass));
        
        $recupUser=$connexion->prepare('SELECT * FROM user WHERE nom=?  AND email=? AND pass=?');
        $recupUser->execute(array($nom,$email,$pass));
         if($recupUser->rowCount()>0){
            $_SESSION['nom'] = $nom;
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            $_SESSION['id']=$recupUser->fetch()['id'];
            header("location:authentification.php");
         }

         echo $_SESSION['id'];

    }else{
        echo "Veuillez remplir tous les champs";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: calc(100% - 12px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .error-message {
        color: #ff0000;
        margin-bottom: 10px;
    }

    .success-message {
        color: #008000;
        margin-bottom: 10px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Inscription</h2>
    <form id="registration-form" action="" method="POST">
        <div class="error-message"></div>
        <div class="success-message"></div>
        <label for="username">Prénom et nom:</label>
        <input type="text" id="username" name="nom" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="">Mot de passe:</label>
        <input type="password"  name="pass" required>

        <!-- <label for="confirm_password">Confirmer le mot de passe:</label>
        <input type="password" name="repass" required> -->

        <input type="submit" value="s'inscrire" name="valider">
    </form>
</div>

</body>
</html>
