var $=jQuery.noConflict();

$(document).ready(function(){
    $('select').on('change', function() {
        toggleQuery(this.value);
      });
   
});

var retrieveImage = () => {
    var data = {
		'action': 'appsmo_gallery_action',
		'whatever': ajax_object.we_value      // We pass php values differently!
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(ajax_object.ajax_url, data, function(response) {
		alert('Got this from the server: ' + response);
	});
}