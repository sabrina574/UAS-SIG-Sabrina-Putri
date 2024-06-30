<?php echo view('header'); ?>
<?php echo view('sidebar'); ?>

<main class="col-10 ms-sm-auto px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h1 class="h4">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-9 d-flex">
            <div id="map" class="flex-grow" style="width: 1200px; height: 750px;"></div>
            <script type="text/javascript" src="<?php echo 'public/uploads/' . $kabupaten->kode_kabupaten . '.json'; ?>"></script>
            <script>
                // AJAX function untuk mengambil data per kecamatan
                function getData(kode_kecamatan) {
                    $.ajax({
                        url: '<?php echo site_url('getdata'); ?>',
                        type: 'GET',
                        data: {
                            kode_kecamatan: kode_kecamatan
                        },
                        success: function(response) {
                            var obj = JSON.stringify(response);
                            var res = JSON.parse(obj);
                            $('#tableBody').html(res.hasil);
                        }
                    });
                    }

                    var coordinate = [<?php echo $kabupaten->koordinat; ?>];
                    var zoomLevel = 11;
                    var map = new L.map('map').setView(coordinate, zoomLevel);
                    var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                    function onEachFeature(feature, layer) {
                        layer.on('click', function (e) {
                            let kode = e.target.feature.properties.Code;
                            getData(kode);
                        });
                        var label = L.marker(layer.getBounds().getCenter(), {
                            icon: L.divIcon({
                                className: 'text-danger fw-bold',
                                html: feature.properties.Name,
                                iconSize: [100, 10]
                            })
                        }).addTo(map);
                    }

                    function style(feature) {
                        return {
                            fillColor: '#87CEEB',
                            weight: 2,
                            opacity: 1,
                            color: '#DAA520',
                            dashArray: '3',
                            fillOpacity: 0.5
                        };
                    }

                    $.getJSON("<?php echo base_url('public/uploads/' . $kabupaten->kode_kabupaten . '.json'); ?>", function(data) {
                        const geojson = new L.geoJson(data, {
                            style: style,
                            onEachFeature: onEachFeature
                        }).addTo(map);
                    });

                    var lokasi = <?php echo $marker; ?>;
                    for (var i = 0; i < lokasi.length; i++) {
                        let marker_label = 'KODE  POS: ' + lokasi[i].kode_pos + '<br>' + lokasi[i].nama_apotik + '<br>' + lokasi[i].alamat_apotik;
                        var marker = new L.marker([lokasi[i].latitude, lokasi[i].longitude])
                            .bindPopup(marker_label)
                            .addTo(map);
                    }
            
            </script>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header bg-primary text-light">Statistik</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody id="tableBody">
                            <tr>
                                <td>Kabupaten</td>
                                <td>:</td>
                                <td><?php echo $kabupaten->nama_kabupaten; ?></td>
                            </tr>
                            <tr>
                                <td>Luas Wilayah</td>
                                <td>:</td>
                                <td><?php echo number_format($kabupaten->luas_wilayah, 0, ',', '.') . ' km<sup>2</sup>'; ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Penduduk</td>
                                <td>:</td>
                                <td><?php echo number_format($kabupaten->jumlah_penduduk, 0, ',', '.') . ' Jiwa'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer small bg-primary text-light">
                    Sumber : BPS 2022
                </div>
            </div>
        </div>
    </div>
</main>

<?php echo view('footer'); ?>
