<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card mb-3" style="max-width: 800px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="card-text">Nip</p>
                        </div>
                        :
                        <div class="col">
                            <p class="card-text"><?= $user['nip']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="card-text">Username</p>
                        </div>
                        :
                        <div class="col">
                            <p class="card-text"><?= $user['username']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="card-text">No . Telp</p>
                        </div>
                        :
                        <div class="col">
                            <p class="card-text"><?= $user['telp']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="card-text">Tanggal Lahir</p>
                        </div>
                        :
                        <div class="col">
                            <p class="card-text"><?= $user['tgl_lahir']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="card-text">Alamat</p>
                        </div>
                        :
                        <div class="col">
                            <p class="card-text"><?= $user['alamat']; ?></p>
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-6">
                            <a class="badge badge-success" href="<?= base_url('user/editUser/') . $user['id']; ?>"><i class="fas fa-fw fa-user-edit "></i> Edit Profile</a>

                        </div>
                        <div class="col-6">
                            <a class="badge badge-primary" href="<?= base_url('user/changePassword'); ?>"><i class="fas fa-fw fa-key "></i> Ubah Password</a>

                        </div>
                    </div>


                    <p class="card-text"><small class="text-muted">Member sejak <?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.Container-fluid -->



</div>
<!-- End of Main Content -->