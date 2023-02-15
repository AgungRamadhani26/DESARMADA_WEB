//                                        //
// UNTUK MELAKUKAN TAMBAH DAN EDIT DRIVER //
//                                        //

//Fungsi ini digunakan untuk membersihkan form inputan pada modal add maupun edit
function bersihkanDriver() {
    $('#nama').val('');
    $('#id_driver_e').val('');
    $('#nama_e').val('');
}


//Digunakan untuk membersihkan form input jika kita mengclose modal 
$('.tombol-tutup').on('click', function() {
    //agar tetap pada halaman
    if ($('sukses').is(":visible")) {
        window.location.href = current_url() + "?" + $_SERVER['QUERY_STRING'];
    }
    $('.alert').hide();
    bersihkanDriver();
});


//Untuk melakukan proses TAMBAH DRIVER
$('#tombol-simpan-add-driver').on('click', function() {
    let $nama = $('#nama').val(); //mengambil inputan berdasarkan id=nama pada form modal
    $.ajax({ //menggunakan request ajax
        url: "/driver/tambah_driver", //url ke controller driver menjalankan fungsi tambah_driver melalui routes
        type: "POST", //menggunakan method post
        data: { //digunakan untuk mengirimkan data ke controller
            nama: $nama
        },
        success: function(hasil) { //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.sukses == false) { //Jika penambahan data gagal
                $('.sukses').hide(); //menghide alert dengan kelas sukses
                $('.error').show(); //menampilkan alert dengan kelas error
                $('.error').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
            } else { //Jika penambahan data berhasil
                $('.error').hide(); //menghide alert dengan kelas error
                $('.sukses').show(); //menampilkan alert dengan kelas sukses
                $('.sukses').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
                bersihkanDriver(); //memanggilkan fungsi bersihkan agar setelah data berhasil ditambah tulisan di form input pada modal juga hilang
            }
        }
    });
});
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal add driver (sama dengan menekan save)
$('#formDriver').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-add-driver').click();
    }
});


//Untuk melakukan proses EDIT DRIVER
function edit_driver($id) {
    $.ajax({
        url: "/driver/edit_driver/" + $id, //url ke controller driver menjalankan fungsi edit_driver melalui routes dengan membawa id_driver yang akan diedit
        type: "GET", //methodnya get karena cuman mengirim request, post jika sekalian mengirimkan data
        success: function(hasil) { //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.id_driver != '') { //Jika id_drivernya tidak kosong (ada)
                $('#id_driver_e').val($obj.id_driver); //menampilkan value yang akan diedit pada modal
                $('#nama_e').val($obj.nama); //menampilkan value yang akan diedit pada modal
            }
        }
    });
}
//Untuk melanjutkan proses EDIT DRIVER
$('#tombol-simpan-edit-driver').on('click', function() {
    let $id_driver = $('#id_driver_e').val(); //mengambil id_driver dari modal kalau id_drivernya kosong maka artinya akan menambah data baru kalau id_drivernya ada artinya edit data
    let $nama = $('#nama_e').val(); //mengambil inputan berdasarkan id=nama pada form modal
    $.ajax({ //menggunakan request ajax
        url: "/driver/update_driver", //url ke controller driver menjalankan fungsi update_driver melalui routes
        type: "POST", //menggunakan method post
        data: { //digunakan untuk mengirimkan data ke controller
            id_driver: $id_driver,
            nama: $nama
        },
        success: function(hasil) { //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.sukses == false) { //Jika penambahan data gagal
                $('.sukses').hide(); //menghide alert dengan kelas sukses
                $('.error').show(); //menampilkan alert dengan kelas error
                $('.error').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
            } else { //Jika penambahan data berhasil
                $('.error').hide(); //menghide alert dengan kelas error
                $('.sukses').show(); //menampilkan alert dengan kelas sukses
                $('.sukses').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
                bersihkanDriver(); //memanggilkan fungsi bersihkan agar setelah data berhasil diedit tulisan di form input pada modal juga hilang
            }
        }
    });
});
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal edit driver (sama dengan menekan save)
$('#formDriver_e').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-edit-driver').click();
    }
});




