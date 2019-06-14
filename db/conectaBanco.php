<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_noticia', 'root', '12345', []);
} catch (PDOException $e) {
    echo '<br><br><br>Erro ao conectar com o MySQL!!!<br><br>' . $e->getMessage();
    exit();
}
?>
