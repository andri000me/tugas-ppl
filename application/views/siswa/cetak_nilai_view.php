<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <a href="<?= base_url('cetak/cetakNilai') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak semua nilai</a>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('pesan'); ?>
            <!-- tambah data -->
            <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Nilai Siswa</a>
            <!-- table menu -->
            <div class="table-responsive-xl">
                <table class="table table-hover" style="width: 195%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($cetak_nilai as $s) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $s['nama']; ?></td>
                                <td><?= $s['mapel']; ?></td>
                                <td><?= $s['nilai']; ?></td>
                                <td>
                                    <a href="<?= base_url('user/ubahDataNilai/') . $s['id']; ?>" class="badge badge-success">edit</a>
                                    |
                                    <a href="<?= base_url('user/hapusDataNilai/') . $s['id']; ?>" data-toggle="modal" data-target="#ubahData" class="badge badge-danger tombol-hapus-siswa">delete</a>
                                </td>
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

<!-- Modal -->
<!-- Modal tambah data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/nilaiSiswa') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Siswa</label>
                        <select class="form-control" id="nama" name="nama">
                            <?php foreach ($siswa as $s) : ?>

                                <option value="<?= $s['nama']; ?>"><?= $s['nama']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mapel">Mata Pelajaran</label>
                        <select class="form-control" id="mapel" name="mapel">
                            <?php foreach ($mapel as $m) : ?>

                                <option value="<?= $m['mapel']; ?>" selected><?= $m['mapel']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <select class="form-control" id="nilai" name="nilai">
                            <?php foreach ($nilai as $n) : ?>

                                <option value="<?= $n['nilai']; ?>" selected><?= $n['nilai']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>