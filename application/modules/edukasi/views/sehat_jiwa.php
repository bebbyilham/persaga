  <!-- Header -->
  <div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0"><?= $title; ?></h6>
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
            <h3 class="card-title">Daftar Edukasi Sehat Jiwa</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabel_materi" class="table table-hover table-sm display">
                <thead>
                  <tr>
                    <th style="width: 2%;">No.</th>
                    <th style="width: 10%;">Nama Materi</th>
                    <th style="width: 10%;">#</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card shadow-sm">
          <div class="card-header">
            <h3 class="card-title">Daftar Video Sehat Jiwa</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabel_video" class="table table-hover table-sm display">
                <thead>
                  <tr>
                    <th style="width: 2%;">No.</th>
                    <th style="width: 10%;">Nama Video</th>
                    <th style="width: 10%;">#</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $('#loading').hide();
        // DataTable
        var dataTable = $('#tabel_materi').DataTable({
          "serverSide": true,
          "responsive": true,
          "pageLength": 25,
          "order": [],
          "ajax": {
            "url": "<?php echo base_url(); ?>edukasi/tabelmateriedukasi",
            "type": "POST",

          },
          columnDefs: [{
            orderable: false,
            targets: [0, 2]
          }],
          autoWidth: !1,
          language: {
            search: "Cari"
          },
        });

        var dataTable1 = $('#tabel_video').DataTable({
          "serverSide": true,
          "responsive": true,
          "pageLength": 25,
          "order": [],
          "ajax": {
            "url": "<?php echo base_url(); ?>edukasi/tabelvideoedukasi",
            "type": "POST",

          },
          columnDefs: [{
            orderable: false,
            targets: [0, 2]
          }],
          autoWidth: !1,
          language: {
            search: "Cari"
          },
        });



        $(document).on("click", ".lihat_file", function() {
          let id = $(this).attr('id');
          let file_materi = $(this).attr('materi');
          window.open('<?= base_url(); ?>assets/documents/' + file_materi);
        })

        $(document).on("click", ".lihat_video", function() {
          let id = $(this).attr('id');
          let link_video = $(this).attr('video');
          window.open(link_video);
        })


      });
    </script>