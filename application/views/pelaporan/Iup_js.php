	$(document).ready(function(){
        $('#data tfoot th').each( function () {
	        var title = $(this).text();
	        $(this).html( '<input type="text" placeholder="'+title+'" />' );
	    } );

        var table = $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [  {
				    "targets": [9],
				    "render": $.fn.dataTable.render.number( '.',',',0, ),
				    "sClass": 'text-right'
				},{
				    "targets": 4,
				    "sClass": 'text-center'
				} ]
		    }
		);

		table.columns().every( function () {
	        var that = this;
	 
	        $( 'input', this.footer() ).on( 'keyup change', function () {
	            if ( that.search() !== this.value ) {
	                that
	                    .search( this.value )
	                    .draw();
	            }
	        } );
	    } );
	});
