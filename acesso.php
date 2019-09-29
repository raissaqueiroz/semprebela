<?php 
	require_once 'functions/functions.php';
	carregaIncludes("functions/", array("config", "conexao", "database"));
	if(!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])){
		flash("mensagem", "É necessário estar logado para acessar essa área!", "danger");
		header("Location: index.php");
	}  
    
	
?>