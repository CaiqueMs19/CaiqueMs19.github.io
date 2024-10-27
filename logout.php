<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (isset($_SESSION['usuario'])) {
    // Destrói todas as variáveis de sessão
    $_SESSION = array(); // Limpa a sessão

    // Se a sessão for baseada em cookies, limpe os cookies
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"], $params["secure"], $params["httponly"]
        );
    }

    // Destrói a sessão
    session_destroy();
}

// Redireciona para a página de login
header("Location: login.php");
exit();
?>
