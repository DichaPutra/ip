<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KPI_locking_c extends CI_Controller {

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
            $this->load->model('Setting_m');
            // AMBIL NILAI ON / OFF
            //toggle setting input nilai improvment
            $this->datakirim['setting1'] = $this->Setting_m->getSettingStats("1");

            //toggle setting input nilai realisasi
            $this->datakirim['setting2'] = $this->Setting_m->getSettingStats("2");

            //toggle setting input nilai capaian
            $this->datakirim['setting3'] = $this->Setting_m->getSettingStats("3");

            //toggle setting input improvement
            $this->datakirim['setting4'] = $this->Setting_m->getSettingStats("4");


            $this->load->view('KPI_setting_v', $this->datakirim);
        }
    }

    public function turnON($idSetting) {
        $this->load->model('Setting_m');
        $this->Setting_m->turnON($idSetting);
        $this->index();
    }

    public function turnOFF($idSetting) {
        $this->load->model('Setting_m');
        $this->Setting_m->turnOFF($idSetting);
        $this->index();
    }

}