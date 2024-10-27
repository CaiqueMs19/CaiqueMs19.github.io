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
    <title>Realizar Empréstimo</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Inclua seu CSS aqui -->
    <style>
        /* Estilo básico do formulário */
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .link {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #4a90e2; /* Cor do botão */
            transition: background-color 0.3s;
        }

        .link:hover {
            background-color: #357ab8; /* Cor do botão ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo">Realizar Empréstimo</h1>
        <form action="DB/realizar_emprestimo_action.php" method="POST">
            <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>">
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
            
            <div class="form-group">
                <label for="nome_responsavel">Nome do Responsável:</label>
                <input type="text" id="responsavel" name="responsavel" required>
            </div>

            <div class="form-group">
                <label for="data_saida_emprestimo">Data de Saída:</label>
                <input type="date" id="data_saida_emprestimo" name="data_saida_emprestimo" required>
            </div>

            <div class="form-group">
                <label for="data_volta_emprestimo">Data de Volta:</label>
                <input type="date" id="data_volta_emprestimo" name="data_volta_emprestimo" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao">
            </div>

            <div class="form-group">
                <label for="tel_responsavel">Telefone do Responsável:</label>
                <input type="text" id="tel_responsavel" name="tel_responsavel" required>
            </div>

            <button type="submit" class="link">Realizar Empréstimo</button>
        </form>
        <a href="consultar_produto.php" class="link">Voltar para Consulta</a>
    </div>
</body>
</html>
