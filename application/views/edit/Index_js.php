	$(document).ready(function(){
        $( "#btnEditMulai" ).click(function() {
            //alert('test');
            //alert( $("#PilihanEdit").val() );
            location.href = '<?php echo site_url('edit'); ?>/' + $("#PilihanEdit").val();
        });
	});
