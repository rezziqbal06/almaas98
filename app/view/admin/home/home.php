<?php if (in_array($sess->admin->a_jabatan_nama, ['Direktur', 'Admin'])) : ?>
    <section>
        <div class="row">
            <?php $title = ["Unit Tersedia", "Kustomer", "Booking", "Order Selesai"]; ?>
            <?php $value = [$count_produk, $count_kustomer, $count_booking, $count_order_done]; ?>
            <?php $icon = ["app", "single-02", "cart", "cart"]; ?>
            <?php $color = ["danger", "warning", "info", "success"]; ?>
            <?php foreach ($title as $k => $v) : ?>
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"><?= $title[$k] ?></p>
                                        <h2 class="font-weight-bolder">
                                            <?= $value[$k] ?>
                                        </h2>
                                        <p class="mb-0 d-none">
                                            <span class="text-success text-sm font-weight-bolder">+55%</span>
                                            since yesterday
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-<?= $color[$k] ?> shadow-primary text-center rounded-circle">
                                        <i class="ni ni-<?= $icon[$k] ?> text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>
<section>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Piket Hari Ini
                    <div class="icon icon-shape bg-accent shadow-info text-center float-end rounded-circle">
                        <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (isset($jadwal_hari_ini[0]->id)) : ?>
                        <?php $temp = ''; ?>
                        <?php foreach ($jadwal_hari_ini as $k => $v) : ?>
                            <?php if ($k == 0) { ?>
                                <?php $temp = $v->kawasan; ?>
                                <small class="mt-2 text-primary"><i class="fa fa-map-marker me-2"></i><?= $v->kawasan ?></small>
                            <?php } else { ?>
                                <?php if ($temp != $v->kawasan) : ?>
                                    <?php $temp = $v->kawasan; ?>
                                    <small class="mt-2 text-primary"><i class="fa fa-map-marker me-2"></i><?= $v->kawasan ?></small>
                                <?php endif ?>
                            <?php } ?>
                            <h3 value="<?= $v->id ?>"><?= $v->nama ?></h3>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
            <div class="d-grid gap-2 col-12 mx-auto mt-3">
                <a href="<?= base_url_admin() ?>order/baru" class="btn btn-success" type="button"><i class="ni ni-book-bookmark text-white me-3"></i> Tambah Survey</a>
                <a href="<?= base_url_admin() ?>akun/user/baru" class="btn btn-warning" type="button"><i class="ni ni-single-02 text-white me-3"></i> Tambah Pelanggan</a>
            </div>
            <?php if (isset($libur_hari_ini[0]->id)) : ?>
                <div class="card d-none">
                    <div class="card-header">
                        Libur Hari Ini
                        <div class="icon icon-shape bg-warning shadow-info text-center float-end rounded-circle">
                            <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php $temp = ''; ?>
                        <?php foreach ($libur_hari_ini as $k => $v) : ?>
                            <h5 value="<?= $v->id ?>"><?= $v->nama ?></h5>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Jadwal Piket
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="drTable" class="table table-vcenter table-striped">
                            <thead>
                                <?= $this->cjm->datatable()->table_headers() ?>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (in_array($sess->admin->a_jabatan_nama, ['Direktur', 'Admin'])) : ?>
    <section>
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        Omset Perbulan
                    </div>
                    <div class="card-body">
                        <canvas id="line-chart-gradient-omset" class="chart-canvas" height="300px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Jumlah Survei Perbulan
                    </div>
                    <div class="card-body">
                        <canvas id="line-chart-gradient-jumlah" class="chart-canvas" height="300px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-none">

                <div class="card">
                    <div class="card-header">
                        Order Bulan Ini
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Kode</th>
                                <th>Produk</th>
                                <th>Pembeli</th>
                                <th>Tanggal Pesan</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($orders as $o) : ?>
                                <tr>
                                    <td><?= $o->kode ?></td>
                                    <td><?= $o->produk ?></td>
                                    <td><?= $o->pembeli ?></td>
                                    <td><?= $o->tgl_pesan ?></td>
                                    <td><?= $o->status_badge ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>