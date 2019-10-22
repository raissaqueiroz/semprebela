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
                        <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
                            <?php 
                            $servicos = dbRead('servico');
                            if($servicos):
                                foreach ($servicos as $servico): ?>
                                <div class="col-sm-4 text-center">
                                    <table class="table table-striped">
                                        <thead>     
                                            <tr>
                                                <th class="text-center"><strong><?=$servico['NOME']?></strong></th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            <?php
                                            $horarios = dbRead("horario", "WHERE FK_SERVICO = '{$servico['ID']}'");
                                            if($horarios):
                                                foreach ($horarios as $horario):?>
                                                    <tr>
                                                        <td class="text-center"><?= $horario['HORA']?></td>
                                                        <td>
                                                        <form action="horario.php" method="POST">
                                                            <input type="hidden" value="<?= $horario['ID'] ?>" name="id" ?>
                                                            <button class="btn btn-login" type="submit" name="edit"><i class="mdi mdi-grease-pencil"></i></button>
                                                            <button class="btn btn-login" type="submit" name="delete"><i class="mdi mdi-account-remove"></i></button>
                                                        </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>   
                                    </table>
                                </div>  
                                <?php endforeach; ?>
                            <?php else: ?>
                            <h5 class="text-center"> Nenhum Horário Encontrado </h5>
                            <?php endif; ?>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>           
</div>
<?php require_once '../../includes/rodape.php'; ?>