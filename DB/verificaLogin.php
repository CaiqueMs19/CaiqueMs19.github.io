<?php
session_start();
require_once 'conexao.php'; // Certifique-se de que o caminho para o arquivo de conexão esteja correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Prepara a consulta
    $query = "SELECT id_user, usuario, senha FROM usuario WHERE usuario = ?"; // Seleciona o id_usuario
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica se a senha está correta
        if (password_verify($senha, $row['senha'])) {
            $_SESSION['usuario'] = $row['usuario']; // Armazena o nome de usuário na sessão
            $_SESSION['id_user'] = $row['id_user']; // Armazena o ID do usuário na sessão
            header("Location: ../controle.php"); // Redireciona para a página principal
            exit();
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='../login.php';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href='../login.php';</script>";
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
}
?>
