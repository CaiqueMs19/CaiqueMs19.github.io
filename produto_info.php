<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redireciona se não estiver logado
    exit();
}

// Inclui a conexão com o banco de dados
require_once 'DB/conexao.php';

// Verifica se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Prepara a consulta
    $query = "SELECT * FROM produto WHERE id_produto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o produto existe
    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        echo "<script>alert('Produto não encontrado!'); window.location.href='consultar_produto.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID do produto não fornecido!'); window.location.href='consultar_produto.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Inclua seu CSS aqui -->
    <style>
        /* Estilo básico do produto_info */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            background-color: #f4f6f8;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
            position: relative;
            top: 150px;
        }

        .titulo {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4a90e2;
            text-align: center;
        }

        .produto-img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .info {
            margin: 10px 0;
            font-size: 18px;
        }

        .info span {
            font-weight: bold;
            color: #4a90e2;
        }

        .links {
            display: flex;
            justify-content: center; /* Centraliza os botões */
            margin-top: 20px;
            position: relative;
            right:550px;
            top: 40px;
        }

        .link {
            display: inline-block;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #4a90e2; /* Cor do botão */
            transition: background-color 0.3s;
            margin: 0 10px; /* Espaçamento entre os botões */
        }

        .link:hover {
            background-color: #357ab8; /* Cor do botão ao passar o mouse */
        }
    </style>
    <script>
        function confirmarExclusao(id) {
            if (confirm("Você realmente deseja excluir este produto?")) {
                window.location.href = "DB/excluir_produto.php?id=" + id; // Redireciona para a página de exclusão
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="titulo">Detalhes do Produto</h1>
        <img src="DB/<?php echo htmlspecialchars($produto['foto']); ?>" alt="<?php echo htmlspecialchars($produto['produto']); ?>" class="produto-img">
        
        <div class="info"><span>Nome:</span> <?php echo htmlspecialchars($produto['produto']); ?></div>
        <div class="info"><span>Marca:</span> <?php echo htmlspecialchars($produto['marca']); ?></div>
        <div class="info"><span>Tamanho:</span> <?php echo htmlspecialchars($produto['tamanho']); ?></div>
        <div class="info"><span>Cor:</span> <?php echo htmlspecialchars($produto['cor']); ?></div>
        <div class="info"><span>Quantidade:</span> <?php echo htmlspecialchars($produto['quantidade']); ?></div>
        <div class="info"><span>Tipo:</span> <?php echo htmlspecialchars($produto['tipo']); ?></div>
        <div class="info"><span>Data de Saída:</span> <?php echo htmlspecialchars($produto['data_saida']); ?></div>
        <div class="info"><span>Data de Entrada:</span> <?php echo htmlspecialchars($produto['data_entrada']); ?></div>
        <div class="info"><span>Prateleira:</span> <?php echo htmlspecialchars($produto['prateleira']); ?></div>
        <div class="info"><span>Estoque:</span> <?php echo htmlspecialchars($produto['estoque']); ?></div>
        <div class="info"><span>Descrição:</span> <?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></div>

        <div class="links">
            <a href="emprestimo_produto.php?id=<?php echo $id_produto; ?>" class="link" target="_blank">Realizar um Empréstimo</a>
            <a href="editar_produto.php?id=<?php echo $id_produto; ?>" class="link" target="_blank">Editar</a>
            <a href="#" class="link" onclick="confirmarExclusao(<?php echo $id_produto; ?>)">Dar Baixa</a>
        </div>
        <div class="links">
            <a href="consultar_produto.php" class="link">Voltar para Consulta</a>
            <a href="controle.php" class="link">Voltar para Painel de Controle</a>
        </div>
    </div>
</body>
</html>
