<?php

    session_start();
    require_once __DIR__."/../controller/GeneralController.php";
    class EventoController extends GeneralController {
        private $connect;
        private $connection;

        public function __construct(){
            require_once __DIR__."/../core/Connection.php";
            require_once __DIR__."/../model/Evento.php";


            $this->connect = new Connection();
            $this->connection = $this->connect->conexion();
        }

        function runEventos(){
			$evento = new Evento($this->connection);
			$eventos = array("eventos" => $evento->getAll());
			$parameters = $eventos;
			$this->view('evento', $parameters);
		}

		function insertEventoView(){
			$evento = new Evento($this->connection);
			$parameters = array();
			$this->view('eventoInsertar', $parameters);
		}

		function insertEvento(){
			$evento = new Evento($this->connection);
			$archiveTem = $_FILES['archive']['tmp_name'];
			$name = $_POST["nombre"];
			$type = $_FILES['archive']['type'];
			$size = $_FILES['archive']['size'];
			$path = $_FILES['archive']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$destiny = "img/eventos/"."_".$name.".".$ext;

			if (move_uploaded_file($archiveTem, $destiny)) {
				$evento->insertEvento($_POST["nombre"], $_POST["lugar"], $_POST["fecha"], $destiny);
			}
			header('Location: index.php?controller=Evento&action=runEventos');
		}

		function updateEventoView(){
			$evento = new Evento($this->connection);
			$eventoObj = array("eventos" => $evento->getEventoById($_GET["idE"]));
			$parameters = $eventoObj;
			$this->view('eventoActualizar', $parameters);
		}

		function updateEvento(){
			$evento = new Evento($this->connection);

			$oldI = $evento->getEventoById($_POST["idE"]);
			$nameD = $oldI[0]["foto"];
			$destiny = "";


			if ($_POST["nombre"] !== $oldI[0]["nombre"]) {
				$ext = pathinfo($oldI[0]["foto"], PATHINFO_EXTENSION);
				$destiny = "img/eventos/"."_".$_POST["nombre"].".".$ext;
				rename($oldI[0]["foto"], $destiny);
				$evento->updateEvento($_POST["idE"], $_POST["nombre"], $_POST["lugar"], $_POST["fecha"], $destiny);
				$nameD = $destiny;
			}


			if ($_FILES['archive']['tmp_name'] != null) {
				unlink($nameD);

				$archiveTem = $_FILES['archive']['tmp_name'];
				$name = $_POST["nombre"];
				$type = $_FILES['archive']['type'];
				$size = $_FILES['archive']['size'];
				$path = $_FILES['archive']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);

				$destiny = "img/eventos/"."_".$name.".".$ext;

				move_uploaded_file($archiveTem, $destiny);

				$evento->updateEvento($_POST["idE"], $_POST["nombre"], $_POST["lugar"], $_POST["fecha"], $destiny);
			}else{
				$destiny = $nameD;
			}
			
			
			
			header('Location: index.php?controller=Evento&action=runEventos');
		}

		function deleteEvento(){
			$evento = new Evento($this->connection);
			$name = $evento->getEventoById($_GET["idE"])[0]["foto"];
			$evento->deleteEvento($_GET["idE"]);
			unlink($name);
			header('Location: index.php?controller=Evento&action=runEventos');
		}

	}


?>