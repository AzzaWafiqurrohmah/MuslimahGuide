
    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
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

                                <form class="row g-3 needs-validation" method="post" action="/login" novalidate>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <a href="pages-register.html" class="forgot-password" style="text-align: right; color: #DE6172 " for="forgotPass">Forgot Password?</a>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" id="manual" name="manual" >Login</button>
                                            <button class="btn btn-primary w-100" style="margin-top: 10px; margin-bottom: 20px; background-color: white; border-color: #DA4256 ; color: #DA4256;" type="submit" id="google" name="google">
                                                <i class="bi bi-google" style="color: #DA4256 ; font-size: 0.8rem;"></i>
                                                Login with google
                                            </button>
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

