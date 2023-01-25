//                                        //
// UNTUK MELAKUKAN TAMBAH DAN EDIT DRIVER //
//                                        //

//Fungsi ini digunakan untuk membersihkan form inputan pada modal
function bersihkanDriver() {
    $('#nama').val('');
    $('#id_driver_e').val('');
    $('#nama_e').val('');
}

//Digunakan untuk membersihkan form input jika kita mengclose modal 
$('.tombol-tutup').on('click', function() {
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
$('#nama').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-add-driver').click();
    }
});

//Untuk melakukan proses EDIT DRIVER
function edit_driver($id) {
    $.ajax({
        url: "/driver/edit_driver/" + $id, //url ke controller driver fungsi edit_driver melalui routes dengan membawa id_driver yang akan diedit
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
    let $id_driver = $('#id_driver_e').val(); //mengambil id_driver dari modal kalau id_drivernya kosong maka artinya akan menambah adata baru kalau id_drivernya ada artinya edit data
    let $nama = $('#nama_e').val(); //mengambil inputan berdasarkan id=nama pada form modal
    $.ajax({ //menggunakan request ajax
        url: "/driver/update_driver", //url ke controller driver menjalankan fungsi tambah_driver melalui routes
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
                bersihkanDriver(); //memanggilkan fungsi bersihkan agar setelah data berhasil ditambah tulisan di form input pada modal juga hilang
            }
        }
    });
});
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal edit driver (sama dengan menekan save)
$('#nama_e').on('keypress', function(e){
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
    if ($('sukses').is(":visible")) {
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
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal add driver (sama dengan menekan save)
$('#namalokasi').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-add-lokasi').click();
    }
});

