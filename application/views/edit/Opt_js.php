	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": [4,5],
				    "sClass": 'text-center'
				} ]
		    }
		);
	});

	$('#frmDetailOpt').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 

		var kode = button.data("kode");
		var nama = (kode!="") ? button.data("nama") : "";
		var tanaman = (kode!="") ? button.data("tanaman") : "";
		var namalatin = (kode!="") ? button.data("namalatin") : "";
		var persen = (kode!="") ? button.data("persen") : "";
		
		var judul = ((kode!="") ? "Edit" : "Tambah") + " data organisme pengganggu tanaman";
		var mode = (kode!="") ? "edit" : "";

		var modal = $(this);
		modal.find(".modal-title").text(judul);
		modal.find("#kodeopt").val(kode);
		modal.find("#namaopt").val(nama);
		modal.find("#namalatin").val(namalatin);
		modal.find("#persen").val(persen);
		modal.find("#tanaman").val(tanaman).change();
		modal.find("#hMode").val(mode);
	});

	$( "#btnSimpan" ).click(function() {
        $("#imgSimpan").toggle();
        SimpanData();
    });

    function SimpanData() {
    	var kode = $("#kodeopt").val();
    	var nama = $("#namaopt").val();
    	var namalatin = $("#namalatin").val();
    	var persen = $("#persen").val();
    	var tanaman = $("#tanaman").val();
    	var mode = $("#hMode").val();

    	var data = { "kodeopt": kode, "namaopt": nama, "namalatin": namalatin
    				, "persen": persen, "idtanaman": tanaman, "editmode": mode };

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('opt/save'); ?>",
	        data: data,
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
	        url: "<?php echo site_url('opt/delete'); ?>",
	        data: { "kodeopt": kode },
	        success: function (msg) {
	            alert("Data terhapus dengan sukses");
	            location.reload(true);
	        },
	        error: function (xhr, status, error) {
	            alert("Error!");
	            console.log(xhr);
	        }
	    });
	}
