<?php 
require 'auth.php';

$id = (int) $_GET["id"];

if(hapus_barang_masuk($id) > 0){
    header("Location: barang_masuk.php?pesan=hapus");
}else{
    header("Location: barang_masuk.php?pesan=gagal");
}
exit;
?>
