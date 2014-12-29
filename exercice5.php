<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta content="text/html;charset=UTF-8" http-equiv="Content-Type"/>
<title>Petit moteur de recherche</title> 
<link href="#" rel="stylesheet" type="text/css"/>
</head>
<body>

<form action="exercice5.php" method="post">
<p><label>Tapez un nom de ville ou une partie :</label><input type="text" name="recherche"/></p>
<p><input type="submit" name="valider" value="Valider"/></p>
</form>

<?php 
if (!empty($_POST['recherche']))
	{
		try {
		$bdd = new PDO ('mysql:host=localhost; dbname=projet_villes','root','');
		}
		catch (Exception $e)
		{
		die ('Erreur: '.$e->getMessage());
		}
		$result = $bdd -> prepare('SELECT population, villes_nom FROM villes WHERE villes_nom LIKE ?') or die (print_r($bdd->errorInfo()));
		$result -> execute (array('%'.$_POST['recherche'].'%'));
		
		while ($row = $result -> fetch())
		{
		echo $row['villes_nom'].' a une population de '.$row ['population'];
		}
		
		$result-> closeCursor();
		
	}
else 
{
echo 'Veuillez saisir votre recherche !';
}


?>
</body>
</html>