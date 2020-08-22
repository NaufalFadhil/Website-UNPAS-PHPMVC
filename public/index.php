<?php
// JIKA TIDAK ADA SESSION JALANKAN SESSION
if (!session_id()) session_start();

// MELAKUKAN TEKNIK BOOTSTRAPING
require_once '../app/init.php';

// BUAT OBJEK DENGAN INSTANSIASI KELAS APP
$app = new App();
