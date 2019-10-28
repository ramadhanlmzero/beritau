<?php
$this->load->view("layouts/wrapper_top.php");
$this->load->helper("url");

use Carbon\Carbon;
?>

<div class="tombol">
    <a href="<?php echo base_url() ?>author/news/create" class="btn btn-gradient btn-fw">
        Tambah Data
    </a>
    <a href="<?php echo base_url() ?>author/news/trash" class="mx-3 btn btn-danger btn-fw">
        Sampah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data Berita</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="newsTable" class="table">
                        <thead>
                            <tr>
                                <th width="50px">No.</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Status</th>
                                <th>Terakhir Dibuat</th>
                                <th>Terakhir Diperbarui</th>
                                <th width="100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $number = 1;
                            foreach ($news as $article) {
                                ?>
                                <tr>
                                    <td><?php echo $number++ ?></td>
                                    <td><?php str($article->title) ?></td>
                                    <td><?php str($article->category) ?></td>
                                    <td><?php str($article->name) ?></td>
                                    <td>
                                        <?php if ($article->status == 1) { ?>
                                            Publikasi
                                        <?php } if ($article->status == 2) { ?>
                                            Draft
                                        <?php } if ($article->status == 0) { ?>
                                            Sampah
                                        <?php } ?>
                                    </td>
                                    <td><?php str(Carbon::parse($article->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y %H:%I:%S')) ?></td>
                                    <td><?php str(Carbon::parse($article->updated_at, 'Asia/Jakarta')->locale('ID')->diffForHumans()) ?></td>
                                    <td>
                                        <a href="<?php echo base_url() ?>artikel/detail/<?php echo $article->slug ?>" target="_blank" class="btn btn-success mr-2 p-2" data-toggle="tooltip" title="Lihat Berita">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="<?php echo base_url() ?>author/news/edit/<?php echo $article->id ?>" class="btn btn-primary mr-2 p-2" data-toggle="tooltip" title="Ubah Berita">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="<?php echo base_url() ?>author/news/softdelete/<?php echo $article->id ?>" method="POST" style="display:inline;">
                                            <button type="submit" class="btn btn-danger p-2" data-toggle="tooltip" onclick="trashEntry()" title="Buang Berita">
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