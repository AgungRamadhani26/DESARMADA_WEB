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



// //                                      //
// // UNTUK MELAKUKAN TAMBAH DAN EDIT USER //
// //                                      //

// //Fungsi ini digunakan untuk membersihkan form inputan pada modal
// function bersihkanUser() {
//     $('#id_user').val('');
//     $('#username').val('');
//     $('#nama').val('');
//     $('#level').val('');
//     $('#password').val('');
//     $('#konfirpass').val('');
// }

// //Digunakan untuk membersihkan form input jika kita mengclose modal 
// $('.tombol-tutup-user').on('click', function() {
//     if ($('sukses').is(":visible")) {
//         window.location.href = current_url() + "?" + $_SERVER['QUERY_STRING'];
//     }
//     $('.alert').hide();
//     bersihkanUser();
// });

// //Untuk melakukan proses EDIT USER
// function edit_user($id) {
//     $.ajax({
//         url: "/user/edit_user/" + $id, //url ke controller driver fungsi edit_driver melalui routes dengan membawa id_driver yang akan diedit
//         type: "GET", //methodnya get karena cuman mengirim request, post jika sekalian mengirimkan data
//         success: function(hasil) { //hasil ajaxnya
//             var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
//             if ($obj.id_user != '') { //Jika id_drivernya tidak kosong (ada)
//                 $('#id_user').val($obj.id_user);
//                 $('#username').val($obj.username);
//                 $('#nama').val($obj.nama);
//                 $('#level').val($obj.level);
//                 $('#password').val($obj.password);
//                 $('#konfirpass').val($obj.password);
//             }
//         }
//     });
// }

// //Untuk melakukan proses TAMBAH USER, dan melanjutkan proses edit
// $('#tombol-simpan-user').on('click', function(){
//     let $id_user = $('#id_user').val();
//     let $username = $('#username').val();
//     let $nama = $('#nama').val(); //mengambil inputan berdasarkan id=namalokasi pada form modal
//     let $level = $('#level').val();
//     let $password = $('#password').val();
//     let $konfirpass = $('#konfirpass').val();
//     $.ajax({ //menggunakan request ajax
//         url: "/user/tambah_user", //url ke controller lokasi menjalankan fungsi tambah_lokasi melalui routes
//         type: "POST", //menggunakan method post
//         data:{ //digunakan untuk mengirimkan data ke controller
//             id_user: $id_user,
//             username: $username,
//             nama: $nama,
//             level: $level,
//             password: $password,
//             konfirpass: $konfirpass
//         },
//         success: function(hasil){ //hasil ajaxnya
//             var $obj = $.parseJSON(hasil); //memparsing data hasil ajax dari controller
//             if ($obj.sukses == false) { //Jika penambahan data gagal
//                 $('.sukses-user').hide(); //menghide alert dengan kelas sukses
//                 $('.error-user').show(); //menampilkan alert dengan kelas error
//                 $('.error-user').html($obj.error); //menambahkan elemen html dari data dengan key error dari controller
//             } else { //Jika penambahan data berhasil
//                 $('.error-user').hide(); //menghide alert dengan kelas error
//                 $('.sukses-user').show(); //menampilkan alert dengan kelas sukses
//                 $('.sukses-user').html($obj.sukses); //menambahkan elemen html dari data dengan key sukses dari controller
//                 bersihkanUser(); //memanggilkan fungsi bersihkan agar setelah data berhasil ditambah tulisan di form input pada modal juga hilang
//             }
//         }
//     })
// });
