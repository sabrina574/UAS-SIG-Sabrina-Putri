<?php
echo view('header');
echo view('sidebar');
?>
<main class="col-10 ms-sm-auto px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-itemscenter pt-3 pb-2">
        <h1 class="h4">Tambah Data apotik</h1>
    </div>
    <?php echo form_open('simpanapotik') ?>
    <div class="row">
        <div class="col-4">
            <div class="mb-3">
                <label class="form-label">Kecamatan</label>
                <?php
                echo form_dropdown(
                    'kode_kecamatan',
                    $kecamatanOptions,
                    '',
                    'class="form-control"'
                ); ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Kode Pos</label>
                <?php
                $kode_pos = [
                    'name' => 'kode_pos',
                    'type' => 'number',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Masukkan Kode Pos',
                    'required' => 'required'
                ];
                echo form_input($kode_pos); ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama apotik</label>
                <?php
                $nama_apotik = [
                    'name' => 'nama_apotik',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Masukkan Nama apotik',
                    'required' => 'required'
                ];
                echo form_input($nama_apotik);
                ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat apotik</label>
                <?php
                $alamat_apotik = [
                    'name' => 'alamat_apotik',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Masukkan Alamat apotik',
                    'required' => 'required'
                ];
                echo form_input($alamat_apotik);
                ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Koordinat apotik</label>
                <?php
                $koordinat = [
                    'name' => 'koordinat',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Contoh : -7.5134,109.0702',
                    'required' => 'required'
                ];
                echo form_input($koordinat);
                ?>
            </div>
            <div>
                <?php
                $simpan = [
                    'type' => 'submit',
                    'content' => 'Simpan',
                    'class' => 'btn btn-primary'
                ];
                echo form_button($simpan);
                echo anchor('kecamatan', 'Batal', ['class' => 'btn btn-danger']);
                ?>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</main>
<?php echo view('footer'); ?>