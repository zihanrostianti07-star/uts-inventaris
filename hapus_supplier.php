<?php 
require 'auth.php';

$id = $_GET["id"];

if(hapus_supplier($id) > 0){
    echo "<script>
            alert('Data supplier berhasil dihapus!');
            document.location.href = 'supplier.php';
          </script>
    ";
}else{
    echo "<script>
            alert('Data supplier gagal dihapus!');
            document.location.href = 'supplier.php';
          </script>
    ";
}
?>
