
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

        <li class="nav-heading">Profile</li>
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
        <h1>Upload New Article</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Education</li>
                <li class="breadcrumb-item active"><a href="/article">Article</a></li>
                <li class="breadcrumb-item">Edit Article</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <br>
            <br>
            <!-- Horizontal Form -->
            <form method="post" action="/editArticle" enctype="multipart/form-data" onsubmit="QuillContent()">
                <div class="row mb-3" style="margin-left: 25px;">
                    <div class="col-sm-4">
                        <div class="upload-container" style="text-align: center;">
                            <div class="upload-button-edit" onclick="document.getElementById('fileInput-edit').click()">
                                <img src="assets/img/education/<?=$data->getImg();?>" id="previewImg" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                                <input type="hidden" id="inputImg" name="inputImg" value="<?=$data->getImg();?>">
                                <input type="file" id="fileInput-edit" name="fileInput-edit" style="display:none" onchange="handleFileUpload2(this)" >
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="mb-3" style="font-size: 14px;">
                            <label for="title" class="col-sm-2 col-form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?=$data->getTitle(); ?>">
                            <input type="hidden" id="education_id" name="education_id" value="<?=$data->getEducationId(); ?>">
                        </div>
                        <div class="mb-3" style="font-size: 14px;">
                            <label for="text" class="col-sm-2 col-form-label">Isi</label>
                            <div class="quill-editor-full" id="text">
                                <p><?=$data->getContents(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>


                <div style="text-align: end;">
                    <button type="reset" class="btn btn-secondary" style="font-size: 12px;"  >Reset</button>
                    <button type="submit" class="btn btn-primary"  style="font-size: 12px;" id="btn-submit" name="btn-submit" >Submit</button>
                    <input type="hidden" id="content" name="content">
                </div>

                <input type="hidden" id="alertArticleEdit" name="alertArticleEdit" data-alertArticleEdit="<?= $_SESSION['alert']; ?>">

            </form><!-- End Horizontal Form -->

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>

        //alert
        const alertArticleEdit = document.getElementById('alertArticleEdit').dataset;
       console.log(alertArticleEdit);
        if(alertArticleEdit !== 'alert'){
            Swal.fire({
                title: 'Artikel Edukasi',
                text: 'berhasil ' + alertArticleEdit,
                icon: 'success',
                confirmButtonText: 'Ok'
            });

        }

        //quill content
        function QuillContent() {
            var quill = new Quill('#text', {
                theme: 'snow'
            });
            var content = quill.getText();

            $('#content').val(content);
        }
    </script>

</main><!-- End #main -->
