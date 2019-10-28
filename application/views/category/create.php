<?php
$this->load->view("layouts/wrapper_top.php");
?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4 row">Input Data Kategori</h4>
        <form method="POST" action="<?php echo base_url() ?>author/category/store" class="forms-sample">
            <div class="form-group row">
                <label for="name">Jenis Kategori</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="contoh: Politik" required>
            </div>
            <button type="submit" class="btn btn-gradient mr-2 mt-4">Simpan</button>
            <a href="<?php echo base_url() ?>author/category/index/" class="btn btn-light mt-4">
                Batal
            </a>
        </form>
    </div>
</div>

<?php
$this->load->view("layouts/wrapper_bottom.php");
?>