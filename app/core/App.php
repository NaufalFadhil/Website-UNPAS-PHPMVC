<?php
// CORE APP
///////////

// MEMBUAT CLASS APP
class App
{
    // MEMBUAT PRPOERT PADA CLASS (APP)
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    // MEMBUAT CONSTRUCTOR
    public function __construct()
    {
        // ASIGN KE ROOTING
        // AMBIL URL DAN TARUH PADA VAR
        $url = $this->parseURL();

        // PANGGIL CONTROLLER
        // JIKA ADA FILE YANG TERSEDIA PADA FOLDER CONTROLLER, JIKA TIDAK ADA TAMPIL HOME
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            // UBAH PROP CONTROLLER MENJADI URL YANG TERSEDIA (URL IDX 0)
            $this->controller = $url[0];
            // HAPUS URL IDX 0 YANG DIAMBIL KARENA UDAH DI UBAH
            unset($url[0]);
        }

        // PANGIL FILE PROP CONTROLLERS YANG DIAMBIL
        require_once '../app/controllers/' . $this->controller . '.php';
        // BUAT OBJEK BARU DENFGAN INSTANSIASI CLASS UNTUK MEMANGGIL METHOD
        // MELAKUKAN INSTANSIASI AGAR BISA MEMANGGIL METHOD
        $this->controller = new $this->controller;

        // PANGGIL METHOD
        // JIKA ADA METHOD (URL IDX 1)
        if (isset($url[1])) {
            // JIKA METHOD ADA, AMBIL OBJEK DAN METHOD (URL IDX 1)
            if (method_exists($this->controller, $url[1])) {
                // UBAH NILAI PROP MENJADI METHOD (URL IDX 1)
                $this->method = $url[1];
                // HILANGKAN METHOD KARENA GA KEPAKE LAGI
                unset($url[1]);
            }
        }

        // PANGGIL PARAMATER
        // JIKA PROPERTY MASIH ADA
        if (!empty($url)) {
            // AMBIL SEMUA NILAI MASUKKAN PADA ARRAY LALU UBAH NILAI PROP PARAMS
            $this->params = array_values($url);
        }

        // JALANKAN CONTROLLER & METHOD. SERTA KIRIMKAN PARAMS JIKA ADA
        // call_user_func_array($function, param_Array)
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // MELAKUKAN ROOTING //
    public function parseURL()
    {
        // LAKUKAN HTACCESS
        // FILE YANG DAPAT DIGUNAKAN UNTUK MEMODIFIKASI FILE APACHE, DILAKUKAN PER FOLDER
        // BERFUNGI UNTUK MEMBATASI PENGGUNA AGAR TIDAK MASUK KE FOLDER SELAIN PUBLIC

        // JIKA ADA URL YANG DIKIRIMKAN
        if (isset($_GET['url'])) {
            // MEMECAH STRING MENJADI ARRAY //
            // AMBIL URL DAN MENGHAOUS SLASH DI AKHIR URL
            $url = rtrim($_GET['url'], '/');
            // MEMBERSIHKAN DARI KARAKTER2 NGACO, YANG MEMUNGKINKAN HACK
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // PECAH URL MENJADI ARRAY DENGAN DELIMITER SLASH 
            $url = explode('/', $url);
            // KEMBALIKAN NILAI 
            return $url;
        }
    }
}
