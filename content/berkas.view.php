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
        <div class="main-sidebar-header">
            <a href="index.html" class="header-logo">
                <img src="assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
                <img src="assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
                <img src="assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-white">
                <img src="assets/images/brand-logos/toggle-white.png" alt="logo" class="toggle-white">
            </a>
        </div>

        <?php
        include 'component/sidebar.view.php';
        ?>

    </aside>
    <!-- End::app-sidebar -->

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body p-2">
                            <form action="" method="post" id="cari">
                                <div class="card-body d-flex p-3 align-items-center">
                                    <input class="form-control" placeholder="CARI NAMA OPD"
                                        type="search" id="datasearch"> <button type="submit" class="btn"><i
                                            class="fa fa-search d-none d-md-block"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row row-sm" id="tablespm">

                    </div>
                </div>
            </div>

        </div>

        <!-- Page Header Close -->




    </div>
</div>
<?php
include 'component/footer.view.php';
?>
<div class="modal fade" id="exampleModalXl" tabindex="-1"
    aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalXlLabel">LIST SPM</h6>
                <!-- <button class="btn btn-outline-warning ms-auto float-center tampilkan"
                    data-bs-placement="top" data-bs-toggle="tooltip" value="` + value.id_sipd + `" title="View Task">Laporan SPM</button>
                <button class="btn btn-outline-secondary ms-auto float-center tampilkan"
                    data-bs-placement="top" data-bs-toggle="tooltip" value="` + value.id_sipd + `" title="View Task">SPM Masuk</button> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-bordered" id="listspm">
                        <thead>
                            <tr>
                                <th scope="col">No SPM</th>
                                <th scope="col">Dokumen</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Potongan</th>
                                <th scope="col">Input Sumber Dana</th>
                                <th scope="col">Inputan Berkas</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaldemo8insert" tabindex="-1"
    aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Upload Berkas</h6>

                <!-- <button class="btn btn-outline-warning ms-auto float-center tampilkan"
                    data-bs-placement="top" data-bs-toggle="tooltip" value="` + value.id_sipd + `" title="View Task">Laporan SPM</button>
                <button class="btn btn-outline-secondary ms-auto float-center tampilkan"
                    data-bs-placement="top" data-bs-toggle="tooltip" value="` + value.id_sipd + `" title="View Task">SPM Masuk</button> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    <h6>Nomor SPM</h6> <label class="form-control" for="" name="nomorspm" id="nomorspm"></label><br>
                    <h6>Nama OPD</h6><label class="form-control" for="" name="namaopd" id="namaopd"></label><br>
                    <h6>Nilai SPM</h6><label class="form-control" for="" name="nilaispm" id="nilaispm"></label>
                    <br>

                    <input type="hidden" name="idspmhidden" id="idspmhidden" value="">

                    <input type="file" id="pdfFile" name="pdfFile" accept="application/pdf">
                    <button type="button" id="uploadBtn" class="btn btn-primary">Upload PDF</button>
                </form>

                <div class="progress mt-3" style="height: 25px;">
                    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated"
                        role="progressbar" style="width: 0%">0%</div>
                </div>

                <div id="status" class="mt-2"></div>
            </div>
        </div>
    </div>
</div>


<!-- End::app-content -->



