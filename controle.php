<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redireciona se não estiver logado
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Estilo do corpo e do conteúdo centralizado */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            background-color: #f4f6f8;
            color: #333;
        }

        /* Estilo do contêiner */
        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Estilo do título */
        .titulo {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4a90e2;
        }

        /* Estilo dos links e botões */
        .link {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #4a90e2;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .link:hover {
            background-color: #357ab8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo">Painel de Controle</h1>

        <a href="cadastro_produto.php" class="link">Cadastrar Produto</a>
        <a href="cadastro_usuario.php" class="link">Cadastrar Usuário</a>
        <a href="consultar_produto.php" class="link">Consultar Produto</a>
        <a href="consultar_emprestimo.php" class="link">Consultar Emprestimo</a>

        <a href="logout.php" class="link">Logout</a> <!-- Link para sair do sistema -->
    </div>
</body>
</html>
