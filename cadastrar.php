<?php
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // AJUSTE: Os nomes aqui devem ser IGUAIS aos do KeyValuePair do C#
    $email = $_POST['novoUsuario'] ?? null; 
    $senha = $_POST['novaSenha'] ?? null;
    $tipo  = $_POST['tipoUsuario'] ?? null;

    if ($email && $senha && $tipo) {
        
        // Converte o tipo para MAIÚSCULO para bater com o ENUM do MySQL (COLABORADOR / CLIENTE)
        $tipo = strtoupper($tipo);

        // 1. Verifica se o e-mail já existe
        $check = $mysqli->prepare("SELECT id_usuario FROM Usuarios WHERE user_email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "erro_email_existe"; // Nome que você tratou no C#
            $check->close();
        } else {
            $check->close();

            // 2. Insere o novo usuário
            $stmt = $mysqli->prepare("INSERT INTO Usuarios (user_email, user_senha, user_tipo) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $senha, $tipo);

            if ($stmt->execute()) {
                echo "sucesso";
            } else {
                echo "erro_ao_inserir: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        echo "dados_incompletos";
    }
}
?>