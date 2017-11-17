var compt_answer = 1;

function add_answer(){
	$("#nb_champ").val(compt_answer);
	var champ = "<br><input type='text' placeholder='Intitulé' name='input" + compt_answer + "'>";
	var act_div = $("#content_answer").html();
	$("#content_answer").html(act_div + champ);
	compt_answer ++;
}

function getChoice(){
	var act_choice = $('select').val();
	if(act_choice == 1){
		$('#input_step').css('display', 'block');
		$('#final_step').css('display', 'none');
	}
	else if(act_choice == 2){
		$('#label_answer').text("Question à choix unique. Cliquez sur le bouton + pour ajouter une réponse puis sur Enregistrer pour terminer");
		$('#final_step').css('display', 'block');
		$('#input_step').css('display', 'none');
	}
	else if(act_choice == 3){
		$('#label_answer').text("Question à choix multiple. Cliquez sur le bouton + pour ajouter une réponse puis sur Enregistrer pour terminer");
		$('#final_step').css('display', 'block');
	}
	compt_answer = 1;
}