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
        $sql = 'SELECT con_nome FROM contribuenti WHERE con_com_id = :com_id ORDER BY con_nome';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':com_id', $com_id, PDO::PARAM_INT);
        $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}

$contribuenti = new Contribuenti();
echo $contribuenti->getByComune($_GET['com_id']);