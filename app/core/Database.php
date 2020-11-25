<?php
// FILE DATABASE // CORE
// MENGATUR KONEKSI DATABASE
/////////////////////////

// MEMBUAT CLASS DATABASE 
class Database
{
    // DATABASE MENGGUNAKAN DRIVER PDO
    // PDO = PHP DATA OBBJECT
    // LEBIH FLEKSIBEL KETIKA INGIN TIDAK INGIN MENGGUNALKAN MYSQLI LAGI
    // DRIVER PDO LEBIH MUDAH DARI PADA DRIVER MYSQLI

    // BUAT PORPERTY DENGAN NILAI YANG BERADA DI CONFIG
    private $host = DB_HOST,
        $user = DB_USER,
        $pass = DB_PASS,
        $db_name = DB_NAME;
    // DBH = DATABASE HANDLER, UNTUK MENAMPUNG KONEKSI PADA DATABASE
    // STMT = STATMENT
    private $dbh, $stmt;

    // MEMBUAT METHOD CONSTRUCTOR, KETIKA MODEL DIPANGGIL LANGUN KONEK KE DB
    public function __construct()
    {
        // DSN = DATA SOURCE NAME, IDENTITAS SERVER KITA
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        $option = [
            // AGAR KONEKSI DATABASE TERUS TERJAGA => OPTIMASI
            PDO::ATTR_PERSISTENT => true,
            // ATRIBUT MODE ERROR  EXCEPTOP
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // CHECK KONEKSI //
        // COBA
        try {
            // BUAT OBJEK UNTUK PROPERTY DARI HANDLER DRIVE PDO
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
            // JIKA TERJADI ERROR TANGKAP PDO
        } catch (PDOException $e) {
            // HENTIKAN PROGRAM, KIRIM PESAN ERROR
            die($e->getMessage());
        }
    }

    // BUAT METHOD UNTUK MENAJALANKAN QUERY // METHOD DIBUAT GENERIC / FLEKSIBEL
    public function query($query)
    {
        // SBERI HANDLER LALU SIAPKAN
        $this->stmt = $this->dbh->prepare($query);
    }

    // SETELAH DI PERIAPKAN LAKUKAN BINDING
    // KARENA DI QUERY ADA PARAM(INSERT WHERE, SET, DLL)
    // TYPE BUKAN KITA YANG MENETUKAN TAPI APLIKASI
    public function bind($params, $value, $type = null)
    {
        // JIKA TYPENYA NULL
        if (is_null($type)) {
            // JALANKAN SWITCH
            switch (true) {
                    // JIKA VALUE INTERGER
                case is_int($value):
                    // ASSIGN TYPE 
                    // PDO PARAM INT (SCRIPT MENENTUKAN PARAMETER OOTMATIS)
                    $type = PDO::PARAM_INT;
                    break;
                    // JIKA VALUE BOOLEAN
                case is_bool($value):
                    // ASSIGN TYPE 
                    // PDO PARAM BOOL (SCRIPT MENENTUKAN PARAMETER OOTMATIS)
                    $type = PDO::PARAM_BOOL;
                    break;
                    // JIKA VALUE NULL
                case is_null($value):
                    // ASSIGN TYPE 
                    // PDO PARAM NULL (SCRIPT MENENTUKAN PARAMETER OOTMATIS)
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    // ASSIGN TYPE 
                    // PDO PARAM STR (SCRIPT MENENTUKAN PARAMETER OOTMATIS)
                    $type = PDO::PARAM_STR;
            }
        }

        // LAKUKAN BIND VALUE
        // BISA DIMASUKKAN PADA QUERY
        // DISARANKAN SEPERTI INI AGAR TERHINDAR SQL INJECTION
        $this->stmt->bindValue($params, $value, $type);
    }

    // METHOD EKSESKUSI
    public function execute()
    {
        // EKSEKUSI STATEMENT
        $this->stmt->execute();
    }

    // METHOD HASIL BANYAK DATA
    public function resultSet()
    {
        // PANGGIL EXECUTE
        $this->execute();
        // KEMBALIKAN NILAI STATEMENT FETCHALL
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // METHOD HASIL SATU DATA
    public function single()
    {
        // PANGGIL EXECUTE
        $this->execute();
        // KEMBALIKAN NILAI STATEMENT FETCH
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // MENGHITUNG ROW
    public function rowCount()
    {
        // KEMBALIKAN NILAI STATEMENT COUNT
        return $this->stmt->rowCount();
    }
}
