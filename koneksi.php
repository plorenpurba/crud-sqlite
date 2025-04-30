<?php
try{
    $conn = new \PDO('sqlite:./database.db');
}catch(\PDOException $e){
    echo $e->getMessage();
}

class Database{
    function create ($tugas, $waktu){
        $sql = "INSERT INTO tugas (deskripsi, waktu) VALUES('$tugas','$waktu')";
        $conn->exec($sql);
    }
}