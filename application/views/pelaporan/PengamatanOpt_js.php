	$(document).ready(function(){
        $('#data').DataTable( 
	        {
		        "columnDefs": 
		        [ {
				    "targets": [8,10],
				    "render": $.fn.dataTable.render.number( '.',',',2, ),
				    "sClass": 'text-right'
				},{
				    "targets": [2,3,9],
				    "sClass": 'text-center'
				} ],
		        "initComplete" : function () {
		            this.api().columns().every( function () {
		                var column = this;
		                var select = $('<select><option value=""></option></select>')
		                    .appendTo( $(column.footer()).empty() )
		                    .on( 'change', function () {
		                        var val = $.fn.dataTable.util.escapeRegex(
		                            $(this).val()
		                        );
		 
		                        column
		                            .search( val ? '^'+val+'$' : '', true, false )
		                            .draw();
		                    } );
		 
		                column.data().unique().sort().each( function ( d, j ) {
		                    select.append( '<option value="'+d+'">'+d+'</option>' )
		                } );
		            } );
		        }
		    }
		);
	});
