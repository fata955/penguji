<?php
session_start();
include 'component/header.view.php';

include 'component/pengaturantampilan.view.php';

?>

<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<div class="page">
    <?php
    include 'component/header2.view.php';
    ?>
    <!--End modal -->
    <!-- Start::app-sidebar -->
    <aside class="app-sidebar sticky" id="sidebar">

        <!-- Start::main-sidebar-header -->
        <div class="main-sidebar-header">
            <a href="index.html" class="header-logo">
                <img src="assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
                <img src="assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
                <img src="assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-white">
                <img src="assets/images/brand-logos/toggle-white.png" alt="logo" class="toggle-white">
            </a>
        </div>
        <!-- End::main-sidebar-header -->
        <?php
        include 'component/sidebar.view.php';
        ?>

    </aside>
    <!-- End::app-sidebar -->

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Berita List</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Menu Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input Berita</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex my-xl-auto right-content align-items-center">
                    <div class="pe-1 mb-xl-0">
                        <!-- <a href="#modaldemo8insert" id="tambah" class="modal-effect btn btn-primary d-grid mb-3" data-bs-effect="effect-fall" data-bs-toggle="modal">
                            Tambah
                        </a> -->
                        <a class="modal-effect btn btn-primary d-grid mb-3" data-bs-effect="effect-fall" data-bs-toggle="modal" href="#modaldemo8insert" id="tambah">tambah</a>
                        <!-- <button type="button" class="btn btn-info btn-icon me-2 btn-b">
                            <i class="bx bx-file-blank"></i></i>
                         
                        </button> -->
                    </div>

                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                    <div class="card">
                        <!-- <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-0">USERS TABLE</h4>
                                <a href="javascript:void(0);" class="tx-inverse" data-bs-toggle="dropdown"><i
                                        class="mdi mdi-dots-horizontal text-gray"></i></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="javascript:void(0);">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Another
                                        Action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Something Else
                                        Here</a>
                                </div>
                            </div>
                            <p class="fs-12 text-gray-5 mb-2">Example of Valex Simple Table. <a href="">Learn
                                    more</a></p>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive border border-bottom-0 userlist-table">
                                <table class="table card-table table-vcenter text-nowrap mb-0" id="mytablenews">
                                    <thead>
                                        <tr>

                                            <th><span>No</span></th>
                                            <th><span>Judul Berita</span></th>
                                            <!-- <th><span>Isi</span></th> -->
                                            <th><span>User</span></th>
                                            <th><span>Tanggal</span></th>
                                            <th><span>Gambar</span></th>
                                            <th><span>Status</span></th>
                                            <!-- <th><span>tanggal</span></th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <!-- <ul class="pagination mt-4 mb-0 float-end flex-wrap">
                                <li class="page-item page-prev disabled">
                                    <a class="page-link" href="javascript:void(0);" tabindex="-1">Prev</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                                <li class="page-item page-next">
                                    <a class="page-link" href="javascript:void(0);">Next</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                </div><!-- COL END -->
            </div>
            <!--End::row-1 -->


        </div>
    </div>


    <!-- End::app-content -->

    <!-- End::app-content -->
    <div class="modal fade" id="modaldemo8edit">

        <div class="modal-dialog modal-dialog-centered text-center" role="document">

            <div class="modal-content modal-content-demo">
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                <form action="proses/berita/news.php?action=updateData" method="post" id="editForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h6 class="modal-title">Form edit halaman</h6>

                    </div>
                    <div class="modal-body text-start">
                          <input type="hidden" class="form-control " id="id" name="id">
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Judul Berita" name="judul_berita" id="judul_berita">
                        </div><br>
                        <div class="input-group">
                            <textarea class="form-control" name="isihalaman" id="isihalaman"></textarea>
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="" name="user" id="user" hidden>
                        </div><br>
                        <label for="">Tanggal</label><br>
                        <div class="input-group">
                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                        </div><br>
                        <div class="input-group">
                            <img src="" width="300" class="thumbnail" name="filegmbr" id="filegmbr" width="100%" height="100%">

                        </div><br>
                        <label for="">Pilih Gambar</label><br>
                        <div class="input-group">
                            <input type="file" class="form-control form-control-sm" name="filegambar" id="filegambar">
                        </div><br>
                        <label for="">Pilih Status</label><br>
                        <div class="input-group">
                            <select class="form-control" class="form-select rounded-pill" aria-label="Default select example" name="status" id="status">
                                <!-- <option value="0">PILIH STATUS</option> -->
                                <option value="1">AKTIF</option>
                                <option value="2">NON AKTIF</option>

                            </select>
                        </div><br>
                        <div class="input-group">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="update">
                            Update
                        </button>

                    </div>
                </form>
            </div>
        </div>


    </div>


    <div class="modal fade" id="tampilisi">

        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Isi Halaman</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editFormlagi">
                    <div class="modal-body text-start">
                        <div class="input-group">
                            <textarea class="form-control" name="halamanisi" id="halamanisi" rows="100" disabled></textarea>
                        </div><br>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <?php
    include 'component/footer.view.php';
    ?>


    <script src="/admin/assets/ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function() {

            $('#modaldemo8insert').on('shown.bs.modal', function() {
                CKEDITOR.replace('isi', {
                    filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl: 'assets/ckfinder/ckfinder.html?Type=Images',
                    filebrowserFlashBrowseUrl: 'assets/ckfinder/ckfinder.html?Type=Flash',
                    filebrowserUploadUrl: 'assets/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl: 'assets/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl: 'assets/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Flash'
                });



            });
            $('#modaldemo8edit').on('shown.bs.modal', function() {
                CKEDITOR.replace('isihalaman', {
                    filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl: 'assets/ckfinder/ckfinder.html?Type=Images',
                    filebrowserFlashBrowseUrl: 'assets/ckfinder/ckfinder.html?Type=Flash',
                    filebrowserUploadUrl: 'assets/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl: 'assets/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl: 'assets/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Flash'
                });



            });

            fetchData();
            kosong();

            let table = new DataTable("#mytablenews");

            // function to fetch data from database
            function fetchData() {

                $.ajax({
                    url: "proses/berita/news.php?action=fetchData",
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        var data = response.data;
                        table.clear().draw();
                        var counter = 1;
                        $.each(data, function(index, value) {
                            table.row
                                .add([
                                    counter,
                                    value.judul_berita,
                                    // value.isi,
                                    value.user,
                                    value.tanggal,
                                    '<img src="imageberita/' + value.gambar + '" alt="img" width="100" height="100">',
                                    value.status,
                                    // value.urutan,
                                    '<button type="button" data-bs-effect="effect-fall" data-bs-toggle="modal" href="#tampilisi" class="btn btn-sm btn-success btn-b liat"  value="' +
                                    value.id +
                                    '"><i class="las la-eye"></i></button>' +
                                    '<button type="button" data-bs-effect="effect-fall" data-bs-toggle="modal" href="#modaldemo8edit" class="btn btn-sm btn-info btn-b  editBtn" value="' +
                                    value.id +
                                    '"><i class="las la-pen"></i></button>' +
                                    '<Button type="button" class="btn btn-sm btn-danger deleteBtn" value="' +
                                    value.id +
                                    '"><i class="las la-trash"></i></Button>'
                                ])

                                .draw(false);
                            counter++;
                        });
                    }
                });
            }

            function kosong() {
                $("#judul_berita").val('');
                $("#filegambar").val('');
                // $("#isi").val('');
                $("#user").val('');
                $("#status").val('');
                $("#tanggal").val('');
                // $("#urutan").val('');
                $("#error").hide();
            }
            $("#tambah").on("click", function() {
                $('#modaldemo8insert').on('shown.bs.modal', function() {
                    CKEDITOR.replace('isi', {
                        filebrowserBrowserUrl: '../../assets/ckfinder/ckfinder.html',
                        filebrowserBrowserUrl: '../../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                    });
                });
            })
            // function to insert data to database
            $("#form_inputnews").on("submit", function(e) {
                var isi = $('textarea#isi').value();
                // var isi = $("#isi").val('');
                window.location.replace("/berita");
                // console.log(isi);
                e.preventDefault();
                $.ajax({
                    url: "proses/berita/news.php?action=insertData",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: true,
                    processData: false,
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.statusCode == 200) {
                            // alert('Data Sukses tersimpan');
                            // $('#modaldemo8insert').fadeOut("close");
                            // window.location.replace("/admin/inputmenu");
                            fetchData();
                            kosong();
                        } else if (response.statusCode == 500) {
                            alert('Data Harus jpg,png dan jpeg');
                            fetchData();
                            //   $(".preview_img").attr("src", "images/default_profile.jpg");
                            // $("#errorToast").toast("show");
                            // $("#errorMsg").html(response.message);
                        } else if (response.statusCode == 400) {
                            $("#simpan").removeAttr("disabled");
                            Swal.fire("!", "Data Masih Kosong", "Warning");
                            // $("#errorToast").toast("show");
                            // $("#errorMsg").html(response.message);
                        } else if (response.statusCode == 800) {
                            $("#error").show();
                            alert('Data Sudah Ada yang sama')
                            // window.location.replace("/admin/inputmenu");
                            fetchData();

                            // $("#simpan").removeAttr("disabled");
                            // Swal.fire("!", "Data Masih Kosong", "Warning");
                            // $("#errorToast").toast("show");
                            kosong();
                            // $("#errorMsg").html(response.message);
                        }

                    }
                });
            });

            // function to edit data
            $("#mytablenews").on("click", ".editBtn", function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url: "proses/berita/news.php?action=fetchSingle",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var data = response.data;

                        $("#modaldemo8edit #editForm #id").val(data.id);
                        $("#modaldemo8edit #editForm input[name='judul_berita']").val(data.judul_berita);
                        $("#modaldemo8edit #editForm textarea[name='isihalaman']").val(data.isi);
                        $("#modaldemo8edit #editForm input[name='tanggal']").val(data.tanggal);
                        $("#modaldemo8edit #editForm img[name='filegmbr']").attr("src", 'imageberita/' + data.gambar);
                        $("#modaldemo8edit #editForm select[name='status']").val(data.status);
                        $("#modaldemo8edit").modal("show");

                    }
                });
            });
            
            $("#mytablenews").on("click", ".liat", function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url: "proses/berita/news.php?action=fetchIsi",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var data = response.data;

                        $("#tampilisi #editFormlagi textarea[name='halamanisi']").val(data.isihalaman);

                        $("#tampilisi").modal("show");

                    }
                });
            });


            // function to update data in database
            $("#editForm").on("submit", function(e) {
                 var isi = $('textarea#isihalaman').value();
                // var isi = $("#isi").val('');
                window.location.replace("/admin/berita");
                // $("#editBtn").attr("disabled");
                e.preventDefault();
                $.ajax({
                    url: "proses/berita/news.php?action=updateData",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.statusCode == 200) {
                            // alert('Data Sukses terupdate')
                            // Swal.fire("!", "Data Sukses Terupdate", "success");
                            fetchData();
                            kosong();
                            // $("#offcanvasEditUser").modal("hide");
                        } else if (response.statusCode == 500) {
                            alert('File Yang Dimasukan Harus JPG atau PNG');
                            kosong();
                        } else if (response.statusCode == 400) {
                            alert('isi Yang Kosong');
                        }
                    }
                });
            });

            // function to delete data
            $("#mytablenews").on("click", ".deleteBtn", function() {
                if (confirm("Apakah yakin Menghapus Data Ini?")) {
                    var id = $(this).val();
                    //   var delete_image = $(this).closest("td").find(".delete_image").val();
                    $.ajax({
                        url: "proses/berita/news.php?action=deleteData",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id
                            //   delete_image
                        },
                        success: function(response) {
                            if (response.statusCode == 200) {
                                alert('Data Sukses Terhapus')
                                fetchData();

                            } else if (response.statusCode == 500) {
                                alert('Penghapusan data error, Jaringan Anda');
                            }
                        }
                    });
                }
            });
        });
    </script>


    <div class="modal fade" id="modaldemo8insert" tabindex="-1" role="dialog">

        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <form action="proses/berita/news.php?action=insertData" method="POST" id="form_inputnews" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h6 class="modal-title">Form Input Berita</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Judul Berita" name="judul_berita" id="judul_berita">
                        </div><br>
                        <div class="input-group">
                            <textarea class="form-control" name="isi" id="isi"></textarea>
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Judul Berita" name="user" id="user" hidden>
                        </div><br>
                        <label for="">Tanggal</label><br>
                        <div class="input-group">
                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                        </div><br>
                        <label for="">Pilih Gambar</label><br>
                        <div class="input-group">
                            <input type="file" class="form-control form-control-sm" name="filegambar" id="filegambar">
                        </div><br>
                        <label for="">Pilih Status</label><br>
                        <div class="input-group">
                            <select class="form-control" class="form-select rounded-pill" aria-label="Default select example" name="status" id="status">
                                <!-- <option value="0">PILIH STATUS</option> -->
                                <option value="1">AKTIF</option>
                                <option value="2">NON AKTIF</option>

                            </select>
                        </div><br>
                        <div class="input-group">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="simpan">
                            Simpan
                        </button>

                    </div>
                </form>
            </div>
        </div>

    </div>