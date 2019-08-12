<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <a href="<?= base_url('cetak/cetakSiswa') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak semua data siswa</a>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <!-- table menu -->
            <div class="table-responsive-xl">
                <table class="table table-hover" style="width: 195%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nis</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tangal Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">No. Telpn</th>
                            <th scope="col">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($siswa as $s) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $s['nis']; ?></td>
                                <td><?= $s['nama']; ?></td>
                                <td><?= $s['tgl_lahir']; ?></td>
                                <td><?= $s['jenis_kelamin']; ?></td>
                                <td><?= $s['telp']; ?></td>
                                <td><?= $s['alamat']; ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->