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
		if(response.responseCode === "200"){
            console.log(response.data)
        }
	});
}