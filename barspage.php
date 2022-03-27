<?php
$title = "Infos Bar";
require_once "./include/functions.inc.php";
require "./include/header.inc.php";
?>

<?php

$db = new \Database('lvanden_hmb2021');


if ((isset($_GET['id'])) && (!empty($_GET['id']))) {

  $id_bars = $_GET['id'];
  $liked = $db->is_liked($_SESSION['pseudo'], $_GET['id']);
  foreach ($db->query_barspage($id_bars) as $post) :

?>
    <section>
      <h1 style="color: var(--main-color);"><?php echo $post->nom; ?></h1>
      <h2 style="left: 0%; right: 0%; text-align: left;">Informations Générales</h2>

      <article class="infos-bar">
        <div class="affiche-bar">
          <figure>
            <img src="./images/logo_1.png" alt="Affiche Bar" style="max-width: 140px; max-height: 140px; border-radius: 30px;">
          </figure>
        </div>
        <div class="infos-text">
          <p>Boisssons : <?php echo $post->boissons; ?></p>
          <p>Téléphone :
            <?php
            if (!empty($post->telephone)) {
              echo $post->telephone;
            } else {
              echo "Pas de numéro de téléphone";
            }
            ?>
          </p>
          <a href="<?php echo $post->site_web; ?>">
            <p><?php echo $post->site_web; ?> </p>
          </a>
          <p>Horaire : <?php echo $post->horaire ?></p>
          <?php
          if (isset($_SESSION['pseudo'])) { // ajouter condition et n'a pas deja like
            if (!$liked) {
              echo '<form method="post">';
              echo '<button class="btn btn-like" type="submit" id="likeButton" name="likeButton">';
              echo '<span class="btn-icon btn--icon-default">';
              echo '<span class="fa fa-heart"></span>';
              echo '</span>';
              echo '<span class="btn-icon btn--icon-liked">';
              echo '<span class="fa fa-heart"></span>';
              echo '</span>';
              echo '<span class="btn-content  btn-content--liked"> Liked </span>';
              echo '<span class="btn-content btn-content--default"> Like </span>';
              echo '</button>';
              echo '</form>';
            }
            if ($liked) {
              echo '<form method="post">';
              echo '<button class="btn btn-like liked" type="submit" id="unlikeButton" name="unlikeButton">';
              echo '<span class="btn-icon btn--icon-default">';
              echo '<span class="fa fa-heart"></span>';
              echo '</span>';
              echo '<span class="btn-icon btn--icon-liked">';
              echo '<span class="fa fa-heart"></span>';
              echo '</span>';
              echo '<span class="btn-content  btn-content--liked"> Liked </span>';
              echo '<span class="btn-content btn-content--default"> Like </span>';
              echo '</button>';
              echo '</form>';
            }
          }
          ?>

        </div>
      </article>
    </section>

<?php
  endforeach;
}



?>

<?php

if (isset($_POST['likeButton'])) {
  $db->likeBar($_SESSION['pseudo'], $_GET['id']);
  echo "<script type='text/javascript'>window.top.location='barspage.php?id={$id_bars}';</script>";
  exit;
}

if (isset($_POST['unlikeButton'])) {
  $db->unlikeBar($_SESSION['pseudo'], $_GET['id']);
  echo "<script type='text/javascript'>window.top.location='barspage.php?id={$id_bars}';</script>";
  exit;
}


if (isset($_POST['commentArea'])) {
  if (!empty($_POST['commentArea'])) {
    $pseudo = $_SESSION['pseudo'];
    $texte =  htmlspecialchars($_POST['commentArea']);
    $date = date("Y-m-d H:i:s");
    $db->insert_commentaire($pseudo, $texte, $date, intval($_GET['id']));
  }
}


foreach ($db->print_comment(intval($_GET['id'])) as $post) :
  echo '<div class="comment-box">';
  echo '<div class="comment-head">';
  echo '<h6 class="comment-name by-author">' . $post->pseudo . '</h6>';
  echo '<span>' . $post->date . '</span>';
  echo '</div>';
  echo '<div class="comment-content">' . $post->texte . '</div>';
  echo '</div>';
  echo '</div>';
endforeach;


if (isset($_SESSION['pseudo'])) {
  echo '<form method="post">';
  echo '<div>';
  echo '<label class="commentLabel" for="comment">Laisser un commentaire :</label><br>';
  echo '<textarea id="commentArea" class="commentArea" name="commentArea"></textarea><br>';
  echo '<input type="submit" class="commentButton" id="commentButton" name="commentButton" value="Envoyer">';
  echo '</div>';
  echo '</form>';
}
?>

<?php
require "./include/footer.inc.php";
?>