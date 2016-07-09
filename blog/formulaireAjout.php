<?php

$connect = mysqli_connect("127.0.0.1", "root", "", "blogphp");

/* Vérification de la connexion */
if (!$connect) {
   echo "Échec de la connexion : ".mysqli_connect_error();
   exit();
}

$requete = "SELECT * FROM `category`";
$tabCategory = [];
if ($resultat = mysqli_query($connect,$requete)) {
        while ($ligne = mysqli_fetch_assoc($resultat)) {
             array_push ($tabCategory,$ligne);
        }
}

 ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
   <head>
      <title>Blog</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
<body>
   <h2>Nouvel article</h2>
   <form action="insertionArticle.php" method="POST" enctype="multipart/form-data">
      <p>Titre de l'article: <input type="text" name="title" /></p>
      <p>Categorie: <select name="category[]" multiple>
     <?php foreach ($tabCategory as $value) {
                echo "<option value=".$value['id'].">".$value['name']."</option>";
            }?>
        </select>
      </p>
      <p>Texte : <br /><textarea name="text" rows="10" cols="50"></textarea></p>
      <input type="submit" name="ok" value="Envoyer">
   </form>
   <br />
   <a href="blog.php" >blog</a>
</body>
</html>
