<?php
// Configurações de conexão
$host = "localhost";
$db_name = "trabalho_SA";
$username = "root";
$password = ""; // Coloque sua senha do banco aqui, se houver

try {
    // 1. Conexão com o Banco de Dados usando PDO (mais seguro)
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Query de Consulta
    // No futuro, você pode receber o ID do fornecedor via GET ou POST para filtrar
    // Ex: WHERE id_fornecedor = :id
    $sql = "SELECT 
                id_contrato, 
                valor_total, 
                data_vencimento, 
                status_contrato, 
                termos_clausulas 
            FROM contrato 
            ORDER BY data_contrato DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 3. Recuperar os dados
    $contratos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 4. Transformar os dados em JSON e enviar para o C#
    header('Content-Type: application/json');
    echo json_encode($contratos);

} catch (PDOException $e) {
    // Caso ocorra erro, retorna o erro no formato JSON para não quebrar o C#
    http_response_code(500);
    echo json_encode(["erro" => $e->getMessage()]);
}
?>