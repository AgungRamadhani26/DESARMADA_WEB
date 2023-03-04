<!--Load script dari folder public-->
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/main.js"></script>
<!--Load script datatable dari folder public-->
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<!--Load sweetalert dari folder vendor-->
<script src="/assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
<!--Untuk autonumeric pada input bbm dan saldo tol-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js" integrity="sha512-6j+LxzZ7EO1Kr7H5yfJ8VYCVZufCBMNFhSMMzb2JRhlwQ/Ri7Zv8VfJ7YI//cg9H5uXT2lQpb14YMvqUAdGlcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.js" integrity="sha512-/lbeISSLChIunUcgNvSFJSC+LFCZg08JHFhvDfDWDlY3a/NYb/NPKOcfDte3aA6E3mxm9a3sdxvkktZJSCpxGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
   new AutoNumeric('#isi_tol', {
      decimalPlaces: '0',
      decimalCharacter: ',',
      digitGroupSeparator: '.'
   });

   new AutoNumeric('#isi_bbm', {
      decimalPlaces: '0',
      decimalCharacter: ',',
      digitGroupSeparator: '.'
   });
</script>
<script>
   <?php if (session()->getFlashdata('swal_icon')) { ?>
      Swal.fire({
         icon: '<?= session()->getFlashdata('swal_icon') ?>',
         title: '<?= session()->getFlashdata('swal_title') ?>',
         text: '<?= session()->getFlashdata('swal_text') ?>',
      })
   <?php } ?>
</script>

<!--Script untuk menjalankan datatable-->
<!--Simple Datatable-->
<script>
   let table1 = document.querySelector('#table1');
   let dataTable = new simpleDatatables.DataTable(table1);
</script>
<!--FlatPickr-->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="/assets/ajax.js"></script>
<script src="/assets/showhidePass.js"></script>
<script>
   config = {
      dateFormat: "Y-m-d",
      altInput: true,
      altFormat: "d-m-Y",
   }
   flatpickr("#tgl_pinjam", config);
   flatpickr("#tgl_kembali", config);
</script>