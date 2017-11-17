<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Afficher les erreurs et les avertissements
error_reporting(E_ALL);

// try
// {
//     $bdd = new PDO('mysql:host=;dbname=ordiassi_quizz;charset=utf8', 'ordiassi_admin', 'Kfixwoax68');
// }
// catch (Exception $e)
// {
//     die('Erreur : ' . $e->getMessage());
// }

try
{
    $bdd = new PDO('mysql:host=;bdname=quizz_bdd;charset=utf8', 'root', 'kfixwoax');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if(@$_POST['title_question']){
	$type_question = $_POST['type_question'];
	$nb_champ = $_POST['nb_champ'];
	$title = $_POST['title_question'];


	$req_question = $bdd->prepare("INSERT INTO Questions (text_question, type_question, level_question) VALUES (:text_question, :type_question, :level_question)");
	$req_question->bindParam(":text_question", $title, PDO::PARAM_STR);
	$req_question->bindParam(":type_question", $type_question, PDO::PARAM_INT);
	$req_question->bindParam(":level_question", $_POST['level'], PDO::PARAM_INT);
	$req_question->execute();

	$id_question = $bdd->lastInsertId();

	if($type_question == 2){
		for ($i=1; $i <= $nb_champ; $i++) {
			if($i == $_POST['num_success']){
				$value_success = 1;
			}
			else{
				$value_success = 0;
			}
			$act_var = "input".$i;
			$act_champ = $_POST[$act_var];
			$req_reponse = $bdd->prepare("INSERT INTO Reponses (text_reponse, success_reponse, id_question) VALUES (:text_reponse, :success_reponse, :id_question)");
			$req_reponse->bindParam(":text_reponse", $act_champ, PDO::PARAM_STR);
			$req_reponse->bindParam(":success_reponse", $value_success, PDO::PARAM_INT);
			$req_reponse->bindParam(":id_question", $id_question, PDO::PARAM_INT);
			$req_reponse->execute();
		}
	}
	else{
		$value_success = 1;
		$req_reponse = $bdd->prepare("INSERT INTO Reponses (text_reponse, success_reponse, id_question) VALUES (:text_reponse, :success_reponse, :id_question)");
		$req_reponse->bindParam(":text_reponse", $_POST['champ_rep'], PDO::PARAM_STR);
		$req_reponse->bindParam(":success_reponse", $value_success, PDO::PARAM_INT);
		$req_reponse->bindParam(":id_question", $id_question, PDO::PARAM_INT);
		$req_reponse->execute();
	}
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Ajout questions</title>
    <style type="text/css">
    	.button{
    		border: 1px solid #2F2F2F;
    		padding: 3px;
    		width: 13px;
    		margin-top: 10px;
    		cursor: pointer;
    	}
    	#final_step{
    		display: none;
    	}
    </style>
</head>

<body>
<form method="post" action="index.php">
	<label>Intitulé de la question</label><br/>
	<input type="text" name="title_question" placeholder="Intitulé de la question"/>
	<br><br>
	<label>Difficulté</label>
	<input type="number" name="level" style="width:40px;"/>
	<input type="hidden" id="nb_champ" name="nb_champ" value="0"/>
	<br><br>

	<label>Type de question</label><br/>
	<select id="select" name="type_question">
	  <option value="1">Avec champ de réponse</option> 
	  <option value="2">Avec choix unique</option>
	</select>
	<span class="button" onclick="getChoice()">Validé</span>
	<br><br>

	<div id="input_step" style="display: none;">
		<label>Remplissez la réponse et enregistrez</label><br>
		<input type="text" name="champ_rep"/><br><br>
		<input type="submit" name="Enregistrer"/>
	</div>

	<div id="final_step">
		<label id="label_answer"></label>
		<br>
		<div id="button_plus" class="button" onclick="add_answer()">+</div><br>
		<div id="nb_rep">
			<label>Bonne réponse</label>
			<input type="number" name="num_success" style="width:40px;"/><br>
		</div>
		<div id="content_answer"></div>
		<br><br>
		<input type="submit" name="Enregistrer"/>
	</div>
</form>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="js/form_inscription.js"></script><script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</body>
</html>
