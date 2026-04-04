<?php
session_start(); // Inicia a sessão para manter o usuário logado
require("conexao.php");

$erro_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');

    if ($email && $senha) {
        try {
            // Busca o usuário pelo e-mail
            $sql = $pdo->prepare("SELECT * FROM colaborador WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $colaborador = $sql->fetch(PDO::FETCH_ASSOC);

                // Verifica se a senha digitada combina com a do banco
                if ($senha == $colaborador['senha']) {
                    // Login com sucesso! Salva na sessão:
                    $_SESSION['colaborador_id'] = $colaborador['IdColaborador']; // Corrigido para IdColaborador baseado no seu banco
                    $_SESSION['colaborador_nome'] = $colaborador['Nome'];

                    header("Location: index.php"); // Mude para sua página inicial após login
                    exit();
                } else {
                    $erro_msg = "Senha incorreta!";
                }
            } else {
                $erro_msg = "E-mail não encontrado!";
            }
        } catch (PDOException $e) {
            $erro_msg = "Erro no sistema: " . $e->getMessage();
        }
    } else {
        $erro_msg = "Preencha todos os campos!";
    }
}
?>