<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Form Ubah Data Nilai Siswa
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $cetak_nilai['id']; ?>">
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
                        <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->