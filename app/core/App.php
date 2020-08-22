<?php

class App
{
    // MEMBUAT PRPOERT PADA CLASS (APP)
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // ASIGN KE ROOTING
        $url = $this->parseURL();
        // var_dump($url);

        // JIKA ADA CONTROLLER / FILE YANG TERSEDIA
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            // UBAH NILAI PROPERTY KE CONTROLLER (URL INDEX KE 0)
            $this->controller = $url[0];
            // HAPUS CONTROLLER (URL INDEX KE 0)
            unset($url[0]);
        }

        // PANGIL CONTROLLERS
        require_once '../app/controllers/' . $this->controller . '.php';
        // INSTANSIASI CLASS UNTUK MEMANGGIL METHOD
        $this->controller = new $this->controller;

        // PANGGIL MWTHOD
        // JIKA ADA METHOD (INDEX 1 DI URL)
        if (isset($url[1])) {
            // JIKA METHOD ADA, AMBIL OBJEK DAN METHOD (INDEX KE 1 URL)
            if (method_exists($this->controller, $url[1])) {
                // JUBAH NILAI PROPERTY KE METHOD (INDEX KE 1 URL)
                $this->method = $url[1];
                // HILANGKAN METHOD
                unset($url[1]);
            }
        }

        // PANGGIL PARAMATER
        if (!empty($url)) {
            // AMBIL DATA ARRAY
            $this->params = array_values($url);
        }

        // JALANKAN CONTROLLER & MEYHOD. SERTA KIRIMKAN PARAMS JIKA ADA
        // call_user_func_array($function, param_Array)
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // MELAKUKAN ROOTING
    public function parseURL()
    {
        // JIKA TERSEDIA DIDALAM URL 
        if (isset($_GET['url'])) {
            // AMBIL URL DAN HILANGAN SLASH
            $url = rtrim($_GET['url'], '/');
            // MEMBERSIHKAN DARI KARAKTER2 NGACO, YANG MEMUNGKINKAN HACK
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // PECAH BERDASARKAN SLAH 
            $url = explode('/', $url);
            // KEMBALIKAN NILAI 
            return $url;
        }
    }
}
