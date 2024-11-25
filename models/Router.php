<?php

namespace Models;

class Router{

  private $routes = [];

  public function get($uri, $callback){
    $this->routes["GET"][$uri] = $callback;
  }

  public function post($uri, $callback){
    $this->routes["POST"][$uri] = $callback;
  }

  public function run(){
    /**
     * PHP_URL_PATH est une constante prédéfinie en PHP qui est utilisée avec la fonction parse_url() pour extraire spécifiquement la partie chemin (pensez aux endpoints API) d'une URL.
     * $url = 'https://www.exemple.com/articles/123/titre-de-larticle';
     * $chemin = parse_url($url, PHP_URL_PATH);
     * echo $chemin; // Affichera : /articles/123/titre-de-larticle
     */
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    $method = $_SERVER["REQUEST_METHOD"];

    if(!isset($this->routes[$method][$uri])){
      echo "Page introuvable.";
      exit;  
    }

    call_user_func($this->routes[$method][$uri]);
  }

}