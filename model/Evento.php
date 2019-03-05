<?php
	require_once "General.php";
	class Evento extends General
	{

		public function __construct($connection){
        	parent::__construct($connection);
    	}


		function getAll(){
			$con = $this->getConnection()->prepare("SELECT * FROM evento ORDER BY fecha desc");
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

		function getEventoByNombre($nombre){
			$data = array("nombre" => $nombre);
			$con = $this->getConnection()->prepare("SELECT * FROM evento where nombre= :nombre");
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

		function updateEvento($id, $nombre, $lugar, $fecha, $foto){
			$data = array("id" => $id, "nombre" => $nombre, "lugar" => $lugar, "fecha" => $fecha, "foto" => $foto);
			$con = $this->getConnection()->prepare("UPDATE evento SET nombre = :nombre, lugar = :lugar, fecha = :fecha, foto = :foto where id = :id");
	        $con->execute($data);
	        $this->conection = null;
		}

		function deleteEvento($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("DELETE from evento where id = :id");
	        $con->execute($data);
		}
	}

?>