  <!-- Header -->
  <div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0"><?= $title; ?></h6>
          </div>
          <!-- <div class="col-lg-6 col-5 text-right">
            <a href="<?php echo base_url(); ?>blog" class="tambah_blog btn btn-sm btn-neutral">Kembali</a>
          </div> -->
        </div>
        <!-- Card stats -->
        <div class="row">
          <?php
          $birthDate = new DateTime($pasien['tanggal_lahir']);
          $today = new DateTime("today");
          if ($birthDate > $today) {
            exit("0 tahun 0 bulan 0 hari");
          }
          $y = $today->diff($birthDate)->y;
          $m = $today->diff($birthDate)->m;
          $d = $today->diff($birthDate)->d;
          if ($pasien['jenis_kelamin'] == 1) {
            $jk = 'Laki-laki';
          } else {
            $jk = 'Perempuan';
          }
          ?>



        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt--6 shadow-sm">
    <div class="row">
      <div class="col">
        <div class="card shadow-sm">
          <form method="post" id="form_hasil_lab">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"><?= $pasien['nama'] ?></h3><span><?= '(' . $jk . ' - ' . $y . ' Tahun ' . $m . ' Bulan ' . $d . ' Hari)' ?></span>
                </div>
                <div class="col-4 text-right">
                  <button type="submit" id="simpan_integritas_kulit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="heading-small text-muted mb-4">Data Hasil Lab Penunjang Pasien</h6>
              <div class="pl-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="upload_hasil_lab">Upload Hasil Lab</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="upload_hasil_lab" name="upload_hasil_lab" lang="en">
                        <label class="custom-file-label" for="upload_hasil_lab">format pdf, jpeg, png</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <input type="hidden" name="id_pasien" id="id_pasien" value="<?= $pasien['id'] ?>">
                  <input type="hidden" name="id_rawatan" id="id_rawatan" value="<?= $rawatan['id'] ?>">
                  <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $user['pegawai_id'] ?>">
                  <div class="col-12">
                    <div class="form-group">
                      <label class="form-control-label" for="keterangan">Keterangan</label>
                      <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <hr class="my-4" /> -->
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card shadow-sm">
          <div class="card-header">
            <h3 class="card-title">Data Hasil Lab Penunjang Pasien</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabel_integritas_kulit" class="table table-hover table-sm display">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>No.</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Create User -->
    <div class="modal fade" id="modal_foto_kulit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-primary"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img class="card-img-top" id="src_foto_kulit" src="" alt="Image placeholder">
          </div>
          <div class="modal-footer">
            <div class="text-right">

            </div>
          </div>

        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('#tanggal_pemasangan').datetimepicker({
          timepicker: false,
          datepicker: true,
          scrollInput: false,
          theme: 'success',
          format: 'Y-m-d',
          maxDate: '+2y',
        });
        $('#loading').hide();
        //   $("#deskripsi").summernote('code', '');
        $('#description').summernote({
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
          ],
        });


        // DataTable
        var dataTable = $('#tabel_integritas_kulit').DataTable({
          "serverSide": true,
          "responsive": true,
          "pageLength": 25,
          "order": [],
          "ajax": {
            "url": "<?php echo base_url(); ?>pasien/tabelhasillab",
            "type": "POST",
            "data": function(data) {
              data.id_rawatan = '<?= $rawatan['id'] ?>'
            },
          },
          columnDefs: [{
            orderable: false,
            targets: [0, 1, 2]
          }],
          autoWidth: !1,
          language: {
            search: "Cari",
            paginate: {
              "next": "<i class='ni ni-bold-right text-primary'></i>",
              "previous": "<i class='ni ni-bold-left text-primary'></i>"
            }
          },
        });


        $(document).on('submit', '#form_hasil_lab', function(event) {

          var keterangan = $('#keterangan').val()
          var upload_hasil_lab = $('#upload_hasil_lab').val()
          // var status = '1';

          $.ajax({
            url: '<?php echo base_url(); ?>pasien/simpanhasillab',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
              console.log(data);
              Swal.fire({
                icon: 'success',
                title: 'Data berhasil ditambahkan',
                showConfirmButton: false,
                timer: 2000
              })
              dataTable.ajax.reload();
              $('#keterangan').val('')
              $('#upload_hasil_lab').val('')
            }
          });

        });

        $(document).on('click', '.foto_kulit', function() {
          $('#modal_foto_kulit').modal('show');
          $('.modal-title').text('Foto Kulit');
          var fk = $(this).attr('fotokulit');
          $("#src_foto_kulit").attr("src", fk)
        });

        $(document).on('click', '.delete', function() {
          var id = $(this).attr('id');
          var notransaksi = $(this).attr('notransaksi');
          var file = $(this).attr('file');
          var status = 99;
          Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Hapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Saya Yakin'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: '<?php echo base_url(); ?>pasien/hapushasillab',
                method: 'POST',
                data: {
                  id: id,
                  status: status,
                  notransaksi: notransaksi
                },
                success: function(data) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Dihapus',
                    showConfirmButton: false,
                    timer: 2000
                  })
                  dataTable.ajax.reload();
                }
              });
            }
          })
        });
      });
    </script>