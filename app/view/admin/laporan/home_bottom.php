$('#start_date').val(moment().startOf('year').format('YYYY-MM-DD'))
$('#end_date').val(moment().endOf('year').format('YYYY-MM-DD'))
filter()
$('.export-pdf').on('click', function(e){
  var bodies = $(`#${$(this).data('tipe')}`).html()
  var contents = `
  <center>
    <h3>${$(this).data('label') ?? ''}</h3>
  </center>
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
    ${bodies}
  `
  if($(this).data('tipe') == "all"){
    contents = ''
    $.each($('section'), function(idex, val){
      contents += `
      <center>
        <h3>${$(this).data('label') ?? ''}</h3>
      </center>
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
      <p>${$(this).html()}</p>
      
      `
    })
  }
  
  const newWindow = window.open("about:blank");
  if (newWindow) {
  const contentToPrint = `<html>

  <head>
    <style>
      @page {
        size: auto;
        margin: 0;
      }

      @media print {
        @page {
          size: 210mm 297mm;
          /* A4 */
        }

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
          border: 1px solid black;
          border-left: none;
          width: 100%;
        }

        .table-parent thead th {
          border: 1px solid black;
          border-right: none;
          border-top: none;
          border-bottom: none;
          white-space: nowrap;
          font-size: 0.65rem;
        }

        .table-parent tbody td {
          border: 1px solid black;
          border-right: none;
          border-bottom: none;
          font-size: 0.65rem;
          text-align: left;
        }

        *{
          font-family: courier, courier new, serif;
        }
      }
    </style>
    <title>${$(this).data('label')}_${$('#start_date').val()}-${$('#end_date').val()}</title>
  </head>

  <body>
    <table>
      <tr>
        <td rowspan="3" class="td-responsive">
          <img src="<?= $this->cdn_url("media/logo.png") ?>" alt="main_logo">
        </td>
        <td>
          AL-MAAS 98 RESIDENCE
        </td>
      </tr>
      <tr>
        <td> Perumahan Bumi Permai, Jalan Bengawan Solo 17, RT 09 RW 03, Kelurahan Kaliurang, Kecamatan Kebahagiaan, Kota Malang, Jawa Timur, 224352</td>
      </tr>
      <tr>
        <td>081802803423</td>
      </tr>
    </table>
    <p>
      <hr>
    </p>
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

  newWindow.document.open();
  newWindow.document.write(contentToPrint);
  newWindow.document.close();

  newWindow.print();
  newWindow.close();
  }
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
            <td>${idx + 1}</td>
            <td>${val.kawasan ?? ''}</td>
            <td>${val.nama ?? ''}</td>
            <td>${val.nik ?? ''}</td>
            <td>${val.telp ?? ''}</td>
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
            <td>${idx + 1}</td>
            <td>${val.bulan ?? ''}</td>
            <td>${val.jumlah ?? ''}</td>
            <td>Rp. ${val.omset ?? 0}</td>
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
            <td class="border-print">${idx + 1}</td>
            <td class="border-print">${val.kawasan ?? ''}</td>
            <td class="border-print">${val.konsumen ?? ''}</td>
            <td class="border-print">${val.lantai ?? ''}</td>
            <td class="border-print">${val.luas_bangunan ?? ' '}(m<sup>2</sup>)/${val.luas_tanah ?? ''}(m<sup>2</sup>) </td>
            <td class="border-print">${val.marketing ?? ''}</td>
            <td class="border-print">${val.nomor ?? ''}</td>
            <td class="border-print">${val.posisi ?? ''}</td>
            <td class="border-print">${val.status ?? ''}</td>
            <td class="border-print">${val.tgl_pesan ?? ''}</td>
            <td class="border-print">${val.tipe ?? ''}</td>
            <td class="border-print">${val.total_harga ?? ''}</td>
            <td class="border-print">${val.unit ?? ''}</td>
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
            <td class="border-print">${idx + 1}</td>
            <td class="border-print">${val.kawasan ?? ''}</td>
            <td class="border-print">${val.konsumen ?? ''}</td>
            <td class="border-print">${val.lantai ?? ''}</td>
            <td class="border-print">${val.luas_bangunan ?? ' '}(m<sup>2</sup>)/${val.luas_tanah ?? ''}(m<sup>2</sup>) </td>
            <td class="border-print">${val.marketing ?? ''}</td>
            <td class="border-print">${val.nomor ?? ''}</td>
            <td class="border-print">${val.posisi ?? ''}</td>
            <td class="border-print">${val.status ?? ''}</td>
            <td class="border-print">${val.tgl_pesan ?? ''}</td>
            <td class="border-print">${val.tipe ?? ''}</td>
            <td class="border-print">${val.total_harga ?? ''}</td>
            <td class="border-print">${val.unit ?? ''}</td>
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
            <td class="border-print">${idx + 1}</td>
            <td class="border-print">${val.blok ?? ''}</td>
            <td class="border-print">${val.harga ?? ''}</td>
            <td class="border-print">${val.kawasan ?? ''}</td>
            <td class="border-print">${val.lantai ?? ''}</td>
            <td class="border-print">${val.luas_bangunan ?? ' '}(m<sup>2</sup>)/${val.luas_tanah ?? ''}(m<sup>2</sup>) </td>
            <td class="border-print">${val.nomor ?? ''}</td>
            <td class="border-print">${val.posisi ?? ''}</td>
            <td class="border-print">${val.tipe ?? ''}</td>
            <td class="border-print">${val.unit ?? ''}</td>
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