<?php 
require 'auth.php';

$judul = "Tambah Data Barang Masuk";
$menu = "barang_masuk";

$daftar_barang = query_db("SELECT * FROM barang");
$daftar_supplier = query_db("SELECT * FROM supplier");

$gagal = false;

if(isset($_POST["tambah"])){
    if(tambah_barang_masuk($_POST) > 0){
        header("Location: barang_masuk.php?pesan=tambah");
        exit;
    }else{
        $gagal = true;
    }
}

require 'header.php';
?>

<?php if($gagal) : ?>
    <div class="alert alert-danger">Data barang masuk gagal ditambahkan! <?php echo mysqli_error($conn); ?></div>
<?php endif; ?>

<div class="card">
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="tanggal">Tanggal Masuk</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="form-group">
                <label for="barang_id">Barang</label>
                <select name="barang_id" id="barang_id" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach($daftar_barang as $brg) : ?>
                        <option value="<?php echo $brg["id"]; ?>"><?php echo $brg["kode_barang"]; ?> - <?php echo $brg["nama_barang"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-control" required>
                    <option value="">-- Pilih Supplier --</option>
                    <?php foreach($daftar_supplier as $sup) : ?>
                        <option value="<?php echo $sup["id"]; ?>"><?php echo $sup["nama"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" placeholder="Masukkan jumlah barang" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Contoh: Pengadaan bulan November"></textarea>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="tambah" class="btn btn-success"> Tambah Data </button>
            <a href="barang_masuk.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
