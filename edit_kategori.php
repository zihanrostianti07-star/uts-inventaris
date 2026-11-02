<?php 
require 'auth.php';

$judul = "Edit Data Kategori";
$menu = "kategori";

$id = $_GET["id"];
$kategori = query_db("SELECT * FROM kategori WHERE id = $id")[0];

if(isset($_POST["edit"])){
    if(edit_kategori($_POST) > 0){
        echo "<script>
                alert('Data kategori berhasil diubah!');
                document.location.href = 'kategori.php';
              </script>
        ";
    }else{
        echo "<script>
                alert('Data kategori gagal diubah atau tidak ada perubahan!');
              </script>
        ";
        echo mysqli_error($conn);
    }
}

require 'header.php';
?>

<div class="card">
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $kategori["id"]; ?>">
        <input type="hidden" name="nama_lama" value="<?php echo $kategori["nama_kategori"]; ?>">

        <div class="card-body">
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="<?php echo $kategori["nama_kategori"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required><?php echo $kategori["keterangan"]; ?></textarea>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="edit" class="btn btn-primary"> Edit Data </button>
            <a href="kategori.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
