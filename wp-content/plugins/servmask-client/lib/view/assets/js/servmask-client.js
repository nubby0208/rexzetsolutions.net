jQuery(document).ready(function($) {
	$('.ui.checkbox').checkbox();

	$.ajax({
		url: servmask_client.ajax.wp_content_url,
		type: 'GET',
		dataType: 'json'
	}).done(function (result) {
		$('table').append('<tr class="positive smc-size"><td><input type="hidden" name="Size of WP_CONTENT_DIR" value="'+ result.wp_content_size +'" />Size of WP_CONTENT_DIR</td><td>'+ result.wp_content_size +'</td></tr>');
		smc_remove_spinner();
	}).fail(function (jqXHR, textStatus, textError) {
		$('div.active').removeClass('active');
		alert('Unable to get "Size of WP_CONTENT_DIR" option because: ' + textError);
	});

	$.ajax({
		url: servmask_client.ajax.wp_content_dir_size_url,
		type: 'GET',
		dataType: 'json'
	}).done(function (result) {
		$('table').append('<tr class="positive smc-dir-size"><td>Size of WP_CONTENT_DIR by folders</td><td class="dir-size"></td></tr>');
		$.each( result.wp_content_dirs_size, function( k, v ){
			var result = v.split(' - ');
			$('.dir-size').append( v + '<br />' );
			$('.dir-size').append( '<input type="hidden" name="'+ result[0] +'" value="'+ result[1] +'" />' );
		});
		smc_remove_spinner();
	}).fail(function (jqXHR, textStatus, textError) {
		$('div.active').removeClass('active');
		alert('Unable to get "Size of WP_CONTENT_DIR by folders" option because: ' + textError);
	});

	$.ajax({
		url: servmask_client.ajax.backup_size_url,
		type: 'GET',
		dataType: 'json'
	}).done(function (result) {
		$('tr:nth-child(19)').before('<tr class="positive smc-backup-size"><td><input type="hidden" name="Backup size" value="'+ result.backup_size +'" />Backup size</td><td>'+ result.backup_size +'</td></tr>');
		smc_remove_spinner();
	}).fail(function (jqXHR, textStatus, textError) {
		$('div.active').removeClass('active');
		alert('Unable to get "Backup size" option because: ' + textError);
	});


	function smc_remove_spinner(){
		if ($(".smc-size").length > 0 && $(".smc-dir-size").length > 0 && $(".smc-backup-size").length > 0){
			$('div.active').removeClass('active');
		}
	}
});