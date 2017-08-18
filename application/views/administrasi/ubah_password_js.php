	function ShowError(msg) {
    	$(".alert").html(msg);
    	$("#errorbox").show();
	}

	$( "#btnSave" ).click(function() {
    	$("#errorbox").hide();
    	var passlama = $("#passlama").val();
    	var passbaru = $("#passbaru").val();
    	var passbaru2 = $("#passbaru2").val();

    	if(passlama.trim() == "") {
			ShowError("Password lama harus diisi !!");
			return;
		}

    	if(passbaru.trim() == "") {
			ShowError("Password baru harus diisi !!");
			return;
		}

    	if(passbaru2.trim() == "") {
			ShowError("Konfirmasi password baru harus diisi !!");
			return;
		}

		if(passbaru!=passbaru2) {
			ShowError("Password baru dan password konfirmasi tidak sama !!");
			return;
		}

		if(confirm("Ganti password?")) {

	    	$.ajax({
		        type: "POST",
		        url: "<?php echo site_url('akun/CheckPassword'); ?>",
		        data: { "password": passlama },
		        success: function (msg) { 
		        	var str = msg.trim();
		        	//alert(str);
		        	if(str=="SUCCESS") SaveSetting(passbaru); 
		        	else ShowError("Password lama salah !!");
		        },
		        error: function (xhr, status, error) {
		            //alert("Error!");
		            console.log(xhr);
		            ShowError("Sistem error! Silahkan hubungi administrator sistem.");
		        }
		    });
			
		}
    });

    function SaveSetting(passbaru) {
    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('akun/SavePassword'); ?>",
	        data: { "password": passbaru },
	        success: function (msg) {
	            alert("Password berhasil diubah");
	            location.reload(true);
	        },
	        error: function (xhr, status, error) {
	            //alert("Error!");
	            console.log(xhr);
	            ShowError("Sistem error! Silahkan hubungi administrator sistem.");
	        }
	    });
	}