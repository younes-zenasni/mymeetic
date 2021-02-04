<?php
session_start();
 
$bdd = new PDO('mysql:host=localhost;dbname=mymeetic', 'root', '');
 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
 

<!DOCTYPE html>
    <html lang="fr">
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


<div  class="box" align="center">
         <h1>Profil de <?php echo $userinfo['prenom']; ?></h1>
         <br />
        Prénom : <?php echo $userinfo['prenom']; ?>  <?php echo $userinfo['nom']; ?>
         <br /> 
         Mail : <?php echo $userinfo['email']; ?>
         <br />
         Âge : <?php echo $userinfo['age']; ?> ans
         <br />
         Sexe : <?php echo $userinfo['sexe']; ?>
         <br />
         Ville : <?php echo $userinfo['ville']; ?>
         <br />
         Loisir : <?php echo $userinfo['loisir']; ?>
        <br>
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a class="btn" href="editionprofil.php">Editer mon profil</a>
         <a class=" btn" href="deconnexion.php">Se déconnecter</a>
         
         <?php
         }
         ?>
      </div>
    
</div>


<style>
    body{
    background:fixed no-repeat center;
    background-image: url(background.jpg);
    background-size: cover;
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
  color: pink;
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

.btn{
      background-color: pink;
      color: black!important;
      border-radius: 10px;
      text-decoration: none;
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
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2020 Copyright :
    <a class="text-pink" href="#" >MyMeetic.com</a>
  </div>
  <!-- Copyright -->
</footer>


</body>
</html>
<?php   
}
?>