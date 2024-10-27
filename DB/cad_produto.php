<?php
require_once 'conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$produto = $dados["produto"];
$marca = $dados["marca"];
$tamanho = $dados["tamanho"];
$cor = $dados["cor"];
$quantidade = $dados["quantidade"];
$tipo = $dados["tipo"];
$data_saida = $dados["data_saida"];
$data_entrada = $dados["data_entrada"];
$prateleira = $dados["prateleira"];
$estoque = $dados["estoque"];
$descricao = $dados["descricao"];

$nomedoArquivo = $_FILES['arquivo']['name'];
$caminhoAtualArquivo = $_FILES['arquivo']['tmp_name'];
$caminhoSalvar = 'fotoCad/' . $nomedoArquivo;

// Move o arquivo para a pasta de destino
if (move_uploaded_file($caminhoAtualArquivo, $caminhoSalvar)) {
    // Apenas agora faz o INSERT, pois o arquivo foi movido com sucesso
    $query_insert = "INSERT INTO produto (produto, marca, tamanho, cor, quantidade, tipo, foto, data_saida, data_entrada, prateleira, estoque, descricao)
                     VALUES ('$produto', '$marca', '$tamanho', '$cor', '$quantidade', '$tipo', '$caminhoSalvar', '$data_saida', '$data_entrada', '$prateleira', '$estoque', '$descricao')";

    if ($conn->query($query_insert) === TRUE) {
        echo "<script>
                alert('Produto Cadastrado com Sucesso!'); 
                window.location.href='../cadastro_produto.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao cadastrar produto: " . $conn->error . "'); 
                window.location.href='../cadastro_produto.php';
              </script>";
    }
} else {
    // Se falhar ao mover o arquivo, você pode informar o erro
    echo "<script>
            alert('Erro ao fazer upload da imagem. Verifique as permissões da pasta.'); 
            window.location.href='../cadastro_produto.php';
          </script>";
}
?>
