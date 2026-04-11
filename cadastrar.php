<?php
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $User_nome = $_POST['novoUsuario'] ?? null;
    $User_senha = $_POST['novaSenha'] ?? null;
    $User_tipo = $_POST['tipoUsuario'] ?? 'CLIENTE';

    if ($User_nome && $User_senha) {
        
        // 1. PRIMEIRO: Verifica se o usuário já existe
        $check = $mysqli->prepare("SELECT user_nome FROM Usuarios WHERE user_nome = ?");
        $check->bind_param("s", $User_nome);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            // Se encontrar alguém, envia o aviso que o C# está esperando
            echo "erro_usuario_existe";
            $check->close();
        } else {
            $check->close();

            // 2. SEGUNDO: Se não existir, faz a inserção
            $stmt = $mysqli->prepare("INSERT INTO Usuarios (user_nome, user_senha, user_tipo) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $User_nome, $User_senha, strtoupper($User_tipo));

            if ($stmt->execute()) {
                echo "sucesso";
            } else {
                echo "erro_banco: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        echo "campos_vazios";
    }
}
?>