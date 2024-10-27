<?php 
// Inclui a conexão
require_once 'conexao.php';

// Resgata os dados da URL
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Armazena os dados na variável
$name = $dados["name"];
$cpf = $dados["cpf"];
$endereco = $dados["endereco"];
$usuario = $dados["usuario"];
$senha = $dados["senha"]; // A senha a ser armazenada deve ser transformada em hash
$telefone = $dados["telefone"];

// Hash da senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Cria o hash da senha

// Realiza o insert no DB
$query_insert = "INSERT INTO usuario (name, cpf, endereco, usuario, senha, telefone)
                 VALUES (?, ?, ?, ?, ?, ?)";

// Prepara a consulta para evitar SQL Injection
$stmt = $conn->prepare($query_insert);
$stmt->bind_param("ssssss", $name, $cpf, $endereco, $usuario, $senhaHash, $telefone); // Associa as variáveis

// Faz verificação do insert
if ($stmt->execute()) {
    echo "<script>
            alert('Usuário cadastrado com sucesso!'); 
            window.location.href='../cadastro_usuario.php';
          </script>";
} else {
    echo "<script>
            alert('Erro: " . $stmt->error . "'); 
            window.location.href='../cadastro_usuario.php';
          </script>";
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>
