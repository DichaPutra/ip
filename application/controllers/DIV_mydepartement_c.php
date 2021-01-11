<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DIV_mydepartement_c extends CI_Controller {

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
            // megambil all data improvement
            $this->load->model('Departemen_m');
            $this->datakirim['departemen'] = $this->Departemen_m->getDepartemenBawahanDivisi($this->idDivisi);
            // pesan
            $this->datakirim['pesan'] = $this->pesan;

            $this->load->view('DIV_departmentsRealization_v', $this->datakirim);
        }
    }

    public function inputProgress($idDepartemen) {
        $year = date('Y');
        $this->load->model('Departemen_m');
        $this->datakirim['departemen'] = $this->Departemen_m->getDepartemenByID($idDepartemen);
        $this->datakirim['idDepartemen'] = $idDepartemen;

        $this->load->model('Improvement_m');
        $this->datakirim['improvement'] = $this->Improvement_m->getRealizationDiv($idDepartemen,$year);

        //untuk parameter print
        $year = date('Y');
        $this->datakirim['tahun'] = $year;
        $this->datakirim['iddepartemen'] = $idDepartemen;

        //locking
        $this->load->model('Setting_m');
        $this->datakirim['setting3'] = $this->Setting_m->getSettingStats("3");


        $this->datakirim['pesan'] = $this->pesan;

        $this->load->view('DIV_departmentsRealization_ip_v', $this->datakirim);
    }

    public function inputProgress2() {
        $idImprovement = $this->input->post('idImprovement');
        $persentase = $this->input->post('persentase');
        $idDepartemen = $this->input->post('idDepartemen');
        //echo "idImprovemen = $idImprovement | persntase = $persentase | idDepartemen = $idDepartemen";


        $this->load->model('Improvement_m');
        $persentaselama = $this->Improvement_m->getPersentase($idImprovement);

        if ($persentaselama[0]['persentaseCapaian'] >= $persentase) {
            $this->pesan = "<div class=\"alert alert-danger fade in alert-dismissable\"> 
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a>
            <strong>Error!</strong> tidak dapat memasukkan nilai progress lebih kecil dariada sebelumnya
            </div>";
            $this->inputProgress($idDepartemen);
        } elseif ($persentase == 100) {
            $this->pesan = "<div class=\"alert alert-warning fade in alert-dismissable\"> 
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a>
            
            <strong>Perhatian!</strong> anda menginput 100% pada capaian. Apakah improvement ini benar-benar selesai ?  <br>(progress dengan capaian 100% tidak dapat diubah lagi) <br><br>
            <button class=\"btn btn-default\" data-dismiss=\"alert\">Cancel</button>
            <a href =\"".base_url()."index.php/DIV_mydepartement_c/inputProgressSeratusPersen/$idImprovement/$idDepartemen\"><button class=\"btn btn-primary\"> OK </button>
            </div>";
            $this->inputProgress($idDepartemen);
        } else {
            $this->Improvement_m->editProgress($idImprovement, $persentase);

            //redirect + pesan success

            $this->pesan = "<div class=\"alert alert-success fade in alert-dismissable\"> 
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a>
            <strong>Success!</strong> Progress berhasil di inputkan
            </div>";
            $this->inputProgress($idDepartemen);
        }
    }

    public function inputProgressSeratusPersen($idImprovement, $idDepartemen) {
        $persentase = 100;

        $this->load->model('Improvement_m');
        $this->Improvement_m->editProgress($idImprovement, $persentase);

        //redirect + pesan success

        $this->pesan = "<div class=\"alert alert-success fade in alert-dismissable\"> 
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a>
            <strong>Success!</strong> Progress berhasil di inputkan
            </div>";
        $this->inputProgress($idDepartemen);
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