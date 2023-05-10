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
                          <table id="tabel_gejala_kambuh" class="table table-hover table-sm display">
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
                          <h1 class="heading mt-4 tahapkambuh"></h1>
                          <h4 class="heading mt-4">Tindakan yang dapat dilakukan keluarga</h4>
                      </div>
                      <div class="list-group datatindakan">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <a href="<?= base_url(); ?>beranda/gejalakambuh/" type="button" class="btn btn-white">Kembali</a>
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
              var dataTable = $('#tabel_gejala_kambuh').DataTable({
                  "serverSide": true,
                  "responsive": true,
                  "pageLength": 25,
                  "order": [],
                  "ajax": {
                      "url": "<?php echo base_url(); ?>beranda/tabelgejalakambuh",
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

              $(document).on('click', '.edit', function() {
                  var id = $(this).attr('id');
                  $('#modalEdit').modal('show');
                  $('#tanggal_input').val('');
                  $('#id_input').val(id);
              });

              $(document).on('click', '#tambah_pemeriksaan', function() {
                  var id_pasien = <?= $user['pasien_id'] ?>;
                  var id_user = <?= $user['id_user'] ?>;

                  $.ajax({
                      url: '<?php echo base_url(); ?>beranda/simpangejalakambuh',
                      method: 'POST',
                      dataType: 'JSON',
                      data: {
                          id_pasien: id_pasien,
                          id_user: id_user,
                      },
                      success: function(data) {
                          //   console.log(data);
                          dataTable.ajax.reload();
                          window.open('<?= base_url(); ?>beranda/formgejalakambuh/' + data);
                      }
                  });
              });

              $(document).on("click", ".info", function() {
                  let id_gejala_kambuh = $(this).attr('id')
                  let hasil = $(this).attr('hasil')
                  //   if (hasil >= 6) {
                  //       $('#modal-hasil-depresi').modal('show');
                  //   } else {
                  //       $('#modal-hasil-normal').modal('show');
                  //   }
                  $.ajax({
                      url: '<?php echo base_url(); ?>beranda/infogejalakambuhpasien',
                      method: 'POST',
                      dataType: 'JSON',
                      data: {
                          id_gejala_kambuh: id_gejala_kambuh,
                      },
                      success: function(data) {
                          console.log(data);
                          $('#modal-hasil-depresi').modal('show');
                          var hasiltahap = data['hasiltahap']['tahap_kambuh'];
                          // console.log(hasiltahap);
                          $('.tahapkambuh').text(hasiltahap);

                          if (data['hasiltindakan']) {
                              var hasiltindakan = data['hasiltindakan'];
                              var no = 1
                              $.each(hasiltindakan, function(i, result) {
                                  $('.datatindakan').append(
                                      `
                  <a href="#" class="list-group-item list-group-item-action">` + no++ + '. ' +
                                      result.tindakan_keluarga +
                                      `</a>
                                    `
                                  );
                              });
                          } else {
                              $('.datatindakan').html('');
                          }
                          // if (data.hasil >= 6) {
                          //   $('#modal-hasil-depresi').modal('show');
                          // } else {
                          //   $('#modal-hasil-normal').modal('show');
                          // }
                          // Swal.fire({
                          //   icon: 'success',
                          //   title: 'Data berhasil disimpan',
                          //   showConfirmButton: false,
                          //   timer: 1500
                          // })
                          // window.location.href = "<?php base_url(); ?>blog/";
                      }
                  });
              })

              $(document).on("click", ".cek", function() {
                  let id = $(this).attr('id');
                  dataTable.ajax.reload();
                  window.open('<?= base_url(); ?>beranda/formgejalakambuh/' + id);
              })

              $(document).on('click', '.btn_simpan', function() {
                  var tgl_input = $('#tanggal_input').val();
                  var id_input = $('#id_input').val();

                  $.ajax({
                      url: '<?php echo base_url(); ?>beranda/updatetglgejalakambuh',
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