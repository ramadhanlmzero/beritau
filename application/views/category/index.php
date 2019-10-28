<?php
$this->load->view("layouts/wrapper_top.php");
use Carbon\Carbon;
?>

<div class="tombol">
    <a href="<?php echo base_url() ?>author/category/create" class="btn btn-gradient btn-fw">
        Tambah Data
    </a>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data Kategori</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="categoryTable" class="table">
                        <thead>
                            <tr>
                                <th width="50px">No.</th>
                                <th>Jenis Kategori</th>
                                <th>Terakhir Dibuat</th>
                                <th>Terakhir Diperbarui</th>
                                <th width="70px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $number = 1;
                            foreach ($categories as $category) {
                                ?>
                                <tr>
                                    <td><?php echo $number++ ?></td>
                                    <td><?php str($category->name) ?></td>
                                    <td><?php str(Carbon::parse($category->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y %H:%I:%S')) ?></td>
                                    <td><?php str(Carbon::parse($category->updated_at, 'Asia/Jakarta')->locale('ID')->diffForHumans()) ?></td>
                                    <td>
                                        <a href="<?php echo base_url() ?>author/category/edit/<?php echo $category->id ?>" class="btn btn-primary mr-2 p-2" data-toggle="tooltip" title="Ubah Kategori">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="<?php echo base_url() ?>author/category/delete/<?php echo $category->id ?>" method="POST" style="display:inline;">
                                            <button type="submit" class="btn btn-danger p-2" data-toggle="tooltip" onclick="deleteEntry()" title="Hapus Kategori">
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