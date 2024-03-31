<?php
session_start();

include_once 'functions.php';
// ça permet de voir si la méthode post qui contient les clés email et password n'est sont pas vides
if(!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
// cette ligne prends la méthode userLogin qui passe en parametre deux variables et l'affecte dans result
    $result = userLogin($email, $password);

/* dans ce point on vérifie la la variable result contient bien les données, si oui l'internaute sera rediriger 
    vers la page d'acceuil, par contre il va rester dans la page login
 */
    if($result != false) {
        $_SESSION['user'] = $result;
    }
}

if(!empty($_SESSION['user'])) {
  header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="content_form">
        <form action="" method="post">
            <span class="content_message">S'authentifier</span><br><br>
            <input class="input_box" type="email" name="email" placeholder="Votre Email" required><i class='bx bx-envelope'></i><br>
            <input class="input_box" type="password" name="password" placeholder="Votre mot de passe" required><i class='bx bxs-lock'></i><br>
            <input class="input_btn" type="submit" name="btn" value="Se connecter">
        </form>
    </div>
    
</body>
</html>