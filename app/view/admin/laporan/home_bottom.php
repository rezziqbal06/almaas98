$('#start_date').val(moment().startOf('year').format('YYYY-MM-DD'))
$('#end_date').val(moment().endOf('year').format('YYYY-MM-DD'))
filter()
$('.export-pdf').on('click', function(e){
  var bodies = $(`#${$(this).data('tipe')}`).html()
  var contents = `
  <center>
    <h5>${$(this).data('label') ?? ''}</h5>
  </center>
    ${bodies}
  `
  if($(this).data('tipe') == "all"){
    contents = ''
    $.each($('section'), function(idex, val){
      contents += `
      <center>
        <h5>${$(this).data('label') ?? ''}</h5>
      </center>
      <p>${$(this).html()}</p>
      
      `
    })
  }
  
  var contentToPrint = `<html>

  <head>
    <style>
        .table th {
          font-weight: bold;
        }

        .table tbody tr:hover {
          background-color: #d1e0e0;
        }

        img {
          height: 4rem;
        }

        .td-responsive {
          width: 25% !important;
        }

        th,
        td {
          font-size: 0.85rem;
          padding: 0.3rem;
          word-wrap: break-word;
        }


        hr {
          height: 5px;
          border-top: 1px solid black;
          border-bottom: 1px solid black;
          border-right: none;
          border-left: none;
        }

        .table-parent {
          border-collapse: separate;
          width: 100%;
        }

        .table-parent thead th {
          white-space: nowrap;
          font-size: 0.65rem;
          text-align: center;
        }

        .table-parent tr{
          border-bottom: 0.2px solid gray;
        }

        .table-parent tbody td {
          font-size: 0.6rem;
          text-align: left;
        }

        *{
          font-family: courier, courier new, serif;
        }

        .brt{
          border-right: 0.2px solid gray; border-top: 0.2px solid gray
        }

        .bl{
          border-left: 0.2px solid gray;
        }
      
    </style>
    <title>${$(this).data('label')}_${$('#start_date').val()}-${$('#end_date').val()}</title>
  </head>

  <body>
    <table style="width: 100%; margin: 0; padding: 0">
      <tr>
        <td rowspan="3" class="td-responsive" style="vertical-align: top !important;">
          <img src="<?= $this->cdn_url("media/logo.png") ?>" alt="main_logo">
        </td>
        <td style="vertical-align: top;">
        <?=$this->config->semevar->site_name?>
        </td>
      </tr>
      <tr>
        <td><?=$this->config->semevar->site_address?></td>
      </tr>
      <tr>
        <td><?=$this->config->semevar->site_number?></td>
      </tr>
    </table>
    <p>
      <hr>
    </p>
    <table>
      <tr>
        <td>Periode</td>
        <td>: ${moment($('#start_date').val()).format('DD-MM-YYYY')} - ${moment($('#end_date').val()).format('DD-MM-YYYY')}</td>
      </tr>
      <tr>
        <td>Kawasan</td>
        <td>: ${$('#kawasan option:selected').text()}</td>
      </tr>
    </table>
    <p>${contents}</p>

    <p>
    <table style="width: 100%;">
      <tr>
        <td></td>
        <td style="width: 50%"></td>
        <td rowspan="3" style="vertical-align: top;">${getNamaHari(moment().format('d'))}, ${moment().format('DD')} ${getNamaBulan(moment().format('M'))} ${moment().format('YYYY')}</td>
      </tr>
      <tr>
        <td style="vertical-align: top;">
          <center>Mengetahui</center>
        </td>
        <td style="height: 5rem;"></td>
      </tr>
      <tr>
        <td>
          <center>Yayat Hendrayana</center>
        </td>
      </tr>
    </table>
    </p>
  </body>

  </html>`;

  contentToPrint = contentToPrint.replaceAll('class="table table-vcenter table-hover dt-wow table-parent" style="width: 100%;" cellspacing="0"', 'class="table-parent" cellspacing="0"')

   const pdfOptions = {
    margin: 5,
    filename: `${$(this).data('tipe') != "all" ? $(this).data('label'): "Laporan"}_${$('#start_date').val()}-${$('#end_date').val()}.pdf`,
    image: { type: 'jpeg', quality: 0.98 }, 
    html2canvas: { scale: 2 }, 
    jsPDF: { unit: 'mm', format: 'a4' }, // Format dan orientasi halaman
    pagebreak: { mode: ['avoid-all'] }, // Mode halaman (menghindari pemotongan)
    autoTable: { styles: { overflow: 'linebreak' }, tableWidth: 'auto' }, // Opsi autoTable
  };

  html2pdf().from(contentToPrint).set(pdfOptions).save()

})

