<?php

    $db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306","lvanden","hmb2021");
    if(isset($_POST['password']) && isset($_POST['password_repeat']) && isset($_POST['token'])){
      if(!empty($_POST['password']) && !empty($_POST['password_repeat'])&& !empty($_POST['token'])){
        echo "on rentre dedans";
        $password=htmlspecialchars($_POST["password"]);
        $password_repeat=htmlspecialchars($_POST["password_repeat"]);
        $token=htmlspecialchars($_POST["token"]);

        $check = $db->prepare("SELECT * FROM utilisateur WHERE token = ?");
        $check->execute(array($token));
        $row=$check->rowCount();
        if($row!=null){
          $password = password_hash($password,  PASSWORD_BCRYPT);

          $update = $db->prepare("UPDATE utilisateur SET password = ? WHERE token = ?");
          $update->execute(array($password,$token));

          $delete = $db->prepare("DELETE FROM password_recover WHERE token_user = ?");
          $delete->execute(array($token));

          header('Location:index.php');

        }else{
          echo "compte non existant";
          //compte non existant
        }

      }else{
        echo "manque mot de passe";
        //manque mot de passe
      }
    }else{
      echo "non set";
    }

    ?>
