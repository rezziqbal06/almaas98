<!-- modal option -->
<div id="modal_option" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Pilihan</h2>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 btn-group-vertical " style="text-align: left;">
						<a id="adetail" href="#" class="btn btn-info btn-left"><i class="fa fa-info-circle"></i> Detail Produk</a>
						<a id="aproduk_foto" href="#" class="btn btn-info btn-left"><i class="fa fa-users"></i> Kelola Foto Produk</a>
						<a id="aedit" href="#" class="btn btn-info btn-left"><i class="fa fa-pencil"></i> Edit Produk</a>
						<button id="bhapus" type="button" class="btn btn-info btn-left"><i class="fa fa-trash-o"></i> Hapus Produk</button>
					</div>
				</div>
				<div class="row" style="margin-top: 1em; ">
					<div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
					<div class="col-xs-12 btn-group-vertical">
						<button type="button" class="btn btn-default btn-block text-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
					</div>
				</div>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>


<!-- media-->
<!-- media modal -->
<div id="modal_media" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
				<h4 class="modal-title">Pilih Media untuk featured image</h4>
			</div>
			<div id="modalBody" class="modal-body">

				<div class="row">
					<div class="col-sm-9">
						<div id="rwm" class="row media-manager">
							<div class="col-md-12">
								<h2>Loading....</h2>
							</div>
						</div>
						<br>
						<ul class="pagination pagination-split mt5" style="display:none;">
							<li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
							<li><a href="#">1</a></li>
							<li class="active"><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
						</ul>


					</div><!-- col-sm-9 -->
					<div class="col-sm-3">
						<div class="media-manager-sidebar">

							<button id="buploadshow" class="btn btn-primary btn-block">Upload Files</button>

							<div class="mb30"></div>

							<h5 class="lg-title">Folders</h5>
							<ul id="folder_list" class="folder-list">
								<li><a href="#" data-folder="/" class="folder_selector"><i class="fa fa-folder-o"></i> /</a></li>
							</ul>

						</div>
					</div><!-- col-sm-3 -->
				</div>

			</div><!-- modal diego -->
		</div><!-- modal content -->
	</div><!-- modal dialog -->
</div>
<!-- end media modal -->

<!-- media add modal -->
<div id="modal_media_add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
				<h4 class="modal-title">Upload Media</h4>
			</div>
			<div id="modalBody" class="modal-body">
				<p id="modal_media_add_loading">Loading...</p>
				<form id="modal_media_add_form" method="post" action="<?= base_url("api_front/cms/media/add/") ?>" style="display:none;" class="form-horizontal" onsubmit="return false;">

					<div class="form-group">
						<div class="col-md-12">
							<label for="ifolder" class="control-label">Pilih Folder</label>
							<div class="input-group mb15">
								<span class="input-group-addon">Folder</span>
								<select id="ifolder" name="folder" class="form-control">
									<option value="/">-- Root folder --</option>
								</select>
								<span id="ifoldertambah" class="input-group-addon">+ Tambah</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<label for="ifile" class="control-label">Slug</label>
							<div class="input-group mb15">
								<span class="input-group-addon"><i class="fa fa-file-image-o"></i></span>
								<input id="ifile" name="file" class="form-control" type="file" accept="image/*" required />
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<div class="btn-group pull-right">
								<button id="mfaddsimpan" type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<!-- end media add modal -->
<!-- end media-->


<!-- modal detail -->
<div id="modal_detail" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title"></h2>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<div class="row">
					<div class="kartu-detail ">
						<div class="row">
							<div class="col-md-4">
								<a id="panel_gambar" href="" target="_blank" class=""><img id="gambar" class=" img-fluid rounded" src="" data-zoom-image="" alt="<?= $produk->nama ?? '' ?>" style="border-radius:0 0 32px 32px;"></a>
							</div>
							<div class="col-md-8">
								<p class="fs-5 mt-2 mb-1"><b id="type">Type <?= $produk->luas_tanah ?? '' ?>/<?= $produk->luas_bangunan ?? '' ?></b></p>
								<small id="kawasan" class="text-grey"><i class="fa fa-map-marker mb-2 me-1"></i> <?= $produk->kawasan ?? '' ?></small>
								<div class="d-flex justify-content-start flex-wrap text-grey">
									<div id="listrik" class="me-3"><i class="fa fa-bolt me-1"></i> <small><?= $produk->listrik ?? '' ?> watt</small></div>
									<div id="toilet" class="me-3"><i class="fa fa-bath me-1" style="vertical-align: baseline;"></i> <small><?= $produk->toilet ?? '' ?></small></div>
									<div id="kamar_tidur" class="me-3"><i class="fa fa-bed me-1"></i> <small><?= $produk->kamar_tidur ?? '' ?></small></div>
								</div>
								<div id="deskripsi" class="mt-4"><?= $produk->deskripsi ?? '' ?></div>
								<hr>
								<h3 class="me-3 m-0"><b id="angsuran" class="text-primary"><?= $produk->angsuran ?? '' ?></b>/bulan</h3>
								<span id="harga" class="text-grey" style="margin-top: -4px;">Rp. <?= $produk->harga ?? '' ?> </span>
							</div>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top: 1em; ">

				</div>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>