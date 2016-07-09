<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
   <head>
      <title>Blog</title>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
   </head>
<body>
<?php
$connect = mysqli_connect("127.0.0.1", "root", "", "blogphp");

/* Vérification de la connexion */
if (!$connect) {
   echo "Échec de la connexion : ".mysqli_connect_error();
   exit();
}

$requete = "INSERT INTO `article` (`id`, `title`, `date`, `text`, `author`) VALUES (NULL,'".htmlentities(addslashes($_POST['title']), ENT_QUOTES)."','".date("Y-m-d")."','".htmlentities (addslashes($_POST['text']), ENT_QUOTES)."', 1)";
$resultat = mysqli_query($connect,$requete);
$identifiant = mysqli_insert_id($connect);
/* Fermeture de la connexion */


if ($identifiant != 0) {
   echo "<br />Ajout du commentaire réussi.<br /><br />";
}
else {
   echo "<br />Le commentaire n'a pas pu être ajouté.<br /><br />";
}



$requete = "INSERT INTO `articlecategory` (`fk_idArticle`, `fk_idCategory`) VALUES ";

foreach ($_POST['category'] as $selectedOption)
    $requete .="('".$identifiant."', '".$selectedOption."'),";

$requete[strlen($requete)-1]=';';
echo $requete;

$resultat = mysqli_query($connect,$requete);
/* Fermeture de la connexion */
mysqli_close($connect);


?>
<a href="formulaireAjout.php" >retour à la page d'ajout d'articles</a>
</body>
</html>
