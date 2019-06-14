<?php
include './db/conectaBanco.php';
session_start();

if (isset($_POST['deletaUsuario'])) {
    $exclui_usuario = array('id' => $_POST['idUsuario']);
    $stmt = $pdo->prepare("DELETE FROM tb_usuario WHERE id_usuario = :id");
    $stmt->execute($exclui_usuario);

    if ($stmt->rowCount() > 0) {
        include('gerenciamentoSite.php');
    } else {
    echo "<br><br><br>ERRO Excluir!!!!!";
    }
}
    
