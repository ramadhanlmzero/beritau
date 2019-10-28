<?php
$this->load->helper("url");
?>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo base_url() ?>dashboard/index"><img src="<?php echo base_url() ?>assets/images/logo.png" alt="logo" /></a>
        <button class="navbar-toggler d-lg-none align-self-center" type="button">
            <span class="icon-menu"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <?php if ($this->session->userdata('role') == "Admin") { ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown d-none d-lg-flex">
                    <a href="<?php echo base_url() ?>author/news/create" class="nav-link nav-btn">
                        <span class="btn">+ Tulis Berita</span>
                    </a>
                </li>
            </ul>
        <?php } ?>
        <ul class="navbar-nav navbar-nav-right d-none d-sm-block">
            <li class="nav-item dropdown d-none d-lg-flex">
                <a class="nav-link dropdown-toggle" id="menuDropdown" data-toggle="dropdown" aria-expanded="false">
                    <?php echo $this->session->userdata('name') ?>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="menuDropdown">
                    <a class="dropdown-item font-weight-medium" href="<?php echo base_url() ?>">
                        <i class="icon-notebook pr-2"></i>
                        Lihat Berita
                    </a>
                    <a class="dropdown-item font-weight-medium" href="<?php echo base_url() ?>author/user/edit/<?php echo $this->session->userdata('id') ?>">
                        <i class="icon-user pr-2"></i>
                        Perbarui Profil
                    </a>
                    <a class="dropdown-item font-weight-medium" href="<?php echo base_url() ?>auth/logout">
                        <i class="icon-logout pr-2"></i>
                        Keluar
                    </a>
                </div>
            </li>
        </ul>
        <a href="{ name:'account_index' }" class="navbar-toggler navbar-toggler-right d-lg-none align-self-center">
            <span class="icon-wrench"></span>
        </a>
    </div>
</nav>