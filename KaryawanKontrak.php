<?php

require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    private $durasiKontrakBulan;
    private $agensiPenyalur;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $durasiKontrakBulan, $agensiPenyalur) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->agensiPenyalur = $agensiPenyalur;
    }

    public static function getData() {
        return "WHERE jenis_karyawan = 'Kontrak'";
    }

    #[Override]
    public function hitungGajiBersih(){
       $gajiBersih = $this->hariKerjaMasuk*$this->gajiDasarPerhari;
       return $gajiBersih;
    }

    #[Override]
    public function tampilkanProfilKaryawan(){
        return "ID: EMP-" . $this->getIdKaryawan() . " | " .
            "Nama: " . $this->getNamaKaryawan() . " | " .
            "Dept: " . $this->getDepartemen() . " | " .
            "Kehadiran: " . $this->getHariKerjaMasuk() . " Hari | " .
            "Gaji Harian: Rp " . number_format($this->getGajiDasarPerHari(), 0, ',', '.') . " | " .
            "Durasi Kontrak: " . $this->durasiKontrakBulan . " Bulan | " .
            "Agensi: " . $this->agensiPenyalur; // Ditutup dengan rapi menggunakan titik koma (;)
}

}
?>