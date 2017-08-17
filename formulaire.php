<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Pour faire la connexion entre le fichier de code ci-présent et la base de donnée phpmyadmin

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=todolistsql;charset=utf8', 'root', 'user');
	// echo "la connexion avec la bdd fonctionne";

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
        // echo 'la connexion  avec la bdd ne fonctionne PAS !!';
}
	if(isset($_POST["envoyerTodo"])) {
					$tache = $_POST["todo"];
					$insert = $bdd->query(
					"INSERT INTO tabletodolist 
						(tache,etat) 
					VALUES 
						('$tache', 'todo')");
				
	

				 }
	if(isset($_POST["envoyerDone"])) {

	if(!empty($_POST['done'])){

		foreach($_POST['done'] as $checked){
	           
          $update = $bdd->query(
          	"UPDATE tabletodolist 
				set etat='done'
			WHERE tache='$checked'");
			} 
        }


	
			 }

				

?>




<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1> TO DO LIST</h1>
		<h4> by Safia </h4>
		<h2> Liste de choses à faire avant de mourir: </h2>
		<form method="post" action="formulaire.php">
			<?php 

			$select_todo = $bdd->query("SELECT * FROM tabletodolist WHERE etat='todo'");
			while (($ligne_todo = $select_todo->fetch() )!== false) {
			if(!empty($ligne_todo["tache"])){
					
				 		echo '<input type="checkbox" name="done[]" value="' . $ligne_todo['tache'] . '">'. $ligne_todo['tache'] . '</br>';
					
			 } 
				 }
			?>

			<input type="submit" name="envoyerDone" value="cocher et valider choses faites">
		</form>
		<form method="post" action="formulaire.php">
			<p> Ecris ci-dessous une tache/mission que tu aimerais bien faire avant de crevee. La vie est courte, veux-tu apprendre la guitare? Devenir peintre cubiste? sortir un album de rap? Apprendre la programmation informatique ? Ecris tout ce que tu veux ici </p>	
			<input type="text" name="todo" value="" placeholder="Ecrire tache ici">  
			<input type="submit" name="envoyerTodo" value="Créer nouvelle tache">
			<h2> Trucs déjà faits de la liste :</h2>
			<?php
			// $done = $_POST['done'];
			// print_r($done);
			
			$select_done = $bdd->query("SELECT * FROM tabletodolist WHERE etat='done'");
			while (($ligne_done = $select_done->fetch() )!== false) {
				
			if(!empty($ligne_done["tache"])){
					
					
				 		echo '<div> <p class="barre"> <input type="checkbox" checked ="yes" disabled ="disabled">' . $ligne_done["tache"] . '</p> </div>';
				 		

			 } 
				 }
			
			




						 
						

			
					
			
			?>
		</form>
	</body>
</html>
