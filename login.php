<?php 

try {
	
	$pdo = new PDO('mysql:host=localhost;dbname=loginajax', 'root', '');
	
	
	
} catch(PDOException $e) {
	echo 'Erro: '.$e->getMessage();
	exit;
}

if (isset($_POST['email']) && !empty($_POST['email'])) {
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	
	$sql = 'SELECT * FROM usuarios WHERE email = :email AND senha = :senha';
	$sql = $pdo->prepare($sql);
	$sql->bindValue(':email', $email);
	$sql->bindValue(':senha', md5($senha));
	$sql->execute();
	
	if ($sql->rowCount() > 0) {
		echo 'Usuário logado com sucesso!';
	} else {
		echo 'E-mail e/ou senha estão errados!';
	}
} else {
	echo 'Digite um email e/ou senha!';
}
