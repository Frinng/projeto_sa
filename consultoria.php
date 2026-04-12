<?php
header('Content-Type: application/json');

$host = 'localhost';
$db   = 'trabalho_SA';
$user = 'root'; // ajuste se necessário
$pass = '';     // ajuste se necessário

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consultamos a View que você já criou no SQL
    $stmt = $pdo->query("SELECT * FROM vw_consultoria_resumo");
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados) {
        echo json_encode($dados);
    } else {
        echo json_encode(['error' => 'Nenhum dado encontrado']);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>