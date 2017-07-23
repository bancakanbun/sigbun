	$( "#btnSave" ).click(function() {
		if(confirm("Simpan data?")) SaveSetting();
    });

    function SaveSetting() {
    	var url = $("#alamat").val();

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('administrasi/savewfs'); ?>",
	        data: { "url": url },
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