<?php

if(isset($_POST["inscriptionbtn"])){
    inscription();
}

function inscription(){

    try{

        $db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306","lvanden","hmb2021");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_POST['pseudo']) && isset($_POST['password'])){

            $pseudo = $_POST['pseudo'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];

                $password = password_hash($password,  PASSWORD_BCRYPT);
                $longueurKey = 15;
                for($i=0;$i<$longueurKey;$i++){
                    $key .=mt_rand(0,9);
                }

                $longueurtoken = 24;
                for($i=0;$i<$longueurtoken;$i++){
                    $token .=mt_rand(0,9);
                }

                $slogan_id = rand(1,11);

                $sqlSlogan = "SELECT * FROM slogans WHERE id = ?";
                $reqSlogan = $db->prepare($sqlSlogan);
                $reqSlogan->execute(array($slogan_id));
                $data = $reqSlogan->fetch();
                $slogan = $data["phrase"];

                $sql = "INSERT INTO utilisateur (pseudo,mail,password,confirmation_key,token,slogan) VALUES (?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($pseudo,$mail,$password,$key,$token,$slogan));
                
                mailconfirm($pseudo,$key,$mail);

                echo "<script>
                        alert('Création de compte réussie, merci de consulter vos mails afin de vérifier votre compte');
                        window.location.href='https://erwannlbdevweb.alwaysdata.net/hmb/index.php';
                    </script>";


        }

    }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }

}

function mailConfirm($pseudo,$key,$mail){
    $header="MIME-Version: 1.0\r\n";
    $header.='From:"Hold My Beer"<holdmybeerdwa@gmail.com>'."\n";
    $header.='Content-Type:text/html; charset="utf-8"'."\n";
    $header .='Content-Transfer-Encoding: 8bit';

    $message='
    <html>
        <body>
            <div>
            <img src="images/logo_3.png">
            <br/>
            Bonjour '.$pseudo.' , veuillez confirmer votre inscription sur Hold My Beer en cliquant sur le lien suivant:
            <br/>
            <a href="https://erwannlbdevweb.alwaysdata.net/hmb/confirmation.php?pseudo='.$pseudo.'&key='.$key.'">Cliquez ici</a>
            </div>
        </body>
    </html>
    ';
    mail($mail,"Confirmation de votre compte",$message,$header);
}

?>
