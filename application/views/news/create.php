<?php
$this->load->view("layouts/wrapper_top.php");
?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4 row">Input Data Berita</h4>
        <form method="POST" action="<?php echo base_url() ?>author/news/store" class="forms-sample" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="status">Buat Sebagai</label>
                <select class="form-control" name="status" id="status" required>
                    <option disabled selected>Pilih salah satu</option>
                    <option value="1">Publikasi</option>
                    <option value="2">Draft</option>
                </select>
            </div>
            <div class="form-group row">
                <label>Kategori Berita</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option disabled selected>Pilih salah satu</option>
                    <?php
                    foreach ($categories as $category) {
                        ?>
                        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="title">Judul Berita</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="contoh: Menghebohkan!" required>
            </div>
            <div class="form-group row mb-0">
                <label for="content">Konten Berita</label>
            </div>
            <div class="form-group row">
                <textarea name="content" id="content" class="form-control" rows="30"></textarea>
            </div>
            <div class="form-group">
                <p class="row">Unggah Gambar</p>
                <div class="col">
                    <img id="preview" height="150px" src="<?php echo base_url() ?>storage/news/nopic.jpg">
                </div>
            </div>
            <div class="form-group row">
                <div class="input-group col-xs-6">
                    <input type="file" accept="image/*" name="image" onchange="readURL(this);" required>
                </div>
                <small class="mt-2">Max size 10MB</small>
            </div>
            <button type="submit" class="btn btn-gradient mr-2 mt-4">Simpan</button>
            <a href="<?php echo base_url() ?>author/news/index/" class="btn btn-light mt-4">
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