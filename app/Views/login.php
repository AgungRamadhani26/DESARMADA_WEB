<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Peminjaman Kendaraan</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/pages/auth.css">

    <!--Js untuk google recapcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <section class="text-center">
        <!-- Background image -->
        <div class="p-5 bg-image" style="background-image: linear-gradient(to right, #53abea, #91a6cf); height: 300px;"></div>
        <!-- Background image -->
        <div class="card mx-4 mx-md-5 px-md-5 shadow-5-strong" style="margin-top: -150px; background: hsla(0, 0%, 100%, 0.8); backdrop-filter: blur(600px);">
            <center>
                <img src="/assets/images/img_tampilan/logo-login.png" width="150px" alt="Logo" class="mt-3">
            </center>
            <div class="card-body pt-5 px-md-5 mx-md-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">Login</h2>
                        <form action="/login" method="POST">
                            <?php if (session()->getFlashdata('error')) { ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php } ?>
                            <?= csrf_field(); ?>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" class="form-control form-control <?= (session()->getFlashdata('error_username')) ? 'is-invalid' : ''; ?>" name="username" placeholder="Username" autofocus value="<?= session()->getFlashdata('username') ?>">
                                <div class=" invalid-feedback">
                                    <?= session()->getFlashdata('error_username') ?>
                                </div>
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" class="form-control form-control <?= (session()->getFlashdata('error_password')) ? 'is-invalid' : ''; ?>" name="password" placeholder="Password" value="<?= session()->getFlashdata('password') ?>">
                                <div class=" invalid-feedback">
                                    <?= session()->getFlashdata('error_password') ?>
                                </div>
                            </div>
                            <!--Google Recapcha-->
                            <div class="g-recaptcha <?= (session()->getFlashdata('error_captcha')) ? 'is-invalid' : ''; ?>" data-sitekey="6LfQ0D0kAAAAAL78dOEU7Z_CKv35PgQeAu1xby6K"></div>
                            <div class=" invalid-feedback">
                                <?= session()->getFlashdata('error_captcha') ?>
                            </div>
                            <!-- Submit button -->
                            <center>
                                <div class="col-4">
                                    <button class="btn btn-primary btn-block shadow-lg mt-5" type="submit" name="login" value="login">Log in</button>
                                </div>
                            </center>
                            <!-- Lupa password -->
                            <div class="text-center mt-3">
                                <p><a class="font-bold" href="/lupa_password">Lupa Password ?</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>