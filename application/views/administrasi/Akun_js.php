	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": [2,4],
				    "sClass": 'text-center'
				} ]
		    }
		);
	});

	$('#frmDetailUser').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var kode = button.data("kode");
		var nama = (kode!="") ? button.data("nama") : "";
		var username = (kode!="") ? button.data("user") : "";
		var password = (kode!="") ? button.data("pass") : "";
		var level = (kode!="") ? button.data("type") : "";
		var kota = (kode!="") ? button.data("kota") : "";
		var judul = ((kode!="") ? "Edit" : "Tambah") + " data pengguna";
		var mode = (kode!="") ? "edit" : "";

		var modal = $(this);
		modal.find(".modal-title").text(judul);
		modal.find("#kode").val(kode);
		modal.find("#nama").val(nama);
		modal.find("#username").val(username);
		modal.find("#level").val(level).change();
		modal.find("#kota").val(kota).change();
		modal.find("#hMode").val(mode);

		if(kode!="") modal.find("#password").attr("readonly","");
	});

	$( "#btnSimpan" ).click(function() {
        $("#imgSimpan").toggle();
        SimpanData();
    });

    function SimpanData() {
    	var kode = $("#kode").val();
    	var nama = $("#nama").val();
    	var username = $("#username").val();
    	var password = $("#password").val();
    	var level = $("#level").val();
    	var kota = $("#kota").val();
    	var mode = $("#hMode").val();

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('akun/save'); ?>",
	        data: { "kode": kode, "nama": nama, "username": username, "password": password
	        		, "level": level, "editmode": mode, "kodekota": kota },
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
	        url: "<?php echo site_url('akun/delete'); ?>",
	        data: { "kode": kode },
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
