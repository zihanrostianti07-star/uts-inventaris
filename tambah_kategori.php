<?php 
require 'auth.php';

$judul = "Tambah Data Kategori";
$menu = "kategori";

if(isset($_POST["tambah"])){
    if(tambah_kategori($_POST) > 0){
        echo "<script>
                alert('Data kategori berhasil ditambahkan!');
                document.location.href = 'kategori.php';
              </script>
        ";
    }else{
        echo "<script>
                alert('Data kategori gagal ditambahkan!');
              </script>
        ";
        echo mysqli_error($conn);
    }
}

require 'header.php';
?>

<div class="card">
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Contoh: Elektronik" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan kategori" required></textarea>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="tambah" class="btn btn-success"> Tambah Data </button>
            <a href="kategori.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
