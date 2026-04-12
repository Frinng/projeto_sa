<?php
header('Content-Type: application/json; charset=utf-8');

$host = 'localhost';
$user = 'root';
$pass = ''; // Sua senha do banco
$db   = 'trabalho_SA';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["error" => "Falha na conexão: " . $conn->connect_error]));
}

// Consultando a View que criamos no passo anterior
$sql = "SELECT tag, sexo, peso, eh_matriz, em_engorda, na_maternidade, em_quarentena FROM vw_status_geral_animais";
$result = $conn->query($sql);

$animais = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $animais[] = $row;
    }
}

echo json_encode($animais);
$conn->close();
?>