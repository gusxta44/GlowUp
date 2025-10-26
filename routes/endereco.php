<?php
require_once __DIR__ . '/../controllers/EnderecoController.php';

$id = $seguimentos[2] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

//rapaziada, esse ( ? e : ) é como se fosse literalmente um if else, dei uma mudada pra nao ficar ctrl c e v igual o jeff pediu :)

switch ($method) {
    case 'GET':
        $id ? EnderecoController::getById($id) : EnderecoController::getAll();
        break; 

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            jsonResponse(['message' => 'Dados inválidos'], 400);
            break;
        }
        EnderecoController::create($data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$id) {
            jsonResponse(['message' => 'ID do endereço é obrigatório'], 400);
            break;
        }
        EnderecoController::update($id, $data);
        break;

    case 'DELETE':
        if (!$id) {
            jsonResponse(['message' => 'ID do endereço é obrigatório'], 400);
            break;
        }
        EnderecoController::delete($id);
        break;

    default:
        jsonResponse(['status' => 'erro', 'message' => 'Método não permitido'], 405);
}
?>
