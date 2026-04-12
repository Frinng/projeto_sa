<?php
header('Content-Type: application/json');

$host = 'localhost';
$db   = 'trabalho_SA';
$user = 'root';
$pass = ''; // ajuste sua senha aqui

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id_produto, nome_produto, Qnt_Produto, dt_fabricacao, dt_validade FROM produto");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($produtos);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>