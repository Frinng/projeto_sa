<?php
// Inicia a sessão para o PHP saber quem está logado
session_start();

// Destrói todas as informações de login do usuário
session_destroy();

// Agora sim, redireciona o usuário de volta para o login.htm
header("Location: login.htm");
exit;
?>