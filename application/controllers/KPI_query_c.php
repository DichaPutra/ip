<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KPI_query_c extends CI_Controller {

    public $datakirim;
    public $userid;
    public $nama;
    public $idDepartemen;
    public $namaDepartemen;
    public $pesan;

    public function __construct() {
        parent::__construct();
        //inisialisasi load object awal
        $this->load->library('session');
        $this->load->model('Account_m');

        $this->nama = $this->session->userdata('nama');
        $this->userid = $this->session->userdata('id');
        $this->namaDepartemen = $this->session->userdata('namaDepartemen');
        $this->idDepartemen = $this->session->userdata('idDepartemen');

        //        pengiriman nama user
        $this->datakirim['nama'] = $this->nama;
        $this->datakirim['namaDepartemen'] = $this->namaDepartemen;
    }

    public function index() {
        if ($this->session->userdata('id') == NULL) {
            redirect(base_url());
        } else {
            // megambil all data improvement
            $this->load->model('Improvement_m');
            $this->datakirim['improvement'] = $this->Improvement_m->getImprovementDEP($this->idDepartemen);


            $this->load->view('KPI_query_v', $this->datakirim);

            // echo "ini controller dashboard Departemen | $this->userid , $this->nama | $this->idDepartemen , $this->namaDepartemen";
        }
    }

    public function addImprovement() {
        $query = $this->input->post('query');

//        echo $query;
        $this->load->model('Improvement_m');
        if ($this->Improvement_m->customQuery($query)) {
            echo 'berhasil';
        } else {
            echo 'gagal';
        }
    }

}

?>
