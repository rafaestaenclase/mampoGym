<?php

    session_start();
    require_once __DIR__."/../controller/GeneralController.php";
    class IntegranteController extends GeneralController {
        private $connect;
        private $connection;

        public function __construct(){
            require_once __DIR__."/../core/Connection.php";
            require_once __DIR__."/../model/Integrante.php";


            $this->connect = new Connection();
            $this->connection = $this->connect->conexion();
        }

        function runIntegrante(){
			$integrante = new Integrante($this->connection);
			$parameters = array("integrante" => $integrante->getAll());
			$this->view('integrante', $parameters);
		}

		function insertIntegranteView(){
			$integrante = new Integrante($this->connection);
			$parameters = array();
			$this->view('integranteInsertar', $parameters);
		}

		function insertIntegrante(){
			$integrante = new Integrante($this->connection);
			$archiveTem = $_FILES['archive']['tmp_name'];
			$path = $_FILES['archive']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$name = $_POST["nombre"];
			$type = $_FILES['archive']['type'];
			$size = $_FILES['archive']['size'];

			$destiny = "img/integrante/"."_".$name.".".$ext;

			if (move_uploaded_file($archiveTem, $destiny)) {
				$integrante->insertIntegrante($_POST["nombre"], $_POST["rango"], $_POST["premio"], $destiny);
			}

			
			header('Location: index.php?controller=Integrante&action=runIntegrante');
		}

		function updateIntegranteView(){
			$integrante = new Integrante($this->connection);
			$parameters = array("integrante" => $integrante->getIntegranteById($_GET["idI"]));
			$this->view('integranteActualizar', $parameters);
		}

		function updateIntegrante(){
			$integrante = new Integrante($this->connection);

			$oldI = $integrante->getIntegranteById($_POST["idI"]);
			$nameD = $oldI[0]["foto"];
			$destiny = $nameD;

			if ($_POST["nombre"] !== $oldI[0]["nombre"]) {
				$ext = pathinfo($oldI[0]["foto"], PATHINFO_EXTENSION);
				$destiny = "img/integrante/"."_".$_POST["nombre"].".".$ext;
				rename($oldI[0]["foto"], $destiny);
				$integrante->updateIntegrante($_POST["idI"], $_POST["nombre"], $_POST["rango"], $_POST["premio"], $destiny);
				$nameD = $destiny;
			}


			if ($_FILES['archive']['tmp_name'] != null) {
				unlink($nameD);

				$archiveTem = $_FILES['archive']['tmp_name'];
				$name = $_POST["nombre"];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$type = $_FILES['archive']['type'];
				$size = $_FILES['archive']['size'];
				$path = $_FILES['archive']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);

				$destiny = "img/integrante/"."_".$name.".".$ext;

				move_uploaded_file($archiveTem, $destiny);

				$integrante->updateIntegrante($_POST["idI"], $_POST["nombre"], $_POST["rango"], $_POST["premio"], $destiny);

			}

			header('Location: index.php?controller=Integrante&action=runIntegrante');
		}

		function deleteIntegrante(){
			$integrante = new Integrante($this->connection);
			$name = $integrante->getIntegranteById($_GET["idI"])[0]["foto"];
			$integrante->deleteIntegrante($_GET["idI"]);
			unlink($name);
			header('Location: index.php?controller=Integrante&action=runIntegrante');
		}

	}


?>