     <!-- Start::main-sidebar -->

     <?php
        // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $tes = $_SERVER['REQUEST_URI'];
        $get = "/home/";
        $get1 = "/inputmenu";
        ?>
     <div class="main-sidebar" id="sidebar-scroll">
         <!-- Start::nav -->
         <nav class="main-menu-container nav nav-pills flex-column sub-open">
             <div class="slide-left" id="slide-left">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                 </svg>
             </div>
             <ul class="main-menu">
                 <!-- Start::slide__category -->
                 <li class="slide__category"><span class="category-name">Main</span></li>
                 <!-- End::slide__category -->

                 <!-- Start::slide -->
                 <li class="slide ">
                     <a href="/admin" class='
                        <?php
                        if ($get === $tes) {
                            echo 'side-menu__item active';
                        } else {
                            echo 'side-menu__item';
                        }
                        ?>
                     '>
                         <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                             <path d="M0 0h24v24H0V0z" fill="none" />
                             <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                             <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                         </svg>
                         <span class="side-menu__label">Beranda</span>
                         <!-- <span class="badge bg-success ms-auto menu-badge">1</span> -->
                     </a>
                 </li>

                 <!-- End::slide -->

                 <!-- End::slide -->

                 <!-- Start::slide__category -->
                 <li class="slide__category"><span class="category-name">Setting</span></li>
                 <!-- End::slide__category -->

                 <!-- Start::slide -->
                 <li class="slide has-sub">
                     <a href="javascript:void(0);" class="
                             <?php
                                if ($get1 === $tes) {
                                    echo 'side-menu__item active';
                                } else {
                                    echo 'side-menu__item';
                                }
                                ?>
                     ">

                         <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                             <path d="M0 0h24v24H0V0z" fill="none" />
                             <path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3" />
                             <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z" />
                         </svg>
                         <span class="side-menu__label">Data</span>
                         <i class="fe fe-chevron-right side-menu__angle"></i>
                     </a>
                     <ul class="slide-menu child1">
                         <li class="slide side-menu__label1">
                             <a href="javascript:void(0);"></a>
                         </li>
                         <li class="slide">
                             <a href="/inputmenu" class="
                               <?php
                                if ($get1 === $tes) {
                                    echo 'side-menu__item active';
                                } else {
                                    echo 'side-menu__item';
                                }
                                ?>
                             ">Daftar Penguji</a>
                         </li>
                         <li class="slide">
                             <a href="/inputsubmenu" class="side-menu__item">Pajak/Potongan</a>
                         </li>
                         <li class="slide">
                             <a href="/inputsubmenu" class="side-menu__item">Penarikan Data Sp2d</a>
                         </li>
                     </ul>
                 </li>
                 <!-- End::slide -->

                 <!-- Start::slide -->
                 <li class="slide has-sub">
                     <a href="javascript:void(0);" class="side-menu__item">
                         <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                             <path d="M0 0h24v24H0V0z" fill="none" />
                             <path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
                             <path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
                         </svg>
                         <span class="side-menu__label">Input</span>
                         <i class="fe fe-chevron-right side-menu__angle"></i>
                     </a>
                     <ul class="slide-menu child1 mega-menu">
                         <li class="slide side-menu__label1">
                             <a href="javascript:void(0);">Input</a>
                         </li>
                         <li class="slide">
                             <a href="/kertaskerja" class="side-menu__item">Input Kertas Kerja</a>
                         </li>

                     </ul>
                 </li>
                 <!-- End::slide -->

                 <!-- Start::slide -->
                 <li class="slide has-sub">
                     <a href="javascript:void(0);" class="side-menu__item">
                         <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                             <path d="M0 0h24v24H0V0z" fill="none" />
                             <path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
                             <path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
                         </svg>
                         <span class="side-menu__label">Management Page</span>
                         <i class="fe fe-chevron-right side-menu__angle"></i>
                     </a>
                     <ul class="slide-menu child1 mega-menu">
                         <li class="slide side-menu__label1">
                             <a href="javascript:void(0);">Berita</a>
                         </li>
                         <li class="slide">
                             <a href="/admin/halaman" class="side-menu__item">Halaman</a>
                         </li>
                         <li class="slide">
                             <a href="/admin/berita" class="side-menu__item">Berita Terkini</a>
                         </li>
                         <li class="slide">
                             <a href="/admin/pegawai" class="side-menu__item">Data Pegawai</a>
                         </li>

                     </ul>
                 </li>
                 <!-- End::slide -->

                 <!-- Start::slide -->
                 <li class="slide has-sub">
                     <a href="javascript:void(0);" class="side-menu__item">
                         <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                             <path d="M0 0h24v24H0z" fill="none" />
                             <path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 10 6.5 10s1.5.67 1.5 1.5S7.33 13 6.5 13zm3-4C8.67 9 8 8.33 8 7.5S8.67 6 9.5 6s1.5.67 1.5 1.5S10.33 9 9.5 9zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 6 14.5 6s1.5.67 1.5 1.5S15.33 9 14.5 9zm4.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" opacity=".3" />
                             <path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z" />
                             <circle cx="6.5" cy="11.5" r="1.5" />
                             <circle cx="9.5" cy="7.5" r="1.5" />
                             <circle cx="14.5" cy="7.5" r="1.5" />
                             <circle cx="17.5" cy="11.5" r="1.5" />
                         </svg>
                         <span class="side-menu__label">Advanced Ui</span>
                         <i class="fe fe-chevron-right side-menu__angle"></i>
                     </a>
                     <ul class="slide-menu child1">
                         <li class="slide side-menu__label1">
                             <a href="javascript:void(0);">Advanced Ui</a>
                         </li>
                         <li class="slide">
                             <a href="accordions-collpase.html" class="side-menu__item">Accordions</a>
                         </li>
                         <li class="slide">
                             <a href="carousel.html" class="side-menu__item">Carousel</a>
                         </li>
                         <li class="slide">
                             <a href="modals-closes.html" class="side-menu__item">Modals</a>
                         </li>
                         <li class="slide">
                             <a href="timeline.html" class="side-menu__item">Timeline</a>
                         </li>
                         <li class="slide">
                             <a href="sweet-alerts.html" class="side-menu__item">Sweet Alerts</a>
                         </li>
                         <li class="slide">
                             <a href="ratings.html" class="side-menu__item">Ratings</a>
                         </li>
                         <li class="slide">
                             <a href="search.html" class="side-menu__item">Search</a>
                         </li>
                         <li class="slide">
                             <a href="userlist.html" class="side-menu__item">Userlist</a>
                         </li>
                         <li class="slide has-sub">
                             <a href="javascript:void(0);" class="side-menu__item">Blog Pages
                                 <i class="fe fe-chevron-right side-menu__angle"></i></a>
                             <ul class="slide-menu child2">
                                 <li class="slide">
                                     <a href="blog.html" class="side-menu__item">Blog</a>
                                 </li>
                                 <li class="slide">
                                     <a href="blog-details.html" class="side-menu__item">Blog Details</a>
                                 </li>
                                 <li class="slide">
                                     <a href="blog-post.html" class="side-menu__item">Blog Post</a>
                                 </li>
                             </ul>
                         </li>
                         <li class="slide">
                             <a href="offcanvas.html" class="side-menu__item">Offcanvas</a>
                         </li>
                         <li class="slide">
                             <a href="placeholders.html" class="side-menu__item">Placeholders</a>
                         </li>
                         <li class="slide">
                             <a href="swiperjs.html" class="side-menu__item">Swiper JS</a>
                         </li>
                     </ul>
                 </li>
                 <!-- End::slide -->

             </ul>
             <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                 </svg></div>
         </nav>
         <!-- End::nav -->

     </div>
     <!-- End::main-sidebar -->