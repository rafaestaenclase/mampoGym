<?php

	require_once "General.php";

	class Archive extends General
	{
		
		public function __construct($connection){
        	parent::__construct($connection);
    	}

		private $url;
		private $idQuestion;

		function getArchiveByPost($id){
			$con = $this->getConnection()->prepare("SELECT * FROM archive where idPost = :id");
	        $con->execute(array("id" => $id));
	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}

		function insertArchive($url, $idPost){
			$con = $this->getConnection()->prepare("INSERT INTO archive (url, idPost) VALUES (:url, :idPost)");
	        $con->execute(array("url" => $url,
							"idPost" => $idPost));
	        $this->connection = null;
		}

	}


?>