<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Estilos do reset e do corpo conforme o anterior */
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
            max-width: 400px;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .titulo {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4a90e2;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .input-field:focus {
            border-color: #4a90e2;
        }
        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #4a90e2;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #357ab8;
        }

        .links {
            display: flex;
            justify-content: center; /* Centraliza os botões */
            margin-top: 10px;
            position: relative;
            bottom:60px;
            left:150px;
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
</head>
<body>
    <div class="container">
        <h1 class="titulo">LOGIN</h1>
        <div class="links">
            <a href="index.php" class="link">Voltar</a>
        </div>
        <form action="DB/verificaLogin.php" method="POST">
            <input type="text" class="input-field" name="usuario" placeholder="Usuário" required>
            <input type="password" class="input-field" name="senha" placeholder="Senha" required>
            <input type="submit" class="btn-submit" value="Entrar">
        </form>
    </div>
</body>
</html>
