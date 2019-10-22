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
                                <label class="label-input" for="usuario">Usuário</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuário">
                            </div>
                            <div class="form-group">
                                <label class="label-input" for="senha">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
                            </div>
                            <div class="form-group">
                                <label class="label-input" for="nome">Nome completo</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
                            </div>
                            <div class="form-group">
                                <label class="label-input" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-input" for="dtnasc">Data de Nascimento</label>
                                <input type="date" name="dtmasc" class="form-control" id="dtnasc" placeholder="dd/mm/yyyy"/>   
                            </div>
                            <div class="form-group">
                                <label class="label-input" for="telefone">Telefone</label>
                                <input type="telefone" class="form-control" name="telefone" id="telefone" placeholder="Telefone">
                            </div>
                            <div class="form-group">
                                <label class="label-input" for="rg">RG</label>
                                <input type="text" class="form-control" name="rg" id="rg" placeholder="RG">
                            </div>
                            <div class="form-group">
                                <label class="label-input" for="cpf">CPF</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF">
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
