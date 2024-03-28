<?php include 'Connexion_bdd'?>
<html>
<head>
    <title>Question_Client</title>
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

    <div class="wrapper">
        <h2>Information personnelle</h2>
        <form id="form" action="Question_client.php" method="post">
            <label for="poids">Poids (kg):</label>
            <input type="number" id="poids" name="poids" required><br>

            <label for="taille">Taille (cm):</label>
            <input type="number" id="taille" name="taille" required><br>

            <label for="niveau">Niveau :</label>
            <select id="niveau" name="niveau">
                <option value="debutant">Débutant</option>
                <option value="intermediaire">Intermédiaire</option>
                <option value="confirme">Confirmé</option>
            </select><br>

            <label for="objectif">Objectif :</label>
            <select id="objectif" name="objectif">
                <option value="perte-poids">Perte de poids</option>
                <option value="prise-masse">Prise de masse</option>
                <option value="seche">Sèche</option>
                <option value="entretien">Entretien</option>
            </select><br>

            <label for="temps-libre">Temps libre (en heures) :</label>
            <input type="number" id="temps-libre" name="temps-libre" required><br>

            <input type="submit" value="Suivant" class="btn">
        </form>
    </div>
</body>
</html>
<?php 
if (isset($_POST['Suivant'])) 
{
    if (isset($_POST['poids']) and isset($_POST['taille']) and isset($_POST['niveau']) and isset($_POST ['objectif']) and isset($_POST ['temps-libres']))
    {
      $poids= $_POST['poids'];
      $prenom= $_POST['prenom'];
      $email= $_POST['email'];
      $MDP= $_POST['MDP'];
      $DateDeNaissance= $_POST['DateDeNaissance'];
      
      $_SESSION['poids']=$poids;
      $_SESSION['prenom']=$prenom;
      $_SESSION['email']=$email;
      $_SESSION['MDP']=$MDP;
      $_SESSION['DateDeNaissance']=$DateDeNaissance;
      try{
        $req = $bdd ->prepare("INSERT INTO Info_Utilisateur (nom, prenom, email, MDP, DateDeNaissance) VALUES ( ?, ?, ?, ?, ?)");
        $result= $bdd->query($req);
        var_dump($result);
        $req -> execute ([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['MDP'], $_POST['DateDeNaissance']]);
        header("Location:connexion.php");
      exit();
    }
    catch(Exception $e) {
  die('Erreur : '. $e -> getMessage());
}}}
?>
