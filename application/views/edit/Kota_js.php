	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": [0,2],
				    "sClass": 'text-center'
				} ]
		    }
		);
	});

	$('#frmDetailKota').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var kode = button.data("kode");
		var nama = (kode!="") ? button.data("nama") : "";
		var judul = ((kode!="") ? "Edit" : "Tambah") + " data Kabupaten/Kota";
		var mode = (kode!="") ? "edit" : "";

		var modal = $(this);
		modal.find(".modal-title").text(judul);
		modal.find("#kodekota").val(kode);
		modal.find("#hKode").val(kode);
		modal.find("#namakota").val(nama);
		modal.find("#hNama").val(nama);
		modal.find("#hMode").val(mode);
	});

	$( "#btnSimpan" ).click(function() {
        $("#imgSimpan").toggle();
        SimpanData();
    });

    function SimpanData() {
    	var kode = $("#kodekota").val();
    	var lkode = $("#hKode").val();
    	var nama = $("#namakota").val();
    	var lnama = $("#hNama").val();
    	var mode = $("#hMode").val();

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('kota/save'); ?>",
	        data: { "kodekota": kode, "namakota": nama, "editmode": mode, "kodelama": lkode, "namalama": lnama },
	        success: function (msg) {
	            alert("Data tersimpan dengan sukses");
	            location.reload(true);
	        },
	        error: function (xhr, status, error) {
	            alert("Error!");
	            console.log(error);
	        }
	    });
	}

	$( ".btnDelete" ).click(function() {
		var kode = $(this).attr("data-kode");
		var nama = $(this).attr("data-nama");
		
		if(confirm("Hapus data?")) DeleteData(kode,nama);
    });

    function DeleteData(kode,nama) {
    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('kota/delete'); ?>",
	        data: { "kodekota": kode, "namakota": nama },
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
