<?php 
require 'auth.php';

$id = $_GET["id"];

if(hapus_barang($id) > 0){
    echo "<script>
            alert('Data barang berhasil dihapus!');
            document.location.href = 'index.php';
          </script>
    ";
}else{
    echo "<script>
            alert('Data barang gagal dihapus!');
            document.location.href = 'index.php';
          </script>
    ";
}
?>
