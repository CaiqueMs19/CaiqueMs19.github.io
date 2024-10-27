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
    <title>Cadastro de Usuários</title>
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
            height: 100vh;
            background-color: #f4f6f8;
            color: #333;
        }

        /* Estilo do contêiner */
        .container {
            width: 100%;
            max-width: 400px;
            min-height:650px;
            height:auto;
            padding: 20px;
            padding-top:50px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            position:relative;
            top:50px;
            margin:auto;
        }

        /* Estilo do título */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4a90e2;
            display: block; /* Assegura que o título seja exibido como bloco */
        }

        /* Estilo do formulário e dos rótulos */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            text-align: left;
            margin-bottom: 5px;
            color: #333;
        }

        /* Estilo dos campos de entrada */
        input[type="text"],
        input[type="number"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="password"]:focus {
            border-color: #4a90e2;
        }

        /* Estilo dos botões */
        input[type="submit"],
        input[type="reset"] {
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: #fff;
        }

        input[type="submit"] {
            background-color: #4a90e2;
        }

        input[type="reset"] {
            background-color: #d9534f;
        }

        input[type="submit"]:hover {
            background-color: #357abd;
        }

        input[type="reset"]:hover {
            background-color: #c9302c;
        }
        input:invalid {
            border-color: #d9534f;
        }
        input[type="number"] {
            -moz-appearance: textfield; /* Para navegadores Firefox */
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none; /* Para navegadores baseados em WebKit (Chrome, Safari, Opera) */
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Usuários</h1>
        
        <form action="DB/cad_user.php" method="POST">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" required>

            <label for="cpf">CPF</label>
            <input type="number" name="cpf" id="cpf" maxlength="11" placeholder="Somente Numeros Ex: 11111111111"  required>

            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" required>

            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>

            <label for="telefone">Telefone</label>
            <input type="number" name="telefone" id="telefone"  maxlength="11" placeholder="Somente Numeros Ex: 11999999999"  required>

            <input type="submit" value="Cadastrar" aria-label="Enviar formulário">
            <input type="reset" value="Limpar" aria-label="Limpar campos do formulário">
        </form>
    </div>
</body>
</html>