$('.datepicker').datepicker({format: 'yyyy-mm-dd'})

$.get("<?= base_url("api_admin/pengaturan/kategori/") ?>").done(res => {
  if(res.data && res.data.length > 0){
    var kawasan = ''
    res.data.map(val => {
    kawasan += `<option value="${val[0] ?? '' }">${val[1] ?? ''}</option>`
    })

    $('#kawasan').append(kawasan)
  }
})

$('#filter_handler').on('click', function(){
  filter();
})

function filter(){
  if(validate() == true){

    var surveyon_res = ''
    var omset_res = ''
    var unit_terboking = ''
    var unit_terjual = ''
    var unit_tersedia = ''

    $.get(`<?= base_url('api_admin/laporan/') ?>?sdate=${$('#start_date').val()}&edate=${$('#end_date').val()}${$('#kawasan option:selected').val() != "all" ? '&a_kategori_id='+$('#kawasan option:selected').val() : ''}`).done(res => {
      console.log(res)
      if(res.status == "200" && res.data){
        $('#surveyon_tbody').empty()
        $('#omset_tbody').empty()
        $('#unit_terboking_tbody').empty()
        $('#unit_terjual_tbody').empty()
        $('#unit_tersedia_tbody').empty() 
        
        //surveyon
        if(res.data.list_surveyon && res.data.list_surveyon.length > 0){
          $('#surveyon_res').show()
          var surveyon_tbody = ''
          res.data.list_surveyon.map((val, idx) => {
          surveyon_tbody += `
          <tr>
            <td class="brt bl">${idx + 1}</td>
            <td class="brt">${val.kawasan ?? ''}</td>
            <td class="brt">${val.nama ?? ''}</td>
            <td class="brt">${val.nik ?? ''}</td>
            <td class="brt">${val.telp ?? ''}</td>
          </tr>
          `
          })
          $('#surveyon_tbody').html(surveyon_tbody)
        }

        if(res.data.count_surveyon && res.data.count_surveyon.length > 0){
          var count_serveyon_tbody = ''
          res.data.count_surveyon.map(val => {
            count_serveyon_tbody += `
              <tr>
                <td>Jumlah Kawasan <b>${val.kawasan}</b></td>
                <td>: <b>${val.jumlah}</b></td>
              </tr>
            `
          })
          $('#count_surveyon_res').html(`<table>${count_serveyon_tbody}</table>`)
        }

        //omset
        if(res.data.omset && res.data.omset.length > 0){
          $('#omset_res').show()
          var omset_tbody = ''
          res.data.omset.map((val, idx) => {
          omset_tbody += `
          <tr>
            <td class="brt bl">${idx + 1}</td>
            <td class="brt">${val.bulan ?? ''}</td>
            <td class="brt">${val.jumlah ?? ''}</td>
            <td class="brt">Rp. ${val.omset ?? 0}</td>
          </tr>
          `
          })
          $('#omset_tbody').html(omset_tbody)
        }

        //unit terboking
        if(res.data.unit_booking && res.data.unit_booking.length > 0){
          $('#unit_terboking_res').show()

          res.data.unit_booking.map((val, idx) => {
          unit_terboking += `
          <tr>
            <td class="brt bl">${idx + 1}</td>
            <td class="brt">${val.kawasan ?? ''}</td>
            <td class="brt">${val.konsumen ?? ''}</td>
            <td class="brt">${val.lantai ?? ''}</td>
            <td class="brt">${val.luas_bangunan ?? ' '}(m<sup>2</sup>)/${val.luas_tanah ?? ''}(m<sup>2</sup>) </td>
            <td class="brt">${val.marketing ?? ''}</td>
            <td class="brt">${val.nomor ?? ''}</td>
            <td class="brt">${val.posisi ?? ''}</td>
            <td class="brt">${val.tgl_pesan ?? ''}</td>
            <td class="brt">${val.tipe ?? ''}</td>
            <td class="brt">${val.total_harga ?? ''}</td>
            <td class="brt">${val.unit ?? ''}</td>
          </tr>
          `
          })

          $('#unit_terboking_tbody').html(unit_terboking)
        }

        //unit terjual
        if(res.data.unit_terjual && res.data.unit_terjual.length > 0){
          $('#unit_terjual_res').show()

          res.data.unit_terjual.map((val, idx) => {
          unit_terjual += `
          <tr>
            <td class="brt bl">${idx + 1}</td>
            <td class="brt">${val.kawasan ?? ''}</td>
            <td class="brt">${val.konsumen ?? ''}</td>
            <td class="brt">${val.lantai ?? ''}</td>
            <td class="brt">${val.luas_bangunan ?? ' '}(m<sup>2</sup>)/${val.luas_tanah ?? ''}(m<sup>2</sup>) </td>
            <td class="brt">${val.marketing ?? ''}</td>
            <td class="brt">${val.nomor ?? ''}</td>
            <td class="brt">${val.posisi ?? ''}</td>
            <td class="brt">${val.tgl_pesan ?? ''}</td>
            <td class="brt">${val.tipe ?? ''}</td>
            <td class="brt">${val.total_harga ?? ''}</td>
            <td class="brt">${val.unit ?? ''}</td>
          </tr>
          `
          })

          $('#unit_terjual_tbody').html(unit_terjual)
        }

        //unit tersedia
        if(res.data.unit_tersedia && res.data.unit_tersedia.length > 0){
          $('#unit_tersedia_res').show()

          res.data.unit_tersedia.map((val, idx) => {
          unit_tersedia += `
          <tr>
            <td class="brt bl">${idx + 1}</td>
            <td class="brt">${val.blok ?? ''}</td>
            <td class="brt">${val.harga ?? ''}</td>
            <td class="brt">${val.kawasan ?? ''}</td>
            <td class="brt">${val.lantai ?? ''}</td>
            <td class="brt">${val.luas_bangunan ?? ' '}(m<sup>2</sup>)/${val.luas_tanah ?? ''}(m<sup>2</sup>) </td>
            <td class="brt">${val.nomor ?? ''}</td>
            <td class="brt">${val.posisi ?? ''}</td>
            <td class="brt">${val.tipe ?? ''}</td>
            <td class="brt">${val.unit ?? ''}</td>
          </tr>
          `
          })

          $('#unit_tersedia_tbody').html(unit_tersedia)
        }


      }
    })
  }
}

function validate(){
  var attr = [
  {
  name: '#start_date',
  label: 'Tanggal Mulai',
  },
  {
  name: '#end_date',
  label: 'Tanggal Selesai',
  },
  {
  name: '#kawasan',
  label: 'Kawasan',
  }
  ]

  var message = ''

  attr.map(val => {
    if($(val.name).val() == ""){
      message += `<li class="text-sm font-weight-bold text-white">${val.label} Harus Diisi</li>`
    }
  })


  if(message != ""){
  $('#response_container').html(`<div class="alert alert-danger alert-dismissible fade show">
    <ul>${message}</ul>
  </div>
  `)
  return false;
  }

  return true
}

function getNamaHari(digit) {
  const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

  if (digit >= 0 && digit <= 6) {
    return hari[digit]; 
  } else {
    return 'Angka hari tidak valid' ; 
  } 

}

function getNamaBulan(digit) {
  const bulan = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];

  if (digit >= 1 && digit <= 12) {
    return bulan[digit - 1]; // Karena indeks array dimulai dari 0
  } else {
    return 'Angka bulan tidak valid';
  }
}