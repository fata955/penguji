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
                    <div class="row row-sm" id="tablespm">
                        <div class="card mb-4">
                            <div class="card-body d-flex p-3 align-items-center">
                                <input class="form-control" placeholder="Cari Nomor SPM, Keterangan, nilai"
                                    type="search"> <button class="btn"><i
                                        class="fa fa-search d-none d-md-block"></i></button>
                            </div>
                        </div>
                        <!-- <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-body d-flex p-3 align-items-center">
                                    <input class="form-control" placeholder="Cari Nomor SPM, Keterangan, nilai"
                                        type="search"> <button class="btn"><i
                                            class="fa fa-search d-none d-md-block"></i></button>
                                </div>
                            </div>
                        </div> -->


                        <!-- <div class="col-xl-4 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body p-0">
                                    <div class="todo-widget-header d-flex pb-2 p-4">
                                        <div class="dropdown">
                                            <div class="drop-down-profile" data-bs-toggle="dropdown"><img alt=""
                                                    class="rounded-circle avatar avatar-lg"
                                                    src="../assets/images/faces/12.jpg"><span
                                                    class="assigned-task bg-info">2</span></div>
                                            <div class="dropdown-menu fs-13">
                                                <div class="main-header-profile text-center">
                                                    <div class="fs-16 h5 mb-0">Petey Cruiser</div>
                                                    <span>Web Designer</span>
                                                </div>
                                                <a class="dropdown-item" href="javascript:void(0);">View Total
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Completed
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Settings</a>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="">
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="archive" class="p-2 text-muted"><i
                                                        class="fas fa-envelope-open-text"></i></a>
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="Move to spam"
                                                    class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
                                                <a class="p-2 text-muted" data-bs-toggle="dropdown"><i
                                                        class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu fs-13">
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Unread</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Important</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add to
                                                        Tasks</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add Star</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mute</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to
                                                        Trash</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <span class="fs-12 text-muted">Nomor SPM</span><span
                                            class="badge bg-primary-transparent text-primary ms-auto float-end">New
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">voluptatem accusantium dolo
                                            laudantium</h5>
                                    </div>
                                    <div class="p-4 border-top">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-danger-transparent text-danger ms-auto float-end">Pending
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">inventore veritatis et quasi
                                            architecto</h5>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <a class="btn btn-primary" href="javascript:void(0);" data-bs-placement="top"
                                        data-bs-toggle="tooltip" title="Assign Task">Assign</a>
                                    <a class="btn btn-outline-primary ms-auto float-end" href="javascript:void(0);"
                                        data-bs-placement="top" data-bs-toggle="tooltip" title="View Task">View
                                        All</a>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-xl-4 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body p-0">
                                    <div class="todo-widget-header d-flex pb-2 p-4">
                                        <div class="dropdown">
                                            <div class="drop-down-profile" data-bs-toggle="dropdown"><img alt=""
                                                    class="rounded-circle avatar avatar-lg"
                                                    src="../assets/images/faces/9.jpg"><span
                                                    class="assigned-task bg-danger">6</span></div>
                                            <div class="dropdown-menu fs-13">
                                                <div class="main-header-profile text-center">
                                                    <div class="fs-16 h5 mb-0">Petey Cruiser</div>
                                                    <span>Web Designer</span>
                                                </div>
                                                <a class="dropdown-item" href="javascript:void(0);">View Total
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Completed
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Settings</a>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="">
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="archive" class="p-2 text-muted"><i
                                                        class="fas fa-envelope-open-text"></i></a>
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="Move to spam"
                                                    class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
                                                <a class="p-2 text-muted" data-bs-toggle="dropdown"><i
                                                        class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu fs-13">
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Unread</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Important</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add to
                                                        Tasks</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add Star</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mute</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to
                                                        Trash</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-primary-transparent text-primary ms-auto float-end">New
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">Nemo enim ipsam voluptatem
                                            quia voluptas</h5>
                                    </div>
                                    <div class="p-4 border-top">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-danger-transparent text-danger ms-auto float-end">Pending
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">vero eos et accusamus et iusto
                                            odio dignissimos</h5>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <a class="btn btn-primary" href="javascript:void(0);" data-bs-placement="top"
                                        data-bs-toggle="tooltip" title="Assign Task">Assign</a>
                                    <a class="btn btn-outline-primary ms-auto float-end" href="javascript:void(0);"
                                        data-bs-placement="top" data-bs-toggle="tooltip" title="View Task">View
                                        All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card mb-4 mg-lg-b-0">
                                <div class="card-body p-0">
                                    <div class="todo-widget-header d-flex pb-2 p-4">
                                        <div class="dropdown">
                                            <div class="drop-down-profile" data-bs-toggle="dropdown"><img alt=""
                                                    class="rounded-circle avatar avatar-lg"
                                                    src="../assets/images/faces/4.jpg"><span
                                                    class="assigned-task bg-info">9</span></div>
                                            <div class="dropdown-menu fs-13">
                                                <div class="main-header-profile text-center">
                                                    <div class="fs-16 h5 mb-0">Petey Cruiser</div>
                                                    <span>Web Designer</span>
                                                </div>
                                                <a class="dropdown-item" href="javascript:void(0);">View Total
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Completed
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Settings</a>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="">
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="archive" class="p-2 text-muted"><i
                                                        class="fas fa-envelope-open-text"></i></a>
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="Move to spam"
                                                    class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
                                                <a class="p-2 text-muted" data-bs-toggle="dropdown"><i
                                                        class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu fs-13">
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Unread</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Important</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add to
                                                        Tasks</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add Star</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mute</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to
                                                        Trash</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-primary-transparent text-primary ms-auto float-end">New
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">Ut enim ad minima veniam
                                            nostrum exercitationem</h5>
                                    </div>
                                    <div class="p-4 border-top">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-danger-transparent text-danger ms-auto float-end">Pending
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">Quis autem vel eum iure
                                            reprehenderit qui</h5>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <a class="btn btn-primary disabled" href="javascript:void(0);"
                                        data-bs-placement="top" data-bs-toggle="tooltip" title="Assign Task">Assign</a>
                                    <a class="btn btn-outline-primary ms-auto float-end" href="javascript:void(0);"
                                        data-bs-placement="top" data-bs-toggle="tooltip" title="View Task">View
                                        All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4  col-md-6">
                            <div class="card mb-4 mg-lg-b-0">
                                <div class="card-body p-0">
                                    <div class="todo-widget-header d-flex pb-2 p-4">
                                        <div class="dropdown">
                                            <div class=" drop-down-profile" data-bs-toggle="dropdown"><img alt=""
                                                    class="rounded-circle avatar avatar-md"
                                                    src="../assets/images/faces/15.jpg"><span
                                                    class="assigned-task bg-primary">7</span></div>
                                            <div class="dropdown-menu fs-13">
                                                <div class="main-header-profile text-center">
                                                    <div class="fs-16 h5 mb-0">Petey Cruiser</div>
                                                    <span>Web Designer</span>
                                                </div>
                                                <a class="dropdown-item" href="javascript:void(0);">View Total
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Completed
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Settings</a>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="">
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="archive" class="p-2 text-muted"><i
                                                        class="fas fa-envelope-open-text"></i></a>
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="Move to spam"
                                                    class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
                                                <a class="p-2 text-muted" data-bs-toggle="dropdown"><i
                                                        class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu fs-13">
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Unread</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Important</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add to
                                                        Tasks</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add Star</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mute</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to
                                                        Trash</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-primary-transparent text-primary ms-auto float-end">New
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">I must explain to you how all
                                            this mistaken</h5>
                                    </div>
                                    <div class="p-4 border-top">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-danger-transparent text-danger ms-auto float-end">Pending
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">I will give you a complete
                                            account of the system</h5>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <a class="btn btn-primary" href="javascript:void(0);" data-bs-placement="top"
                                        data-bs-toggle="tooltip" title="Assign Task">Assign</a>
                                    <a class="btn btn-outline-primary ms-auto float-end" href="javascript:void(0);"
                                        data-bs-placement="top" data-bs-toggle="tooltip" title="View Task">View
                                        All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card mb-4 ">
                                <div class="card-body p-0">
                                    <div class="todo-widget-header d-flex pb-2 p-4">
                                        <div class="dropdown">
                                            <div class="drop-down-profile" data-bs-toggle="dropdown"><img alt=""
                                                    class="rounded-circle avatar avatar-lg"
                                                    src="../assets/images/faces/5.jpg"><span
                                                    class="assigned-task bg-info">4</span></div>
                                            <div class="dropdown-menu fs-13">
                                                <div class="main-header-profile text-center">
                                                    <div class="fs-16 h5 mb-0">Petey Cruiser</div>
                                                    <span>Web Designer</span>
                                                </div>
                                                <a class="dropdown-item" href="javascript:void(0);">View Total
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Completed
                                                    Tasks</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Settings</a>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="">
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="archive" class="p-2 text-muted"><i
                                                        class="fas fa-envelope-open-text"></i></a>
                                                <a href="javascript:void(0);" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title="Move to spam"
                                                    class="p-2 text-muted"><i class="fas fa-exclamation-circle"></i></a>
                                                <a class="p-2 text-muted" data-bs-toggle="dropdown"><i
                                                        class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu fs-13">
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Unread</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark As
                                                        Important</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add to
                                                        Tasks</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Add Star</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mute</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Move to
                                                        Trash</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-primary-transparent text-primary ms-auto float-end">New
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">Rationally encounter quences
                                            extremely painful</h5>
                                    </div>
                                    <div class="p-4 border-top">
                                        <span class="fs-12 text-muted">10.54am</span><span
                                            class="badge bg-danger-transparent text-danger ms-auto float-end">Pending
                                            task</span>
                                        <h5 class="fs-14 mb-0 mt-2 text-capitalize">Which of us ever undertakes
                                            laborious physical</h5>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <a class="btn btn-primary" href="javascript:void(0);" data-bs-placement="top"
                                        data-bs-toggle="tooltip" title="Assign Task">Assign</a>
                                    <a class="btn btn-outline-primary ms-auto float-end" href="javascript:void(0);"
                                        data-bs-placement="top" data-bs-toggle="tooltip" title="View Task">View
                                        All</a>
                                </div>
                            </div>
                        </div> -->

                    </div>
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
                                <table class="table card-table table-vcenter text-nowrap mb-0" id="mytablelist">
                                    <thead>
                                        <tr>

                                            <th><span>Nomor</span></th>
                                            <th><span>Total</span></th>
                                            <th><span>action</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>0464/MANDIRI/BPKAD/2024</td>
                                            <td>2,000.000.000</td>
                                            <td>
                                                <span class="ms-auto">
                                                    <i class="si si-eye text-primary me-2" data-bs-toggle="tooltip"
                                                        title="" data-bs-placement="top"
                                                        data-bs-original-title="View"></i>
                                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip"
                                                        title="" data-bs-placement="top"
                                                        data-bs-original-title="Delete"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>0464/MANDIRI/BPKAD/2024</td>
                                            <td>2,000.000.000</td>
                                            <td>
                                                <span class="ms-auto">
                                                    <i class="si si-eye text-primary me-2" data-bs-toggle="tooltip"
                                                        title="" data-bs-placement="top"
                                                        data-bs-original-title="View"></i>
                                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip"
                                                        title="" data-bs-placement="top"
                                                        data-bs-original-title="Delete"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>0464/MANDIRI/BPKAD/2024</td>
                                            <td>2,000.000.000</td>
                                            <td>
                                                <span class="ms-auto">
                                                    <i class="si si-eye text-primary me-2" data-bs-toggle="tooltip"
                                                        title="" data-bs-placement="top"
                                                        data-bs-original-title="View"></i>
                                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip"
                                                        title="" data-bs-placement="top"
                                                        data-bs-original-title="Delete"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>0464/MANDIRI/BPKAD/2024</td>
                                            <td>2,000.000.000</td>
                                            <td>
                                                <span class="ms-auto">
                                                    <i class="si si-eye text-primary me-2" data-bs-toggle="tooltip"
                                                        title="" data-bs-placement="top"
                                                        data-bs-original-title="View"></i>
                                                    <i class="si si-trash text-danger me-2" data-bs-toggle="tooltip"
                                                        title="" data-bs-placement="top"
                                                        data-bs-original-title="Delete"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <a class="list-group-item" href="javascript:void(0);">
                                        <div class="event-indicator bg-info"></div>
                                        <h6 class="mb-0">0464/MANDIRI/BPKAD/2024</h6>
                                    </a>
                                    <a class="list-group-item" href="javascript:void(0);">
                                        <div class="event-indicator bg-primary"></div>
                                         <h6 class="mb-0">0464/MANDIRI/BPKAD/2024</h6>
                                    </a>
                                    <a class="list-group-item" href="javascript:void(0);">
                                        <div class="event-indicator bg-success"></div>
                                         <h6 class="mb-0">0464/MANDIRI/BPKAD/2024</h6>
                                    </a>
                                    <a class="list-group-item" href="javascript:void(0);">
                                        <div class="event-indicator bg-danger"></div>
                                          <h6 class="mb-0">0464/MANDIRI/BPKAD/2024</h6>
                                    </a>
                                    <a class="list-group-item border-bottom-0" href="javascript:void(0);">
                                        <div class="event-indicator bg-warning"></div>
                                          <h6 class="mb-0">0464/MANDIRI/BPKAD/2024</h6>
                                    </a> -->
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
        $(document).ready(function () {
            fetchData();
            kosong();

            let table = new DataTable("#mytablemenu");

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
                    success: function (response) {
                        var data = response.data;
                        $.each(data, function (index, value) {
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
                                    <a class="btn btn-outline-primary ms-auto float-end" href="javascript:void(0);"
                                        data-bs-placement="top" data-bs-toggle="tooltip" updateBtn value="` + value.id + `" title="View Task">Add</a>
                                </div>
                            </div>
                        </div>
                        `)

                            // .add([

                            //     value.nomor_sp2d,
                            //     value.nama_skpd,
                            //     value.keterangan_sp2d,
                            //     value.nilai_sp2d,
                            //     '<button type="button" data-bs-effect="effect-fall" data-bs-toggle="modal" href="#modaldemo8edit" class="btn btn-sm btn-info btn-b  editBtn" value="' +
                            //     value.id +
                            //     '"><i class="ri-edit-line"></i></button>' +
                            //     '<Button type="button" class="btn btn-sm btn-danger deleteBtn" value="' +
                            //     value.id +
                            //     '"><i class="ri-delete-bin-line"></i></Button>'
                            // ])



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
            // $("#tambah").on("click", function() {
            //     kosong();
            // })
            // function to insert data to database
            $("#form_inputmenu").on("submit", function (e) {
                // $("#insertBtn").attr("disabled", "disabled");
                e.preventDefault();
                $.ajax({
                    url: "proses/menu/executemenu.php?action=insertData",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
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
            $("#tablespm").on("click", ".updateBtn", function () {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url: "proses/menu/executemenu.php?action=fetchSingle",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function (response) {
                        var data = response.data;

                        $(" #modaldemo8edit #editForm #id").val(data.id);
                        $("#modaldemo8edit #editForm input[name='judul']").val(data.judul);
                        $("#modaldemo8edit #editForm input[name='link']").val(data.link);
                        $("#modaldemo8edit #editForm input[name='urutan']").val(data.urutan);

                        $("#modaldemo8edit").modal("show");

                    }
                });
            });

            // function to update data in database
            $("#editForm").on("submit", function (e) {
                // $("#editBtn").attr("disabled");
                e.preventDefault();
                $.ajax({
                    url: "proses/menu/executemenu.php?action=updateData",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
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
            $("#mytablemenu").on("click", ".deleteBtn", function () {
                if (confirm("Apakah yakin Menghapus Data Ini?")) {
                    var id = $(this).val();
                    //   var delete_image = $(this).closest("td").find(".delete_image").val();
                    $.ajax({
                        url: "proses/menu/executemenu.php?action=deleteData",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id
                            //   delete_image
                        },
                        success: function (response) {
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