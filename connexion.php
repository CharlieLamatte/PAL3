<?php session_start();
include("config.php")?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <img src="Logo_2.jpg" height="70" alt="Logo">
            </div>
            <div class="go-muscu">GO MUSCU</div>
            <div class="cta">
                <a href="Homepage.html" class="btn">Accueil</a>
                <a href="Inscription.html" class="btn">Inscription</a>
            </div>
        </div>
    </nav>

    <div class="form-container">
        <div class="wrapper form">
            <h2>Connexion Client</h2>
            <form action="connexion.php" method="post">
                <label for="client_email">Adresse e-mail :</label><br>
                <input type="email" id="client_email" name="email" required><br><br>
                <label for="client_password">Mot de passe :</label><br>
                <input type="password" id="client_password" name="MDP" required><br><br>
                <input class="btn" type="submit" value="connexion">
            </form>
            <p>Pas encore inscrit ? <a href="Inscription.php" class="btn">Inscription</a></p>
        </div>
    </div>
</body>
</html>
<?php
if (isset($_POST['connexion']))
{
    if (isset($_POST['email']) and isset($_POST['MDP'])) 
    {
  
        $email = $_POST['email'];
        $MDP = $_POST['MDP'];
        try{
        $connexion= $bdd->prepare("SELECT * FROM Connexion WHERE email = ? AND MDP = ?");
        $connexion->execute(array('email'=>$email, 'MDP'=>$MDP));
        $result=$connexion->rowCount();

        if ($result==1) {
            $_SESSION['email'] = $email;
            $_SESSION['MDP'] = $MDP;
            header("Location:page_client.html");
            exit();
        } else { 
            echo "email ou mot de passe incorrect."; 
            //header ("Refresh: 3; URL=Connexion1.php");
            exit();
        }
    }
    catch(Exception $e) {
      die('Erreur : '. $e -> getMessage());
}
}
}

?>

