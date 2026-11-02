<?php 
require 'auth.php';

$judul = "Daftar Kategori Barang";
$menu = "kategori";

// pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query_db("SELECT * FROM kategori"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

if(isset($_GET["halaman"])){
    $halamanAktif = $_GET["halaman"];
}else{
    $halamanAktif = 1;
}
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// search
if(isset($_POST["cari"])){
    $keyword = $_POST["keyword"];
    $kategori = cari_kategori($keyword);
    $sedangCari = true;
    $awalData = 0;
}else{
    $keyword = "";
    $kategori = query_db("SELECT * FROM kategori LIMIT $awalData, $jumlahDataPerHalaman");
    $sedangCari = false;
}

$nomor = $awalData + 1;

require 'header.php';
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post" class="form-inline">
                    <input type="text" name="keyword" class="form-control mr-2" placeholder="Cari kategori..." value="<?php echo $keyword; ?>" autocomplete="off">
                    <button type="submit" name="cari" class="btn btn-primary mr-1">Cari</button>
                    <a href="kategori.php" class="btn btn-secondary">Reset</a>
                </form>
            </div>
            <div class="col-md-6 text-md-right mt-2 mt-md-0">
                <a href="tambah_kategori.php" class="btn btn-success">+ Tambah Data</a>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-bordered text-nowrap">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($kategori) == 0) : ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach($kategori as $data) : ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $data["nama_kategori"]; ?></td>
                    <td><?php echo $data["keterangan"]; ?></td>
                    <td>
                        <a href="edit_kategori.php?id=<?php echo $data["id"]; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="hapus_kategori.php?id=<?php echo $data["id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if($sedangCari == false) : ?>
    <div class="card-footer">
        <?php require 'pagination.php'; ?>
    </div>
    <?php endif; ?>
</div>

<?php require 'footer.php'; ?>
