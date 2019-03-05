<?php
	require_once "General.php";
	class Integrante extends General
	{

		public function __construct($connection){
        	parent::__construct($connection);
    	}


		function getAll(){
			$con = $this->getConnection()->prepare("SELECT * FROM integrante");
	        $con->execute();
	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}

		function getIntegranteById($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("SELECT * FROM integrante where id = :id");
	        $con->execute($data);
	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}

		function getIntegranteByNombre($nombre){
			$data = array("nombre" => $nombre);
			$con = $this->getConnection()->prepare("SELECT * FROM integrante where nombre = :nombre");
	        $con->execute($data);
	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}

		function insertIntegrante($nombre, $rango, $premio, $foto){
			$data = array("nombre" => $nombre, "rango" => $rango, "premio" => $premio, "foto" => $foto);
			$con = $this->getConnection()->prepare("INSERT INTO integrante (nombre, rango, premio, foto) values (:nombre, :rango, :premio, :foto)");
	        $con->execute($data);
	        $this->conection = null;
		}

		function updateIntegrante($id, $nombre, $rango, $premio, $foto){
			$data = array("id" => $id, "nombre" => $nombre, "rango" => $rango, "premio" => $premio, "foto" => $foto);
			$con = $this->getConnection()->prepare("UPDATE integrante SET nombre = :nombre, rango = :rango, premio = :premio, foto = :foto where id = :id");
	        $con->execute($data);
	        $this->conection = null;
		}

		function deleteIntegrante($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("DELETE from integrante where id = :id");
	        $con->execute($data);
		}
	}

?>