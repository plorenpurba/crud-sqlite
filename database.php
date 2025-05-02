<?php

class Database{
     function create ($tugas, $waktu){
         global $conn;
         $sql = "INSERT INTO tugas (deskripsi, waktu) VALUES('$tugas','$waktu')";
         $conn->exec($sql);
     }
     function showTugas (){
         global $conn;
         $sql = $conn->query("SELECT * FROM tugas");
         return $sql->fetchAll(PDO::FETCH_ASSOC);
     }
     function showTugasDariId ($id){
         global $conn;
         if(!$id){
             header('Location: /');
             exit();
         }
         else{
             $sql = $conn->prepare("SELECT * FROM tugas WHERE id = :id");
             $sql->bindParam(':id', $id, PDO::PARAM_INT);
             $sql->execute();
 
         }
         return $sql->fetchAll(PDO::FETCH_ASSOC);
     }
     function delete($d){
         global $conn;
         $sql = "DELETE FROM tugas WHERE id = ". $d;
         $conn->exec($sql);
     }
     
     function updateTugas($id, $deskripsi, $waktu){
         global $conn;
         if (empty($deskripsi) || empty($waktu)){
             header('Location: /'); 
             exit();
         }
         $sql = $conn->prepare("UPDATE tugas SET deskripsi = :deskripsi, waktu = :waktu WHERE id = :id");
         $sql->bindParam(':deskripsi', $deskripsi);
         $sql->bindParam(':waktu', $waktu, PDO::PARAM_INT);
         $sql->bindParam(':id', $id, PDO::PARAM_INT);
         return $sql->execute();
     }
 }

 $db = new Database();