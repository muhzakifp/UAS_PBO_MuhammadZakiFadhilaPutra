<?php

require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    private $tunjanganKesehatan;
    private $opsiSahamId;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $tunjanganKesehatan, $opsiSahamId) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    public static function getData() {
        return "WHERE jenis_karyawan = 'Tetap'";
    }

    #[Override]
    public function hitungGajiBersih(){
        $gajiBersih = ($this->hariKerjaMasuk*$this->gajiDasarPerhari) + $this->tunjanganKesehatan;
        return $gajiBersih;
    }

    #[Override]
    public function tampilkanProfilKaryawan(){
        return "ID: #EMP-" . $this->getIdKaryawan() . " | " .
               "Nama: " . $this->getNamaKaryawan() . " | " .
               "Dept: " . $this->getDepartemen() . " | " .
               "Kehadiran: " . $this->getHariKerjaMasuk() . " Hari | " .
               "Gaji Harian: Rp " . number_format($this->getGajiDasarPerHari(), 0, ',', '.') . " | " .
               "Tunjangan Medis: Rp " . number_format($this->tunjanganKesehatan, 0, ',', '.') . " | " .
               "Opsi Saham ID: " . $this->opsiSahamId;
    }
}
?>