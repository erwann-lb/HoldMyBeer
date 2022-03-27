<?php

  session_start();

  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';
  require 'PHPMailer/Exception.php';
  require_once "./Database.php";

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

function envoiMail(){
  if( (isset($_POST['nom'])) && (isset($_POST['prenom'])) && (isset($_POST['email'])) && (isset($_POST['message']))){

  $sender = $_POST['email'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $message = $_POST['message'];


  $mail = new PHPMailer();

  $mail->isSMTP();
  $mail->Host="smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "tls";
  $mail->Port = 587;
  $mail->Username = "holdmybeerdwa@gmail.com";
  $mail->Password = 'projetdwa2021';

  $mail->Subject = "$nom $prenom";
  $mail->Body = "$message";
  $mail->addAddress("holdmybeerdwa@gmail.com");
  $mail->addreplyto("$sender");
  if($mail->send()){
    echo "mail sent";
  }else {
    echo "non";
  }
  $mail->smtpClose;
  }
}


function recherche_biere($beer_submit){

  $db = new \Database('lvanden_hmb2021');

  if(isset($beer_submit)){

    $str = htmlspecialchars($_POST['search']);

    foreach($db->query_boisson($str)as $post ) :


      echo "<article class ='resultat' id= '".$post->id."'>\n";
      echo "<div class ='resultat-affiche'>";
      echo"\t\t\t<figure>\n";
      echo"<a href='barspage.php?id=".$post->id."'>\n";
      echo "<img src='./images/logo_1.png' alt='Affiche Bar'/>\n";
      echo "</a>";
      echo "\t\t\t</figure>\n";
      echo"\t\t</div>\n";

      echo "<div class ='resultat-description'>";
      echo"<a href='barspage.php?id=".$post->id."'>\n";
      echo "\t <p class='titre'>".$post->nom."</p>\n";
      echo "</a>";
      echo "</div>";
      echo "<div class='post-info'>";
      echo "</div>";
      echo "</article>\n";



    endforeach;

  }
}

function tendances(){

  $db = new \Database('lvanden_hmb2021');



    foreach($db->query_tendances() as $post ) :

      
      echo "<article class ='resultat' id= '".$post->id."'>\n";
      echo "<div class ='resultat-affiche'>";
      echo"\t\t\t<figure>\n";
      echo"<a href='barspage.php?id=".$post->id."'>\n";
      echo "<img src='./images/logo_1.png' alt='Affiche Bar'/>\n";
      echo "</a>";
      echo "\t\t\t</figure>\n";
      echo"\t\t</div>\n";
      
      echo "<div class ='resultat-description'>";
      echo"<a href='barspage.php?id=".$post->id."'>\n";
      echo "\t <p class='titre'>".$post->nom."</p>\n";
      echo "</a>";
      echo "\t <p>".$post->like_count." likes</p>\n";
      echo "</div>";
      echo "</article>\n";

    endforeach;


}


?>