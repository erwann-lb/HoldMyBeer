<?php

class Database{

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct($db_name, $db_user ='lvanden_erwann', $db_pass = '  ',$db_host = 'mysql-lvanden.alwaysdata.net' )
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    private function getPDO()
    {

        if($this->pdo === null)
        {
            $pdo = new PDO("mysql:host=mysql-lvanden.alwaysdata.net;dbname=lvanden_hmb2021;port=3306","lvanden_erwann","hmb2021");

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo = $pdo;
        }

        return $this->pdo;
    }

    public function query_boisson($str)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM bars WHERE boissons REGEXP ?");

        $req->execute(array(htmlspecialchars($str)));

        $datas = $req->fetchAll(PDO::FETCH_OBJ);

        return $datas;

    }

    public function query_barspage($str)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM bars WHERE id = ?");

        $req->execute(array(htmlspecialchars($str)));

        $datas = $req->fetchAll(PDO::FETCH_OBJ);

        return $datas;

    }

    public function query_test($str)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM bars WHERE boissons REGEXP ?");

        $req->execute(array(htmlspecialchars($str)));

        $datas = $req->fetchAll();

        return $datas;
    }

    public function insert_commentaire($pseudo, $texte , $date, $id_bar){

      $req = $this->getPDO()->prepare("INSERT INTO Commentaire (pseudo,texte,date,id_bar) VALUES (:pseudo,:texte,:date,:id_bar)");

      $req->execute(array(
 		  'pseudo' => $pseudo,
 		  'texte' => $texte,
 		  'date' => $date,
       'id_bar' => $id_bar));

    }

    public function print_comment($int){
      $req = $this->getPDO()->prepare("SELECT * FROM Commentaire where id_bar=?");

      $req->execute(array($int));

      $datas = $req->fetchAll(PDO::FETCH_OBJ);

      return $datas;
    }

    public function is_liked($pseudo,$id){
      //check si like
      $req = $this->getPDO()->prepare("SELECT * FROM utilisateur where pseudo=:pseudo and id_bar_favoris REGEXP :id_bar_favoris");
      $req->execute(array(
 		  'pseudo' => $pseudo,
      'id_bar_favoris' => $id));

      $count=$req->rowCount();

      if ($count > 0){
        return true;
      }
      else{
        return false;
      }
      return false;
    }

    public function likeBar($pseudo,$id){
      $req = $this->getPDO()->prepare("SELECT id_bar_favoris FROM utilisateur where pseudo=:pseudo");

      $req->execute(array(
 		  'pseudo' => $pseudo));

      $datas = $req->fetchAll();

      foreach($datas as $row){
        $tmp.=$row['id_bar_favoris'].'/'.$id;
      }
      
      $req2 = $this->getPDO()->prepare("UPDATE utilisateur SET id_bar_favoris=:id_bar_favoris WHERE pseudo = :pseudo");

      $req2->execute(array(
 		  'pseudo' => $pseudo,
      'id_bar_favoris' => $tmp));

      $req3 = $this->getPDO()->prepare("SELECT like_count from bars where id=:id");

      $req3->execute(array(
 		  'id' => $id
      ));

      $datas2 = $req3->fetchAll();

      foreach($datas2 as $row){
        $tmp2.=$row['like_count']+1;
      }

      $req4 = $this->getPDO()->prepare("UPDATE bars SET like_count=:like_count WHERE id = :id");

      $req4->execute(array(
      'like_count' => $tmp2,
      'id' => $id));

    }

    public function unlikeBar($pseudo,$id){

      $req = $this->getPDO()->prepare("SELECT id_bar_favoris FROM utilisateur where pseudo=:pseudo");

      $req->execute(array(
 		  'pseudo' => $pseudo));

      $datas = $req->fetchAll();

      foreach($datas as $row){
        $tmp=$row['id_bar_favoris'];
      }
      $trimmed = str_replace('/'.$id, '', $tmp);

      $req2 = $this->getPDO()->prepare("UPDATE utilisateur SET id_bar_favoris=:id_bar_favoris WHERE pseudo = :pseudo");

      $req2->execute(array(
 		  'pseudo' => $pseudo,
      'id_bar_favoris' => $trimmed));

      $req3 = $this->getPDO()->prepare("SELECT like_count from bars where id=:id");

      $req3->execute(array(
 		  'id' => $id
      ));

      $datas2 = $req3->fetchAll();

      foreach($datas2 as $row){
        $tmp2.=$row['like_count']-1;
      }

      $req4 = $this->getPDO()->prepare("UPDATE bars SET like_count=:like_count WHERE id = :id");

      $req4->execute(array(
      'like_count' => $tmp2,
      'id' => $id));
    }

    public function query_tendances(){
        $req = $this->getPDO()->prepare("SELECT * from bars order by like_count desc limit 10");

        $req->execute(array());

        $datas = $req->fetchAll(PDO::FETCH_OBJ);

        return $datas;

    }

    public function query_favorite_bars_by_users($pseudo){
      $req = $this->getPDO()->prepare("SELECT bars.id,pseudo,bars.nom,bars.site_web from bars,utilisateur WHERE utilisateur.id_bar_favoris REGEXP bars.id and utilisateur.pseudo = :pseudo");

      $req->execute(array(
        'pseudo' => $pseudo
      ));

      $datas = $req->fetchAll(PDO::FETCH_OBJ);

      return $datas;

  }

}
?>