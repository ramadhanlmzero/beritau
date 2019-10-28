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
<script>
    $(document).ready(function() {
        $("#userTable").DataTable({
            "oLanguage": {
                "sLengthMenu": "Tampilkan _MENU_ user",
                "sZeroRecords": "Belum ada user apapun",
                "sInfoEmpty": "Menampilkan 0 data",
                "sInfoFiltered": "",
                "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ user",
                "sSearch": "Cari: ",
                "oPaginate": {
                    "sNext": "Selanjutnya",
                    "sPrevious": "Sebelumnya",
                }
            },
            stateSave: true
        })
        $("#categoryTable").DataTable({
            "oLanguage": {
                "sLengthMenu": "Tampilkan _MENU_ kategori",
                "sZeroRecords": "Belum ada kategori apapun",
                "sInfoEmpty": "Menampilkan 0 data",
                "sInfoFiltered": "",
                "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ kategori",
                "sSearch": "Cari: ",
                "oPaginate": {
                    "sNext": "Selanjutnya",
                    "sPrevious": "Sebelumnya",
                }
            },
            stateSave: true
        })
        $("#newsTable").DataTable({
            "oLanguage": {
                "sLengthMenu": "Tampilkan _MENU_ berita",
                "sZeroRecords": "Belum ada berita apapun",
                "sInfoEmpty": "Menampilkan 0 data",
                "sInfoFiltered": "",
                "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ berita",
                "sSearch": "Cari: ",
                "oPaginate": {
                    "sNext": "Selanjutnya",
                    "sPrevious": "Sebelumnya",
                }
            },
            stateSave: true
        })
    })
</script>

<script>
    function deleteEntry() {
        event.preventDefault();
        var form = event.target.form;
        swal("Yakin ingin menghapusnya?", {
            buttons: {
                cancel: "Tidak Jadi",
                catch: {
                    text: "Ya, Hapus",
                    value: "delete",
                },
            },
            icon: "warning",
            dangerMode: true,
        }).then((value) => {
            switch (value) {
                case "delete":
                    swal("Sukses!", "Data berhasil dihapus!", "success", {
                        button: false,
                    });
                    form.submit();
                    break;
            }
        });
    }
    function trashEntry() {
        event.preventDefault();
        var form = event.target.form;
        swal("Yakin ingin membuangnya ke sampah berita?", {
            buttons: {
                cancel: "Tidak Jadi",
                catch: {
                    text: "Ya, Buang",
                    value: "delete",
                },
            },
            icon: "warning",
            dangerMode: true,
        }).then((value) => {
            switch (value) {
                case "delete":
                    swal("Sukses!", "Data berhasil dibuang! Periksa Sampah Berita!", "success", {
                        button: false,
                    });
                    form.submit();
                    break;
            }
        });
    }
    function restoreEntry() {
        event.preventDefault();
        var form = event.target.form;
        swal("Yakin ingin memulihkannya?", {
            buttons: {
                cancel: "Tidak Jadi",
                catch: {
                    text: "Ya, Pulihkan",
                    value: "delete",
                },
            },
            icon: "warning",
            dangerMode: true,
        }).then((value) => {
            switch (value) {
                case "delete":
                    swal("Sukses!", "Data berhasil dipulihkan!", "success", {
                        button: false,
                    });
                    form.submit();
                    break;
            }
        });
    }
</script>
</body>

</html>