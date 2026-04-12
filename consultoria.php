<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "trabalho_SA";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["error" => "Falha na conexão"]));
}

$sql = "SELECT * FROM vw_consultoria_resumo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $dados = $result->fetch_assoc();
    echo json_encode($dados);
} else {
    echo json_encode(["error" => "Sem dados"]);
}

$conn->close();
?>