//                                        //
// UNTUK MELAKUKAN TAMBAH DAN EDIT LOKASI //
//                                        //

//Fungsi ini digunakan untuk membersihkan form inputan pada modal
function bersihkanLokasi() {
    $('#namalokasi').val('');
    $('#id_lokasi_e').val('');
    $('#namalokasi_e').val('');
}


//Digunakan untuk membersihkan form input jika kita mengclose modal 
$('.tombol-tutup-lokasi').on('click', function() {
    if ($('sukses-lokasi').is(":visible")) {
        window.location.href = current_url() + "?" + $_SERVER['QUERY_STRING'];
    }
    $('.alert').hide();
    bersihkanLokasi();
});


//Untuk melakukan proses TAMBAH LOKASI
$('#tombol-simpan-add-lokasi').on('click', function(){
    let $namalokasi = $('#namalokasi').val(); //mengambil inputan berdasarkan id=namalokasi pada form modal
    $.ajax({ //menggunakan request ajax
        url: "/lokasi/tambah_lokasi", //url ke controller lokasi menjalankan fungsi tambah_lokasi melalui routes
        type: "POST", //menggunakan method post
        data:{ //digunakan untuk mengirimkan data ke controller
            namalokasi: $namalokasi
        },
        success: function(hasil){ //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.sukses == false) { //Jika penambahan data gagal
                $('.sukses-lokasi').hide(); //menghide alert dengan kelas sukses
                $('.error-lokasi').show(); //menampilkan alert dengan kelas error
                $('.error-lokasi').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
            } else { //Jika penambahan data berhasil
                $('.error-lokasi').hide(); //menghide alert dengan kelas error
                $('.sukses-lokasi').show(); //menampilkan alert dengan kelas sukses
                $('.sukses-lokasi').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
                bersihkanLokasi(); //memanggilkan fungsi bersihkan agar setelah data berhasil ditambah tulisan di form input pada modal juga hilang
            }
        }
    })
});
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal add lokasi (sama dengan menekan save)
$('#formLokasi').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-add-lokasi').click();
    }
});


//Untuk melakukan proses EDIT LOKASI
function edit_lokasi($id) {
    $.ajax({
        url: "/lokasi/edit_lokasi/" + $id, //url ke controller lokasi menjalankan fungsi edit_lokasi melalui routes dengan membawa id_lokasi yang akan diedit
        type: "GET", //methodnya get karena cuman mengirim request, post jika sekalian mengirimkan data
        success: function(hasil) { //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.id_departemen != '') { //Jika id_departemen tidak kosong (ada)
                $('#id_lokasi_e').val($obj.id_departemen); //menampilkan value yang akan diedit pada modal
                $('#namalokasi_e').val($obj.nama_departemen); //menampilkan value yang akan diedit pada modal
            }
        }
    });
}
//Untuk melanjutkan proses EDIT LOKASI
$('#tombol-simpan-edit-lokasi').on('click', function(){
    let $id_lokasi = $('#id_lokasi_e').val();
    let $namalokasi = $('#namalokasi_e').val(); //mengambil inputan berdasarkan id=namalokasi_e pada form modal
    $.ajax({ //menggunakan request ajax
        url: "/lokasi/update_lokasi", //url ke controller lokasi menjalankan fungsi update_lokasi melalui routes
        type: "POST", //menggunakan method post
        data:{ //digunakan untuk mengirimkan data ke controller
            id_lokasi: $id_lokasi,
            namalokasi: $namalokasi
        },
        success: function(hasil){ //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.sukses == false) { //Jika penambahan data gagal
                $('.sukses-lokasi').hide(); //menghide alert dengan kelas sukses
                $('.error-lokasi').show(); //menampilkan alert dengan kelas error
                $('.error-lokasi').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
            } else { //Jika penambahan data berhasil
                $('.error-lokasi').hide(); //menghide alert dengan kelas error
                $('.sukses-lokasi').show(); //menampilkan alert dengan kelas sukses
                $('.sukses-lokasi').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
                bersihkanLokasi(); //memanggilkan fungsi bersihkan agar setelah data berhasil diedit tulisan di form input pada modal juga hilang
            }
        }
    })
});
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal edit lokasi (sama dengan menekan save)
$('#formLokasi_e').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-edit-lokasi').click();
    }
});




