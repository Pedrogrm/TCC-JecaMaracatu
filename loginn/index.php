<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// include('conexao.php');
// session_start();

// if (isset($_POST['email']) && isset($_POST['senha'])) {

//     if(strlen($_POST['email']) == 0) {
//         echo "Preencha seu email";
//     } else if(strlen($_POST['senha']) == 0) {
//         echo "Preencha sua senha";
//     } else {

//         $email = $mysqli->real_escape_string($_POST['email']);
//         $senha = $mysqli->real_escape_string($_POST['senha']);

//         $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
//         $sql_query = $mysqli->query($sql_code) or die("Falha na execução do codigo Sql:" . $mysqli->error);

//         $quantidade = $sql_query->num_rows;

//         if($quantidade == 1) {

//             $usuario = $sql_query->fetch_assoc();

//             if(!isset($_SESSION)) {
//                 session_start();
//             }

//             $_SESSION['user'] = $usuario['id'];
//             $_SESSION['nome'] = $usuario['nome'];

//             header("Location: painel.php");

//         } else {
//             echo "falha ao logar email ou senha incorretos";
//         }
//     }
    
// }
?>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Acessar a conta</h1>
        <form action="" method="POST">
            <p>
                <label>email</label>
                <input type="email" name="email">
            </p>
            <p>
                <label>senha</label>
                <input type="password" name="senha">
            </p>
            <p>
                 <button type="submit">Login</button>
            </p>
        </form>
</body>
</html> -->

<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('conexao.php');
session_start();

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Verificações básicas
    if (empty($email)) {
        echo "Preencha seu e-mail.";
    } elseif (empty($senha)) {
        echo "Preencha sua senha.";
    } else {

        // Procura usuário pelo e-mail
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do SQL: " . $mysqli->error);

        if ($sql_query->num_rows == 1) {
            $usuario = $sql_query->fetch_assoc();

            // Verifica se a senha digitada bate com o hash do banco
            if (password_verify($senha, $usuario['senha'])) {

                $_SESSION['id'] = $usuario['id'];       // ID do usuário na sessão
                $_SESSION['nome'] = $usuario['nome'];   // Nome para mostrar no painel

                header("Location: painel.php");
                exit;

            } else {
                echo "Senha incorreta.";
            }

        } else {
            echo "E-mail não encontrado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header>
    <div class="logo">
     <img src="img/Maracatu-removebg-preview.png" alt="Logo Maracatu">
    </div>
    <nav>
     <a href="inicio.html"><button>Sign up</button></a>
    </nav>
  </header>

    <h1>Acessar a conta</h1>
    <form action="" method="POST">
        <p>
            <label>E-mail:</label><br>
            <input type="email" name="email" required>
        </p>
        <p>
            <label>Senha:</label><br>
            <input type="password" name="senha" required>
        </p>
        <p>
            <button type="submit">Login</button>
        </p>
    </form>

    <p>Não tem conta? <a href="cadastro.php">Cadastre-se aqui</a></p>

    <p>login <a href="Login.php">teste</a></p>
</body>
</html>
