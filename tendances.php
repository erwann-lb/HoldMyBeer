<?php
  $title="Bars Tendances";
  require_once "./include/functions.inc.php";
  require "./include/header.inc.php";
?>

<section>

    <div>
        <article id="details"></article>
        <h2 style="text-align: center; left: 0%; right: 0%;">Voici le top 10 des meilleurs bars selon les utilisateurs:</h2>
        <?php
            tendances();
        ?>
    </div>
    
</section>

<?php
    require "./include/footer.inc.php";
?>