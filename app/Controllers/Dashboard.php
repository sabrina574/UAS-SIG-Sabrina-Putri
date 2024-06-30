<?php

namespace App\Controllers;
// menghubungkan file controller dengan model kabupaten
use App\Models\KabupatenModel;
// inisialisasi model kecamatan dan apotik
use App\Models\KecamatanModel;
use App\Models\ApotikModel;

class Dashboard extends BaseController
{
    // method index otomatis dipanggil oleh controller
    public function index()
    {
        // inisiasi objek dari class KabupatenModel
        $kabupaten = new KabupatenModel();
        // ambil data dari tabel kabupaten
        // angka 1 mengacu pada data id_kabupaten di tabel kabupaten
        // artinya mencari data id_kabupaten = 1
        $data['kabupaten'] = $kabupaten->find(1);
        // menampilkan file views/dashboard.php di browser
        // mengirimkan data kabupaten melalui variabel $data
        // inisiasi object dari class apotikModel
        $ApotikModel = new ApotikModel();
        // mengambil semua data apotik
        $query = $ApotikModel->findAll();
        $marker = [];
        foreach ($query as $data_apotik) {
            list($latitude, $longitude) = explode(',', $data_apotik->koordinat);
            $marker[] = [
                'latitude' => (float) $latitude,
                'longitude' => (float) $longitude,
                'kode_pos' => $data_apotik->kode_pos,
                'nama_apotik' => $data_apotik->nama_apotik,
                'alamat_apotik' => $data_apotik->alamat_apotik
            ];
        }

        $data['marker'] = json_encode($marker);
        echo view('dashboard', $data);
    }
    // function untuk menampilkan data kecamatan
    public function getData(){
        $kecamatan = new KecamatanModel();
        $kode_kecamatan = $this->request->getGet('kode_kecamatan');
        $data = $kecamatan->find($kode_kecamatan);

        if(!empty($data)){
            $hasil = '<tr><td width="45%">Kode Kecamatan</td><td>:</td><td>'.$data->kode_kecamatan.'</td></tr>'.
                    '<tr><td>Nama Kecamatan</td><td>:</td><td>'.$data->nama_kecamatan.'</td></tr>'.
                    '<tr><td>Jumlah Penduduk</td><td>:</td><td>'.number_format($data->jumlah_penduduk,0,',','.').' Jiwa</td></tr>'.
                    '<tr><td>Luas Wilayah</td><td>:</td><td>'.number_format($data->luas_wilayah,0,',','.').' Km<sup>2</sup></td></tr>';
        }else{
            $hasil = '<tr><td class="text-center" colspan="3">DATA TIDAK ADA !</td></tr>';
        }

        $respon = ['hasil' => $hasil];

        return $this->response->setJSON($respon);
    }
}
