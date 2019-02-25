<?php
	require_once "General.php";
	class Follow extends General
	{
		private $idFollower;
		private $idFollowed;

		public function __construct($connection){
        	parent::__construct($connection);
    	}

		function followByNickname($idFollower, $nickameFollowed){
			$data = array("idFollower" => $idFollower,"nicknameFollowed" => $nickameFollowed);
			
			$con = $this->getConnection()->prepare("INSERT INTO follow (idFollower, idFollowed) VALUES (:idFollower, (SELECT id from profile where nickname = :nicknameFollowed))");

	        $con->execute($data);
	        $this->connection = null;
		}

		function unFollowByNickname($idFollower, $nickameFollowed){

			$data = array("idFollower" => $idFollower,"nicknameFollowed" => $nickameFollowed);
			
			$con = $this->getConnection()->prepare("DELETE FROM follow where idFollower = :idFollower AND idFollowed = (SELECT id from profile where nickname = :nicknameFollowed)");

	        $con->execute($data);
	        $this->connection = null;
		}

		function isFollow($idFollower, $nickameFollowed){
			$data = array("idFollower" => $idFollower,"nicknameFollowed" => $nickameFollowed);
			
			$con = $this->getConnection()->prepare("SELECT * from follow where idFollower = :idFollower AND idFollowed = (SELECT id from profile where nickname = :nicknameFollowed)");

	        $con->execute($data);
	        if ($con->rowCount() > 0) {
	        	return true;
	        }else{
	        	return false;
	        }
	        $this->connection = null;
		}

	}

?>