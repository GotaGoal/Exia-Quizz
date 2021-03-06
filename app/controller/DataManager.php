<?php 

/**
* Ronflex : Manager des questions avant envoi à la vue
*/
class DataManager
{
	private $bdd;
	private $view;
	private $final_tab;

	function __construct($bdd)
	{
		$this->bdd = $bdd;
		//$this->view = $view;
		// $data_tab = array_merge($this->getLvl(1), $this->getLvl(2));
		// $data_tab = array_merge($data_tab, $this->getLvl(3));
		$this->final_tab = array($this->getLvl(1), $this->getLvl(2), $this->getLvl(3));

	}

	function getTab()
    {
        return $this->final_tab;
    }
	private function getLvl($lvl){
		$compt = 0;
		$req = $this->bdd->prepare("SELECT * FROM Questions WHERE level_question = :lvl ORDER BY RAND()");
		$req->bindParam(":lvl", $lvl, PDO::PARAM_INT);
		$req->execute();
		$tab_lvl = null;

		while($rep = $req->fetch()){
			if($compt <= 4){
				$index = $compt;
				$type = $rep['type_question'];
				$diff = $rep['level_question'];
				$intitule = $rep['text_question'];
				$req2 = $this->bdd->prepare("SELECT * FROM Reponses WHERE id_question = :id_question ORDER BY RAND()");
				$req2->bindParam(":id_question", $rep['id_question'], PDO::PARAM_INT);
				$req2->execute();
                $compt_rep = 0;
                $response = null;
                while($rep2 = $req2->fetch()){
                    $compt_rep ++;
                    $response[] = $rep2['text_reponse'];
                    if($rep2['success_reponse'] == 1){
                        if($rep['type_question'] == 1){
                            $good = $rep2['text_reponse'];
                        }
                        else{
                            $good = $compt_rep;
                        }
                    }
                }
				// echo $index." / ".$type." / ".$diff." / ".$good." / ".$intitule." / ";
				// print_r($response)."<br>";
				$tab_quest = array(
					"index" => $index,
					"type" => $type,
					"difficulty" => $diff,
					"bonne_reponse" => $good,
					"intitule" => $intitule,
					"reponses" => $response
				);
			}
			$compt ++;
			$tab_lvl[] = $tab_quest;
		}
		return $tab_lvl;
	}
}




?>