 <?php
    class Beranda_model extends CI_Model
    {
        //tabel
        var $order_column = array(null, 'status', 'created_at', null);
        public function make_query_kejiwaan_keluarga()
        {
            $id_pasien = $_POST['id_pasien'];
            $this->db->select('*');
            $this->db->where('id_pasien', $id_pasien);
            $this->db->from('kejiwaan_keluarga');
            if (($_POST["search"]["value"])) {
                $this->db->like('created_at', $_POST["search"]["value"]);
            }

            if (isset($_POST["order"])) {
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'ASC');
            }
        }


        public function make_datatables_kejiwaan_keluarga()
        {
            $this->make_query_kejiwaan_keluarga();

            if ($_POST["length"] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
            $query = $this->db->get();
            return $query->result();
        }

        public function get_filtered_data_kejiwaan_keluarga()
        {
            $this->make_query_kejiwaan_keluarga();
            $query = $this->db->get();

            return $query->num_rows();
        }

        public function get_all_data_kejiwaan_keluarga()
        {
            $this->db->select("*");
            $this->db->from('kejiwaan_keluarga');
            return $this->db->count_all_results();
        }
        //end blog

        var $order_column_gejala = array(null, 'status', 'created_at', null);
        public function make_query_gejala_kambuh()
        {
            $id_pasien = $_POST['id_pasien'];
            $this->db->select('*');
            $this->db->where('id_pasien', $id_pasien);
            $this->db->from('gejala_kambuh');
            if (($_POST["search"]["value"])) {
                $this->db->like('created_at', $_POST["search"]["value"]);
            }

            if (isset($_POST["order"])) {
                $this->db->order_by($this->order_column_gejala[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'ASC');
            }
        }


        public function make_datatables_gejala_kambuh()
        {
            $this->make_query_gejala_kambuh();

            if ($_POST["length"] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
            $query = $this->db->get();
            return $query->result();
        }

        public function get_filtered_data_gejala_kambuh()
        {
            $this->make_query_gejala_kambuh();
            $query = $this->db->get();

            return $query->num_rows();
        }

        public function get_all_data_gejala_kambuh()
        {
            $this->db->select("*");
            $this->db->from('gejala_kambuh');
            return $this->db->count_all_results();
        }

        //image blog
        var $order_column_image_blog = array(null, 'name', null, 'status', 'created_at', null);
        public function make_query_image_blog()
        {
            // $id_pasien = $_POST['idpasien'];
            $this->db->select('*');
            $this->db->where('blog_id', $_POST['id_blog']);
            $this->db->from('image_blogs');
            if (($_POST["search"]["value"])) {
                $this->db->like('no_registrasi', $_POST["search"]["value"]);
            }

            if (isset($_POST["order"])) {
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'ASC');
            }
        }


        public function make_datatables_image_blog()
        {
            $this->make_query_image_blog();

            if ($_POST["length"] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
            $query = $this->db->get();
            return $query->result();
        }

        public function get_filtered_data_image_blog()
        {
            $this->make_query_image_blog();
            $query = $this->db->get();

            return $query->num_rows();
        }

        public function get_all_data_image_blog()
        {
            $this->db->select("*");
            $this->db->from('image_blogs');
            return $this->db->count_all_results();
        }
        //end image blog
        public function simpan_jiwa_keluarga($data)
        {
            $this->db->insert('kejiwaan_keluarga', $data);
        }

        public function simpan_gejala_kambuh($data)
        {
            $this->db->insert('gejala_kambuh', $data);
        }

        public function simpan_gejala_kambuh_pasien($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('gejala_kambuh', $data);
        }
        public function simpan_kejiwaan_keluarga($id, $data)
        {
            $this->db->where('id', $id);
            $this->db->update('kejiwaan_keluarga', $data);
        }
        public function simpan_image_blog($data)
        {
            $this->db->insert('image_blogs', $data);
        }
        public function ubah_status_blog($data, $id)
        {
            $this->db->where('id', $id);
            $this->db->update('blogs', $data);
        }
        public function hapus_image_blog($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('image_blogs');
        }
    }
    ?>