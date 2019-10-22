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
                        <div class="d-flex flex-column mb-5">                                    
                            <a class="btn btn-login col-sm-1 align-self-end" href="novo.php"><i class="mdi mdi-account-plus"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><strong>Nome</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Telefone</strong></th>
                                        <th><strong>CPF</strong></th>
                                        <th><strong>RG</strong></th>
                                    </tr>
                                                       
                                </thead>
                                <tbody>
                                    <?php
                                    $clientes = dbRead('cliente');
                                    if($clientes):
                                        foreach ($clientes as $cliente):
                                        ?>
                                        <tr>
                                            <td><?= $cliente['NOME']?></td>
                                            <td><?= $cliente['EMAIL']?></td>
                                            <td><?= $cliente['TELEFONE']?></td>
                                            <td><?= $cliente['CPF']?></td>
                                            <td><?= $cliente['RG']?></td> 
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhum registro encontrado</td> 
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