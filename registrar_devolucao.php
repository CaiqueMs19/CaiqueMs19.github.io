<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redireciona se não estiver logado
    exit();
}

// Inclui a conexão com o banco de dados
require_once 'DB/conexao.php';

// Verifica se o ID do empréstimo foi passado
if (isset($_GET['id_emprestimo'])) {
    $id_emprestimo = intval($_GET['id_emprestimo']);
} else {
    echo "<script>alert('ID do empréstimo não fornecido.'); window.location.href='listar_emprestimos.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Devolução</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Inclua seu CSS aqui -->
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            position:relative;
            left:-10px;
        }

        input[type="submit"] {
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #357ab8;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrar Devolução</h2>
        <form action="DB/processar_devolucao.php" method="post">
            <input type="hidden" name="id_emprestimo" value="<?php echo $id_emprestimo; ?>">
            <label for="info_adicional">Informações Adicionais:</label>
            <textarea name="info_adicional" id="info_adicional" rows="4" placeholder="Insira informações adicionais sobre a devolução..."></textarea>
            <input type="submit" value="Registrar Devolução">
        </form>
    </div>
</body>
</html>
