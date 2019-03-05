<?php
	require_once "General.php";
	class Administrador extends General
	{

		public function __construct($connection){
        	parent::__construct($connection);
    	}


		function getHashByUsuarioContrasenna($usuario, $contrasenna){
			$data = array("usuario" => $usuario, "contrasenna" => $contrasenna);
			$con = $this->getConnection()->prepare("SELECT hash FROM administrador where usuario = :usuario and contrasenna = :contrasenna");
	        $con->execute($data);
	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}
	}

?>