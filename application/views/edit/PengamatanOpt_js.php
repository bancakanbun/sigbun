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
				},{
				    "targets": [11],
				    "width": "100px"
				}],
		        "initComplete" : function () {
		            this.api().columns().every( function () {
		                var column = this;
		                if(this.index()!=0) {
			                var select = $('<select><option value=""></option></select>')
			                    .appendTo( $(column.footer()).empty() )
			                    .on( 'change', function () {
			                        var val = $.fn.dataTable.util.escapeRegex( $(this).val() );
			 
			                        column.search( val ? '^'+val+'$' : '', true, false ).draw();
			                    } );
			 
			                column.data().unique().sort().each( function ( d, j ) {
			                    select.append( '<option value="'+d+'">'+d+'</option>' )
			                } );
		            	}
		            } );
		        }
		    }
		);
	});

    $( ".btnEdit" ).click(function() {
        var kode = $(this).attr("data-kode");
        var url = "<?php echo site_url('edit/pengamatan/update'); ?>/" + kode;
        location.href=url;
    });

