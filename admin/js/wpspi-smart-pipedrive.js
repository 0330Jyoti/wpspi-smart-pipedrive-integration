 (function($) { 
 	"use strict"; 
	var wp_module_name, pipedrive_module_name;
 	jQuery(document).on("change", "select[name=wp_module]", function(){
		jQuery('.loader').addClass('is-active');

		wp_module_name = jQuery(this).val();
		jQuery.ajax({
	        url: smart_pipedrive_js.ajaxurl,
	        type: 'post',
	        data: {
	            'action':'wp_field',
	            'wp_module_name': wp_module_name
	        },
	        success: function( response ) {
	            jQuery("select[name=wp_field]").empty().append(response);
	            jQuery('.loader').removeClass('is-active');
	        },
	    });
	});


	jQuery(document).on("change", "select[name=pipedrive_module]", function(){
		
		jQuery('.loader').addClass('is-active');

		pipedrive_module_name = jQuery(this).val();

		jQuery.ajax({
	        url: smart_pipedrive_js.ajaxurl,
	        type: 'post',
	        data: {
	            'action':'pipedrive_field',
	            'pipedrive_module_name': pipedrive_module_name
	        },
	        success: function( response ) {
	            jQuery("select[name=pipedrive_field]").empty().append(response);
	            jQuery('.loader').removeClass('is-active');
	        },
	    });
	});

	jQuery(document).ready(function(){

		$('#mapping-list-table').DataTable( {
	        initComplete: function () {
	            this.api().columns().every( function () {
	                var column = this;
	                var select = $('<select><option value="">Select All</option></select>')
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
	    } );
	});	    

})(jQuery); 