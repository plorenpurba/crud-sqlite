<?php 
include "koneksi.php";

$id = isset($_GET['tampil']) ? $_GET['tampil'] : false;

$listTugas = $db->showTugasDariId($id);

if (!$listTugas) {
    header('Location: /');
    exit();
}
$tugas = $listTugas[0] ?? ['deskripsi' => '', 'waktu' => ''];


?>

<h1>Info Aktifitas</h1>
<p>Deskripsi : <?= $tugas['deskripsi'] ?></p>
<p>Waktu : <?= $tugas['waktu'] ?></p>
<a href="index.php"> Kembali</a>