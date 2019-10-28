<?php

use Carbon\Carbon;

setlocale(LC_TIME, 'IND');

$this->load->model("News_model");

// Berdasarkan Refresh
$data = ['visitor_count' => $news->visitor_count + 1];
$this->News_model->update($data, $news->id);

// Berdasarkan IP Address
// if(!$this->session->userdata('ip'))
// {
//     $visitor = ['ip' => $_SERVER['REMOTE_ADDR']];
//     $this->session->set_userdata($visitor);
//     $data = ['visitor_count' => $news->visitor_count+1];
//     $this->News_model->update($data, $news->id);
// }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Beritau - Situs Berita Serba Tau</title>
    <?php
    $this->load->helper('style');
    style(base_url() . "assets/css/jquery.css");
    style(base_url() . "assets/css/simple-line-icons.css");
    style(base_url() . "assets/css/materialdesignicons.min.css");
    style(base_url() . "assets/css/font-awesome.min.css");
    style(base_url() . "assets/css/fontawesome-stars.css");
    style(base_url() . "assets/css/dataTables.bootstrap4.min.css");
    style(base_url() . "assets/css/style.css");
    ?>

    <style>
        .landing-page .navbar {
            padding: 10px;
        }

        .page-description-2 {
            line-height: 1.5em;
            height: 3em;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-scroller landing-page">
        <div class="container-fluid top-banner">
            <nav class="navbar navbar-expand-lg bg-transparent">
                <div class="row flex-grow">
                    <div class="col-md-8 d-lg-flex flex-row mx-auto">
                        <a class="navbar-brand" href="<?php echo base_url() ?>">
                            <img src="<?php echo base_url() ?>assets/images/logo.png" alt="logo" />
                        </a>
                        <button class="navbar-toggler collapsed float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon ti ti-menu text-white"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-link" href="<?php echo base_url() ?>">BERANDA</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <?php if ($this->session->userdata('logged_in') == TRUE) {
                                        if ($this->session->userdata('role') == "Penulis" || $this->session->userdata('role') == "Admin") {
                                            ?>
                                            <a class="nav-link btn btn-link" href="<?php echo base_url() ?>author/user/index"><?php echo $this->session->userdata('name') ?></a>
                                        <?php
                                            }
                                            if ($this->session->userdata('role') == "Pembaca") {
                                                ?>
                                            <a class="nav-link btn btn-link dropdown-toggle" id="menuDropdown" data-toggle="dropdown" aria-expanded="false"><?php echo $this->session->userdata('name') ?></a>
                                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="menuDropdown">
                                                <a class="dropdown-item font-weight-medium" href="<?php echo base_url() ?>author/user/edit/<?php echo $this->session->userdata('id') ?>">
                                                    <i class="icon-user pr-2"></i>
                                                    Perbarui Profil
                                                </a>
                                                <a class="dropdown-item font-weight-medium" href="<?php echo base_url() ?>auth/logout">
                                                    <i class="icon-logout pr-2"></i>
                                                    Keluar
                                                </a>
                                            </div>
                                        <?php }
                                        } else { ?>
                                        <a class="nav-link btn btn-link" href="<?php echo base_url() ?>auth/login">MASUK</a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container-fluid middle-section bg-white">
            <div class="row mb-5">
                <div class="col-md-8 mx-auto">
                    <div class="text-left">
                        <div class="pt-4">
                            <p class="d-block h1 mb-0"><?php str($news->title) ?></p>
                            <p class="page-url mt-1">
                                <i class="fa fa-calendar mr-1"></i>
                                <?php str(Carbon::parse($news->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y')) ?>
                                <i class="fa fa-pencil ml-3 mr-1"></i>
                                <?php str($news->name) ?>
                                <i class="fa fa-eye ml-3 mr-1"></i>
                                Dilihat <?php str($news->visitor_count) ?> kali
                                <i class="fa fa-tag ml-3 mr-1"></i>
                                <?php str($news->category);
                                if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('role') == "Admin") { ?>
                                    <a href="<?php echo base_url() ?>author/news/edit/<?php echo $news->id ?>" class="btn btn-primary pull-right p-2" data-toggle="tooltip" title="Ubah Berita">
                                        <i class="fa fa-pencil"></i>
                                        Sunting Berita
                                    </a>
                                <?php } ?>
                            </p>
                            <div class="text-center mb-4">
                                <img src="<?php echo base_url() ?>storage/news/<?php echo $news->image ?>" height="300" alt="image" />
                            </div>
                            <div class="page-description mt-1"><?php echo $news->content ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-8 mx-auto">
                    <p class="d-block h1 mb-0">Berita Terkait</p>
                    <?php
                    if ($relatednews) {
                        foreach ($relatednews as $article) {
                            ?>
                            <div class="pt-4 border-bottom text-left">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <img src="<?php echo base_url() ?>storage/news/<?php echo $article->image ?>" width="200" height="110" alt="image" />
                                    </div>
                                    <div class="col-xl">
                                        <a class="d-block h4 mb-0" href="<?php echo base_url() ?>artikel/detail/<?php echo $article->slug ?>"><?php str($article->title) ?></a>
                                        <p class="page-url mt-1">
                                            <i class="fa fa-calendar mr-1"></i>
                                            <?php str(Carbon::parse($article->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y')) ?>
                                        </p>
                                        <div class="page-description-2 mt-1 w-75 text-muted"><?php echo $article->content ?></div>
                                        <a href="<?php echo base_url() ?>artikel/detail/<?php echo $article->slug ?>" class="btn btn-primary btn-lg my-4 py-2 mr-2">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    else
                    {
                        echo "<p class='mt-4'>Tidak ada berita terkait.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <footer class="container-fluid footer">
            <div class="row pb-5 text-white footer-top">
                <div class="col-md-8 mx-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo base_url() ?>assets/images/logo.png" alt="logo" class="brand-logo" />
                            <div class="d-flex flex-row footer-social-icons">
                                <i class="fa fa-facebook bg-facebook"></i>
                                <i class="fa fa-google bg-google"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row contact-details">
                                <div class="col-12 d-flex mb-3">
                                    <i class="ti-mobile mr-4"></i>
                                    <h6 class="font-weight-normal">(0838) 3181 1803</h6>
                                </div>
                                <div class="col-12 d-flex mb-3">
                                    <i class="ti-settings mr-4"></i>
                                    <h6 class="font-weight-normal">muhamadramadhan@gmail.com</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6>Newsletter</h6>
                            <p>To get the latest news from us please
                                subscribe your email.</p>
                            <div class="mt-3">
                                <input type="email" class="form-control" placeholder="Enter your email" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-4 footer-bottom">
                <div class="col-md-8 mx-auto">
                    <div class="container-fluid clearfix">
                        <span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="<?php echo base_url() ?>">Muhamad Ramadhan</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </div>
            </div>
        </footer>
        <?php

        $this->load->helper('script');

        script(base_url() . "assets/js/jquery.js");
        script(base_url() . "assets/js/jquery.barrating.min.js");
        script(base_url() . "assets/js/raphael.min.js");
        script(base_url() . "assets/js/morris.min.js");
        script(base_url() . "assets/js/jquery.sparkline.min.js");
        script(base_url() . "assets/js/dashboard.js");
        script(base_url() . "assets/js/bootstrap-show-password.min.js");
        script(base_url() . "assets/js/datatables.min.js");
        script("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
        ?>
</body>