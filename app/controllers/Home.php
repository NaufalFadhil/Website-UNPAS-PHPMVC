<?php

// EXTENDS KE KELAS CORE
class Home extends Controller
{
    // JIKA TIDAK MENULISKAN APAPUN METHOD INI AKAN DIPANGGIL 
    public function index()
    {
        $data["judul"] = "Home";
        // PANGGIL MODEL AMBIL METHOD USER MASUKKAN KE DATA
        $data["nama"] = $this->model('User_model')->getUser();
        $this->view("templates/header", $data);
        $this->view('home/index', $data);
        $this->view("templates/footer");
    }
}
