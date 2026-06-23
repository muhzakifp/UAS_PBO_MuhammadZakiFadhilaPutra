<?php
class Koneksi {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_uas_pbo_trpl1b_muhammadzakifp"; 
    protected $koneksi;

    public function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        
        if (mysqli_connect_errno()) {            die("Koneksi database gagal: " . mysqli_connect_error());
        }
        //echo "Koneksi terhubung";
    }
}

$konek = new Koneksi();
?>