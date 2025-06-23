<?php include 'db.php';

// Tambah
if (isset($_POST['tambah'])) {
    $conn->query("INSERT INTO aktivitas_sales (sales_id, klien_id, tanggal_aktivitas, deskripsi)
    VALUES ('$_POST[sales]', '$_POST[klien]', '$_POST[tanggal]', '$_POST[deskripsi]')");
    header("Location: aktivitas_sales.php"); exit;
}

// Hapus
if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM aktivitas_sales WHERE aktivitas_id = $_GET[hapus]");
    header("Location: aktivitas_sales.php"); exit;
}
?>

<h2>Aktivitas Sales</h2>

<form method="POST">
    Sales:
    <select name="sales">
        <?php
        $s = $conn->query("SELECT * FROM sales");
        while ($row = $s->fetch_assoc()) {
            echo "<option value='{$row['Sales_ID']}'>{$row['nama_sales']}</option>";
        }
        ?>
    </select><br>

    Klien:
    <select name="klien">
        <?php
        $k = $conn->query("SELECT * FROM klien");
        while ($row = $k->fetch_assoc()) {
            echo "<option value='{$row['klien_id']}'>{$row['nama_klien']}</option>";
        }
        ?>
    </select><br>

    Tanggal: <input type="date" name="tanggal"><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    <button name="tambah">Simpan</button>
</form>

<table border="1" cellpadding="5">
<tr><th>ID</th><th>Sales</th><th>Klien</th><th>Tanggal</th><th>Deskripsi</th><th>Aksi</th></tr>
<?php
$q = $conn->query("SELECT a.*, s.nama_sales, k.nama_klien FROM aktivitas_sales a
    LEFT JOIN sales s ON a.sales_id = s.Sales_ID
    LEFT JOIN klien k ON a.klien_id = k.klien_id
    ORDER BY a.tanggal_aktivitas DESC");
while ($r = $q->fetch_assoc()): ?>
<tr>
    <td><?= $r['aktivitas_id'] ?></td>
    <td><?= $r['nama_sales'] ?></td>
    <td><?= $r['nama_klien'] ?></td>
    <td><?= $r['tanggal_aktivitas'] ?></td>
    <td><?= $r['deskripsi'] ?></td>
    <td><a href="?hapus=<?= $r['aktivitas_id'] ?>" onclick="return confirm('Hapus?')">Hapus</a></td>
</tr>
<?php endwhile; ?>
</table>
