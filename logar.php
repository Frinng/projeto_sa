<?php
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $User_nome = $_POST['usuario'] ?? null;
    $User_senha = $_POST['senha'] ?? null;

    if ($User_nome && $User_senha) {
        // Buscamos a senha e o tipo do usuário
        $stmt = $mysqli->prepare("SELECT User_senha, User_tipo FROM Usuarios WHERE User_nome = ?");
        $stmt->bind_param("s", $User_nome);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $dados = $resultado->fetch_assoc();

            if ($User_senha === $dados['User_senha']) {
                // Retorna o tipo (ADMIN, COLABORADOR, CLIENTE ou FORNECEDOR)
                echo strtoupper($dados['User_tipo']);
            } else {
                echo "FALHA";
            }
        } else {
            echo "FALHA";
        }
        $stmt->close();
    } else {
        echo "ERRO_CAMPOS";
    }
}
?>