<?php
// ICORE CONTROLLER
// MENGKONTROL ARAH TUJUAN WEB
//////////////////////////////

// BUAT CLASS
class Controller
{
    // MEMBUAT METHOD
    public function view($view, $data = [])
    {
        // MENGAMBIL FILE VIEW
        require_once '../app/views/' . $view . '.php';
    }

    // MEMBUAT METHOD
    public function model($model)
    {
        // MENGAMBIL FILE MODELS
        require_once '../app/models/' . $model . '.php';
        // KARENA KELAS LAKUKAN INSTANSIASI
        return new $model;
    }
}
