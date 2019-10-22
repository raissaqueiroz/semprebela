<?php 
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['cadastrar']) || !empty($_POST['cadastrar'])){
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
            if((isset($nome) && isset($valor)) || (!empty($usuario) && !empty($descricao))){
				$ifExists = ifExists("nome", $nome, "servico"); //função que verifica se usuário existe (database.php)
				if($ifExists == true){
					$insert = [
						"nome" 	=> $nome,
                        "valor"		=> $valor,
                        "descricao"    =>  $descricao
					];
                    $query = dbCreate('servico', $insert);
                    if($query){
                        flash("mensagem", "O serviço informado foi cadastrado com sucesso!", "success");
                        header("Location: index.php"); 
                    } else {
                        flash("mensagem", "Não foi possivel cadastrar serviço. Por favor, entre em contato com o suporte do sistema!", "danger");
                        header("Location: index.php");
                    }
                } else {
                    flash("mensagem", "O serviço informado já existe. Por favor, tente outro nome de serviço!", "danger");
                    header("Location: novo.php");
                }
            } else {
                flash("mensagem", "Por favor, preencha todos os campos!", "danger");
                header("Location: novo.php");
            }
        } else if(isset($_POST['editar']) || !empty($_POST['editar'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
            if((isset($nome) && isset($valor)) || (!empty($usuario) && !empty($descricao))){
				$update = [
					"NOME" 	=> $nome,
                    "VALOR"		=> $valor,
                    "DESCRICAO"    =>  $descricao
                ];
                $query = dbUpdate("servico", $update, "ID = '{$id}'");
                if($query){
                    flash("mensagem", "O serviço informado foi editado com sucesso!", "success");
                    header("Location: index.php"); 
                } else {
                    flash("mensagem", "Não foi possivel editar serviço. Por favor, entre em contato com o suporte do sistema!", "danger");
                    header("Location: index.php");
                }
            } else {
                flash("mensagem", "Por favor, preencha todos os campos!", "danger");
                header("Location: novo.php");
            }
        } else {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
?>
    
