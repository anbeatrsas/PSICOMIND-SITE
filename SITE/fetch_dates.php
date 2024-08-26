<?php
include "conn/conection.php"; // Inclua o arquivo de conexão com o banco de dados

// Obtém o ID do profissional do request POST
$profissional_id = $_POST['profissional_id'] ?? 0;

// Consulta as datas disponíveis para o profissional selecionado
$query = "SELECT dia FROM escala WHERE disponivel = 1 AND profissional_id = ?";

// Prepare a declaração para evitar SQL Injection
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $profissional_id);
$stmt->execute();

// Obtém os resultados
$result = $stmt->get_result();

// Cria um array para armazenar as datas disponíveis
$datasDisponiveis = [];
while ($row = $result->fetch_assoc()) {
    $datasDisponiveis[] = $row['dia'];
}

// Define o cabeçalho para JSON
header('Content-Type: application/json');

// Retorna as datas em formato JSON
echo json_encode($datasDisponiveis);

// Fecha a conexão
$stmt->close();
$conn->close();
?>
