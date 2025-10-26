<?php
require_once __DIR__ . '/../controllers/TelProfController.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        TelProfController::getAll();
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['id_profissional_fk']) || empty($data['id_telefone_fk'])) {
            jsonResponse(['message' => 'IDs obrigatórios'], 400);
            break;
        }
        TelProfController::create($data);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['id_profissional_fk']) || empty($data['id_telefone_fk'])) {
            jsonResponse(['message' => 'IDs obrigatórios'], 400);
            break;
        }
        TelProfController::delete($data['id_profissional_fk'], $data['id_telefone_fk']);
        break;

    default:
        jsonResponse(['status' => 'erro', 'message' => 'Método não permitido'], 405);
}
?>
