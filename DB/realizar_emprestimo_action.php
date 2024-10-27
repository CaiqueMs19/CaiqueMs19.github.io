<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redireciona se não estiver logado
    exit();
}

// Inclui a conexão com o banco de dados
require_once 'conexao.php';

// Resgata os dados do formulário
$id_produto = $_POST['id_produto'];
$id_user = $_SESSION['id_user']; // Armazenar id_usuario da sessão
$responsavel = $_POST['responsavel'];
$data_saida_emprestimo = $_POST['data_saida_emprestimo'];
$data_volta_emprestimo = $_POST['data_volta_emprestimo'];
$descricao = $_POST['descricao'];
$tel_responsavel = $_POST['tel_responsavel'];

// Prepara a consulta para verificar a quantidade em estoque
$query_check_qtd = "SELECT quantidade FROM produto WHERE id_produto = ?";
$stmt_check_qtd = $conn->prepare($query_check_qtd);
$stmt_check_qtd->bind_param("i", $id_produto);
$stmt_check_qtd->execute();
$stmt_check_qtd->bind_result($quantidade);
$stmt_check_qtd->fetch();
$stmt_check_qtd->close();

if ($quantidade > 1) {
    // Reduz a quantidade em estoque
    $nova_quantidade = $quantidade - 1;
    $query_update_qtd = "UPDATE produto SET quantidade = ? WHERE id_produto = ?";
    $stmt_update_qtd = $conn->prepare($query_update_qtd);
    $stmt_update_qtd->bind_param("ii", $nova_quantidade, $id_produto);
    $stmt_update_qtd->execute();
    $stmt_update_qtd->close();
} elseif ($quantidade == 1) {
    // Reduz a quantidade para zero e atualiza o status do produto
    $query_update_status = "UPDATE produto SET quantidade = 0, status = 0 WHERE id_produto = ?";
    $stmt_update_status = $conn->prepare($query_update_status);
    $stmt_update_status->bind_param("i", $id_produto);
    $stmt_update_status->execute();
    $stmt_update_status->close();
} else {
    echo "<script>alert('Quantidade de produto insuficiente.'); window.location.href='../realizar_emprestimo.php?id=$id_produto';</script>";
    exit();
}

// Prepara a consulta para inserir o empréstimo
$query_insert = "INSERT INTO emprestimo (id_produto, id_user, responsavel, data_saida_emprestimo, data_volta_emprestimo, descricao, telefone_resp)
                 VALUES (?, ?, ?, ?, ?, ?, ?)";

if ($stmt_insert = $conn->prepare($query_insert)) {
    $stmt_insert->bind_param("issssss", $id_produto, $id_user, $responsavel, $data_saida_emprestimo, $data_volta_emprestimo, $descricao, $tel_responsavel);
    if ($stmt_insert->execute()) {
        echo "<script>alert('Empréstimo realizado com sucesso!'); window.location.href='../consultar_produto.php';</script>";
    } else {
        echo "<script>alert('Erro ao realizar o empréstimo.'); window.location.href='../realizar_emprestimo.php?id=$id_produto';</script>";
    }
    $stmt_insert->close();
} else {
    echo "<script>alert('Erro ao preparar a consulta de inserção.'); window.location.href='../realizar_emprestimo.php?id=$id_produto';</script>";
}

$conn->close();
?>
