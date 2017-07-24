var sipkebun_data = $.parseJSON('<?php echo $sipkebun_data; ?>');
var sp2bks = $.parseJSON('<?php echo $sp2bks; ?>');

var maxtahun = "<?php echo $max_tahun; ?>";
var kota = [<?php foreach ($kota->result() as $row) { echo "'".$row->nm_kota."',"; } ?>];
var bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
var tema = ["PKE","CPKO","CPO","KERNEL","TBS"];
var kelompok = ["PERORANGAN","PERUSAHAAN","KELOMPOK TANI"];

function GenerateSeriesData(source,name_field,data_field,show_in_legend)
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

    target.push({name: key, data: data, showInLegend:show_in_legend});

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
            var data = GenerateSeriesData($.parseJSON(msg),name_field,data_field,true);

            if(chart.series.length > 0) while(chart.series.length > 0) chart.series[0].remove(true);

            jQuery.each(data, function(i, val) { chart.addSeries(val,false); });
            chart.series[0].showInLegend = false;
            chart.redraw();
            chart.hideLoading();
        },
        error: function (xhr, status, error) {
            alert("Error while loading data!");
            console.log(xhr);
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

    var data3 = GenerateSeriesData(data3,"nm_tanaman","luas_area",true);
    dashboard03.xAxis[0].setCategories(kota);
    if(dashboard03.series.length > 0) while(dashboard03.series.length > 0) dashboard03.series[0].remove(true);
    jQuery.each(data3, function(i, val) { dashboard03.addSeries(val,false); });
    dashboard03.redraw();
    dashboard03.hideLoading();    

    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    var data4 = GenerateSeriesData(data4,"nm_tanaman","luas_area",true);
    dashboard04.xAxis[0].setCategories(status);
    if(dashboard04.series.length > 0) while(dashboard04.series.length > 0) dashboard04.series[0].remove(true);
    jQuery.each(data4, function(i, val) { dashboard04.addSeries(val,false); });
    dashboard04.redraw();
    dashboard04.hideLoading();    
    <?php } ?>
}

function Tahun2Change() {
    var id = $(this).attr("id");
    var tahun = $(this).val();

    if(id == "tahun3") LoadSipKebun(tahun,"dashboard05");
    if(id == "tahun4") LoadSipKebun(tahun,"dashboard06");
}

function LoadSipKebun(tahun_aktif,id_dashboard) {
    var tahun = {};
    var chart3 = {};
    var field = "";
    if (id_dashboard == "dashboard05") field = "inti_";
    if (id_dashboard == "dashboard06") field = "plasma_";
    
    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    if(tahun_aktif!="") {
        var dashboard = $('#' + id_dashboard).highcharts();
        dashboard.showLoading();
    }
    <?php } ?>

    jQuery.each(sipkebun_data, function(i, val) { 
        jQuery.each(tema, function(i,val2) {
            var thn = val["tahun"];
            if (!(thn === null)) {
                if (!(thn in tahun)) { tahun[thn] = "tahun"; }

                if(thn == tahun_aktif) {
                    var bln = val["bulan"];
                    if( !(bln===null) ) {
                        if(!(val2 in chart3)) chart3[val2] = {};
                        if(!(bulan[bln-1] in chart3[val2])) chart3[val2][bulan[bln-1]] = 0;
                        var init_val = val[field+val2.toLowerCase()];
                        init_val = (init_val===null) ? 0 : parseInt(init_val);
                        chart3[val2][bulan[bln-1]] += init_val;
                    }
                }
            } 
        });

    });

    if(tahun_aktif=="") {
        tahun = Object.keys(tahun);
        max_tahun = 0;
        
        $("#tahun3").empty()
        $.each(tahun,function(key, val) {
            $("#tahun3").append('<option value="' + val + '">' + val + '</option>');
            if(max_tahun < val) max_tahun = val;
        });

        $("#tahun4").empty()
        $.each(tahun,function(key, val) {
            $("#tahun4").append('<option value="' + val + '">' + val + '</option>');
        });

        $( "#tahun3" ).val(maxtahun).change();
        $( "#tahun4" ).val(maxtahun).change();
    }

    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    data3 = [];
    if(tahun_aktif!="") {
        jQuery.each(tema, function(i, tem) { 
            if(!(tem in chart3)) chart3[tem] = {};
            jQuery.each(bulan, function(i, k) { 
                if(!(k in chart3[tem])) chart3[tem][k] = 0.0; 
                var o = new Object(); 
                o.nm_bulan = k;
                o.nm_tema = tem;
                o.produksi = chart3[tem][k];
                data3.push(o);
            });
        });

        var data3 = GenerateSeriesData(data3,"nm_tema","produksi",true);
        if(dashboard.series.length > 0) while(dashboard.series.length > 0) dashboard.series[0].remove(true);
        jQuery.each(data3, function(i, val) { dashboard.addSeries(val,false); });
        dashboard.redraw();
        dashboard.hideLoading();    
    }
    <?php } ?>
}

