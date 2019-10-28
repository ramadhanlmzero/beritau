<?php
$this->load->view("layouts/wrapper_top.php");
use Carbon\Carbon;
?>

<div class="tombol">
    <a href="<?php echo base_url() ?>author/user/create" class="btn btn-gradient btn-fw">
        Tambah Data
    </a>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data Pengguna</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="userTable" class="table">
                        <thead>
                            <tr>
                                <th width="50px">No.</th>
                                <th>Foto Profil</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Hak Akses</th>
                                <th>Bergabung Sejak</th>
                                <th width="70px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $number = 1;
                            foreach ($users as $user) {
                                ?>
                                <tr>
                                    <td><?php echo $number++ ?></td>
                                    <td>
                                        <img src="<?php echo base_url() ?>storage/user/<?php echo $user->photo ?>" alt="image" />
                                    </td>
                                    <td><?php str($user->name) ?></td>
                                    <td><?php str($user->email) ?></td>
                                    <td><?php str($user->role) ?></td>
                                    <td><?php str(Carbon::parse($user->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y')) ?></td>
                                    <td>
                                        <a href="<?php echo base_url() ?>author/user/edit/<?php echo $user->id ?>" class="btn btn-primary mr-2 p-2" data-toggle="tooltip" title="Ubah Pengguna">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="<?php echo base_url() ?>author/user/delete/<?php echo $user->id ?>" method="POST" style="display:inline;">
                                            <button type="submit" class="btn btn-danger p-2" data-toggle="tooltip" onclick="deleteEntry()" title="Hapus Pengguna">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view("layouts/wrapper_bottom.php");
?>