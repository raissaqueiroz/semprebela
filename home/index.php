<?php 
    require_once '../functions/functions.php';
    require_once '../functions/config.php';
    require_once '../functions/conexao.php';
    require_once '../functions/database.php';

    if(!isset($_SESSION['nivel']) || empty($_SESSION['nivel'])){
        flash("mensagem", "É necessário estar logado para acessar essa área!", "danger");
        header("Location: ../../index.php");
    } else {
        if($_SESSION['nivel'] != 2){
            flash("mensagem", "Você não tem permissão para acessar essa área!", "danger");
            header("Location: ../../index.php");
        } 
    } 

    if($_SESSION['status'] != 'S'){
        header("Location: cadastro/");
    } 
        require_once '../includes/cabecalho.php';
        require_once 'includes/menu.php';
?>
<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <?= getFlash('mensagem') ?>
                        <div class="d-flex flex-column mt-5">                                    
                            <h3 class="text-primary col-sm-1 align-self-center">Olá! Seja Bem Vindo(a)!</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
