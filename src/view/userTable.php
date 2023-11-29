<!-- Template Main CSS File -->
<link href="/assetsWeb/css/style.css" rel="stylesheet">
<title>Page: Tabel Pengguna</title>
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/dashboard" class="logo d-flex align-items-center">
            <img src="/assetsWeb/img/logo.png" alt="">
            <span class="d-none d-lg-block">ZenFemina</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="assetsWeb/img/profile/<?=$profileImg;?>" alt="Profile" class="rounded-circle">
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

<!-- Sign Out -->
<form method="post" action="/userTable">
    <div class="modal fade" id="basicModal4" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="/userTable" novalidate>
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
                </form>
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
            <a class="nav-link " href="/userTable">
                <i class="bi bi-people"></i>
                <span>User</span>
            </a>
        </li><!-- End User Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="ri-book-mark-fill"></i><span>Education</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/article">
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
        <h1>Data User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card" style="padding: 2rem" >
        <div class="card-body">
                <div class="col-lg-9 d-flex" style="text-align: left; margin-left: -23px" >
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" style="border-radius: 8px; font-size: 14px; padding: 8px 24px;">
                        <i class="bi bi-plus-lg" style="margin-right: 10px;"></i>New User
                    </button>
                </div>

                <div class="modal fade" id="basicModal" tabindex="-1">
                    <div class="modal-dialog" style="text-align: left; padding: 20px" >
                        <div class="modal-content">
                                    <!-- Custom Styled Validation -->
                                    <form class="row g-3 needs-validation" method="post" action="/userTable" novalidate>
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Akun User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="padding-top: 0px">
                                        <div class="col-12">
                                            <label for="validationCustomUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" class="form-control" id="validationCustomUsername" name="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Please choose a username
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-12">
                                                <label for="validationCustom01" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="add-name" name ="validationCustom03"  required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter a valid name!
                                                </div>
                                            </div>
                                        <div class="col-12">
                                            <label for="validationCustom01" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="validationCustom01" name ="validationCustom01"  required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a valid Email!
                                            </div>
                                        </div>
                                            <div class="col-12">
                                                <label for="validationCustom02" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="validationCustom02" name ="validationCustom02"  required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" id="addUser" name="addUser" type="submit">Submit</button>
                                        </div>
                                    </form><!-- End Custom Styled Validation -->
                        </div>
                    </div>
                </div> <!--End Basic Modal-->
            </div>

        <!-- edit data table -->
        <div class="modal fade" id="basicModal2" tabindex="-1">
            <div class="modal-dialog" style="text-align: left; padding: 20px" >
                <div class="modal-content">
                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="/userTable" novalidate>
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Akun User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="padding-top: 0px">
                            <div class="col-12">
                                <label for="validationCustomUsername" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" class="form-control" id="edit-username" name="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a username
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustom01" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="edit-name" name ="validationCustom03"  required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please enter a valid name!
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustom01" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit-email" name ="validationCustom01"  required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please enter a valid Email!
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustom02" class="form-label">Password</label>
                                <input type="password" class="form-control" id="edit-password" name ="validationCustom02"  required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close" name="close" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit" id="editUser" name="editUser">Submit</button>
                            <input type="hidden" name="user_id_edit" id="user_id_edit" >
                        </div>
                    </form><!-- End Custom Styled Validation -->
                </div>
            </div>
        </div> <!--End Basic Modal-->


        <!-- Delete Modal -->
        <div class="modal fade" id="basicModal3" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="/userTable" novalidate>
                        <div class="modal-header" style="padding-top: 0.6rem; padding-bottom: 0.3rem;">
                            <i class="bi bi-exclamation-circle" style="color: red; font-size: 1.5rem; margin-left: 15px; margin-right: 8px" ></i>
                            <h5 style="margin-top: 9px">Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            Apakah Anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="deleteUser" name="deleteUser" >Delete</button>
                            <input type="hidden" name="user_id_delete" id="user_id_delete" >
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Basic Modal-->

<!--        <div class="sessionData" data-sessionData="--><?php //= $_SESSION['alert']; ?><!--"></div>-->
        <input type="hidden" id="sessionData" name="sessionData" data-sessionData="<?= $_SESSION['alert']; ?>">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
        <script>
            const sessionData = document.getElementById('sessionData').dataset["sessiondata"];
            if(sessionData != null && sessionData.trim() !== ""){
                Swal.fire({
                    title: 'Data Pengguna',
                    text: 'berhasil ' + sessionData,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            }
        </script>
            <!-- Table with hoverable rows -->
            <table class="Newtable datatables" id="user-table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Age</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $length = count($data);
                foreach ($data as $row) {
                    if ($i > $length || $row === null) {
                        break;
                    }
                    ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?=  $row['name']; ?></td>
                        <td><?=  $row['age']; ?></td>
                        <td><?=  $row['username']; ?></td>
                        <td><?=  $row['email']; ?></td>
                        <td>
                            <button type="button" class="custom-btn btn-edit" id="btn-edit" name="btn-edit" data-bs-toggle="modal" data-bs-target="#basicModal2" data-id="<?=$row['user_id']?>"  data-username=<?=$row['username']?> data-email=<?=$row['email']?> data-password=<?=$row['password']?> data-name=<?=$row['name']?> >
                                Edit
                            </button>
                            <button type="button" class="custom-btnDelete btn-delete" id="btn-delete" name="btn-delete" data-bs-toggle="modal" data-bs-target="#basicModal3" data-id="<?=$row['user_id']?>" >
                                Hapus
                            </button>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>

                </tbody>
            </table>
            <!-- End Table with hoverable rows -->
            </div>

        </div>
    </div>

