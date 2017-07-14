	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": 5,
				    "render": $.fn.dataTable.render.number( '.',',',2, ),
				    "sClass": 'text-right'
				},{
				    "targets": 4,
				    "sClass": 'text-center'
				} ]
		    }
		);
	});
