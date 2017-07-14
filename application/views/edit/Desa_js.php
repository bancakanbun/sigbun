	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": [3],
				    "sClass": 'text-center'
				} ]
		    }
		);
	});

	$('#frmDetailDesa').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var kode = button.data("kode");
		var nama = (kode!="") ? button.data("nama") : "";
		var kota = (kode!="") ? button.data("kota") : "";
		var judul = ((kode!="") ? "Edit" : "Tambah") + " data Kecamatan/Desa";
		var mode = (kode!="") ? "edit" : "";

		var modal = $(this);
		modal.find(".modal-title").text(judul);
		modal.find("#kodedesa").val(kode);
		modal.find("#namadesa").val(nama);
		modal.find("#kodekota").val(kota).change();
		modal.find("#hMode").val(mode);
	});

	$( "#btnSimpan" ).click(function() {
        $("#imgSimpan").toggle();
        SimpanData();
    });

    function SimpanData() {
    	var kode = $("#kodedesa").val();
    	var nama = $("#namadesa").val();
    	var kota = $("#kodekota").val();
    	var mode = $("#hMode").val();

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('desa/save'); ?>",
	        data: { "kodedesa": kode, "namadesa": nama, "editmode": mode, "kodekota": kota },
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
		
		if(confirm("Hapus data?")) DeleteData(kode);
    });

    function DeleteData(kode) {
    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('desa/delete'); ?>",
	        data: { "kodedesa": kode },
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
