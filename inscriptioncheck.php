<?php
session_start();

try{

    $db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306","lvanden","hmb2021");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pseudo=$_POST['pseudo'];

    $sqlPseudo = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo'";
    $resultPseudo = $db->prepare($sqlPseudo);
    $resultPseudo->execute();

    $mail=$_POST['mail'];

    $sqlMail = "SELECT * FROM utilisateur WHERE mail = '$mail'";
    $resultMail = $db->prepare($sqlMail);
    $resultMail->execute();

    if($resultPseudo->rowCount()>0){
      echo "pseudoExist";
    }

    if($resultMail->rowCount()>0){
      echo "mailExist";
    }


}catch(PDOException $e){
    echo $e->getMessage();
}
?>
