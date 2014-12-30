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

//on vérifie si la variable existe et n'est pas nulle		
if (isset ($_POST['recherche']) AND $_POST['recherche'] != NULL)
	{
	    try {
		$bdd = new PDO ('mysql:host=localhost; dbname=projet_villes','root','');
		}
		catch (Exception $e)
		{
		die ('Erreur: '.$e->getMessage());
		}
		
		$recherche = htmlspecialchars($_POST['recherche']);//Evite les injection XSS
		
		$result = $bdd -> prepare('SELECT population, villes_nom FROM villes WHERE villes_nom LIKE ?') or die (print_r($bdd->errorInfo()));
		$result -> execute (array('%'.$recherche.'%'));
		$count = $result ->rowCount(); //méthode qui compte le nb de lignes (marche av execute)
		
		if ($count >0) 
			{
				while ($row = $result -> fetch())
				{
			
				?><p><?php echo $row['villes_nom'].' a une population de '.$row ['population']. '.';?></p>
		
				<?php
		$result-> closeCursor();
				}
			}
		else
		{
		echo 'Aucun résultat ne correspond.';
		}
	}

else 
{
echo 'Veuillez saisir votre recherche !';
}


?>
</body>
</html>