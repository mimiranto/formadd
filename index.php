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
use Controllers\ArticlesController ; 

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
  "title" => "Test1",
  "content" => "test test test ",
  "author" => "mimiranto"
];

/**
 * Ajout d'un article en base de données
 */
// $article::add(
//   $article_test["title"],
//   $article_test["content"],
//   $article_test["author"]
// );

//var_dump($article::getList());

// var_dump($article::getById(10));

// var_dump($article::getLast());

// $updated_article = [
//   "id" => 5,
//   "title" => "Test 5 mis à jour",
//   "content" => "Ce contenu a été mis à jour",
//   "author" => "MIMIRANTO",
//   "created_date" => new \Datetime("now")
// ];

// var_dump($article->update(
//   $updated_article["id"],
//   $updated_article["title"],
//   $updated_article["content"],
//   $updated_article["author"],
//   $updated_article["created_date"]->sub(\DateInterval::createFromDateString("1 hour"))->format("Y/m/d H:i:s"),
// ));

// var_dump($article::getById(5));

// var_dump($article::deleteAll());

// var_dump($article::deleteArticle(11));



// On instancie le routeur
$router = new Router();

$uri = $_SERVER["REQUEST_URI"];

switch (true) {
  case ($uri === "/"):
    $router->get("/", function () {
      echo "Page d'accueil";
    });
    break;
    case ($uri === "/articles"):
    $router->get("/articles", ArticlesController::getList());
    break;
    case (preg_match("/^\/articles\/(\d+)$/", $uri )):
    $router->get($uri, function (int $id) {
      if (!is_null($id)) {
        var_dump(Article::getById($id));
      }
    });
    break;
    case ($uri === "/articles/ajouter" && $_SERVER['REQUEST_METHOD'] === 'GET'):
      // Afficher le formulaire
      $router->get("/articles/ajouter", function () {
          ArticlesController::showForm();
      });
      break;
  
  case ($uri === "/articles/ajouter" && $_SERVER['REQUEST_METHOD'] === 'POST'):
      // Traiter le formulaire
      $router->post("/articles/ajouter", function () {
          ArticlesController::AddForm();
      });
      break;  
    default:
      echo "404";
      break;
}


$router->run();