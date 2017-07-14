	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": [2,3],
				    "sClass": 'text-center'
				} ]
		    }
		);
	});

	$('#frmDetailTanaman').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var id = button.data("id");
		var nama = (id!="") ? button.data("nama") : "";
		var prod = (id!="") ? button.data("prod") : "0";
		var judul = ((id!="") ? "Edit" : "Tambah") + " data komoditi";
		var mode = (id!="") ? "edit" : "";

		var modal = $(this);
		modal.find(".modal-title").text(judul);
		modal.find("#kodetanaman").val(id);
		modal.find("#namatanaman").val(nama);
		modal.find("#produktivitas").val(prod);
		modal.find("#hMode").val(mode);
	});

	$( "#btnSimpan" ).click(function() {
        $("#imgSimpan").toggle();
        SimpanData();
    });

    function SimpanData() {
    	var id = $("#kodetanaman").val();
    	var nama = $("#namatanaman").val();
    	var prod = $("#produktivitas").val();
    	var mode = $("#hMode").val();
    	console.log({ "idtanaman": id, "namatanaman": nama, "produktivitas": prod, "editmode": mode });

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('tanaman/save'); ?>",
	        data: { "idtanaman": id, "namatanaman": nama, "produktivitas": prod, "editmode": mode },
	        success: function (msg) {
	            alert("Data tersimpan dengan sukses");
	            location.reload(true);
	        },
	        error: function (xhr, status, error) {
	            alert("Error!");
	            console.log(error);
	            $("#imgSimpan").toggle();
	        }
	    });
	}

	$( ".btnDelete" ).click(function() {
		var idtanaman = $(this).attr("data-id");
		
		if(confirm("Hapus data?")) DeleteData(idtanaman);
    });

    function DeleteData(idtanaman) {
    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('tanaman/delete'); ?>",
	        data: { "idtanaman": idtanaman },
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
