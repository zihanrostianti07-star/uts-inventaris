<?php 
require 'auth.php';

$judul = "Tambah Data Supplier";
$menu = "supplier";

if(isset($_POST["tambah"])){
    if(tambah_supplier($_POST) > 0){
        echo "<script>
                alert('Data supplier berhasil ditambahkan!');
                document.location.href = 'supplier.php';
              </script>
        ";
    }else{
        echo "<script>
                alert('Data supplier gagal ditambahkan!');
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
                <label for="kode_supplier">Kode Supplier</label>
                <input type="text" name="kode_supplier" id="kode_supplier" class="form-control" placeholder="Contoh: SP007" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama supplier" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label for="no_hp">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Contoh: 081234567890" required>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control-file">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="tambah" class="btn btn-success"> Tambah Data </button>
            <a href="supplier.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