function Tahun3Change() {
    load_sp2bks($(this).val());
}

function load_sp2bks(tahun_aktif) {
    var tahun = {};
    var chart3 = {};
    var id_dashboard = "dashboard07";
    var group = "Jumlah Pemohon"
    
    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    if(tahun_aktif!="") {
        var dashboard = $('#' + id_dashboard).highcharts();
        dashboard.showLoading();
    }
    <?php } ?>

    chart3[group] = {};
    jQuery.each(sp2bks.data, function(i, val) { 
        var thn = val["tahun"];
        if (!(thn === null)) {
            if (!(thn in tahun)) { tahun[thn] = "tahun"; }

            if(thn == tahun_aktif) {
                var kel = val["level"].toUpperCase();
                if(!(kel in chart3[group])) chart3[group][kel] = 0;
                var init_val = val["jml_pemohon"];
                init_val = (init_val===null) ? 0 : parseInt(init_val);
                chart3[group][kel] += init_val;
            }
        } 
    });

    if(tahun_aktif=="") {
        tahun = Object.keys(tahun);
        max_tahun = 0;
        
        $("#tahun5").empty()
        $.each(tahun,function(key, val) {
            $("#tahun5").append('<option value="' + val + '">' + val + '</option>');
            if(max_tahun < val) max_tahun = val;
        });

        $( "#tahun5" ).val(maxtahun).change();
    }

    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    data3 = [];
    if(tahun_aktif!="") {
        jQuery.each(kelompok, function(i, k) { 
            if(!(k in chart3[group])) chart3[group][k] = 0.0; 
            var o = new Object(); 
            o.nm_level = k;
            o.nm_tema = group;
            o.jumlah = chart3[group][k];
            data3.push(o);
        });

        var data3 = GenerateSeriesData(data3,"nm_tema","jumlah",false);
        if(dashboard.series.length > 0) while(dashboard.series.length > 0) dashboard.series[0].remove(true);
        jQuery.each(data3, function(i, val) { dashboard.addSeries(val,false); });
        dashboard.redraw();
        dashboard.hideLoading();    
    }
    <?php } ?>
}

function InitiateStackedChart(id,xlabel,ytitle,series_data) {
    Highcharts.chart(id, {
        chart: { type: 'column' },
        title: { text: '' },
        xAxis: { categories: xlabel },
        yAxis: {
            min: 0,
            allowDecimals: false,
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
InitiateStackedChart('dashboard05',bulan,'Jumlah produksi (ton)',[]);
InitiateStackedChart('dashboard06',bulan,'Jumlah produksi (ton)',[]);
InitiateStackedChart('dashboard07',kelompok,'Jumlah',[]);
<?php } ?>


$(document).ready(function(){
    $( "#tahun1" ).change(TahunChange);
    $( "#tahun1" ).val(maxtahun).change();

    <?php if( CheckAksesGroup(["Administrator","Operator","Eksekutif"]) ) { ?>
    $( "#tahun2" ).change(TahunChange);
    $( "#tahun2" ).val(maxtahun).change();

    $( "#tahun3" ).change(Tahun2Change);
    $( "#tahun4" ).change(Tahun2Change);

    $( "#tahun5" ).change(Tahun3Change);
    <?php } ?>

    LoadDashboardIup();
    LoadSipKebun("","");
    load_sp2bks("");
});
