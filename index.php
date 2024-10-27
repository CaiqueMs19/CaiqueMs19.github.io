<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-Vindo ao Almoxarifado</title>
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
            background-image:url(img/logo.png);
            background-repeat:no-repeat;
            background-position:center;
            background-size:50%;
            /*background-color: #f4f6f8;*/
            color: #333;
        }

        /* Estilo do contêiner */
        .container {
            width: 100%;
            max-width: 400px;
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

        /* Estilo dos links */
        .link {
            margin-bottom: 20px;
            color: #fff; /* Cor do texto do botão */
            text-decoration: none;
            background-color: #4a90e2; /* Fundo do botão */
            padding: 10px 15px; /* Espaçamento interno */
            border-radius: 5px; /* Bordas arredondadas */
            display: inline-block; /* Para que o padding funcione corretamente */
            transition: background-color 0.3s; /* Efeito de transição */
            position: relative;
            bottom:60px;
            left:150px;
        }

        .link:hover {
            background-color: #357ab8; /* Cor ao passar o mouse */
        }

        /* Estilo da barra de pesquisa */
        .barra_pesquisa {
            display: flex;
            align-items: center;
            gap: 5px; /* Espaçamento entre input e botão */
        }

        /* Estilo dos campos de entrada */
        .barra {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .barra:focus {
            border-color: #4a90e2;
        }

        /* Estilo do botão da lupa */
        .lupa {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        /* Estilo dos resultados da pesquisa */
        .resultados {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px; /* Espaçamento entre os cards */
        }

        /* Estilo do card do produto */
        .card {
            padding: 10px;
            background-color: #e8f0fe;
            border: 1px solid #4a90e2;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02); /* Efeito de aumento no hover */
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .resultado-item {
            margin: 5px 0;
            text-decoration: none;
            color: #333;
        }

        
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo">ALMOXARIFADO</h1>
        <a href="login.php" class="link">Login</a>
        
        <form action="" method="POST" class="barra_pesquisa">
            <input type="text" class="barra" name="pesquisa" placeholder="Pesquisar produtos..." required>
            <button type="submit" class="lupa">
                <img src="img/lupa.png" alt="pesquisar" width="25px">
            </button>
        </form>

        <div class="resultados">
            <?php
                $resultados = ''; // Inicializa a variável de resultados

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Inclui a conexão com o banco de dados
                    require_once 'DB/conexao.php';

                    // Resgata o termo da pesquisa
                    $termo = $_POST['pesquisa'];

                    // Prepara a consulta
                    $query = "SELECT * FROM produto WHERE produto LIKE ?"; // Supondo que a tabela se chama 'produtos' e a coluna 'nome'
                    $stmt = $conn->prepare($query);
                    $searchTerm = "%$termo%"; // Adiciona os percentuais para busca parcial
                    $stmt->bind_param("s", $searchTerm);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Exibe os resultados
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Supondo que 'foto' é o nome da coluna que contém a URL da imagem
                            $foto = htmlspecialchars($row['foto']);
                            $produtoNome = htmlspecialchars($row['produto']);
                            $linkProduto = "consulta_produto_public.php?id=" . $row['id_produto']; // Link para a página de informações do produto

                            $resultados .= "<a href='$linkProduto' class='card'>";
                            $resultados .= "<img src='DB/$foto' alt='$produtoNome' width='100px'>";
                            $resultados .= "<div class='resultado-item'>$produtoNome</div>";
                            $resultados .= "</a>";
                        }
                    } else {
                        $resultados = "<div class='resultado-item'>Nenhum produto encontrado.</div>";
                    }

                    // Fecha a conexão
                    $stmt->close();
                    $conn->close();
                }

                echo $resultados; // Exibe os resultados da pesquisa
            ?>
        </div>
    </div>
</body>
</html>
