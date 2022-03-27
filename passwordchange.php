<?php
  $title="Connexion";
  require_once "./include/functions.inc.php";
  require "./include/header.inc.php";

  $db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306","lvanden","hmb2021");
  if(isset($_POST['u']) && !empty($_POST['u'])){
    $token = htmlspecialchars(base64_decode($_GET['u']));
    $check =$db->prepare("SELECT * FROM password_recover WHERE token_user = ?");
    $check->execute(array($token));
    $row = $check->rowCount();
    if($row==0){
      die();
    }
  }
?>
<div class="center">
<div class="loginForm">
  <h1>Mot de passe oublié</h1>
  <h3>Entrez votre adresse mail afin de réinitialiser le mot de passe</h3>

  <form method="POST" action="passwordchangepost.php">
    <input type="hidden" name="token" value="<?php echo base64_decode(htmlspecialchars($_GET["u"]));?>"/>
    <div class="text_field" id="text_field_password">
			<input type="password" id="password" name="password" required="required">
			<label>Mot de passe</label>
		</div>

    <div class="text_field" id="text_field_password_confirmation">
			<input type="password" id="passwordconfirmation" name="password_repeat" required="required">
			<label>Confirmation mot de passe</label>
		</div>
    <input type="submit" name="connexionbtn" value="Réinitialiser" id="login-btn"/>

    <div class="signup_link">
			La mémoire vous reviens ? <a href="./connexionform.php">Par ici</a>
		</div>
	</form>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
  require "./include/footer.inc.php";
?>
