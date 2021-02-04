<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=mymeetic', 'root', '');

if(isset($_POST['formconnexion'])) {
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passwordconnect = sha1($_POST['passwordconnect']);
    if(!empty($emailconnect) AND !empty($passwordconnect)) {
       $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = ? AND motdepasse = ?");
       $requser->execute(array($emailconnect, $passwordconnect));
       $userexist = $requser->rowCount();
       if($userexist == 1) {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['prenom'] = $userinfo['prenom'];
          $_SESSION['email'] = $userinfo['email'];
          header("Location: espace_membre.php?id=".$_SESSION['id']);
       } else {
          $erreur = "Email ou mot de passe incorrect !";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
 }
 ?>

<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
            <link href="style.css" rel="stylesheet">
            <title>My Meetic</title>
        </head>
        <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand" href="#"><img src="logo.png" alt="logo" width="100px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="connexion.php">Connexion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inscription.php">Inscription</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="autourdemoi.php">Autour de moi</a>
      </li>
    </ul>
  </div>
</nav>
       
<br> <br>



<div class="box" align="center">

<form action="" method="POST">

<h1>Connexion</h1>
<br> 
<div class="form-example">
<input type="email" name="emailconnect" id="email" placeholder="Email" required  />
<br> <br>
<input type="password" name="passwordconnect" id="password" placeholder="Mot de passe" required  />
<br> <br>
<input type="submit" name="formconnexion" value="Se connecter">    
</div>

</form>

<br>

<?php
    if(isset($erreur))
{
    echo '<font color="pink">'.$erreur."</font>";
} ?>
</div>

<style>

body{
    background:fixed no-repeat center;
    background-image: url(background.jpg);
    background-size: cover;
}

input[type=submit]{
    background-color: pink;
    color: #343A40;
}

 h1{
     color: pink;
 }   

.nav-link{
    color: pink!important;
    margin-left: 3rem;
  }

  .nav-link:hover{
    color: white!important;
    background-color: pink;
    border-radius: 10px;
  }
  
  .navbar-nav{
    margin-left: auto;
    margin-right: auto;
  }

  .box {
  width: 400px;
  height: 300px;
  background-color: #343A40;
  position: relative;
  margin-left: auto;
  margin-right: auto;
}

.box::before,
.box::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  background: linear-gradient(45deg, #ff0000, #00f0f0, #00ff00, #0000ff, #ff0000, #00f0f0, #00ff00, #0000ff, #f00f0f);
  width: 100%;
  height: 100%;
  transform: scale(1.02);
  z-index: -1;
  background-size: 500%;
  animation: animate 20s infinite;
}

.box::after {
  filter: blur(20px);
}

@keyframes animate {
  0% { background-position: 0 0; }
  50% { background-position: 300% 0; }
  100% { background-position: 0 0; }
}

input{
    border-radius: 10px;
}

footer{
    font-size: large;
    position:fixed;
    bottom:0px;
    width: 100%;
}

.text-pink{
    color: pink;
}

.text-center{
    color: pink;
}
</style>


<footer class="bg-dark text-center text-lg-start">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2021 Copyright :
    <a class="text-pink" href="#" >MyMeetic.com</a>
  </div>
</footer>


</body>
</html>