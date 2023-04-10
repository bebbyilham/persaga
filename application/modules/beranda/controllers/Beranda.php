<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Beranda_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['content'] = '';
        $page = 'beranda/index';
        // echo modules::run('template/loadview', $data);
        echo modules::run('template/loadview', $data, $page);
    }

    public function gejalakambuh()
    {
        $data['title'] = 'Deteksi Dini Gejala Kambuh';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['content'] = '';
        $page = 'beranda/gejala_kambuh';
        // echo modules::run('template/loadview', $data);
        echo modules::run('template/loadview', $data, $page);
    }

    public function jiwakeluarga()
    {
        $data['title'] = 'Kesehatan Jiwa Keluarga';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['content'] = '';
        $page = 'beranda/jiwa_keluarga';
        // echo modules::run('template/loadview', $data);
        echo modules::run('template/loadview', $data, $page);
    }

    public function simpanjiwakeluarga()
    {
        $id_pasien = $_POST['id_pasien'];
        $id_user = $_POST['id_user'];

        $data = array(
            'id_pasien'            => $id_pasien,
            'id_user'            => $id_user,
            'status'            => 0,
        );

        $this->Beranda_model->simpan_jiwa_keluarga($data);
        $idjiwakeluarga = $this->db->insert_id();
        echo json_encode($idjiwakeluarga);
    }

    public function simpangejalakambuh()
    {
        $id_pasien = $_POST['id_pasien'];
        $id_user = $_POST['id_user'];

        $data = array(
            'id_pasien'         => $id_pasien,
            'id_user'           => $id_user,
            'status'            => 0,
        );

        $this->Beranda_model->simpan_gejala_kambuh($data);
        $idgejalakambuh = $this->db->insert_id();
        echo json_encode($idgejalakambuh);
    }

    public function formkesehatanjiwakeluarga($id)
    {
        $data['title'] = 'Kesehatan Jiwa Keluarga';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        // $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])
        //     ->row_array();

        // $this->db->where('id !=', 2);
        $data['keluarga'] = $this->db->get_where('kejiwaan_keluarga', ['id' => $id])
            ->row_array();
        $data['pertanyaan'] = $this->db->order_by('id', 'ASC')->get('master_pertanyaan_keluarga')->result_array();

        $data['content'] = '';
        $page = 'beranda/form_kesehatan_jiwa_keluarga';
        // echo modules::run('template/loadview', $data);
        echo modules::run('template/loadview', $data, $page);
    }

    public function simpankejiwaankeluarga()
    {
        $id_kejiwaan_keluarga = $_POST['id_kejiwaan_keluarga'];
        $hasil = $this->db->get_where('list_kejiwaan_keluarga', ['id_kejiwaan_keluarga' => $id_kejiwaan_keluarga])->num_rows();

        $data = array(
            'status'            => $_POST['status'],
            'hasil'            => $hasil,
        );

        $this->Beranda_model->simpan_kejiwaan_keluarga($id_kejiwaan_keluarga, $data);
        echo json_encode($data);
    }

    public function changePertanyaan()
    {
        $id_kejiwaan_keluarga = $this->input->post('keluargaId');
        $id_pertanyaan = $this->input->post('pertanyaanId');


        $data = [
            'id_pertanyaan' => $id_pertanyaan,
            'id_kejiwaan_keluarga' => $id_kejiwaan_keluarga,
            'jawaban' => 1
        ];

        $result = $this->db->get_where('list_kejiwaan_keluarga', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('list_kejiwaan_keluarga', $data);
        } else {
            $this->db->delete('list_kejiwaan_keluarga', $data);
        }

        echo 'Pertanyaan dijawab';
    }

    public function formgejalakambuh($id)
    {
        $data['title'] = 'Deteksi Dini Gejala Kambuh Pada Pasien Gangguan Jiwa';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        // $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])
        //     ->row_array();

        // $this->db->where('id !=', 2);
        $data['gejala'] = $this->db->get_where('gejala_kambuh', ['id' => $id])
            ->row_array();
        $data['pertanyaan'] = $this->db->order_by('id', 'ASC')->get('master_tanda_gejala_pasien')->result_array();

        $data['content'] = '';
        $page = 'beranda/form_gejala_kambuh';
        // echo modules::run('template/loadview', $data);
        echo modules::run('template/loadview', $data, $page);
    }

    public function simpangejalakambuhpasien()
    {
        $id_gejala_kambuh = $_POST['id_gejala_kambuh'];
        $hasil = $this->db->get_where('list_gejala_kambuh', ['id_gejala_kambuh' => $id_gejala_kambuh])->num_rows();
        $tahap = $this->db->limit(1)->order_by('tahap', 'DESC')->get_where('list_gejala_kambuh', ['id_gejala_kambuh' => $id_gejala_kambuh])->row_array();

        $data = array(
            'status'    => $_POST['status'],
            'hasil'     => $hasil,
            'tahap'     => $tahap['tahap']
        );
        $this->Beranda_model->simpan_gejala_kambuh_pasien($id_gejala_kambuh, $data);
        $id_tahap = $tahap['tahap'];
        $hasiltahap = $this->db->get_where('master_tahap_kambuh', ['id_tahap' => $id_tahap])->row_array();
        $hasiltindakan = $this->db->get_where('master_tindakan_keluarga', ['id_tahap' => $id_tahap])->result_array();

        $message = [
            'hasiltahap' => $hasiltahap,
            'hasiltindakan' => $hasiltindakan
        ];
        echo json_encode($message);
    }

    public function infogejalakambuhpasien()
    {
        $id_gejala_kambuh = $_POST['id_gejala_kambuh'];
        // $hasil = $this->db->get_where('list_gejala_kambuh', ['id_gejala_kambuh' => $id_gejala_kambuh])->num_rows();
        $tahap = $this->db->limit(1)->order_by('tahap', 'DESC')->get_where('list_gejala_kambuh', ['id_gejala_kambuh' => $id_gejala_kambuh])->row_array();

        // $data = array(
        //     'status'    => $_POST['status'],
        //     'hasil'     => $hasil,
        //     'tahap'     => $tahap['tahap']
        // );
        // $this->Beranda_model->simpan_gejala_kambuh_pasien($id_gejala_kambuh, $data);
        $id_tahap = $tahap['tahap'];
        $hasiltahap = $this->db->get_where('master_tahap_kambuh', ['id_tahap' => $id_tahap])->row_array();
        $hasiltindakan = $this->db->get_where('master_tindakan_keluarga', ['id_tahap' => $id_tahap])->result_array();

        $message = [
            'hasiltahap' => $hasiltahap,
            'hasiltindakan' => $hasiltindakan
        ];
        echo json_encode($message);
    }

    public function changeGejala()
    {
        $id_gejala_kambuh = $this->input->post('gejalaId');
        $id_pertanyaan = $this->input->post('pertanyaanId');
        $tahap = $this->input->post('tahap');


        $data = [
            'id_gejala_tanda' => $id_pertanyaan,
            'id_gejala_kambuh' => $id_gejala_kambuh,
            'tahap' => $tahap,
            'jawaban' => 1
        ];

        $result = $this->db->get_where('list_gejala_kambuh', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('list_gejala_kambuh', $data);
        } else {
            $this->db->delete('list_gejala_kambuh', $data);
        }

        echo 'Gejala atau Tanda dipilih';
    }

    public function tabelgejalakambuh()
    {
        $fetch_data = $this->Beranda_model->make_datatables_gejala_kambuh();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            if ($row->status >= 1) {
                $sub_array[] = '
                <a href="#" class="fas fa-check-circle fa-lg ml-2 mr-2 cek" id="' . $row->id . '" pasien="' . $row->id_pasien . '" hasil="' . $row->hasil . '" data-toggle="modal" data-target="#staticBackdrop" title="Cek"></a>
                <a href="#" class="fa fa-info-circle fa-lg ml-2 mr-2 info" id="' . $row->id . '" pasien="' . $row->id_pasien . '" hasil="' . $row->hasil . '" data-toggle="modal" data-target="#staticBackdrop" title="Info"></a>
                ';
            } else {
                $sub_array[] = '
                <a href="#" class="fas fa-check-circle fa-lg ml-2 mr-2 cek" id="' . $row->id . '" pasien="' . $row->id_pasien . '" hasil="' . $row->hasil . '" data-toggle="modal" data-target="#staticBackdrop" title="Cek"></a>';
            }

            $sub_array[] = $no;
            $sub_array[] = '<span href="#" class="status badge badge-primary" title="Dibuat" >' . $row->created_at . '</span><br>' . '<span href="#" class="status badge badge-info" title="Diperbarui" >' . $row->updated_at . '</span><br>';


            $sub_array[] = '<span href="#" class="status badge badge-danger" title="Cemas atau Depresi" >' . $row->tahap_kambuh . '</span><br>';
            if ($row->status >= 1) {
                $status = 'Selesai';
                $sub_array[] = '<span href="#" class="status badge badge-success" title="Selesai" >' . $status . '</span><br>';
            } else {
                $status = 'Draft';
                $sub_array[] = '<span href="#" class="status badge badge-secondary" title="Draft" >' . $status . '</span><br>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Beranda_model->get_all_data_gejala_kambuh(),
            "recordsFiltered"     => $this->Beranda_model->get_filtered_data_gejala_kambuh(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tabelkejiwaankeluarga()
    {
        $fetch_data = $this->Beranda_model->make_datatables_kejiwaan_keluarga();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            if ($row->status >= 1) {
                $sub_array[] = '
                <a href="#" class="fas fa-check-circle fa-lg ml-2 mr-2 cek" id="' . $row->id . '" pasien="' . $row->id_pasien . '" hasil="' . $row->hasil . '" data-toggle="modal" data-target="#staticBackdrop" title="Cek"></a>
                <a href="#" class="fa fa-info-circle fa-lg ml-2 mr-2 info" id="' . $row->id . '" pasien="' . $row->id_pasien . '" hasil="' . $row->hasil . '" data-toggle="modal" data-target="#staticBackdrop" title="Info"></a>
                ';
            } else {
                $sub_array[] = '
                <a href="#" class="fas fa-check-circle fa-lg ml-2 mr-2 cek" id="' . $row->id . '" pasien="' . $row->id_pasien . '" hasil="' . $row->hasil . '" data-toggle="modal" data-target="#staticBackdrop" title="Cek"></a>';
            }

            $sub_array[] = $no;
            $sub_array[] = '<span href="#" class="status badge badge-primary" title="Dibuat" >' . $row->created_at . '</span><br>' . '<span href="#" class="status badge badge-info" title="Diperbarui" >' . $row->updated_at . '</span><br>';


            if ($row->hasil >= 6) {
                $hasil = 'Cemas atau Depresi';
                $sub_array[] = '<span href="#" class="status badge badge-danger" title="Cemas atau Depresi" >' . $hasil . '</span><br>';
            } else {
                $hasil = 'Normal';
                $sub_array[] = '<span href="#" class="status badge badge-success" title="Normal" >' . $hasil . '</span><br>';
            }
            if ($row->status >= 1) {
                $status = 'Selesai';
                $sub_array[] = '<span href="#" class="status badge badge-success" title="Selesai" >' . $status . '</span><br>';
            } else {
                $status = 'Draft';
                $sub_array[] = '<span href="#" class="status badge badge-secondary" title="Draft" >' . $status . '</span><br>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Beranda_model->get_all_data_kejiwaan_keluarga(),
            "recordsFiltered"     => $this->Beranda_model->get_filtered_data_kejiwaan_keluarga(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function infojiwakeluarga()
    {
        $id_kejiwaan_keluarga = $_POST['id'];
        $hasil = $this->db->get_where('kejiwaan_keluarga', ['id' => $id_kejiwaan_keluarga])->result_array();

        echo json_encode($hasil);
    }

    public function tambahgejalakambuh()
    {
        $data['title'] = 'Blog';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['content'] = '';
        $page = 'blog/tambah_blog';
        // echo modules::run('template/loadview', $data);
        echo modules::run('template/loadview', $data, $page);
    }

    public function getAllCreators()
    {
        $data = $this->Creator_model->fetch_all_creators();
        echo json_encode($data);
    }

    public function simpanblog()
    {
        $data = array(
            'name'            => $_POST['judul'],
            'category'        => $_POST['category'],
            'description'     => $_POST['description'],
            'status'          => $_POST['status'],
            'description'     => $_POST['description'],
            'creator_id'       => $_POST['creator'],
            'thumbnail'       => $_POST['thumbnail']
        );

        $this->Blog_model->simpan_blog($data);
        echo json_encode($data);
    }

    public function ubahstatusblog()
    {
        $data = array(
            'status'            => $_POST['status'],
        );

        $this->Blog_model->ubah_status_blog($data, $_POST['id']);
        echo json_encode($data);
    }

    public function imageblog($id)
    {
        $data['title'] = 'Image Blog';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['id_blog'] = $id;

        $data['content'] = '';
        $page = 'blog/image_blog';
        echo modules::run('template/loadview', $data, $page);
    }

    public function tabelimageblog()
    {
        $fetch_data = $this->Blog_model->make_datatables_image_blog();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = substr($row->image, 0, 40) . '...';
            $sub_array[] = '
            <a href="#" class="fa fa-trash ml-2 mr-2 text-danger delete" id="' . $row->id . '" file="' . $row->file_name . '" data-toggle="modal" data-target="#staticBackdrop" title="delete"></a>';

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Blog_model->get_all_data_image_blog(),
            "recordsFiltered"     => $this->Blog_model->get_filtered_data_image_blog(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function simpanimageblog()
    {
        $config['upload_path']          = './assets/img/image_blog/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = '6024'; // 6024KB
        $config['encrypt_name']            = TRUE;

        $this->load->library('upload', $config);

        $this->upload->do_upload('file_blog');
        $filename = $this->upload->data("file_name");
        $data = array(

            'image'                 => base_url('assets/img/image_blog/') . $filename,
            'file_name'                 => $filename,
            'blog_id'                 => $this->input->post('id_blog')
        );
        $this->Blog_model->simpan_image_blog($data);
        echo json_encode($data);
    }

    public function hapusimageblog()
    {
        $id = $_POST['id'];
        $file = $_POST['file'];
        unlink(FCPATH . 'assets/img/image_blog/' . $file);
        $this->Blog_model->hapus_image_blog($id);
        echo json_encode('Foto berhasil dihapus');
    }
}
