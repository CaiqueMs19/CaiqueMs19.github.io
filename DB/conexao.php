<?php

$host = "localhost";    
$user = "root";         
$pass = "";
$db = "controledeestoque";

try {
    $conn = mysqli_connect($host, $user, $pass,$db); 
    $conn->set_charset('utf8'); 
    date_default_timezone_set('America/Sao_Paulo');
} catch (Exception $e) {
    echo 'Erro: ',  $e->getMessage(), "<br>";
}
?>