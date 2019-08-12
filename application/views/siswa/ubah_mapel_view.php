<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Form Ubah Matapelajaran
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $mapel['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Siswa</label>
                            <input type="text" class="form-control" name="mapel" id="mapel" value="<?= $mapel['mapel']; ?>">
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