<?php
$this->load->view("layouts/head.php");
setlocale(LC_TIME, 'IND');
?>

<div class="container-scroller">
    <?php
    $this->load->view("layouts/navbar.php")
    ?>
    <div class="container-fluid page-body-wrapper">
        <div class="row row-offcanvas row-offcanvas-left">
            <?php
            $this->load->view("layouts/sidebar.php")
            ?>
            <div class="content-wrapper">