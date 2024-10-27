<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redireciona se não estiver logado
    exit();
}

// Inclui a conexão com o banco de dados
require_once 'conexao.php';

// Verifica se o ID do empréstimo e as informações adicionais foram passadas
if (isset($_POST['id_emprestimo']) && isset($_POST['info_adicional'])) {
    $id_emprestimo = intval($_POST['id_emprestimo']);
    $info_adicional = $conn->real_escape_string(trim($_POST['info_adicional']));

    // Prepara a consulta para atualizar o status do empréstimo e adicionar informações adicionais
    $query_update = "UPDATE emprestimo SET status = 0, info_adicional = ? WHERE id_emprestimo = ?";
    
    if ($stmt = $conn->prepare($query_update)) {
        $stmt->bind_param("si", $info_adicional, $id_emprestimo);
        
        if ($stmt->execute()) {
            echo "<script>alert('Devolução registrada com sucesso!'); window.location.href='../consultar_emprestimo.php';</script>";
        } else {
            echo "<script>alert('Erro ao registrar a devolução.'); window.location.href='../consultar_emprestimo.php';</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('Erro ao preparar a consulta.'); window.location.href='../consultar_emprestimo.php';</script>";
    }
} else {
    echo "<script>alert('Dados de devolução não fornecidos.'); window.location.href='../consultar_emprestimo.php';</script>";
}

// Fecha a conexão
$conn->close();
?>
