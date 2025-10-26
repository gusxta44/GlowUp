<?php
require_once __DIR__ . '/../controllers/ProfissionaisController.php';

$id = $seguimentos[2] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $id ? ProfissionaisController::getById($id) : ProfissionaisController::getAll();
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || empty($data['nome']) || empty($data['email']) || empty($data['descricao']) || !isset($data['acessibilidade']) || !isset($data['isJuridica']) || empty($data['id_cadastro_fk'])) {
            jsonResponse(['message' => 'Dados inválidos ou incompletos'], 400);
            break;
        }
        ProfissionaisController::create($data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? $id;
        if (!$id) {
            jsonResponse(['message' => 'ID do profissional é obrigatório'], 400);
            break;
        }
        ProfissionaisController::update($data, $id);
        break;

    case 'DELETE':
        if (!$id) {
            jsonResponse(['message' => 'ID do profissional é obrigatório'], 400);
            break;
        }
        ProfissionaisController::delete($id);
        break;

    default:
        jsonResponse(['status' => 'erro', 'message' => 'Método não permitido'], 405);
}
?>
