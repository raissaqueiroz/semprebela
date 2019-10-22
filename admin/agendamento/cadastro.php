<?php 
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['cadastrar']) || !empty($_POST['cadastrar'])){
            $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
            $dataFormatada = dateImport($data);// CONVERTER DATA
            $fk_cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_NUMBER_INT);
            $fk_horario = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_NUMBER_INT);
            if((isset($dataFormatada) && isset($fk_horario) && isset($fk_cliente)) || (!empty($dataFormatada) && !empty($fk_horario) && !empty($fk_cliente))){
                $insert = [
                    "DATA" 	        => $dataFormatada,
                    "FK_HORARIO"	=> $fk_horario,
                    "FK_CLIENTE"	=> $fk_cliente,
                ];
                $query = dbCreate('agendamento', $insert);
                if($query){
                    flash("mensagem", "O agendamento informado foi cadastrado com sucesso!", "success");
                    header("Location: index.php"); 
                } else {
                    flash("mensagem", "Não foi possivel cadastrar agendamento. Por favor, entre em contato com o suporte do sistema!", "danger");
                    header("Location: index.php");
                }
                
            } else {
                flash("mensagem", "Por favor, preencha todos os campos!", "danger");
                header("Location: novo.php");
            }
        } else if(isset($_POST['delete']) || !empty($_POST['delete'])){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $delete = dbDelete("agendamento", "ID = '{$id}'");
            if($delete){
				flash("mensagem", "Agendamento excluido com sucesso!", "success");
                header("Location: index.php");
            } else {
                flash("mensagem", "Erro ao excluir agendamento!", "danger");
                header("Location: index.php");
            }
        } else {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
?>
    
