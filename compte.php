<?php
$title = "Compte";
require_once "./include/functions.inc.php";
require "./include/header.inc.php";

$db = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306", "lvanden", "hmb2021");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
  $tailleMax = 2097152;
  $extensionValide = array('image/jpg', 'image/jpeg', 'image/png');
  if ($_FILES['avatar']['size'] <= $tailleMax) {
    $extensionUpload = $_FILES['avatar']['type'];
    if (in_array($extensionUpload, $extensionValide)) {
      $path = "avatars/" . $_SESSION['pseudo'] . "." . explode("/", $extensionUpload)[1];
      $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
      if ($resultat) {
        $updateavatar = $db->prepare('UPDATE utilisateur SET avatar = :avatar WHERE pseudo = :pseudo');
        $updateavatar->execute(array('avatar' => $_SESSION['pseudo'] . "." . explode("/", $extensionUpload)[1], ':pseudo' => $_SESSION['pseudo']));
      } else {
        echo "Une erreur est surnvenue.";
      }
    } else {
      echo "Le type de fichier n'est pas valide.";
    }
  } else {
    echo "Le fichier est trop volumineux.";
  }
}
?>

<section class="account" id="account">
  <div class="account-info" id="account-info">
    <h1>MON COMPTE</h1>
  </div>
</section>
<div class="row gutters-sm">
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center">

          <?php
          $pseudo = $_SESSION['pseudo'];
          $sqlAvatar = "SELECT * FROM utilisateur WHERE pseudo = ?";
          $resultAvatar = $db->prepare($sqlAvatar);
          $resultAvatar->execute(array($pseudo));
          $data = $resultAvatar->fetch();
          $slogan = $data["slogan"];
          if ($data["avatar"] == "") {
            echo "<img src='images/avatar.jpg' alt='Admin' class='avatar'/>";
          } else {
            echo "<img src='avatars/" . $data['avatar'] . "' alt='Admin' class='avatar'/>";
          }
          ?>
          <div class="mt-3">
            <?php
            echo "<h2 style='text-align:center'>" . $_SESSION['pseudo'] . "</h2>";
            echo "<p class='slogan'>" . $slogan . "</p>";
            ?>

            <br />
            <form method="POST" action="#" enctype="multipart/form-data">
              <input type="file" name="avatar" />
              <input type="submit" name="avatarSubmit" value="Changer la photo de profil" />
            </form>
            <form action="passwordoublieform.php">
              <button class="btnCompte">Changer le mot de passe</button>
            </form>
            <form action="deconnexion.php">
              <button class="btnCompte">Se déconnecter</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="card mb-3">
    </div>
  </div>

  <p class="text-secondary mb-1" style="text-align: center;">Vos bars favoris</p>
  <?php
  $db = new \Database('lvanden_hmb2021');
  foreach ($db->query_favorite_bars_by_users($_SESSION['pseudo']) as $post) :
    echo '<article class="leaderboard__profile">';
    echo '<span class="leaderboard__name">' . $post->nom . '</span>';
    echo '<span class="leaderboard__value"><a class=leaderboard__link href="barspage.php?id=' . $post->id . '">Plus d\'infos <i class="fas fa-eye"></i></a></span>';
    if (!empty($post->site_web)) {
      echo '<span class="leaderboard__value"><a class=leaderboard__link href="' . $post->site_web . '"><i class="fas fa-globe">Site</i></a></span>';
    }

    echo '</article>';
  endforeach;

  ?>


</div>





<?php
require "./include/footer.inc.php";
?>