<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DIV_realizationScore_c extends CI_Controller {

    public $nama;
    public $userid;
    public $namaDivisi;
    public $idDivisi;
    public $pesan;

    public function __construct() {
        parent::__construct();
        //inisialisasi load object awal
        $this->load->library('session');
        $this->load->model('Account_m');

        $this->nama = $this->session->userdata('nama');
        $this->userid = $this->session->userdata('id');
        $this->namaDivisi = $this->session->userdata('namaDivisi');
        $this->idDivisi = $this->session->userdata('idDivisi');

        //        pengiriman nama user
        $this->datakirim['nama'] = $this->nama;
        $this->datakirim['namaDivisi'] = $this->namaDivisi;
    }

    public function index() {
        if ($this->session->userdata('id') == NULL) {
            redirect(base_url());
        } else {
            //set tahun menilai realisasi = tahun now - 1  (ini bakal berbeda beda tergantung menilai kapan divisnya be carefull
            $year = date('Y') - 1;

            // megambil all data improvement
            $this->load->model('Departemen_m');
            $this->datakirim['departemen'] = $this->Departemen_m->getDeptRealizationScore($this->idDivisi, $year);

            // pesan
            $this->datakirim['pesan'] = $this->pesan;

            //locking
            $this->load->model('Setting_m');
            $this->datakirim['setting2'] = $this->Setting_m->getSettingStats("2");

            //tahun header
            $this->datakirim['year'] = $year;

            $this->load->view('DIV_realizationScore_v', $this->datakirim);

            // echo "ini controller dashboard Divisi | $this->userid , $this->nama | $this->idDivisi , $this->namaDivisi";
        }
    }

    public function detailProgress($idDepartemen,$year) {
        $this->load->model('Improvement_m');
        $this->datakirim['improvement'] = $this->Improvement_m->getRealizationDiv($idDepartemen,$year);

        //kirim tahunn & dep ID untuk print
//        $year = date('Y');
        $this->datakirim['tahun'] = $year;
        $this->datakirim['iddepartemen'] = $idDepartemen;

        //daa to view
        $this->load->model('Departemen_m');
        $this->datakirim['departemen'] = $this->Departemen_m->getDepartemenByID($idDepartemen);
        $this->load->view('DIV_realizationscore_dp_v', $this->datakirim);
    }

    public function inputScore() {
        //set tahun menilai realisasi = tahun now - 1  (ini bakal berbeda beda tergantung menilai kapan divisnya be carefull
        $year = date('Y') - 1;


        $score = $this->input->post('score');
        $comments = $this->input->post('comments');
        $idDepartemen = $this->input->post('idDepartemen');
        // echo "iddepartemen = $idDepartemen | $score | $comments";

        $this->load->model('Realization_score_m');
        $this->Realization_score_m->insertScore($idDepartemen, $score, $comments, $year);

        $this->pesan = "<div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a> <strong>Success!</strong> Score berhasil ditambahkan</div>";

        $this->index();
    }

    public function editScore() {
        $score = $this->input->post('score');
        $idScore = $this->input->post('idScore');
        //        echo "scorenya = $score | idscore = $idScore";

        $this->load->model('Realization_score_m');
        $this->Realization_score_m->editScore($score, $idScore);

        $this->pesan = "<div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a> <strong>Success!</strong> Score berhasil diedit</div>";

        $this->index();
    }

    public function deleteScore($idScore) {
        $this->load->model('Realization_score_m');
        $this->Realization_score_m->deleteScore($idScore);

        $this->pesan = "<div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a> <strong>Success!</strong> Score berhasil dihapus</div>";

        $this->index();
    }

    public function cetakPDF($idDepartemen, $tahun) {
//        echo "$iddepartemen | $tahun";
        $this->load->library('fpdf');
        $this->load->model('Improvement_m');
        $this->load->model('Departemen_m');

        $namadepartemen = $this->Departemen_m->getDepartemenByID($idDepartemen);
        $improvement = $this->Improvement_m->getRealizationDiv($idDepartemen);


        $this->fpdf = new FPDF();
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial', 'B', 16);
        $this->fpdf->Image('dist/img/logopakerin.png', 8, 10, 40, 30, '', 'www.mpowerstaff.com');
        $this->fpdf->SetFont('Arial', 'B', 20);
        $this->fpdf->Cell(90);
        $this->fpdf->Cell(20, 10, 'PT PABRIK KERTAS INDONESIA', 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(90);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 13);
        $this->fpdf->Cell(90);
        $this->fpdf->Cell(20, 10, 'Bangun - Pungging - Mojokerto', 0, 0, 'C');

        $this->fpdf->Ln(4);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(90);
        $this->fpdf->Cell(20, 10, 'Tel. (0321) 5913779', 0, 0, 'C');

        $this->fpdf->Ln(5);
        $this->fpdf->Ln(5);
        $this->fpdf->Cell(20, 10, '_______________________________________________________________________________________________________________________________________________________', 0, 0, 'C');


        $this->fpdf->Ln(7);
        $this->fpdf->Cell(90);
        $this->fpdf->Ln(7);
        $this->fpdf->SetFont('Times', 'B', 20);
        $this->fpdf->Cell(90);
        $this->fpdf->Cell(20, 10, "$namadepartemen", 0, 0, 'C');

        $this->fpdf->Ln(4);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(90);
        $this->fpdf->SetFont('Times', 'B', 12);
        $this->fpdf->Cell(20, 10, "Realisasi Capaian Improvement Periode Th. $tahun", 0, 0, 'C');
        $this->fpdf->Ln(10);

        $no = 0;
        foreach ($improvement as $key) {
            $no++;
            $kodeimprovement = sprintf("%04s", $key->id) . "-" . sprintf("%03s", $key->Departemen_id) . "-" . $key->periode;

            if ($key->kendalaRealisasi == NULL) {
                $kendalarealisasi = "  -- Tidak Ada Kendala --  ";
            } else {
                $kendalarealisasi = $key->kendalaRealisasi;
            }

            $this->fpdf->Ln(14);
            $this->fpdf->SetFont('Times', 'B', 13);
            $this->fpdf->MultiCell(188, 6, "$no. [$kodeimprovement] $key->judul_improvement", 0);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Times', '', 11);
            $this->fpdf->MultiCell(188, 6, "$key->improvement", 0);

            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Times', 'B', 13);
            $this->fpdf->MultiCell(188, 6, " - Kendala Improvement : ", 0);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Times', '', 11);
            $this->fpdf->MultiCell(188, 6, "$kendalarealisasi", 0);


            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Times', 'B', 13);
            $this->fpdf->MultiCell(188, 6, " - Persentase Capaian :  $key->persentaseCapaian %", 0);
        }

        $this->fpdf->Output('I', "fileimprovement-$namadepartemen.pdf", false);
    }

}
