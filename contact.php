<?php
$title = "Contact";
require_once "./include/functions.inc.php";
require "./include/header.inc.php";
?>
<section class="contact">
  <div class="container">
    <div class="contactForm">
      <form action="./mailSent.php" method="post">
        <h2>Contactez nous</h2>
        <div class="content">
          <input id="nom" type="text" name="nom" required="required" />
          <span>Nom</span>
        </div>

        <div class="content">
          <input id="prenom" type="text" name="prenom" required="required" />
          <span>Prénom</span>
        </div>

        <div class="content">
          <input id="email" type="email" name="email" required="required" />
          <span>E-mail</span>
        </div>
        <div class="content">
          <textarea id="message" required="required" name="message"></textarea>
          <span>Entrez votre message ...</span>
        </div>
        <div class="content">
          <input type="submit" onclick="sendEMail()" value="Envoyer" />
        </div>
      </form>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
  function sendEmail() {
    var nom = $("#nom");
    var email = $("#email");
    var objet = $("#objet");
    var message = $("#message");

    if (nom != '' && email != '' && message != '') {
      $.ajax({
        url: "sendEmail.php",
        method: 'POST',
        dataType: 'json',
        data: {
          nom: nom.val(),
          email: email.val(),
          objet: objet.val(),
          message: message.val(),
        },
        success: function(reponse) {
          $('#formMail')[0].reset();
        }
      })
    }
  }
</script>
</main>
</body>

</html>