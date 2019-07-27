<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Pada class controller ini menampilkan Dashboard
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //inisialisasi load object awal
        $this->load->library('session');
        $this->load->model('Transaksi_m');
    }

// 1 ) MENAMPILKAN ALL DATA =================
    //menampilkan all data
    public function index() {
        if ($this->session->userdata('username') == NULL) {
            //bila session user kosong balik ke 'Welcome'
            redirect(base_url());
        } else {
            $datakirim['username'] = $this->session->userdata('username');
            $datakirim['trans'] = $this->Transaksi_m->read();
            $this->load->view('dashboard_v', $datakirim);
        }
    }

// 2 ) EDIT DATA ==========================
    //menampilkan form untuk edit data
    public function editForm($idtransaksi) {
        //value form untuk edit
        $datakirim['idtransaksi'] = $idtransaksi;

        $data = $this->Transaksi_m->readEdit($idtransaksi);
        $datakirim['barang'] = $data[0]['barang'];
        $datakirim['harga'] = $data[0]['harga'];
        $datakirim['username'] = $this->session->userdata('username');
        $datakirim['idakun'] = $this->session->userdata('idakun');

        $this->load->view('editform_v', $datakirim);
    }

    //fungsi untuk melakukan update ke database
    public function editData() {
        //ambil data dari form
        $idtransaksi = $this->input->post('idtransaksi');
        $barang = $this->input->post('barang');
        $harga = $this->input->post('harga');
        $pembeli = $this->input->post('pembeli');

        //update database
        $this->Transaksi_m->update($idtransaksi, $barang, $harga, $pembeli);

        //pesan sukses + redirect
        echo '<script>alert("Edit Data Berhasil");</script>';
        $this->index();
    }

// 3 ) DELETE DATA ===================
    public function deleteData($idtransaksi) {
        //delete data di database
        $this->Transaksi_m->delete($idtransaksi);
        echo '<script>alert("Delete Data Berhasil");</script>';
        $this->index();
    }

// 4) JSON GET ====================
    public function jsonGet() {
        // fungsi untuk pengambilan data dalam bentuk JSON
        $arr = $this->Transaksi_m->readArr();

        //add the header here
        header('Content-Type: application/json');
        echo json_encode($arr);
    }

// 5) Export Excel Data ================

    public function excelData() {
        /*         * *****EDIT LINES 3-8****** */
        $DB_Server = "localhost"; //MySQL Server    
        $DB_Username = "root"; //MySQL Username     
        $DB_Password = "";             //MySQL Password     
        $DB_DBName = "test";         //MySQL Database Name  
//        $DB_TBLName = "transaksi"; //MySQL Table Name   
        $filename = "datatransaksi";         //File Name

        /*         * *****YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE****** */
        //create MySQL connection   
        $sql = "SELECT a.idtransaksi, a.barang, a.harga, b.username as pembeli
            FROM transaksi a, akun b 
            WHERE a.pembeli = b.idakun";
        $Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
        //select database   
        $Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error() . "<br>" . mysql_errno());
        //execute query 
        $result = @mysql_query($sql, $Connect) or die("Couldn't execute query:<br>" . mysql_error() . "<br>" . mysql_errno());
        $file_ending = "xls";
        //header info for browser
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        /*         * *****Start of Formatting for Excel****** */
        //define separator (defines columns in excel & tabs in word)
        $sep = "\t"; //tabbed character
        //start of printing column names as names of MySQL fields
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
            echo mysql_field_name($result, $i) . "\t";
        }
        print("\n");
        //end of printing column names  
        //start while loop to get data
        while ($row = mysql_fetch_row($result)) {
            $schema_insert = "";
            for ($j = 0; $j < mysql_num_fields($result); $j++) {
                if (!isset($row[$j]))
                    $schema_insert .= "NULL" . $sep;
                elseif ($row[$j] != "")
                    $schema_insert .= "$row[$j]" . $sep;
                else
                    $schema_insert .= "" . $sep;
            }
            $schema_insert = str_replace($sep . "$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
        }
    }

}
