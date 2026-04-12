<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$pass = ""; // Sua senha do MySQL
$db   = "trabalho_SA";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Usando a view de engorda do seu SQL
    $stmt = $conn->prepare("SELECT brinco_identificador, sexo_animal, idade_meses, peso_kg FROM vw_lote_engorda");
    $stmt->execute();

    $animais = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($animais);
} catch(PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>