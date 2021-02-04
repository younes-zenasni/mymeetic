<?php

$resultat = [];

$bdd = new PDO('mysql:host=localhost;dbname=mymeetic', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
try{
session_start();

    
   
if(isset($_SESSION['id']))
{
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    $nom = strtoupper($user['nom']);
    $prenom = strtoupper($user['prenom']);
}

    if (isset($_GET["sexe"]) && isset($_GET["age_min"])) {
            
            $sexe = $_GET["sexe"];
            $age_min = $_GET["age_min"];
            $ville = $_GET['ville'];
            $age_max = $_GET["age_max"];
            $loisir = $_GET["loisir"];
        $recherche = $bdd->prepare("SELECT * FROM utilisateurs WHERE sexe=:sexe AND age >= :age AND age <= :age_max AND ville = :ville AND loisir = :loisir");
        
                $recherche->bindParam(':sexe', $sexe, PDO::PARAM_STR);
                $recherche->bindParam(':age', $age_min, PDO::PARAM_INT);
                $recherche->bindParam(':ville', $ville, PDO::PARAM_STR);
                $recherche->bindParam(':age_max', $age_max, PDO::PARAM_INT);
                $recherche->bindParam(':loisir', $loisir, PDO::PARAM_STR);
                $recherche->execute();
                $resultat = $recherche->fetchAll();
    }
    else{
        $erreur =  "Aucune personne n'a été trouvé";
    }
}catch (PDOException $e) {
      die("Erreur de connexion à la base :".$e->getMessage());
      exit();
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

<form action="" method="GET">
  <fieldset>
<legend><h1>Recherche de nouvelles personnes</h1></legend>

<div class="form-example">
<label for="age_min">Entrer l'âge minimal</label>
<br>
<input type="number" name="age_min" id="age_min"  required>
</div>

<br>

<div class="form-example">
<label for="age_max">Entrer l'âge maximal </label>
<br>
<input type="number" name="age_max" id="age_max" required>
</div>

<br>

<div class="form-example">
<label for="sexe">Entrer le genre </label>
<br>
<input type="texte" name="sexe" id="sexe" required>
</div>

<br>

<div class="form-example">
<label for="ville">Entrer la ville</label>
<br>
<input type="text" name="ville" id="ville" required>
</div>

<br>

<div class="form-example">
<label for="loisir">Entrer le loisir</label>
<br>
<input type="texte" name="loisir" id="loisir" required>
</div>

<br>

<input type="submit" name="search" value="Rechercher" />
</fieldset>
</form>

<br>

<?php if(isset($erreur)) { echo $erreur; } ?>

<br> <br>


<?php foreach ($resultat as $key => $value): ?>
                
                <ul class="resultat" style="list-style-type: none; display: block; text-align: left;">
                    <li style="text-transform: uppercase; font-weight: bold; font-size: 22px;"> <?= $value["prenom"] ?>  <?=$value["nom"]?></li>
                    <li style="font-size: 20px;">Age : <?= $value["age"]  ?></li>
                    <li style="font-size: 20px;">Sexe : <?= $value["sexe"]  ?></li>
                    <li style="font-size: 20px;">Loisir : <?= $value["loisir"]  ?></li>
                    <li style="font-size: 20px;">Ville : <?=$value["ville"] ?></li>
                </ul>
            <?php endforeach; ?>
</div>

<br> <br>

<footer class="bg-dark text-center text-lg-start">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2021 Copyright :
    <a class="text-pink" href="#" >MyMeetic.com</a>
  </div>
</footer>

</body>

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
  height: 850px;
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

.resultat{
    color: pink;
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

</html>