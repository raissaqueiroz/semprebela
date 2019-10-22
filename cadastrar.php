<?php 
    require_once 'functions/functions.php';
    require_once 'functions/config.php';
    require_once 'functions/conexao.php';
    require_once 'functions/database.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?=TITLE?> - Cadastre-se</title>
        <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/padrao.css">
        <link rel="shortcut icon" href="images/favicon.ico" />
    </head>
    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                    <div class="row flex-grow">
                        <div class="col-lg-6 d-flex align-items-center justify-content-center">
                            <div class="auth-form-transparent text-left p-3">
                                <div class="brand-logo">
                                    <a href="index.php" title="Sempre Bela" class="logo"><?= TITLE ?></a>
                                </div>
                                <h4>Seja Bem Vindo(a)!</h4>
                                <h6 class="font-weight-light">Preencha os campos abaixo para realizar seu cadastro!</h6>
                                <?= getFlash('mensagem') ?>
                                <form class="pt-3" action="login.php" method="POST" autocomplete="off">
                                    <div class="form-group">
                                        <label for="exampleInputEmail">Usuário</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-account-outline text-pink"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Usuário" name="usuario" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Senha</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="mdi mdi-lock-outline text-pink"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Senha" name="senha" required>                        
                                        </div>
                                    </div>
        
                                    <div class="my-3">
                                        <button class="btn btn-block btn-login btn-lg font-weight-medium auth-form-btn" type="submit" name="cadastrar">Cadastrar</button>
                                    </div>
                                
                                    <div class="text-center mt-4 font-weight-light">
                                         Já possui conta ? <a href="index.php" class="btn-text-pink">Entrar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 login-half-bg d-flex flex-row"></div>
                    </div>
                </div>
          <!-- content-wrapper ends -->
            </div>
        
        </div>
      

        <script src="vendors/base/vendor.bundle.base.js"></script>
        <script src="js/template.js"></script>
      
    </body>

</html>
