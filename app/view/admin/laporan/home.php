<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row" style="">
            <div class="col-md-6">
                <div class="btn-group">
                    <button type="button" onclick="history.back()" class="btn btn-info btn-submit"><i class="fa fa-arrow-left icon-submit"></i> Kembali</button>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="card">

        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-10">
                    <h6><strong><?= $this->getTitle() ?></strong></h6>
                </div>
                <div class="col-2">
                    <button type="button" data-tipe="all" data-label="UNIT TERSEDIA" class="btn btn-success export-pdf">Export All</button>
                </div>
            </div>

        </div>

        <div class="card-body">

            <div class="row align-items-center">
                <div class="col-md-3 form-group">
                    <label for="start_date">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="text" name="start_date" id="start_date" class="form-control datepicker">
                </div>
                <div class="col-md-3 form-group">
                    <label for="end_date">Tanggal Selesai <span class="text-danger">*</span></label>
                    <input type="text" name="end_date" id="end_date" class="form-control datepicker">
                </div>
                <div class="col-md-3 form-group">
                    <label for="kawasan">Kawasan <span class="text-danger">*</span></label>
                    <select name="kawasan" id="kawasan" class="form-control">
                        <option value="all">Semua Kawasan</option>
                    </select>
                </div>
                <div class="col-md-3 mt-3"><button type="button" class="btn btn-primary" id="filter_handler">Filter</button></div>
            </div>

            <div id="response_container"></div>
        </div>

    </div>

    <!-- Surveyon -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-10">
                    <h5>Surveyon</h5>
                </div>
                <div class="col-2 justify-content-end">
                    <button type="button" data-tipe="table-surveyon" data-label="LIST SURVEYON" class="btn btn-success export-pdf">Export</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="surveyon_res" style="display: none;">
                <section id="table-surveyon" data-label="LIST SURVEYON">
                    <table class="table table-vcenter table-hover dt-wow table-parent" style="width: 100%;" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="brt bl" style="width: 3%;">No.</th>
                                <th class="brt">Kawasan</th>
                                <th class="brt">Nama</th>
                                <th class="brt">Telepon</th>
                                <th class="brt">Sumber Iklan</th>
                                <th class="brt">Marketing</th>
                            </tr>
                        </thead>
                        <tbody id="surveyon_tbody"></tbody>
                    </table>
                    <div id="count_surveyon_res"></div>
                </section>
            </div>
        </div>
    </div>

    <!-- Omset Perbulan -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-10">
                    <h5>Omset Perbulan</h5>
                </div>
                <div class="col-2 justify-content-end">
                    <button type="button" data-tipe="table-omset" data-label="OMSET PERBULAN" class="btn btn-success export-pdf">Export</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="omset_res" style="display: none;">
                <section id="table-omset" data-label="OMSET PERBULAN">
                    <table class="table table-vcenter table-hover dt-wow table-parent" style="width: 100%;" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="brt bl" style="width: 3%;">No.</th>
                                <th class="brt">Bulan</th>
                                <th class="brt">Jumlah</th>
                                <th class="brt">Omset</th>
                            </tr>
                        </thead>
                        <tbody id="omset_tbody"></tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <!-- Unit Terbooking -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-10">
                    <h5>Unit Terbooking</h5>
                </div>
                <div class="col-2 justify-content-end">
                    <button type="button" data-tipe="table-unit_terboking" data-label="UNIT TERBOOKING" class="btn btn-success export-pdf">Export</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="unit_terboking_res" style="display: none;">
                <section id="table-unit_terboking" data-label="UNIT TERBOOKING">
                    <p>
                    <table class="table table-vcenter table-hover dt-wow table-parent" style="width: 100%;" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="brt bl" style="width: 3%;">No.</th>
                                <th class="brt" style="">Kawasan</th>
                                <th class="brt" style="">Konsumen</th>
                                <th class="brt" style="">Sumber Iklan</th>
                                <th class="brt" style="">Lantai</th>
                                <th class="brt" style="">lb/lt</th>
                                <th class="brt" style="">Marketing</th>
                                <th class="brt" style="">Nomor</th>
                                <th class="brt" style="">Posisi</th>
                                <th class="brt" style="">Tanggal Pesan</th>
                                <th class="brt" style="">Tipe</th>
                                <th class="brt" style="">Total Harga</th>
                                <th class="brt" style="">Unit</th>
                            </tr>
                        </thead>
                        <tbody id="unit_terboking_tbody"></tbody>
                    </table>
                    </p>
                </section>
            </div>
        </div>
    </div>

    <!-- Unit Terjual -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-10">
                    <h5>Unit Terjual</h5>
                </div>
                <div class="col-2 justify-content-end">
                    <button type="button" data-tipe="table-unit_terjual" data-label="UNIT TERJUAL" class="btn btn-success export-pdf">Export</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="unit_terjual_res" style="display: none;">
                <section id="table-unit_terjual" data-label="UNIT TERJUAL">
                    <table class="table table-vcenter table-hover dt-wow table-parent" style="width: 100%;" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="brt bl" style="width: 3%;">No.</th>
                                <th class="brt">Kawasan</th>
                                <th class="brt">Konsumen</th>
                                <th class="brt" style="">Sumber Iklan</th>
                                <th class="brt">Lantai</th>
                                <th class="brt">lb/lt</th>
                                <th class="brt">Marketing</th>
                                <th class="brt">Nomor</th>
                                <th class="brt">Posisi</th>
                                <th class="brt">Tanggal Pesan</th>
                                <th class="brt">Tipe</th>
                                <th class="brt">Total Harga</th>
                                <th class="brt">Unit</th>
                            </tr>
                        </thead>
                        <tbody id="unit_terjual_tbody"></tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <!-- Unit Tersedia -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-10">
                    <h5>Unit Tersedia</h5>
                </div>
                <div class="col-2 justify-content-end">
                    <button type="button" data-tipe="table-unit_tersedia" data-label="UNIT TERSEDIA" class="btn btn-success export-pdf">Export</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="unit_tersedia_res" style="display: none;">
                <section id="table-unit_tersedia" data-label="UNIT TERSEDIA">
                    <table class="table table-vcenter table-hover dt-wow table-parent" style="width: 100%;" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="brt bl" style="width: 3%;">No.</th>
                                <th class="brt">Blok</th>
                                <th class="brt">Harga</th>
                                <th class="brt">Kawasan</th>
                                <th class="brt">Lantai</th>
                                <th class="brt">lb/lt</th>
                                <th class="brt">Nomor</th>
                                <th class="brt">Posisi</th>
                                <th class="brt">Tipe</th>
                                <th class="brt">Unit</th>
                            </tr>
                        </thead>
                        <tbody id="unit_tersedia_tbody"></tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>


</div>