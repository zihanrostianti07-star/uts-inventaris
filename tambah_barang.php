<?php 
require 'auth.php';

$judul = "Tambah Data Barang";
$menu = "barang";

$daftar_kategori = query_db("SELECT * FROM kategori");

if(isset($_POST["tambah"])){
    if(tambah_barang($_POST) > 0){
        echo "<script>
                alert('Data barang berhasil ditambahkan!');
                document.location.href = 'index.php';
              </script>
        ";
    }else{
        echo "<script>
                alert('Data barang gagal ditambahkan!');
              </script>
        ";
        echo mysqli_error($conn);
    }
}

require 'header.php';
?>

<div class="card">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Contoh: BR008" required>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Masukkan nama barang" required>
            </div>

            <div class="form-group">
                <label for="merk">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control" placeholder="Masukkan merk barang" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach($daftar_kategori as $kat) : ?>
                        <option value="<?php echo $kat["nama_kategori"]; ?>"><?php echo $kat["nama_kategori"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control-file">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="tambah" class="btn btn-success"> Tambah Data </button>
            <a href="index.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
