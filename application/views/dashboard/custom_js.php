var maxtahun = "<?php echo $max_tahun; ?>";
var kota = [<?php foreach ($kota->result() as $row) { echo "'".$row->nm_kota."',"; } ?>];

function GenerateSeriesData(source,name_field,data_field)
{
    var tmp = {};
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

    target.push({name: key, data: data});

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

    var chart = $('#' + target).highcharts();
    chart.showLoading();
    $.ajax({
        type: "GET",
        url: url,
        success: function (msg) {
            var data = GenerateSeriesData($.parseJSON(msg),name_field,data_field);

            if(chart.series.length > 0) while(chart.series.length > 0) chart.series[0].remove(true);

            jQuery.each(data, function(i, val) { chart.addSeries(val,false); });
            chart.redraw();
            chart.hideLoading();
        },
        error: function (xhr, status, error) {
            alert("Error while loading data!");
            console.log(error);
        }
    });
}

function LoadDashboardIup() {
    var dashboard03 = $('#dashboard03').highcharts();
    dashboard03.showLoading();
    
    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    var dashboard04 = $('#dashboard04').highcharts();
    dashboard04.showLoading();
    <?php } ?>

    var iup_data = $.parseJSON('<?php echo $iup_data; ?>');

    var kota = {};
    var status = {};
    var komoditi = {};

    var chart3 = {};
    var chart4 = {};

    jQuery.each(iup_data["features"], function(i, val) { 
        var namakota = val["properties"]["wadmkk"];
        if (!(namakota in kota)) { kota[namakota] = "a"; }

        var namastatus = val["properties"]["statussk"];
        if(namastatus === null) namastatus = "Tidak Ada Status";
        namastatus = namastatus.toUpperCase();
        if (!(namastatus in status)) { status[namastatus] = "a"; }

        var namakomoditi = val["properties"]["jnskbn"];
        if (!(namakomoditi in komoditi)) { komoditi[namakomoditi] = "a"; }

        var luas = parseFloat(val["properties"]["shape_area"]);
        
        if(!(namakomoditi in chart3)) chart3[namakomoditi] = {};
        if(!(namakota in chart3[namakomoditi])) chart3[namakomoditi][namakota] = 0.0;
        chart3[namakomoditi][namakota] += luas;

        if(!(namakomoditi in chart4)) chart4[namakomoditi] = {};
        if(!(namastatus in chart4[namakomoditi])) chart4[namakomoditi][namastatus] = 0.0;
        chart4[namakomoditi][namastatus] += luas;
    });

    kota = Object.keys(kota);
    status = Object.keys(status);
    komoditi = Object.keys(komoditi);

    data3 = [];
    data4 = [];

    jQuery.each(komoditi, function(i, kom) { 
        if(!(kom in chart3)) chart3[kom] = {};
        jQuery.each(kota, function(i, k) { 
            if(!(k in chart3[kom])) chart3[kom][k] = 0.0; 
            var o = new Object(); 
            o.nm_kota = k;
            o.nm_tanaman = kom;
            o.luas_area = chart3[kom][k];
            data3.push(o);
        });

        if(!(kom in chart4)) chart4[kom] = {};
        jQuery.each(status, function(i, s) { 
            if(!(s in chart4[kom])) chart4[kom][s] = 0.0; 
            var o = new Object(); 
            o.nm_status = s;
            o.nm_tanaman = kom;
            o.luas_area = chart4[kom][s];
            data4.push(o);
        });
    });

    var data3 = GenerateSeriesData(data3,"nm_tanaman","luas_area");
    dashboard03.xAxis[0].setCategories(kota);
    if(dashboard03.series.length > 0) while(dashboard03.series.length > 0) dashboard03.series[0].remove(true);
    jQuery.each(data3, function(i, val) { dashboard03.addSeries(val,false); });
    dashboard03.redraw();
    dashboard03.hideLoading();    

    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    var data4 = GenerateSeriesData(data4,"nm_tanaman","luas_area");
    dashboard04.xAxis[0].setCategories(status);
    if(dashboard04.series.length > 0) while(dashboard04.series.length > 0) dashboard04.series[0].remove(true);
    jQuery.each(data4, function(i, val) { dashboard04.addSeries(val,false); });
    dashboard04.redraw();
    dashboard04.hideLoading();    
    <?php } ?>
}

function InitiateStackedChart(id,xlabel,ytitle,series_data) {
    Highcharts.chart(id, {
        chart: { type: 'column' },
        title: { text: '' },
        xAxis: { categories: xlabel },
        yAxis: {
            min: 0,
            title: { text: ytitle },
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
        ,series: series_data
    });
    
}

InitiateStackedChart('dashboard01',kota,'Luas daerah (ha)',[]);
InitiateStackedChart('dashboard03',[],'Luas daerah (ha)',[]);

<?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
InitiateStackedChart('dashboard02',kota,'Total rugi (Rp)',[]);
InitiateStackedChart('dashboard04',[],'Luas daerah (ha)',[]);
<?php } ?>


$(document).ready(function(){
    $( "#tahun1" ).change(TahunChange);
    $( "#tahun1" ).val(maxtahun).change();

    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    $( "#tahun2" ).change(TahunChange);
    $( "#tahun2" ).val(maxtahun).change();
    <?php } ?>

    LoadDashboardIup();
});