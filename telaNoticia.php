<?php include 'cabecalho.php'; ?>
<div class="container-fluid text-center">
    <div class="row">
        <div class="col-md-12">
            <?php
            $noticia = array(':idNoticia' => $_GET['idNoticia']);

            $rs = $pdo->prepare("SELECT * from tb_noticia WHERE id_noticia = :idNoticia ");
            $rs->execute($noticia);
            $mostraNoticia = $rs->fetch(PDO::FETCH_OBJ);

            echo '<div class="jumbotron jumbotron-fluid">';
            echo "<h1>{$mostraNoticia->titulo_noticia}</h1>";
            echo "<p class='mt-4'>Escrito por {$mostraNoticia->Criador_Noticia} em {$mostraNoticia->data_noticia} </p>";
            echo "<h6 class='mt-3 mb-0'>{$mostraNoticia->resumo_noticia}</h6>";

            if (isset($_SESSION['logado'])) {
                if ($_SESSION['tipoConta'] == 'nivel1' || $_SESSION['tipoConta'] == 'nivel2') {
                    echo '<div class="btn-group">';
                    echo "<td><form action='gerenciarNoticia.php' method='post' name='detalhes{$mostraNoticia->id_noticia}'>
            
            <input type='hidden' name='idNoticia' value='{$mostraNoticia->id_noticia}'>";

                    echo "<button class='btn btn-success btn-sm mr-4 mt-4 mb-0 ' type='submit' name='editaNoticia'>Alterar</button>";
                    echo "</form>";
                    echo "<form action='db/acoes.php' method='post' name='detalhes{$mostraNoticia->id_noticia}'>
                        <input type='hidden' name='idNoticia' value='{$mostraNoticia->id_noticia}'>";
                    echo "<button class='btn btn-danger btn-sm mt-4 mb-0'type='submit' name='deleteNoticia'>Deletar</button>";
                    echo "</form></td>";
                    echo "</div>";
                }
            }
            
            echo '</div>';

           echo '<div class="container">';
            echo "<p class='text-justify'>{$mostraNoticia->noticia}</p>";

            echo "<img src='{$mostraNoticia->img_noticia}'class='mt-5 mb-5' width='1000px' height='auto'>";
            echo "</div>";
            ?>
        
            
        </div>
    </div>
</div>
<?php include 'rodape.php'; ?>