<?php 
require 'auth.php';

$judul = "Edit Data Barang";
$menu = "barang";

$daftar_kategori = query_db("SELECT * FROM kategori");

$id = $_GET["id"];
$barang = query_db("SELECT * FROM barang WHERE id = $id")[0];

if(isset($_POST["edit"])){
    if(edit_barang($_POST) > 0){
        echo "<script>
                alert('Data barang berhasil diubah!');
                document.location.href = 'index.php';
              </script>
        ";
    }else{
        echo "<script>
                alert('Data barang gagal diubah atau tidak ada perubahan!');
              </script>
        ";
        echo mysqli_error($conn);
    }
}

require 'header.php';
?>

<div class="card">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $barang["id"]; ?>">
        <input type="hidden" name="gambar_lama" value="<?php echo $barang["gambar"]; ?>">

        <div class="card-body">
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="<?php echo $barang["kode_barang"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?php echo $barang["nama_barang"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="merk">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control" value="<?php echo $barang["merk"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach($daftar_kategori as $kat) : ?>
                        <?php 
                        if($kat["nama_kategori"] == $barang["kategori"]){
                            $pilih = "selected";
                        }else{
                            $pilih = "";
                        }
                        ?>
                        <option value="<?php echo $kat["nama_kategori"]; ?>" <?php echo $pilih; ?>><?php echo $kat["nama_kategori"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar (kosongkan jika tidak ingin mengganti)</label><br>
                <?php if($barang["gambar"] != "") : ?>
                    <img src="img/<?php echo $barang["gambar"]; ?>" alt="" width="100" height="100"><br><br>
                <?php endif; ?>
                <input type="file" name="gambar" id="gambar" class="form-control-file">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="edit" class="btn btn-primary"> Edit Data </button>
            <a href="index.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
