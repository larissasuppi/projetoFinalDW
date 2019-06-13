<!DOCTYPE html>

<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="css/styleLogin.css" rel="stylesheet">

</head>

<body>
    <div class="login">
        <img src="img/logo_info.png" class="usuario" width="100" height="100" alt="">
        <h1 class="text-center">LOGIN</h1>
        <form method="POST" action="db/validaLoginBanco.php">

            <div class="form-group text-center mt-3">
                <label for="exampleInputEmail1">Endereço de email</label>
                <input type="text" name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
            </div>
            <div class="form-group text-center mt-3">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Senha">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-light text-center mt-3" name="logaUsuario" value="Entrar">
            </div>

        </form>
    </div>
</body>

</html>