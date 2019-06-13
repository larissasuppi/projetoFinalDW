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
                <h2 class="text-left mb-5">Registrar novo usuario</h2>
                <p>Usuario</p>
                <input type="text" class="form-control" name="usuario" placeholder="Insira seu nome de usuario" required="">

                <p>Nome de Perfil</p>
                <input type="text" class="form-control" name="nome" placeholder="Insira seu nome completo" required="">

                <p>Senha</p>
                <input type="password" class="form-control" name="senha" placeholder="Insira sua senha" required="">

                <p>Tipo de Conta</p>
                <select type="select" class="form-control" name="tipo" placeholder="Tipo de conta" required="">
                    <option value="nivel1">Administrador</option>
                    <option value="nivel2">Gerenciador de Noticias</option>
                    <option value="nivel3">Gerenciador de Avisos</option>
                </select>

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
        <h2 class="text-left mb-5">Alterar Dados da empresa</h2>
        <form enctype="multipart/form-data" class="form-group needs-validation justify-content-center" action="db/acoes.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <p>Nome da Empresa</p>
                    <input type="text" class="form-control" name="nome" value="<?php echo $mostraEmpresa->nome_empresa ?>">
                    <p>Telefone para contato</p>
                    <input type="text" class="form-control" name="tel" value="<?php echo $mostraEmpresa->telefone ?>">
                    <p>Email</p>
                    <input type="text" class="form-control" name="email" value="<?php echo $mostraEmpresa->email ?>">
                    <p>Logo</p>
                    <?php echo "<img src='{$mostraEmpresa->logo}' width='30' height='30' class='d-inline-block align-top'>";?>
                    <input type="file" class="form-control" name="imagem" value="" required="">
                </div>
            </div>

            <div class="botaoAlterarEmpresa text-center">
            <button type="submit" class="btn btn-primary  btn-block mb-2" id="botao" name="alteraEmpresa" class="btn">Alterar dados da empresa</button>
            </div>
           

        </form>
    </div>
</div>


<?php include 'rodape.php' ?>