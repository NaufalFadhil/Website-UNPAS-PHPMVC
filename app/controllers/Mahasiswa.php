<?php
// CONTROLLER MAHASISWA
///////////////////////

// BUAT CLASS WAJIB EXTENDS KE CONTROLLER
class Mahasiswa extends Controller
{
    // BUAT METHOD INDEX
    public function index()
    {
        // ASSIGN PROP
        $data['judul'] = 'Daftar Mahasiswa';
        // PANGGIL METHOD GET ALL DI DALAM METHOD MODEL LALU ASSIGN SEBAGA DATA
        $data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
        // PANGGIL METHOD VIEW
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    // BUAT METHOD DETAIL
    public function detail($id)
    {
        // ASSIGN PROP
        $data['judul'] = 'Detail Mahasiswa';
        // PANGGIL METHOD GET ID DI DALAM METHOD MODEL LALU ASSIGN SEBAGA DATA
        $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);
        // PANGGIL METHOD VIEW
        $this->view('templates/header', $data);
        $this->view('mahasiswa/detail', $data);
        $this->view('templates/footer');
    }

    // BUAT METHOD TAMBAH
    public function tambah()
    {
        // JIKA METHOD TAMBAH DATA PADA METHOD MODEL BERNILAI LEBIH DARI NOL
        if ($this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0) {
            // PANGGIL CLASS FLASHER DAN AMBIL METHOD ISIKAN PARAMETER
            Flasher::setFlash('Berhasil', 'Ditambah', 'success');
            // UBAH LOKASI
            header('Location: ' . BASEURL . '/mahasiswa');
            // KELUAR METHOD
            exit;
        } else {
            // PANGGIL CLASS FLASHER DAN AMBIL METHOD ISIKAN PARAMETER
            Flasher::setFlash('Gagal', 'Ditambah', 'danger');
            // UBAH LOKASI
            header('Location: ' . BASEURL . '/mahasiswa');
            // KELUAR METHOD
            exit;
        }
    }

    // BUAT METHOD HAPUS
    public function hapus($id)
    {
        // JIKA METHOD HAPUS DATA PADA METHOD MODEL BERNILAI LEBIH DARI NOL
        if ($this->model('Mahasiswa_model')->hapusDataMahasiswa($id) > 0) {
            // PANGGIL CLASS FLASHER DAN AMBIL METHOD ISIKAN PARAMETER
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            // UBAH LOKASI
            header('Location: ' . BASEURL . '/mahasiswa');
            // KELUAR METHOD
            exit;
        } else {
            // PANGGIL CLASS FLASHER DAN AMBIL METHOD ISIKAN PARAMETER
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            // UBAH LOKASI
            header('Location: ' . BASEURL . '/mahasiswa');
            // KELUAR METHOD
            exit;
        }
    }

    // BUAT METHOD AMBIL UBAH
    public function getUbah()
    {
        // AMBIL METHOD ID MAHASISWA PADA METHOD MODEL
        // UBAH DATA DARI ASSOSIATIF KE JSON, LALU TAMPILKAN
        echo json_encode($this->model('Mahasiswa_model')->getMahasiswaById($_POST['id']));
    }

    // BUAT METHOD UBAH
    public function ubah()
    {
        // JIKA METHOD UBAH DATA PADA METHOD MODEL BERNILAI LEBIH DARI NOL
        if ($this->model('Mahasiswa_model')->ubahDataMahasiswa($_POST) > 0) {
            // PANGGIL CLASS FLASHER DAN AMBIL METHOD ISIKAN PARAMETER
            Flasher::setFlash('Berhasil', 'Diubah', 'success');
            // UBAH LOKASI
            header('Location: ' . BASEURL . '/mahasiswa');
            // KELUAR METHOD
            exit;
        } else {
            // PANGGIL CLASS FLASHER DAN AMBIL METHOD ISIKAN PARAMETER
            Flasher::setFlash('Gagal', 'Diubah', 'danger');
            // UBAH LOKASI
            header('Location: ' . BASEURL . '/mahasiswa');
            // KELUAR METHOD
            exit;
        }
    }

    // BUAT METHOD CARI
    public function cari()
    {
        // ASSIGN PROOP
        $data['judul'] = 'Daftar Mahasiswa';
        // PANGGIL METHOD CAR DI DALAM METHOD MODEL LALU ASSIGN SEBAGA DATA
        $data['mhs'] = $this->model('Mahasiswa_model')->cariDataMahasiswa();
        // PANGGIL METHOD VIEW
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }
}
