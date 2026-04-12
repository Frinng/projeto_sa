<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$pass = ""; // Coloque sua senha do banco aqui
$db   = "trabalho_SA";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buscando da View que você criou no seu script SQL
    $stmt = $conn->prepare("SELECT brinco_identificador, idade_meses, peso_kg, raca FROM vw_lote_maternidade");
    $stmt->execute();

    $animais = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($animais);
} catch(PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>