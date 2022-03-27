<?php
  $title="Connexion";
  require_once "./include/functions.inc.php";
  require "./include/header.inc.php";
?>
<div class="center">
<div class="loginForm">
  <h1>Mot de passe oublié</h1>
  <h3>Entrez votre adresse mail afin de réinitialiser le mot de passe</h3>

  <form method="POST" action="passwordoublie.php">

    <div id="text_field_pseudo" class="text_field">
			<input type="text" id="identifiantconnection" name="email" required="required"/>
			<label>Adresse mail du compte</label>
		</div>

    <input type="submit" name="connexionbtn" value="Réinitialiser" id="login-btn"/>

    <div class="signup_link">
			La mémoire vous reviens ? <a href="./connexionform.php">Par ici</a>
		</div>
	</form>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
</script>

<?php
  require "./include/footer.inc.php";
?>
