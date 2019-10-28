<?php
$this->load->view("layouts/wrapper_top.php");
$this->load->helper("url");

use Carbon\Carbon;
?>

<div class="tombol">
    <a href="<?php echo base_url() ?>author/news/index" class="btn btn-gradient btn-fw">
        Kembali
    </a>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Sampah Berita</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="newsTable" class="table">
                        <thead>
                            <tr>
                                <th width="50px">No.</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Terakhir Dibuat</th>
                                <th>Terakhir Dibuang</th>
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
                                    <td><?php str($article->name) ?></td>
                                    <td><?php str(Carbon::parse($article->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y %H:%I:%S')) ?></td>
                                    <td><?php str(Carbon::parse($article->updated_at, 'Asia/Jakarta')->locale('ID')->diffForHumans()) ?></td>
                                    <td>
                                        <form action="<?php echo base_url() ?>author/news/restore/<?php echo $article->id ?>" method="POST" style="display:inline;">
                                            <button type="submit" class="btn btn-success mr-2 p-2" data-toggle="tooltip" onclick="restoreEntry()" title="Pulihkan Berita">
                                                <i class="fa fa-undo"></i>
                                            </button>
                                        </form>
                                        <form action="<?php echo base_url() ?>author/news/delete/<?php echo $article->id ?>" method="POST" style="display:inline;">
                                            <button type="submit" class="btn btn-danger p-2" data-toggle="tooltip" onclick="deleteEntry()" title="Hapus Berita">
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