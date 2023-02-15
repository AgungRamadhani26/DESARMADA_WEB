<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Peminjaman Kendaraan</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">

    <!--Js untuk google recapcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <center>
                        <img src="/assets/images/img_tampilan/logo-login.png" alt="Logo">
                    </center>
                    <div class="mt-4">
                        <form action="/login" method="POST">
                            <?php if (session()->getFlashdata('error')) { ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php } ?>
                            <?= csrf_field(); ?>
                            <div class="form-group position-relative mb-4">
                                <input type="email" class="form-control form-control-xl <?= (session()->getFlashdata('error_username')) ? 'is-invalid' : ''; ?>" placeholder="Username" name="username" autofocus value="<?= session()->getFlashdata('username') ?>">
                                <div class=" invalid-feedback">
                                    <?= session()->getFlashdata('error_username') ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control form-control-xl <?= (session()->getFlashdata('error_password')) ? 'is-invalid' : ''; ?>" placeholder="Password" name="password" value="<?= session()->getFlashdata('password') ?>">
                                <div class=" invalid-feedback">
                                    <?= session()->getFlashdata('error_password') ?>
                                </div>
                            </div>
                            <div class="g-recaptcha <?= (session()->getFlashdata('error_captcha')) ? 'is-invalid' : ''; ?>" data-sitekey="6LfQ0D0kAAAAAL78dOEU7Z_CKv35PgQeAu1xby6K"></div>
                            <div class=" invalid-feedback">
                                <?= session()->getFlashdata('error_captcha') ?>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit" name="login" value="login">Log in</button>
                        </form>
                        <div class="text-center mt-4 text-lg fs-4">
                            <p><a class="font-bold" href="">Lupa Password?</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>

    </div>
</body>

</html>