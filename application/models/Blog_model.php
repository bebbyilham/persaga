 <?php
    class Blog_model extends CI_Model
    {
        //tabel blog
        var $order_column = array(null, 'name', null, 'status', 'created_at', null);
        public function make_query_blog()
        {
            // $id_pasien = $_POST['idpasien'];
            $this->db->select('*');
            // $this->db->where('jenis_layanan', 2);
            $this->db->from('blogs');
            if (($_POST["search"]["value"])) {
                $this->db->like('no_registrasi', $_POST["search"]["value"]);
            }

            if (isset($_POST["order"])) {
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'ASC');
            }
        }


        public function make_datatables_blog()
        {
            $this->make_query_blog();

            if ($_POST["length"] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
            $query = $this->db->get();
            return $query->result();
        }

        public function get_filtered_data_blog()
        {
            $this->make_query_blog();
            $query = $this->db->get();

            return $query->num_rows();
        }

        public function get_all_data_blog()
        {
            $this->db->select("*");
            $this->db->from('blogs');
            return $this->db->count_all_results();
        }
        //end blog

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

        public function simpan_blog($data)
        {
            $this->db->insert('blogs', $data);
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