  <!-- Header -->
  <div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0"><?= $title; ?></h6>
          </div>
          <div class="col-lg-6 col-5 text-right">
            <a href="<?php echo base_url(); ?>beranda/jiwakeluarga" class="btn btn-sm btn-neutral">Kembali</a>
          </div>
        </div>
        <!-- Card stats -->
        <div class="row">




        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt--6 shadow-sm">
    <div class="row">
      <div class="col">
        <div class="card shadow-sm">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Pilih Tanda dan Gejala</h3>
              </div>
              <div class="col-4 text-right">
                <button type="button" id="simpan" class="btn btn-sm btn-primary">Simpan & Lihat Hasil</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form>
              <h6 class="heading-small text-muted mb-4">Pilih Tanda dan Gejala dibawah ini
              </h6>
              <div class="pl-lg-4">
                <!-- Checklist -->
                <ul class="list-group list-group-flush" data-toggle="checklist">
                  <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                    <div class="checklist-item checklist-item-primary">
                      <div>
                        <h5 class="checklist-title mb-0">Tanda dan Gejala</h5>
                      </div>
                      <div>
                        <div class="custom-control custom-checkbox custom-checkbox-primary">
                          <h5 class="checklist-title mb-0">Ya/Tidak</h5>
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php $i = 1; ?>
                  <?php foreach ($pertanyaan as $p) : ?>
                    <?php
                    if ($p['tahap'] == 1) {
                      $tahap = 'success';
                    } else if ($p['tahap'] == 2) {
                      $tahap = 'info';
                    } else if ($p['tahap'] == 3) {
                      $tahap = 'warning';
                    } else if ($p['tahap'] == 4) {
                      $tahap = 'danger';
                    } else {
                      $tahap = 'info';
                    }
                    ?>
                    <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                      <div class="checklist-item checklist-item-<?= $tahap ?>">
                        <div>
                          <small class="text-<?= $tahap; ?>"><?= 'Tahap ' . $p['tahap']; ?></small>
                          <h5 class="checklist-title mb-0"><?= $i++ . '. ' . $p['tanda_gejala']; ?></h5>
                        </div>
                        <div>
                          <div class="custom-control custom-checkbox custom-checkbox-<?= $tahap ?>">
                            <input class="custom-control-input check" id="chk-todo-task-<?= $p['id']; ?>" type="checkbox" <?= check_gejala_tanda($gejala['id'], $p['id']); ?> data-gejala="<?= $gejala['id']; ?>" data-pertanyaan=" <?= $p['id']; ?>" data-tahap=" <?= $p['tahap']; ?>">
                            <label class=" custom-control-label" for="chk-todo-task-<?= $p['id']; ?>"></label>
                          </div>
                        </div>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>

          </div>
        </div>
        <hr class="my-4" />

        </form>
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
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button> -->
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
  <div class="modal fade" id="modal-hasil-normal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-success modal-dialog-centered modal-" role="document">
      <div class="modal-content bg-gradient-success">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-notification">Hasil</h6>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button> -->
        </div>
        <div class="modal-body">
          <div class="py-3 text-center">
            <i class="fas fa-smile fa-10x"></i>
            <h3 class="heading mt-4">KONDISI KELUARGA NORMAL</h3>
          </div>

        </div>
        <div class="modal-footer">
          <a href="<?= base_url(); ?>beranda/jiwakeluarga/" type="button" class="btn btn-white">Kembali</a>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {

      $('.check').on('click', function() {
        const gejalaId = $(this).data('gejala');
        const pertanyaanId = $(this).data('pertanyaan');
        const tahap = $(this).data('tahap');

        $.ajax({
          url: "<?= base_url('beranda/changeGejala'); ?>",
          type: 'POST',
          data: {
            gejalaId: gejalaId,
            pertanyaanId: pertanyaanId,
            tahap: tahap,
          },
          success: function(data) {
            console.log(data);
            Swal.fire({
              icon: 'success',
              title: data,
              showConfirmButton: false,
              timer: 500
            })
          }
        });
      });

      // simpan
      $('#simpan').on('click', function() {
        var id_gejala_kambuh = <?= $gejala['id'] ?>;
        var status = '1';

        $.ajax({
          url: '<?php echo base_url(); ?>beranda/simpangejalakambuhpasien',
          method: 'POST',
          dataType: 'JSON',
          data: {
            id_gejala_kambuh: id_gejala_kambuh,
            status: status,
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

      });
    });
  </script>