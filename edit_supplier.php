<?php 
require 'auth.php';

$judul = "Edit Data Supplier";
$menu = "supplier";

$id = $_GET["id"];
$supplier = query_db("SELECT * FROM supplier WHERE id = $id")[0];

if(isset($_POST["edit"])){
    if(edit_supplier($_POST) > 0){
        echo "<script>
                alert('Data supplier berhasil diubah!');
                document.location.href = 'supplier.php';
              </script>
        ";
    }else{
        echo "<script>
                alert('Data supplier gagal diubah atau tidak ada perubahan!');
              </script>
        ";
        echo mysqli_error($conn);
    }
}

require 'header.php';
?>

<div class="card">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $supplier["id"]; ?>">
        <input type="hidden" name="gambar_lama" value="<?php echo $supplier["gambar"]; ?>">

        <div class="card-body">
            <div class="form-group">
                <label for="kode_supplier">Kode Supplier</label>
                <input type="text" name="kode_supplier" id="kode_supplier" class="form-control" value="<?php echo $supplier["kode_supplier"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $supplier["nama"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $supplier["email"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="no_hp">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?php echo $supplier["no_hp"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar (kosongkan jika tidak ingin mengganti)</label><br>
                <?php if($supplier["gambar"] != "") : ?>
                    <img src="img/<?php echo $supplier["gambar"]; ?>" alt="" width="100" height="100"><br><br>
                <?php endif; ?>
                <input type="file" name="gambar" id="gambar" class="form-control-file">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="edit" class="btn btn-primary"> Edit Data </button>
            <a href="supplier.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
