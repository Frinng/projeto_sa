<?php
// logar.php
require("conexao.php"); // Mantém a sua conexão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados enviados pelo C#
    $User_nome = $_POST['usuario'] ?? null;
    $User_senha = $_POST['senha'] ?? null;

    if ($User_nome && $User_senha) {
        // Prepara a busca no banco apenas pelo nome do usuário
        $stmt = $mysqli->prepare("SELECT User_senha FROM Usuarios WHERE User_nome = ?");
        $stmt->bind_param("s", $User_nome);
        $stmt->execute();
        
        $resultado = $stmt->get_result();

        // Se encontrou alguma linha com esse usuário...
        if ($resultado->num_rows > 0) {
            $Surubinha = $resultado->fetch_assoc();

            // Verifica se a senha digitada é igual à senha salva no banco
            if ($User_senha === $Surubinha['User_senha']) {
                
                // Exemplo simples para definir se é o ADMIN
                if ($User_nome === "Pedro_ADM") { 
                    echo "ADMIN";
                } else {
                    echo "SUCESSO";
                }

            } else {
                echo "FALHA"; // Achou o usuário, mas a senha está errada
            }
        } else {
            echo "FALHA"; // Não encontrou nenhum usuário com esse nome
        }
        $stmt->close();
    } else {
        echo "ERRO_CAMPOS";
    }
}
?>