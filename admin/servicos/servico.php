<?php 
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['edit']) || !empty($_POST['edit'])){
            $id = $nome = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $dados = dbread("servico", "where id = '{$id}'");
            $nome = $dados[0]['NOME'];
            $valor = $dados[0]['VALOR'];
            $descricao = $dados[0]['DESCRICAO'];
            if((isset($nome) && isset($valor)) || (!empty($usuario) && !empty($descricao))){
                if(!isset($_SESSION['nivel']) || empty($_SESSION['nivel'])){
                    flash("mensagem", "É necessário estar logado para acessar essa área!", "danger");
                    header("Location: ../../index.php");
                } else {
                    if($_SESSION['nivel'] != 1){
                        flash("mensagem", "Você não tem permissão para acessar essa área!", "danger");
                        header("Location: ../../index.php");
                    }
                }
                require_once '../../includes/cabecalho.php';
                require_once '../includes/menu.php';
                ?>
                <div class="container-fluid page-body-wrapper col-sm-12">
                    <div class="main-panel">
                        <div class="content-wrapper">
                        <?= getFlash('mensagem') ?>
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card pl-lg-5">
                                    <div class="card-body col-sm-6">
                                        <br>
                                        <br>
                                        <form class="forms-sample " action="cadastro.php" method="POST">
                                            <input type="hidden" name="id" value="<?=$id?>" />
                                            <div class="form-group">
                                                <label class="label-input" for="nome">Nome do Serviço</label>
                                                <input type="text" class="form-control" name="nome" value="<?=$nome?>" id="nome" placeholder="Nome do Serviço">
                                            </div>
                                            <div class="form-group">
                                                <label class="label-input" for="valor">Valor</label>
                                                <input type="text" class="form-control" name="valor" value="<?=$valor?>" id="valor" placeholder="Valor: R$ 0,00">
                                            </div>
                                            <div class="form-group">
                                                <label class="label-input" for="descricao">Descrição</label>
                                                <textarea class="form-control" name="descricao" id="descricao" rows="4" cols="6"><?=$descricao?></textarea>
                                            </div>
                                        
                                            <div class="d-flex flex-column mt-5">
                                                <button type="submit" class="btn btn-login  align-self-center col-sm-4" name="editar">Editar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                 require_once '../../includes/rodape.php'; 
            } else {
                flash("mensagem", "Por favor, preencha todos os campos!", "danger");
                header("Location: novo.php");
            }
        } else if(isset($_POST['delete']) || !empty($_POST['delete'])) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $delete = dbDelete("servico", "ID = '{$id}'");
            if($delete){
				flash("mensagem", "Serviço excluido com sucesso!", "success");
                header("Location: index.php");
            } else {
                flash("mensagem", "Erro ao excluir serviço!", "danger");
                header("Location: index.php");
            }
        } else {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }

?>
    
