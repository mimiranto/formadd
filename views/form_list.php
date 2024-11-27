<?php
    $headTitle = "Ajouter un article";
    ob_start();
?>

<section>
    <h1>Créer un article</h1>
    <form method="POST" action="/articles/ajouter">
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="content">Contenu :</label>
    <textarea id="content" name="content" required></textarea>
    <br>
    <label for="author">Auteur :</label>
    <input type="text" id="author" name="author" required>
    <br>
    <button type="submit">Ajouter l'article</button>
</form>

</section>

<?php
    $mainContent = ob_end_flush();
?>
