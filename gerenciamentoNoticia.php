<?php
include './cabecalho.php';
include './validaLogin.php';

if ($_SESSION['tipoConta'] == 'nivel3') {
    header('location:index.php');
}

if (isset($_POST['editaNoticia'])) {
    $noticia = array(':idCliente' => $_POST['idNoticia']);
    $idNoticia = $_POST['idNoticia'];

    $rs = $pdo->prepare("SELECT * from tb_noticia WHERE id_noticia = :idCliente ");
    $rs->execute($noticia);
    $mostraNoticia = $rs->fetch(PDO::FETCH_OBJ);
    $dataFormatadaEntrada = date('Y-m-d\TH:i', strtotime($mostraNoticia->data_entra));
    $dataFormatadaSaida = date('Y-m-d\TH:i', strtotime($mostraNoticia->data_sai));
}
?>

<div class="container">
    <div class="row formulario">
        <div class="col-md-12">
            <?php
            if (isset($_POST['editaNoticia'])) {
                echo '<div class = "display-4 text-center mb-4">Alterar Noticia</div>';
            } else {
                echo '<div class = "display-4 text-center mb-4">Inserir Noticia</div>';
            }
            ?>
        </div>
    </div>   
    <div class="row cadastro">
        <div class="col-md-12">
            <form enctype="multipart/form-data" class="form-group needs-validation justify-content-center" method="post" action="db/acoes.php" novalidate>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputCodigo">Título</label>
                        <input type="text" class="form-control" id="inputCodigo" onfocus=" placeholder="Título" name="titulo" required="" value="<?php echo isset($_POST['editaNoticia']) ? $mostraNoticia->titulo_noticia : ""; ?>">  
                    </div>
                    <div class="form-group col-md-7">
                        <label for="inputDesc">Resumo</label>
                        <input type="text" class="form-control" id="inputDesc" name="resumo" required="" placeholder="Resumo da notícia" value="<?php
                        if (isset($_POST['editaNoticia'])) {
                            echo $mostraNoticia->resumo_noticia;
                        }
                        ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputDesc">Noticia Completa</label>
                        <textarea style="resize: vertical" class="form-control" id="inputDesc" rows="4" name="noticia" placeholder="Insira a notícia aqui" required ><?php
                            if (isset($_POST['editaNoticia'])) {
                                echo $mostraNoticia->noticia;
                            }
                            ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="imagem">Foto: </label>
                        <input type="file" class="form-control border-0" id="imagem" name="imagem">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Disponivel de:</label>
                        <input type="datetime-local" class="form-control"  name="dataEntrada" required value="<?php
                        if (isset($_POST['editaNoticia'])) {
                            echo $dataFormatadaEntrada;
                        }
                        ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Até:</label>
                        <input type="datetime-local" class="form-control" name="dataSaida" required value="<?php
                        if (isset($_POST['editaNoticia'])) {
                            echo $dataFormatadaSaida;
                        }
                        ?>">
                    </div>
                </div>

                <div class="botao text-center ">
                    <?php
                    if (isset($_POST['editaNoticia'])) {
                        echo "<input type='hidden' name='idNoticia' value='$idNoticia'>";
                        echo '<button type="submit" class="btn btn-primary mb-2 btn-block" id="botao" name="atualizaNoticia" class="btn">Atualizar</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-primary mb-2 btn-block" id="botao" name="salvaNoticia" class="btn">Salvar</button>';
                    }
                    ?>
                </div>   
            </form>
        </div>
    </div>
</div>
<?php
include './rodape.php';
?>