<?php
namespace App\Controllers;
use App\Models\KecamatanModel;
use App\Models\ApotikModel;

class Apotik extends BaseController{
    public function index(){
        $this->tampil(); // memanggil method tampil
    }

    public function tampil(){
        $apotik = new ApotikModel();
        $data['query'] = $apotik->select('apotik.*, kecamatan.nama_kecamatan AS kecamatan')
                                ->join('kecamatan', 'kecamatan.kode_kecamatan = apotik.kode_kecamatan')
                                ->findAll();
        $data['msg'] = session()->getFlashdata('msg');
        echo view('apotik/tampil', $data);
    }

    public function tambah(){
        $kecamatan = new KecamatanModel();
        $kecamatan = $kecamatan->findAll();
        $kecamatanOptions = array();
        //mempersiapkan variabel array
        $kecamatanOptions[''] = 'belum dipilih';
        // perulangan untuk menghasilkan option value di dropdown kecamatan
        foreach($kecamatan as $row){
            $kecamatanOptions[$row->kode_kecamatan] = strtoupper($row->nama_kecamatan);
        }
        // memanggil view form tambah
        $data['kecamatanOptions'] = $kecamatanOptions; // Jangan lupa tambahkan ini
        return view('apotik/tambah', $data);
    }

    public function edit($kode_pos){
        $kecamatan = new KecamatanModel();
        $kecamatan = $kecamatan->findAll();
        $kecamatanOptions = array();
        $kecamatanOptions[''] = 'belum dipilih';
        foreach($kecamatan as $row){
            $kecamatanOptions[$row->kode_kecamatan] = strtoupper($row->nama_kecamatan);
            }
            $data['kecamatanOptions'] = $kecamatanOptions;
            
                $apotik = new ApotikModel();
                $data['query'] = $apotik->find($kode_pos);
                $data['id'] = $kode_pos;
                return view('apotik/edit',$data);
        }

    public function simpan(){
        $apotik = new ApotikModel();
        // mengambil data dari masing-masing input pada form tambah
        // dan disimpan pada array untuk disimpan ke tabel apotik
        $data_apotik = [
            'kode_pos' => $this->request->getVar('kode_pos'),
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'), 
            'nama_apotik' => $this->request->getVar('nama_apotik'),
            'alamat_apotik' => $this->request->getVar('alamat_apotik'),
            'koordinat' => $this->request->getVar('koordinat')
        ];
        // menggunakan query builder insert 
        // untuk menyimpan ke tabel apotik
        $apotik->insert($data_apotik);
        // method affectedRows() mengembalikan nilai 1 
        // jika insert berhasil, nilai 0 jika gagal
        if($apotik->affectedRows() > 0){
            // persiapkan pesan jika insert berhasil
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil disimpan!</div>';
        } else {
            // persiapkan pesan jika insert gagal
            $msg = '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>';
        }
        // mengirimkan nilai msg melalui flashdata
        // flashdata adalah session sekali pakai
        session()->setFlashdata('msg', $msg);
        // memanggil index pada controller apotik
        // tujuannya agar setelah simpan, tampilan kembali ke tabel crud
        return redirect()->to('apotik');
    }

    public function update(){
        $apotik = new ApotikModel();
        //mengambil input hidden id dari form edit
        $id = $this->request->getVar('id');
        $data_apotik = [
            'kode_pos' =>$this->request->getVar('kode_pos'),
            'kode_kecamatan' =>$this->request->getVar('kode_kecamatan'),
            'nama_apotik' =>$this->request->getVar('nama_apotik'),
            'alamat_apotik' =>$this->request->getVar('alamat_apotik'),
            'koordinat' =>$this->request->getVar('koordinat')
        ];
        // menggunakan query builder update
        // untuk mengubah data di tabel apotik
        // berdasarkan id (kode apotik)
        $apotik->update($id,$data_apotik);
        if($apotik->affectedRows() > 0){
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil disimpan!</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>';
        }
        session()->setFlashdata('msg', $msg);
        return redirect()->to('apotik');
    }

    public function hapus($kode_pos){
        $apotik = new ApotikModel();
        // menggunakan query builder delete
        // untuk menghapus data di tabel apotik
        // sesuai kode_apotik
        $apotik->delete(['kode_pos' => $kode_pos]);
        if($apotik->affectedRows() > 0){
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil dihapus!</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>';
        }
        session()->setFlashdata('msg', $msg);
        return redirect()->to('apotik');
    }
}
?>
