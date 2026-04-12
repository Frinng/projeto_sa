<?php
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['usuario'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if ($email && $senha) {
        $stmt = $mysqli->prepare("SELECT user_senha, user_tipo FROM Usuarios WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $dados = $resultado->fetch_assoc();

            if ($senha === $dados['user_senha']) {
                echo strtoupper($dados['user_tipo']);
            } else {
                echo "FALHA"; // Senha errada
            }
        } else {
            // AQUI ESTÁ A MUDANÇA:
            echo "EMAIL_INEXISTENTE"; 
        }
        $stmt->close();
    } else {
        echo "ERRO_CAMPOS";
    }
}
?>