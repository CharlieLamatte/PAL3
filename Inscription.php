<?php include 'Connexion_bdd'?>
<html>
<head>
    <link rel="stylesheet" href="style.css"> 
    <title>Inscription</title>
    <style>
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <img src="Logo_2.jpg" height="70" alt="Logo">
            </div>
            <div class="go-muscu">GO MUSCU</div>
            <div class="cta">
                <a href="Homepage.html" class="btn">Acceuil</a>
                <a href="connexion.html" class="btn">Connexion</a>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <h2>Inscription</h2>
        <form id="myForm" action="Inscription.php" method="post">
            <label for="nom">Nom :</label><br>
            <input type="text" id="nom" name="nom" required><br>

            <label for="prenom">Prénom :</label><br>
            <input type="text" id="prenom" name="prenom" required><br>

            <label for="email"> e-mail :</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="MDP" required><br>

            <label for="birthdate">Date de naissance :</label><br>
            <input type="date" id="birthdate" name="DateDeNaissance" required><br>
            <p id="errorMessage" class="error"></p>


            <input type="submit" class="btn" value="Inscription" onclick="checkYear()">

        </form>
    </div>
    <script>// verification et message d'erreur pour l'age
        function checkYear() {
            var birthdate = new Date(document.getElementById("birthdate").value);
            var birthYear = birthdate.getFullYear();
            var currentYear = new Date().getFullYear();
            
            if (currentYear - birthYear < 16) {
                document.getElementById("errorMessage").innerText = "Vous devez être âgé d'au moins 16 ans pour vous inscrire.";
            } else {
                document.getElementById("errorMessage").innerText = "";
                document.getElementById("myForm").submit();
            }
        }
    </script>
    </div>
</body>

<?php 
if (isset($_POST['Inscription'])) 
{
    if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['email']) and isset($_POST ['MDP']) and isset($_POST ['DateDeNaissance']))
    {
      $nom= $_POST['nom'];
      $prenom= $_POST['prenom'];
      $email= $_POST['email'];
      $MDP= $_POST['MDP'];
      $DateDeNaissance= $_POST['DateDeNaissance'];
      
      $_SESSION['nom']=$nom;
      $_SESSION['prenom']=$prenom;
      $_SESSION['email']=$email;
      $_SESSION['MDP']=$MDP;
      $_SESSION['DateDeNaissance']=$DateDeNaissance;
      try{
        $req = $bdd ->prepare("INSERT INTO Utilisateur (nom, prenom, email, MDP, DateDeNaissance) VALUES ( ?, ?, ?, ?, ?)");
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
