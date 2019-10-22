<?php 
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['cadastrar']) || !empty($_POST['cadastrar'])){
            // Cadastro de Login
            $usuario = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            if((isset($usuario) && isset($senha)) || (!empty($usuario) && !empty($usuario))){
				$existsUser = ifExistsUser($usuario, "login"); //função que verifica se usuário existe (database.php)
				if($existsUser == true){
					$insert = [
						"usuario" 	=> $usuario,
                        "senha"		=> $senha,
                        "status"    => 'S'
					];
                    $query = dbCreate('login', $insert);
                    if($query){
                        $id = dbId();
                        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);
                        $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
                        $rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_NUMBER_INT);
                        if(isset($nome) AND isset($email) AND isset($telefone) AND isset($cpf) AND isset($rg)){
                            $status = ifExistsCliente($email, 'cliente');
                            if($status == true){
                                $insert = [
                                    'FK_LOGIN'  => $id,
                                    "NOME" 	    => $nome,
                                    "EMAIL"		=> $email,
                                    "TELEFONE"  => $telefone,
                                    "CPF"       => $cpf,
                                    'RG'      => $rg,
                                ];

                                $query = dbCreate('cliente', $insert);
                                if(!$query){
                                    flash("mensagem", "Não foi possivel cadastrar cliente. Por favor, entre em contato com o suporte do sistema!", "danger");
                                    header("Location: index.php");
                                } else {
                                    flash("mensagem", "O cliente informado foi cadastrado com sucesso!", "success");
                                    header("Location: index.php"); 
                                }
                            } else {
                                flash("mensagem", "O email informado já existe. Por favor, tente outro email!", "danger");
                                header("Location: novo.php");
                            }    
                        } else {
                            flash("mensagem", "Por favor, preencha todos os campos!", "danger");
                            header("Location: novo.php");
                        }
                    } else {
                        flash("mensagem", "Não foi possivel cadastrar usuário. Por favor, entre em contato com o suporte do sistema!", "danger");
                        header("Location: index.php");
                    }
                } else {
                    flash("mensagem", "O usuário informado já existe. Por favor, tente outro nome de usuário!", "danger");
                    header("Location: novo.php");
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
    
