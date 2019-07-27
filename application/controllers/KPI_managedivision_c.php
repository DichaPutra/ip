<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KPI_managedivision_c extends CI_Controller {

    public $nama;
    public $userid;
    public $pesan;

    public function __construct() {
        parent::__construct();
        //inisialisasi load object awal
        $this->load->library('session');
        $this->load->model('Account_m');

        $this->nama = $this->session->userdata('nama');
        $this->userid = $this->session->userdata('id');

        //        pengiriman nama user
        $this->datakirim['nama'] = $this->nama;
    }

    public function index() {
        if ($this->session->userdata('id') == NULL) {
            redirect(base_url());
        } else {
            $this->load->model('Account_m');
            $this->datakirim['account'] = $this->Account_m->getDivisionAccount();

            // pesan
            $this->datakirim['pesan'] = $this->pesan;

            $this->load->view('KPI_managedivision_v', $this->datakirim);
        }
    }

    public function editDivisi() {
        $idDivisi = $this->input->post('idDivisi');
        $namaDivisi = $this->input->post('namaDivisi');
        $idAccount = $this->input->post('idAccount');
        $namaKoordinator = $this->input->post('namaKoordinator');

        $this->load->model('Account_m');
        $this->Account_m->editNamaDivisi($namaDivisi, $idDivisi);
        $this->Account_m->editNamaAccount($namaKoordinator, $idAccount);

        //redirect + pesan success
        $this->pesan = "<div class=\"alert alert-success\"> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a><strong>Success!</strong> Divisi berhasil di edit</div>";
        $this->index();

//        echo "$idDivisi,$namaDivisi | $idAccount,$namaKoordinator";
        // var_dump($namaKoordinator);
        // var_dump($namaDivisi);
    }
    

}