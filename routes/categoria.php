<?php
require_once __DIR__ . '/../controllers/CategoriaController.php';

$id = $seguimentos[2] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'GET':
        if ($id) {
            CategoriaController::getById($id);
        } else {
            CategoriaController::getAll();
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['nome'])) {
            jsonResponse(['message' => 'Nome da categoria é obrigatório'], 400);
            break;
        }
        CategoriaController::create($data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$id) {
            jsonResponse(['message' => 'ID da categoria é obrigatório'], 400);
            break;
        }

        if (!$data || empty($data['nome'])) {
            jsonResponse(['message' => 'Nome da categoria é obrigatório'], 400);
            break;
        }

        CategoriaController::update($id, $data);
        break;

    case 'DELETE':
        if (!$id) {
            jsonResponse(['message' => 'ID da categoria é obrigatório'], 400);
            break;
        }

        CategoriaController::delete($id);
        break;

    default:
        jsonResponse(['status' => 'erro', 'message' => 'Método não permitido'], 405);
}
?>
