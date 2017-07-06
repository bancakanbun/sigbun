Highcharts.chart('dashboard01', {
    chart: { type: 'column' },
    title: { text: 'Jumlah serangan organisme penggangu tanaman' },
    xAxis: {
        categories: [<?php foreach ($kota->result() as $row) { echo "'".$row->nm_kota."',"; } ?>]
    },
    yAxis: {
        min: 0,
        title: { text: 'Luas daerah (ha)' },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    legend: {
        align: 'center',
        x: -30,
        y: 25,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '{series.name}: {point.y}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
<?php
	$kom = "";
	echo "series: [";
	foreach ($content->result() as $row) 
	{
		if ($kom != $row->nm_tanaman) {
			if ($kom!="") echo "]}, ";
			echo "{ name: '".$row->nm_tanaman."', data: [";
			$kom = $row->nm_tanaman;
		}
		echo (($row->luasdaerah == 0) ? "null" : $row->luasdaerah).",";
	}
	echo "]}]";
?>
});

Highcharts.chart('dashboard02', {
    chart: { type: 'column' },
    title: { text: 'Jumlah kerugian (rupiah) akibat organisme penggangu tanaman' },
    xAxis: {
        categories: [<?php foreach ($kota->result() as $row) { echo "'".$row->nm_kota."',"; } ?>]
    },
    yAxis: {
        min: 0,
        title: { text: 'Total rugi (Rp)' },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    legend: {
        align: 'center',
        x: -30,
        y: 25,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '{series.name}: {point.y}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
<?php
	$kom = "";
	echo "series: [";
	foreach ($content2->result() as $row) 
	{
		if ($kom != $row->nm_tanaman) {
			if ($kom!="") echo "]}, ";
			echo "{ name: '".$row->nm_tanaman."', data: [";
			$kom = $row->nm_tanaman;
		}
		echo (($row->total_rugi == 0) ? "null" : $row->total_rugi).",";
	}
	echo "]}]";
?>
});