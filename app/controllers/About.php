<?php
// CONTROLLER ABOUT
/////////////////////
// SEMUA CONTROLLER YANG DIBUAT HARUS EXTENDS KE CLASS CONTROLLER PADA FOLDER CORE

// BUAT CLASS ABOUT EXTENDS KE CONTROLLER
class About extends Controller
{
    // METHOD INDEX
    public function index($nama = "Naufal Fadhil", $pekerjaan = "Mahasiswa", $umur = 19)
    {
        // ASSIGN PROP
        $data["nama"] = $nama;
        $data["pekerjaan"] = $pekerjaan;
        $data["umur"] = $umur;
        $data["judul"] = "About";
        // PANGGIL METHOD VIEW
        $this->view("templates/header", $data);
        $this->view("about/index", $data);
        $this->view("templates/footer");
    }

    // METHOD PAGE
    public function page()
    {
        // ASSIGN PROP
        $data["judul"] = "Page";
        // PANGGIL METHOD VIEW
        $this->view("templates/header", $data);
        $this->view("about/page");
        $this->view("templates/footer");
    }
}
