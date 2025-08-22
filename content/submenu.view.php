<?php
include 'component/header.view.php';
include 'component/pengaturantampilan.view.php';
?>
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
                    <h5 class="page-title fs-21 mb-1">Sub Menu List</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Menu Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input SubMenu</li>
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
                                <table class="table card-table table-vcenter text-nowrap mb-0" id="mytablesubmenu">
                                    <thead>
                                        <tr>

                                            <th><span>No</span></th>
                                            <th><span>judul menu</span></th>
                                            <th><span>Judul sub Menu</span></th>
                                            <th><span>Link</span></th>
                                            <th><span>Urutan</span></th>
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


    <div class="modal fade" id="modaldemo8insert">
        <form method="post" id="form_inputsubmenu">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Form Input Menu</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="input-group">
                            <select class="form-control" class="form-select rounded-pill" aria-label="Default select example" name="menujudul" id="menujudul">
                                <?php
                                // include '../../lib/conn.php';
                                $menu = mysqli_query($koneksi, "SELECT * from menu");
                                while ($fetch = mysqli_fetch_array($menu)) {
                                    echo '<option value="' . $fetch['id'] . '">' . $fetch['judul'] . '</option>';
                                }
                                ?>
                            </select>
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Judul Sub Menu" name="submenujudul" id="submenujudul">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Isi Link" name="link" id="link">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Isi Urutan Menu" name="urutan" id="urutan">
                        </div>


                        <!-- //MESSAGE -->

                        <div class="alert custom-alert1 alert-secondary" id="error">
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
                            <div class="text-center px-5 pb-0">
                                <svg class="custom-alert-icon svg-secondary" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                                <h5>Confirmed</h5>
                                <p class="">This alert is created to just show the confirmation message.</p>
                                <div class="">
                                    <button class="btn btn-sm btn-secondary m-1">Close</button>
                                </div>
                            </div>
                        </div>
                        <!-- ENDMESSAGE -->


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="simpan">
                            Simpan
                        </button>
                        <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal" >Close</button> -->
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="modal fade" id="modaldemo8edit">
        <form method="post" id="editForm">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Form edit subMenu</h6>
                        <!-- <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button> -->
                    </div>
                    <div class="modal-body text-start">
                        <input type="hidden" class="form-control " id="id" name="id">
                        <div class="input-group">
                            <select class="form-control" class="form-select rounded-pill" aria-label="Default select example" name="menujudul" id="menujudul">
                                <?php
                                // include '../../lib/conn.php';
                                $menu = mysqli_query($koneksi, "SELECT * from menu");
                                while ($fetch = mysqli_fetch_array($menu)) {
                                    echo '<option value="' . $fetch['id'] . '">' . $fetch['judul'] . '</option>';
                                }
                                ?>
                            </select>
                        </div><br>
                        <div class="input-group">

                            <input type="text" class="form-control " name="submenujudul" id="submenujudul">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " name="link" id="link">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " name="urutan" id="urutan">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="update">
                            Update
                        </button>
                        <!-- <button class="btn btn-light" data-bs-dismiss="modal" >Close</button> -->
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php
    include 'component/footer.view.php';
    ?>



    <script>
        $(document).ready(function() {
            fetchData();
            kosong();

            let table = new DataTable("#mytablesubmenu");

            // function to fetch data from database
            function fetchData() {
                $.ajax({
                    url: "proses/menu/executesubmenu.php?action=fetchData",
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
                                    value.id_menu,
                                    value.judul,
                                    value.link,
                                    value.urutan,
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
                $("#menujudul").val('');
                $("#submenujudul").val('');
                $("#link").val('');
                $("#urutan").val('');
                $("#error").hide();
            }
            $("#tambah").on("click", function() {
                kosong();
            })
            // function to insert data to database
            $("#form_inputsubmenu").on("submit", function(e) {
                // $("#insertBtn").attr("disabled", "disabled");
                e.preventDefault();
                $.ajax({
                    url: "proses/menu/executesubmenu.php?action=insertData",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.statusCode == 200) {
                            alert('Data Sukses tersimpan');
                            // $('#modaldemo8insert').fadeOut("close");
                            // window.location.replace("/admin/inputmenu");
                            fetchData();
                            kosong();
                        } else if (response.statusCode == 500) {
                            $("#offcanvasAddUser").offcanvas("hide");
                            $("#simpan").removeAttr("disabled");
                            $("#insertForm")[0].reset();
                            Swal.fire("!", "Data Erro Disimpan", "Warning");
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
            $("#mytablesubmenu").on("click", ".editBtn", function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url: "proses/menu/executesubmenu.php?action=fetchSingle",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var data = response.data;

                        $(" #modaldemo8edit #editForm #id").val(data.id);
                        $("#modaldemo8edit #editForm select[name='menujudul']").val(data.id_menu);
                        $("#modaldemo8edit #editForm input[name='submenujudul']").val(data.judul);
                        $("#modaldemo8edit #editForm input[name='link']").val(data.link);
                        $("#modaldemo8edit #editForm input[name='urutan']").val(data.urutan);

                        $("#modaldemo8edit").modal("show");

                    }
                });
            });

            // function to update data in database
            $("#editForm").on("submit", function(e) {
                // $("#editBtn").attr("disabled");
                e.preventDefault();
                $.ajax({
                    url: "proses/menu/executesubmenu.php?action=updateData",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.statusCode == 200) {
                            alert('Data Sukses terupdate')
                            // Swal.fire("!", "Data Sukses Terupdate", "success");
                            fetchData();
                            kosong();
                            // $("#offcanvasEditUser").modal("hide");
                        } else if (response.statusCode == 500) {
                            alert('Failed to update data');
                            kosong();
                        } else if (response.statusCode == 400) {
                            alert('isi Yang Kosong');
                        }
                    }
                });
            });

            // function to delete data
            $("#mytablesubmenu").on("click", ".deleteBtn", function() {
                if (confirm("Apakah yakin Menghapus Data Ini?")) {
                    var id = $(this).val();
                    //   var delete_image = $(this).closest("td").find(".delete_image").val();
                    $.ajax({
                        url: "proses/menu/executesubmenu.php?action=deleteData",
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