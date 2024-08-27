<?php
include "conn/conection.php"; // Inclua o arquivo de conexão com o banco de dados

// Obtém o ID do profissional e a data do request POST
$profissional_id = $_POST['profissional_id'] ?? 0;
$data_agendamento = $_POST['data_agendamento'] ?? '';

// Consulta os horários disponíveis para o profissional selecionado na data escolhida
$query = "SELECT id, horario FROM escala WHERE dia = ? AND disponivel = 1 AND profissional_id = ?";

// Prepare a declaração para evitar SQL Injection
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $data_agendamento, $profissional_id);
$stmt->execute();

// Obtém os resultados
$result = $stmt->get_result();

// Cria um array para armazenar os horários disponíveis
$horariosDisponiveis = [];
while ($row = $result->fetch_assoc()) {
    $horariosDisponiveis[] = [
        'id' => $row['id'],
        'horario' => $row['horario']
    ];
}

// Define o cabeçalho para JSON
header('Content-Type: application/json');

// Retorna os horários em formato JSON
echo json_encode($horariosDisponiveis);

// Fecha a conexão
$stmt->close();
$conn->close();
?>
