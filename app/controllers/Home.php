<?php
// CLASS HOME
////////////'/

// MEMBUAT CLASS HOME, WAJIB EXTENDS KE CLASS CONTROLLER
class Home extends Controller
{
    // JIKA TIDAK MENULISKAN APAPUN METHOD INI AKAN DIPANGGIL 
    public function index()
    {
        // ASSIGN PROP
        $data["judul"] = "Home";
        // PANGGIL MODEL AMBIL METHOD USER MASUKKAN KE DATA
        $data["nama"] = $this->model('User_model')->getUser();
        // PANGGIL METHOD VIEW
        $this->view("templates/header", $data);
        $this->view('home/index', $data);
        $this->view("templates/footer");
    }
}
