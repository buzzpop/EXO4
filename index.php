<?php
require_once "functions.php";
// PARTIE INPUT AVEC UNE PHRASE
$message=''; // pour signaler un message d'ereur
$phrase=''; // pour recuperer la phrase dans le input
$messageCorrecte=''; //  pour afficher le message si la phrase est correcte
$deleteSpace= []; // tableau contenant les phrases supprimées de leur spaces unitules
$cutSentences=[]; // tableau contenant le texte découpé en phrase
$validSentences=[]; // tableau contenant les phrases valides aprés découpage
$invalidSentences=[]; // tableau contenant les phrases invalides aprés découpage
$correction=''; // variable contenant la correction des phrases ne commencant pas par
// une lettre majuscule ou ne se terminant pas par un point concaténés avec les bonne phrase

if (isset($_POST['valider'])){
    $phrase= $_POST['phrase'];
    if (is_empty($phrase))
    {
        $message= ' ( Veuillez entrer une phrase - )';
    }

    elseif (sentence_begin_maj_end_dat($phrase))
    {
        $messageCorrecte= ' ( Phrase Correcte - )';
    }
    else
    {
        $message= ' ( La phrase doit commencer par une lettre majuscule et se termine par un point - )';
    }
}
// PARTIE TEXTAREA AVEC UN TEXTE

$messageArea=''; // pour signaler un message d'eereur
$texteInArea=''; // pour recuperer le texte dans le textarea
$cutSentences=[]; //  pour afficher le message si la phrase est correcte
if (isset($_POST['envoie'])){
    $texteInArea= $_POST['texte'];
    if (is_empty($texteInArea))
    {
        $messageArea= ' ( Veuillez entrer une texte - )';
    }

    elseif (cut_texte_in_sentence($texteInArea))
    {
        // tableaux contenant les phrases coupées
        for ($i=0; isset(cut_texte_in_sentence($texteInArea)[$i]); $i++ ){
        $cutSentences[]=  cut_texte_in_sentence($texteInArea)[$i];
        }
        //var_dump($cutSentences);
        foreach ($cutSentences as $element ){
                if (sentence_begin_maj_end_dat($element)){
                    // tableau contenant les phrases valides aprés découpage
                    $validSentences[]= $element;
                }else {
                    // tableau contenant les phrases invalides aprés découpage
                   $invalidSentences[]= $element;
                }
        }
        // suppression des espaces unitules des phrases
        foreach ($cutSentences as $element ){

               $deleteSpace[]= delete_space_in_sentence($element);

        }
        // correction des phrases non valides
        foreach ($deleteSpace as $element ){

                $correction.= correction_sentence($element);
        }

    }

    else
    {
        $messageArea= ' ( Il ny as pas de phrases valides - )';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="exercice4.css">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<form method="post" >
    <label for="nb">Entrer une phrase</label> <br>
    <input type="text" name="phrase" value="<?= $phrase ?>"> <br> <br>
    <p style="color: red"><?= $message ?></p>
    <p style="color: green"><?= $messageCorrecte ?></p>


    <div>
        <input class="btn1" type="submit" value="Valider" name="valider">
        <input class="btn2" type="reset" value="Annuler" name="btn2"> <br><r></r>
    </div>
    <hr>

    <label for="nb">Entrer une phrase</label> <br>
    <textarea type="text" name="texte" cols="100" rows="10" ><?= $texteInArea ?></textarea> <br> <br>
    <p style="color: red"><?= $messageArea ?></p>
    <?php
    if (!is_empty($validSentences)){?>
        <h3 style="color: green">LES PHRASES CORRECTES</h3>
        <p style="color: green"> <?php  print_r($validSentences); ?>  </p>

        <?php
    }
    ?>
    <?php
    if (!is_empty($invalidSentences)){?>
    <h3 style="color: red">LES PHRASES INCORRECTES</h3>
    <p style="color: red"> <?php  echo '<pre>';print_r($invalidSentences); echo '</pre>';?>  </p>

    <?php
    }
    ?>


    <div>
        <input class="btn1" type="submit" value="Valider" name="envoie">
        <input class="btn2" type="reset" value="Annuler" name="btn2"> <br> <br>
    </div>
        <?php
        if (!is_empty($correction)){?>

    <p>SUPPRESSION DES ESPACES UNITULES ET CORRECTION DES PHRASES NON VALIDES</p>
    <textarea  name="correct" cols="100" rows="10" disabled><?php var_dump($correction) ?></textarea>  <br> <br>
    <?php
    }
        ?>

</form>

</body>
</html>