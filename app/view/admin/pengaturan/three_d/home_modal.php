<!-- modal option -->
<div id="modal_option" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Aksi </h2>
				<h5 id="t"></h5>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 btn-group-vertical">
						<!-- <a id="adetail" href="#" class="btn btn-info btn-left"><i class="fa fa-info"></i> Detail</a> -->
						<a id="aedit" href="#" class="btn btn-primary btn-left"><i class="fa fa-pencil"></i> Edit</a>
						<button id="bhapus" type="button" class="btn btn-danger btn-left btn-submit"><i class="fa fa-trash-o icon-submit"></i> Hapus</button>
					</div>
				</div>
				<div class="row" style="margin-top: 1em; ">
					<div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
					<div class="col-xs-12 btn-group-vertical" style="">
						<button type="button" class="btn btn-default btn-block text-left" data-dismiss="modal" id="btn_close_modal"><i class="fa fa-close"></i> Tutup</button>
					</div>
				</div>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>

<!-- modal tambah -->
<div id="modal_tambah" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Tambah</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form action="" method="POST" id="ftambah">
					<div class="row">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6 mb-2">
									<label for="ideskripsi" class="control-label">deskripsi</label>
									<input id="ideskripsi" type="text" name="deskripsi" class="form-control" required>
								</div>
								<div class="col-md-12 mb-2">
									<label for="igambar" class="control-label">Script embed 3d model</label>
									<textarea name="gambar" id="igambar" class="form-control" cols="30" rows="10"></textarea>
								</div>
								<div class="col-12 text-end">
									<button data-id="i" class="lihat_3d btn btn-primary">Lihat 3D</button>
								</div>
								<div class="col-md-2 mb-2">
									<label for="iis_active" class="control-label">Status</label>
									<select name="is_active" id="iis_active" class="form-control">
										<option value="1">Aktif</option>
										<option value="0">Draft</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 1em; ">
						<div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
						<div class="col-xs-12 btn-group-vertical" style="">
							<button type="submit" class="btn btn-default btn-block text-left" data-dismiss="modal"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>

<!-- modal edit -->
<div id="modal_edit" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Edit</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form action="" method="POST" id="fedit">
					<div class="row">
						<div class="form-group">
							<input type="hidden" name="id" id="ieid">
							<div class="row">
								<div class="col-md-6 mb-2">
									<label for="iedeskripsi" class="control-label">deskripsi</label>
									<input id="iedeskripsi" type="text" name="deskripsi" class="form-control" required>
								</div>
								<div class="col-md-12 mb-2">
									<label for="iegambar" class="control-label">Script embed 3d model</label>
									<textarea name="gambar" id="iegambar" class="form-control" cols="30" rows="10"></textarea>
								</div>
								<div class="col-12 text-end">
									<button data-id="ie" class="lihat_3d btn btn-primary">Lihat 3D</button>
								</div>
								<div class="col-md-2 mb-2">
									<label for="ieis_active" class="control-label">Status</label>
									<select name="is_active" id="ieis_active" class="form-control">
										<option value="1">Aktif</option>
										<option value="0">Draft</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 1em; ">
						<div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
						<div class="col-xs-12 btn-group-vertical" style="">
							<button type="submit" class="btn btn-default btn-block text-left" data-dismiss="modal"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>


<!-- modal 3d -->
<div id="modal_3d" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<div id="detail_3d"></div>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>