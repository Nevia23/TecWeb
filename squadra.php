<?php

require_once "..". DIRECTORY_SEPARATOR ."connessione.php";  //DIRECTORY_SEPARATOR mette lo slash corretto!

$paginaHTML = file_get_contents("squadra_php.html");  //bisogna mettere il percorso verso il file

$connessione = new DBAccess();

$stringaGiocatori = "";
$giocatori = "";

$connOk = $connessione->openDBConnection();

if ($connOk){

	$giocatori = $connessione->getList();
	$connessione->closeConnection(); //db occupato per minor tempo possibile

		if ($giocatori!=null) {
		
		$stringaGiocatori .= '<dl id = "giocatori">';  //.= è come += vado ad aggiungere qualcosa. se ho " nella stringa, le " fuori si sostituiscono con ' (apici)
	
		foreach ($giocatori as $giocatore) { 

			$stringaGiocatori .= "<dt>" . $giocatore['nome'];
			if ($giocatore['capitano']) {
				$stringaGiocatori.= "- <em>Capitano</em>";
			}
			$stringaGiocatori .="</dt>"
			. '<dd><img src="' . $giocatore['immagine']. '" alt="" />'
			. '<dt class="giocatore"> <dt>Data di nascita</dt>'
			. '<dd>' . $giocatore['dataNascita'] . '</dd>'
			. '<dt>Luogo</dt>'
			. '<dd>' . $giocatore['luogo'] . '</dd>'
			. '<dt>Squadra</dt>'
			. '<dd>' . $giocatore['squadra'] . '</dd>'
			. '<dt>Ruolo</dt>'
			. '<dd>' . $giocatore['ruolo'] . '</dd>'
			. '<dt>Altezza</dt>'
			. '<dd>' . $giocatore['altezza'] . '</dd>'
			. '<dt>Ruolo</dt>'
			. '<dd>' . $giocatore['ruolo'] . '</dd>'
			. '<dt>Maglia</dt>'
			. '<dd>' . $giocatore['maglia'] . '</dd>'
			. '<dt>Maglia in nazionale</dt>'
			. '<dd>' . $giocatore['magliaNazionale'] . '</dd>'
			if ($giocatore['ruolo'] != 'libero') {
				$stringaGiocatori .= '<dt>Punti totali</dt>';
			} else {
				$stringaGiocatori .= '<dt>Ricezioni</dt>';
			}
		}
		$stringaGiocatori .= '<dd>' . $giocatore['punti'] . '</dd>'
		if ($giocatore['riconoscimenti']) {
			$stringaGiocatori .= '<dt class="riconoscimenti">Riconoscimenti</dt>'
			. '<dd>' . $giocatore['riconoscimenti'] . '</dd>';
		}

		if ($giocatore['note']) {
			$stringaGiocatori .= '<dt class="note">Note</dt>'
			. '<dd>' . $giocatore['note'] . '</dd>';
		}
		$stringaGiocatori .= '</dl>';
		
//altra roba che non so dove sia

		} else {
			$stringaGiocatori = "<p>Nessun giocatore presente.</p>";
		}

} else {
	$stringaGiocatori = "<p>I sistemi sono momentaneamente fuori servizio. Ci scusiamo per il disagio.</p>";
}

echo str_replace("<listaGiocatori/>", $stringaGiocatori, $paginaHTML);  //sostituisco placeholder

?>


//tecweb.studenti.math.unipd.it/phpmyadmin
//costruire form per inserire il giocatore! (info personali, squadra, nazionale, carriera)