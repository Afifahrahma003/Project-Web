<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('model/t_jawaban_alumni_model.php');
include_once('model/t_responden_alumni_model.php');
include_once('model/koneksi.php');

$act = $_GET['act'];
$alumni = new t_responden_alumni($db);
$idRes = $alumni->getRespondenId();

if ($act == 'simpan') {
    foreach ($_POST['jawaban'] as $soal_id => $jawaban) {
        $data = [
            'responden_alumni_id' => $idRes,
            'soal_id' => $soal_id,
            'jawaban' => $jawaban,
        ];
        $insert = new t_jawaban_alumni($db);
        $insert->insertData($data);
    }
    echo 'berhasil';
    // Redirect setelah sukses menyimpan data
    header('Location: t_responden_alumni_form.php');
    exit();
}

if ($act == 'hapus') {
    $id = $_GET['id'];

    $hapus = new t_jawaban_alumni($db);
    $hapus->deleteData($id);

    header('Location: t_responden_alumni_form.php');
    exit();
}
?>