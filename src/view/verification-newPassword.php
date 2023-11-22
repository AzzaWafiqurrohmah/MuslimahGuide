
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
                                <div class="pt-4 pb-2" >
                                    <h5 class="text-center pb-0 fs-4" style="padding: 0px; margin-bottom: 10px; font-weight: 600">
                                        <a href="/verificationCode?id=<?= $verification_id; ?>" style="color: black">
                                            <span class="bi bi-arrow-left float-start" style="text-align: left; font-weight: 900; cursor: pointer"></span>
                                            Kata sandi baru
                                        </a>
                                    </h5>

                                    <p style="font-size: 13px; color: #899bbd; text-align: center">
                                        Buat kata sandi yang kuat untuk akun dengan e-mail <?= $email; ?>
                                    </p>
                                </div>



                                <form class="row g-3 needs-validation" method="post" action="/verificationNewPassword" novalidate>

                                    <div class="col-12" style="margin-top: 0px; margin-bottom: 10px">
                                        <label for="firstPassword" class="form-label" style="font-size: 13px">Kata sandi baru</label>
                                        <input type="password" name="firstPassword" class="form-control" id="firstPassword"  required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12" style="margin-top: 0px; margin-bottom: 20px">
                                        <label for="secondPassword" class="form-label" style="font-size: 13px">Ketik ulang kata sandi baru</label>
                                        <input type="password" name="secondPassword" class="form-control" id="secondPassword"  required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="warning-box mt-3 border border-info d-flex align-items-center" style="color: #3498db; background-color: #f0f8ff; border-radius: 8px; font-size: 0.75rem; padding: 7px">
                                        <span class="bi bi-exclamation-circle-fill me-2" style="font-size: 1.5rem; padding: 0px 7px"></span>
                                        <div class="flex-grow-1" >
                                            Setelah kata sandi diubah, silakan masuk kembali dengan kata sandi baru di semua perangkatmu.
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <input type="hidden" id="verification_id" name="verification_id" value="<?= $verification_id; ?>">
                                        <button class="btn btn-primary w-100" style="padding: 6px 6px; font-size: 14px" type="submit" id="manual" name="manual" >Lanjutkan</button>
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

