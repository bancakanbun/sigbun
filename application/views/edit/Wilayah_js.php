	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ 	{ "targets": [6], "sClass": 'text-center' },
	        		{ "targets": [4], "render": $.fn.dataTable.render.number( '.',',',0, ), "sClass": 'text-right'},
	        		{ "targets": [5], "render": $.fn.dataTable.render.number( '.',',',2, ), "sClass": 'text-right'}
				]
		    }
		);
	});

	$( "#kota" ).change(function() {
        var kota = $( "#kota" ).val();
        var desa = $( "#hDesa" ).val();

        $("#desa").empty().append('<option value="">[ Pilih Desa ]</option>');
        
        if(kota!="") {
	        $.ajax({
		        type: "GET",
		        url: "<?php echo site_url('desa/getbycity/'); ?>" + kota.toLowerCase(),
		        success: function (msg) {
		            $.each($.parseJSON(msg),function(key, val) 
					{
					    $("#desa").append('<option value="' + val.id_desa + '">' + val.nm_desa + '</option>');
					});

			    	if(desa!="") {
			    		$("#desa").val(desa).change();
			    		$("#hDesa").val("");
			    	}
		        },
		        error: function (xhr, status, error) {
		            alert("Error while loading data Desa!");
		            console.log(error);
		        }
		    });
    	}

    });

	$('#frmDetailWilayah').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var kode = button.data("kode");
		var tanaman = (kode!="") ? button.data("tanaman") : "";
		var kota = (kode!="") ? button.data("kota") : "";
		var luas = (kode!="") ? button.data("luas") : "";
		var harga = (kode!="") ? button.data("harga") : "";
		var desa = (kode!="") ? button.data("desa") : "";

		var judul = ((kode!="") ? "Edit" : "Tambah") + " data Lahan Perkebunan";
		var mode = (kode!="") ? "edit" : "";

		var modal = $(this);
		modal.find(".modal-title").text(judul);
		modal.find("#kodewilayah").val(kode);
		modal.find("#tanaman").val(tanaman).change();
		modal.find("#hDesa").val(desa);
		modal.find("#kota").val(kota).change();
		modal.find("#luaslahan").val(luas);
		modal.find("#hargapanen").val(harga);
		modal.find("#hMode").val(mode);
	});

	$( "#btnSimpan" ).click(function() {
        $("#imgSimpan").toggle();
        SimpanData();
    });

    function SimpanData() {
    	var kode = $("#kodewilayah").val();
    	var desa = $("#desa").val();
    	var tanaman = $("#tanaman").val();
    	var luas = $("#luaslahan").val();
    	var harga = $("#hargapanen").val();
    	var mode = $("#hMode").val();

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('wilayah/save'); ?>",
	        data: { "kodewilayah": kode, "kodedesa": desa, "kodetanaman": tanaman
        			, "luas": luas, "harga": harga, "editmode": mode },
	        success: function (msg) {
	            alert("Data tersimpan dengan sukses");
	            location.reload(true);
	        },
	        error: function (xhr, status, error) {
	            alert("Error!");
	            console.log(xhr);
	        }
	    });
	}

	$( ".btnDelete" ).click(function() {
		var kode = $(this).attr("data-kode");
		
		if(confirm("Hapus data?")) DeleteData(kode);
    });

    function DeleteData(kode) {
    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('wilayah/delete'); ?>",
	        data: { "kodewilayah": kode },
	        success: function (msg) {
	            alert("Data terhapus dengan sukses");
	            location.reload(true);
	        },
	        error: function (xhr, status, error) {
	            alert("Error!");
	            console.log(error);
	        }
	    });
	}
