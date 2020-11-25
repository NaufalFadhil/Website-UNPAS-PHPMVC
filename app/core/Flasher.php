<?php
// INI CLASS FLASHER // CORE
// MENGATUR TAMPILAN SEKILAS
////////////////////////////

// BUAT CLASS
class Flasher
{
    // BUAT METHOD STATIC
    // AGAR MEMANGGIL METHOD TANPA MELAKUKAN INSTANSIASI
    public static function setFlash($pesan, $aksi, $tipe)
    {
        // SET SESSION YANG DIBERI NAMA FLASH, LALU ISI MENGGUNAKAN ARRAY
        $_SESSION['flash'] = [
            // ISI ARRAY MENGGUNAKAN ARGUMEN PARAMETER
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    // BUAT METHOD FLASH
    // UNTUK MENAMPILKAN PESANNYA
    public static function flash()
    {
        // CHECK ADAKAH SESSION FLASH, JIKA ADA
        // JANGAN LUPA JALANKNA SESSION PADA HAL INDEX
        if (isset($_SESSION['flash'])) {
            // TAMPILKAN WARNING
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
                Data Mahasiswa <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            // SETELAH DITAMPILKAN HAPUS SESSION, BERLAKU 1x
            unset($_SESSION['flash']);
        }
    }
}
