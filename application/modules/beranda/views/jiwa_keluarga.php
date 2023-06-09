  <!-- Header -->
  <div class="header bg-gradient-primary pb-6">
      <div class="container-fluid">
          <div class="header-body">
              <div class="row align-items-center py-4">
                  <div class="col-lg-6 col-7">
                      <h6 class="h2 text-white d-inline-block mb-0"><?= $title; ?></h6>
                  </div>
                  <div class="col-lg-6 col-5 text-right">
                      <a href="#" id="tambah_pemeriksaan" class="tambah btn btn-sm btn-neutral">Tambah</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="container-fluid mt--6 shadow-sm">
      <div class="row">
          <div class="col-lg-12">
              <?= $this->session->flashdata('message'); ?>
          </div>
      </div>
      <div class="row">
          <div class="col">
              <div class="card shadow-sm">
                  <div class="card-header">
                      <h3 class="card-title">Daftar Riwayat</h3>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table id="tabel_jiwa_keluarga" class="table table-hover table-sm display">
                              <thead>
                                  <tr>
                                      <th class="text-center" style="width: 1%;">#</th>
                                      <th style="width: 2%;">No.</th>
                                      <th style="width: 10%;">Waktu</th>
                                      <th style="width: 10%;">Hasil</th>
                                      <th style="width: 10%;">Status</th>
                                  </tr>
                              </thead>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Modal  -->
      <div class="modal fade" id="modal-hasil-depresi" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-danger modal-xl modal-dialog-centered modal-" role="document">
              <div class="modal-content bg-gradient-danger">
                  <div class="modal-header">
                      <h6 class="modal-title" id="modal-title-notification">Hasil</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="py-3 text-center">
                          <i class="fas fa-tired fa-10x"></i>
                          <h3 class="heading mt-4">TERDAPAT MASALAH PSIKOLOGIS SEPERTI (CEMAS ATAU DEPRESI)</h3>
                          <h4 class="heading mt-4">Tindakan yang dapat dilakukan keluarga</h4>
                      </div>
                      <div class="list-group">
                          <a href="#" class="list-group-item list-group-item-action">
                              1. Kaji penyebab masalah psikologis (cemas atau depresi) yang dirasakan
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">2. Lakukan upaya untuk mengatasi atau menghindari hal-hal yang menyebabkan cemas atau depresi yang dialami</a>
                          <a href="#" class="list-group-item list-group-item-action">3. Lakukan latihan relaksasi tarik nafas dalam</a>
                          <a href="#" class="list-group-item list-group-item-action">4. Lakukan distraksi atau pengalihan perhatian</a>
                          <a href="#" class="list-group-item list-group-item-action">5. Lakukan latihan hipnosis 5 jari</a>
                          <a href="#" class="list-group-item list-group-item-action">6. Lakukan latihan relaksasi otot progresif</a>
                          <a href="#" class="list-group-item list-group-item-action">7. Lakukan latihan spiritual</a>
                          <a href="#" class="list-group-item list-group-item-action">8. Segera konsultasi ke pelayanan kesehatan terdekat apabila gejala tidak berkurang</a>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white">Kembali</button>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modal-hasil-normal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-success modal-dialog-centered modal-" role="document">
              <div class="modal-content bg-gradient-success">
                  <div class="modal-header">
                      <h6 class="modal-title" id="modal-title-notification">Hasil</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="py-3 text-center">
                          <i class="fas fa-smile fa-10x"></i>
                          <h3 class="heading mt-4">KONDISI KELUARGA NORMAL</h3>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white">Kembali</button>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Ubah Waktu</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group row">
                          <div class="input-group">
                              <input type="hidden" class="form-control" id="id_input" name="id_input" autocomplete="off" required>
                              <input type="text" class="form-control" id="tanggal_input" name="tanggal_input" autocomplete="off" required>
                              <span class="input-group-append">
                                  <button type="button" class="btn btn-primary btn_simpan">Simpan</button>
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <script>
          $(document).ready(function() {
              $('#loading').hide();
              $('#tanggal_input').datetimepicker({
                  timepicker: true,
                  datepicker: true,
                  scrollInput: false,
                  theme: 'success',
                  format: 'Y-m-d H:i:s',
                  minDate: '0',
              });
              // DataTable
              var dataTable = $('#tabel_jiwa_keluarga').DataTable({
                  "serverSide": true,
                  "responsive": true,
                  "pageLength": 25,
                  "order": [],
                  "ajax": {
                      "url": "<?php echo base_url(); ?>beranda/tabelkejiwaankeluarga",
                      "type": "POST",
                      "data": function(data) {
                          data.id_pasien = <?= $user['pasien_id'] ?>;
                      },
                  },
                  columnDefs: [{
                      orderable: false,
                      targets: [0, 1, 2, 3, 4]
                  }],
                  autoWidth: !1,
                  language: {
                      search: "Cari"
                  },
              });

              $(document).on('click', '#tambah_pemeriksaan', function() {
                  var id_pasien = <?= $user['pasien_id'] ?>;
                  var id_user = <?= $user['id_user'] ?>;

                  $.ajax({
                      url: '<?php echo base_url(); ?>beranda/simpanjiwakeluarga',
                      method: 'POST',
                      dataType: 'JSON',
                      data: {
                          id_pasien: id_pasien,
                          id_user: id_user,
                      },
                      success: function(data) {
                          //   console.log('simpan:', data);
                          dataTable.ajax.reload();
                          window.open('<?= base_url(); ?>beranda/formkesehatanjiwakeluarga/' + data);
                      }
                  });
              });

              $(document).on("click", ".info", function() {
                  let id = $(this).attr('id')
                  let hasil = $(this).attr('hasil')
                  if (hasil >= 6) {
                      $('#modal-hasil-depresi').modal('show');
                  } else {
                      $('#modal-hasil-normal').modal('show');
                  }
              })

              $(document).on("click", ".cek", function() {
                  let id = $(this).attr('id');
                  dataTable.ajax.reload();
                  window.open('<?= base_url(); ?>beranda/formkesehatanjiwakeluarga/' + id);
              })
              $(document).on('click', '.edit', function() {
                  var id = $(this).attr('id');
                  $('#modalEdit').modal('show');
                  $('#tanggal_input').val('');
                  $('#id_input').val(id);
              });
              $(document).on('click', '.btn_simpan', function() {
                  var tgl_input = $('#tanggal_input').val();
                  var id_input = $('#id_input').val();

                  $.ajax({
                      url: '<?php echo base_url(); ?>beranda/updatetgljiwakeluarga',
                      method: 'POST',
                      dataType: 'JSON',
                      data: {
                          id_input: id_input,
                          tgl_input: tgl_input,
                      },
                      success: function(data) {
                          $('#tanggal_input').val('');
                          //   console.log(data);
                          dataTable.ajax.reload();
                          $('#modalEdit').modal('hide');
                      }
                  });
              });

          });
      </script>