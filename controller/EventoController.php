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

		function getAll(){
			$connection = new Connection();
			$post = new Post($connection);
			$resul = $post->getAll();
			return $resul;
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