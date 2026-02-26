<?php

require_once './Database.php';
header('Content-Type: application/json; charset=utf-8');

class Contribuenti
{
    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getByComune(string $com_id): string {
        $sql = 'SELECT contribuenti.con_nome FROM contribuenti WHERE con_com_id = :com_id ORDER BY con_nome';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':com_id', $com_id, PDO::PARAM_INT);
        $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}

$com_id = filter_input(INPUT_GET, 'com_id', FILTER_VALIDATE_INT);
if ($com_id === false || $com_id === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Parametro com_id mancante o non valido']);
    exit;
}

$contribuenti = new Contribuenti();
echo $contribuenti->getByComune($com_id);