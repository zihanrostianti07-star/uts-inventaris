<?php 
require 'auth.php';

$judul = "Edit Data Barang Masuk";
$menu = "barang_masuk";

$id = (int) $_GET["id"];
$barang_masuk = query_db("SELECT * FROM barang_masuk WHERE id = $id")[0];

$daftar_barang = query_db("SELECT * FROM barang");
$daftar_supplier = query_db("SELECT * FROM supplier");

$gagal = false;

if(isset($_POST["edit"])){
    if(edit_barang_masuk($_POST) > 0){
        header("Location: barang_masuk.php?pesan=edit");
        exit;
    }else{
        $gagal = true;
    }
}

require 'header.php';
?>

<?php if($gagal) : ?>
    <div class="alert alert-warning">Data gagal diubah atau tidak ada perubahan! <?php echo mysqli_error($conn); ?></div>
<?php endif; ?>

<div class="card">
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $barang_masuk["id"]; ?>">

        <div class="card-body">
            <div class="form-group">
                <label for="tanggal">Tanggal Masuk</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo $barang_masuk["tanggal"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="barang_id">Barang</label>
                <select name="barang_id" id="barang_id" class="form-control" required>
                    <?php foreach($daftar_barang as $brg) : ?>
                        <?php if($brg["id"] == $barang_masuk["barang_id"]) : ?>
                            <option value="<?php echo $brg["id"]; ?>" selected><?php echo $brg["kode_barang"]; ?> - <?php echo $brg["nama_barang"]; ?></option>
                        <?php else : ?>
                            <option value="<?php echo $brg["id"]; ?>"><?php echo $brg["kode_barang"]; ?> - <?php echo $brg["nama_barang"]; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-control" required>
                    <?php foreach($daftar_supplier as $sup) : ?>
                        <?php if($sup["id"] == $barang_masuk["supplier_id"]) : ?>
                            <option value="<?php echo $sup["id"]; ?>" selected><?php echo $sup["nama"]; ?></option>
                        <?php else : ?>
                            <option value="<?php echo $sup["id"]; ?>"><?php echo $sup["nama"]; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="<?php echo $barang_masuk["jumlah"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"><?php echo $barang_masuk["keterangan"]; ?></textarea>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="edit" class="btn btn-primary"> Edit Data </button>
            <a href="barang_masuk.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
