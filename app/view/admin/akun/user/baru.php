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
            <h6><strong><?= $this->getTitle() ?></strong></h6>
        </div>

        <div class="card-body">

            <form id="ftambah" action="<?= base_url_admin() ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="iis_active" class="control-label">Aktif?</label>
                        <select id="iis_active" name="is_active" class="form-control">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="ifnama" class="control-label">Nama Lengkap*</label>
                        <input type="text" name="fnama" id="ifnama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="col-md-6 d-none">
                        <label for="inik" class="control-label">NIK*</label>
                        <input type="number" name="nik" id="inik" class="form-control" placeholder="Nama">
                    </div>
                    <?php if (isset($jabatans) && count($jabatans)) { ?>
                        <div class="col-md-6">
                            <label for="ia_jabatan_id" class="control-label">Profesi</label>
                            <select name="a_jabatan_id" id="ia_jabatan_id" class="form-control select2" required>
                                <?php foreach ($jabatans as $jb) { ?>
                                    <option value="<?= $jb->id ?>"><?= $jb->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <?php if (isset($units) && count($units)) { ?>
                        <div class="col-md-6">
                            <label for="ia_unit_id" class="control-label">Unit</label>
                            <select name="a_unit_id" id="ia_unit_id" class="form-control select2" required>
                                <?php foreach ($units as $un) { ?>
                                    <option value="<?= $un->id ?>"><?= $un->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>

                </div>

                <!-- <div class="form-group row">
                    <div class="col-md-6">
                        <label for="ialamat_select" class="control-label">Cari Alamat</label>
                        <select id="ialamat_select" class="form-control select2"></select>
                    </div>
                </div> -->
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="iprovinsi">Provinsi</label>
                        <select id="iprovinsi" class="form-control" name="provinsi"></select>
                    </div>
                    <div class="col-md-4">
                        <label for="ikabkota">Kabupaten / Kota</label>
                        <select id="ikabkota" class="form-control" name="kabkota"></select>
                    </div>
                    <div class="col-md-4">
                        <label for="ikecamatan">Kecamatan</label>
                        <select id="ikecamatan" class="form-control" name="kecamatan"></select>
                    </div>
                    <div class="col-md-4">
                        <label for="ikelurahan">Desa / Kelurahan</label>
                        <select id="ikelurahan" class="form-control" name="kelurahan"></select>
                    </div>
                    <div class="col-md-4">
                        <label for="ikodepos" class="control-label">Kodepos</label>
                        <input id="ikodepos" class="form-control " name="kodepos" placeholder="Kodepos">
                    </div>
                    <div class="col-md-6">
                        <label for="ialamat">Alamat</label>
                        <textarea id="ialamat" class="form-control" name="alamat" maxlength="30"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="ialamat2">Alamat2</label>
                        <textarea id="ialamat2" class="form-control" name="alamat2" maxlength="30"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="ipenilaian">Penilaian/Testimoni</label>
                        <textarea id="ipenilaian" class="form-control" name="penilaian" maxlength="300"></textarea>
                    </div>
                </div>
                <div class="form-group row">

                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="iitelp" class="control-label">Telepon</label>
                        <input id="iitelp" type="number" class="form-control" name="telp" placeholder="Telepon" />
                    </div>
                    <div class="col-md-4">
                        <label for="iemail" class="control-label">Email</label>
                        <input id="iemail" type="email" class="form-control" name="email" placeholder="Email" />
                    </div>
                    <div class="col-md-4">
                        <label for="iusername" class="control-label">Username</label>
                        <input id="iusername" type="username" class="form-control" name="username" placeholder="Username" />
                    </div>
                    <div class="col-md-4">
                        <label for="isumber_iklan">Sumber Iklan</label>
                        <select id="isumber_iklan" class="form-control" name="sumber_iklan">
                            <option value="Teman">Teman</option>
                            <option value="Saudara">Saudara</option>
                            <option value="Website Resmi Almaas">Website Resmi Almaas</option>
                            <option value="Website Rumah.com">Website Rumah.com</option>
                            <option value="Website Rumah123.com">Website Rumah123.com</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Tiktok">Tiktok</option>
                            <option value="Youtube">Youtube</option>
                            <option value="Twitter">Twitter</option>
                        </select>
                    </div>
                    <div class="col-md-2 panel-pembayaran mb-2">
                        <label for="iktp" class="control-label">KTP</label>
                        <input id="iktp" type="file" name="ktp" accept=".png, .jpg, .jpeg" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <img id="img-iktp" src="" alt="" class="img-fluid rounded">
                    </div>
                    <!-- <div class="col-md-4">
                        <label for="ipassword" class="control-label">Password</label>
                        <input id="ipassword" type="password" class="form-control" name="password" value="123456" placeholder="password" />
                    </div> -->
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-12 text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>