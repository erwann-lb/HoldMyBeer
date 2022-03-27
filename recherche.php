<?php
  $title="Recherche";
  require_once "./include/functions.inc.php";
  require "./include/header.inc.php";
?>

<section>

    <div class="searchBar">
        <form id="search-form" method="post" action="./recherche.php">
          <input id ="search-input" type="text" name="search" placeholder="Rechercher une boisson">
          <input id ="search-submit" type="submit" name="submit">
        </form>
    </div>

    <div>
        <article id="details"></article>
        <h2 style="text-align: center; left: 0%; right: 0%;">Résultat de la recherche pour "<?php echo htmlspecialchars($_POST["search"])?>"</h2>
        <?php
            recherche_biere(htmlspecialchars($_POST['submit']));
        ?>
    </div>
    
</section>

<?php
    require "./include/footer.inc.php";
?>