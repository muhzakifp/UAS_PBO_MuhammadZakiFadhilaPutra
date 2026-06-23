<?php

require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    private $uangSakuBulanan;
    private $sertifikatKampusMerdeka;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $uangSakuBulanan, $sertifikatKampusMerdeka) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikatKampusMerdeka = $sertifikatKampusMerdeka;
    }

    public static function getData() {
        return "WHERE jenis_karyawan = 'Magang'";
    }

    #[Override]
    public function hitungGajiBersih(){
       $gajiBersih = ($this->hariKerjaMasuk*$this->gajiDasarPerhari) * 0.80;
       return $gajiBersih;
    }

    #[Override]
    public function tampilkanProfilKaryawan(){
        return "ID: #EMP-" . $this->getIdKaryawan() . " | " .
               "Nama: " . $this->getNamaKaryawan() . " | " .
               "Dept: " . $this->getDepartemen() . " | " .
               "Kehadiran: " . $this->getHariKerjaMasuk() . " Hari | " .
               "Uang Harian Pokok: Rp " . number_format($this->getGajiDasarPerHari(), 0, ',', '.') . " | " .
               "Uang Saku Tambahan: Rp " . number_format($this->uangSakuBulanan, 0, ',', '.') . " | " .
               "Program: " . $this->sertifikatKampusMerdeka;
    }
}
?>