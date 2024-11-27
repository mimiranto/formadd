<?php

namespace Models;
use \Datetime;
use \PDO;
use \Exception;

class Article{

  protected int $id;
  protected string $title;
  protected string $content;
  protected string $author;
  protected string $created_date;
  protected string $modification_date;
  private static $bdd;

  public function __construct($bdd = null){
    if(!is_null($bdd)){
      self::setBdd($bdd);
    }
  }

  public static function getId(): int{
    return self::$id;
  }

  public static function setId(int $id){
    self::$id = $id;
  }

  public static function getTitle(): string{
    return self::$title;
  }

  public static function setTitle(string $title){
    self::$title = $title;
  }

  public static function getContent(): string{
    return self::$content;
  }

  public static function setContent(string $content){
    self::$content = $content;
  }

  public static function getCreatedDate(): Datetime{
    return Utils::returnDatetime(self::$created_date);
  }

  public static function setCreatedDate(string $created_date){
    self::$created_date = $created_date;
  }

  public static function getModificationDate(): Datetime{
    return Utils::returnDatetime(self::$modification_date);
  }

  public static function setModificationDate(string $modification_date){
    self::$modification_date = $modification_date;
  }

  public static function add(
    string $title,
    string $content,
    string $author
  ){
    try{
      $req = self::$bdd->prepare("INSERT INTO articles(title, content, author) VALUES(:title, :content, :author)");
      $req->bindValue(":title", $title, PDO::PARAM_STR);
      $req->bindValue(":content", $content, PDO::PARAM_STR);
      $req->bindValue(":author", $author, PDO::PARAM_STR);
  
      if(!$req->execute()){
        throw new Exception("Une erreur s'est produite lors de l'ajout d'un article à la table.");
      }
    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function getList(){
    try{
      $req = self::$bdd->prepare("SELECT * FROM articles ORDER BY id ASC");

      if(!$req->execute()){
        Utils::launchException("Une erreur s'est produite lors de la récupération de la liste des articles");
      }

      $datas = $req->fetchAll(PDO::FETCH_OBJ);
      $req->closeCursor();

      if(!$datas){
        Utils::launchException("La liste des articles est vide.");
      }

      return $datas;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function getById(int $id){
    try{

      $req = self::$bdd->prepare("SELECT * FROM articles WHERE id=:id");
      $req->bindValue(":id", $id, PDO::PARAM_INT);

      if(!$req->execute()){
        Utils::launchException("Une erreur s'est produite lors de la récupération de l'article.");
      }

      $article = $req->fetch(PDO::FETCH_OBJ);

      if(!$article){
        Utils::launchException("L'article ciblé est introuvable.");
      }

      return $article;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function getFirst(){
    try{
      $req = self::$bdd->prepare("SELECT * FROM articles ORDER BY id ASC LIMIT 1");

      if(!$req->execute()){
        Utils::launchException("Erreur lors de la tentative de retour du premier article de la table.");
      }

      $article = $req->fetch(PDO::FETCH_OBJ);

      if(!$article){
        Utils::launchException("Retour du premier article de la table articles impossible.");
      }

      return $article;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function getLast(){
    try{
      $req = self::$bdd->prepare("SELECT * from articles ORDER BY id DESC LIMIT 1");

      if(!$req->execute()){
        Utils::launchException("Erreur lors de la tentative de retour du dernier article.");
      }

      $article = $req->fetch(PDO::FETCH_OBJ);

      if(!$article){
        Utils::launchException("Retour du dernier article de la table articles impossible.");
      }

      return $article;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function update(
    int $id,
    string $title,
    string $content,
    string $author,
    string $created_date
  ){
    try{
      
      $req = self::$bdd->prepare("UPDATE articles SET title=:title, content=:content, author=:author, created_date=:created_date, modification_date=NOW() WHERE id=:id");
      $req->bindValue(":id", $id, PDO::PARAM_INT);
      $req->bindValue(":title", $title, PDO::PARAM_STR);
      $req->bindValue(":content", $content, PDO::PARAM_STR);
      $req->bindValue(":author", $author, PDO::PARAM_STR);
      $req->bindValue(":created_date", $created_date, PDO::PARAM_STR);

      if(!$req->execute()){
        Utils::launchException("Une erreur s'est produite lors de la mise à jour de l'article");
      }

      return true;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function updateTitle(int $id, string $title){
    try{
      
      $req = self::$bdd->prepare("UPDATE articles SET title=:title WHERE id=:id");
      $req->bindValue(":id", $id, PDO::PARAM_INT);
      $req->bindValue(":title", $title, PDO::PARAM_STR);

      if(!$req->execute()){
        Utils::launchException("Une erreur s'est produite lors de la mise à jour du titre de l'article");
      }

      return true;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function updateContent(int $id, string $content){
    try{
      
      $req = self::$bdd->prepare("UPDATE articles SET content=:content WHERE id=:id");
      $req->bindValue(":id", $id, PDO::PARAM_INT);
      $req->bindValue(":content", $content, PDO::PARAM_STR);

      if(!$req->execute()){
        Utils::launchException("Une erreur s'est produite lors de la mise à jour du contenu de l'article");
      }

      return true;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function updateAuthor(int $id, string $author){
    try{
      
      $req = self::$bdd->prepare("UPDATE articles SET author=:author WHERE id=:id");
      $req->bindValue(":id", $id, PDO::PARAM_INT);
      $req->bindValue(":author", $author, PDO::PARAM_STR);

      if(!$req->execute()){
        Utils::launchException("Une erreur s'est produite lors de la mise à jour de l'auteur de l'article");
      }

      return true;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function updateCreatedDate(int $id, string $created_date){
    try{
      
      $req = self::$bdd->prepare("UPDATE articles SET created_date=:created_date WHERE id=:id");
      $req->bindValue(":id", $id, PDO::PARAM_INT);
      $req->bindValue(":created_date", $created_date, PDO::PARAM_STR);

      if(!$req->execute()){
        Utils::launchException("Une erreur s'est produite lors de la mise à jour de la date de création de l'article");
      }

      return true;

    }catch(Exception $e){
      Utils::readException($e);
    }
  }

  public static function deleteAll(){
    return self::$bdd->exec("DELETE FROM articles");
  }

  public static function deleteArticle(int $id){
    return self::$bdd->exec("DELETE FROM articles WHERE id=$id");
  }

  public static function setBdd($bdd){
    self::$bdd = $bdd;
  }

}