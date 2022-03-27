<?php
  $title="Connexion";
  require_once "./include/functions.inc.php";
  require "./include/header.inc.php";
?>
<div class="center">
<div class="loginForm">
  <h1>Connexion</h1>

  <form method="POST" action="connexion.php">

    <div id="text_field_pseudo" class="text_field">
			<input type="text" id="identifiantconnection" name="identifiant" required="required"/>
			<label>Identifiant</label>
		</div>

    <div id="text_field_password" class="text_field">
			<input type="password" id="passwordconnection" name="password" required="required"/>
			<label>Mot de passe</label>
		</div>

    <div class="pass">
      <a href="./passwordoublieform.php">Mot de passe oublié ?</a>
    </div>

    <input type="submit" name="connexionbtn" value="Se connecter" id="login-btn"/>

    <div class="signup_link">
			Pas encore inscrit ? <a href="./inscriptionform.php">S'incrire ici</a>
		</div>
	</form>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){

    $("#identifiantconnection").keyup(function(){
      var identifiant = $('#identifiantconnection').val();
      var password = $('#passwordconnection').val();
      if(identifiant!='' && password!=''){
        $.ajax({
          type:"POST",
          url:"connexioncheck.php",
          data:{"identifiant":identifiant,"password":password},
          success:function(data){
            if(data.includes('notverified')){
              correct=1;
            }else if(data.includes('wrong')){
              correct=2;
            }else{
              correct=0;
            }
          }
        });
      }
    });

    $("#passwordconnection").keyup(function(){
      var identifiant = $('#identifiantconnection').val();
      var password = $('#passwordconnection').val();
      if(identifiant!='' && password!=''){
        $.ajax({
          type:"POST",
          url:"connexioncheck.php",
          data:{"identifiant":identifiant,"password":password},
          success:function(data){
            if(data.includes('notverified')){
              correct=1;
            }else if(data.includes('wrong')){
              correct=2;
            }else{
              correct=0;
            }
          }
        });
      }
    });

    document.querySelector("#login-btn").addEventListener("click", function(event) {
      if(correct==1){
        document.getElementById("passwordconnection").value = "";
        alert("Veuillez vérifier votre compte avant de pouvoir vous connecter");
        event.preventDefault();
      }else if(correct==2){
        document.getElementById("passwordconnection").value = "";
        alert("Identifiant ou mot de passe incorrect");
        event.preventDefault();
      }
  }, false);


  });



</script>

<?php
  require "./include/footer.inc.php";
?>
