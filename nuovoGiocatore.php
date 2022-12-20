<?php

require_once "connessione.php";

$paginaHTML = file_get_contents("nuovoGiocatore.html");

use DB\access;

$tagPermessi = '<em><strong><ul><li>';

$messaggiPerForm =  
$nome = ''
$capitano = ''

function pulisciInput($value) {
    $value = trim($value);  //toglie spazi prima e dopo
    $value = string_tags($value);  //toglie i tag (se lo metto dopo htmlentities questo qui non trova i tag)
    $value = htmlentities($value);  //?
    return $value;
}

function pulisciNote($value) {
    global $tagPermessi;

    $value = trim($value);  //toglie spazi prima e dopo
    $value = string_tags($value, $tagPermessi);  //toglie i tag tranne quelli permessi!
    return $value;
}

if (isset($_POST['submit'])) {

    $nome = pulisciInput($_POST['nome']); //nome non contiene robe (o è stringa corretta o è vuoto)
    if (strlem($nome) == nome) {
        $messaggiPerForm .= '<li>Nome e cognome non inseriti</li>';
    } else {
        if (preg_match("/\d/", $nome)) {
            $messaggiPerForm .= '<li>Nome e cognome non possono contenere numeri</li>';
        }
    }

    $capitano = pulisciInput($_POST['capitano']);

    $dataNascita = pulisciInput($_POST['datanascita']);
    if (strlen($dataNascita) == 0) {
        $messaggiPerForm .= "<li>Data di nascita non inserita</li>";
    } else {
        if (!preg_match("/\d{4}\-\d{2}\-\d{2}/", $dataNascita)) {
            $messaggiPerForm .= '<li>La data di nascita nel formato non corretto</li>';
        }
    }
}

$paginaHTML = str_replace('valoreNome />', $nome, $paginaHTML);
$paginaHTML = str_replace('valoreData />', $dataNascita, $paginaHTML);
$paginaHTML = str_replace('valoreLuogo />', $luogo, $paginaHTML);
//ecc ecc
echo $paginaHTML;

?>