<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
   <head>
      <title>Blog</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
<body>
   <h2>Blog</h2>
   <hr />
   <?php
   $connect = mysqli_connect("127.0.0.1", "root", "", "blogphp");

   /* Vérification de la connexion */
   if (!$connect) {
      echo "Échec de la connexion : ".mysqli_connect_error();
      exit();
   }

   $requete = "SELECT * FROM article,articlecategory,category where article.id = articlecategory.fk_idArticle and category.id = articlecategory.fk_idCategory and category.name = 'jeux' ORDER BY Date";
   if ($resultat = mysqli_query($connect,$requete)) {
      date_default_timezone_set('Europe/Paris');
      /* fetch le tableau associatif */
      while ($ligne = mysqli_fetch_assoc($resultat)) {
        $dt_debut = date_create_from_format('Y-m-d', $ligne['date']);
        echo "<h3>".$ligne['title']."</h3>";
        echo "<h4>Le ".$dt_debut->format('d/m/Y')."</h4>";
        echo "<div style='width:400px'>";
        $html = html_entity_decode($ligne['text']);
        echo $html;
        echo " </div>";
        echo "<hr />";
      }
   }
   ?>
   <br />
   <a href="formulaireAjout.php" >retour à la page d'insertion</a>
</body>
</html>
