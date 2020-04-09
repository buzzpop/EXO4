<?php

// FONCTION QUI PERMET DE TESTER SI UNE CHAINE EST VIDE OU PAS
function is_empty($chaine){
    return(long_chaine($chaine)==0);
}

// RETOURNER LE NOMBRE DE CARACTERES D'UNE CHAINE
function long_chaine ($chaine){
    $c=0;
    while(isset($chaine[$c]) &&$chaine[$c]!= ''){
        $c= $c+1;
    }
    return $c;
}
// FONCTION QUI VERIFIE SI UNE PHRASE COMMENCE PAR UNE LETTRE MAJ ET SE TERMINE PAR UN POINT
function sentence_begin_maj_end_dat ($sentence){
if (isset($sentence)){
if (!preg_match('#^[A-Z](.){1,}[.!?]$#', $sentence)) {
return false;
}
}
return true;
}



// FONCTION QUI PERMET DE DECOUPER UN TEXTE EN PHRASE ET RETOURNE LES PHRASES DECOUPEES
    function cut_texte_in_sentence ($texte)
    {
        $recupSentence=[];
        $validSentence='';
        $result= preg_split('#([.!?]){1}#', $texte, -1, PREG_SPLIT_DELIM_CAPTURE);
        for ($i=0; isset($result[$i]); $i++)
        {
            if (!is_empty($result[$i])) {
                if ($result[$i] != '.' && $result[$i] != '!' && $result[$i] != '?' ) {
                    if (isset($result[$i+1])) {
                        $recupSentence[]= $result[$i].$result[$i+1];
                    }
                    else {
                        $recupSentence[]= $result[$i];
                    }
                }
            }
        }
        return $recupSentence;
    }

// FONCTION QUI SUPPRIME LES ESPACES UNITULES D'UNE PHRASE
function delete_space_in_sentence($chaine){
    $pattern= '%\s+%';
    $replacement=' ';
    $chaine= preg_replace($pattern, $replacement, $chaine);
    return $chaine;
}


// CORRECTION DE LA PREMIERE LETTRE EN MAJUSCULE ET METTRE UN POINT A LA FIN SI LA PHRASE
// NE SE TERMINE PAS PAR UNE PONCTUATION
function correction_sentence ($letter){
    $min="a";
    $maj='A';
    for ($j=0;$j<26;$j++) {
        for ($i = 0; $i < long_chaine($letter); $i++) {
            if ($letter[0] == $min) {
                $letter[0]= $maj;
            }elseif ($letter[0] == ' ') {
                if ($letter[1]== $min)
                $letter[1]= $maj;
            }
            if ($letter[long_chaine($letter)-1]=='.' || $letter[long_chaine($letter)-1]=='!' ||
                $letter[long_chaine($letter)-1]=='?' ){}
            else{
                $letter= $letter.'.';
            }
        }
        $maj++;
        $min++;
    }
    return $letter;
}



