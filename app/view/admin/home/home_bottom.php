var drTable = {};
var ieid = '';
function initLineChart(context, type_chart, label_title, labels, data, color, backgroundColor){
    new Chart(context, {
    type: type_chart,
    data: {
        labels: labels,
        datasets: [{
            label: label_title,
            tension: 0.4,
            weight: 5,
            borderRadius: 5,
            pointRadius: 0,
            borderColor: color,
            borderWidth: type_chart == 'line' ? 3 : 0,
            backgroundColor: backgroundColor,
            fill: true,
            data: data,
            maxBarThickness: type_chart == 'line' ? 6 : 35

        },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            display: false,
        }
        },
        interaction: {
        intersect: false,
        mode: 'index',
        },
        scales: {
        y: {
            grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
            },
            ticks: {
            display: true,
            padding: 10,
            color: '#b2b9bf',
            font: {
                size: 11,
                family: "Poppins",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        x: {
            grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
            },
            ticks: {
            display: true,
            color: '#b2b9bf',
            padding: 10,
            font: {
                size: 11,
                family: "Poppins",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        },
    },
    });
}

var ctx1 = document.getElementById("line-chart-gradient-omset").getContext("2d");
var ctx2 = document.getElementById("line-chart-gradient-jumlah").getContext("2d");

var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, 'rgba(94,114,228,0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke1.addColorStop(0, 'rgba(94,114,228,0)'); //purple colors

var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

initLineChart(ctx1, "line", "Omset", <?=$chart->bulan?>, <?=$chart->omset?>, "#5e72e4", gradientStroke1)
initLineChart(ctx2, "bar", "Order", <?=$chart->bulan?>, <?=$chart->jumlah?>, "#3A416F", "#3A416F")


App.datatables();

if(jQuery('#drTable').length>0){
	drTable = jQuery('#drTable')
	.on('preXhr.dt', function ( e, settings, data ){
		$().btnSubmit();
	}).DataTable({
			"order"					: [[ 3, "asc" ]],
			"responsive"	  : true,
			"bProcessing"		: true,
			"bServerSide"		: true,
			"sAjaxSource"		: "<?=base_url("api_admin/pengaturan/jadwal/")?>",
			"fnServerParams": function ( aoData ) {
				aoData.push(
					{ "name": "a_company_id", "value": $("#fl_a_company_id").val() },
					{ "name": "is_active", "value": $("#fl_is_active").val() }
				);
			},
			"fnServerData"	: function (sSource, aoData, fnCallback, oSettings) {
				oSettings.jqXHR = $.ajax({
					dataType 	: 'json',
					method 		: 'POST',
					url 		: sSource,
					data 		: aoData
				}).done(function (response, status, headers, config) {
					$('#drTable > tbody').off('click', 'tr');
					$('#drTable > tbody').on('click', 'tr', function (e) {
						e.preventDefault();
						var id = $(this).find("td").html();
						ieid = id;
					
						
					});

					$().btnSubmit('finished');

					fnCallback(response);
				}).fail(function (response, status, headers, config) {
					gritter("<?=DATATABLES_AJAX_FAILED_MSG?>", '<?=DATATABLES_AJAX_FAILED_CLASS?>');
					$().btnSubmit('finished');
				});
			},
	});
	$('.dataTables_filter input').attr('placeholder', 'Cari nama, telp');
	$("#fl_button").on("click",function(e){
		e.preventDefault();
		drTable.ajax.reload();
	});
}