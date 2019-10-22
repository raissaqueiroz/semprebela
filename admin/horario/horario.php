<?php 
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['edit']) || !empty($_POST['edit'])){
            $id = $nome = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $dados = dbread("horario", "where id = '{$id}'");
            $hora = $dados[0]['HORA'];
            $fk_servico = $dados[0]['FK_SERVICO'];
            if((isset($hora) && isset($fk_servico)) || (!empty($hora) && !empty($fk_servico))){
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
                                            <div class="form-group">
                                                <label class="label-input" for="servico">Serviço</label>
                                                <select class="form-control form-control-lg" id="servico" name="servico">
                                                    <?php 
                                                    $servicos = dbRead("servico");
                                                    if($servicos):
                                                        foreach($servicos as $servico): 
                                                    ?>
                                                        <option value="<?=$servico['ID']?>"><?=$servico['NOME']?></option> 
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option  value=""> NENHUM REGISTRO ENCONTRADO</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="label-input" for="valor">Hora</label>
                                                <input type="text" class="form-control" name="hora" id="hora" placeholder="Hora: HH:MM">
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
            $id = $nome = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $delete = dbDelete("horario", "ID = '{$id}'");
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
    
