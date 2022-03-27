<?php

    $db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306","lvanden","hmb2021");
    if(isset($_POST['email']) && !empty($_POST['email'])){
      $email = htmlspecialchars($_POST['email']);

      $check = $db->prepare("SELECT token,pseudo FROM utilisateur WHERE mail = ?");
      $check->execute(array($email));

      $data = $check->fetch();
      $pseudo = $data['pseudo'];
      $row= $check->rowCount();
      if($row){
        $longueurtoken = 24;
        for($i=0;$i<$longueurtoken;$i++){
            $token .=mt_rand(0,9);
        }
        $token_user = $data["token"];

        $insert = $db->prepare("INSERT INTO password_recover(token_user,token) VALUES(?,?)");
        $insert->execute(array($token_user,$token));

        $link ="https://erwannlbdevweb.alwaysdata.net/hmb/passwordrecover.php?u=".base64_encode($token_user)."&token=".base64_encode($token);

        //Envoi du mail

        $header="MIME-Version: 1.0\r\n";
        $header.='From:"Hold My Beer"<holdmybeerdwa@gmail.com>'."\n";
        $header.='Content-Type:text/html; charset="utf-8"'."\n";
        $header .='Content-Transfer-Encoding: 8bit';

        $message='
        <html>
            <body>
                <br/>
                Bonjour '.$pseudo.' , pour changer votre mot de passe, merci de cliquer sur le lien suivant :
                <br/>
                <a href='.$link.'>Par ici la magie</a>
                </div>
            </body>
        </html>
        ';
        mail($email,"Demande de changement de mot de passe",$message,$header);
        echo"<script>alert('mail envoyé à '.$email)</script>";
        header("Location:/hmb/index.php");
      }else{
        //compte non existant
        echo "compte non existant";

      }
    }else{
    }

?>
