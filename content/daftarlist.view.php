<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: /login");
  exit();
}
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
                    <h5 class="page-title fs-21 mb-1">Penguji List</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Menu Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input Menu</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex my-xl-auto right-content align-items-center">
                    <div class="pe-1 mb-xl-0">
                        <!-- <a href="#modaldemo8insert" id="tambah" class="modal-effect btn btn-primary d-grid mb-3" data-bs-effect="effect-fall" data-bs-toggle="modal">
                            Tambah
                        </a> -->
                        <!-- <input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fa fa-search d-none d-md-block"></i></button> -->
                        <!-- <a class="modal-effect btn btn-primary d-grid mb-3" data-bs-effect="effect-fall" data-bs-toggle="modal" href="#modaldemo8insert" id="tambah">tambah</a> -->
                        <a href="">
                            <div class="drop-down-profile" data-bs-toggle="dropdown"><img alt=""
                                    class="rounded-circle avatar avatar-lg" src="../assets/images/faces/1.png"><span
                                    class="assigned-task bg-purple">9</span>
                                <!-- <a href="product-cart.html" class="adtocart"> <i class="las la-shopping-cart "></i> -->
                                <!-- </a> -->
                            </div>
                        </a>

                        <!-- <button type="button" class="btn btn-info btn-icon me-2 btn-b">
                            <i class="bx bx-file-blank"></i></i>
                         
                        </button> -->
                    </div>

                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="row">
                <div class="col-xl-9 col-md-12">
                    <!-- <form action="proses/sp2d/page.php?action=fetchSingle" method="post"> -->
                    <div class="card mb-4">
                        <form action="" method="post">
                            <div class="card-body d-flex p-3 align-items-center">

                                <input class="form-control" placeholder="Cari Nomor SPM, Keterangan, nilai"
                                    type="search"> <button type="submit" class="btn"><i
                                        class="fa fa-search d-none d-md-block"></i></button>


                            </div>
                        </form>
                    </div>
                    <div class="row row-sm" id="tablespm">

                    </div>
                    <!-- </form> -->
                </div>

                <div class="col-lg-12 col-xl-3">
                    <div class="card card--events mb-4 overflow-hidden">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="main-content-label">List Pengambilan Data</div>
                                <p class="mb-0">Rp. 12.000.000.000
                                </p>
                            </div>
                            <div class="list-group to-do-tasks rounded-0">
                                <div class="table-responsive border border-bottom-0 userlist-table">
                                    <table class="table card-table table-vcenter text-nowrap mb-0" id="mytablelist">
                                        <thead>
                                            <tr>
                                                <th><span>OPD</span></th>
                                                <th><span>NILAI</span></th>
                                                <th><span>action</span></th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="pt-4 px-4">
                                <div class="main-content-label">Recent Tasks</div>
                                <p class="mb-4">It is Very Easy to Customize and it uses in website apllication.
                                </p>
                            </div>
                            <div class="d-flex p-3 border-top">
                                <label class="ckbox"><input class="mb-2" checked="" type="checkbox"><span>Do
                                        something
                                        more</span></label>
                                <span class="ms-auto">
                                    <i class="si si-pencil text-primary me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Edit"></i>
                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Delete"></i>
                                </span>
                            </div>
                            <div class="d-flex p-3 border-top">
                                <label class="ckbox"><input class="mb-2" checked="" type="checkbox"><span>Update
                                        More
                                        Files</span></label>
                                <span class="ms-auto">
                                    <i class="si si-pencil text-primary me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Edit"></i>
                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Delete"></i>
                                </span>
                            </div>
                            <div class="d-flex p-3 border-top">
                                <label class="ckbox"><input class="mb-2" type="checkbox"><span>Complete
                                        Projects</span></label>
                                <span class="ms-auto">
                                    <i class="si si-pencil text-primary me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Edit"></i>
                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Delete"></i>
                                </span>
                            </div>
                            <div class="d-flex p-3 border-top">
                                <label class="ckbox"><input class="mb-2" type="checkbox"><span>Finish
                                        Something</span></label>
                                <span class="ms-auto">
                                    <i class="si si-pencil text-primary me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Edit"></i>
                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Delete"></i>
                                </span>
                            </div>
                            <div class="d-flex p-3 border-top">
                                <label class="ckbox"><input class="mb-2" checked="" type="checkbox"><span>System
                                        Updated</span></label>
                                <span class="ms-auto">
                                    <i class="si si-pencil text-primary me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Edit"></i>
                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Delete"></i>
                                </span>
                            </div>
                            <div class="d-flex p-3 border-top">
                                <label class="ckbox"><input class="mb-2" type="checkbox"><span>Change
                                        Settings</span></label>
                                <span class="ms-auto">
                                    <i class="si si-pencil text-primary me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Edit"></i>
                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-placement="top" data-bs-original-title="Delete"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End::row-1 -->


        </div>
    </div>


    <!-- End::app-content -->


    <div class="modal fade" id="modaldemo8insert">
        <form method="post" id="form_inputmenu">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Form Input Menu</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Judul Menu" name="judul" id="judul">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Isi Link" name="link" id="link">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Isi Urutan Menu" name="urutan"
                                id="urutan">
                        </div>


                        <!-- //MESSAGE -->

                        <div class="alert custom-alert1 alert-secondary" id="error">
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                aria-label="Close"><i class="bi bi-x"></i></button>
                            <div class="text-center px-5 pb-0">
                                <svg class="custom-alert-icon svg-secondary" xmlns="http://www.w3.org/2000/svg"
                                    height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
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
                        <h6 class="modal-title">Form edit Menu</h6>
                        <!-- <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button> -->
                    </div>
                    <div class="modal-body text-start">
                        <input type="hidden" class="form-control " id="id" name="id">
                        <div class="input-group">

                            <input type="text" class="form-control " name="judul">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " name="link">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " name="urutan">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="update">
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
            fetchCart();
            kosong();

            let table = new DataTable("#mytablelist");

            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            // function to fetch data from database
            function fetchData() {
                $.ajax({
                    url: "proses/sp2d/page.php?action=fetchData",
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        var data = response.data;
                        // $("#tablespm").hide();

                        $.each(data, function(index, value) {

                            $("#tablespm").append(`
                            <div class="col-xl-4 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body p-0">
                                    <div class="todo-widget-header d-flex pb-2 p-4">
                                    </div>
                                    <div class="p-4">
                                        <span class="fs-12 text-muted">Nomor SP2D</span><span
                                            class="badge bg-primary-transparent text-primary ms-auto float-end">` + value.nama_skpd + `</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">` + value.nomor_sp2d + `</h5>
                                    </div>
                                    <div class="p-4 border-top">
                                        <span class="fs-12 text-muted">Keterangan Sp2d</span><span
                                            class="badge bg-danger-transparent text-danger ms-auto float-end">` + value.tanggal_sp2d + `</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">` + value.keterangan_sp2d + `</h5>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <a class="btn btn-primary" href="javascript:void(0);" data-bs-placement="top"
                                        data-bs-toggle="tooltip" title="Assign Task">` + formatRupiah(value.nilai_sp2d) + `</a>
                                    <button class="btn btn-outline-primary ms-auto float-end editBtn"
                                        data-bs-placement="top" data-bs-toggle="tooltip"  value="` + value.id + `" title="View Task">Add</button>
                                </div>
                            </div>
                        </div>
                    
                        `)
                            // .draw(false);
                        });
                    }
                });
            }
            // function to fetch data from database
            function fetchCart() {
                $.ajax({
                    url: "proses/sp2d/page.php?action=fetchCart",
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        var data = response.data;
                        table.clear().draw();
                        // var counter = 1;
                        $.each(data, function(index, value) {
                            table.row
                                .add([
                                    // counter,
                                    value.nama_skpd,
                                    formatRupiah(value.nilai_sp2d),
                                    '<button type="button" data-bs-effect="effect-fall" data-bs-toggle="modal" href="#modaldemo8edit" class="btn btn-sm btn-info btn-b  editBtn" value="' +
                                    value.id +
                                    '"><i class="ri-eye-line"></i></button>' +
                                    '<Button type="button" class="btn btn-sm btn-danger deleteBtn" value="' +
                                    value.id +
                                    '"><i class="ri-delete-bin-line"></i></Button>'
                                ])

                                .draw(false);
                            // counter++;
                        });
                    }
                });
            }



            function kosong() {
                $("#judul").val('');
                $("#link").val('');
                $("#urutan").val('');
                $("#error").hide();
            }


            // function to edit data
            $("#tablespm").on("click", ".editBtn", function() {
                if (confirm("Apakah yakin memasukkan dalam Keranjang?")) {
                    var id = $(this).val();
                    //   var delete_image = $(this).closest("td").find(".delete_image").val();
                    $.ajax({
                        url: "proses/sp2d/page.php?action=fetchSingle",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id: id
                            //   delete_image
                        },
                        success: function(response) {
                            if (response.statusCode == 200) {
                                window.location.replace("/kertaskerja");

                                // fetchCart();
                                // fetchData();

                            } else if (response.statusCode == 500) {
                                alert(' data error, Jaringan Anda');
                            }
                        }
                    });
                }
                // console.log(id);
                // e.preventDefault();
                // $.ajax({
                //     url: "proses/sp2d/page.php?action=fetchSingle",
                //     type: "POST",
                //     dataType: "json",
                //     data: {
                //         id: id
                //     },
                //     success: function(response) {
                //         var response = JSON.parse(response);
                //         if (response.statusCode == 200) {
                //             alert('Data Sukses terupdate');
                //             window.location.replace("/kertaskerja");
                //             // Swal.fire("!", "Data Sukses Terupdate", "success");
                //             fetchData();
                //             fetchCart();

                //             kosong();
                //             // $("#offcanvasEditUser").modal("hide");
                //         } else if (response.statusCode == 500) {
                //             alert('Failed to update data');
                //             kosong();
                //         } else if (response.statusCode == 400) {
                //             alert('isi Yang Kosong');
                //         }

                //     }
                // });
            });

            // function to update data in database
            $("#editForm").on("submit", function(e) {
                // $("#editBtn").attr("disabled");
                e.preventDefault();
                $.ajax({
                    url: "proses/menu/executemenu.php?action=updateData",
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
            $("#mytablelist").on("click", ".deleteBtn", function() {
                if (confirm("Apakah yakin Menghapus Data Ini?")) {
                    var id = $(this).val();
                    //   var delete_image = $(this).closest("td").find(".delete_image").val();
                    $.ajax({
                        url: "proses/sp2d/page.php?action=kembali",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id
                            //   delete_image
                        },
                        success: function(response) {
                            if (response.statusCode == 200) {
                                window.location.replace("/kertaskerja");

                            } else if (response.statusCode == 500) {
                                alert('data error, Jaringan Anda');
                            }
                        }
                    });
                }
            });
        });
    </script>

