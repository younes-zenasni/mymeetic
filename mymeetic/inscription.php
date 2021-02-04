<?php

$bdd = new PDO('mysql:host=localhost;dbname=mymeetic', 'root', '');

if(isset($_POST['forminscription']))
{
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $age = htmlspecialchars($_POST['age']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $ville = htmlspecialchars($_POST['ville']);
    $loisir = htmlspecialchars($_POST['loisir']);
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);

    if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['age']) AND !empty($_POST['sexe']) AND !empty($_POST['ville']) AND !empty($_POST['loisir']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password2'])) 
            {
            $prenomlength = strlen($prenom);
            if($prenomlength <= 255) {
               if($email <= 255) {
                  if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                     $reqemail = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = ?");
                     $reqemail->execute(array($email));
                     $emailexist = $reqemail->rowCount();
                     if($emailexist == 0) {
                        if($password == $password2) {
                           $insertuser = $bdd->prepare("INSERT INTO utilisateurs(prenom, nom, age, sexe, ville, loisir, email, motdepasse) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                           $insertuser->execute(array($prenom, $nom, $age, $sexe, $ville, $loisir, $email, $password));
                           $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                        } else {
                           $erreur = "Vos mots de passes ne correspondent pas !";
                        }
                     } else {
                        $erreur = "Adresse mail déjà utilisée !";
                     }
                  } else {
                     $erreur = "Votre adresse mail n'est pas valide !";
                  }
               } else {
                  $erreur = "Vos adresses mail ne correspondent pas !";
               }
            } else {
               $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
            }
         } else {
            $erreur = "Tous les champs doivent être complétés !";
         }
      }
      ?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
      <fieldset>
    <legend><h1>Inscription</h1></legend>

    <div class="form-example">
    <label for="prenom">Entrer votre prénom </label>
    <br>
    <input type="text" name="prenom" id="prenom"  required>
    </div>

    <br>

    <div class="form-example">
    <label for="prenom">Entrer votre nom </label>
    <br>
    <input type="text" name="nom" id="nom" required>
    </div>

    <br>

    <div class="form-example">
    <label for="age">Entrer votre âge </label>
    <br>
    <input type="number" name="age" id="age" required>
    </div>

    <br>

    <div class="form-example">
    <label for="genre">Séléctionner votre genre </label>
    <br>
    <select name="sexe">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
    </select>
    </div>

    <br>

    <div class="form-example">
    <label for="ville">Séléctionner votre ville</label>
    <br>
    <select name="ville">
    <option value="Lyon">Lyon</option>
    <option value="Paris">Paris</option>
    <option value="Marseille">Marseille</option>
    </select>
    </div>

    <br>

    <div class="form-example">
    <label for="prenom">Entrer votre loisir</label>
    <br>
    <input type="text" name="loisir" id="loisir" required>
    </div>

    <br>

    <div class="form-example">
    <label for="email">Entrer votre Email </label>
    <br>
    <input type="email" name="email" id="email" required>
    </div>

    <br>

    <div class="form-example">
    <label for="prenom">Entrer votre mot de passe </label>
    <br>
    <input type="password" name="password" id="password" required>
    </div>

    <br>

    <div class="form-example">
    <label for="prenom">Confirmer votre mot de passe </label>
    <br>
    <input type="password" name="password2" id="passsword2" required>
    </div>

    <br>

    <input type="submit" name="forminscription" value="Je m'inscris" />
    

    </fieldset>


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

label{
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
  height: 950px;
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

<br> <br>

<footer class="bg-dark text-center text-lg-start">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2021 Copyright :
    <a class="text-pink" href="#" >MyMeetic.com</a>
  </div>
</footer>

<script>
    
</script>



</body>
</html>