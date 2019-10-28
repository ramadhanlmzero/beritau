<?php
$this->load->helper('url');
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="<?php echo base_url() ?>storage/user/<?php echo $this->session->userdata('photo') ?>" alt="image" />
                </div>
                <div class="profile-name">
                    <p class="name">
                        <?php echo $this->session->userdata('name') ?>
                    </p>
                    <p class="designation">
                        <?php echo $this->session->userdata('role') ?>
                    </p>
                </div>
            </div>
        </li>
        <?php if ($this->session->userdata('role') != "Pembaca") { ?>
        <li class="nav-item">
            <a href="<?php echo base_url() ?>author/news/index" class="nav-link">
                <i class="icon-notebook menu-icon"></i>
                <span class="menu-title">Data Master Berita</span>
            </a>
        </li>
        <?php } if ($this->session->userdata('role') == "Admin") { ?>
        <li class="nav-item">
            <a href="<?php echo base_url() ?>author/category/index" class="nav-link">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Data Master Kategori</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url() ?>author/user/index" class="nav-link">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">Data Master User</span>
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>