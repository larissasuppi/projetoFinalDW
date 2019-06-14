<?php
  include './db/conectaBanco.php';
  session_start();

    if (isset($_POST['cadastrarUsuario'])) { 

        $novo_usuario = array(
            ':usuario' => $_POST['usuario'],
            ':nome' => $_POST['nome'],
            ':senha' => $_POST['senha'],
            ':tipo' => $_POST['tipo']
        );
    
        $stmt = $pdo->prepare("INSERT INTO tb_usuario (login,nome,senha,tipo_conta)
            VALUES (:usuario,:nome,:senha,:tipo)");
        $stmt->execute($novo_usuario);
    
        if ($stmt->rowCount() > 0) {
            include('gerenciarSite.php');
        } else {
            echo "<br><br><br>ERRO novo!!!!!";
        }
    }
