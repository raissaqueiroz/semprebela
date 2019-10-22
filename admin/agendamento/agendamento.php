<?php 
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['agendar']) || !empty($_POST['agendar'])){
            $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
            $fk_servico = filter_input(INPUT_POST, 'servico', FILTER_SANITIZE_NUMBER_INT);
            $fk_cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_NUMBER_INT);
            if((isset($data) && isset($fk_servico) && isset($fk_cliente)) || (!empty($data) && !empty($fk_servico) && !empty($fk_cliente))){
                $servico = dbRead("servico", "WHERE ID = '{$fk_servico}'");
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
                                            <input type="hidden" name="cliente" value="<?=$fk_cliente?>" />
                                            <input type="hidden" name="data" value="<?=$data?>" />
                                            <h5>Valor: R$ <?=$servico[0]['VALOR']; ?> </h5>
                                            <div class="form-group">
                                                <label class="label-input" for="horario">Escolha um dos horários abaixo</label>
                                                <select class="form-control form-control-lg" id="horario" name="servico">
                                                    <?php 
                                                    $horarios = dbRead("horario", "WHERE FK_SERVICO = '{$fk_servico}'");
                                                    if($horarios):
                                                        foreach($horarios as $horario): 
                                                    ?>
                                                        <option value="<?=$horario['ID']?>"><?=$horario['HORA']?></option> 
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option  value=""> NENHUM REGISTRO ENCONTRADO</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <div class="d-flex flex-column mt-5">
                                                <button type="submit" class="btn btn-login  align-self-center col-sm-4" name="cadastrar">Finalizar Agendamento</button>
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
    
