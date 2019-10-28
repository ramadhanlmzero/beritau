<?php
$this->load->view("layouts/head.php");
$this->load->helper("url");
?>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
        <div class="row">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-6 mx-auto">
                        <div class="row mx-auto">
                            <div class="col-lg-12 bg-white">
                                <div class="auth-form-light text-left p-5">
                                    <h2>Jadilah <?php echo $role ?>!</h2>
                                    <h4 class="font-weight-light">Selamat datang di Beritau</h4>
                                    <form class="pt-5" action="<?php echo base_url() ?>auth/store" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="name">Masukkan Nama</label>
                                            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Nama Lengkap" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Masukkan Email</label>
                                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="password">Masukkan Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Unggah Foto</label>
                                            <div class="col mt-3">
                                                <img id="preview" height="150px" src="<?php echo base_url() ?>storage/user/nopic.jpg">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="input-group col-xs-6">
                                                <input type="file" accept="image/*" name="photo" class="form-control" onchange="readURL(this);" required>
                                            </div>
                                            <small class="mt-2">Max size 10MB</small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="role">Gabung Sebagai</label>
                                            <input type="text" name="role" class="form-control" value="<?php echo $role ?>" id="role" readonly required>
                                        </div>
                                        <div class="mt-5">
                                            <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium">Gabung</button>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col text-right">
                                                <a href="<?php echo base_url() ?>">Beranda</a>
                                            </div>
                                            <div class="col">
                                                <a href="<?php echo base_url() ?>auth/login">Masuk</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .auth form .form-group i {
        top: calc(53%);
    }
</style>

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
$this->load->view("layouts/foot.php");
?>