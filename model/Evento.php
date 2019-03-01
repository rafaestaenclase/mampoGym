<?php
	require_once "General.php";
	class Evento extends General
	{

		public function __construct($connection){
        	parent::__construct($connection);
    	}


		function getAll(){
			$con = $this->getConnection()->prepare("SELECT * FROM evento");
	        $con->execute();
	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}

		function getEventoById($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("SELECT * FROM evento where id = :id");
	        $con->execute($data);
	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}

		function insertEvento($nombre, $lugar, $fecha, $foto){
			$data = array("nombre" => $nombre, "lugar" => $lugar, "fecha" => $fecha, "foto" => $foto);
			$con = $this->getConnection()->prepare("INSERT INTO evento (nombre, lugar, fecha, foto) values (:nombre, :lugar, :fecha, :foto)");
	        $con->execute($data);
	        $this->conection = null;
		}

		function updateEvento($id, $nombre, $lugar, $fecha){
			$data = array("id" => $id, "nombre" => $nombre, "lugar" => $lugar, "fecha" => $fecha);
			$con = $this->getConnection()->prepare("UPDATE evento SET nombre = :nombre, lugar = :lugar, fecha = :fecha where id = :id");
	        $con->execute($data);
	        $this->conection = null;
		}

		function deleteEvento($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("DELETE from evento where id = :id");
	        $con->execute($data);
		}

		function getPostById($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("SELECT po.*, pr.nickname FROM post po, profile pr where po.id = :id and pr.id = po.idProfile");
	        $con->execute($data);
	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getPostByNickname($nickname){
			$data = array("nickname" => $nickname);
			$con = $this->getConnection()->prepare("SELECT * FROM post where idProfile in (SELECT id FROM profile where nickname = :nickname) ORDER BY datePost DESC");
	        $con->execute($data);
	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getPostByCategory($category){
			$con = $this->connection->connect();
			$data = array("category" => $category);
			$con = $con->prepare("SELECT * FROM post where idCategory in (SELECT id FROM category where name = :category) ORDER BY datePost DESC");
	        $con->execute($data);
	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getPostBySearchTitle($title){
			$data = array("title" => $title);
			$con = $this->getConnection()->prepare("SELECT * FROM post where title like '%".$title."%' ORDER BY datePost DESC");
	        $con->execute($data);
	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getFollowedPosts($id){
			$con = $this->getConnection()->prepare("SELECT * FROM post where idProfile in (SELECT idFollowed FROM follow where idFollower = :id) or idProfile = :id ORDER BY datePost DESC ");
	        $con->execute(array("id" => $id));
	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getRefreshPosts($id, $date){
			$con = $this->getConnection()->prepare("SELECT * FROM post where (idProfile in (SELECT idFollowed FROM follow where idFollower = :id) AND datePost > :datePost)");
	        $con->execute(array("id" => $id,
							"datePost" => $date));
	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return sizeof($resul);
		}

		function insertPost($idP, $title, $rawData, $datePost, $idC){
			$con = $this->getConnection()->prepare("INSERT INTO post (rawData, datePost, title, idProfile, idCategory) VALUES (:rawData, :datePost, :title, :idP, :idC)");

	        $result = $con->execute(array("idP" => $idP,
							"title" => $title,
							"rawData" => $rawData,
							"datePost" => $datePost,
							"idC" => $idC));
	        return $this->getConnection()->lastInsertId();
	        $this->connection = null;
	        
		}
	}

?>