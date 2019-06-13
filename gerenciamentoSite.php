<?php
include 'cabecalho.php';
include 'validaLogin.php';

if ($_SESSION['tipoConta'] != 'nivel1') {
    header('location:index.php');
}
?>

<div class="container">
    <div class="col-md-12">
        <div class="display-4 text-center mt-5 mb-2">
            Gerenciamento do Site
        </div>
        <br>

    </div>
    <!--CRIAR NOVO USUARIO-->
    <div class="row cadastro">
        <div class="col-md-12">
            <form class="form-group needs-validation justify-content-center" action="db/acoes.php" method="post">
                <h2 class="text-left mb-3">Registrar novo usuario</h2>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="usuario">Usuário: </label>
                        <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="emailHelp" placeholder="Seu usuário aqui!">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nomeconta">Nome de Perfil: </label>
                        <input type="text" name="nome" class="form-control" id="nomeconta" aria-describedby="emailHelp" placeholder="Seu Nome de Perfil!">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="senha">Senha: </label>
                        <input type="text" name="senha" class="form-control" id="senha" aria-describedby="emailHelp" placeholder="Insira a sua senha">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="senha">Tipo da conta: </label>
                        <select type="select" class="form-control" name="tipo" placeholder="Tipo de conta" required="">
                            <option value="nivel1">Administrador</option>
                            <option value="nivel2">Gerenciador de Noticias</option>
                            <option value="nivel3">Gerenciador de Avisos</option>
                        </select>
                    </div>
                </div>

                <div class="botao text-center">
                    <button type="submit" class="btn btn-primary btn-block mb-3 mt-2" id="botao" name="cadatrarUsuario" class="btn">Cadastrar Usuario</button>
                </div>

            </form>
        </div>
    </div>

    <!--EDITAR DADOS DA EMPRESA-->

    <?PHP
    $rs = $pdo->prepare("SELECT * from tb_empresa WHERE id_empresa = 1");
    $rs->execute();
    $mostraEmpresa = $rs->fetch(PDO::FETCH_OBJ);
    ?>

    <div class="col-md-12">
        <h2 class="text-left mb-3 mt-4">Alterar Dados da empresa</h2>
        <form enctype="multipart/form-data" class="form-group needs-validation justify-content-center" action="db/acoes.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <p>Nome da Empresa:</p>
                    <input type="text" class="form-control" name="nome" value="<?php echo $mostraEmpresa->nome_empresa ?>">
                </div>
                <div class="form-group col-md-6">
                    <p>Telefone para contato:</p>
                    <input type="text" class="form-control" name="tel" value="<?php echo $mostraEmpresa->telefone ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <p>Email:</p>
                    <input type="text" class="form-control" name="email" value="<?php echo $mostraEmpresa->email ?>">
                </div>
                <div class="form-group col-md-5">
                    <p>Logo:</p>
                    <input type="file" class="form-control" name="imagem" value="" required="">
                </div>
                <div class="form-group col-md-1">
                    <?php echo "<img src='{$mostraEmpresa->logo}' width='85' height='85' class=' align-center'>"; ?>
                </div>

            </div>
    </div>

    <div class="botaoAlterarEmpresa text-center mb-4">
        <button type="submit" class="btn btn-primary  btn-block mb-2" id="botao" name="alteraEmpresa" class="btn">Alterar dados da empresa</button>
    </div>


    </form>
</div>
</div>


<?php include 'rodape.php' ?>