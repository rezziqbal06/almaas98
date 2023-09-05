NProgress.start();

setTimeout(function(){
	NProgress.done();
},500)

$(document).off('click', '.btn-kategori');
$(document).on('click', '.btn-kategori', function(e){
	e.preventDefault();
	var kategori_id = $(this).attr('data-id');
	$(".btn-kategori").removeClass("text-bold text-primary");
	$(this).addClass("text-bold text-primary");
	$.get('<?=base_url("api_front/produk/?a_kategori_id=")?>'+kategori_id).done(function(dt){
		if(dt.status == 200){
			var s = ""
			$.each(dt.data, function(k,v){
			s += `	<div class="col-6 col-md-2 p-3 kartu-produk" data-kategori-id="${v.a_kategori_id}">
					<a href="<?= base_url("produk/") ?>${v.slug}" class="" data-id="${v.id}" data-kategori-id="${v.a_kategori_id}" alt="${v.nama}">
						<div class="kartu-gambar-produk">
							<img src="<?= base_url("") ?>${v.gambar}" alt="${v.nama}" aria-describedby="${v.nama}" class="img-fluid">
						</div>
						<p class="text-center mt-3"><b>${v.nama}</b></p>
					</a>
				</div>`
			})
			$("#panel_produk").slideUp();
			setTimeout(function(){
				$("#panel_produk").html(s).slideDown();
			},333)
		}else{

		}
	})
});

$('#banner').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    fade: true,
    cssEase: 'linear',
	dots: true, // Enable dots (indicator bullets)
	appendDots: '.carousel-indicators ul', // Append dots to the specified element
    customPaging : function(slider, i) {
      // Custom function to create the dot indicators
      return '<button class="dot"></button>';
    }
  });

function getProduk(options={}){
	$.post('<?=base_url("api_front/produk/")?>', options).done(function(dt){
		if(dt.status == 200){
			var s = '';
			$.each(dt.data, function(k,v){
				s+= `<div class="col-md-4">
						<div class="p-2 mb-3 kartu-produk" data-kategori-id="${v?.a_kategori_id}">
							<a href="<?= base_url("produk/") ?>${v?.slug}" class="" data-id="${v?.id}" data-kategori-id="${v?.a_kategori_id}" alt="${v?.nama}">
								<div class="row">
									<div class="col-4">
										<div class="kartu-gambar-produk">
											<img src="<?= base_url("") ?>${v?.gambar}" alt="${v?.nama}" aria-describedby="${v?.nama}" class="img-fluid">
										</div>
									</div>
									<div class="col-8">
										<p class="m-0 mb-1"><b>Type ${v?.luas_tanah}/${v?.luas_bangunan}</b></p>
										<small class="text-grey"><i class="fa fa-map-marker mb-2"></i> ${v?.kawasan}</small>
										<div class="d-flex justify-content-start flex-wrap">
											<div class="me-3"><b class="text-primary">${v?.harga}</b>/bulan</div>
											<div class="me-3"><i class="fa fa-bath" style="vertical-align: baseline;"></i> <small>${v?.toilet}</small></div>
											<div class="me-3"><i class="fa fa-bed"></i> <small>${v?.kamar_tidur}</small></div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>`
			})

			$("#panel_produk").html(s);
		}else{

		}
	})
	
}

getProduk();

$('#cari_quiz').bind('keyup blur', $.debounce(function(){
	var keyword = $(this).val();
	getProduk({keyword: keyword})
}, 300));