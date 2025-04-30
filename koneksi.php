<?php
try {
    $conn = new PDO('sqlite:./database.db');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

class Database {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function create($tugas, $waktu) {
        $sql = "INSERT INTO tugas (deskripsi, waktu) VALUES (:tugas, :waktu)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tugas', $tugas);
        $stmt->bindParam(':waktu', $waktu);
        return $stmt->execute();
    }

    public function showTugas() {
        $sql = "SELECT * FROM tugas";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showTugasDariID($id) {
        if (!$id) {
            header('Location: /');
            exit();
        }
        $sql = $this->conn->prepare("SELECT * FROM tugas WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = $this->conn->prepare("DELETE FROM tugas WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        return $sql->execute();
    }

    public function updateTugas($id, $deskripsi, $waktu) {
        if (empty($deskripsi) || empty($waktu)) {
            header('Location: /');
            exit();
        }
        $sql = $this->conn->prepare("UPDATE tugas SET deskripsi = :deskripsi, waktu = :waktu WHERE id = :id");
        $sql->bindParam(':deskripsi', $deskripsi);
        $sql->bindParam(':waktu', $waktu);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        return $sql->execute();
    }
}

$db = new Database($conn);
