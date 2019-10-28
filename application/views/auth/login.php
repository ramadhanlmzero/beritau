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
                        <div class="row">
                            <div class="col-lg-12 mx-auto bg-white">
                                <div class="auth-form-light text-left p-5">
                                    <h2>Masuk</h2>
                                    <h4 class="font-weight-light">Selamat datang di Beritau</h4>
                                    <form class="pt-5" action="<?php echo base_url() ?>auth/auth" method="POST">
                                        <?php
                                        if ($this->session->flashdata('msg')) {
                                            ?>
                                            <div class="alert alert-danger">
                                                <span><?php echo $this->session->flashdata('msg') ?></span>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" data-toggle="password" required>
                                        </div>
                                        <div class="mt-5">
                                            <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium">Masuk</button>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col text-right">
                                                <a href="<?php echo base_url() ?>">Beranda</a>
                                            </div>
                                            <div class="col text-center">
                                                <a href="<?php echo base_url() ?>auth/register/Penulis">Jadi Penulis</a>
                                            </div>
                                            <div class="col">
                                                <a href="<?php echo base_url() ?>auth/register/Pembaca">Jadi Pembaca</a>
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

<?php
$this->load->view("layouts/foot.php");
?>