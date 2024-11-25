<?php

namespace Models;

class Autoloader
{
  static function register()
  {
    /**
     * On enregistre toutes les classes grâce à l'autoloader.
     */
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  static function autoload($class)
  {
    /**
     * On configure le chemin de chargement de nos classes (ici, les models)
     */
    if (strpos($class, __NAMESPACE__ . '\\') === 0) {
      $class = str_replace(__NAMESPACE__ . '\\', '', $class);
      // Remplacer les anti-slashes par des slashes si on travaille sous UNIX
      //$class = str_replace('\\', '/', $class);
      require_once ROOT . "/models/$class.php";
    }
  }
}