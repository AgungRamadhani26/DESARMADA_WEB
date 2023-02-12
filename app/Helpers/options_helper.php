<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


function set_dot($d)
{
   $whole      = floor($d);
   $fraction   = $d - $whole;

   if ($fraction == 0) {
      return @number_format($d, 0, ',', '.');
   } else {
      return number_format($d, 2, ',', '.');
   }
}

function idr($nominal)
{
   return 'Rp ' . set_dot($nominal);
}


function export_history($history, $fileName)
{
   $spreadsheet = new Spreadsheet();
   $sheet = $spreadsheet->getActiveSheet();
   $sheet->setCellValue('A1', 'No');
   $sheet->setCellValue('B1', 'Jenis Kendaraan');
   $sheet->setCellValue('C1', 'Tipe Kendaraan');
   $sheet->setCellValue('D1', 'Nomor Polisi');
   $sheet->setCellValue('E1', 'Tanggal Pinjam');
   $sheet->setCellValue('F1', 'Jam Pinjam');
   $sheet->setCellValue('G1', 'Tanggal Kembali');
   $sheet->setCellValue('H1', 'Jam Kembali');
   $sheet->setCellValue('I1', 'Km Awal');
   $sheet->setCellValue('J1', 'Km Akhir');
   $sheet->setCellValue('K1', 'Total Km');
   $sheet->setCellValue('L1', 'Pengisian Tol');
   $sheet->setCellValue('M1', 'Pengisian BBM');
   $sheet->setCellValue('N1', 'Peminjam');
   $sheet->setCellValue('O1', 'Keperluan');
   $sheet->setCellValue('P1', 'Kota Tujuan');
   $sheet->setCellValue('Q1', 'Driver');

   $column = 2; //index kolom
   foreach ($history as $h) {
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
      if ($h['saldo_tol_akhir'] == NULL) {
         $pengisian_tol = 0;
      } else {
         $pengisian_tol = $h['saldo_tol_akhir'] - $h['saldo_tol_awal'];
      }

      $sheet->setCellValue('A' . $column, ($column - 1));
      $sheet->setCellValue('B' . $column, $h['jenis_kendaraan']);
      $sheet->setCellValue('C' . $column, $h['tipe_kendaraan']);
      $sheet->setCellValue('D' . $column, $h['nomor_polisi']);
      $sheet->setCellValue('E' . $column, $tgl_pinjam2);
      $sheet->setCellValue('F' . $column, $jam_pinjam2);
      $sheet->setCellValue('G' . $column, $tgl_kembali2);
      $sheet->setCellValue('H' . $column, $jam_kembali2);
      $sheet->setCellValue('I' . $column, $h['km_awal']);
      $sheet->setCellValue('J' . $column, $h['km_akhir']);
      $sheet->setCellValue('K' . $column, $total_km);
      $sheet->setCellValue('L' . $column, idr($pengisian_tol));
      $sheet->setCellValue('M' . $column, idr($h['hargabbm']));
      $sheet->setCellValue('N' . $column, $h['nama']);
      $sheet->setCellValue('O' . $column, $h['keperluan']);
      $sheet->setCellValue('P' . $column, $h['tujuan']);
      $sheet->setCellValue('Q' . $column, $h['driver']);
      $column++;
   }

   $sheet->getStyle('A1:Q1')->getFont()->setBold(true); //biar title file excelnya jadi bold
   //Biar title excelnya berwarna kuning
   $sheet->getStyle('A1:Q1')->getFill()
      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFFFFF00');
   //Biar file excelnya punya border
   $styleArray = [
      'borders' => [
         'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
         ],
      ],
   ];
   $sheet->getStyle('A1:Q' . ($column - 1))->applyFromArray($styleArray);

   $sheet->getColumnDimension('A')->setAutoSize(true);
   $sheet->getColumnDimension('B')->setAutoSize(true);
   $sheet->getColumnDimension('C')->setAutoSize(true);
   $sheet->getColumnDimension('D')->setAutoSize(true);
   $sheet->getColumnDimension('E')->setAutoSize(true);
   $sheet->getColumnDimension('F')->setAutoSize(true);
   $sheet->getColumnDimension('G')->setAutoSize(true);
   $sheet->getColumnDimension('H')->setAutoSize(true);
   $sheet->getColumnDimension('I')->setAutoSize(true);
   $sheet->getColumnDimension('J')->setAutoSize(true);
   $sheet->getColumnDimension('K')->setAutoSize(true);
   $sheet->getColumnDimension('L')->setAutoSize(true);
   $sheet->getColumnDimension('M')->setAutoSize(true);
   $sheet->getColumnDimension('N')->setAutoSize(true);
   $sheet->getColumnDimension('O')->setAutoSize(true);
   $sheet->getColumnDimension('P')->setAutoSize(true);
   $sheet->getColumnDimension('Q')->setAutoSize(true);

   $writer = new Xlsx($spreadsheet);
   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   header('Content-Disposition: attachment;filename=' . $fileName);
   header('Cache-Control: max-age=0');
   $writer->save('php://output');
   exit();
}
