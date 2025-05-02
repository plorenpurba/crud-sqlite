<?php
include"koneksi.php";

// Yang nanganin
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $tugas = $_POST['tugas'];
    $waktuString = $_POST['waktu'];
    $waktu = (int) $waktuString;
    
    if (empty($tugas) || empty($waktu)){
        header('Location: '. $_SERVER['SCRIPT_NAME']);
        exit;
    }
    else{
        $db->create($tugas, $waktu);
        header('Location: '. $_SERVER['SCRIPT_NAME']);
        exit;
    }
    
}
if ($_SERVER['REQUEST_METHOD'] == "GET"){
    $hapus = isset($_GET['hapus']) ? $_GET['hapus'] : false;
    if ($hapus !== false){
        $db->delete($hapus);
        header('Location: '. $_SERVER['SCRIPT_NAME']);
        exit;
    }
}

$listTugas = $db->showTugas();
?>

<form action="/" method="post">
    <h2>Tugas</h2>
    <input type="text" name="tugas" required>
    <h2>Waktu</h2>
    <input type="number" name="waktu" required>
    <button type="submit">Simpan</button>
</form>

<?php if(!empty($listTugas)): ?>
    <h2>Daftar Tugas </h2>
    <ul>
    <?php foreach($listTugas as $t): ?>
        <li>Tugas : <?= $t['deskripsi']; ?> </li>
        <li>waktu : <?= $t['waktu']; ?> Jam <a href="?hapus=<?= $t['id']; ?>">Hapus</a> | <a href="update.php?ubah=<?= $t['id'] ?> ">Ubah</a></li>
        <hr>
    <?php endforeach; ?>

    </ul>
    <?php endif; ?>