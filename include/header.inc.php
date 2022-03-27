<?php
  session_start();

  require_once "./Database.php";

  $db = new \Database('lvanden_hmb2021');

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hold My Beer - Accueil</title>

    <!--css and js link-->
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/stylesfaq.css" />
    
    <script src="js/script.js"></script>
    <script src="js/scriptfaq.js"></script>
    <!-- Add JQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- custom font-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

  </head>
  <body>
    <header class="header">
      <a href="./index.php" class="logo">
        <img src="images/logobeer.png" alt="" width="100" height="100" />
      </a>


      <nav class="navbar">
        <a href="./index.php">Accueil</a>
        <a href="./tendances.php">Bars Tendances</a>
        <a href="./faq.php">Foire Aux Questions</a>
        <a href="./contact.php">Contact</a>
        <?php
          if(empty($_SESSION['pseudo'])){
            echo"<a id='connexion_navbar' href='./connexionform.php'>Inscription / Connexion</a>";
          }else
          {
              echo "<a id='connexion_navbar' href='./compte.php'>Mon Compte</a>";

          }
        ?>
      </nav>


      <div class="icons">
              <?php
                if(empty($_SESSION['pseudo'])){
                  echo'<a href="./connexionform.php" id="connexion" >';
                }else{
                  echo'<a href="./compte.php" id="connexion" >';
                }
              ?>
              <img src="images/login_logo.png"  alt="" width="34" height="32" />
              <?php
                if(!empty($_SESSION['pseudo'])){
                  echo '<p class="header_pseudo">'.$_SESSION['pseudo'].'</p>';
                }
              ?>
              </a>
              <div class="fas fa-bars" id="menu-btn"></div>
            </div>
    </header>
    <main>
