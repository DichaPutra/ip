<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DEP_rencanaimprovement_c extends CI_Controller {

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

            //locking
            $this->load->model('Setting_m');
            $this->datakirim['setting4'] = $this->Setting_m->getSettingStats("4");

            //kirim tahunn & dep ID untuk print
            $year = date('Y') + 1;
            $this->datakirim['tahun'] = $year;
            $this->datakirim['iddepartemen'] = $this->idDepartemen;



            // pesan
            $this->datakirim['pesan'] = $this->pesan;

            $this->load->view('DEP_rencanaimprovement_v', $this->datakirim);

            // echo "ini controller dashboard Departemen | $this->userid , $this->nama | $this->idDepartemen , $this->namaDepartemen";
        }
    }

    public function editImprovement() {
        $editanjudul = htmlspecialchars($this->input->post('juduledit'));
        $editan = htmlspecialchars($this->input->post('editan'));
        $idImprovement = $this->input->post('idImprovement');

        $this->load->model('Improvement_m');
        $this->Improvement_m->editImprovementDEP($idImprovement, $editanjudul, $editan);

        $this->pesan = "<div class=\"alert alert-success\"> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a><strong>Success!</strong> Improvement Berhasil diedit</div>";

        $this->index();
    }

    public function addImprovement() {
        $jdl_improvement = htmlspecialchars($this->input->post('jdl_improvement'));
        $improvement = htmlspecialchars($this->input->post('improvement'));

//        echo "judul = $jdl_improvement | imrovement = $improvement";
        $this->load->model('Improvement_m');
        $this->Improvement_m->addImprovementDEP($jdl_improvement, $improvement, $this->idDepartemen);

        $this->pesan = "<div class=\"alert alert-success\"> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a><strong>Success!</strong> Improvement Berhasil ditambahkan</div>";

        $this->index();
    }

    public function deleteImprovement($idImprovement) {
        $this->load->model('Improvement_m');
        $this->Improvement_m->deleteImprovementDEP($idImprovement);

//        echo "yang di delete improvement dengan id = $idImprovement";

        $this->pesan = "<div class=\"alert alert-success\"> <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">×</a><strong>Success!</strong> Improvement Berhasil dihapus</div>";

        $this->index();
    }

    public function cetakPDF($idDepartemen, $tahun) {
        $this->load->library('fpdf');
        $this->load->model('Improvement_m');
        $this->load->model('Departemen_m');

        $namadepartemen = $this->Departemen_m->getDepartemenByID($idDepartemen);
        $improvement = $this->Improvement_m->getImprovementKPI($idDepartemen, $tahun);


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
        $this->fpdf->Cell(20, 10, "Improvement List Periode Th. $tahun", 0, 0, 'C');
        $this->fpdf->Ln(10);

        $no = 0;
        foreach ($improvement as $key) {
            $no++;
            $kodeimprovement = sprintf("%04s", $key->id) . "-" . sprintf("%03s", $key->Departemen_id) . "-" . $key->periode;

            $this->fpdf->Ln(12);
            $this->fpdf->SetFont('Times', 'B', 13);
            $this->fpdf->MultiCell(188, 6, "$no. [$kodeimprovement] $key->judul_improvement", 0);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Times', '', 11);
            $this->fpdf->MultiCell(188, 6, "$key->improvement", 0);
        }

        $this->fpdf->Output('I', "fileimprovement-$namadepartemen.pdf", false);
    }

}

?>
