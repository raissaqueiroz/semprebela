<?php 
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';	
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['cadastrar']) || !empty($_POST['cadastrar'])){
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
            $rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING);
            $id = $_SESSION['id'];
            if(isset($nome) AND isset($email) AND isset($telefone)AND isset($cpf) AND isset($rg)){
                $status = ifExistsCliente($email, 'cliente');
                if($status == true){
                    $insert = [
                        'FK_LOGIN'  => $id,
                        "NOME" 	    => $nome,
                        "EMAIL"		=> $email,
                        "TELEFONE"  => $telefone,
                        "CPF"       => $cpf,
                        'RG'    =>  $rg
                    ];
                    $query = dbCreate('cliente', $insert);
                    if(!$query){
                        flash("mensagem", "Não foi possivel cadastrar usuário. Por favor, entre em contato com o suporte do sistema!", "danger");
                        header("Location: index.php");
                    } else {
                        $update = ["STATUS" 	=> "S"];
                        $_SESSION['status'] = "S"; 
                        $query = dbUpdate("login", $update, "ID = '{$id}'");
                        flash("mensagem", "O cliente informado foi cadastrado com sucesso!", "success");
                        header("Location: index.php");
                    }
                } else {
                    flash("mensagem", "O email informado já existe. Por favor, tente outro email!", "danger");
                    header("Location: cadastro.php");
                }
                    
            } else {
                flash("mensagem", "Por favor, preencha todos os campos!", "danger");
                header("Location: cadastro.php");
            }
        } else {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
            
?>