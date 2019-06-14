<?php
    include './db/conectaBanco.php';
    session_start();
    
    if (isset($_POST['editarUsuario'])) {

        $alteraUsuario = array(':id' => $_POST['idUsuario'],
            ':login' => $_POST['usuario'],
            ':nome' => $_POST['nome'],
            ':senha' => $_POST['senha'],
            ':tipoConta' => $_POST['tipo']);
    
        $stmt = $pdo->prepare("UPDATE `tb_usuario` SET `login`= :login,`nome`=:nome,`senha`=:senha,`tipo_conta`=:tipoConta WHERE id_usuario = :id");
        $stmt->execute($alteraUsuario);
    
        if ($stmt->rowCount() > 0) {
            header('location: gerenciarSite.php');
        } else {
            echo "<br><br><br>ERRO novo!!!!!";
        }
    }
    

?>