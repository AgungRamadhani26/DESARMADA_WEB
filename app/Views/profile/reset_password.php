<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="/assets/images/img_tampilan/logo.png">
   <title>Aplikasi Monitoring Kendaraan</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="/assets/css/bootstrap.css">
   <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
   <link rel="stylesheet" href="/assets/css/app.css">
   <link rel="stylesheet" href="/assets/css/pages/auth.css">

   <!--Js untuk google recapcha-->
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
   <section class="vh-100" style="background-image: url('/assets/images/img_tampilan/BG-LupaPass.jpg');">
      <div class="container py-5 h-100">
         <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
               <div class="card shadow-2-strong" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center">
                     <img src="/assets/images/img_tampilan/logo-login.png" width="150px" alt="Logo">
                     <h3 class="mb-3 mt-1">Lupa Password</h3>
                     <p>Silahkan input password baru anda</p>
                     <form action="/lupa_password/save_reset_password/<?= $user['id_user']; ?>" method="POST">
                        <?php if (session()->getFlashdata('err_pass_Konf')) { ?>
                           <div class="alert alert-danger">
                              <?= session()->getFlashdata('err_pass_Konf') ?>
                           </div>
                        <?php } ?>
                        <?php if (session()->getFlashdata('success_pass_Konf')) { ?>
                           <div class="alert alert-success">
                              <?= session()->getFlashdata('success_pass_Konf') ?>
                           </div>
                        <?php } ?>
                        <div class="form-outline mb-4">
                           <input type="email" name="username" class="form-control form-control-lg" placeholder="Username" value="<?= $user['username']; ?>" readonly>
                           <div class=" invalid-feedback">
                           </div>
                        </div>
                        <div class="form-outline mb-4">
                           <input type="password" name="password_Baru" class="form-control form-control-lg <?= (session()->getFlashdata('err_passwordBaru')) ? 'is-invalid' : ''; ?>" placeholder="Password baru" value="<?= old('password_Baru'); ?>">
                           <div class=" invalid-feedback">
                              <?= session()->getFlashdata('err_passwordBaru') ?>
                           </div>
                        </div>
                        <div class="form-outline mb-4">
                           <input type="password" name="Konfir_passwordBaru" class="form-control form-control-lg <?= (session()->getFlashdata('err_konfirPassBaru')) ? 'is-invalid' : ''; ?>" placeholder="Konfirmasi password baru" value="<?= old('Konfir_passwordBaru'); ?>">
                           <div class=" invalid-feedback">
                              <?= session()->getFlashdata('err_konfirPassBaru') ?>
                           </div>
                        </div>
                        <center>
                           <div class="col-3">
                              <button class="btn btn-primary btn btn-block" type="submit">Kirim</button>
                           </div>
                        </center>
                     </form>
                  </div>
                  <div class="mb-4 ms-5">
                     <a href="/"><b>Kembali ke menu login</b></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</body>

</html>