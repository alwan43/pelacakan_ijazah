<?php
include "database.php";
$hasil = "";
$data = null;

if (isset($_POST['nisn'])) {
    $nisn = mysqli_real_escape_string($db, $_POST['nisn']);

    // Query pencarian berdasarkan NISN
    $sql = "SELECT * FROM ijazah WHERE nisn=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $nisn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $hasil = "✅ Data ijazah ditemukan!";
    } else {
        $hasil = "❌ NISN tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pencarian Ijazah</title>
</head>
<body>
    <h2>Cek Data Ijazah</h2>

    <form method="POST" action="index.php">
        <label>Masukkan NISN:</label><br>
        <input type="text" name="nisn" required placeholder="Contoh: 1234567890">
        <button type="submit">Cari</button>
    </form>

    <p><?= $hasil ?></p>

  <?php if ($data): ?>
    <h3>Detail Ijazah:</h3>
    <ul>
        <li><strong>NISN:</strong> <?= htmlspecialchars($data['NISN']) ?></li>
        <li><strong>Nama:</strong> <?= htmlspecialchars($data['nama']) ?></li>
        <li><strong>Tempat & Tanggal Lahir:</strong> <?= htmlspecialchars($data['tempat_tanggal_lahir']) ?></li>
        <li><strong>Jenis Kelamin:</strong> <?= htmlspecialchars($data['jenis_kelamin']) ?></li>
        <li><strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']) ?></li>
        <li><strong>Kompetensi Keahlian:</strong> <?= htmlspecialchars($data['kompetensi_keahlian']) ?></li>
        <li><strong>Tanggal Lulus:</strong> <?= htmlspecialchars($data['tanggal_lulus']) ?></li>
        <li><strong>Nomor Ijazah:</strong> <?= htmlspecialchars($data['nomor_ijazah']) ?></li>
        <li><strong>Status Ijazah:</strong> <?= htmlspecialchars($data['status_ijazah']) ?></li>

        <?php if (!empty($data['foto'])): ?>
            <li><strong>Foto:</strong><br>
                <img src="uploads/<?= htmlspecialchars($data['foto']) ?>" alt="Foto Siswa" width="150">
            </li>
        <?php else: ?>
            <li><strong>Foto:</strong> Tidak ada foto tersedia</li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
