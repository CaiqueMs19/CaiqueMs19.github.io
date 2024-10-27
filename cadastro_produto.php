<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Estilo do corpo e centralização do conteúdo */
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
            min-height:850px;
            height:auto;
            padding: 20px;
            padding-top:20px;
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
        }

        /* Estilo do formulário e rótulos */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            text-align: left;
            color: #333;
        }

        /* Estilo dos campos de entrada */
        input[type="text"],
        input[type="number"],
        input[type="file"],
        input[type="date"] {
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
        input[type="file"]:focus,
        input[type="date"]:focus {
            border-color: #4a90e2;
        }

        /* Remove as setas dos campos de número */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
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
            color: #fff;
            transition: background-color 0.3s ease;
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
        <h1>Cadastro de Produtos</h1>
        
        <form action="DB/cad_produto.php" method="POST"  enctype="multipart/form-data">
            <label for="produto">Produto</label>
            <input type="text" name="produto" id="produto" maxlength="50" placeholder="Máx. 50 caracteres" required>

            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca" maxlength="30" placeholder="Máx. 30 caracteres" required>

            <label for="tamanho">Tamanho</label>
            <input type="text" name="tamanho" id="tamanho" maxlength="10" placeholder="Máx. 10 caracteres" required>

            <label for="cor">Cor</label>
            <input type="text" name="cor" id="cor" maxlength="15" placeholder="Máx. 15 caracteres" required>

            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" min="1" max="999" placeholder="Máx. 3 dígitos" required>

            <label for="tipo">Tipo</label>
            <input type="text" name="tipo" id="tipo" maxlength="20" placeholder="Máx. 20 caracteres" required>

            <label for="foto">Foto</label>
            <input type="file" name="arquivo" id="foto">

            <label for="data_saida">Data de Saída</label>
            <input type="date" name="data_saida" id="data_saida">

            <label for="data_entrada">Data de Entrada</label>
            <input type="date" name="data_entrada" id="data_entrada" required>

            <label for="estoque">Prateleira</label>
            <input type="text" name="prateleira" id="prateleira" maxlength="10" placeholder="Máx. 10 caracteres" required>

            <label for="estoque">Estoque</label>
            <input type="text" name="estoque" id="estoque" maxlength="20" placeholder="Máx. 10 caracteres" required>

            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" maxlength="100" placeholder="Máx. 100 caracteres" required><br>

            <input type="reset" value="Limpar">
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
