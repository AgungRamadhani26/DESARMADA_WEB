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
   <section class="vh-100" style="background-image: linear-gradient(to right, #53abea, #91a6cf);">
      <div class="container py-5 h-100">
         <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
               <div class="card shadow-2-strong" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center">
                     <img src="/assets/images/img_tampilan/logo-login.png" width="150px" alt="Logo">
                     <h3 class="mb-3 mt-1">Lupa Password</h3>
                     <p>Tolong kirimkan email saudara agar kami dapat mengirim link pembaruan password ke email yang saudara kirimkan</p>
                     <form action="/lupa_password/cek_email" method="POST">
                        <?php if (session()->getFlashdata('berhasil_kirim_email')) { ?>
                           <div class="alert alert-success">
                              <?= session()->getFlashdata('berhasil_kirim_email') ?>
                           </div>
                        <?php } ?>
                        <div class="form-outline mb-4">
                           <input type="email" name="username" class="form-control form-control-lg <?= (session()->getFlashdata('err_username')) ? 'is-invalid' : ''; ?>" placeholder="Username" value="<?= old('username'); ?>">
                           <div class=" invalid-feedback">
                              <?= session()->getFlashdata('err_username') ?>
                           </div>
                        </div>
                        <center>
                           <div class="col-3">
                              <button class="btn btn-primary btn btn-block" type="submit">Kirim</button>
                           </div>
                        </center>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</body>

</html>