<script>
    $(document).ready(function() {

        // let table = new DataTable("#listspm");
        fetchData();

        let opsiSumberDana = "";
        let table = new DataTable("#listspm", {
            columnDefs: [{
                targets: [0, 1, 2], // kolom yang ingin dibungkus
                render: function(data) {
                    return `<div style="white-space:normal; word-wrap:break-word; max-width:200px;">${data}</div>`;
                }
            }]

        });
        // 1. Ambil sumber dana dulu





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
        function fetchData(data) {
            $("#tablespm").empty();
            $.ajax({
                url: "proses/berkas/page.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;

                    // $("#tablespm").hide();

                    $.each(data, function(index, value) {

                        $("#tablespm").append(`
                            <div class="col-md-4 col-lg-4 col-xl-2  col-sm-4">
                            <div class="card kotakspm" style="min-height: 250px; "  value="` + value.id_sipd + `">
                                <div class="card-body h-50">
                                    <div class="pro-img-box">
                                        <div class="product-sale">
                                            <!-- <div class="badge bg-pink">New</div> -->
                                            <!-- <a href="wish-list.html"><i class="mdi mdi-heart-outline ms-auto wishlist"></i></a> -->
                                        </div>
                                        <a href="spm/1"><img class="w-100 rounded-3" src=""
                                                alt="product-image">
                                        </a>
                                        <!-- <a href="product-cart.html" class="adtocart"> <i class="las la-shopping-cart "></i>
                                        </a> -->
                                    </div>
                                    <div class="text-center pt-3">
                                 
                                        <h3 class="h6 mb-2 mt-4 fw-bold text-uppercase">` + value.nama_opd + `
                                        </h3> 
                                      
                                       
                                    </div>
                                    
                                    <div class="text-center pt-3">
                                     <button class="btn btn-outline-warning ms-auto float-center tampilkan"
                                        data-bs-placement="top" data-bs-toggle="tooltip"  value="` + value.id_sipd + `" title="View Task">SPM Masuk</button>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    
                        `)
                        // .draw(false);
                    });

                }
            });
        }
        // function to update data in database
        $("#cari").on("submit", function(e) {
            // $("#editBtn").attr("disabled");
            $("#tablespm").empty();
            var dsearch = $("#datasearch").val();
            e.preventDefault();
            if (dsearch) {
                $.ajax({
                    url: "proses/berkas/page.php?action=searchopd",
                    type: "POST",
                    dataType: "json",
                    data: {
                        dsearch: dsearch
                    },
                    success: function(response) {
                        var data = response.data;
                        // $("#tablespm").hide();
                        $.each(data, function(index, value) {
                            $("#tablespm").append(`
                             <div class="col-md-4 col-lg-4 col-xl-2  col-sm-4" >
                            <div class="card " style="min-height: 250px;" value="` + value.id_sipd + `">
                                <div class="card-body h-50">
                                    <div class="pro-img-box">
                                        <div class="product-sale">
                                            <!-- <div class="badge bg-pink">New</div> -->
                                            <!-- <a href="wish-list.html"><i class="mdi mdi-heart-outline ms-auto wishlist"></i></a> -->
                                        </div>
                                        <a href="spm/1"><img class="w-100 rounded-3" src=""
                                                alt="product-image">
                                        </a>
                                        <!-- <a href="product-cart.html" class="adtocart"> <i class="las la-shopping-cart "></i>
                                        </a> -->
                                    </div>
                                    <div class="text-center pt-3">
                                 
                                        <h3 class="h6 mb-2 mt-4 fw-bold text-uppercase">` + value.nama_opd + `
                                        </h3> 
                                      
                                        <span class="fs-15 ms-auto">
                                            <i class="ion ion-md-star text-warning"></i>
                                            <i class="ion ion-md-star text-warning"></i>
                                            <i class="ion ion-md-star text-warning"></i>
                                            <i class="ion ion-md-star-half text-warning"></i>
                                            <i class="ion ion-md-star-outline text-warning"></i>
                                        </span>

                                    </div>
                                    
                                    <div class="text-center pt-3">
                                        <button class="btn btn-outline-warning ms-auto float-center tampilkan"
                                        data-bs-placement="top" data-bs-toggle="tooltip"  value="` + value.id_sipd + `" title="View Task">DATA SPM</button>
                                   
                                    </div>  
                                </div>
                            </div>
                        </div>
                        `)
                            // .draw(false);
                        });
                    }
                });
            } else {
                fetchData();
            }

        });

        $.ajax({
            url: "proses/berkas/page.php?action=sumberdana",
            type: "GET",
            dataType: "json",
            async: false, // supaya selesai dulu sebelum dipakai
            success: function(res) {
                var data = res.data;
                opsiSumberDana += '<option value="">Pilih Sumber Dana</option>';
                // opsiSumberDana += '<option value="">PAD</option>';
                $.each(data, function(index, value) {
                    opsiSumberDana += '<option value="' + value.id + '">' + value.namasumberdana + '</option>';
                });
            }
        });
        $("#tablespm").on("click", ".tampilkan", function(e) {
            var id = $(this).val();
            e.preventDefault();
            if (id) {
                $.ajax({
                    url: "proses/berkas/page.php?action=listspm",
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        var data = response.data;
                        console.log(data);

                        table.clear().draw();

                        $.each(data, function(index, value) {
                            let selected = "";
                            if (value.id_dana == 0 || value.id_dana == null) {
                                selected = opsiSumberDana;
                            } else {
                                selected = opsiSumberDana.replace(
                                    'value="' + value.id_dana + '"',
                                    'value="' + value.namasumberdana + '" selected'
                                );
                            }

                            let tombolBerkas = "";
                            if (value.file_exists) {
                                // jika file sudah ada → tombol View Berkas
                                tombolBerkas =
                                    '<a href="' + value.file_url + '" target="_blank" ' +
                                    'class="btn btn-outline-success ms-auto float-center tampilkan3" ' +
                                    'data-id="' + value.id_spm + '" title="View Berkas">View Berkas</a>';
                            } else {
                                // jika file belum ada → tombol Upload Berkas
                                tombolBerkas =
                                    '<button class="btn btn-outline-danger ms-auto float-center tampilkan3" ' +
                                    'nilaispm="' + value.nilai_spm + '" namaopd="' + value.nama_opd + '" ' +
                                    'nomorspm="' + value.nomor_spm + '" data-id="' + value.id_spm + '" ' +
                                    'value="' + value.id_spm + '" title="Upload Berkas">Upload Berkas</button>';
                            }

                            table.row.add([
                                value.nomor_spm,
                                value.jenis,
                                value.keterangan_spm,
                                formatRupiah(value.nilai_spm),
                                formatRupiah(value.potongan),
                                '<select class="form-select pilih-sumber" data-id="' + value.id_spm + '">' + selected + '</select>',
                                tombolBerkas
                            ]).draw(false);
                        });


                        $("#exampleModalXl").modal('show');
                    }
                });
            } else {
                fetchData();
            }
        });


        $(document).on("change", ".pilih-sumber", function(e) {
            let id = $(this).data("id");
            let dana = $(this).val();

            console.log("EVENT CHANGE JALAN");
            console.log("ID:", id);
            console.log("Dana:", dana);

            $.ajax({
                url: "proses/berkas/page.php?action=updateSd",
                type: "POST",
                data: {
                    id: id,
                    id_dana: dana
                },
                success: function(res) {
                    console.log("RESPON PHP:", res);
                    $("#successToast").toast("show");

                },
                error: function(xhr) {
                    console.log("AJAX ERROR:", xhr.status, xhr.responseText);
                    alert('Gagal Update !');
                }
            });
        });
        $(document).on("click", ".tampilkan3", function(e) {
            e.preventDefault();

            let fileUrl = $(this).attr("href");

            if (fileUrl) {
                // View Berkas → buka file PDF di tab baru
                window.open(fileUrl, "_blank");
            } else {
                // Upload Berkas → jalankan modal insert
                $("#exampleModalXl").modal("hide");
                $("#modaldemo8insert").modal("show");

                var id = $(this).data('id');
                var nomorspm = $(this).attr("nomorspm");
                var nilaispm = $(this).attr("nilaispm");
                var namaopd = $(this).attr("namaopd");

                $('#idspmhidden').val(id);
                $('#nomorspm').text(nomorspm);
                $('#namaopd').text(namaopd);
                $('#nilaispm').text(nilaispm);
            }
        });



        $("#uploadBtn").on("click", function() {
            const file = $("#pdfFile")[0].files[0];
            let id = $('#idspmhidden').val();
            let name = $('#nameopd').val();
            let nomorspm = $('#nomorspm').text();
            // console.log(id);
            if (!file) {
                alert("Pilih file PDF terlebih dahulu!");
                return;
            }

            const chunkSize = 5 * 1024 * 1024; // 5MB
            const totalChunks = Math.ceil(file.size / chunkSize);
            let currentChunk = 0;

            // Cek ke server: chunk terakhir yang sudah diupload
            $.ajax({
                url: "proses/berkas/resume.php",
                type: "POST",
                data: {
                    nomorspm: nomorspm,
                    fileName: file.name,
                    id: id
                },
                success: function(response) {
                    currentChunk = parseInt(response) || 0;
                    uploadNextChunk();
                }
            });
            fetchData();


            function uploadNextChunk() {
                if (currentChunk >= totalChunks) {
                    $("#status").html("<b>Upload selesai!</b>");
                    $("#progressBar").removeClass("progress-bar-animated");
                    return;
                }

                const start = currentChunk * chunkSize;
                const end = Math.min(start + chunkSize, file.size);
                const chunk = file.slice(start, end);

                const formData = new FormData();
                formData.append("chunk", chunk);
                formData.append("index", currentChunk);
                formData.append("total", totalChunks);
                formData.append("fileName", file.name);
                formData.append("nomorspm", nomorspm);
                formData.append("id", id);

                $.ajax({
                    url: "proses/berkas/upload.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        let percent = Math.round(((currentChunk + 1) / totalChunks) * 100);
                        $("#progressBar").css("width", percent + "%").text(percent + "%");
                        $("#status").html("Chunk " + (currentChunk + 1) + " dari " + totalChunks + " selesai.");

                        currentChunk++;
                        uploadNextChunk();
                        console.log(id);
                    },
                    error: function() {
                        $("#status").html("Terjadi kesalahan pada chunk " + (currentChunk + 1));
                    }
                });


            }
            fetchData();
            $('#pdfFile').replaceWith($('#pdfFile').clone());
        });

    });
</script>





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






<!-- <div class="alert custom-alert1 alert-secondary" id="error">
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
</div> -->

<div id="successToast" class="toast colored-toast bg-success-transparent" role="alert" aria-live="assertive"
    aria-atomic="true">
    <div class="toast-header bg-success text-fixed-white">
        <img class="bd-placeholder-img rounded me-2" src="../assets/images/brand-logos/toggle-white.png" alt="...">
        <strong class="me-auto">Valex</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Your,toast message here.
    </div>
</div>
