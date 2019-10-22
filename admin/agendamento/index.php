<?php
    require_once '../../functions/functions.php';
    require_once '../../functions/config.php';
    require_once '../../functions/conexao.php';
    require_once '../../functions/database.php';

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
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <?= getFlash('mensagem') ?>
                        <div class="d-flex flex-column mb-5">                                    
                            <a class="btn btn-login col-sm-1 align-self-end" href="novo.php"><i class="mdi mdi-account-plus"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><strong>Cliente</strong></th>
                                        <th><strong>Serviço</strong></th>
                                        <th><strong>Data</strong></th>
                                        <th><strong>Hora</strong></th>
                                        <th><strong>Valor</strong></th>
                                        <th><strong>Ações</strong></th>
                                    </tr>         
                                </thead>
                                <tbody>
                                    <?php
                                    $agendamentos = dbRead('agendamento');
                                    if($agendamentos):
                                        foreach ($agendamentos as $agendamento):
                                            $cliente = dbRead("cliente", "WHERE ID = '{$agendamento['FK_CLIENTE']}'");
                                            $horario = dbRead("horario", "WHERE ID = '{$agendamento['FK_HORARIO']}'");
                                            $servico = dbRead("servico", "WHERE ID = '{$horario[0]['FK_SERVICO']}'"); 
                                        ?>
                                        <tr>
                                            <td><?= $cliente[0]['NOME']; ?></td>
                                            <td><?= $servico[0]['NOME']; ?></td>
                                            <td><?= dateExport($agendamento['DATA']); ?></td>
                                            <td><?= $horario[0]['HORA']; ?></td>
                                            <td><?= $servico[0]['VALOR']; ?></td>
                                            <td>
                                                <form action="agendamento.php" method="POST">
                                                    <input type="hidden" value="<?= $agendamento['ID'] ?>" name="id" ?>
                                                    <button class="btn btn-login" type="submit" name="delete"><i class="mdi mdi-account-remove"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhum registro encontrado</td> 
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>           
</div>
<?php require_once '../includes/rodape.php'; ?>