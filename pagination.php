<?php // butuh variabel: $halamanAktif dan $jumlahHalaman (dihitung di halaman yang memanggil) ?>
<ul class="pagination justify-content-center mb-0">

    <!-- tombol Prev -->
    <?php if($halamanAktif > 1) : ?>
        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halamanAktif - 1; ?>">&larr; Prev</a></li>
    <?php else : ?>
        <li class="page-item disabled"><span class="page-link">&larr; Prev</span></li>
    <?php endif; ?>

    <!-- nomor halaman -->
    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamanAktif) : ?>
            <li class="page-item active"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php else : ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>

    <!-- tombol Next -->
    <?php if($halamanAktif < $jumlahHalaman) : ?>
        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halamanAktif + 1; ?>">Next &rarr;</a></li>
    <?php else : ?>
        <li class="page-item disabled"><span class="page-link">Next &rarr;</span></li>
    <?php endif; ?>

</ul>
