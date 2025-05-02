<?php
include "koneksi.php";

$id = isset($_GET['ubah']) ? $_GET['ubah'] : false;

$listTugas = $db->showTugasDariId($id);

if (!$listTugas) {
    header('Location: /');
    exit();
}

$tugas = $listTugas[0] ?? ['deskripsi' => '', 'waktu' => ''];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $tugas = $_POST['tugas'];
    $waktuString = $_POST['waktu'];
    $waktu = (int) $waktuString;

    if (empty($tugas) || empty($waktu)) {
        header('Location: ' . $_SERVER['SCRIPT_NAME']);
        exit;
    } else {
        $db->updateTugas($id, $tugas, $waktu);
        header('Location: /');
        exit;
    }
}
?>

<form action="" method="post">
    <h2>Tugas</h2>
    <input type="text" name="tugas" value="<?= htmlspecialchars($tugas['deskripsi']); ?>" required>
    <h2>Waktu</h2>
    <input type="number" name="waktu" value="<?= htmlspecialchars($tugas['waktu']); ?>"required>
    <button type="submit">Simpan</button>
</form>