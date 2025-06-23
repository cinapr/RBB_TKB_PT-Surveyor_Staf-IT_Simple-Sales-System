<?php include 'db.php'; ?>

<?php
// Tambah produk
if (isset($_POST['tambah'])) {
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $conn->query("INSERT INTO produk (nama_produk, kategori, harga) VALUES ('$nama', '$kategori', '$harga')");
    header("Location: produk.php");
    exit;
}

// Hapus produk
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM produk WHERE produk_id = $id");
    header("Location: produk.php");
    exit;
}

// Ambil data untuk edit
$edit = false;
$edit_data = [];
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM produk WHERE produk_id = $id");
    $edit_data = $result->fetch_assoc();
}

// Update produk
if (isset($_POST['update'])) {
    $id       = $_POST['id'];
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $conn->query("UPDATE produk SET nama_produk='$nama', kategori='$kategori', harga='$harga' WHERE produk_id=$id");
    header("Location: produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Produk Sederhana</title>
</head>
<body>
    <h2>Data Produk</h2>

    <?php if ($edit): ?>
        <h3>Edit Produk</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $edit_data['produk_id'] ?>">
            Nama Produk: <input type="text" name="nama" value="<?= $edit_data['nama_produk'] ?>" required><br>
            Kategori: <input type="text" name="kategori" value="<?= $edit_data['kategori'] ?>"><br>
            Harga: <input type="number" name="harga" value="<?= $edit_data['harga'] ?>" required><br>
            <button type="submit" name="update">Update</button>
            <a href="produk.php">Batal</a>
        </form>
    <?php else: ?>
        <h3>Tambah Produk</h3>
        <form method="POST">
            Nama Produk: <input type="text" name="nama" required><br>
            Kategori: <input type="text" name="kategori"><br>
            Harga: <input type="number" name="harga" required><br>
            <button type="submit" name="tambah">Simpan</button>
        </form>
    <?php endif; ?>

    <hr>

    <h3>Daftar Produk</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM produk ORDER BY nama_produk ASC");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['produk_id'] ?></td>
            <td><?= $row['nama_produk'] ?></td>
            <td><?= $row['kategori'] ?></td>
            <td><?= number_format($row['harga']) ?></td>
            <td>
                <a href="produk.php?edit=<?= $row['produk_id'] ?>">Edit</a> |
                <a href="produk.php?hapus=<?= $row['produk_id'] ?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
