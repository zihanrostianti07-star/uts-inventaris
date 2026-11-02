<?php 
require 'auth.php';

$judul = "Daftar Supplier Inventaris";
$menu = "supplier";

// pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query_db("SELECT * FROM supplier"));
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
    $supplier = cari_supplier($keyword);
    $sedangCari = true;
    $awalData = 0;
}else{
    $keyword = "";
    $supplier = query_db("SELECT * FROM supplier LIMIT $awalData, $jumlahDataPerHalaman");
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
                    <input type="text" name="keyword" class="form-control mr-2" placeholder="Cari supplier..." value="<?php echo $keyword; ?>" autocomplete="off">
                    <button type="submit" name="cari" class="btn btn-primary mr-1">Cari</button>
                    <a href="supplier.php" class="btn btn-secondary">Reset</a>
                </form>
            </div>
            <div class="col-md-6 text-md-right mt-2 mt-md-0">
                <a href="tambah_supplier.php" class="btn btn-success">+ Tambah Data</a>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-bordered text-nowrap">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Supplier</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($supplier) == 0) : ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach($supplier as $data) : ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $data["kode_supplier"]; ?></td>
                    <td><?php echo $data["nama"]; ?></td>
                    <td><?php echo $data["email"]; ?></td>
                    <td><?php echo $data["no_hp"]; ?></td>
                    <td>
                        <?php if($data["gambar"] != "") : ?>
                            <img src="img/<?php echo $data["gambar"]; ?>" alt="" width="90" height="90">
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_supplier.php?id=<?php echo $data["id"]; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="hapus_supplier.php?id=<?php echo $data["id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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
