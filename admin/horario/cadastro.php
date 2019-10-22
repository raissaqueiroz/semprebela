<?php 
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['cadastrar']) || !empty($_POST['cadastrar'])){
            $hora = filter_input(INPUT_POST, 'hora', FILTER_SANITIZE_STRING);
            $fk_servico = filter_input(INPUT_POST, 'servico', FILTER_SANITIZE_STRING);
            if((isset($hora) && isset($fk_servico)) || (!empty($hora) && !empty($fk_servico))){
				$ifExists = ifExistsHorario($hora, $fk_servico); //função que verifica se usuário existe (database.php)
				if($ifExists == true){
					$insert = [
						"HORA" 	        => $hora,
                        "FK_SERVICO"	=> $fk_servico,
					];
                    $query = dbCreate('horario', $insert);
                    if($query){
                        flash("mensagem", "O horário informado foi cadastrado com sucesso!", "success");
                        header("Location: index.php"); 
                    } else {
                        flash("mensagem", "Não foi possivel cadastrar horário. Por favor, entre em contato com o suporte do sistema!", "danger");
                        header("Location: index.php");
                    }
                } else {
                    flash("mensagem", "O horário informado já existe pra esse serviço. Por favor, tente outro horário ou serviço!", "danger");
                    header("Location: novo.php");
                }
            } else {
                flash("mensagem", "Por favor, preencha todos os campos!", "danger");
                header("Location: novo.php");
            }
        } else if(isset($_POST['editar']) || !empty($_POST['editar'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $hora = filter_input(INPUT_POST, 'hora', FILTER_SANITIZE_STRING);
            $fk_servico = filter_input(INPUT_POST, 'servico', FILTER_SANITIZE_STRING);
            if((isset($hora) && isset($fk_servico)) || (!empty($hora) && !empty($fk_servico))){
				$update = [
					"HORA" 	        => $hora,
                    "FK_SERVICO"    => $fk_servico,
                ];
                $query = dbUpdate("horario", $update, "ID = '{$id}'");
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
    
