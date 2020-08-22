<?php

// INI KELAS CONTROLLER UTAMA
class Controller
{
    // MEMANGGIL VIEW
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        // MENGAMBIL FILE MODELS
        require_once '../app/models/' . $model . '.php';
        // KARENA KELAS LAKUKAN INSTANCE
        return new $model;
    }
}
