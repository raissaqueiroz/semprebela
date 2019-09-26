<?php
	#abrindo conexão
	function dbConnect(){
		//conexão
		$conn = @mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Falha na conexão: ".@mysqli_connect_error());
		//codificação do banco
		@mysqli_set_charset($conn, DB_CHARSET) or die("Erro no padrão de codificação do banco: ".@mysqli_error($conn));

		return $conn;
	}
	#fechando conexão
	function dbClose($conexao){
		@mysqli_close($conexao) or die("Erro ao tentar fechar conexão com o banco: ".@mysqli_error($conexao));
	}
?>