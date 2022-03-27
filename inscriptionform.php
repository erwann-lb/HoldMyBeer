<?php
  $title="Inscription";
  require_once "./include/functions.inc.php";
  require "./include/header.inc.php";
?>
<div class="center">
<div class="loginForm">
    <h1>Inscription</h1>
	<form method="POST" action="inscription.php">

    <div class="text_field" id="text_field_pseudo">
			<input type="text" id="pseudoinput" name="pseudo" required="required"/>
			<label>Identifiant</label>
		</div>

    <div class="text_field" id="text_field_mail">
			<input type="email" id="mailinput" name="mail" required="required"/>
			<label>E-Mail</label>
		</div>

    <div class="text_field" id="text_field_password">
			<input type="password" id="password" name="password" required="required"/>
			<label>Mot de passe</label>
		</div>

    <div class="text_field" id="text_field_password_confirmation">
			<input type="password" id="passwordconfirmation" name="pass-retype" required="required"/>
			<label>Confirmation mot de passe</label>
		</div>

        <input type="submit" value="  S'inscrire  " id="register-btn" name ="inscriptionbtn"/>
		<div class="signup_link">
			Déjà inscrit ? <a href="./connexionform.php">Se connecter ici</a>
		</div>
	</form>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  var pseudoissue =0;
  var mailissue =0;
  var passwordissue =0;
$(document).ready(function(){

  $("#pseudoinput").keyup(function(){
    var pseudo = $('#pseudoinput').val();
    if(pseudo!=''){
     $.ajax({
        type:"POST",
        url:"inscriptioncheck.php",
        data:{"pseudo":pseudo},
        success:function(data){
          if(data.includes('pseudoExist')){
            pseudoissue=1;
            document.getElementById("text_field_pseudo").style.setProperty('border-color','red');
          }else{
            pseudoissue=0;
            document.getElementById("text_field_pseudo").style.setProperty('border-color','#adadad');
          }
        }
      });
    }
  });


  $("#mailinput").keyup(function(){
    var mail = $('#mailinput').val();
    if(mail!=''){
     $.ajax({
        type:"POST",
        url:"inscriptioncheck.php",
        data:{"mail":mail},
        success:function(data){
          if(data.includes('mailExist')){
            mailissue=1;
            document.getElementById("text_field_mail").style.setProperty('border-color','red');
          }else{
            mailissue=0;
            document.getElementById("text_field_mail").style.setProperty('border-color','#adadad');
          }
        }
      });
    }
  });


  $('#passwordconfirmation').change(function () {
    var pass = $('#password').val();
  if ($('#password').val() != $('#passwordconfirmation').val()) {
    passwordissue=1;
    document.getElementById("text_field_password_confirmation").style.setProperty('border-color','red');
  }else{
    passwordissue=0;
     document.getElementById("text_field_password_confirmation").style.setProperty('border-color','#adadad');
  }
});



  $("#pseudoinput").change(function(){
    if(pseudoissue==1){
      alert("Cet identifiant n'est pas disponible, veuillez en choisir un autre");
    }
  });


  $("#mailinput").change(function(){
    if(mailissue==1){
      alert("Cette adrese mail est déjà associée à un compte");
    }
  });


  $("#passwordconfirmation").change(function(){
    if(passwordissue==1){
      alert("Les deux mots de passe ne correspondent pas");
    }
  });

  document.querySelector("#register-btn").addEventListener("click", function(event) {
      if(passwordissue==1 || pseudoissue==1 || mailissue==1){
        document.getElementById("passwordconfirmation").value = "";
        alert("Merci de remplir le formulaire d'inscription avec des informations valides");
        event.preventDefault();
        if(pseudoissue==1){
          document.getElementById("pseudoinput").value = "";
        }
        if(mailissue==1){
          document.getElementById("mailinput").value = "";
        }
       }
  }, false);

});

</script>
<?php
  require "./include/footer.inc.php";
?>