//                                      //
// UNTUK MELAKUKAN TAMBAH DAN EDIT USER //
//                                      //

//Fungsi ini digunakan untuk membersihkan form inputan pada modal
function bersihkanUser() {
    $('#username').val('');
    $('#nama').val('');
    $('#level').val('');
    $('#driver').val('');
    $('#password').val('');
    $('#konfirpass').val('');
    $('#id_user_e').val('');
    $('#username_e').val('');
    $('#nama_e').val('');
    $('#level_e').val('');
    $('#driver_e').val('');
}


//Digunakan untuk membersihkan form input jika kita mengclose modal 
$('.tombol-tutup-user').on('click', function() {
    if ($('sukses-user').is(":visible")) {
        window.location.href = current_url() + "?" + $_SERVER['QUERY_STRING'];
    }
    $('.alert').hide();
    bersihkanUser();
});


//Untuk melakukan proses TAMBAH USER
$('#tombol-simpan-add-user').on('click', function(){
    let $username = $('#username').val();
    let $nama = $('#nama').val(); //mengambil inputan berdasarkan id=namalokasi pada form modal
    let $level = $('#level').val();
    let $driver = $('#driver').val();
    let $password = $('#password').val();
    let $konfirpass = $('#konfirpass').val();
    $.ajax({ //menggunakan request ajax
        url: "/user/tambah_user", //url ke controller user menjalankan fungsi tambah_user melalui routes
        type: "POST", //menggunakan method post
        data:{ //digunakan untuk mengirimkan data ke controller
            driver: $driver,
            username: $username,
            nama: $nama,
            level: $level,
            password: $password,
            konfirpass: $konfirpass
        },
        success: function(hasil){ //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.sukses == false) { //Jika penambahan data gagal
                $('.sukses-user').hide(); //menghide alert dengan kelas sukses
                $('.error-user').show(); //menampilkan alert dengan kelas error
                $('.error-user').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
            } else { //Jika penambahan data berhasil
                $('.error-user').hide(); //menghide alert dengan kelas error
                $('.sukses-user').show(); //menampilkan alert dengan kelas sukses
                $('.sukses-user').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
                bersihkanUser(); //memanggilkan fungsi bersihkan agar setelah data berhasil ditambah tulisan di form input pada modal juga hilang
            }
        }
    })
});
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal add user (sama dengan menekan save)
$('#formUser').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-add-user').click();
    }
});


//Untuk melakukan proses EDIT USER
function edit_user($id) {
    $.ajax({
        url: "/user/edit_user/" + $id, //url ke controller user menjalankan fungsi edit_user melalui routes dengan membawa id_user yang akan diedit
        type: "GET", //methodnya get karena cuman mengirim request, post jika sekalian mengirimkan data
        success: function(hasil) { //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.id_user != '') { //Jika id_user tidak kosong (ada)
                $('#id_user_e').val($obj.id_user);
                $('#username_e').val($obj.username);
                $('#nama_e').val($obj.nama);
                $('#level_e').val($obj.level);
                $('#driver_e').val($obj.id_driver);
            }
        }
    });
}
//Untuk melakukan proses EDIT USER, dan melanjutkan proses edit
$('#tombol-simpan-edit-user').on('click', function(){
    let $id_user = $('#id_user_e').val()
    let $username = $('#username_e').val();
    let $nama = $('#nama_e').val(); //mengambil inputan berdasarkan id=nama_e pada form modal
    let $level = $('#level_e').val();
    let $driver = $('#driver_e').val();
    $.ajax({ //menggunakan request ajax
        url: "/user/update_user", //url ke controller user menjalankan fungsi update_user melalui routes
        type: "POST", //menggunakan method post
        data:{ //digunakan untuk mengirimkan data ke controller
            id_user: $id_user,
            username: $username,
            nama: $nama,
            level: $level,
            driver: $driver,
        },
        success: function(hasil){ //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.sukses == false) { //Jika penambahan data gagal
                $('.sukses-user').hide(); //menghide alert dengan kelas sukses
                $('.error-user').show(); //menampilkan alert dengan kelas error
                $('.error-user').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
            } else { //Jika penambahan data berhasil
                $('.error-user').hide(); //menghide alert dengan kelas error
                $('.sukses-user').show(); //menampilkan alert dengan kelas sukses
                $('.sukses-user').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
                bersihkanUser(); //memanggilkan fungsi bersihkan agar setelah data berhasil diedit tulisan di form input pada modal juga hilang
            }
        }
    })
});
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal edit user (sama dengan menekan save)
$('#formUser_e').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-edit-user').click();
    }
});




