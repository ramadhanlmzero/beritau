<?php
$this->load->view("layouts/wrapper_top.php");
?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4 row">Input Data User</h4>
        <form method="POST" action="<?php echo base_url() ?>author/user/store" class="forms-sample" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="contoh: Ramadhan" required>
            </div>
            <div class="form-group row">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="contoh: rama@gmail.com" required>
            </div>
            <div class="form-group row">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="contoh: incorrect" required>
            </div>
            <div class="form-group row">
                <label for="role">Hak Akses</label>
                <select class="form-control" name="role" id="role" required>
                    <option disabled selected>Pilih salah satu</option>
                    <option value="Penulis">Penulis</option>
                    <option value="Pembaca">Pembaca</option>
                </select>
            </div>
            <div class="form-group">
                <p class="row">Unggah Foto</p>
                <div class="col">
                    <img id="preview" height="150px" src="<?php echo base_url() ?>storage/user/nopic.jpg">
                </div>
            </div>
            <div class="form-group row">
                <div class="input-group col-xs-6">
                    <input type="file" accept="image/*" name="photo" onchange="readURL(this);" required>
                </div>
                <small class="mt-2">Max size 10MB</small>
            </div>
            <button type="submit" class="btn btn-gradient mr-2 mt-4">Simpan</button>
            <a href="<?php echo base_url() ?>author/user/index/" class="btn btn-light mt-4">
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

<?php
$this->load->view("layouts/wrapper_bottom.php");
?>