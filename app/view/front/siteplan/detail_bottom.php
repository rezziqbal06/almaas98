var media_target_div = 'dgaleri_items';
var media_single = 0;
var media_name = 'image[]';
var media_caption = 0;
var media_id = '';
var folder_id = '';
var galeri_item_count = 0;
var id_spec = 0;
var data_siteplan = {};

$(".select2").select2();

$('.currency').mask("#.##0", {reverse: true});

function convertToSlug(Text) {
  	return Text.toLowerCase()
             .replace(/ /g, '-')
             .replace(/[^\w-]+/g, '');
}


//submit form
$("#ftambah").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch fa-spin');
  if(!data_siteplan){
    gritter('Data Siteplan tidak ada', 'warning');
    return false;
  }
  var fd = new FormData($(this)[0]);

  var string_data_siteplan = JSON.stringify(data_siteplan)
  fd.append('data_siteplan', string_data_siteplan);

	var url = '<?= base_url("api_admin/pengaturan/kategori/update_siteplan/$akm->id")?>';

	$.ajax({
		type: $(this).attr('method'),
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			if(respon.status==200){
				gritter('<h4>Sukses</h4><p>Data berhasil ditambahkan</p>','success');
				setTimeout(function(){
					window.location = '<?=base_url_admin('pengaturan/kategori/')?>';
				},500);
			}else{
				gritter('<h4>Gagal</h4><p>'+respon.message+'</p>','warning');
				$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
				$('.btn-submit').prop('disabled',false);
				NProgress.done();
			}
		},
		error:function(){
			setTimeout(function(){
				gritter('<h4>Error</h4><p>Tidak dapat menambah data, silahkan coba beberapa saat lagi</p>','danger');
			}, 666);

			$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
			$('.btn-submit').prop('disabled',false);
			NProgress.done();
			return false;
		}
	});
});



$("#isiteplan").on('change', function(e){
  e.preventDefault();
  $("#ipath_siteplan").val('')
  const file = event.target.files[0];
                
  if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
          const svgContent = e.target.result;
          $("#siteplan").html(svgContent); // Display the SVG
      };
      reader.readAsText(file);
  }
})


function getDetail(data, type = 'click'){
  if(data){
    var datas = data.split('|');
    if(datas){
      var id = '';
      var Tipe = '';
      var blok = '';
      var nomor = '';
      var lt = '';
      var lb = '';
      var kamar = '';
      var toilet = '';
      var posisi = '';
      $.each(datas, function(k,v){
        if(v.includes('LB-')){
            lb = v.replaceAll('LB-','');
        }else if(v.includes('N-')){
            nomor = v.replaceAll('N-','');
        }else if(v.includes('LT-')){
            lt = v.replaceAll('LT-','');
        }else if(v.includes('B-')){
            blok = v.replaceAll('B-','');
        }else if(v.includes('PS-')){
            posisi = v.replaceAll('PS-','');
        }else if(v.includes('ID-')){
            id = v.replaceAll('ID-','');
        }
      })

      detail = `Blok ${blok} No ${nomor} Type ${lt}/${lb} ${posisi}`
      $("#detail_rumah").text(detail)
      if(type == 'click'){
        $.get('<?=base_url("api_admin/pengaturan/produk_item/detail/")?>'+id).done(function(dt){
          if(dt.status == 200){
            if(dt.data){
                var gambar = '<?=base_url()?>'+dt.data.tipe_rumah.gambar;
                $("#panel_gambar").attr('href', gambar);
                $("#gambar").attr('src', gambar);
                $("#type").text(`Type ${dt.data.tipe_rumah.luas_tanah}/${dt.data.tipe_rumah.luas_bangunan}`);
                $("#kawasan").html(`<i class="fa fa-map-marker mb-2 me-1"></i> ${dt.data.kategori.nama}`);
                $("#listrik").html(`<i class="fa fa-bolt me-1"></i> ${dt.data.tipe_rumah.listrik}`);
                $("#toilet").html(`<i class="fa fa-bath me-1"></i> ${dt.data.tipe_rumah.toilet}`);
                $("#kamar_tidur").html(`<i class="fa fa-bed me-1"></i> ${dt.data.tipe_rumah.kamar_tidur}`);
                $("#deskripsi").html(`${dt.data.tipe_rumah.deskripsi}`);
                $("#angsuran").text(`Rp.${dt.data.tipe_rumah.angsuran}`);
                $("#harga").text(`Rp.${dt.data.tipe_rumah.harga}`);
                $("#modal_detail").modal('show')
            }
          }
        });
      }
     
    }
  }
  
}

