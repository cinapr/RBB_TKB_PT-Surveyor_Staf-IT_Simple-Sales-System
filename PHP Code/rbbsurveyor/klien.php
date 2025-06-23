<?php include 'db.php';

// Tambah
if (isset($_POST['tambah'])) {
    $conn->query("INSERT INTO klien (nama_klien, alamat, wilayah_id) VALUES ('$_POST[nama]', '$_POST[alamat]', '$_POST[wilayah]')");
    header("Location: klien.php"); exit;
}

// Hapus
if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM klien WHERE klien_id = $_GET[hapus]");
    header("Location: klien.php"); exit;
}

// Edit
$edit = false;
$data = [];
if (isset($_GET['edit'])) {
    $edit = true;
    $data = $conn->query("SELECT * FROM klien WHERE klien_id = $_GET[edit]")->fetch_assoc();
}

// Update
if (isset($_POST['update'])) {
    $conn->query("UPDATE klien SET nama_klien='$_POST[nama]', alamat='$_POST[alamat]', wilayah_id='$_POST[wilayah]' WHERE klien_id = $_POST[id]");
    header("Location: klien.php"); exit;
}
?>

<h2>Data Klien</h2>

<?php if ($edit): ?>
<form method="POST">
    <input type="hidden" name="id" value="<?= $data['klien_id'] ?>">
    Nama: <input name="nama" value="<?= $data['nama_klien'] ?>"><br>
    Alamat: <input name="alamat" value="<?= $data['alamat'] ?>"><br>
    Wilayah: 
    <select name="wilayah">
        <?php
        $wil = $conn->query("SELECT * FROM wilayah");
        while ($w = $wil->fetch_assoc()):
            $sel = $w['Wilayah_ID'] == $data['wilayah_id'] ? 'selected' : '';
            echo "<option value='$w[Wilayah_ID]' $sel>$w[Provinsi]</option>";
        endwhile;
        ?>
    </select><br>
    <button name="update">Update</button> <a href="klien.php">Batal</a>
</form>
<?php else: ?>
<form method="POST">
    Nama: <input name="nama"><br>
    Alamat: <input name="alamat"><br>
    Wilayah: 
    <select name="wilayah">
        <?php
        $wil = $conn->query("SELECT * FROM wilayah");
        while ($w = $wil->fetch_assoc()):
            echo "<option value='$w[Wilayah_ID]'>$w[Provinsi]</option>";
        endwhile;
        ?>
    </select><br>
    <button name="tambah">Tambah</button>
</form>
<?php endif; ?>

<table border="1" cellpadding="5">
<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Wilayah</th><th>Aksi</th></tr>
<?php
$q = $conn->query("SELECT k.*, w.Provinsi FROM klien k LEFT JOIN wilayah w ON k.wilayah_id = w.Wilayah_ID");
while($r = $q->fetch_assoc()): ?>
<tr>
    <td><?= $r['klien_id'] ?></td>
    <td><?= $r['nama_klien'] ?></td>
    <td><?= $r['alamat'] ?></td>
    <td><?= $r['Provinsi'] ?></td>
    <td>
        <a href="klien.php?edit=<?= $r['klien_id'] ?>">Edit</a> |
        <a href="klien.php?hapus=<?= $r['klien_id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
