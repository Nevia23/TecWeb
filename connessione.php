<?php

namespace DB;

class DBAccess {

	private const HOST_DB = "127.0.0.1";
	private const DATABASE_NAME = "bzaghett"
	private const USERNAME =
	private const PASSWORD =

	private $connection;
	
	public function openDBConnection() {

		mysqli_report(MYSQLI_REPORT_ERROR);

		$this->connection = mysqli_connect(DBAccess::HOST_DB, DBAccess::USERNAME, DBAccess::PASSWORD, DBAccess::DATABASE_NAME);
		
		if (mysqli_connect_errno()) {
			return false;
		} else {
			return true;
		}
	}

	public function getlist() {
		$query = "SELECT * FROM giocatori ORDER BY ID ASC";
		$queryResult = mysqli_query($this->connection, $query) or die("Errore in dbConnection: ". mysqli_error($this->connection));

		if (mysqli_num_rows($queryResult)==0){
			return null;
		} else {
			$result = array();
			while ($riga = mysqli_fetch_assoc($queryResult)) {
				array_push($result, $riga);
			}
			$queryResult->free();
			return $result;
		}
	}

	public function insertNewPlayer($nome, $capitano, $dataNascita, $luogo, $squadra, $ruolo, $altezza, $maglia, $magliaNazionale, $punti, $riconoscimenti, $note) {
		//non metto ID tra gli attributi perché definito autoincrementante
		$queryString = "INSERT INTO giocatori (nome, capitano, dataNascita, luogo, squadra, ruolo, altezza, maglia, magliaNazionale, punti, riconoscimenti, note) VALUES (\"$nome\", $capitano, \"$dataNascita\", \"$luogo\", \"$squadra\", \"$ruolo\", $altezza, $maglia, $magliaNazionale, $punti, \"$riconoscimenti\", \"$note\")";
		
		$queryOK = mysqli_query($this->connection, $queryString) or die(mysqli_error(this->connection));

		if (msqli_affected_rows($this->connection)>0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePlayer($id) {
		$queryString = "DELETE FROM giocatori WHERE ID=$id";

		$queryOK = mysqli_query($this->connection, $queryString) or die(mysqli_error(this->connection));

		if (msqli_affected_rows($this->connection)>0) {
			return true;
		} else {
			return false;
		}
	}

	public function closeConnection() {
		mysqli_close($this->connection);
	}
}


?>

//inserire <listaGiocatori /> dopo main e h1 Squadra come placeholder>