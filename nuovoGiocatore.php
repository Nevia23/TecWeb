<?php

require_once "connessione.php";

$paginaHTML = file_get_contents("nuovoGiocatore.html");

use DB\access;

$tagPermessi = '<em><strong><ul><li>';

$messaggiPerForm = '';
$nome = '';
$capitano = '';
$note = '';

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

    $luogo = pulisciInput($_POST['luogo']);
    if (strlen($luogo)==0) {
        $messaggiPerForm .= '<li>Luogo di nascita non presente</li>';
    } else {}

    $altezza = <pulisci class=""></pulisci>
    if(strlen($altezza)==0) {
        $messaggiPerForm  .= '<li>Altezza non presente</li>';
    } elseif(!(ctype_digit($altezza) && ($altezza > 129))) {
        $messaggiPerForm .= '<li>L\'altezza deve essere un numero maggiore di 130</li>';
    }

    $squadra = pulisciInput($_POST['squadra']);
    if(strlen($squadra)==0 {
        $messaggiPerForm .= '<li>Squadra non presente</li>';
    } else {
        if (preg_match("/\d/", $squadra)) {
            $messaggiPerForm .= '<li>La squadra non può contenere numeri</li>;'
        }
    } 

    $maglia = pulisciInput($_POST['maglia']);
    if(strlen ) .................

    $magliaNazionale.............

    $ruolo
    if ............

    $punti
    if ................
    
    $riconoscimenti = pulisciNote

    //dopo aver fatto tutti i controlli

    if ($messaggiPerForm == "") {
        $connessione = new DBAccess();
        $connOK = $connessione->openDBConnection();
        if ($connOK) {
            //se non voglio fare così posso fare un array associativo anziché creare tutte queste variabili
            $queryOK = $connessione->insertNewPlayer($nome, $capitano, $dataNascita, $luogo, $squadra, $ruolo, $altezza, $maglia, $magliaNazionale, $punti, $riconoscimenti, $note);
            if($queryOK) {
                //molto importante notificare anche il successo, non solo gli errori
                $messaggiPerForm = '<div if="greetings"><p>Inserimento avvenuto con successo.</p></div>'; 
            } else {
                $messaggiPerForm = '<div if="messageErrors"><p>Problema nell\'inserimento dei dati, controlla se hai usato caratteri speciali.</p></div>'; 
            }
        } else {
            $messaggiPerForm = '<div if="messageErrors"><p>I nostri sistemi sono al momento non funzionanti, ci scusiamo per il disagio.</p></div>';
        }
    } else {
        $messaggiPerForm = '<div id="messageErrors"><ul>' . $messaggiPerForm . '</ul></div>';
    }
}

$paginaHTML = str_replace("<messaggiPerForm>");
$paginaHTML = str_replace('valoreNome />', $nome, $paginaHTML);
$paginaHTML = str_replace('valoreData />', $dataNascita, $paginaHTML);
$paginaHTML = str_replace('valoreLuogo />', $luogo, $paginaHTML);
//ecc ecc
echo $paginaHTML;

//dopo login cosa si vedrà? la dashboard dell'utente. Meglio NON rimandare alla home.

?>