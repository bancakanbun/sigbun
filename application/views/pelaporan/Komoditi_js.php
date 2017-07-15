	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": 2,
				    "sClass": 'text-center'
				} ]
		    }
		);
	});
