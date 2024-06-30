<?php 
// Memanggil file view header dan sidebar
echo view('header');
echo view('sidebar');
?>
<main class="col-10 ms-sm-auto px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h1 class="h4">Edit Data Apotik</h1>
    </div>
    
    <!-- Form untuk mengedit data apotik -->
    <?php echo form_open('updateapotik') ?>
    
    <div class="row">
        <div class="col-4">
            <div class="mb-3">
                <label class="form-label">Kecamatan</label>
                <?php 
                // Hidden input untuk ID
                echo form_hidden('id', $id);
                // Dropdown untuk memilih kecamatan
                echo form_dropdown('kode_kecamatan', $kecamatanOptions, $query->kode_kecamatan, 'class="form-control"');
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Kode POS</label>
                <?php 
                // Input untuk Kode Apotik
                $kode_pos = [
                    'name' => 'kode_pos',
                    'type' => 'number',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Masukkan Kode Apotik',
                    'required' => 'required',
                    'value' => $query->kode_pos
                ];
                echo form_input($kode_pos);
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Apotik</label>
                <?php 
                // Input untuk Nama Apotik
                $nama_apotik = [
                    'name' => 'nama_apotik',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Masukkan Nama apotik',
                    'required' => 'required',
                    'value' => $query->nama_apotik
                ];
                echo form_input($nama_apotik);
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat Apotik</label>
                <?php 
                // Input untuk Alamat Apotik
                $alamat_apotik = [
                    'name' => 'alamat_apotik',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Masukkan apotik ',
                    'required' => 'required',
                    'value' => $query->alamat_apotik
                ];
                echo form_input($alamat_apotik);
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Koordinat Apotik</label>
                <?php 
                // Input untuk Koordinat Apotik
                $koordinat = [
                    'name' => 'koordinat',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Contoh : -7.5134,109.0702',
                    'required' => 'required',
                    'value' => $query->koordinat
                ];
                echo form_input($koordinat);
                ?>
            </div>
            <div>
                <?php 
                // Tombol submit untuk menyimpan perubahan
                $simpan = [
                    'type' => 'submit',
                    'content' => 'Simpan',
                    'class' => 'btn btn-primary'
                ];
                echo form_button($simpan);
                // Link untuk membatalkan perubahan
                echo anchor('apotik', 'Batal', ['class' => 'btn btn-danger']);
                ?>
            </div>
        </div>
    </div>
    
    <?php echo form_close(); ?>
</main>
<?php 
// Memanggil file view footer
echo view('footer'); 
?>
