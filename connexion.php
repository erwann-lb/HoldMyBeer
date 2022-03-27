<?php

if(isset($_POST["connexionbtn"])){

    connexion();
}

function connexion(){

    try{

        $db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306","lvanden","hmb2021");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_POST['identifiant']) && isset($_POST['password'])){

            $identifiant = $_POST['identifiant'];
           
            $sql = "SELECT * FROM utilisateur WHERE pseudo = ? OR mail = ? ";
                $result = $db->prepare($sql);
                $result->execute(array($identifiant,$identifiant));
                $data = $result->fetch();

                session_start();
                $_SESSION['pseudo'] = $data['pseudo'];

                header('Location:index.php');


        }

    }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }

}
?>