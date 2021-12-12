var $=jQuery.noConflict();

$(document).ready(function(){
    $('.appsmo-gallery-unsplash-button').on('click', function(e) {
        retrieveImage(e);
      });
   
});

var retrieveImage = (e) => {
    var data = {
		'action': 'appsmo_gallery_action',
		'service': $("input[name=service]").val()      
	};
    console.log(data);
	jQuery.post(ajax_object.ajax_url, data, function(response) {
		alert('Got this from the server: ' + response);
	});
}