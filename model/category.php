<?php
	require_once "General.php";
	class Category extends General
	{
		private $id;
		private $name;
		
		public function __construct($connection){
        	parent::__construct($connection);
    	}

		function getAll(){
			$con = $this->getConnection()->prepare("SELECT * FROM category");
	        $con->execute();
	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getCategoryById($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("SELECT * FROM category where id = :id");
	        $con->execute($data);

	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getCategoryBySearchName($name){
			$data = array("name" => $name);
			$con = $this->getConnection()->prepare("SELECT * FROM category where name like '%".$name."%' ");
	        $con->execute($data);

	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getCategoryByName($name){
			$data = array("name" => $name);
			$con = $this->getConnection()->prepare("SELECT * FROM category where name = :name");
	        $con->execute($data);

	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}

		function insertCategory($name){
			$data = array("name" => $name);
			
			$con = $this->getConnection()->prepare("INSERT INTO category (name) VALUES (:name)");

	        $con->execute($data);
	        $this->conection = null;
		}


	}

?>