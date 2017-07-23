	var kota = "<?php echo $info->id_kota; ?>";
	var desa = "<?php echo $info->id_desa; ?>";

	$(function () {
        $('#dtDari').datetimepicker({format: 'DD/MM/YYYY'});
        $('#dtSampai').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false //Important! See issue #1075
        });
        $("#dtDari").on("dp.change", function (e) {
            $('#dtSampai').data("DateTimePicker").minDate(e.date);
        });
        $("#dtSampai").on("dp.change", function (e) {
            $('#dtDari').data("DateTimePicker").maxDate(e.date);
        });
    });

    $(document).ready(function(){
        $('#kode').val("<?php echo $info->idinfo; ?>");
        $('#tahun').val("<?php echo $info->id_tahun; ?>");
        $('#luaslahan').val("<?php echo $info->luasdaerah; ?>");
        $('#hargapanen').val("<?php echo $info->hargapanen; ?>");
        $('#tanaman').val("<?php echo $info->id_tanaman; ?>").change();
        $('#dtDari').data("DateTimePicker").date(moment("<?php echo $info->awal; ?>"));
        $('#dtSampai').data("DateTimePicker").date(moment("<?php echo $info->akhir; ?>"));

        var myRadio = $('input[name=triwulanRadio]');
        var triwulan = myRadio.filter('[value=<?php echo $info->triwulan; ?>]').prop('checked', true);

        $('#detail_opt').DataTable(
	        {
		        "bLengthChange": false,
				"bFilter": false,
				"columnDefs": 
		        [ {
				    "targets": [0,2],
				    "bVisible": false
				},{
					"render": RenderDeleteButton,
					"targets": [14]
				},{
				    "targets": [10,11],
				    "render": $.fn.dataTable.render.number( '.',',',2, ),
				    "sClass": 'text-right'
				} ]
		    }
		);
	});

	function RenderDeleteButton( data, type, row) {
		var str = "";
		str += '<button type="button" class="btn btn-default btn-xs btnDelete">';
		str += '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';

		return str;
	}

    $(document).on("click", ".btnDelete", function(){
        $('#detail_opt').DataTable().row($(this).parent()).remove().draw( false );
	});

	$( "#tanaman" ).change(function() {
        var tanaman = $(this).val();
        $("#produktivitas").val($(this).children(':selected').attr("data-prd"));

        $("#kota").empty().append('<option value="">[ Pilih Kab/Kota ]</option>');
        $("#organisme").empty().append('<option value="">[ Pilih organisme ]</option>');
        
        if(tanaman!="") {
	        $.ajax({
		        type: "GET",
		        url: "<?php echo site_url('wilayah/getkotabykomoditi/'); ?>" + tanaman,
		        success: function (msg) {
		            $.each($.parseJSON(msg),function(key, val) 
					{
					    $("#kota").append('<option value="' + val.id_kota + '">' + val.nm_kota + '</option>');
					});
					$("#kota").val(kota).change();
		        },
		        error: function (xhr, status, error) {
		            alert("Error while loading data Desa!");
		            console.log(error);
		        }
		    });

	        $.ajax({
		        type: "GET",
		        url: "<?php echo site_url('opt/getbytanaman/'); ?>" + tanaman,
		        success: function (msg) {
		            $.each($.parseJSON(msg),function(key, val) 
					{
					    $("#organisme").append('<option value="' + val.id_opt + '" data-persen="' + val.persentase_hilang + '">' + val.nm_opt + '</option>');
					});
		        },
		        error: function (xhr, status, error) {
		            alert("Error while loading data Desa!");
		            console.log(error);
		        }
		    });
    	}

    });

	$( "#kota" ).change(function() {
        var tanaman = $("#tanaman").val();
        var kota = $(this).val();

        $("#desa").empty().append('<option value="">[ Pilih Kec/Desa ]</option>');
        
        if(kota!="") {
	        $.ajax({
		        type: "GET",
		        url: "<?php echo site_url('wilayah/getdesabykomoditiandkota/'); ?>" + tanaman + "/" + kota,
		        success: function (msg) {
		            $.each($.parseJSON(msg),function(key, val) 
					{
					    $("#desa").append('<option value="' + val.id_desa + '">' + val.nm_desa + '</option>');
					});
					$("#desa").val(desa).change();
		        },
		        error: function (xhr, status, error) {
		            alert("Error while loading data Desa!");
		            console.log(error);
		        }
		    });
    	}

    });

	$( "#desa" ).change(function() {
        var tanaman = $("#tanaman").val();
        var kota = $("#kota").val();
        var desa = $(this).val();

        if(tanaman!="" && desa!="") {
	        $.ajax({
		        type: "GET",
		        url: "<?php echo site_url('wilayah/getwilayah/'); ?>" + tanaman + "/" + desa,
		        success: function (msg) {
		            var data = $.parseJSON(msg);
		            $("#wilayah").val(data[0].id_wilayah);
		        },
		        error: function (xhr, status, error) {
		            alert("Error while loading data Desa!");
		            console.log(xhr);
		        }
		    });
    	}

    });

    $( "#btnTambahDetail" ).click(function() {
        var tanaman = $("#tanaman").val();
        if(tanaman=="") {
        	alert("Pilih komoditi terlebih dahulu");
        	return;
    	}

    	//reset form input detail
    	$("#organisme").val("");
        var ringan = $("#ringan").val(0);
        var sedang = $("#sedang").val(0);
        var berat = $("#berat").val(0);
        var apbn = $("#apbn").val(0);
        var apbd1 = $("#apbd1").val(0);
        var apbd2 = $("#apbd2").val(0);
        var masyarakat = $("#masyarakat").val(0);
        var pengendalian = $("#pengendalian").val("");
        var hilangproduksi = $("#hilangproduksi").val(0);
        var kerugianhasil = $("#kerugianhasil").val(0);

    	$('#frmDetailPengamatan').modal('show');
    });

	$( "#btnSimpanDetail" ).click(function() {
        $("#imgSimpan").toggle();

        var kode = $("#organisme").val();
        var organisme = (kode=="")?"":$("#organisme").children(':selected').text();
        var persentase = (kode=="")?"":$("#organisme").children(':selected').attr("data-persen");
        var ringan = $("#ringan").val();
        var sedang = $("#sedang").val();
        var berat = $("#berat").val();
        var apbn = $("#apbn").val();
        var apbd1 = $("#apbd1").val();
        var apbd2 = $("#apbd2").val();
        var masyarakat = $("#masyarakat").val();
        var pengendalian = $("#pengendalian").val();
        var hilangproduksi = $("#hilangproduksi").val();
        var kerugianhasil = $("#kerugianhasil").val();

        var data = [kode,organisme,persentase,apbn,apbd1,apbd2,masyarakat,ringan,sedang,berat,0,kerugianhasil,hilangproduksi,pengendalian,kode];
        $('#detail_opt').dataTable().fnAddData(data);

        $('#frmDetailPengamatan').modal('hide');
        $("#imgSimpan").toggle();
    });

	$( "#btnSave" ).click(function() {
        $("#imgSave").toggle();

        var kode = $("#kode").val();
        var tanggal = moment().format("YYYY-MM-DD hh:mm:ss");
        var wilayah = $("#wilayah").val();
        var kodetahun = $("#tahun").val();
        var tahun = (kodetahun=="")?"":$("#tahun").children(':selected').text();
        var tanaman = $("#tanaman").val();
        var produktivitas = $("#produktivitas").val();
        var kota = $("#kota").val();
        var desa = $("#desa").val();
        var dtDari = $("#dtDari").val();
        var dtSampai = $("#dtSampai").val();
        var luaslahan = $("#luaslahan").val();
        var hargapanen = $("#hargapanen").val();
        
        var dtDari = $('#dtDari').data("DateTimePicker").date();
        if(dtDari!=null) dtDari = dtDari.format("YYYY-MM-DD hh:mm:ss");
        var dtSampai = $('#dtSampai').data("DateTimePicker").date();
        if(dtSampai!=null) dtSampai = dtSampai.format("YYYY-MM-DD hh:mm:ss");

        var myRadio = $('input[name=triwulanRadio]');
        var triwulan = myRadio.filter(':checked').val();
        if(triwulan == undefined) triwulan="";

        var info = new Object();
        var idbaru = "P." + wilayah + "." + tahun + "." + triwulan;
        info.id = idbaru;
        info.idlama = kode;
        info.tanggal = tanggal;
        info.wilayah = wilayah;
        info.tahun = kodetahun;
        info.triwulan = triwulan;
        info.hargapanen = hargapanen;
        info.luaslahan = luaslahan;
        info.awal = dtDari;
        info.akhir = dtSampai;

        var details = [];
        var kerugian = 0;
        counter = 0;

        $.each($('#detail_opt').DataTable().rows().data(),function(key, val) 
		{
		    counter++;
		    var detail = new Object();
		    var rugi = parseInt(val[11]);
		    kerugian += rugi;

		    detail.id = idbaru + "-" + String("000" + counter).slice(-3);;
		    detail.kode = idbaru;
		    detail.organisme = val[0];
		    detail.apbn =  val[3];
		    detail.apbd1 = val[4];
		    detail.apbd2 = val[5];
		    detail.masyarakat = val[6];
		    detail.ringan = val[7];
		    detail.sedang = val[8];
		    detail.berat = val[9];
		    detail.hilangproduksi = produktivitas; 
		    detail.hargapanen = hargapanen;
		    detail.persentaseserang = val[2]; 
		    detail.rugihasil = rugi;
		    detail.produkhasil = val[12];
		    detail.carakendali = val[13];

		    details.push(detail);
		});

		info.totalrugi = kerugian;
		info.details = details;

		$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('pengamatan/save'); ?>",
	        data: { "info": JSON.stringify(info), "editmode": "edit" },
	        success: function (msg) {
	            alert("Data tersimpan dengan sukses");
	            location.href="<?php echo site_url(); ?>/edit/pengamatan";
	            //console.log(msg);
	        },
	        error: function (xhr, status, error) {
	            $("#imgSave").toggle();
	            alert("Error!");
	            console.log(xhr);
	        }
	    });

        $("#imgSave").toggle();
    });
