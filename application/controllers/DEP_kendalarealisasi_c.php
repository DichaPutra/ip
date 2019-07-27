<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DEP_kendalarealisasi_c extends CI_Controller {

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
            $this->datakirim['improvement'] = $this->Improvement_m->getImprovementKendalaDEP($this->idDepartemen);

            //kirim tahunn & dep ID untuk print
            $year = date('Y');
            $this->datakirim['tahun'] = $year;
            $this->datakirim['iddepartemen'] = $this->idDepartemen;

            // pesan
            $this->datakirim['pesan'] = $this->pesan;

            $this->load->view('DEP_kendalarealisasi_v', $this->datakirim);

            // echo "ini controller dashboard Departemen | $this->userid , $this->nama | $this->idDepartemen , $this->namaDepartemen";
        }
    }

    public function editKendala() {
        //mengambil data dari form
        $idImprovement = $this->input->post('idImprovement');
        $editanKendala = $this->input->post('editanKendala');

        //update database
        $this->load->model('Improvement_m');
        $this->Improvement_m->editKendala($idImprovement, $editanKendala);

        //redirect + pesan success
        $this->pesan = "<div class=\"alert alert-success\"> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a><strong>Success!</strong> Kendala berhasil diedit</div>";
        $this->index();
    }

    public function addKendala() {
        //mengambil data dari form
        $idImprovement = $this->input->post('idImprovement');
        $kendala = $this->input->post('kendala');


        //update database
        $this->load->model('Improvement_m');
        $this->Improvement_m->addKendala($idImprovement, $kendala);

        //redirect + pesan success
        $this->pesan = "<div class=\"alert alert-success\"> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a><strong>Success!</strong> Kendala berhasil ditambahkan</div>";
        $this->index();
    }

    public function deleteKendala($idImprovement) {
        // update database
        $this->load->model('Improvement_m');
        $this->Improvement_m->nullifiedKendala($idImprovement);

        //redirect + pesan success
        $this->pesan = "<div class=\"alert alert-success\"> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a><strong>Success!</strong> Kendala berhasil dihapus</div>";
        $this->index();
    }

    public function cetakPDF($idDepartemen, $tahun) {
//        echo "$iddepartemen | $tahun";
        $this->load->library('fpdf');
        $this->load->model('Improvement_m');
        $this->load->model('Departemen_m');

        $namadepartemen = $this->Departemen_m->getDepartemenByID($idDepartemen);
        $improvement = $this->Improvement_m->getRealizationKPI($idDepartemen, $tahun);

        

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