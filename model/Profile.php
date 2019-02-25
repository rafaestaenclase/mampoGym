<?php
	require_once "General.php";
	class Profile extends General
	{
		private $id;
		private $nickname;
		private $password;
		private $photo;
		private $email;

		public function __construct($connection){
        	parent::__construct($connection);
    	}

		function getAll(){
			$con = $this->connection->connect();
			$con = $con->prepare("SELECT * FROM profile");
	        $con->execute();
	        $resul = $con->fetchAll();
	        $this->conection = null;
	        return $resul;
		}

		function getProfileById($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("SELECT * FROM profile where id = :id");
	        $con->execute($data);

	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getProfileIsSet($nickname){
			$con = $this->connection->connect();
			$data = array("nickname" => $nickname);
			$con = $con->prepare("SELECT * FROM profile where nickname = :nickname ");
	        $con->execute($data);
	        $this->connection = null;
	        if ($con->rowCount() > 0) {
	        	return true;
	        }else{
	        	return false;
	        }
		}

		function getProfileByNickame($nickname){
			$data = array("nickname" => $nickname);
			$con = $this->getConnection()->prepare("SELECT * FROM profile where nickname = :nickname");
	        $con->execute($data);

	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getProfileBySearchNickame($nickname){
			$data = array("nickname" => $nickname);
			$con = $this->getConnection()->prepare("SELECT * FROM profile where (nickname LIKE '%".$nickname."%' ) ");
	        $con->execute($data);

	        $resul = $con->fetchAll();
	        $this->conection = null; //cierre de conexión
	        return $resul;
		}

		function getNicknameById($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("SELECT nickname FROM profile where id = :id");
	        $con->execute($data);

	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getPhotoById($id){
			$data = array("id" => $id);
			$con = $this->getConnection()->prepare("SELECT photo FROM profile where id = :id");
	        $con->execute($data);

	        $resul = $con->fetchAll();
	        $this->connection = null;
	        return $resul;
		}

		function getProfileByNicknamePassword($nickname, $password){
        $res = $this->getConnection()->prepare(
            "SELECT * FROM profile where nickname = :nickname and password = :password"
        );
        $res->execute(array(
            "nickname" => $nickname,
			"password" => $password
        ));
        $result = $res->fetchAll();

        $this->setConnection(null);
        return $result;
    }

		function insertProfile($nickname, $password){

			$con = $this->connection->connect();
			$data = array("nickname" => $nickname,
							"password" => $password);
			$con = $con->prepare("INSERT INTO profile (nickname, password, photo) VALUES (:nickname, :password, 'test')");
	        $con->execute($data);
	        $this->conection = null;
		}

		function updatePhotoProfile($idP, $url){

			$data = array("idP" => $idP,
							"photo" => $url);
			$con = $this->getConnection()->prepare("UPDATE profile SET photo = :photo where id = :idP");
	        $con->execute($data);
	        $this->connection = null;
		}

		
	}

?>