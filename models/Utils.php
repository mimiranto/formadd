<?php
namespace Models;

class Utils{

  public static function helloWorld(){
    echo "Hello world !";
  }

  public static function returnDatetime(string $date): \Datetime{
    $date = new \Datetime($date);
    return $date;
  }

  public static function launchException(string $message){
    throw new \Exception($message);
  }

  public static function readException(\Exception $e){
    die("Exception : ". $e->getMessage());
  }

}