//Untuk melakukan proses EDIT LOKASI
function edit_lokasi($id) {
    $.ajax({
        url: "/lokasi/edit_lokasi/" + $id, //url ke controller driver fungsi edit_driver melalui routes dengan membawa id_driver yang akan diedit
        type: "GET", //methodnya get karena cuman mengirim request, post jika sekalian mengirimkan data
        success: function(hasil) { //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.id_departemen != '') { //Jika id_drivernya tidak kosong (ada)
                $('#id_lokasi_e').val($obj.id_departemen); //menampilkan value yang akan diedit pada modal
                $('#namalokasi_e').val($obj.nama_departemen); //menampilkan value yang akan diedit pada modal
            }
        }
    });
}
//Untuk melanjutkan proses EDIT LOKASI
$('#tombol-simpan-edit-lokasi').on('click', function(){
    let $id_lokasi = $('#id_lokasi_e').val();
    let $namalokasi = $('#namalokasi_e').val(); //mengambil inputan berdasarkan id=namalokasi pada form modal
    $.ajax({ //menggunakan request ajax
        url: "/lokasi/update_lokasi", //url ke controller lokasi menjalankan fungsi tambah_lokasi melalui routes
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
                bersihkanLokasi(); //memanggilkan fungsi bersihkan agar setelah data berhasil ditambah tulisan di form input pada modal juga hilang
            }
        }
    })
});
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal add driver (sama dengan menekan save)
$('#namalokasi_e').on('keypress', function(e){
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
    $('#password_e').val('');
    $('#konfirpass_e').val('');
}

//Digunakan untuk membersihkan form input jika kita mengclose modal 
$('.tombol-tutup-user').on('click', function() {
    if ($('sukses').is(":visible")) {
        window.location.href = current_url() + "?" + $_SERVER['QUERY_STRING'];
    }
    $('.alert').hide();
    bersihkanUser();
});

//Untuk melakukan proses TAMBAH USER, dan melanjutkan proses edit
$('#tombol-simpan-add-user').on('click', function(){
    let $username = $('#username').val();
    let $nama = $('#nama').val(); //mengambil inputan berdasarkan id=namalokasi pada form modal
    let $level = $('#level').val();
    let $driver = $('#driver').val();
    let $password = $('#password').val();
    let $konfirpass = $('#konfirpass').val();
    $.ajax({ //menggunakan request ajax
        url: "/user/tambah_user", //url ke controller lokasi menjalankan fungsi tambah_lokasi melalui routes
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
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal add driver (sama dengan menekan save)
$('#formUser').on('keypress', function(e){
    if (e.which === 13){
        e.preventDefault();
        $('#tombol-simpan-add-user').click();
    }
});

//Untuk melakukan proses EDIT USER
function edit_user($id) {
    $.ajax({
        url: "/user/edit_user/" + $id, //url ke controller driver fungsi edit_driver melalui routes dengan membawa id_driver yang akan diedit
        type: "GET", //methodnya get karena cuman mengirim request, post jika sekalian mengirimkan data
        success: function(hasil) { //hasil ajaxnya
            var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
            if ($obj.id_user != '') { //Jika id_drivernya tidak kosong (ada)
                $('#id_user_e').val($obj.id_user);
                $('#username_e').val($obj.username);
                $('#nama_e').val($obj.nama);
                $('#level_e').val($obj.level);
                $('#driver_e').val($obj.id_driver);
                $('#password_e').val($obj.password);
                $('#konfirpass_e').val($obj.password);
            }
        }
    });
}
//Untuk melakukan proses EDIT USER, dan melanjutkan proses edit
$('#tombol-simpan-edit-user').on('click', function(){
    let $id_user = $('#id_user_e').val()
    let $username = $('#username_e').val();
    let $nama = $('#nama_e').val(); //mengambil inputan berdasarkan id=namalokasi pada form modal
    let $level = $('#level_e').val();
    let $driver = $('#driver_e').val();
    let $password = $('#password_e').val();
    let $konfirpass = $('#konfirpass_e').val();
    $.ajax({ //menggunakan request ajax
        url: "/user/update_user", //url ke controller lokasi menjalankan fungsi tambah_lokasi melalui routes
        type: "POST", //menggunakan method post
        data:{ //digunakan untuk mengirimkan data ke controller
            id_user: $id_user,
            username: $username,
            nama: $nama,
            level: $level,
            driver: $driver,
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
//Untuk mentrigger ketika menekan enter maka akan sama dengan submit form modal add driver (sama dengan menekan save)
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
    $('#nopol').val('');
    $('#kmawal').val('');
    $('#gambar').val('');
}

//Digunakan untuk membersihkan form input jika kita mengclose modal 
$('.tombol-tutup-kendaraan').on('click', function() {
    if ($('sukses').is(":visible")) {
        window.location.href = current_url() + "?" + $_SERVER['QUERY_STRING'];
    }
    $('.alert').hide();
    bersihkanKendaraan();
});

//Untuk melakukan proses TAMBAH KENDARAAN
$('#tombol-simpan-add-kendaraan').on('click', function(){
    let $jeniskendaraan = $('#jeniskendaraan').val(); //mengambil inputan berdasarkan id=namalokasi pada form modal
    let $tipekendaraan = $('#tipekendaraan').val();
    let $nopol = $('#nopol').val();
    let $lokasi = $('#lokasi').val();
    let $kmawal = $('#kmawal').val();
    // let $gambar = document.getElementById('gambar').files[0]
    // let $gambar = $('#gambar').val();
    let $gambar = $('#gambar').prop('files')[0];
    // let $gambar = $('#gambar')[0].files[0];
    console.log($gambar);
    $.ajax({ //menggunakan request ajax
        url: "/kendaraan/tambah_kendaraan", //url ke controller lokasi menjalankan fungsi tambah_lokasi melalui routes
        type: "POST", //menggunakan method post
        data:{ //digunakan untuk mengirimkan data ke controller
            jeniskendaraan: $jeniskendaraan,
            tipekendaraan: $tipekendaraan,
            nopol: $nopol,
            lokasi: $lokasi,
            kmawal: $kmawal,
            gambar: $gambar
        },
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
                bersihkanLokasi(); //memanggilkan fungsi bersihkan agar setelah data berhasil ditambah tulisan di form input pada modal juga hilang
            }
        }
    })
});

function previewImg() {
    const gambar = document.querySelector('#gambar');
    const imgPreview = document.querySelector('.img-preview');
    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);
    fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}


