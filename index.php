<?php
  $title="Accueil";
  require_once "./include/functions.inc.php";
  require "./include/header.inc.php";
?>

    <section class="home" id="home">
      <div class="content">
        <h2 style="text-align: left; left: 0%; right: 0%; position: inherit;" >Let's beer up</h2>
        <p>
          Sur ce site, viens trouver à ta guise le bar ou la bière qui
          correspond à tes goûts et surtout ta soif !
        </p>

      </div>

      <div class="searchBar">
        <form id="search-form" method="post" action="./recherche.php">
          <input id ="search-input" type="text" name="search" placeholder="Rechercher une boisson">
          <input id ="search-submit" type="submit" name="submit">
        </form>
      </div>
    </section>

<?php
  require "./include/footer.inc.php";
?>
