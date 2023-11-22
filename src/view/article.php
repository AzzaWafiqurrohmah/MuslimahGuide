<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/dashboard" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">ZenFemina</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="assets/img/profile/<?=$profileImg;?>" alt="Profile" class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $name; ?></span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6><?= $name; ?></h6>
                                <span>Admin</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/profile">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#basicModal4">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<form method="post" action="/dashboard">
    <div class="modal fade" id="basicModal4" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding-top: 0.6rem; padding-bottom: 0.3rem;">
                    <i class="bi bi-exclamation-circle" style="color: red; font-size: 1.5rem; margin-left: 15px; margin-right: 8px" ></i>
                    <h5 style="margin-top: 9px">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    Apakah Anda yakin ingin keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="sign-out" name="sign-out">Sign out</button>
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal-->
</form>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Home</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Menu</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="/userTable">
                <i class="bi bi-people"></i>
                <span>User</span>
            </a>
        </li><!-- End User Nav -->

        <li class="nav-item">
            <a class="nav-link" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="ri-book-mark-fill"></i><span>Education</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/article" class="active">
                        <i class="bi bi-circle"></i><span>Articles</span>
                    </a>
                </li>
                <li>
                    <a href="/uploadArticle">
                        <i class="bi bi-circle"></i><span>Upload New Article</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Education Nav -->

        <li class="nav-heading">profile</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="/profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Articles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Education</li>
                <li class="breadcrumb-item active">article</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Delete Modal -->
    <div class="modal fade" id="basicModal3" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="/article" novalidate>
                    <div class="modal-header" style="padding-top: 0.6rem; padding-bottom: 0.3rem;">
                        <i class="bi bi-exclamation-circle" style="color: red; font-size: 1.5rem; margin-left: 15px; margin-right: 8px" ></i>
                        <h5 style="margin-top: 9px">Warning</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        Apakah Anda yakin ingin menghapus artikel ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="deleteUser" name="deleteUser" >Delete</button>
                        <input type="hidden" name="education_id_delete" id="education_id_delete" >
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Basic Modal-->

    <section class="section dashboard" id="article">
        <div class="row">

            <?php
            $i = 1;
            $length = count($data);
            foreach ($data as $row) {
                if ($i > $length || $row === null) {
                    break;
                }
                ?>
                <div class="card col-lg-3 col-md-6 col-sm-12" style="padding: 0px; margin-right: 20px; margin-left: 10px">
                    <img src="assets/img/education/<?=  $row['img']; ?>" class="card-img-top" alt="..." style="padding: 0 0 0 0" >
                    <div class="card-body">
                        <h5 class="card-title"><?=  $row['title']; ?></h5>
                        <p class="card-text"><?=  $row['contents']; ?></p>
                    </div>
                    <div style="text-align: right; margin-bottom: 20px; margin-right: 23px;" >
                        <button type="button" class="btn-edit" style="border-color: #4154f1; background-color: #4154f1; color: white; font-size: 14px; border-radius: 5px; padding: 4px 8px;" id="btn-edit" name="btn-edit">
                            <a href="/editArticle?id=<?=$row['education_id']?>" style="color: white">
                                <i class="ri-edit-2-line"></i>
                            </a>
                        </button>
                        <button type="button" class="btn-delete" style="border-color: #FC2A46; background-color: #FC2A46; color: white; font-size: 14px; border-radius: 5px; padding: 4px 8px;" id="deleteArticle" name="deleteArticle" data-bs-toggle="modal" data-bs-target="#basicModal3" data-id="<?=$row['education_id']?>" >
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>

                <?php
                $i++;
            }
            ?>
        </div>
    </section>


</main><!-- End #main -->