<?php
use Models\Autoloader;
/**
 * On ajoute le timezone pour éviter un décalage horaire sur la manipulation des dates (exemple : DateInterval = H-1)
 */
ini_set("date.timezone", "Europe/Paris");

/**
 * Requires
 */
require_once "./utils/Defines.php";
require_once "./models/Autoloader.php";
/**
 * use Autoloader to autoload all models
 */
Autoloader::register();
/**
 * use Models
 */
use Models\BDD;
use Models\Utils;
use Models\Article;

use Models\Router;

// spl_autoload_register(function ($class) {
//   $class = ucfirst($class);
//   $class = str_replace("\\", "/", $class);
//   $class_path = ROOT . "/{$class}.php";
//   if (file_exists($class_path)) {
//     require_once $class_path;
//   }
// });

$article = new Article(BDD::connect());

$article_test = [
  "title" => "Test",
  "content" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam qui reprehenderit deserunt dolorem praesentium, autem nihil dolorum officiis officia, ab accusantium cum labore, soluta natus iusto incidunt distinctio minus error?",
  "author" => "webdevoo"
];

/**
 * Ajout d'un article en base de données
 */
// $article::add(
//   $article_test["title"],
//   $article_test["content"],
//   $article_test["author"]
// );

// var_dump($article::getList());

// var_dump($article::getById(9));

// var_dump($article::getLast());

$updated_article = [
  "id" => 9,
  "title" => "Test mis à jour",
  "content" => "Ce contenu a été mis à jour",
  "author" => "WebdevooUpdated",
  "created_date" => new \Datetime("now")
];

// var_dump($article->update(
//   $updated_article["id"],
//   $updated_article["title"],
//   $updated_article["content"],
//   $updated_article["author"],
//   $updated_article["created_date"]->sub(\DateInterval::createFromDateString("1 hour"))->format("Y/m/d H:i:s"),
// ));

// var_dump($article::getById(9));

// var_dump($article::deleteAll());

// var_dump($article::deleteArticle(11));

Utils::helloWorld();

// On instancie le routeur
$router = new Router();

// On définit les routes
$router->get("/", function(){
  echo "Page d'accueil";
});

$router->get("/articles", function(){
  Article::getList();
});

$router->get('/articles/:id', function(int $id){
  if(!is_null($id)){
    Article::getById($id);
  }
});

// On exécute le routeur, sinon il ne fonctionnera pas 😶‍🌫️
$router->run();