<?php

    session_start();
    require_once __DIR__."/../controller/GeneralController.php";
    class AdministradorController extends GeneralController {
        private $connect;
        private $connection;

        public function __construct(){
            require_once __DIR__."/../core/Connection.php";
            require_once __DIR__."/../model/Administrador.php";


            $this->connect = new Connection();
            $this->connection = $this->connect->conexion();
        }

        function runLogin(){
			$parameters = Array();
			$this->view('login', $parameters);
		}

		function verifyLogin(){
			if(isset($_POST["usuario"], $_POST["contrasenna"])){
                $admin = new Administrador($this->connection);
                $dbuser = $admin->getHashByUsuarioContrasenna($_POST["usuario"], $_POST["contrasenna"]);
                if($dbuser == null){
                    echo "ERRO DE INICIO";
                    $parameters = Array();
					$this->view('login', $parameters);
                }else{
                    $_SESSION["hash"] = $dbuser[0]["hash"];
                    $parameters = Array();
					$this->view('index', $parameters);
                }
            }else{
            	$parameters = Array();
				$this->view('login', $parameters);
            }
			
		}

		function logOut(){
			session_destroy();
			header('Refresh: 0; url=index.php');
			$parameters = Array();
			$this->view('index', $parameters);
		}

	}


?>