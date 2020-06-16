<?php
    require APPPATH . 'libraries/REST_Controller.php';
    
    class dokter extends REST_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        public function index_get($id = 0)
        {
            if(!empty($id = 0)){
                $data = $this->db->get_where("dokter", ['Id_dokter' => $id])->result();
            } else {
                $data = $this->db->get("dokter")->result();
            }
            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function index_post()
        {
            $input = $this->input->post();
            $this->db->insert('dokter', $input);

            $this->response(['Dokter created successfully.'], REST_Controller::HTTP_OK);
        }

        /**
         * get All Data from this method
         * 
         * @return Response
         */


        function index_put() {
            $id = $this->put('Id_dokter');
            $data = array(
                        'Id_dokter'       => $this->put('Id_dokter'),
                        'nama'          => $this->put('nama'),
                        'spesialis'    => $this->put('spesialis'),
                        'alamat'    => $this->put('alamat'));
            $this->db->where('Id_dokter', $id);
            $update = $this->db->update('dokter', $data);
            if ($update) {
                $this->response(array('status' => 'dokter Change successfully'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
         function index_delete() {
            $id = $this->delete('Id_dokter');
            $this->db->where('Id_dokter', $id);
            $delete = $this->db->delete('Dokter');
            if ($delete) {
                $this->response(array('status' => 'dokter deleted successfully'), 201);
            } else {
                $this->response(array('status' => 'dokter deleted fail', 502));
            }
        }
    }