<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Aplikasi Peminjaman Kendaraan</title>
   <style>
      .border-table {
         font-family: Arial, Helvetica, sans-serif;
         width: 100%;
         border-collapse: collapse;
         font-size: 12px;
      }

      .border-table th {
         border: 1 solid #000;
         font-weight: bold;
         background-color: #e1e1e1;
      }

      .border-table td {
         border: 1 solid #000;
      }
   </style>
</head>

<body>
   <center>
      <h3>History Peminjaman Mobil</h3>
      <p>Print at: <?= date('d-m-Y H:i:s') ?></p>
   </center>
   <table class="border-table">
      <thead>
         <tr>
            <th>No</th>
            <th>Jenis Kendaraan</th>
            <th>Tipe Kendaraan</th>
            <th>Nomor Polisi</th>
            <th>Tanggal Pinjam</th>
            <th>Jam Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Jam Kembali</th>
            <th>Km Awal</th>
            <th>Km Akhir</th>
            <th>Total Km</th>
            <th>Pengisian Tol</th>
            <th>Pengisian BBM</th>
            <th>Peminjam</th>
            <th>Keperluan</th>
            <th>Kota Tujuan</th>
            <th>Driver</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $i = 1 ?>
         <?php foreach ($history as $h) : ?>
            <tr>
               <?php
               //Untuk tanggal pinjam
               $tgl_pinjam = $h['tgl_peminjaman'];
               $tgl_pinjam1 = strtotime($tgl_pinjam);
               $tgl_pinjam2 = date('d-m-Y', $tgl_pinjam1);
               //Untuk jam pinjam
               $jam_pinjam = $h['jam_peminjaman'];
               $jam_pinjam1 = strtotime($jam_pinjam);
               $jam_pinjam2 = date('H:i', $jam_pinjam1);
               //Untuk tanggal kembali
               if ($h['tgl_kembali'] != NULL) {
                  $tgl_kembali = $h['tgl_kembali'];
                  $tgl_kembali1 = strtotime($tgl_kembali);
                  $tgl_kembali2 = date('d-m-Y', $tgl_kembali1);
               } else {
                  $tgl_kembali2 = '';
               }
               //Untuk jam kembali
               if ($h['jam_kembali'] != NULL) {
                  $jam_kembali = $h['jam_kembali'];
                  $jam_kembali1 = strtotime($jam_kembali);
                  $jam_kembali2 = date('H:i', $jam_kembali1);
               } else {
                  $jam_kembali2 = '';
               }
               //Untuk total KM
               if ($h['km_akhir'] != NULL) {
                  $total_km = $h['km_akhir'] - $h['km_awal'];
               } else {
                  $total_km = 0;
               }
               //Untuk pengisian tol
               if ($h['saldo_tol_akhir'] == NULL || $h['saldo_tol_akhir'] == $h['saldo_tol_awal']) {
                  $pengisian_tol = 0;
               } else {
                  $pengisian_tol = $h['saldo_tol_akhir'] - $h['saldo_tol_awal'];
               }
               ?>
               <!--Menampilkan historynya-->
               <td><?= $i++ ?></td>
               <td><?= $h['jenis_kendaraan'] ?></td>
               <td><?= $h['tipe_kendaraan'] ?></td>
               <td><?= $h['nomor_polisi'] ?></td>
               <td><?= $tgl_pinjam2 ?></td>
               <td><?= $jam_pinjam2 ?></td>
               <td><?= $tgl_kembali2 ?></td>
               <td><?= $jam_kembali2 ?></td>
               <td><?= $h['km_awal'] ?></td>
               <td><?= $h['km_akhir'] ?></td>
               <td><?= $total_km ?></td>
               <td><?= idr($pengisian_tol) ?></a></td>
               <td><?= idr($h['hargabbm']) ?></a></td>
               <td><?= $h['nama'] ?></td>
               <td><?= $h['keperluan'] ?></td>
               <td><?= $h['tujuan'] ?></td>
               <td><?= $h['driver'] ?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
   <!--Load script bootstrap 5-->
</body>

</html>