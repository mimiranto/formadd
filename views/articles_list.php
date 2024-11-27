<?php
    $headTitle = "Liste des Articles";

    

    if(!isset($articlesList) || !$articlesList){
        $mainContent = "Erreur 4.4 ";
        exit;
    }



    ob_start();
?>

<section>
    <h1>Liste des Articles</h1>
    <?php foreach($articlesList as $article): ?>
    <article>
    <h2><?= $article->title ?> - Par <?= $article->author ?></h2>
    <p>
        <?= $article->content ?>
    </p>
</article>
<?php endforeach; ?>
</section>

<?php

$mainContent = ob_end_flush();
