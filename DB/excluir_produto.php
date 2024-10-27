<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redireciona se não estiver logado
    exit();
}

// Inclui a conexão com o banco de dados
require_once 'conexao.php';

// Verifica se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Prepara a consulta para alterar o status do produto
    $query = "UPDATE produto SET status = 0 WHERE id_produto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produto);
    
    // Tenta realizar a alteração
    if ($stmt->execute()) {
        echo "<script>alert('Produto excluido com sucesso!'); window.location.href='../consultar_produto.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o status do produto.'); window.location.href='../consultar_produto.php';</script>";
    }
} else {
    echo "<script>alert('ID do produto não fornecido!'); window.location.href='../consultar_produto.php';</script>";
    exit();
}
?>