$(document).off('click', 'path')
$(document).on('click', 'path', function(e){
	e.preventDefault();
	var id = $(this).attr('id')
	var data = $(this).attr('data-rumah-id');
  $("path").removeClass('selected');
  //$("#"+id).removeClass('booking').removeClass('tersedia').removeClass('terjual');
  $("#"+id).addClass('selected');
  $("#id_path").val(id);
  getDetail(data)
})

<?php if (isset($akm->siteplan) && strlen($akm->siteplan)) : ?>
    var siteplan_url = '<?=base_url($akm->siteplan)?>'
    $.get(siteplan_url).done(function(data){
      var svg = $(data).find('svg');
      var width = svg.attr('width');
      var height = svg.attr('height');
      svg.attr('viewBox', `0 0 ${width} ${height}`)
      $("#siteplan").html(svg); // Display the SVG
    
      var stok = '<?=$akm->data_siteplan?>';
      if(stok){
        data_siteplan = JSON.parse(stok);
        console.log(data_siteplan, 'data_siteplan')
        $.each(data_siteplan, function(k,v){
          if(v){
            $("#"+k).attr('data-rumah-id', v.data);
            $("#"+k).addClass(v.status);
          }
        })
      }
    })
<?php endif ?>


$(document).off('mouseenter', 'path')
$(document).on('mouseenter', 'path', function(e){
	e.preventDefault();
  var detail = '';
	var data = $(this).attr('data-rumah-id');
  getDetail(data,'hover');
 
})

function resetSiteplan(){
  $("path[data-rumah-id]").removeClass('fill-white');
  $("#ftambah").trigger('reset');
  $("#iblok").val('');
  $("#irumah").val(''); 
}

function filterSitemap(){
  $("path[data-rumah-id]").addClass('fill-white');
  var status_rumah = $('[name="status_rumah"]:checked').val();
  var posisi = $('[name="posisi"]:checked').val();
  var blok = $("#iblok").val();
  var rumah = $("#irumah").val(); //type
  var stringSelected = "path";
  if(status_rumah) stringSelected += "[class*='"+status_rumah+"']"
  if(blok) stringSelected += "[data-rumah-id*='B-"+blok+"']"
  if(rumah) stringSelected += "[data-rumah-id*='"+rumah+"']"
  if(posisi) stringSelected += "[data-rumah-id*='PS-"+posisi+"']"
  console.log(stringSelected, 'string selected');
  $(stringSelected).removeClass('fill-white');
}

$('[name="status_rumah"]').on('change', function(e){
  e.preventDefault();
  filterSitemap();
})

$('[name="posisi"]').on('change', function(e){
  e.preventDefault();
  filterSitemap();
})

$(document).off('change', '.select2')
$(document).on('change', '.select2', function(e){
	e.preventDefault();
  filterSitemap();
})

$("#reset").on('click', function(e){
  e.preventDefault();
  resetSiteplan();
})

$(document).ready(function() {
  var $siteplan = $('#siteplan');

  if('ontouchstart' in window == false && window.matchMedia("(orientation: portrait)").matches == false) {
    $siteplan.on('mousemove', function(e) {
      var x = e.clientX;
      var y = e.clientY;

      $('svg').css({
        'transform-origin': x + 'px ' + y + 'px',
        'transform': 'scale(1.5)'
      });
    });

    $siteplan.on('mouseleave', function(e) {
      $('svg').css('transform', 'scale(1.0)');
    });

    $siteplan.on('click', function() {
      $('svg').css('transform', 'scale(1.0)');
    });
  }
});
