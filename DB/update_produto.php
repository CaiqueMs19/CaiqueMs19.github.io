<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o ID do produto foi passado
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Obtém os dados do formulário
    $produto = $_POST['produto'];
    $marca = $_POST['marca'];
    $tamanho = $_POST['tamanho'];
    $cor = $_POST['cor'];
    $quantidade = $_POST['quantidade'];
    $tipo = $_POST['tipo'];
    $data_saida = $_POST['data_saida'];
    $data_entrada = $_POST['data_entrada'];
    $prateleira = $_POST['prateleira'];
    $estoque = $_POST['estoque'];
    $descricao = $_POST['descricao'];

    $nomedoArquivo = $_FILES['arquivo']['name'];
    $caminhoAtualArquivo = $_FILES['arquivo']['tmp_name'];
    $caminhoSalvar = 'fotoCad/' . $nomedoArquivo;

    // Prepara a consulta para atualizar o produto

    if (move_uploaded_file($caminhoAtualArquivo, $caminhoSalvar)) {
        $query = "UPDATE produto SET produto = ?, marca = ?, tamanho = ?, cor = ?, quantidade = ?, tipo = ?, foto = ?, data_saida = ?, data_entrada = ?, prateleira = ?, estoque = ?, descricao = ? WHERE id_produto = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssisssssssi", $produto, $marca, $tamanho, $cor, $quantidade, $tipo, $caminhoSalvar, $data_saida, $data_entrada, $prateleira, $estoque, $descricao, $id_produto);
        
        if ($stmt->execute()) {
            echo "<script>alert('Produto atualizado com sucesso!'); window.location.href='../consultar_produto.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar produto!'); window.location.href='../consultar_produto.php';</script>";
        }
        } else {
            echo "<script>alert('ID do produto não fornecido!'); window.location.href='../consultar_produto.php';</script>";
        }
    }

// Fecha a conexão
$conn->close();
?>
