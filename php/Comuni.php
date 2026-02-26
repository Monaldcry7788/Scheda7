<?php
require_once './Database.php';
class Comuni
{
    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getComuni(): String {
        $stmt = $this->conn->query('SELECT com_id, com_nome FROM comuni ORDER BY com_nome');
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}

$comuni = new Comuni();
echo $comuni->getComuni();