<?php
$this->load->view("layouts/wrapper_top.php");
?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4 row">Edit Berita <?php echo $news->title ?></h4>
        <form method="POST" action="<?php echo base_url() ?>author/news/update/<?php echo $news->id ?>" class="forms-sample" enctype="multipart/form-data">
            <input type="hidden" name="filename" value="<?php echo $news->image ?>">
            <div class="form-group row">
                <label for="status">Buat Sebagai</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="<?php echo $news->status ?>" selected>
                        <?php if ($news->status == 1) { ?>
                            Publikasi
                        <?php }
                        if ($news->status == 2) { ?>
                            Draft
                        <?php } ?>
                    </option>
                    <?php if ($news->status != 1) { ?>
                        <option value="1">Publikasi</option>
                    <?php }
                    if ($news->status != 2) { ?>
                        <option value="2">Draft</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group row">
                <label>Kategori Berita</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="<?php echo $news->category_id ?>" selected><?php echo $news->category ?></option>
                    <?php
                    foreach ($categories as $category) {
                        if ($category->id != $news->category_id) {
                            ?>
                        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="title">Judul Berita</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $news->title ?>" placeholder="contoh: Menghebohkan!" required>
            </div>
            <div class="form-group row mb-0">
                <label for="content">Konten Berita</label>
            </div>
            <div class="form-group row">
                <textarea name="content" id="content" class="form-control" rows="30"><?php echo $news->content ?></textarea>
            </div>
            <div class="form-group">
                <p class="row">Unggah Gambar</p>
                <div class="col">
                    <img id="preview" height="150px" src="<?php echo base_url() ?>storage/news/<?php echo $news->image ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="input-group col-xs-6">
                    <input type="file" accept="image/*" name="image" onchange="readURL(this);">
                </div>
                <small class="mt-2">Max size 10MB</small>
            </div>
            <button type="submit" class="btn btn-gradient mr-2 mt-4">Simpan</button>
            <a href="<?php echo base_url() ?>author/news/index" class="btn btn-light mt-4">
                Batal
            </a>
        </form>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                jQuery('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea'
    });
</script>

<?php
$this->load->view("layouts/wrapper_bottom.php");
?>