    $( "#btnLogin" ).click(function() { DoLogin(); });
    $( "#username" ).keypress(function(event) { if(event.which == 13) DoLogin(); });
    $( "#password" ).keypress(function(event) { if(event.which == 13) DoLogin(); });

    function DoLogin() {
    	var username = $("#username").val();
    	var password = $("#password").val();

    	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('akun/dologin'); ?>",
	        data: { "username": username, "password": password },
	        success: function (msg) {
            	var str = msg.trim();
	            if(str=="SUCCESS") location.href="<?php echo site_url('home'); ?>";
	            else {
	            	if (str=="ERROR") str = "<strong>Username</strong> tidak terdaftar atau <strong>password</strong> salah";
	            	$(".alert").html(str);
	            	$(".alert").show();
	            }
	        },
	        error: function (xhr, status, error) {
	            alert("Error!");
	            console.log(xhr);
	        }
	    });
	}

	$(document).ready(function() {
	    $( "#username" ).focus();
	});