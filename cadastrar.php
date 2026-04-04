<?php
// cadastrar.php
require("conexao.php"); // Certifique-se que este arquivo está na mesma pasta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Pegando os dados enviados pelo HttpClient do C#
    $User_nome = $_POST['novoUsuario'] ?? null;
    $User_senha = $_POST['novaSenha'] ?? null;
    $ID_User = $_POST['IDgerado'] ?? null;

    if ($User_nome && $User_senha && $ID_User) {
        // Preparando a query (proteção contra SQL Injection)
        $stmt = $mysqli->prepare("INSERT INTO usuarios ( User_nome , User_senha, ID_User) VALUES (?, ?, ?)");
        
        // "ssii" = string, string, integer, integer
        $stmt->bind_param("ssi", $User_nome, $User_senha, $ID_User);

        if ($stmt->execute()) {
            echo "sucesso"; // Resposta simples para o C#
        } else {
            echo "erro_banco: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "campos_vazios";
    }
}
?>