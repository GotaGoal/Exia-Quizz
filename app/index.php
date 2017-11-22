<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Afficher les erreurs et les avertissements
error_reporting(E_ALL);



include("model/SPDO.php");
include("controller/DataManager.php");

$bdd = SPDO::getInstance()->getPDO();

$manager = new DataManager($bdd);
$resume_tab = $manager->getTab();

?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>Exia Quizz</title>
        <meta name="description" content="">
        <meta name="author" content="LESPINASSE Nicolas - GARDIEN Benjamin">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/lib/normalize.css">
        <link rel="stylesheet" href="css/lib/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <!--[if lt IE 9]>
        <script src="js/lib/html5shiv.js"></script>
        <![endif]-->

    </head>
    <body>


    <script src="js/lib/jquery-3.2.1.min.js"></script>
    <script src="js/lib/bootstrap.js"></script>
    <script src="js/script.js"></script>
        <div class="global-wrapper" id="particles-js">
            <script src="js/lib/particles.js"></script>
            <script src="js/app.js"></script>

            <header>


            </header>
                <div class="wrapper">




                    <div class="container-fluid" id="page-accueil">

                        <div id="div-top" class="row">

                        </div>
                       <div class="row" id="container-bouton-demarrage">


                           <button id="bouton-demarrage" class="btn btn-primary" onclick="augmentediv()">EXIA QUIZZ<br>CLIQUEZ POUR COMMENCER</button>
                       </div>
                        <div id="div-bottom" class="row">

                        </div>
                    </div>

                    <script>var compteur = 0;</script>

                    <?php
                    $compteur_total = 0;
                    $q=0;
                    for ($q=0; $q<3; $q++) {
                        $i = 0;
                        ?>
                            <?php

                        for ($i = 0; $i < 5; $i++) {
                            ?>

                            <div class="container container-question" id="<?php echo $compteur_total?>question"  <?php if($compteur_total >0)
                            {
                                echo 'style="display:none;"';
                            }?>>
                                <div class="row bloc-question">
                                    <div class="question">
                                        <h3 class="title-question"><span class="label label-warning qid"
                                                                         id="qid"><?php echo $compteur_total +1?></span>
                                            <span id="question"><?php echo $resume_tab[$q][$i]['intitule'] ?></span>
                                        </h3>
                                    </div>

                                    <?php
                                    if ($resume_tab[0][$i]['type'] == 1) {
                                        echo ' <div class="input-response">
                                                                <form class="login" id="theFormID" action="quiz.html">
                                                                    <input type="text" id="reponse-text" placeholder="Ecrivez votre réponse ici"><br>

                                                                </form>
                                                            </div>';

                                        ?>

                                        <button type="submit" class="btn btn-success" id="submit_on"
                                                onclick="next(<?php echo $resume_tab[$q][$i]['bonne_reponse']; ?>,document.getElementById('reponse-text').value ,<?php echo $compteur_total?>)">
                                            SUIVANT
                                        </button>
                                    <?php
                                    }

                                    else
                                    {

                                    ?>
                                        <ul class="container-reponse">

                                            <?php
                                            $w = 0;
                                            $tab_selector = ["f-option", "s-option", "t-option", "y-option", "a-option"];
                                            for ($w = 0; $w < 5; $w++) {
                                                echo "<li>
                                            <input type=\"radio\" id=\""; ?><?php echo $tab_selector[$w];
                                                echo "\" name=\"selector\" value=\""; ?><?php echo $w + 1;
                                                echo "\">
                                            <label for=\""; ?><?php echo $tab_selector[$w];
                                                echo "\" class=\"element-animation\">"; ?><?php echo $resume_tab[$q][$i]['reponses'][$w];
                                                echo "</label>
                                            <div class=\"check\"><div class=\"inside\"></div></div>
                                        </li>";
                                            }

                                            ?>

                                        </ul>
                                        <button type="submit" class="btn btn-success" id="submit_on"
                                                onclick="next(<?php echo $resume_tab[$q][$i]['bonne_reponse']; ?>,$('input[name=selector]:checked').val(),<?php echo $compteur_total?>)">
                                            SUIVANT
                                        </button>
                                        <?php

                                    }


                                    ?>




                                </div>

                            </div>
                            <script>compteur++;</script>
                            <?php
                            $compteur_total ++;

                        }
                    }
                    ?>


                    <div class="container container-question" id="affiche_result" style="display: none">
                        <div class="row bloc-question">
                            <div class="question">
                                <h3 class="title-question">
                                    <span id="question">Félicitation votre score est de : <span id="affichage_score"></span> sur 15</span>
                                </h3>
                            </div>
                            <ul class="container-reponse">
                                <h3 class="title-question" style="color:white; margin-left: 10px"  id="affiche_commentaire"></h3>
                                <h3 class="title-question" style="color:white; margin-left: 10px" id="sub_com"></h3>
                            </ul>
                            <button type="submit" class="btn btn-success" id="submit_on" onclick="window.location.reload()">ACCUEIL</button>

                        </div>
                    </div>

                </div>


            <footer>

            </footer>
        </div>


    </body>
</html>
