<?php
include 'cabecalho.php';
include 'validaLogin.php';

if ($_SESSION['tipoConta'] != 'nivel1') {
    header('location:index.php');
}

$id_usuario = '';
$login = '';
$senha = '';
$nome = '';
$tipo_conta = '';

if (isset($_POST['editaUsuario'])) {
    $filtro = array('auxId' => $_POST['idUsuario']);
    $rs = $pdo->prepare("SELECT id_usuario,login,senha,nome,tipo_conta FROM tb_usuario WHERE id_usuario LIKE :auxId");
    if ($rs->execute($filtro)) {
        if ($rs->rowCount() > 0) {
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                $id_usuario = $row->id_usuario;
                $login = $row->login;
                $senha = $row->senha;
                $nome = $row->nome;
                $tipo_conta = $row->tipo_conta;
            }
        }
    }
}
?>

<div class="container">
    <div class="col-md-12">
        <div class="display-4 text-center mt-5 mb-2">
            Gerenciamento do Site
        </div>
        <br>

    </div>

    <!--Novo usuário e editar usuário-->
    <div class="row cadastro">
        <div class="col-md-12">

            <?php if (isset($_POST['editaUsuario'])) { ?>
                <form class="form-group needs-validation justify-content-center" action="editarUsuario.php" method="POST">
                    <h2 class="text-left mb-3">Editar usuário</h2>
                <?php } else { ?>
                    <form class="form-group needs-validation justify-content-center" action="inserirUsuario.php" method="POST">
                        <h2 class="text-left mb-3">Registrar novo usuário</h2>
                    <?php } ?>

                    <div class="form-row">
                        <div class="col-md-1">
                            <label for="idUsuario">Código :</label>
                            <input readonly value="<?php echo $id_usuario; ?>" type="text" name="idUsuario" id="idCliente" class="form-control form-control-sm" arria-describeby="idClienteHelp" placeholder="ID Cliente">
                            <small id="idClienteHelp" class="form-text text-muted">ID.</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="usuario">Usuário: </label>
                            <input type="text" value="<?php echo $login; ?>" name="usuario" class="form-control form-control-sm" id="usuario" aria-describedby="emailHelp" placeholder="Seu usuário aqui!">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="nomeconta">Nome de Perfil: </label>
                            <input type="text" value="<?php echo $nome; ?>" name="nome" class="form-control form-control-sm" id="nomeconta" aria-describedby="emailHelp" placeholder="Seu Nome de Perfil!">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="senha">Senha: </label>
                            <input type="text" name="senha" value="<?php echo $senha; ?>" class="form-control form-control-sm" id="senha" aria-describedby="emailHelp" placeholder="Insira a sua senha">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="senha">Tipo da conta: </label>
                            <select type="select" value="<?php echo $tipo_conta; ?>" class="form-control form-control-sm" name="tipo" placeholder="Tipo de conta" required="">
                                <option value="nivel1">Administrador</option>
                                <option value="nivel2">Gerenciador de Noticias</option>
                                <option value="nivel3">Gerenciador de Avisos</option>
                            </select>
                        </div>
                    </div>

                    <div class="botao text-center">
                        <?php
                        if (isset($_POST['editaUsuario'])) { ?>
                            <button type='submit' name='editarUsuario' id='editClienteDB' class='btn btn-success btn-block btn-sm form-control'><i class='fas fa-save'></i> Atualizar</button>
                        <?php } else { ?>
                            <button type="submit" class="btn btn-primary btn-block btn-sm mb-3 mt-2" id="botao" name="cadastrarUsuario" class="btn">Cadastrar Usuario</button>
                        <?php }

                    ?>
                    </div>

                </form>

        </div>
    </div>
    <div>
        <table class="table table-sm text-center">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Login</th>
                    <th scope="col">Senha</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo_Conta</th>
                    <th scope="col"><button type="submit" class="btn btn-light" disabled><i class="far fa-trash-alt"></i></button></th>
                    <th scope="col"><button type="submit" class="btn btn-light" disabled><i class="far fa-edit"></i></button></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //busca os usuários
                $filtro = array('auxNome' => '%%');
                $rs = $pdo->prepare("SELECT id_usuario,login,senha,nome, tipo_conta
                  FROM tb_usuario WHERE nome LIKE :auxNome");
                if ($rs->execute($filtro)) {
                    if ($rs->rowCount() > 0) {
                        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<th scope='row'>{$row->id_usuario}</td>";
                            echo "<td>{$row->login}</td>";
                            echo "<td>{$row->senha}</td>";
                            echo "<td>{$row->nome}</td>";
                            echo "<td>{$row->tipo_conta}</td>";

                            echo "<td><form action='deletarUsuario.php' method='POST' name='delUsuario{$row->id_usuario}'>
                      <input type='hidden' name='idUsuario' value='{$row->id_usuario}'>
                      <button class='btn btn-danger' type='submit' name='deletaUsuario'><i class='far fa-trash-alt'></i></button>
                      </form></td>";


                            echo "<td><form action='gerenciamentoSite.php' method='POST' name='editUsuario{$row->id_usuario}'>
                      <input type='hidden' name='idUsuario' value='{$row->id_usuario}'>
                      <button class='btn btn-success' type='submit' name='editaUsuario'><i class='far fa-edit'></i></button>
                      </form></td>";
                            echo "</tr>";
                        }
                    }
                }

                echo "</tbody>";
                ?>

            </tbody>
        </table>
    </div>


    <!--Dados da empresa-->

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
                    <input type="file" class="form-control" name="imagem" value="" >
                </div>
                <div class="form-group col-md-1">
                <?php echo "<img src='{$mostraEmpresa->logo}' width='85' height='85' class='d-inline-block align-top'>";?>
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