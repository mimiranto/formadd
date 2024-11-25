<?php

namespace Models;

class User{

  protected $id;
  protected $pseudo;
  protected $password;
  protected $inscription_date;
  private static $bdd;

  public function __construct($bdd = null){
    if(!is_null($bdd)){
      self::setBdd($bdd);
    }
  }

  public static function getId():int{
    return self::$id;
  }

  public static function setId(int $id){
    self::$id = $id;
  }

  public static function getPseudo():string{
    return self::$pseudo;
  }

  public static function setPseudo(string $pseudo){
    self::$pseudo = $pseudo;
  }

  private static function getPassword():string{
    return self::$password;
  }

  private static function hashPassword(string $password):string{
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $password = null;
    return $hash_password;
  }

  public static function setPassword(string $password){
    self::hashPassword($password);
  }

  public static function getInscriptionDate(){
    Utils::returnDatetime(self::$inscription_date);
  }

  public static function setInscriptionDate(string $inscription_date){
    self::$inscription_date = $inscription_date;
  }

  public static function setBdd($bdd){
    self::$bdd = $bdd;
  }

}