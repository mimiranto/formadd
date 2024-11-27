<?php

namespace Controllers;

use Models\Article;


class ArticlesController{

    public static function index() {
        self::$getList();
    
    }

    
    public static function getList(){
        $articlesList = Article::getList();
        require_once ROOT."/views/articles_list.php";
        require_once ROOT."/templates/global.php";
    }

   
    public static function showForm() {
        require_once ROOT . "/views/form_list.php"; 
    }

    public static function AddForm() {
        // Vérifie que les données ont été envoyées
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? null;
            $content = $_POST['content'] ?? null;
            $author = $_POST['author'] ?? null;

            // Ajoute l'article dans la base de données
            Article::add($title, $content, $author);

            // Redirection ou confirmation
            echo "Article ajouté avec succès !";
        } else {
            echo "erreur envoi";
        }
    }

   
}