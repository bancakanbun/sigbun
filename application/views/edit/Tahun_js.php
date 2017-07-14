	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": [0,1,2],
				    "sClass": 'text-center'
				} ]
		    }
		);
	});

	$('#frmDetailTahun').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var kode = button.data("kode");
		var nama = (kode!="") ? button.data("nama") : "";
		var judul = ((kode!="") ? "Edit" : "Tambah") + " data tahun";
		var mode = (kode!="") ? "edit" : "";

		var modal = $(this);
		modal.find(".modal-title").text(judul);
		modal.find("#namatahun").val(nama);
		modal.find("#hKode").val(kode);
		modal.find("#hMode").val(mode);
	});

	$( "#btnSimpan" ).click(function() {
        $("#imgSimpan").toggle();
        SimpanData();
    });

    function SimpanData() {
    	var kode = $("#hKode").val();
    	var nama = $("#namatahun").val();
    	var mode = $("#hMode").val();

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('tahun/save'); ?>",
	        data: { "kodetahun": kode, "namatahun": nama, "editmode": mode },
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
	        url: "<?php echo site_url('tahun/delete'); ?>",
	        data: { "kodetahun": kode },
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