//                                           //
// UNTUK MELAKUKAN TAMBAH DAN EDIT KENDARAAN //
//                                           //

//Fungsi ini digunakan untuk membersihkan form inputan pada modal
function bersihkanKendaraan() {
    $('#jeniskendaraan').val('');
    $('#tipekendaraan').val('');
    $('#lokasi').val('');
    $('#nopol').val('');
    $('#kmawal').val('');
    $('#gambar').val('');
    $('#id_kendaraan_e').val('');
    $('#gambarlama_e').val('');
    $('#jeniskendaraan_e').val('');
    $('#tipekendaraan_e').val('');
    $('#lokasi_e').val('');
    $('#nopol_e').val('');
    $('#kmawal_e').val('');
    $('#gambar_e').val('');
}


//Digunakan untuk membersihkan form input jika kita mengclose modal 
$('.tombol-tutup-kendaraan').on('click', function() {
    if ($('sukses-kendaraan').is(":visible")) {
        window.location.href = current_url() + "?" + $_SERVER['QUERY_STRING'];
    }
    $('.alert').hide();
    bersihkanKendaraan();
});


//Untuk melakukan proses TAMBAH KENDARAAN
$('#tombol-simpan-add-kendaraan').on('click', function(){
    let $jeniskendaraan = $('#jeniskendaraan').val();
    let $tipekendaraan = $('#tipekendaraan').val();
    let $nopol = $('#nopol').val();
    let $lokasi = $('#lokasi').val();
    let $kmawal = $('#kmawal').val();
    let $gambar = $('#gambar')[0].files[0];

    var fd = new FormData(); //menggunakan form data agar bisa mengirim data image
    fd.append("jeniskendaraan", $jeniskendaraan);
    fd.append("tipekendaraan", $tipekendaraan);
    fd.append("nopol", $nopol);
    fd.append("lokasi", $lokasi);
    fd.append("kmawal", $kmawal);
    fd.append("gambar", $gambar);
    $.ajax({ //menggunakan request ajax
        url: "/kendaraan/tambah_kendaraan", //url ke controller kendaraan menjalankan fungsi tambah_kendaraan melalui routes
        type: "POST", //menggunakan method post
        data: fd,
        processData: false, //process data dan content type diset false agar dapat mengirim data gambar ataupun file
        contentType: false,
        success: function(hasil){ //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.sukses == false) { //Jika penambahan data gagal
                $('.sukses-kendaraan').hide(); //menghide alert dengan kelas sukses
                $('.error-kendaraan').show(); //menampilkan alert dengan kelas error
                $('.error-kendaraan').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
            } else { //Jika penambahan data berhasil
                $('.error-kendaraan').hide(); //menghide alert dengan kelas error
                $('.sukses-kendaraan').show(); //menampilkan alert dengan kelas sukses
                $('.sukses-kendaraan').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
                bersihkanKendaraan(); //memanggilkan fungsi bersihkan agar setelah data berhasil ditambah tulisan di form input pada modal juga hilang
            }
        }
    })
})
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal add kendaraan (sama dengan menekan save)
$('#formKendaraan').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-add-kendaraan').click();
    }
});


