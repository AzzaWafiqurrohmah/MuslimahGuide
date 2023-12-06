
    <!-- Template Main CSS File -->
    <link href="/assetsWeb/css/style.css" rel="stylesheet">
    <title>Page: login</title>
</head>

<body>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                </div>

                                <?php if(isset($params['error'])) { ?>
                                    <div class="row">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $params['error'] ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <form class="row g-3 needs-validation" method="post" action="/login" novalidate>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12 password-container">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <div class="password-input-container">
                                            <input type="password" name="password" class="form-control" id="password" required>
                                            <span id="togglePassword" class="toggle-password bi bi-eye-fill"></span>
                                        </div>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <a href="/verificationEmail" class="forgot-password" style="text-align: right; color: #DE6172; text-decoration: underline; font-size: 14px" for="forgotPass" >Forgot Password?</a>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" id="manual" name="manual" >Login</button>
                                            <a href="<?= $auth; ?>" class="btn btn-primary w-100" style="margin-top: 10px; margin-bottom: 20px; background-color: white; border-color: #DA4256 ; color: #DA4256;">
                                                <i class="bi bi-google" style="color: #DA4256 ; font-size: 0.8rem;"></i>
                                                Login with Google
                                            </a>

                                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        toggleButton.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('bi-eye-fill');
                toggleButton.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('bi-eye-slash-fill');
                toggleButton.classList.add('bi-eye-fill');
            }
        });
    });

</script>

