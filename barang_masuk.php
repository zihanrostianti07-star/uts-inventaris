<?php 
require 'auth.php';

$judul = "Daftar Barang Masuk";
$menu = "barang_masuk";

// pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query_db("SELECT * FROM barang_masuk"));
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
    $barang_masuk = cari_barang_masuk($keyword);
    $sedangCari = true;
    $awalData = 0;
}else{
    $keyword = "";
    $barang_masuk = query_db("SELECT barang_masuk.*, barang.nama_barang, supplier.nama AS nama_supplier
                              FROM barang_masuk
                              JOIN barang ON barang_masuk.barang_id = barang.id
                              JOIN supplier ON barang_masuk.supplier_id = supplier.id
                              ORDER BY barang_masuk.id DESC
                              LIMIT $awalData, $jumlahDataPerHalaman");
    $sedangCari = false;
}

// pesan hasil tambah / edit / hapus (dikirim lewat GET)
$pesan = "";
if(isset($_GET["pesan"])){
    $pesan = $_GET["pesan"];
}

$nomor = $awalData + 1;

require 'header.php';
?>

<?php if($pesan == "tambah") : ?>
    <div class="alert alert-success">Data barang masuk berhasil ditambahkan!</div>
<?php elseif($pesan == "edit") : ?>
    <div class="alert alert-success">Data barang masuk berhasil diubah!</div>
<?php elseif($pesan == "hapus") : ?>
    <div class="alert alert-success">Data barang masuk berhasil dihapus!</div>
<?php elseif($pesan == "gagal") : ?>
    <div class="alert alert-danger">Proses gagal dilakukan!</div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post" class="form-inline">
                    <input type="text" name="keyword" class="form-control mr-2" placeholder="Cari barang masuk..." value="<?php echo $keyword; ?>" autocomplete="off">
                    <button type="submit" name="cari" class="btn btn-primary mr-1">Cari</button>
                    <a href="barang_masuk.php" class="btn btn-secondary">Reset</a>
                </form>
            </div>
            <div class="col-md-6 text-md-right mt-2 mt-md-0">
                <a href="tambah_barang_masuk.php" class="btn btn-success">+ Tambah Data</a>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-bordered text-nowrap">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($barang_masuk) == 0) : ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach($barang_masuk as $data) : ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $data["tanggal"]; ?></td>
                    <td><?php echo $data["nama_barang"]; ?></td>
                    <td><?php echo $data["nama_supplier"]; ?></td>
                    <td><?php echo $data["jumlah"]; ?></td>
                    <td><?php echo $data["keterangan"]; ?></td>
                    <td>
                        <a href="edit_barang_masuk.php?id=<?php echo $data["id"]; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="hapus_barang_masuk.php?id=<?php echo $data["id"]; ?>" class="btn btn-sm btn-danger">Hapus</a>
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
