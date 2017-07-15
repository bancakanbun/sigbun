	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": 4,
				    "sClass": 'text-center'
				} ]
		    }
		);
	});