//Untuk melakukan proses EDIT KENDARAAN
function edit_kendaraan($id) {
    $.ajax({
        url: "/kendaraan/edit_kendaraan/" + $id, //url ke controller kendaraan fungsi edit_kendaraan melalui routes dengan membawa id_kendaraan yang akan diedit
        type: "GET", //methodnya get karena cuman mengirim request, post jika sekalian mengirimkan data
        success: function(hasil) { //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.id_kendaraan != '') { //Jika id_kendaraaan tidak kosong (ada)
                $('#id_kendaraan_e').val($obj.id_kendaraan);
                $('#gambarlama_e').val($obj.gambar)
                $('#jeniskendaraan_e').val($obj.jenis_kendaraan);
                $('#tipekendaraan_e').val($obj.tipe_kendaraan);
                $('#lokasi_e').val($obj.id_departemen);
                $('#nopol_e').val($obj.nomor_polisi);
                $('#kmawal_e').val($obj.km);
                $('img#img-preview_e').attr('src', '/assets/img_kendaraan/'+$obj.gambar);
            }
        }
    });
}
//Untuk melakukan proses EDIT KENDARAAN
$('#tombol-simpan-edit-kendaraan').on('click', function(){
    let $id_kendaraan = $('#id_kendaraan_e').val();
    let $gambarlama = $('#gambarlama_e').val()
    let $jeniskendaraan = $('#jeniskendaraan_e').val();
    let $tipekendaraan = $('#tipekendaraan_e').val();
    let $nopol = $('#nopol_e').val();
    let $lokasi = $('#lokasi_e').val();
    let $kmawal = $('#kmawal_e').val();
    let $gambar = $('#gambar_e')[0].files[0];

    var fd = new FormData();
    fd.append("id_kendaraan", $id_kendaraan);
    fd.append("gambarlama", $gambarlama);
    fd.append("jeniskendaraan", $jeniskendaraan);
    fd.append("tipekendaraan", $tipekendaraan);
    fd.append("nopol", $nopol);
    fd.append("lokasi", $lokasi);
    fd.append("kmawal", $kmawal);
    fd.append("gambar", $gambar);
    $.ajax({ //menggunakan request ajax
        url: "/kendaraan/update_kendaraan", //url ke controller kendaraan menjalankan fungsi update_kendaraan melalui routes
        type: "POST", //menggunakan method post
        data: fd,
        processData: false,
        contentType: false,
        success: function(hasil){ //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.sukses == false) { //Jika penambahan data gagal
                $('.sukses-kendaraan').hide(); //menghide alert dengan kelas sukses
                $('.error-kendaraan').show(); //menampilkan alert dengan kelas error
                $('.error-kendaraan').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
            } else { //Jika penambahan data berhasil
                $('.error-kendaraan').hide(); //menghide alert dengan kelas error
                $('.sukses-kendaraan').show(); //menampilkan alert dengan kelas sukses
                $('.sukses-kendaraan').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
                bersihkanKendaraan(); //memanggilkan fungsi bersihkan agar setelah data berhasil diedit tulisan di form input pada modal juga hilang
            }
        }
    })
})
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal edit kendaraan (sama dengan menekan save)
$('#formKendaraan_e').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-edit-kendaraan').click();
    }
});


//Fungsi ini digunakan untuk menampilkan gambar pada form modal add kendaraan
function previewImg() {
    const gambar = document.querySelector('#gambar');
    const imgPreview = document.querySelector('.img-preview');
    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);
    fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}


//Fungsi ini digunakan untuk menampilkan gambar pada form modal edit kendaraan, jika mengupload gambar baru
function previewImg_e() {
    const gambar = document.querySelector('#gambar_e');
    const imgPreview = document.querySelector('.img-preview_e');
    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);
    fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}

//Fungsi ini digunakan untuk menampilkan gambar pada form modal add kendaraan
function previewImg_tol() {
    const gambar = document.querySelector('#lampiran_isi_tol');
    const imgPreview = document.querySelector('.img-preview-tol');
    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);
    fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}

//Fungsi ini digunakan untuk menampilkan gambar pada form modal add kendaraan
function previewImg_bbm() {
    const gambar = document.querySelector('#lampiran_isi_bbm');
    const imgPreview = document.querySelector('.img-preview-bbm');
    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);
    fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}


