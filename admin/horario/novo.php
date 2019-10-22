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
                                <button type="submit" class="btn btn-login  align-self-center col-sm-4" name="cadastrar">Cadastrar</button>
                            </div>
                        </form>
                        <!-- </div> -->
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
        </div>
		<!-- page-body-wrapper ends -->
    </div>
</div>
<?php require_once '../../includes/rodape.php'; ?>
