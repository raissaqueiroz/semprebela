<?php
	$_SESSION = array();
    require_once 'functions/functions.php';
	carregaIncludes("functions/", array("config", "conexao", "database"));	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['entrar']) || !empty($_POST['entrar'])){
			$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL);;
			$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
			if((isset($usuario) && isset($senha)) || (!empty($usuario) && !empty($usuario))){
				$where = "WHERE usuario = '".$usuario."' AND senha = '".$senha."'";
				$query = dbRead('login', $where);
					if($query == false){
						flash("mensagem", "O usuário informado não existe!", "danger");
						header("Location: index.php");
					} else {
						foreach ($query as $value) {
							$_SESSION['id'] = $value['ID'];
							$_SESSION['usuario'] = $value['USUARIO']; 
						}
						header("Location: home.php");
					}
			} else {
					//flash que usuário não existe
				flash("mensagem", "Por favor, preencha todos os campos!", "danger");
				header("Location: index.php");
			}
		} else if(isset($_POST['cadastrar']) || !empty($_POST['cadastrar'])){
			$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL);;
			$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
			if((isset($usuario) && isset($senha)) || (!empty($usuario) && !empty($usuario))){
				$existsUser = ifExistsUser($usuario, "login"); //função que verifica se usuário existe (database.php)
				if($existsUser == true){
					$insert = [
						"usuario" 	=> $usuario,
						"senha"		=> $senha
					];

					$query = dbCreate('login', $insert);
						if(!$query){
							flash("mensagem", "Não foi possivel cadastrar usuário. Por favor, entre em contato com o suporte do sistema!", "danger");
							header("Location: cLogin.php");
						} else {
							flash("mensagem", "O usuário informado foi cadastrado com sucesso!", "success");
							header("Location: index.php");
							 
						}
				} else {
					flash("mensagem", "O usuário informado já existe. Por favor, tente outro nome de usuário!", "danger");
					header("Location: cadastrar.php");
				}
				
			} else {
				flash("mensagem", "Por favor, preencha todos os campos!", "danger");
				header("Location: cadastrar.php");
			}
		} else {
			header("Location: index.php");
		}
	} else {
		header("Location: index.php");
	}
?>