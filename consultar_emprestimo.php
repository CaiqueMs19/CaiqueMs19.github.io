<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redireciona se não estiver logado
    exit();
}

// Inclui a conexão com o banco de dados
require_once 'DB/conexao.php';

// Prepara a consulta para buscar empréstimos ativos
$query = "SELECT e.id_emprestimo, u.name, e.id_produto, e.responsavel, e.data_saida_emprestimo, e.data_volta_emprestimo, e.descricao, e.telefone_resp, p.produto 
          FROM emprestimo e 
          JOIN produto p ON e.id_produto = p.id_produto 
          JOIN usuario u ON e.id_user = u.id_user
          WHERE e.status = 1
          ORDER BY data_volta_emprestimo"; // Mude aqui para o status que representa "ativo"

// Executa a consulta
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos Ativos</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Inclua seu CSS aqui -->
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4a90e2;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .link {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #4a90e2;
            transition: background-color 0.3s;
            position: relative;
            left:1px;
            top:-10px;
        }

        .link:hover {
            background-color: #357ab8;
        }

        .overdue {
            background-color: #ffe5e5; /* Fundo levemente vermelho */
            font-style: italic; /* Texto em itálico */
            color: #a00; /* Cor do texto mais escura */
        }
    </style>
</head>
<body>
    <h1>Empréstimos Ativos</h1>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID do Empréstimo</th>
                    <th>Produto</th>
                    <th>Responsável</th>
                    <th>Data de Saída</th>
                    <th>Data de Volta</th>
                    <th>Descrição</th>
                    <th>Telefone do Responsável</th>
                    <th>Liberado Por</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php 
                    // Verifica se a data de volta é menor que a data atual
                    $data_volta = new DateTime($row['data_volta_emprestimo']);
                    $data_atual = new DateTime();
                    $is_overdue = $data_volta < $data_atual; // true se a data de volta já passou
                    ?>
                    <tr class="<?php echo $is_overdue ? 'overdue' : ''; ?>">
                        <td><?php echo $row['id_emprestimo']; ?></td>
                        <td><?php echo $row['produto']; ?></td>
                        <td><?php echo $row['responsavel']; ?></td>
                        <td><?php echo $row['data_saida_emprestimo']; ?></td>
                        <td><?php echo $row['data_volta_emprestimo']; ?></td>
                        <td><?php echo $row['descricao']; ?></td>
                        <td><?php echo $row['telefone_resp']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>
                            <a href="registrar_devolucao.php?id_emprestimo=<?php echo $row['id_emprestimo']; ?>" class="link">Devolver</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum empréstimo ativo encontrado.</p>
    <?php endif; ?>
    
    <a href="consultar_produto.php" class="link">Voltar para Consulta de Produtos</a>
</body>
</html>

<?php
// Fecha a conexão
$conn->close();
?>
