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
                <h3 class="mb-0">Pertanyaan Deteksi Dini Kesehatan Jiwa Keluarga</h3>
              </div>
              <div class="col-4 text-right">
                <button type="button" id="simpan" class="btn btn-sm btn-primary">Simpan & Lihat Hasil</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form>
              <h6 class="heading-small text-muted mb-4">Jawab Pertanyaan dibawah
              </h6>
              <div class="pl-lg-4">
                <!-- Checklist -->
                <ul class="list-group list-group-flush" data-toggle="checklist">
                  <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                    <div class="checklist-item checklist-item-primary">
                      <div>
                        <h5 class="checklist-title mb-0">Pertanyaan</h5>
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

                    <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                      <div class="checklist-item checklist-item-primary">
                        <div>
                          <h5 class="checklist-title mb-0"><?= $i++ . '. ' . $p['pertanyaan']; ?></h5>
                        </div>
                        <div>
                          <div class="custom-control custom-checkbox custom-checkbox-primary">
                            <input class="custom-control-input check" id="chk-todo-task-<?= $p['id']; ?>" type="checkbox" <?= check_pertanyaan_keluarga($keluarga['id'], $p['id']); ?> data-keluarga="<?= $keluarga['id']; ?>" data-pertanyaan=" <?= $p['id']; ?>">
                            <label class="custom-control-label" for="chk-todo-task-<?= $p['id']; ?>"></label>
                          </div>
                        </div>
                      </div>
                    </li>
                  <?php endforeach; ?>
                  <!-- <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                    <div class="checklist-item checklist-item-success">
                      <div class="checklist-info">
                        <h5 class="checklist-title mb-0">Call with Dave</h5>
                        <small>10:30 AM</small>
                      </div>
                      <div>
                        <div class="custom-control custom-checkbox custom-checkbox-success">
                          <input class="custom-control-input" id="chk-todo-task-1" type="checkbox" checked>
                          <label class="custom-control-label" for="chk-todo-task-1"></label>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                    <div class="checklist-item checklist-item-warning">
                      <div class="checklist-info">
                        <h5 class="checklist-title mb-0">Lunch meeting</h5>
                        <small>10:30 AM</small>
                      </div>
                      <div>
                        <div class="custom-control custom-checkbox custom-checkbox-warning">
                          <input class="custom-control-input" id="chk-todo-task-2" type="checkbox">
                          <label class="custom-control-label" for="chk-todo-task-2"></label>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                    <div class="checklist-item checklist-item-info">
                      <div class="checklist-info">
                        <h5 class="checklist-title mb-0">Argon Dashboard Launch</h5>
                        <small>10:30 AM</small>
                      </div>
                      <div>
                        <div class="custom-control custom-checkbox custom-checkbox-info">
                          <input class="custom-control-input" id="chk-todo-task-3" type="checkbox">
                          <label class="custom-control-label" for="chk-todo-task-3"></label>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                    <div class="checklist-item checklist-item-danger">
                      <div class=>
                        <h5 class="checklist-title mb-0">Winter Hackaton</h5>
                        <small>10:30 AM</small>
                      </div>
                      <div>
                        <div class="custom-control custom-checkbox custom-checkbox-danger">
                          <input class="custom-control-input" id="chk-todo-task-44" type="checkbox">
                          <label class="custom-control-label" for="chk-todo-task-44"></label>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                    <div class="checklist-item checklist-item-success">
                      <div>
                        <h5 class="checklist-title mb-0">Dinner with Family</h5>
                        <small>10:30 AM</small>
                      </div>
                      <div>
                        <div class="custom-control custom-checkbox custom-checkbox-success">
                          <label class="custom-toggle">
                            <input type="checkbox" checked>
                            <span class="custom-toggle-slider rounded-circle-success" data-label-off="Tidak" data-label-on="Ya"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </li> -->
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
          <button type="button" class="btn btn-white">Kembali</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {

      $('.check').on('click', function() {
        const keluargaId = $(this).data('keluarga');
        const pertanyaanId = $(this).data('pertanyaan');

        $.ajax({
          url: "<?= base_url('beranda/changePertanyaan'); ?>",
          type: 'POST',
          data: {
            keluargaId: keluargaId,
            pertanyaanId: pertanyaanId
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
        var id_kejiwaan_keluarga = <?= $keluarga['id'] ?>;
        var status = '1';

        $.ajax({
          url: '<?php echo base_url(); ?>beranda/simpankejiwaankeluarga',
          method: 'POST',
          dataType: 'JSON',
          data: {
            id_kejiwaan_keluarga: id_kejiwaan_keluarga,
            status: status,
          },
          success: function(data) {
            // console.log(data);
            if (data.hasil >= 6) {
              $('#modal-hasil-depresi').modal('show');
            } else {
              $('#modal-hasil-normal').modal('show');
            }
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