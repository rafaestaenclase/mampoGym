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

			$destiny = "img/eventos/"."_".$name;

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


			if ($_POST["nombre"] !== $oldI[0]["nombre"]) {
				$destiny = "img/eventos/"."_".$_POST["nombre"];
				rename($oldI[0]["foto"], $destiny);
			}


			if ($_FILES['archive']['tmp_name'] != null) {
				unlink($nameD);

				$archiveTem = $_FILES['archive']['tmp_name'];
				$name = $_POST["nombre"];
				$type = $_FILES['archive']['type'];
				$size = $_FILES['archive']['size'];

				$destiny = "img/eventos/"."_".$name;
			}else{
				$destiny = $nameD;
			}

			move_uploaded_file($archiveTem, $destiny);
				
			$evento->updateEvento($_POST["idE"], $_POST["nombre"], $_POST["lugar"], $_POST["fecha"], $destiny);
			
			header('Location: index.php?controller=Evento&action=runEventos');
		}

		function deleteEvento(){
			$evento = new Evento($this->connection);
			$name = $evento->getEventoById($_GET["idE"])[0]["foto"];
			$evento->deleteEvento($_GET["idE"]);
			unlink($name);
			header('Location: index.php?controller=Evento&action=runEventos');
		}

		function getPostByProfile(){
			$connection = new Connection();
			$post = new Post($connection);
			$publications = $post->getPostByProfile($_SESSION["profile"]["id"]);
			
			return $publications;
		}

		function getPostById(){
			$connection = new Connection();
			$post = new Post($connection);
			$publications = $post->getPostById($_GET["idPost"]);
			return $publications;
		}

		function getPostByNickname(){
			$connection = new Connection();
			$post = new Post($connection);
			$publications = $post->getPostByNickname($_GET["nickname"]);
			return $publications;
		}

		function getPostByCategory(){
			$post = new Post($this->connection);
			$publications = $post->getPostByCategory($_GET["nameCategory"]);
			$this->view('search', array("publications" => $publications));
		}

		function getPostByTitle(){
			$connection = new Connection();
			$post = new Post($connection);
			$publications = $post->getPostByTitle($_GET["value"]);
			return $publications;
		}


		function getFollowedPosts(){
			$post = new Post($this->connection);
			$resul = $post->getFollowedPosts($_SESSION["profile"]["id"]);
			return $resul;
		}

		function getRefreshPosts(){
			$post = new Post($this->connection);
			$resul = $post->getRefreshPosts($_SESSION["profile"]["id"], $_GET["date"]);
			echo $resul;
		}

		function insertPost(){
			$post = new Post($this->connection);
			$category = new Category($this->connection);
			$resul = $category->getCategoryByName($_POST["category"]);

			if ($resul == null) {
				$category->insertCategory($_POST["category"]);
				$resul = $category->getCategoryByName($_POST["category"]);
			}

			$idP = $post->insertPost($_SESSION["profile"]["id"], $_POST["title"], $_POST["rawData"], date("d-m-Y H:i:s"), $resul[0]["id"]);
			
			$archiveTem = $_FILES['archive']['tmp_name'];
			$name = $_FILES['archive']['name'];
			$type = $_FILES['archive']['type'];
			$size = $_FILES['archive']['size'];

			$destiny = "img/postImg/".$idP."_".$name;

			if (move_uploaded_file($archiveTem, $destiny)) {
				$archive = new Archive($this->connection);
				$idP = $archive->insertArchive($destiny, $idP);
			}
			header("location:index.php");
		}


		

	}


?>