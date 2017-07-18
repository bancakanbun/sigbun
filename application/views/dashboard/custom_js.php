var maxtahun = "<?php echo $max_tahun; ?>";
var kota = [<?php foreach ($kota->result() as $row) { echo "'".$row->nm_kota."',"; } ?>];

function GenerateSeriesData(source,name_field,data_field)
{
    var key = "";
    var data = [];
    var target = [];

    jQuery.each(source, function(i, val) {
        if(key!=val[name_field] && key != "") {
            tmp = {name: key, data: data};
            target.push(tmp);
            data = [];
        }

        key = val[name_field];
        data.push((val[data_field]!=0)?parseInt(val[data_field]):null);
    });

    return target;
}

function TahunChange() {
    var id = $(this).attr("id");
    var tahun = $(this).val();
    var url = "";
    var target = "";
    var name_field = "";
    var data_field = "";

    if (id=="tahun1") {
        url = "<?php echo site_url('dashboard/getseranganoptluas'); ?>/" + tahun;
        target = "dashboard01";
        name_field = "nm_tanaman";
        data_field = "luasdaerah";
    }
    if (id=="tahun2") {
        url = "<?php echo site_url('dashboard/getseranganoptrugi'); ?>/" + tahun;
        target = "dashboard02";
        name_field = "nm_tanaman";
        data_field = "total_rugi";
    }

    $.ajax({
        type: "GET",
        url: url,
        success: function (msg) {
            var data = GenerateSeriesData($.parseJSON(msg),name_field,data_field);
            var chart = $('#' + target).highcharts();

            if(chart.series.length > 0) while(chart.series.length > 0) chart.series[0].remove(true);

            jQuery.each(data, function(i, val) { chart.addSeries(val,false); });
            chart.redraw();
        },
        error: function (xhr, status, error) {
            alert("Error while loading data!");
            console.log(error);
        }
    });
}

Highcharts.chart('dashboard01', {
    chart: { type: 'column' },
    title: { text: '' },
    xAxis: { categories: kota },
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
    }
    ,series: []
});

Highcharts.chart('dashboard02', {
    chart: { type: 'column' },
    title: { text: '' },
    xAxis: { categories: kota },
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
    }
    ,series: []
});

$(document).ready(function(){
    $( "#tahun1" ).change(TahunChange);
    $( "#tahun1" ).val(maxtahun).change();
    $( "#tahun2" ).change(TahunChange);
    $( "#tahun2" ).val(maxtahun).change();
});