<?php include 'cabecalho.php'; ?>

<div class="container-fluid">
    <!-- Carrossel com imagens e noticias - ultimas tres noticias -->
    <div class="row">
        <div class="col-md-12">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <?php

                    $controle_ativo = 2;
                    $rsNoticia = $pdo->prepare("SELECT * from tb_noticia order by id_noticia DESC LIMIT 3");


                    if ($rsNoticia->execute()) {
                        if ($rsNoticia->rowCount() > 0) {
                            while ($mostraNoticia = $rsNoticia->fetch(PDO::FETCH_OBJ)) {
                                if ($controle_ativo == 2) { ?>
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" <?php echo "src='{$mostraNoticia->img_noticia}' widht = '500px' height = '400px'" ?> alt="Primeiro slide">
                                        <div class="carousel-caption d-none d-md-block">
                                        <?php echo "<h4><a href='detalheNoticia.php?idNoticia={$mostraNoticia->id_noticia}' class='' >{$mostraNoticia->titulo_noticia}</a></h4>"; 
                                             echo "<p>{$mostraNoticia->resumo_noticia}</p>";
                                            ?>
                                        </div>
                                        </form>


                                    </div><?php
                                            $controle_ativo = 1;
                                        } else { ?>
                                    <div class="carousel-item ">
                                        <img class="d-block w-100 " <?php echo "src='{$mostraNoticia->img_noticia}' widht = '500px' height = '400px'" ?> alt="Primeiro slide">
                                        <div class="carousel-caption d-none d-md-block">
                                        <?php echo "<h4><a href='detalheNoticia.php?idNoticia={$mostraNoticia->id_noticia}' class='' >{$mostraNoticia->titulo_noticia}</a></h4>"; 
                                             echo "<p>{$mostraNoticia->resumo_noticia}</p>";
                                            ?>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    }
                }
                ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>

        </div>
    </div>
    <div class="row">

        <!--Noticias-->
        <div class="col-md-9">

            <div class="jumbotron jumbotron-fluid mt-4">
                <div class="container">
                    <h2 class="text-center">Últimas Notícias</h2>
                </div>
            </div>
            <!--Carregando noticias-->
            <?php
            if (isset($_SESSION['logado']) && $_SESSION['tipoConta'] == 'nivel1') {
                $rsNoticia = $pdo->prepare("SELECT * from tb_noticia order by id_noticia DESC");
            } else {
                $rsNoticia = $pdo->prepare("SELECT * FROM tb_noticia WHERE (data_entra <= CURRENT_DATE AND data_sai > CURRENT_DATE) order by id_noticia desc LIMIT 5");
            }

            if ($rsNoticia->execute()) {
                if ($rsNoticia->rowCount() > 0) {
                    while ($mostraNoticia = $rsNoticia->fetch(PDO::FETCH_OBJ)) { ?>

                        <div class="card col-md-12 mr-4 mt-4 mb-4 text-center">
                            <div class="card-body">
                                <?php echo "<h4><a href='detalheNoticia.php?idNoticia={$mostraNoticia->id_noticia}' class='' >{$mostraNoticia->titulo_noticia}</a></h4>"; ?>
                                <p><?php echo "{$mostraNoticia->resumo_noticia}" ?></p>
                                <p class=''>
                                    <?php echo date_format(new DateTime($mostraNoticia->data_noticia), 'd/m/Y'); ?>
                                </p>

                                <?php

                                echo "</div>";
                                echo "</div>";
                            }
                        }
                    }
                    ?>


                </div>



                <!--Avisos-->
                <div class="col-md-3">
                    <div class="jumbotron jumbotron-fluid mt-4">
                        <div class="container">
                            <h2 class="text-center">Avisos</h2>
                        </div>
                    </div>

                    <!--Inserindo dados na tela-->

                    <div class="avisos">
                        <?php
                        if (isset($_SESSION['logado']) && $_SESSION['tipoConta'] == 'nivel1') {
                            $rs2 = $pdo->prepare("SELECT * from tb_avisos order by id_avisos DESC");
                        } else {
                            $rs2 = $pdo->prepare("SELECT * FROM tb_avisos WHERE (data_entrada <= CURRENT_DATE AND data_saida >= CURRENT_DATE)");
                        }

                        if ($rs2->execute()) {
                            if ($rs2->rowCount() > 0) {
                                while ($mostraAvisos = $rs2->fetch(PDO::FETCH_OBJ)) { ?>
                                    <div class="card col-md-12  mt-4 mb-4 text-center">
                                        <div class="card-body">
                                            <p><?php echo "<h5>{$mostraAvisos->aviso}</h5>" ?></p>
                                            <p> <?php echo "<p>{$mostraAvisos->Criador_Aviso}</p>" ?></p>
                                        </div>

                                        <div class="row">
                                            <?php
                                            if (isset($_SESSION['logado'])) {
                                                if ($_SESSION['tipoConta'] == 'nivel1' || $_SESSION['tipoConta'] == 'nivel3') {
                                                    echo '<div class="col-md-2">';
                                                    echo '</div>';
                                                    echo '<form action="gerenciamentoAviso.php" class="col-md-4 text-center" method="POST">';
                                                    echo "<input type='hidden' name='idAviso' value='{$mostraAvisos->id_avisos}'>";
                                                    echo "<button class='btn btn-success text-center btn-block alterar btn-sm mb-2' type='submit' name='editaAviso'><i class='fas fa-edit'></i>Alterar</button>";
                                                    echo '</form>';
                                                    echo '<form action="db/acoes.php" class="col-md-4 text-center" method="POST">';
                                                    echo "<input type='hidden' name='idAviso' value='{$mostraAvisos->id_avisos}'>";
                                                    echo "<button class='btn btn-danger text-center btn-block btn-sm mb-2' type='submit' name='deletaAviso'><i class='fas fa-edit'></i>Deletar</button>";
                                                    echo '</form>';
                                                    echo '<div class="col-md-2">';
                                                    echo '</div>';
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    }
                    ?>
                    </div>

                </div>
            </div>
        </div>
        <?php include 'rodape.php'; ?>