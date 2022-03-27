<?php

session_start();

try{
    $db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306","lvanden","hmb2021");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if(isset($_POST['identifiant']) && isset($_POST['password'])){
        $identifiant = $_POST['identifiant'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM utilisateur WHERE pseudo = '$identifiant' OR mail = '$identifiant'";
        $result = $db->prepare($sql);
        $result->execute(array($pseudo));
        $data = $result->fetch();

        if($result->rowCount()>0){
          if ($data != null) {
            if(password_verify($password,$data['password'])){
              if($data['confirmed']==1){
                echo"ok";
              }else{
                echo"notverified";
              }
            }else{
              echo "wrong";
            }
          }
        }else{
          echo"wrong";
        }
      }
  }catch(PDOException $e){
    echo $e->getMessage();
}

?>