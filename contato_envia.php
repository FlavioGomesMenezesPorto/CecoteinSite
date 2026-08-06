<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');

if (!$nome || !$email || !$mensagem) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Por favor, preencha nome, email e mensagem.']);
    exit;
}

$payload = json_encode([
    'nome' => $nome,
    'email' => $email,
    'telefone' => $telefone,
    'mensagem' => $mensagem,
], JSON_UNESCAPED_UNICODE);

$pythonPath = '/usr/bin/python3';
$scriptPath = __DIR__ . '/src/send_email.py';
$descriptorSpec = [
    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w'],
];

$process = proc_open(escapeshellcmd($pythonPath) . ' ' . escapeshellarg($scriptPath), $descriptorSpec, $pipes);

if (!is_resource($process)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Falha ao iniciar o serviço de envio.']);
    exit;
}

fwrite($pipes[0], $payload);
fclose($pipes[0]);

$output = stream_get_contents($pipes[1]);
$errorOutput = stream_get_contents($pipes[2]);

fclose($pipes[1]);
fclose($pipes[2]);

$returnCode = proc_close($process);

if ($returnCode !== 0) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao enviar e-mail: ' . trim($output . ' ' . $errorOutput)]);
    exit;
}

$response = json_decode($output, true);
if (!is_array($response)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Resposta inválida do serviço de envio.']);
    exit;
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
