<?php
include('conexao.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmar = trim($_POST['confirmar']);

    // Verificações básicas
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar)) {
        echo "Preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido.";
    } elseif ($senha !== $confirmar) {
        echo "As senhas não coincidem.";
    } else {
        // Verifica se o e-mail já está cadastrado
        $sql = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Este e-mail já está cadastrado.";
        } else {
            // Cria o hash da senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Insere o novo usuário
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senhaHash);

            if ($stmt->execute()) {
                echo "✅ Cadastro realizado com sucesso!";
                header("Refresh: 2; URL=index.php"); // redireciona após 2 segundos
                exit;
            } else {
                echo "Erro ao cadastrar: " . $stmt->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Criar Conta</h1>
    <form method="POST" action="">
        <p>
            <label>Nome:</label><br>
            <input type="text" name="nome" required>
        </p>
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </p>
        <p>
            <label>Senha:</label><br>
            <input type="password" name="senha" required>
        </p>
        <p>
            <label>Confirmar Senha:</label><br>
            <input type="password" name="confirmar" required>
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>

    <p>Já tem uma conta? <a href="index.php">Entrar</a></p>
</body>
</html>
